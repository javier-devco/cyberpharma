<?php

namespace App\Filament\Resources\PedidoResource\Pages;

use App\Filament\Resources\PedidoResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord; // <-- CORREGIDO: usa CreateRecord

class CreatePedido extends CreateRecord // <-- CORREGIDO: extiende de CreateRecord
{
    protected static string $resource = PedidoResource::class;
}
