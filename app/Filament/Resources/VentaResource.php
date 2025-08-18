<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VentaResource\Pages;
use App\Models\Producto;
use App\Models\Venta;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Forms\Components\Actions\Action;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class VentaResource extends Resource
{
    protected static ?string $model = Venta::class;
    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';
    protected static ?string $modelLabel = 'Venta';
    protected static ?string $pluralModelLabel = 'Ventas';
    protected static ?string $navigationGroup = 'Transacciones';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()->schema([
                    Forms\Components\Select::make('id_usuario')->label('Vendedor')->relationship('user', 'nombre')->required(),
                    Forms\Components\DateTimePicker::make('fecha_hora')->label('Fecha y Hora')->required()->default(now()),
                ])->columns(2),
                Forms\Components\Section::make('Productos de la Venta')->schema([
                    Forms\Components\Repeater::make('ventaProductos')
                        ->label('Productos')->relationship()
                        ->schema([
                            Forms\Components\Select::make('id_producto')->label('Producto')->relationship('producto', 'descripcion')->searchable()->required()->live()
                                ->afterStateUpdated(function ($state, Set $set, Get $get) {
                                    $set('precio_unitario', Producto::find($state)?->precio_venta ?? 0);
                                    self::actualizarTotal($get, $set);
                                }),
                            Forms\Components\TextInput::make('cantidad')
                                ->numeric()->required()->default(1)->live()
                                ->afterStateUpdated(fn(Get $get, Set $set) => self::actualizarTotal($get, $set))
                                ->rules([
                                    fn(Get $get): \Closure => function (string $attribute, $value, \Closure $fail) use ($get) {
                                        $productoId = $get('id_producto');
                                        if (!$productoId) {
                                            return;
                                        }
                                        $producto = Producto::find($productoId);
                                        if ($value > $producto->cantidad_stock) {
                                            $fail("El stock de '{$producto->descripcion}' es solo de {$producto->cantidad_stock} unidades.");
                                        }
                                    },
                                ]),
                            Forms\Components\TextInput::make('precio_unitario')->label('Precio Unitario')->numeric()->required()->prefix('COP')->live()->afterStateUpdated(fn(Get $get, Set $set) => self::actualizarTotal($get, $set)),
                        ])
                        ->columns(3)->reorderable(false)
                        ->addAction(fn(Action $action) => $action->after(fn(Get $get, Set $set) => self::actualizarTotal($get, $set)))
                        ->deleteAction(fn(Action $action) => $action->after(fn(Get $get, Set $set) => self::actualizarTotal($get, $set)))
                        ->addActionLabel('Añadir Producto'),
                ]),
                Forms\Components\TextInput::make('total_venta')->label('Total de la Venta')->prefix('COP')->readOnly()->numeric()->dehydrated(),
            ]);
    }

    public static function actualizarTotal(Get $get, Set $set): void
    {
        $total = 0;
        $items = $get('ventaProductos');
        if (is_array($items)) {
            foreach ($items as $item) {
                $total += ($item['cantidad'] ?? 0) * ($item['precio_unitario'] ?? 0);
            }
        }
        $set('total_venta', $total);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id_venta')->label('ID Venta')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('user.nombre')->label('Vendedor')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('fecha_hora')->label('Fecha y Hora')->dateTime()->sortable(),
                Tables\Columns\TextColumn::make('total_venta')->label('Total')->money('cop')->sortable(),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    ExportBulkAction::make(),
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
            'index' => Pages\ListVentas::route('/'),
            'create' => Pages\CreateVenta::route('/create'),
            'edit' => Pages\EditVenta::route('/{record}/edit'),
        ];
    }
}
