<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasName;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany; // <-- Importante añadir HasMany
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements FilamentUser, HasName
{
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'nombre',
        'apellido',
        'edad',
        'fecha_ingreso',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed', // <-- La encriptación automática
        ];
    }

    public function getFilamentName(): string
    {
        return "{$this->nombre} {$this->apellido}";
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->can('access_panel');
    }

    /**
     * --- ¡RELACIÓN INVERSA AÑADIDA! ---
     * Un Usuario puede tener muchos movimientos de inventario.
     */
    public function movimientosInventario(): HasMany
    {
        return $this->hasMany(Inventario::class, 'id_usuario', 'id');
    }
}
