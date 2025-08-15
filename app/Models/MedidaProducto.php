<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MedidaProducto extends Model
{
    use HasFactory;

    // --- Propiedades de Configuración del Modelo ---

    /**
     * La tabla asociada con el modelo.
     */
    protected $table = 'medidas_productos';

    /**
     * La clave primaria para el modelo (soluciona el error 'id' not found).
     */
    protected $primaryKey = 'id_medida';

    /**
     * Indica si el modelo debe tener timestamps (created_at y updated_at).
     */
    public $timestamps = true;

    /**
     * Los atributos que se pueden asignar masivamente.
     * (Se ha combinado la información y eliminado la declaración duplicada).
     */
    protected $fillable = [
        'nombre_unidad',
        'abreviatura',
        'activo',
    ];

    /**
     * Los atributos que deben ser convertidos a tipos nativos.
     * (¡Excelente práctica usar esto para el campo 'activo'!).
     */
    protected $casts = [
        'activo' => 'boolean',
    ];

    // --- Relaciones del Modelo ---

    /**
     * Define la relación donde una Medida puede tener muchos Productos.
     */
    public function productos(): HasMany
    {
        return $this->hasMany(Producto::class, 'id_medida', 'id_medida');
    }
}
