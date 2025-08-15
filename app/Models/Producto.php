<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany; // <-- Importante añadir HasMany

class Producto extends Model
{
    use HasFactory;

    /**
     * La tabla asociada con el modelo.
     *
     * @var string
     */
    protected $table = 'productos';

    /**
     * La clave primaria para el modelo.
     *
     * @var string
     */
    protected $primaryKey = 'id_producto';

    /**
     * Indica si el modelo debe tener timestamps.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * Los atributos que se pueden asignar masivamente.
     *
     * @var array
     */
    protected $fillable = [
        'id_proveedor',
        'id_medida',
        'descripcion',
        'cantidad_stock',
        'codigo_lote',
        'fecha_hora',
        'precio_venta',
    ];

    /**
     * Los atributos que deben ser convertidos a tipos de datos.
     */
    protected $casts = [
        'fecha_hora' => 'datetime',
        'precio_venta' => 'decimal:2',
    ];

    // --- DEFINICIÓN DE RELACIONES ---

    /**
     * Un Producto pertenece a un Proveedor.
     */
    public function proveedor(): BelongsTo
    {
        return $this->belongsTo(Proveedor::class, 'id_proveedor', 'id_proveedor');
    }

    /**
     * Un Producto tiene una Medida.
     */
    public function medidaProducto(): BelongsTo
    {
        return $this->belongsTo(MedidaProducto::class, 'id_medida', 'id_medida');
    }

    /**
     * --- ¡RELACIÓN INVERSA AÑADIDA! ---
     * Un Producto puede tener muchos movimientos de inventario.
     */
    public function movimientosInventario(): HasMany
    {
        return $this->hasMany(Inventario::class, 'id_producto', 'id_producto');
    }
}
