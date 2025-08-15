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
        Schema::create('ventas_productos', function (Blueprint $table) {
            $table->id('id_venta_producto'); // Tu nombre de columna para el ID

            // --- Claves Foráneas ---
            // Conecta con la tabla 'ventas'
            $table->foreignId('id_venta')->constrained(
                table: 'ventas',
                column: 'id_venta'
            );

            // Conecta con la tabla 'productos'
            $table->foreignId('id_producto')->constrained(
                table: 'productos',
                column: 'id_producto'
            );

            // --- Columnas de detalle ---
            // Guardamos el precio al momento de la venta, por si cambia en el futuro
            $table->decimal('precio_unitario', 10, 2);
            $table->integer('cantidad');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('venta_productos');
    }
};
