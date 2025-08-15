<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pedido extends Model
{
    use HasFactory;

    protected $table = 'pedidos';
    protected $primaryKey = 'id_pedido';

    // Campos que se pueden llenar masivamente
    protected $fillable = [
        'id_proveedor',
        'id_producto',
        'id_estado',
        'fecha_hora',
        'cantidad',
        'precio_unitario',
        'total',
    ];

    /**
     * Un Pedido pertenece a un Proveedor.
     */
    public function proveedor(): BelongsTo
    {
        return $this->belongsTo(Proveedor::class, 'id_proveedor');
    }

    /**
     * Un Pedido pertenece a un Producto.
     */
    public function producto(): BelongsTo
    {
        return $this->belongsTo(Producto::class, 'id_producto');
    }

    /**
     * Un Pedido tiene un Estado.
     */
    public function estado(): BelongsTo
    {
        return $this->belongsTo(Estado::class, 'id_estado');
    }
}
