<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InventarioResource\Pages;
use App\Models\Inventario;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class InventarioResource extends Resource
{
    protected static ?string $model = Inventario::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';
    protected static ?string $modelLabel = 'Movimiento de Inventario';
    protected static ?string $pluralModelLabel = 'Inventario';
    protected static ?string $navigationGroup = 'Monitoreo'; // Lo agrupamos con Alertas

    // Hacemos que el Resource sea de solo lectura deshabilitando la creación
    public static function canCreate(): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        // El formulario no se usará ya que no se pueden crear/editar registros
        return $form->schema([]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('producto.descripcion')
                    ->label('Producto')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\BadgeColumn::make('movimiento')
                    ->label('Movimiento')
                    ->colors([
                        'success' => 'entrada',
                        'danger' => 'salida',
                        'warning' => 'ajuste',
                    ])
                    ->sortable(),
                Tables\Columns\TextColumn::make('cantidad'),
                Tables\Columns\TextColumn::make('user.nombre')
                    ->label('Realizado por')
                    ->searchable(),
                Tables\Columns\TextColumn::make('fecha_hora')
                    ->label('Fecha')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('descripcion')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            // Deshabilitamos las acciones de editar y borrar
            ->actions([])
            ->bulkActions([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInventarios::route('/'),
        ];
    }
}
