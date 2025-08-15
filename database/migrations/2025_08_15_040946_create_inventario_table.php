<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inventario', function (Blueprint $table) {
            $table->id('id_inventario');

            $table->foreignId('id_producto')->constrained('productos', 'id_producto');
            $table->foreignId('id_usuario')->constrained('users', 'id');

            $table->enum('movimiento', ['entrada', 'salida', 'ajuste']);
            $table->integer('cantidad');
            $table->dateTime('fecha_hora')->default(now());
            $table->string('descripcion', 200)->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inventario');
    }
};
