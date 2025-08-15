<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Inventario extends Model
{
    use HasFactory;

    protected $table = 'inventario';
    protected $primaryKey = 'id_inventario';

    protected $fillable = [
        'id_producto',
        'id_usuario',
        'movimiento',
        'cantidad',
        'fecha_hora',
        'descripcion',
    ];

    /**
     * --- ¡EL PUENTE #1! ---
     * Define la relación: Un registro de Inventario "pertenece a" un Producto.
     */
    public function producto(): BelongsTo
    {
        // belongsTo(ClaseDelOtroModelo::class, 'mi_clave_foranea', 'la_clave_primaria_del_otro');
        return $this->belongsTo(Producto::class, 'id_producto', 'id_producto');
    }

    /**
     * --- ¡EL PUENTE #2! ---
     * Define la relación: Un registro de Inventario "pertenece a" un Usuario.
     */
    public function user(): BelongsTo
    {
        // La clave primaria de la tabla 'users' se llama 'id', por eso el último parámetro es 'id'.
        return $this->belongsTo(User::class, 'id_usuario', 'id');
    }
}
