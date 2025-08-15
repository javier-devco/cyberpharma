<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Proveedor; // Importamos el modelo Proveedor

class ProveedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Lista de proveedores a insertar
        $proveedores = [
            ['nombre_proveedor' => 'Distribuidora Farmacéutica Andina S.A.S.', 'direccion' => 'Calle 72 #15-45, Bogotá D.C.', 'telefono' => '+57 1 745 3020', 'correo_electronico' => 'contacto@andinafarma.com'],
            ['nombre_proveedor' => 'Laboratorios Genéricos S.A.S.', 'direccion' => 'Carrera 50 # 20-15, Bogotá D.C.', 'telefono' => '+57 320 456 7890', 'correo_electronico' => 'ventas@genericolab.com'],
            ['nombre_proveedor' => 'FarmaDistribuciones del Norte Ltda.', 'direccion' => 'Calle 10 # 5-12, Bucaramanga, Santander', 'telefono' => '+57 7 645 3214', 'correo_electronico' => 'pedidos@farmadelnorte.com'],
            ['nombre_proveedor' => 'Laboratorios Vital Pharma S.A.', 'direccion' => 'Avenida 30 # 8-60, Medellín, Antioquia', 'telefono' => '+57 604 512 7894', 'correo_electronico' => 'contacto@vitalpharma.co'],
            ['nombre_proveedor' => 'Drogas y Medicamentos del Caribe Ltda.', 'direccion' => 'Carrera 22 # 45-18, Barranquilla, Atlántico', 'telefono' => '+57 5 356 1247', 'correo_electronico' => 'ventas@drogascaribe.com'],
            ['nombre_proveedor' => 'BioSalud Distribuciones S.A.S.', 'direccion' => 'Calle 18 # 9-24, Cali, Valle del Cauca', 'telefono' => '+57 602 555 7890', 'correo_electronico' => 'info@biosalud.com.co'],
            ['nombre_proveedor' => 'Medisur Ltda.', 'direccion' => 'Carrera 8 # 15-10, Pasto, Nariño', 'telefono' => '+57 2 721 4568', 'correo_electronico' => 'contacto@medisur.com.co'],
            ['nombre_proveedor' => 'FarmaExpress de Occidente S.A.S.', 'direccion' => 'Avenida Las Américas # 55-20, Bogotá D.C.', 'telefono' => '+57 1 489 6750', 'correo_electronico' => 'pedidos@farmaexpressocc.com'],
            ['nombre_proveedor' => 'Química y Salud S.A.', 'direccion' => 'Calle 40 # 8-11, Ibagué, Tolima', 'telefono' => '+57 608 265 9874', 'correo_electronico' => 'ventas@quimicaysalud.com'],
            ['nombre_proveedor' => 'Droguerías Unidos Ltda.', 'direccion' => 'Carrera 14 # 22-05, Villavicencio, Meta', 'telefono' => '+57 608 672 4580', 'correo_electronico' => 'contacto@drogueriasunidos.com'],
            ['nombre_proveedor' => 'FarmaColombia Distribuciones S.A.S.', 'direccion' => 'Calle 64 # 19-28, Bogotá D.C.', 'telefono' => '+57 1 748 9650', 'correo_electronico' => 'comercial@farmacolombia.com.co'],
            ['nombre_proveedor' => 'Laboratorios El Buen Samaritano Ltda.', 'direccion' => 'Carrera 7 # 12-60, Tunja, Boyacá', 'telefono' => '+57 608 742 1569', 'correo_electronico' => 'ventas@buen-samaritano.com'],
            ['nombre_proveedor' => 'Salud Total Proveeduría S.A.S.', 'direccion' => 'Avenida Boyacá # 60-45, Bogotá D.C.', 'telefono' => '+57 1 654 7890', 'correo_electronico' => 'pedidos@saludtotalprovee.com'],
            ['nombre_proveedor' => 'FarmaPlus Mayoristas S.A.S.', 'direccion' => 'Calle 95 # 14-22, Bogotá D.C.', 'telefono' => '+57 1 789 6543', 'correo_electronico' => 'ventas@farmaplusmayoristas.com'],
            ['nombre_proveedor' => 'Laboratorios Naturales de Colombia S.A.', 'direccion' => 'Carrera 6 # 21-40, Neiva, Huila', 'telefono' => '+57 608 874 5621', 'correo_electronico' => 'info@labnaturalescolombia.com'],
        ];

        // Recorremos la lista y creamos cada proveedor
        foreach ($proveedores as $proveedor) {
            // Usamos updateOrCreate para evitar duplicados si ejecutamos el seeder más de una vez
            Proveedor::updateOrCreate(
                ['nombre_proveedor' => $proveedor['nombre_proveedor']],
                $proveedor
            );
        }
    }
}
