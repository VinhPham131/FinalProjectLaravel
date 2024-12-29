<?php

namespace App\Filament\Resources\ProductResource\RelationManagers;

use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ViewField;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Storage;

class MediaRelationManager extends RelationManager
{
    protected static string $relationship = 'media';
    protected static ?string $title = 'Images';

    protected static ?string $modelLabel = 'Images';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Hidden::make('id'),
                ViewField::make('file_name')
                    ->label('Image Preview')
                    ->disabled()
                    ->view('filament.forms.components.image-preview')
                    ->afterStateHydrated(function ($component, $get, $state) {
                        $component->state(Storage::url($get('id') . '/' . $get('file_name')));
                    })
                    ->dehydrated(false),
                TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->columnSpan('full'),
            ]);
    }
    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('file_name')
                    ->label('Image')
                    ->getStateUsing(function ($record) {
                        return $record->getFullUrl();
                    }),
                Tables\Columns\TextColumn::make('name'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                // Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->reorderable('order_column')
            ->defaultSort(column: 'order_column');
    }
}
