<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Muestra el listado de usuarios.
     */
    public function index()
    {
        // Obtiene todos los usuarios y los pasa a la vista
        $users = User::with('roles')->paginate(10); // Pagina los resultados
        return view('admin.users.index', compact('users'));
    }

    /**
     * Muestra el formulario para crear un nuevo usuario.
     */
    public function create()
    {
        // Obtiene todos los roles para poder asignarlos en el formulario
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Guarda el nuevo usuario en la base de datos.
     */
    public function store(Request $request)
    {
        // Validación de los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string|exists:roles,name', // Valida que el rol exista
        ]);

        // Creación del usuario
        $user = User::create([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'email' => $request->email,
            'password' => $request->password, // El modelo se encarga de encriptar
            // Puedes añadir otros campos como 'edad', 'fecha_ingreso' aquí
        ]);

        // Asignación del rol
        $user->assignRole($request->role);

        return redirect()->route('admin.users.index')->with('success', 'Usuario creado exitosamente.');
    }

    /**
     * Muestra el formulario para editar un usuario.
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        // Carga el rol actual del usuario para pre-seleccionarlo en el formulario
        $user->load('roles');
        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Actualiza los datos del usuario en la base de datos.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|string|exists:roles,name',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->update([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'email' => $request->email,
        ]);

        // Actualiza la contraseña solo si se proporcionó una nueva
        if ($request->filled('password')) {
            $user->update(['password' => $request->password]);
        }

        // Sincroniza el rol (elimina los antiguos y añade el nuevo)
        $user->syncRoles([$request->role]);

        return redirect()->route('admin.users.index')->with('success', 'Usuario actualizado exitosamente.');
    }

    /**
     * Elimina un usuario de la base de datos.
     */
    public function destroy(User $user)
    {
        // Evitar que el administrador se elimine a sí mismo
        if ($user->id === auth()->id()) {
            return redirect()->route('admin.users.index')->with('error', 'No puedes eliminar tu propia cuenta.');
        }

        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'Usuario eliminado exitosamente.');
    }
}

