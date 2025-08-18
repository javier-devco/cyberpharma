<?php

namespace App\Filament\Resources\VentaResource\Pages;

use App\Filament\Resources\VentaResource;
use App\Models\Factura;
use App\Models\Inventario;
use App\Models\Producto;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class CreateVenta extends CreateRecord
{
    protected static string $resource = VentaResource::class;

    /**
     * ¡LA LÓGICA ESTÁ AQUÍ!
     * Este método se ejecuta automáticamente después de que la Venta
     * y sus productos se han guardado en la base de datos.
     */
    protected function afterCreate(): void
    {
        // $this->record contiene la venta que se acaba de crear.
        $venta = $this->record;

        DB::transaction(function () use ($venta) {
            $totalCalculado = 0;

            foreach ($venta->ventaProductos as $item) {
                $totalCalculado += $item->cantidad * $item->precio_unitario;
                $producto = Producto::find($item->id_producto);

                if ($producto) {
                    // 1. Descontamos el stock
                    $producto->decrement('cantidad_stock', $item->cantidad);

                    // 2. Creamos el registro de salida en el inventario
                    Inventario::create([
                        'id_producto' => $item->id_producto,
                        'id_usuario' => $venta->id_usuario,
                        'movimiento' => 'salida',
                        'cantidad' => $item->cantidad,
                        'fecha_hora' => $venta->fecha_hora,
                        'descripcion' => "Salida por Venta ID: {$venta->id_venta}",
                    ]);
                }
            }

            // 3. Actualizamos la Venta con el total correcto
            $venta->total_venta = $totalCalculado;
            $venta->save();

            // 4. Creamos la Factura automáticamente
            Factura::create([
                'id_venta' => $venta->id_venta,
                'fecha_emision' => $venta->fecha_hora,
                'total_compra' => $totalCalculado,
            ]);
        });
    }
}
