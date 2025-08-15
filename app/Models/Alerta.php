<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Alerta extends Model
{
    use HasFactory;

    protected $table = 'alertas';
    protected $primaryKey = 'id_alerta';

    // Campos que se pueden llenar masivamente
    protected $fillable = [
        'id_producto',
        'id_estado',
        'tipo_alerta',
        'descripcion_alerta',
        'fecha_aviso',
    ];

    /**
     * Una Alerta pertenece a un Producto.
     */
    public function producto(): BelongsTo
    {
        return $this->belongsTo(Producto::class, 'id_producto');
    }

    /**
     * Una Alerta tiene un Estado.
     */
    public function estado(): BelongsTo
    {
        return $this->belongsTo(Estado::class, 'id_estado');
    }
}
