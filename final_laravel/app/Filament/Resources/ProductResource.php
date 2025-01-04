<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers\MediaRelationManager;
use App\Models\Product;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Cache; // Import Cache facade

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    // Cache key for caching products
    protected static $cacheKey = 'products_list';

    // Cache duration (10 minutes)
    protected static $cacheDuration = 10; // minutes

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required(),
                Textarea::make('description')->required(),
                TextInput::make('price')->numeric()->required(),
                TextInput::make('quantity')->numeric()->required(),
                TextInput::make('material'),
                TextInput::make('size'),
                TextInput::make('stylecode'),
                Select::make('collection_id')
                    ->relationship('collection', 'name')
                    ->nullable()
                    ->searchable()
                    ->preload(),
                TextInput::make('productcode')->required(),
                TextInput::make('color'),
                Select::make('category_id')
                    ->relationship('category', 'name')
                    ->required(),

                SpatieMediaLibraryFileUpload::make('images')
                    ->collection('products')
                    ->multiple()
                    ->image()
                    ->loadStateFromRelationshipsUsing(fn($component) => $component->state([]))
                    ->saveRelationshipsUsing(fn($component) => $component->saveUploadedFiles())
            ]);
    }

    public static function table(Table $table): Table
    {
        // Attempt to fetch products from cache or fetch from DB if cache is expired
        $products = Cache::remember(self::$cacheKey, now()->addMinutes(self::$cacheDuration), function () {
            return Product::with('category', 'collection')->get(); // Cache all products with relationships
        });

        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('name')->sortable()->searchable(),
                TextColumn::make('slug')->sortable()->searchable(),
                TextColumn::make('price')->sortable(),
                TextColumn::make('quantity')->sortable(),
                TextColumn::make('category.name')->sortable()->searchable(),
                TextColumn::make('collection.name')->sortable()->searchable(),
                SpatieMediaLibraryImageColumn::make('images')->collection('products'),
                TextColumn::make('created_at')->dateTime(),
                TextColumn::make('updated_at')->dateTime(),
            ])
            ->rows($products) // Use the cached products
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
            MediaRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }

    // Invalidate cache after creating a product
    public static function afterCreate(Product $product)
    {
        Cache::forget(self::$cacheKey); // Invalidate cache on create
    }

    // Invalidate cache after updating a product
    public static function afterUpdate(Product $product)
    {
        Cache::forget(self::$cacheKey); // Invalidate cache on update
    }

    // Invalidate cache after deleting a product
    public static function afterDelete(Product $product)
    {
        Cache::forget(self::$cacheKey); // Invalidate cache on delete
    }
}

