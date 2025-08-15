<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Permite a un Super-Admin hacer cualquier cosa.
     */
    public function before(User $user, string $ability): bool|null
    {
        if ($user->hasRole('Super-Admin')) {
            return true;
        }
        return null;
    }

    /**
     * Determina si el usuario puede ver la lista de usuarios.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_user');
    }

    /**
     * Determina si el usuario puede ver un usuario específico.
     */
    public function view(User $user, User $model): bool
    {
        return $user->can('view_user');
    }

    /**
     * Determina si el usuario puede crear usuarios.
     */
    public function create(User $user): bool
    {
        return $user->can('create_user');
    }

    /**
     * Determina si el usuario puede editar un usuario.
     */
    public function update(User $user, User $model): bool
    {
        return $user->can('update_user');
    }

    /**
     * Determina si el usuario puede borrar un usuario.
     */
    public function delete(User $user, User $model): bool
    {
        // Regla de seguridad: Un usuario no puede borrarse a sí mismo.
        if ($user->id === $model->id) {
            return false;
        }

        // El usuario puede borrar a otros si tiene el permiso.
        return $user->can('delete_user');
    }
}
