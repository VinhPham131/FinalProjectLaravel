<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CollectionResource\Pages;
use App\Models\Collection;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Cache; // Import the Cache facade

class CollectionResource extends Resource
{
    protected static ?string $model = Collection::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    // Cache key to invalidate
    protected static $cacheKey = 'collections_list';
    // Cache duration (10 minutes in this case)
    protected static $cacheDuration = 10; // minutes

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Textarea::make('description')
                    ->required()
                    ->maxLength(65535),
            ]);
    }

    public static function table(Table $table): Table
    {
        $collections = Cache::remember(self::$cacheKey, now()->addMinutes(self::$cacheDuration), function () {
            return Collection::all(); // Cache all collections
        });
        
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('name')->sortable()->searchable(),
                TextColumn::make('description')->sortable()->searchable(),
                TextColumn::make('slug')->sortable()->searchable(),
                TextColumn::make('created_at')->dateTime(),
                TextColumn::make('updated_at')->dateTime(),
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
            'index' => Pages\ListCollections::route('/'),
            'create' => Pages\CreateCollection::route('/create'),
            'edit' => Pages\EditCollection::route('/{record}/edit'),
        ];
    }

    // Hook into the resource's after create event to clear the cache
    public static function afterCreate(Collection $collection)
    {
        Cache::forget(self::$cacheKey); // Invalidate the cache when a collection is created
    }

    // Hook into the resource's after update event to clear the cache
    public static function afterUpdate(Collection $collection)
    {
        Cache::forget(self::$cacheKey); // Invalidate the cache when a collection is updated
    }

    // Hook into the resource's after delete event to clear the cache
    public static function afterDelete(Collection $collection)
    {
        Cache::forget(self::$cacheKey); // Invalidate the cache when a collection is deleted
    }
}

