<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PedidoResource\Pages;
use App\Models\Pedido;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;

class PedidoResource extends Resource
{
    protected static ?string $model = Pedido::class;

    protected static ?string $navigationIcon = 'heroicon-o-inbox-stack';
    protected static ?string $modelLabel = 'Pedido';
    protected static ?string $pluralModelLabel = 'Pedidos';
    protected static ?string $navigationGroup = 'Transacciones';
    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        // ... (El formulario no cambia)
        return $form
            ->schema([
                Forms\Components\Select::make('id_producto')->label('Producto')->relationship('producto', 'descripcion')->searchable()->required(),
                Forms\Components\Select::make('id_proveedor')->label('Proveedor')->relationship('proveedor', 'nombre_proveedor')->searchable()->required(),
                Forms\Components\Select::make('id_estado')->label('Estado del Pedido')->relationship('estado', 'nombre_estado')->required(),
                Forms\Components\DateTimePicker::make('fecha_hora')->label('Fecha y Hora del Pedido')->required()->default(now()),
                Forms\Components\TextInput::make('cantidad')->required()->numeric(),
                Forms\Components\TextInput::make('precio_unitario')->label('Precio Unitario')->required()->numeric()->prefix('$ '),
                Forms\Components\TextInput::make('total')->required()->numeric()->prefix('$ '),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('producto.descripcion')->label('Producto')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('proveedor.nombre_proveedor')->label('Proveedor')->searchable()->sortable(),
                Tables\Columns\BadgeColumn::make('estado.nombre_estado')->label('Estado')->colors(['primary', 'success' => 'Recibido', 'warning' => 'Enviado', 'danger' => 'Cancelado']),
                Tables\Columns\TextColumn::make('cantidad')->numeric()->sortable(),
                Tables\Columns\TextColumn::make('total')->money('cop')->sortable(),
            ])
            ->filters([
                SelectFilter::make('id_estado')->label('Filtrar por Estado')->relationship('estado', 'nombre_estado')
            ])
            // --- ¡SECCIÓN MODIFICADA! ---
            // Añadimos la acción de borrado junto a la de editar.
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(), // <-- ¡AQUÍ ESTÁ LA LÍNEA AÑADIDA!
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    // ... (El resto de los métodos no cambian)
    public static function getRelations(): array
    {
        return [];
    }
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPedidos::route('/'),
            'create' => Pages\CreatePedido::route('/create'),
            'edit' => Pages\EditPedido::route('/{record}/edit'),
        ];
    }
}
