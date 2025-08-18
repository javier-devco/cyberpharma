<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasManyThrough; // <-- Añadimos este 'use'

class Factura extends Model
{
    use HasFactory;

    protected $table = 'facturas';
    protected $primaryKey = 'id_factura';

    protected $fillable = [
        'id_venta',
        'fecha_emision',
        'total_compra',
    ];

    public function venta(): BelongsTo
    {
        return $this->belongsTo(Venta::class, 'id_venta');
    }

    /**
     * ¡NUEVO! Define la relación para obtener los productos de la venta asociada.
     * Es un "puente": Factura -> Venta -> VentaProducto
     */
    public function ventaProductos(): HasManyThrough
    {
        // Le decimos que queremos muchos VentaProducto A TRAVÉS de Venta.
        // Los IDs se conectan así: facturas.id_venta -> ventas.id_venta -> ventas_productos.id_venta
        return $this->hasManyThrough(
            VentaProducto::class,
            Venta::class,
            'id_venta', // Clave foránea en la tabla ventas (para conectar con facturas)
            'id_venta', // Clave foránea en la tabla ventas_productos (para conectar con ventas)
            'id_venta', // Clave local en la tabla facturas
            'id_venta'  // Clave local en la tabla ventas
        );
    }
}
