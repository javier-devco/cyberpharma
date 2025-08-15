<?php

namespace App\Observers;

use App\Models\Compra;
use App\Models\Producto;

class CompraObserver
{
    /**
     * Se ejecuta después de que una Compra ha sido creada.
     */
    public function created(Compra $compra): void
    {
        // Buscamos el producto correspondiente en el inventario
        $producto = Producto::find($compra->id_producto);

        // Si el producto existe, actualizamos su stock
        if ($producto) {
            $producto->cantidad_stock += $compra->cantidad; // Sumamos la cantidad comprada
            $producto->save(); // Guardamos el cambio en la base de datos
        }
    }

    // ... (el resto de los métodos no los necesitamos por ahora)
}
