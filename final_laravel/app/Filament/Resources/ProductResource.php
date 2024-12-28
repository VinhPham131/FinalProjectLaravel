<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\HtmlString;

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

                Placeholder::make('Images')
                    ->content(function ($record): HtmlString {
                        if (!$record) {
                            return new HtmlString('<div>No images available.</div>');
                        }

                        $imagesHtml = '<div style="display: flex; flex-wrap: wrap; gap: 10px;">';
                        foreach ($record->getMedia('productImages') as $media) {
                            $imagesHtml .= "<img src='" . $media->getUrl() . "' style='max-height: 100px;'>";
                        }
                        $imagesHtml .= '</div>';
                        return new HtmlString($imagesHtml);
                    }),

                SpatieMediaLibraryFileUpload::make('image')
                    ->collection('productImages')
                    ->multiple()
                    ->downloadable()
                    ->responsiveImages()
                    ->reorderable(),
            ]);
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
                ImageColumn::make('productImages')
                    ->label('Image')
                    ->getStateUsing(function ($record) {
                        return $record->getFirstMediaUrl('productImages') ?? null;
                    })
                    ->height(80)
                    ->width(80),
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
            //
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
