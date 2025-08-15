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
        Schema::create('alertas', function (Blueprint $table) {
            $table->id('id_alerta'); // Tu nombre de columna para el ID

            // --- Claves Foráneas ---
            // Conecta con el producto sobre el que se genera la alerta
            $table->foreignId('id_producto')->constrained(
                table: 'productos',
                column: 'id_producto'
            );

            // Conecta con la tabla 'estados' para saber el estado de la alerta
            $table->foreignId('id_estado')->constrained(
                table: 'estados',
                column: 'id_estado'
            );

            // --- Resto de las columnas ---
            $table->string('tipo_alerta', 70);
            $table->string('descripcion_alerta', 130);
            $table->dateTime('fecha_aviso');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alertas');
    }
};
