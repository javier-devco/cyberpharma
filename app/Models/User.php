<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasName;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

// Ya no necesitamos 'BelongsTo' si confiamos 100% en Spatie

class User extends Authenticatable implements FilamentUser, HasName
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nombre',
        'apellido',
        'edad',
        'fecha_ingreso',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed', // ¡Correcto! Esto encripta la contraseña automáticamente.
        ];
    }

    /**
     * Define el nombre que se mostrará en Filament.
     */
    public function getFilamentName(): string
    {
        return "{$this->nombre} {$this->apellido}";
    }

    /**
     * El "guardia de seguridad" para el panel de Filament.
     * Verifica si el usuario tiene el permiso "llave maestra".
     */
    public function canAccessPanel(Panel $panel): bool
    {
        // El método can() es proporcionado por el trait HasRoles de Spatie.
        return $this->can('acceso_panel_admin');
    }

    /**
     * Define la relación con los movimientos de inventario.
     * Reemplaza 'MovimientoInventario' con el nombre real de tu modelo si es diferente.
     */
    public function movimientosInventario(): HasMany
    {
        // El nombre del modelo debe coincidir con el archivo, ej. 'MovimientoInventario'
        // Si no tienes este modelo, puedes comentar o eliminar esta función.
        // return $this->hasMany(MovimientoInventario::class, 'id_usuario', 'id');
    }
}
