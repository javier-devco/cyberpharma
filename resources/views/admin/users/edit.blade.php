<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.users.update', $user) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" value="{{ $user->nombre }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="apellido" class="form-label">Apellido</label>
                    <input type="text" name="apellido" id="apellido" class="form-control" value="{{ $user->apellido }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="email" class="form-label">Correo Electrónico</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="role" class="form-label">Rol</label>
                    <select name="role" id="role" class="form-select" required>
                        @foreach($roles as $role)
                        <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                            {{ $role->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="password" class="form-label">Nueva Contraseña (Opcional)</label>
                    <input type="password" name="password" id="password" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="password_confirmation" class="form-label">Confirmar Nueva Contraseña</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar Usuario</button>
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>