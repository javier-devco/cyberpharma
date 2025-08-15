<?php

namespace Database\Seeders;

use App\Models\MedidaProducto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MedidaProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Lista de todas las unidades de medida que quieres insertar
        $medidas = [
            ['nombre_unidad' => 'Caja', 'abreviatura' => 'Cja'],
            ['nombre_unidad' => 'Unidad', 'abreviatura' => 'Und'],
            ['nombre_unidad' => 'Gramos', 'abreviatura' => 'Gr'],
            ['nombre_unidad' => 'Miligramos', 'abreviatura' => 'Mg'],
            ['nombre_unidad' => 'Mililitros', 'abreviatura' => 'Ml'],
            ['nombre_unidad' => 'Litro', 'abreviatura' => 'L'],
            ['nombre_unidad' => 'Tableta', 'abreviatura' => 'Tab'],
            ['nombre_unidad' => 'Cápsula', 'abreviatura' => 'Cap'],
            ['nombre_unidad' => 'Frasco', 'abreviatura' => 'Fco'],
            ['nombre_unidad' => 'Ampolla', 'abreviatura' => 'Amp'],
            ['nombre_unidad' => 'Sobre', 'abreviatura' => 'Sob'],
            ['nombre_unidad' => 'Paquete', 'abreviatura' => 'Pqt'],
            ['nombre_unidad' => 'Tubo', 'abreviatura' => 'Tb'],
            ['nombre_unidad' => 'Kit', 'abreviatura' => 'Kit'],
        ];

        // Recorremos la lista e insertamos cada registro en la base de datos
        foreach ($medidas as $medida) {
            // Usamos updateOrCreate para no crear duplicados si ejecutamos el seeder varias veces
            MedidaProducto::updateOrCreate(
                ['nombre_unidad' => $medida['nombre_unidad']], // Busca por nombre
                [
                    'abreviatura' => $medida['abreviatura'],
                    'activo' => true, // Todas se crean como "Activas" por defecto
                ]
            );
        }
    }
}
