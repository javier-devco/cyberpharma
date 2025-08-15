<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id('id_producto'); // Usamos tu nombre de columna para el ID

            // --- Definición de Claves Foráneas ---
            // Conecta con la tabla 'proveedores' usando la columna 'id_proveedor'
            $table->foreignId('id_proveedor')->constrained(
                table: 'proveedores',
                column: 'id_proveedor'
            );

            // Conecta con la tabla 'medidas_productos' usando la columna 'id_medida'
            $table->foreignId('id_medida')->constrained(
                table: 'medidas_productos',
                column: 'id_medida'
            );

            // --- Resto de las columnas ---
            $table->string('descripcion', 300);
            $table->integer('cantidad_stock');
            $table->string('codigo_lote', 50);
            $table->dateTime('fecha_hora');
            $table->decimal('precio_venta', 10, 2);

            $table->timestamps(); // Columnas created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
