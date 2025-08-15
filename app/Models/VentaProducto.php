<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VentaProducto extends Model
{
    use HasFactory;

    // El nombre de tu tabla es 'ventas_productos', es correcto.
    protected $table = 'ventas_productos';
    
    // La clave primaria es correcta.
    protected $primaryKey = 'id_venta_producto';

    // Los campos fillable son correctos.
    protected $fillable = [
        'id_venta',
        'id_producto',
        'precio_unitario',
        'cantidad',
    ];

    /**
     * Un VentaProducto pertenece a un Producto.
     * (Esta relación ya la tenías correcta).
     */
    public function producto(): BelongsTo
    {
        // Asegúrate de que la clave foránea en tu tabla sea 'id_producto'
        // y la clave primaria en la tabla 'productos' sea la que corresponde.
        return $this->belongsTo(Producto::class, 'id_producto', 'id_producto');
    }

    /**
     * --- CORRECCIÓN CRÍTICA ---
     * Un VentaProducto también pertenece a una Venta.
     * Esta es la relación que Filament usará para conectar el Repeater.
     */
    public function venta(): BelongsTo
    {
        // Asume que la clave foránea en esta tabla es 'id_venta'
        // y la clave primaria en la tabla 'ventas' es 'id_venta'.
        return $this->belongsTo(Venta::class, 'id_venta', 'id_venta');
    }
}