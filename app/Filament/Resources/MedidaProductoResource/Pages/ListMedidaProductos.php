<?php

namespace App\Filament\Resources\MedidaProductoResource\Pages;

use App\Filament\Resources\MedidaProductoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMedidaProductos extends ListRecords
{
    protected static string $resource = MedidaProductoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
