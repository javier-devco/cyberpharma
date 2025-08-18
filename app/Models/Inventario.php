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

    // Campos que permitimos llenar automáticamente
    protected $fillable = [
        'id_producto',
        'id_usuario',
        'movimiento',
        'cantidad',
        'fecha_hora',
        'descripcion',
    ];

    // Relación para obtener el nombre del producto
    public function producto(): BelongsTo
    {
        return $this->belongsTo(Producto::class, 'id_producto');
    }

    // Relación para obtener el nombre del usuario
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }
}
