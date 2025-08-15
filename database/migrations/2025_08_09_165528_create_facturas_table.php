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
        Schema::create('facturas', function (Blueprint $table) {
            $table->id('id_factura'); // Tu nombre de columna para el ID

            // --- Clave Foránea ---
            // Conecta con la tabla 'ventas'
            $table->foreignId('id_venta')->constrained(
                table: 'ventas',
                column: 'id_venta'
            );

            // --- Resto de las columnas ---
            $table->dateTime('fecha_emision');
            $table->decimal('total_compra', 10, 2); // En tu SQL se llama así, lo mantenemos.

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facturas');
    }
};
