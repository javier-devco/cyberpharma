<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Compra extends Model
{
    use HasFactory;

    protected $table = 'compras';
    protected $primaryKey = 'id_compra';

    protected $fillable = [
        'id_producto',
        'id_proveedor',
        'fecha_hora',
        'cantidad',
        'precio_unitario',
        'total',
    ];

    /**
     * Una Compra pertenece a un Producto.
     */
    public function producto(): BelongsTo
    {
        // --- CÓDIGO MEJORADO ---
        // Se especifica la clave primaria de la tabla 'productos' ('id_producto').
        // Esto evita que Laravel asuma que la clave es 'id' por defecto.
        return $this->belongsTo(Producto::class, 'id_producto', 'id_producto');
    }

    /**
     * Una Compra pertenece a un Proveedor.
     */
    public function proveedor(): BelongsTo
    {
        // --- CÓDIGO MEJORADO ---
        // Se especifica la clave primaria de la tabla 'proveedores' ('id_proveedor').
        return $this->belongsTo(Proveedor::class, 'id_proveedor', 'id_proveedor');
    }
}
