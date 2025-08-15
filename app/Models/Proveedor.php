<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Proveedor extends Model
{
    use HasFactory;

    // --- Propiedades de Configuración del Modelo ---

    /**
     * La tabla asociada con el modelo.
     */
    protected $table = 'proveedores';

    /**
     * La clave primaria para el modelo (soluciona el error 'id' not found).
     */
    protected $primaryKey = 'id_proveedor';

    /**
     * Indica si el modelo debe tener timestamps (created_at y updated_at).
     */
    public $timestamps = true;

    /**
     * Los atributos que se pueden asignar masivamente.
     */
    protected $fillable = [
        'nombre_proveedor',
        'direccion',
        'telefono',
        'correo_electronico',
    ];

    // --- Relaciones del Modelo ---

    /**
     * Un Proveedor puede tener muchos Productos.
     */
    public function productos(): HasMany
    {
        return $this->hasMany(Producto::class, 'id_proveedor', 'id_proveedor');
    }
}
