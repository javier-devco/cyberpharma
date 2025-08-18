<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MedidaProductoResource\Pages;
use App\Models\MedidaProducto;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;

class MedidaProductoResource extends Resource
{
    protected static ?string $model = MedidaProducto::class;

    protected static ?string $navigationIcon = 'heroicon-o-beaker'; // Un ícono alternativo relacionado a medidas
    protected static ?string $modelLabel = 'Medida de Producto';
    protected static ?string $pluralModelLabel = 'Medidas de Productos';
    protected static ?string $navigationGroup = 'Catálogos';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nombre_unidad')
                    ->label('Nombre de la Medida')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('abreviatura')
                    ->label('Abreviatura')
                    ->required()
                    ->maxLength(10),
                Forms\Components\Toggle::make('activo')
                    ->label('Activo')
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nombre_unidad')->label('Nombre')->searchable()->sortable(),
                TextColumn::make('abreviatura')->searchable(),
                IconColumn::make('activo')
                    ->label('Estado')
                    ->boolean()
                    ->sortable(),
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
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMedidaProductos::route('/'),
            'create' => Pages\CreateMedidaProducto::route('/create'),
            'edit' => Pages\EditMedidaProducto::route('/{record}/edit'),
        ];
    }
}
