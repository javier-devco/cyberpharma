<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Factura extends Model
{
    use HasFactory;

    // --- Propiedades de Configuración del Modelo ---

    /**
     * La tabla asociada con el modelo.
     */
    protected $table = 'facturas';

    /**
     * La clave primaria para el modelo.
     */
    protected $primaryKey = 'id_factura';

    /**
     * Indica si el modelo debe tener timestamps.
     */
    public $timestamps = true;

    /**
     * Los atributos que se pueden asignar masivamente.
     */
    protected $fillable = [
        'id_venta',
        'fecha_emision',
        'total_compra',
    ];

    // --- Relaciones del Modelo ---

    /**
     * Una Factura pertenece a una Venta.
     */
    public function venta(): BelongsTo
    {
        return $this->belongsTo(Venta::class, 'id_venta', 'id_venta');
    }
}
