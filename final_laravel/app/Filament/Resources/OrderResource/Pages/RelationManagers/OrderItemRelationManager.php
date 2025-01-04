<?php

namespace App\Filament\Resources\OrderResource\RelationManagers;

use App\Models\OrderItem;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class OrderItemRelationManager extends RelationManager
{
    protected static string $relationship = 'items';
    protected static ?string $title = 'Order Items';

    protected static ?string $modelLabel = 'Order Item';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('product_id')
                    ->relationship('product', 'name')
                    ->required(),
                TextInput::make('quantity')
                    ->numeric()
                    ->required(),
                TextInput::make('price')
                    ->numeric()
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('product.image')
                    ->label('Product Image')
                    ->getStateUsing(function ($record) {
                        return $record->product->getFirstMediaUrl('products');
                    }),
                TextColumn::make('product.name')->label('Product')->sortable()->searchable(),
                TextColumn::make('quantity')->sortable()->searchable(),
                TextColumn::make('price')->sortable()->searchable(),
                TextColumn::make('total')
                    ->label('Total')
                    ->getStateUsing(function (OrderItem $record) {
                        return $record->quantity * $record->price;
                    })
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->form([
                        TextInput::make('quantity')
                            ->numeric()
                            ->required(),
                        TextInput::make('price')
                            ->numeric()
                            ->required(),
                    ])
                    ->action(function (OrderItem $record, array $data): void {
                        $record->quantity = $data['quantity'];
                        $record->price = $data['price'];
                        $record->save();

                        // Update the total price of the associated order
                        $order = $record->order;
                        $order->total_price = $order->items->sum(fn($item) => $item->quantity * $item->price);
                        $order->save();
                    }),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
