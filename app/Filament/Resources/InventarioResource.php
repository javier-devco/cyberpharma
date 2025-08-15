<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InventarioResource\Pages;
use App\Models\Inventario;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction; // <-- ¡PASO 1: AÑADE ESTE 'use'!

class InventarioResource extends Resource
{
    protected static ?string $model = Inventario::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';
    protected static ?string $modelLabel = 'Inventario';
    protected static ?string $pluralModelLabel = 'Inventario';
    protected static ?string $navigationGroup = 'Monitoreo';

    public static function form(Form $form): Form
    {
        // ... (El formulario no cambia)
        return $form
            ->schema([
                Forms\Components\Select::make('id_producto')->label('Producto')->relationship('producto', 'descripcion')->searchable()->required(),
                Forms\Components\Select::make('id_usuario')->label('Usuario Responsable')->relationship('user', 'nombre')->searchable()->required()->default(auth()->id()),
                Forms\Components\Select::make('movimiento')->label('Tipo de Movimiento')->options(['entrada' => 'Entrada', 'salida' => 'Salida', 'ajuste' => 'Ajuste'])->required(),
                Forms\Components\TextInput::make('cantidad')->numeric()->required(),
                Forms\Components\DateTimePicker::make('fecha_hora')->default(now()),
                Forms\Components\Textarea::make('descripcion')->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('producto.descripcion')->label('Producto')->searchable()->sortable(),
                Tables\Columns\BadgeColumn::make('movimiento')->colors(['success' => 'entrada', 'danger' => 'salida', 'warning' => 'ajuste'])->searchable()->sortable(),
                Tables\Columns\TextColumn::make('cantidad')->sortable(),
                Tables\Columns\TextColumn::make('user.nombre')->label('Responsable')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('fecha_hora')->dateTime()->sortable(),
            ])
            ->defaultSort('fecha_hora', 'desc')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(), // Aseguramos que tenga el botón de borrado
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    // --- ¡PASO 2: AÑADE ESTA LÍNEA! ---
                    ExportBulkAction::make(), // <-- ¡AQUÍ ESTÁ LA MAGIA!
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInventarios::route('/'),
            'create' => Pages\CreateInventario::route('/create'),
            'edit' => Pages\EditInventario::route('/{record}/edit'),
        ];
    }
}
