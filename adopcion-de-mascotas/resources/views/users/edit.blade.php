<x-layout>
  <div class="container">
    <h1 class="my-4 text-center text-primary">Actualizar usuario</h1>

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

    <!-- Formulario para actualizar usuario -->
    <form method="POST" action="{{ route('users.update', $user->id) }}" class="p-4 mb-5 bg-light rounded shadow-sm">
      @csrf
      @method('PUT')

      <h2 class="mb-4 text-secondary">Editar usuario</h2>

      <div class="row g-3">
        <div class="col-md-6">
          <label for="name" class="form-label">Nombre</label>
          <input name="name" type="text" class="form-control" value="{{ old('name', $user->name) }}" required>
        </div>

        <div class="col-md-6">
          <label for="email" class="form-label">Correo</label>
          <input name="email" type="email" class="form-control" value="{{ old('email', $user->email) }}" required>
        </div>

        <div class="col-md-6">
          <label for="phone" class="form-label">Teléfono</label>
          <input name="phone" type="tel" class="form-control" value="{{ old('phone', $user->phone) }}" required>
        </div>

        <div class="col-md-6">
          <label for="type" class="form-label">Tipo</label>
          <select name="type" class="form-select">
            <option value="partner" {{ old('type', $user->type) === 'partner' ? 'selected' : '' }}>Socio</option>
            <option value="godfather" {{ old('type', $user->type) === 'godfather' ? 'selected' : '' }}>Padrino</option>
            <option value="veterinary" {{ old('type', $user->type) === 'veterinary' ? 'selected' : '' }}>Veterinario</option>
          </select>
        </div>
      </div>

      <div class="mt-4">
        <button type="submit" class="btn btn-success w-100">Actualizar</button>
      </div>
    </form>
  </div>
</x-layout>
