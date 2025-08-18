<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('ventas', function (Blueprint $table) {
            // Le decimos a la columna que ahora puede ser nula y la modificamos
            $table->decimal('total_venta', 10, 2)->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('ventas', function (Blueprint $table) {
            // Esto es para poder revertir el cambio si es necesario
            $table->decimal('total_venta', 10, 2)->nullable(false)->change();
        });
    }
};
