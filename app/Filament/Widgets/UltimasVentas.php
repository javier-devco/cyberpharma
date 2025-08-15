<?php

namespace App\Filament\Widgets;

use App\Models\Venta;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class UltimasVentas extends BaseWidget
{
    protected static ?string $pollingInterval = '15s';
    protected int | string | array $columnSpan = 'full';
    protected static ?string $heading = 'Últimas Ventas Registradas';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Venta::query()->latest('fecha_hora')->limit(5)
            )
            ->columns([
                // --- CORRECCIÓN CRÍTICA ---
                // Asegúrate de que tu modelo Venta tiene una relación llamada 'user'.
                // Si la relación se llama 'vendedor', cambia 'user.nombre' por 'vendedor.nombre'.
                Tables\Columns\TextColumn::make('user.nombre')
                    ->label('Vendedor'),

                Tables\Columns\TextColumn::make('total_venta')
                    ->label('Total')
                    ->money('cop'),

                Tables\Columns\TextColumn::make('fecha_hora')
                    ->label('Fecha')
                    ->since(),
            ])
            ->paginated(false);
    }
}
