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
        Schema::create('ventas', function (Blueprint $table) {
            $table->id('id_venta'); // Tu nombre de columna para el ID

            // --- Clave Foránea ---
            // Conecta con el usuario que realiza la venta.
            // Apunta a la columna 'id' de la tabla 'users'.
            $table->foreignId('id_usuario')->constrained(
                table: 'users',
                column: 'id'
            );

            // --- Resto de las columnas ---
            $table->dateTime('fecha_hora');

            // --- ¡LÍNEA MODIFICADA! ---
            // Le añadimos ->nullable() para permitir que se cree la venta sin un total inicial.
            $table->decimal('total_venta', 10, 2)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ventas');
    }
};
