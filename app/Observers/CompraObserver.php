<?php

namespace App\Observers;

use App\Models\Compra;
use App\Models\Producto;
use App\Models\Inventario; // <-- Añadimos el modelo Inventario

class CompraObserver
{
    public function created(Compra $compra): void
    {
        $producto = Producto::find($compra->id_producto);

        if ($producto) {
            // 1. Sumamos el stock (esto ya lo teníamos)
            $producto->cantidad_stock += $compra->cantidad;
            $producto->save();

            // 2. ¡NUEVO! Creamos el registro en el inventario
            Inventario::create([
                'id_producto' => $compra->id_producto,
                'id_usuario' => auth()->id(), // El usuario que está registrando la compra
                'movimiento' => 'entrada',
                'cantidad' => $compra->cantidad,
                'fecha_hora' => $compra->fecha_hora,
                'descripcion' => "Compra ID: {$compra->id_compra}",
            ]);
        }
    }
}
