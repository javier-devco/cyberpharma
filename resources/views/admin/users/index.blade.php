@extends('layouts.admin') {{-- O tu layout principal --}}

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Gestión de Usuarios</h1>
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">Crear Usuario</a>
    </div>

    <div class="card">
        <div class="card-body">
            @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Rol</th>
                        <th>Fecha de Ingreso</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                    <tr>
                        <td>{{ $user->nombre }} {{ $user->apellido }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if($user->roles->isNotEmpty())
                            <span class="badge bg-primary">{{ $user->roles->first()->name }}</span>
                            @else
                            <span class="badge bg-secondary">Sin rol</span>
                            @endif
                        </td>
                        <td>{{ $user->created_at->format('d/m/Y') }}</td>
                        <td>
                            <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-warning">Editar</a>
                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este usuario?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">No se encontraron usuarios.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-3">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</div>
@endsection