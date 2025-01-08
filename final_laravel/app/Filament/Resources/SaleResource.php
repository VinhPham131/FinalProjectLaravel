<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SaleResource\Pages;
use App\Models\Collection;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Sale;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Illuminate\Support\Facades\Cache;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SaleResource extends Resource
{
    protected static ?string $model = Sale::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';

    // Cache key prefix for sale target data
    protected static $saleTargetCacheKey = 'sale_target_';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Select::make('sale_target_type')
                    ->options([
                        'category' => 'Category',
                        'product' => 'Product',
                        'collection' => 'Collection',
                    ])
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(fn(callable $set) => $set('sale_target_id', null)),
                Select::make('sale_target_id')
                    ->required()
                    ->options(function (callable $get) {
                        $targetType = $get('sale_target_type');
                        if ($targetType === 'category') {
                            return ProductCategory::all()->pluck('name', 'id');
                        } elseif ($targetType === 'product') {
                            return Product::all()->pluck('name', 'id');
                        } elseif ($targetType === 'collection') {
                            return Collection::all()->pluck('name', 'id');
                        }
                        return [];
                    }),
                TextInput::make('percentage')
                    ->numeric()
                    ->required(),
                DatePicker::make('start_date')
                    ->required(),
                DatePicker::make('end_date')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('name')->sortable()->searchable(),
                TextColumn::make('sale_target_type')->sortable()->searchable(),
                TextColumn::make('sale_target_id')
                    ->label('Sale Target')
                    ->getStateUsing(function ($record) {
                        $cacheKey = self::$saleTargetCacheKey . $record->sale_target_id;

                        return Cache::remember($cacheKey, 60, function () use ($record) {
                            if ($record->sale_target_type === 'category') {
                                return ProductCategory::find($record->sale_target_id)->name ?? 'N/A';
                            } elseif ($record->sale_target_type === 'product') {
                                return Product::find($record->sale_target_id)->name ?? 'N/A';
                            } elseif ($record->sale_target_type === 'collection') {
                                return Collection::find($record->sale_target_id)->name ?? 'N/A';
                            }
                            return 'N/A';
                        });
                    })
                    ->sortable()
                    ->searchable(),
                TextColumn::make('percentage')->sortable(),
                TextColumn::make('start_date')->dateTime(),
                TextColumn::make('end_date')->dateTime(),
                TextColumn::make('created_at')->dateTime(),
                TextColumn::make('updated_at')->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSales::route('/'),
            'create' => Pages\CreateSale::route('/create'),
            'edit' => Pages\EditSale::route('/{record}/edit'),
        ];
    }

    // Invalidate cache after creating a sale
    public static function afterCreate(Sale $sale)
    {
        self::invalidateSaleTargetCache($sale); // Invalidate cache for the relevant sale target
    }

    // Invalidate cache after updating a sale
    public static function afterUpdate(Sale $sale)
    {
        self::invalidateSaleTargetCache($sale); // Invalidate cache for the relevant sale target
    }

    // Invalidate cache after deleting a sale
    public static function afterDelete(Sale $sale)
    {
        self::invalidateSaleTargetCache($sale); // Invalidate cache for the relevant sale target
    }

    // Helper method to invalidate sale target cache
    protected static function invalidateSaleTargetCache(Sale $sale)
    {
        $cacheKey = self::$saleTargetCacheKey . $sale->sale_target_id;
        Cache::forget($cacheKey); // Remove the cache entry for the sale target
    }
}

