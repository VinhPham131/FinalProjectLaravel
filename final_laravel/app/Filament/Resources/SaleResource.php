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
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SaleResource extends Resource
{
    protected static ?string $model = Sale::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('sale_target')
                    ->options([
                        'category' => 'Category',
                        'product' => 'Product',
                        'collection' => 'Collection',
                    ])
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(fn(callable $set) => $set('name', null)),
                Select::make('name')
                    ->required()
                    ->options(function (callable $get) {
                        $target = $get('sale_target');
                        if ($target === 'category') {
                            return ProductCategory::all()->pluck('name', 'name');
                        } elseif ($target === 'product') {
                            return Product::all()->pluck('name', 'name');
                        } elseif ($target === 'collection') {
                            return Collection::all()->pluck('name', 'name');
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
                TextColumn::make('sale_target')->sortable()->searchable(),
                TextColumn::make('name')->sortable()->searchable(),
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
                Tables\Actions\DeleteAction::make(),
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
}
