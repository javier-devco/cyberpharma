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
        Schema::create('proveedores', function (Blueprint $table) {
            $table->id('id_proveedor'); // Usamos tu nombre de columna para el ID
            $table->string('nombre_proveedor', 100);
            $table->string('direccion', 60);
            $table->string('telefono', 40);
            $table->string('correo_electronico', 50);
            $table->timestamps(); // Esto añade las columnas created_at y updated_at, una buena práctica de Laravel
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proveedors');
    }
};
