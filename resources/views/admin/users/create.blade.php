@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4">Crear Nuevo Usuario</h1>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="apellido" class="form-label">Apellido</label>
                        <input type="text" name="apellido" id="apellido" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">Correo Electrónico</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="role" class="form-label">Rol</label>
                        <select name="role" id="role" class="form-select" required>
                            <option value="">Seleccione un rol</option>
                            @foreach($roles as $role)
                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Guardar Usuario</button>
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
</div>
@endsection