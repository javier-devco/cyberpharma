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

    protected $fillable = [
        'id_usuario',
        'fecha_hora',
        'total_venta',
    ];

    /**
     * Este método se ejecuta automáticamente cuando el modelo se inicializa.
     */
    protected static function boot(): void
    {
        parent::boot();

        // Antes de que se cree un nuevo registro de Venta...
        static::creating(function ($venta) {
            // Verificamos si los datos de los productos vienen del formulario.
            // La propiedad 'ventaProductos' es un atributo temporal que Filament usa
            // al crear el modelo antes de guardar las relaciones.
            if (isset($venta->ventaProductos) && is_array($venta->ventaProductos)) {
                $total = 0;
                // Recorremos los productos y calculamos el total en el servidor.
                foreach ($venta->ventaProductos as $item) {
                    if (isset($item['cantidad'], $item['precio_unitario'])) {
                        $total += $item['cantidad'] * $item['precio_unitario'];
                    }
                }
                // Asignamos el total calculado al modelo, justo antes de guardarlo.
                $venta->total_venta = $total;
            }
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }

    public function ventaProductos(): HasMany
    {
        return $this->hasMany(VentaProducto::class, 'id_venta');
    }
}
