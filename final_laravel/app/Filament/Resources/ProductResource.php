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

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

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
                    ->saveRelationshipsUsing(fn($component) => $component->saveUploadedFiles())]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('name')->sortable()->searchable(),
                TextColumn::make('slug')->sortable()->searchable(),
                TextColumn::make('price')->sortable(),
                TextColumn::make('quantity')->sortable(),
                TextColumn::make('category.name')->sortable()->searchable(),
                TextColumn::make('collection.name')->sortable()->searchable(),
                SpatieMediaLibraryImageColumn::make('images')
                    ->collection('products'),
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
}
