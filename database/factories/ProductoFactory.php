<?php

namespace Database\Factories;

use App\Models\MedidaProducto;
use App\Models\Proveedor;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductoFactory extends Factory
{
    public function definition(): array
    {
        return [
            // Asigna un proveedor y una medida existentes de forma aleatoria
            'id_proveedor' => Proveedor::inRandomOrder()->first()->id_proveedor,
            'id_medida' => MedidaProducto::inRandomOrder()->first()->id_medida,
            
            // Datos falsos generados por Faker
            'descripcion' => fake()->text(50),
            'cantidad_stock' => fake()->numberBetween(20, 200), // Stock normal por defecto
            'codigo_lote' => fake()->bothify('LOTE-####??'),
            'fecha_hora' => fake()->dateTimeBetween('+3 months', '+2 years'), // Vencimiento lejano por defecto
            'precio_venta' => fake()->numberBetween(5000, 100000), // Precios para COP
        ];
    }
}```

### **Paso 3: Crear el Seeder Principal (`DatabaseSeeder.php`)**

Ahora, vamos a crear el "guion" que llenará la base de datos. Este guion creará catálogos, productos normales, productos especiales para las alertas y ventas recientes para el gráfico.

Abre el archivo `database/seeders/DatabaseSeeder.php` y **reemplaza todo su contenido** con este código:

```php
<?php

namespace Database\Seeders;

use App\Models\Compra;
use App\Models\Estado;
use App\Models\MedidaProducto;
use App\Models\Producto;
use App\Models\Proveedor;
use App\Models\User;
use App\Models\Venta;
use App\Models\VentaProducto;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. CREAR ROLES BÁSICOS
        $adminRole = Role::create(['name' => 'Administrador']);

        // 2. CREAR USUARIO ADMINISTRADOR
        User::factory()->create([
            'nombre' => 'Michelle',
            'apellido' => 'Quiroz',
            'edad' => '30',
            'fecha_ingreso' => now(),
            'email' => 'admin@cyberpharma.co',
            'password' => Hash::make('Admin#2025'),
        ])->assignRole($adminRole);

        // 3. CREAR CATÁLOGOS BÁSICOS
        Estado::factory()->createMany([['nombre_estado' => 'Pendiente'], ['nombre_estado' => 'Recibido'], ['nombre_estado' => 'Cancelado']]);
        MedidaProducto::factory()->createMany([['nombre_unidad' => 'Caja'], ['nombre_unidad' => 'Blíster'], ['nombre_unidad' => 'Frasco']]);
        
        // 4. CREAR PROVEEDORES
        Proveedor::factory(10)->create();

        // 5. CREAR PRODUCTOS (NORMALES Y ESPECIALES)
        // Crea 50 productos con stock y vencimiento normales
        Producto::factory(50)->create();
        
        // ¡LA MAGIA! Crea 3 productos con BAJO STOCK
        Producto::factory(3)->create([
            'cantidad_stock' => fake()->numberBetween(1, 10),
        ]);

        // ¡LA MAGIA! Crea 2 productos PRÓXIMOS A VENCER
        Producto::factory(2)->create([
            'fecha_hora' => fake()->dateTimeBetween('now', '+29 days'),
        ]);

        // 6. CREAR VENTAS RECIENTES PARA EL GRÁFICO
        // Recuerda que nuestro VentaObserver se encargará de bajar el stock automáticamente
        Venta::factory(25)->create()->each(function (Venta $venta) {
            // A cada venta le añadimos entre 1 y 3 productos
            $items = Producto::inRandomOrder()->limit(rand(1, 3))->get();
            $totalVenta = 0;

            foreach ($items as $producto) {
                $cantidad = rand(1, 5);
                $precio = $producto->precio_venta;
                $subtotal = $cantidad * $precio;

                VentaProducto::factory()->create([
                    'id_venta' => $venta->id_venta,
                    'id_producto' => $producto->id_producto,
                    'cantidad' => $cantidad,
                    'precio_unitario' => $precio,
                ]);
                $totalVenta += $subtotal;
            }

            // Actualizamos el total de la venta
            $venta->total_venta = $totalVenta;
            $venta->save();
        });
    }
}