<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    use HasFactory;

    /**
     * El nombre de la tabla asociada con el modelo.
     *
     * @var string
     */
    protected $table = 'estados';

    /**
     * La clave primaria asociada con la tabla.
     *
     * @var string
     */
    protected $primaryKey = 'id_estado';

    /**
     * Los atributos que se pueden asignar masivamente.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nombre_estado',
    ];
}
