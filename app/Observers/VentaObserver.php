<?php

namespace App\Observers;

use App\Models\Venta;
use App\Models\Producto;
use App\Models\Inventario;
use App\Models\Factura;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log; // <-- Añadimos Log para depurar

class VentaObserver
{
    public function created(Venta $venta): void
    {
        try {
            DB::transaction(function () use ($venta) {
                $totalCalculado = 0;

                // Refrescamos la venta para asegurar que tenemos las relaciones cargadas
                $venta->load('ventaProductos.producto');

                foreach ($venta->ventaProductos as $item) {
                    $totalCalculado += $item->cantidad * $item->precio_unitario;
                    $producto = $item->producto; // Usamos la relación ya cargada

                    if ($producto) {
                        $producto->decrement('cantidad_stock', $item->cantidad);

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

                $venta->total_venta = $totalCalculado;
                $venta->save();

                Factura::create([
                    'id_venta' => $venta->id_venta,
                    'fecha_emision' => $venta->fecha_hora,
                    'total_compra' => $totalCalculado,
                ]);
            });
        } catch (\Exception $e) {
            // Si algo falla, lo registramos en el archivo de logs de Laravel
            Log::error('Error en VentaObserver: ' . $e->getMessage());
        }
    }
}
