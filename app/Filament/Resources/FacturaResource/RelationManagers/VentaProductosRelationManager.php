<?php

namespace App\Filament\Resources\FacturaResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class VentaProductosRelationManager extends RelationManager
{
    protected static string $relationship = 'ventaProductos';

    // Título de la tabla
    protected static ?string $title = 'Productos Facturados';

    public function form(Form $form): Form
    {
        // No necesitamos un formulario, ya que es de solo lectura.
        return $form->schema([]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id_venta_producto')
            ->columns([
                Tables\Columns\TextColumn::make('producto.descripcion')
                    ->label('Producto'),
                Tables\Columns\TextColumn::make('cantidad'),
                Tables\Columns\TextColumn::make('precio_unitario')
                    ->label('Precio Unitario')
                    ->money('cop'),
            ])
            ->filters([])
            // Deshabilitamos todas las acciones para que sea de solo lectura
            ->headerActions([])
            ->actions([])
            ->bulkActions([]);
    }
}
