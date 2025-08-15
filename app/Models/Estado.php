<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nombre_estado',
    ];

    /**
     * Especifica el nombre correcto de la tabla y la clave primaria.
     */
    protected $primaryKey = 'id_estado';
    protected $table = 'estados';
} // <-- ¡AQUÍ ES DONDE DEBE TERMINAR LA CLASE!