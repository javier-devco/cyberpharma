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
        Schema::table('medidas_productos', function (Blueprint $table) {
            // Añadimos la columna para la abreviatura después de 'nombre_unidad'
            $table->string('abreviatura', 15)->nullable()->after('nombre_unidad');

            // Añadimos la columna para saber si la unidad está activa (default: true)
            $table->boolean('activo')->default(true)->after('abreviatura');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('medidas_productos', function (Blueprint $table) {
            //
        });
    }
};
