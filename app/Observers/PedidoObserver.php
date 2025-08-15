<?php

namespace App\Observers;

use App\Models\Pedido;
use App\Models\Producto;
use App\Models\Estado;

class PedidoObserver
{
    /**
     * Se ejecuta después de que un Pedido ha sido actualizado.
     */
    public function updated(Pedido $pedido): void
    {
        // 1. Verificamos si el campo 'id_estado' fue lo que cambió.
        if ($pedido->isDirty('id_estado')) {

            // 2. Buscamos el ID del estado "Recibido".
            $estadoRecibido = Estado::where('nombre_estado', 'Recibido')->first();

            // 3. Si el nuevo estado del pedido es "Recibido", actualizamos el stock.
            if ($estadoRecibido && $pedido->id_estado == $estadoRecibido->id_estado) {

                $producto = Producto::find($pedido->id_producto);

                if ($producto) {
                    $producto->cantidad_stock += $pedido->cantidad; // Sumamos la cantidad del pedido
                    $producto->save();
                }
            }
        }
    }
}
