<?php

// El namespace debe ser EXACTAMENTE este
namespace App\Filament\Widgets;

// Imports necesarios
use App\Models\Compra;
use App\Models\Producto;
use App\Models\Venta;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

// El nombre de la clase debe ser EXACTAMENTE este
class StatsOverview extends BaseWidget
{
    protected static ?string $pollingInterval = '15s';
    protected int | string | array $columnSpan = 'full';

    protected function getStats(): array
    {
        $lowStockThreshold = 10;
        $vencimientoThreshold = Carbon::now()->addDays(30);

        $productosBajoStock = Producto::where('cantidad_stock', '<=', $lowStockThreshold)->count();
        $productosProximosVencer = Producto::whereBetween('fecha_hora', [Carbon::now(), $vencimientoThreshold])->count();
        $totalComprasMes = Compra::where('fecha_hora', '>=', now()->startOfMonth())->count();
        $ingresosMes = Venta::where('fecha_hora', '>=', now()->startOfMonth())->sum('total_venta');

        return [
            Stat::make('Productos con Bajo Stock', $productosBajoStock)->description("Stock <= {$lowStockThreshold} unidades")->descriptionIcon('heroicon-m-exclamation-triangle')->color($productosBajoStock > 0 ? 'danger' : 'success'),
            Stat::make('Productos Próximos a Vencer', $productosProximosVencer)->description("En los próximos 30 días")->descriptionIcon('heroicon-m-clock')->color($productosProximosVencer > 0 ? 'warning' : 'success'),
            Stat::make('Total de Compras (este mes)', $totalComprasMes)->description('Compras registradas este mes')->descriptionIcon('heroicon-m-shopping-bag')->color('primary'),
            Stat::make('Ingresos (este mes)', '$ ' . number_format($ingresosMes, 0))->description('Suma de las ventas de este mes')->descriptionIcon('heroicon-m-currency-dollar')->color('info'),
        ];
    }
}
