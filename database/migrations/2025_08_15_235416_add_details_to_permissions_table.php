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
        Schema::table('permissions', function (Blueprint $table) {
            // --- CORRECCIÓN AQUÍ ---
            // Añadimos ->nullable() para que este campo no sea obligatorio
            $table->string('group_name')->after('name')->nullable()->comment('Para agrupar permisos en la UI');

            // Esta columna ya estaba correcta con ->nullable()
            $table->string('description')->after('group_name')->nullable()->comment('Descripción legible del permiso');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('permissions', function (Blueprint $table) {
            // Esto permite revertir el cambio si es necesario
            $table->dropColumn(['group_name', 'description']);
        });
    }
};
