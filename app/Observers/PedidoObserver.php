<?php

namespace App\Observers;

use App\Models\Pedido;
use App\Models\Producto;
use App\Models\Estado;

class PedidoObserver
{
    public function updated(Pedido $pedido): void
    {
        if ($pedido->isDirty('id_estado')) {
            $estadoRecibido = Estado::where('nombre_estado', 'Recibido')->first();
            if ($estadoRecibido && $pedido->id_estado == $estadoRecibido->id_estado) {
                $producto = Producto::find($pedido->id_producto);
                if ($producto) {
                    $producto->cantidad_stock += $pedido->cantidad;
                    $producto->save();
                }
            }
        }
    }
}
