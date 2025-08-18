<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedidaProducto extends Model
{
    use HasFactory;

    protected $table = 'medidas_productos';
    protected $primaryKey = 'id_medida';

    /**
     * ¡CÓDIGO CORREGIDO!
     * Añadimos 'abreviatura' y 'activo' para permitir que se guarden
     * desde el formulario.
     */
    protected $fillable = [
        'nombre_unidad',
        'abreviatura',
        'activo',
    ];

    /**
     * Le decimos a Laravel que el campo 'activo' debe ser tratado
     * como un booleano (verdadero/falso).
     */
    protected function casts(): array
    {
        return [
            'activo' => 'boolean',
        ];
    }
}
