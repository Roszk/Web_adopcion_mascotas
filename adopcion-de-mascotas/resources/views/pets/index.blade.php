<x-layout>
  <div class="container">
    <h1 class="my-4 text-center text-primary">Mascotas</h1>

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

    <form method="POST" action="{{ route('pets.store') }}" enctype="multipart/form-data" class="p-4 mb-5 bg-light rounded shadow-sm">
      @csrf

      <h2 class="mb-4 text-secondary">Agregar mascota</h2>

      <div class="row g-3">
        <div class="col-md-6">
          <label for="name" class="form-label">Nombre</label>
          <input name="name" type="text" class="form-control" value="{{ old('name', 'Pepito') }}" required>
        </div>

        <div class="col-md-6">
          <label for="age" class="form-label">Edad (años)</label>
          <input name="age" type="number" class="form-control" value="{{ old('age', '3') }}" required>
        </div>

        <div class="col-md-4">
          <label for="sex" class="form-label">Sexo</label>
          <select name="sex" class="form-select">
            <option value="male" {{ old('sex') === 'male' ? 'selected' : '' }}>Macho</option>
            <option value="female" {{ old('sex') === 'female' ? 'selected' : '' }}>Hembra</option>
          </select>
        </div>

        <div class="col-md-4">
          <label for="type" class="form-label">Tipo</label>
          <select name="type" class="form-select">
            <option value="dog" {{ old('type') === 'dog' ? 'selected' : '' }}>Perro</option>
            <option value="cat" {{ old('type') === 'cat' ? 'selected' : '' }}>Gato</option>
          </select>
        </div>

        <div class="col-md-4">
          <label for="size" class="form-label">Tamaño</label>
          <select name="size" class="form-select">
            <option value="small" {{ old('size') === 'small' ? 'selected' : '' }}>Chico</option>
            <option value="medium" {{ old('size') === 'medium' ? 'selected' : '' }}>Mediano</option>
            <option value="big" {{ old('size') === 'big' ? 'selected' : '' }}>Grande</option>
          </select>
        </div>

        <div class="col-md-6">
          <label for="partner_id" class="form-label">Socio</label>
          <select name="partner_id" class="form-select">
            @foreach ($partners as $partner)
              <option value="{{ $partner->id }}" {{ old('partner_id') == $partner->id ? 'selected' : '' }}>
                {{ $partner->name }}
              </option>
            @endforeach
          </select>
        </div>

        <div class="col-md-6">
          <label for="veterinary_id" class="form-label">Veterinario</label>
          <select name="veterinary_id" class="form-select">
            @foreach ($veterinaries as $veterinary)
              <option value="{{ $veterinary->id }}" {{ old('veterinary_id') == $veterinary->id ? 'selected' : '' }}>
                {{ $veterinary->name }}
              </option>
            @endforeach
          </select>
        </div>

        <div class="col-12">
          <label for="image" class="form-label">Foto</label>
          <input name="image" type="file" class="form-control" accept=".png, .jpg, .jpeg" required>
        </div>
      </div>

      <div class="mt-4">
        <button type="submit" class="btn btn-success w-100">Añadir</button>
      </div>
    </form>

    <!-- Grid responsivo -->
    <div class="row">
      @foreach ($pets as $pet)
        <div class="col-md-4 col-sm-6 mb-4">
          <div class="card h-100 shadow-sm">
            <!-- Imagen -->
            <img src="{{ asset('storage/' . $pet->image) }}" class="card-img-top" alt="{{ $pet->name }}" style="height: 200px; object-fit: cover;">

            <div class="card-body">
              <h5 class="card-title text-primary">{{ $pet->name }}</h5>
              <p class="card-text">
                <strong>Estado:</strong> {{ $pet->getStatus() ?? 'N/A' }}<br>
                <strong>Edad:</strong> {{ $pet->age }} años
              </p>

              <!-- Botones -->
              <div class="d-flex justify-content-between">
                <a href="{{ route('pets.edit', $pet->id) }}" class="btn btn-outline-primary btn-sm">Editar</a>
                <form action="{{ route('pets.destroy', $pet->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta mascota?');">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-outline-danger btn-sm">Eliminar</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</x-layout>
