<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CompraResource\Pages;
use App\Models\Compra;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CompraResource extends Resource
{
    protected static ?string $model = Compra::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';
    protected static ?string $modelLabel = 'Compra';
    protected static ?string $pluralModelLabel = 'Compras';
    protected static ?string $navigationGroup = 'Transacciones';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('id_producto')->label('Producto')->relationship('producto', 'descripcion')->searchable()->required(),
                Forms\Components\Select::make('id_proveedor')->label('Proveedor')->relationship('proveedor', 'nombre_proveedor')->searchable()->required(),
                Forms\Components\DateTimePicker::make('fecha_hora')->label('Fecha y Hora de Compra')->required()->default(now()),

                // --- CAMPOS REACTIVOS CORREGIDOS ---
                Forms\Components\TextInput::make('cantidad')
                    ->required()
                    ->numeric()
                    ->minValue(1)
                    ->live(onBlur: true) // Se actualiza al salir del campo
                    ->afterStateUpdated(fn(Set $set, Get $get) => $set('total', ($get('cantidad') ?? 0) * ($get('precio_unitario') ?? 0))),

                Forms\Components\TextInput::make('precio_unitario')
                    ->label('Precio Unitario')
                    ->required()
                    ->numeric()
                    ->prefix('$ ')
                    ->live(onBlur: true) // Se actualiza al salir del campo
                    ->afterStateUpdated(fn(Set $set, Get $get) => $set('total', ($get('cantidad') ?? 0) * ($get('precio_unitario') ?? 0))),

                // El campo total ahora es de solo lectura y se rellena con la lógica de arriba.
                Forms\Components\TextInput::make('total')
                    ->required()
                    ->numeric()
                    ->prefix('$ ')
                    ->readOnly(),
            ]);
    }

    // El resto de la clase (table, etc.) se mantiene igual
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('producto.descripcion')->label('Producto')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('proveedor.nombre_proveedor')->label('Proveedor')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('cantidad')->numeric()->sortable(),
                Tables\Columns\TextColumn::make('total')->money('cop')->sortable(),
                Tables\Columns\TextColumn::make('fecha_hora')->label('Fecha Compra')->dateTime()->sortable(),
            ])
            ->filters([])
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
        return [];
    }
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCompras::route('/'),
            'create' => Pages\CreateCompra::route('/create'),
            'edit' => Pages\EditCompra::route('/{record}/edit'),
        ];
    }
}
