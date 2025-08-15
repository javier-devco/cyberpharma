<?php

namespace App\Observers;

use App\Models\Inventario;
use App\Models\Producto;

class InventarioObserver
{
    /**
     * Se ejecuta después de que un registro de Inventario ha sido creado.
     */
    public function created(Inventario $inventario): void
    {
        $producto = Producto::find($inventario->id_producto);

        if ($producto) {
            if ($inventario->movimiento === 'entrada' || $inventario->movimiento === 'ajuste') {
                // Si es entrada o ajuste, sumamos. 
                // (Nota: podrías querer una lógica más compleja para los ajustes)
                $producto->cantidad_stock += $inventario->cantidad;
            } elseif ($inventario->movimiento === 'salida') {
                $producto->cantidad_stock -= $inventario->cantidad;
            }

            $producto->save();
        }
    }
}
