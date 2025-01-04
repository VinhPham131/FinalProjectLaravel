<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductCategoryResource\Pages;
use App\Models\ProductCategory;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Cache; // Import Cache facade

class ProductCategoryResource extends Resource
{
    protected static ?string $model = ProductCategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    // Cache key for caching product categories
    protected static $cacheKey = 'product_categories_list';

    // Cache duration (10 minutes)
    protected static $cacheDuration = 10; // minutes

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required(),
                TextInput::make('description')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        // Attempt to fetch product categories from cache or fetch from DB if cache is expired
        $productCategories = Cache::remember(self::$cacheKey, now()->addMinutes(self::$cacheDuration), function () {
            return ProductCategory::all(); // Cache all product categories
        });

        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('name')->sortable()->searchable(),
                TextColumn::make('slug')->sortable()->searchable(),
                TextColumn::make('description')->limit(50),
                TextColumn::make('created_at')->dateTime(),
                TextColumn::make('updated_at')->dateTime(),
            ])
            ->rows($productCategories) // Use the cached product categories
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListProductCategories::route('/'),
            'create' => Pages\CreateProductCategory::route('/create'),
            'edit' => Pages\EditProductCategory::route('/{record}/edit'),
        ];
    }

    // Invalidate cache after creating a product category
    public static function afterCreate(ProductCategory $productCategory)
    {
        Cache::forget(self::$cacheKey); // Invalidate cache on create
    }

    // Invalidate cache after updating a product category
    public static function afterUpdate(ProductCategory $productCategory)
    {
        Cache::forget(self::$cacheKey); // Invalidate cache on update
    }

    // Invalidate cache after deleting a product category
    public static function afterDelete(ProductCategory $productCategory)
    {
        Cache::forget(self::$cacheKey); // Invalidate cache on delete
    }
}

