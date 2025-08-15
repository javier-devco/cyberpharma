<?php

namespace App\Observers;

use App\Models\Venta;
use App\Models\Producto;

class VentaObserver
{
    /**
     * Se ejecuta después de que una Venta ha sido creada.
     */
    public function created(Venta $venta): void
    {
        // Recorremos cada línea de producto asociada a esta venta
        foreach ($venta->ventaProductos as $item) {
            // Buscamos el producto correspondiente en el inventario
            $producto = Producto::find($item->id_producto);

            // Si el producto existe, actualizamos su stock
            if ($producto) {
                $producto->cantidad_stock -= $item->cantidad; // Restamos la cantidad vendida
                $producto->save(); // Guardamos el cambio en la base de datos
            }
        }
    }

    // ... (el resto de los métodos no los necesitamos por ahora)
}
