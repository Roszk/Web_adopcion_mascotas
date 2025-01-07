<x-layout>
  <div class="container">
    <h1 class="my-4 text-center text-primary">Usuarios</h1>

    <!-- Mostrar mensajes de éxito o error -->
    @if (session('success'))
      <div class="alert alert-success" role="alert">
        {{ session('success') }}
      </div>
    @endif

    @if (session('error'))
      <div class="alert alert-danger" role="alert">
        {{ session('error') }}
      </div>
    @endif

    <!-- Formulario para agregar un nuevo usuario -->
    <form method="POST" action="{{ route('users.store') }}" class="p-4 mb-5 bg-light rounded shadow-sm">
      @csrf

      <h2 class="mb-4 text-secondary">Agregar usuario</h2>

      <div class="row g-3">
        <div class="col-md-6">
          <label for="name" class="form-label">Nombre</label>
          <input name="name" type="text" class="form-control" value="{{ old('name', 'Germán González') }}" required>
        </div>

        <div class="col-md-6">
          <label for="email" class="form-label">Correo</label>
          <input name="email" type="email" class="form-control" value="{{ old('email', 'german@gmail.com') }}" required>
        </div>

        <div class="col-md-6">
          <label for="phone" class="form-label">Teléfono</label>
          <input name="phone" type="tel" class="form-control" value="{{ old('phone', '123456789') }}" required>
        </div>

        <div class="col-md-6">
          <label for="type" class="form-label">Tipo</label>
          <select name="type" class="form-select">
            <option value="partner" {{ old('type') === 'partner' ? 'selected' : '' }}>Socio</option>
            <option value="godfather" {{ old('type') === 'godfather' ? 'selected' : '' }}>Padrino</option>
            <option value="veterinary" {{ old('type') === 'veterinary' ? 'selected' : '' }}>Veterinario</option>
          </select>
        </div>
      </div>

      <div class="mt-4">
        <button type="submit" class="btn btn-success w-100">Añadir</button>
      </div>
    </form>

    <!-- Tabla de usuarios -->
    <h2 class="mb-4 text-secondary">Lista de usuarios</h2>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Correo</th>
          <th>Teléfono</th>
          <th>Tipo</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($users as $user)
          <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->phone }}</td>
            <td>{{ $user->type }}</td>
            <td>
              <a href="{{ route('users.edit', $user->id) }}" class="btn btn-outline-primary btn-sm">Editar</a>
              <form method="POST" action="{{ route('users.destroy', $user->id) }}" style="display:inline;" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este usuario?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger btn-sm">Eliminar</button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</x-layout>
