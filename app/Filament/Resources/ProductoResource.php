<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductoResource\Pages;
use App\Models\Producto;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProductoResource extends Resource
{
    protected static ?string $model = Producto::class;

    // --- MEJORAS DE TRADUCCIÓN Y PRESENTACIÓN ---
    protected static ?string $navigationIcon = 'heroicon-o-archive-box';
    protected static ?string $modelLabel = 'Producto';
    protected static ?string $pluralModelLabel = 'Productos';
    protected static ?string $navigationGroup = 'Gestión de Productos';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('id_proveedor')->label('Proveedor')->relationship(name: 'proveedor', titleAttribute: 'nombre_proveedor')->searchable()->required(),
                Forms\Components\Select::make('id_medida')->label('Unidad de Medida')->relationship(name: 'medidaProducto', titleAttribute: 'nombre_unidad')->searchable()->required(),
                Forms\Components\Textarea::make('descripcion')->label('Descripción')->required()->maxLength(300)->columnSpanFull(),
                Forms\Components\TextInput::make('codigo_lote')->label('Código de Lote')->required()->maxLength(50),
                Forms\Components\DateTimePicker::make('fecha_hora')->label('Fecha de Vencimiento')->required(),
                Forms\Components\TextInput::make('cantidad_stock')->label('Cantidad en Stock')->required()->numeric(),
                Forms\Components\TextInput::make('precio_venta')->label('Precio de Venta')->required()->numeric()->prefix('COP'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('descripcion')->label('Descripción')->searchable(),
                Tables\Columns\TextColumn::make('proveedor.nombre_proveedor')->label('Proveedor')->sortable(),
                Tables\Columns\TextColumn::make('cantidad_stock')->label('Stock')->numeric()->sortable()->color(fn(int $state): string => match (true) {
                    $state <= 0 => 'danger',
                    $state < 10 => 'warning',
                    default => 'success',
                }),
                Tables\Columns\TextColumn::make('precio_venta')->label('Precio Venta')->money('cop')->sortable(),
                Tables\Columns\TextColumn::make('fecha_hora')->label('F. Vencimiento')->dateTime()->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                // --- CORRECCIÓN: USANDO BOTONES DE SÓLO ÍCONO ---
                Tables\Actions\EditAction::make()->iconButton(),
                Tables\Actions\DeleteAction::make()->iconButton(),
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
            'index' => Pages\ListProductos::route('/'),
            'create' => Pages\CreateProducto::route('/create'),
            'edit' => Pages\EditProducto::route('/{record}/edit'),
        ];
    }
}
