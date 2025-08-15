<?php

namespace App\Filament\Widgets;

use App\Models\Venta;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class VentasChart extends ChartWidget
{
    protected static ?string $heading = 'Ventas de la Última Semana';
    protected static ?int $sort = 2; // Orden en el dashboard
    protected int | string | array $columnSpan = 'full'; // Ocupa todo el ancho

    protected function getData(): array
    {
        // 1. Obtenemos los datos de ventas de los últimos 7 días, agrupados por fecha.
        $data = Venta::query()
            ->whereDate('fecha_hora', '>=', now()->subDays(6))
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get([
                DB::raw('DATE(fecha_hora) as date'),
                DB::raw('SUM(total_venta) as total')
            ])
            ->pluck('total', 'date'); // Creamos un array asociativo: [fecha => total]

        // 2. Preparamos los contenedores para las etiquetas (días) y los valores del gráfico.
        $labels = [];
        $values = [];

        // 3. Iteramos sobre los últimos 7 días para asegurarnos de que todos los días aparecen en el gráfico.
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $dateString = $date->format('Y-m-d');

            // Añadimos la etiqueta del día (Ej: "12 Ago")
            $labels[] = $date->format('d M');

            // Buscamos el total de ventas para ese día. Si no hubo ventas, ponemos 0.
            $values[] = $data[$dateString] ?? 0;
        }

        // 4. Devolvemos los datos en el formato que espera Filament.
        return [
            'datasets' => [
                [
                    'label' => 'Ventas por Día',
                    'data' => $values,
                    'backgroundColor' => '#ea9216', // Tu naranja vibrante
                    'borderColor' => '#ea9216',
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        // Aseguramos que sea un gráfico de barras
        return 'bar';
    }
}
