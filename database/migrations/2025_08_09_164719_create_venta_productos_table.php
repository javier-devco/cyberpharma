<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('ventas_productos', function (Blueprint $table) {
            $table->id('id_venta_producto');
            // ¡LÍNEA CLAVE! Añadimos el borrado en cascada aquí.
            $table->foreignId('id_venta')
                ->constrained(table: 'ventas', column: 'id_venta')
                ->onDelete('cascade');
            $table->foreignId('id_producto')
                ->constrained(table: 'productos', column: 'id_producto');
            $table->decimal('precio_unitario', 10, 2);
            $table->integer('cantidad');
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('ventas_productos');
    }
};
