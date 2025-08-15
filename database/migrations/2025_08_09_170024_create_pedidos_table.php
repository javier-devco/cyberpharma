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
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id('id_pedido'); // Tu nombre de columna para el ID

            // --- Claves Foráneas ---
            // Conecta con el proveedor al que se le hace el pedido
            $table->foreignId('id_proveedor')->constrained(
                table: 'proveedores',
                column: 'id_proveedor'
            );

            // Conecta con el producto que se está pidiendo
            $table->foreignId('id_producto')->constrained(
                table: 'productos',
                column: 'id_producto'
            );

            // Conecta con la tabla 'estados' para saber el estado del pedido
            $table->foreignId('id_estado')->constrained(
                table: 'estados',
                column: 'id_estado'
            );

            // --- Resto de las columnas ---
            $table->dateTime('fecha_hora');
            $table->integer('cantidad');
            $table->decimal('precio_unitario', 10, 2);
            $table->decimal('total', 10, 2);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
