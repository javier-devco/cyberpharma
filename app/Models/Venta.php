<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Venta extends Model
{
    use HasFactory;

    protected $table = 'ventas';
    protected $primaryKey = 'id_venta';

    // Campos que se pueden llenar masivamente
    protected $fillable = [
        'id_usuario',
        'fecha_hora',
        'total_venta',
    ];

    /**
     * Una Venta pertenece a un Usuario (el vendedor).
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }

    /**
     * Una Venta tiene muchos VentaProductos (el detalle).
     */
    public function ventaProductos(): HasMany
    {
        return $this->hasMany(VentaProducto::class, 'id_venta');
    }
}

