<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Producto;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductoPolicy
{
    use HandlesAuthorization;

    /**
     * Determina si el usuario puede ver la lista de productos.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_producto');
    }

    /**
     * Determina si el usuario puede ver un producto específico.
     */
    public function view(User $user, Producto $producto): bool
    {
        return $user->can('view_producto');
    }

    /**
     * Determina si el usuario puede crear productos.
     */
    public function create(User $user): bool
    {
        return $user->can('create_producto');
    }

    /**
     * Determina si el usuario puede editar un producto.
     */
    public function update(User $user, Producto $producto): bool
    {
        return $user->can('update_producto');
    }

    /**
     * Determina si el usuario puede borrar un producto.
     */
    public function delete(User $user, Producto $producto): bool
    {
        return $user->can('delete_producto');
    }

    /**
     * Determina si el usuario puede borrar múltiples productos.
     */
    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_producto');
    }
}
