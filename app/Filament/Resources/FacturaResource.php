<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FacturaResource\Pages;
use App\Models\Factura;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction; // <-- ¡PASO 1: AÑADE ESTE 'use'!

class FacturaResource extends Resource
{
    protected static ?string $model = Factura::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $modelLabel = 'Factura';
    protected static ?string $pluralModelLabel = 'Facturas';
    protected static ?string $navigationGroup = 'Transacciones';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        // ... (El formulario no cambia)
        return $form
            ->schema([
                Forms\Components\Select::make('id_venta')->label('Venta Asociada (ID)')->relationship('venta', 'id_venta')->searchable()->required(),
                Forms\Components\DateTimePicker::make('fecha_emision')->label('Fecha de Emisión')->required()->default(now()),
                Forms\Components\TextInput::make('total_compra')->label('Total Facturado')->numeric()->prefix('$ ')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id_factura')->label('ID Factura')->searchable(),
                Tables\Columns\TextColumn::make('venta.id_venta')->label('ID Venta')->numeric()->sortable(),
                Tables\Columns\TextColumn::make('venta.user.nombre')->label('Vendedor')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('total_compra')->label('Total Facturado')->money('cop')->sortable(),
                Tables\Columns\TextColumn::make('fecha_emision')->label('Fecha Emisión')->dateTime()->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            // --- ¡SECCIÓN MODIFICADA! ---
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    ExportBulkAction::make(), // <-- ¡AQUÍ ESTÁ LA LÍNEA AÑADIDA!
                ]),
            ]);
    }

    // ... (El resto de los métodos no cambian)
    public static function getRelations(): array { return []; }
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFacturas::route('/'),
            'create' => Pages\CreateFactura::route('/create'),
            'edit' => Pages\EditFactura::route('/{record}/edit'),
        ];
    }
}