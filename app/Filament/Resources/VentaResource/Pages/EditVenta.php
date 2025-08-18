<?php

namespace App\Filament\Resources\VentaResource\Pages;

use App\Filament\Resources\VentaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditVenta extends EditRecord
{
    protected static string $resource = VentaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    /**
     * ¡LÓGICA CORREGIDA!
     * Este método se ejecuta DESPUÉS de que los cambios en la Venta han sido guardados.
     */
    protected function afterSave(): void
    {
        $venta = $this->getRecord();
        $total = 0;

        foreach ($venta->ventaProductos as $item) {
            $total += $item->cantidad * $item->precio_unitario;
        }

        $venta->total_venta = $total;
        $venta->save();
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
