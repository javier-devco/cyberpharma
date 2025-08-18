<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('facturas', function (Blueprint $table) {
            $table->id('id_factura');
            // ¡LÍNEA CLAVE! Añadimos el borrado en cascada aquí.
            $table->foreignId('id_venta')
                ->constrained(table: 'ventas', column: 'id_venta')
                ->onDelete('cascade');
            $table->dateTime('fecha_emision');
            $table->decimal('total_compra', 10, 2);
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('facturas');
    }
};
