<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Producto;
use App\Models\Proveedor;
use App\Models\MedidaProducto;
use Carbon\Carbon; // Importante para manejar las fechas

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $productosData = [
            ['proveedor' => 'Distribuidora Farmacéutica Andina S.A.S.', 'medida' => 'Caja', 'descripcion' => 'Acetaminofén 500 mg – Caja x 20 tabletas', 'codigo_lote' => 'L2025-001', 'fecha_vencimiento' => '15/08/2027', 'cantidad_stock' => 150, 'precio_venta' => '8,500'],
            ['proveedor' => 'Laboratorios Genéricos S.A.S.', 'medida' => 'Frasco', 'descripcion' => 'Jarabe para la Tos 120 ml – Sabor miel y limón', 'codigo_lote' => 'L2025-002', 'fecha_vencimiento' => '12/03/2026', 'cantidad_stock' => 80, 'precio_venta' => '12,000'],
            ['proveedor' => 'FarmaDistribuciones del Norte Ltda.', 'medida' => 'Ampolla', 'descripcion' => 'Diclofenaco Sódico 75 mg/3ml – Caja x 10 ampollas', 'codigo_lote' => 'L2025-003', 'fecha_vencimiento' => '05/11/2028', 'cantidad_stock' => 50, 'precio_venta' => '28,500'],
            ['proveedor' => 'Laboratorios Vital Pharma S.A.', 'medida' => 'Tubo', 'descripcion' => 'Crema antibiótica 15 g – Neomicina + Bacitracina', 'codigo_lote' => 'L2025-004', 'fecha_vencimiento' => '30/06/2026', 'cantidad_stock' => 200, 'precio_venta' => '6,900'],
            ['proveedor' => 'BioSalud Distribuciones S.A.S.', 'medida' => 'Caja', 'descripcion' => 'Ibuprofeno 400 mg – Caja x 10 tabletas', 'codigo_lote' => 'L2025-005', 'fecha_vencimiento' => '21/04/2027', 'cantidad_stock' => 120, 'precio_venta' => '7,200'],
            ['proveedor' => 'Medisur Ltda.', 'medida' => 'Frasco', 'descripcion' => 'Multivitamínico líquido 250 ml', 'codigo_lote' => 'L2025-006', 'fecha_vencimiento' => '01/01/2028', 'cantidad_stock' => 75, 'precio_venta' => '22,000'],
            ['proveedor' => 'FarmaExpress de Occidente S.A.S.', 'medida' => 'Caja', 'descripcion' => 'Loratadina 10 mg – Caja x 10 tabletas', 'codigo_lote' => 'L2025-007', 'fecha_vencimiento' => '05/09/2026', 'cantidad_stock' => 180, 'precio_venta' => '9,500'],
            ['proveedor' => 'Química y Salud S.A.', 'medida' => 'Sobre', 'descripcion' => 'Suero oral sabor naranja – Caja x 20 sobres', 'codigo_lote' => 'L2025-008', 'fecha_vencimiento' => '18/12/2026', 'cantidad_stock' => 90, 'precio_venta' => '18,000'],
            ['proveedor' => 'Droguerías Unidos Ltda.', 'medida' => 'Frasco', 'descripcion' => 'Alcohol antiséptico 70% 1 litro', 'codigo_lote' => 'L2025-009', 'fecha_vencimiento' => '30/11/2029', 'cantidad_stock' => 100, 'precio_venta' => '7,800'],
            ['proveedor' => 'FarmaColombia Distribuciones S.A.S.', 'medida' => 'Caja', 'descripcion' => 'Amoxicilina 500 mg – Caja x 12 cápsulas', 'codigo_lote' => 'L2025-010', 'fecha_vencimiento' => '15/02/2028', 'cantidad_stock' => 130, 'precio_venta' => '16,000'],
            ['proveedor' => 'Laboratorios El Buen Samaritano Ltda.', 'medida' => 'Caja', 'descripcion' => 'Ácido fólico 1 mg – Caja x 30 tabletas', 'codigo_lote' => 'L2025-011', 'fecha_vencimiento' => '05/05/2027', 'cantidad_stock' => 90, 'precio_venta' => '4,500'],
            ['proveedor' => 'Salud Total Proveeduría S.A.S.', 'medida' => 'Frasco', 'descripcion' => 'Shampoo medicado contra la caspa 200 ml', 'codigo_lote' => 'L2025-012', 'fecha_vencimiento' => '22/06/2028', 'cantidad_stock' => 85, 'precio_venta' => '14,000'],
            ['proveedor' => 'FarmaPlus Mayoristas S.A.S.', 'medida' => 'Caja', 'descripcion' => 'Vitamina C 500 mg – Caja x 30 tabletas', 'codigo_lote' => 'L2025-013', 'fecha_vencimiento' => '18/10/2027', 'cantidad_stock' => 200, 'precio_venta' => '8,200'],
            ['proveedor' => 'Laboratorios Naturales de Colombia S.A.', 'medida' => 'Frasco', 'descripcion' => 'Jarabe natural de eucalipto 250 ml', 'codigo_lote' => 'L2025-014', 'fecha_vencimiento' => '07/08/2026', 'cantidad_stock' => 60, 'precio_venta' => '15,500'],
            ['proveedor' => 'Distribuidora Farmacéutica Andina S.A.S.', 'medida' => 'Caja', 'descripcion' => 'Metformina 850 mg – Caja x 30 tabletas', 'codigo_lote' => 'L2025-015', 'fecha_vencimiento' => '25/03/2029', 'cantidad_stock' => 150, 'precio_venta' => '12,800'],
        ];

        foreach ($productosData as $data) {
            // 1. Buscar el ID del Proveedor por su nombre
            $proveedor = Proveedor::where('nombre_proveedor', $data['proveedor'])->first();

            // 2. Buscar el ID de la Medida por su nombre
            $medida = MedidaProducto::where('nombre_unidad', $data['medida'])->first();

            // Si no encontramos el proveedor o la medida, saltamos este producto para evitar errores.
            if (!$proveedor || !$medida) {
                continue;
            }

            // 3. Formatear los datos para la base de datos
            $precio = (float) str_replace(',', '', $data['precio_venta']);
            $fecha = Carbon::createFromFormat('d/m/Y', $data['fecha_vencimiento'])->format('Y-m-d H:i:s');

            // 4. Crear el producto usando los IDs encontrados
            Producto::updateOrCreate(
                ['codigo_lote' => $data['codigo_lote']], // Clave para evitar duplicados
                [
                    'id_proveedor' => $proveedor->id_proveedor,
                    'id_medida' => $medida->id_medida,
                    'descripcion' => $data['descripcion'],
                    'cantidad_stock' => $data['cantidad_stock'],
                    'fecha_hora' => $fecha,
                    'precio_venta' => $precio,
                ]
            );
        }
    }
}
