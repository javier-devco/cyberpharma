<?php

namespace App\Filament\Resources\VentaResource\Pages;

use App\Filament\Resources\VentaResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateVenta extends CreateRecord
{
    protected static string $resource = VentaResource::class;

    /**
     * ¡LÓGICA CORREGIDA!
     * Este método se ejecuta DESPUÉS de que la Venta y sus VentaProductos han sido creados.
     */
    protected function afterCreate(): void
    {
        $venta = $this->getRecord();
        $total = 0;

        // Recorremos los productos que YA ESTÁN en la base de datos
        foreach ($venta->ventaProductos as $item) {
            $total += $item->cantidad * $item->precio_unitario;
        }

        // Actualizamos la venta con el total correcto y la guardamos de nuevo.
        $venta->total_venta = $total;
        $venta->save();
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
