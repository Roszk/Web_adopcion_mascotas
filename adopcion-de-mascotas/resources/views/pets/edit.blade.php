<x-layout>
  <div class="container">
    <h1 class="my-4 text-center text-primary">Actualizar mascota</h1>

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

    <!-- Formulario para actualizar mascota -->
    <form method="POST" action="{{ route('pets.update', $pet->id) }}" enctype="multipart/form-data" class="p-4 mb-5 bg-light rounded shadow-sm">
      @csrf
      @method('PUT')

      <h2 class="mb-4 text-secondary text-center">{{ $pet->name }}</h2>

      <!-- Imagen de la mascota -->
      <div class="text-center mb-4">
        <img src="{{ asset('storage/' . $pet->image) }}" class="img-fluid rounded" alt="{{ $pet->name }}" style="height: 400px; object-fit: cover; object-position: top;">
        <div class="mt-3">
          <label for="image" class="form-label">Foto</label>
          <input name="image" type="file" accept=".png, .jpg, .jpeg" class="form-control" value="{{ $pet->image }}">
        </div>
      </div>

      <!-- Nombre de la mascota -->
      <div class="mb-3">
        <label for="name" class="form-label">Nombre</label>
        <input name="name" type="text" class="form-control" value="{{ old('name', $pet->name) }}" required>
      </div>

      <!-- Edad -->
      <div class="mb-3">
        <label for="age" class="form-label">Edad (años)</label>
        <input name="age" type="number" class="form-control" value="{{ old('age', $pet->age) }}" required>
      </div>

      <!-- Sexo -->
      <div class="mb-3">
        <label for="sex" class="form-label">Sexo</label>
        <select name="sex" class="form-select">
          <option value="male" {{ old('sex', $pet->sex) === 'male' ? 'selected' : '' }}>Macho</option>
          <option value="female" {{ old('sex', $pet->sex) === 'female' ? 'selected' : '' }}>Hembra</option>
        </select>
      </div>

      <!-- Tipo de mascota -->
      <div class="mb-3">
        <label for="type" class="form-label">Tipo</label>
        <select name="type" class="form-select">
          <option value="dog" {{ old('type', $pet->type) === 'dog' ? 'selected' : '' }}>Perro</option>
          <option value="cat" {{ old('type', $pet->type) === 'cat' ? 'selected' : '' }}>Gato</option>
        </select>
      </div>

      <!-- Tamaño -->
      <div class="mb-3">
        <label for="size" class="form-label">Tamaño</label>
        <select name="size" class="form-select">
          <option value="small" {{ old('size', $pet->size) === 'small' ? 'selected' : '' }}>Chico</option>
          <option value="medium" {{ old('size', $pet->size) === 'medium' ? 'selected' : '' }}>Mediano</option>
          <option value="big" {{ old('size', $pet->size) === 'big' ? 'selected' : '' }}>Grande</option>
        </select>
      </div>

      <!-- Socio -->
      <div class="mb-3">
        <label for="partner_id" class="form-label">Socio</label>
        <select name="partner_id" class="form-select">
          @foreach ($partners as $partner)
            <option value="{{ $partner->id }}" {{ $partner->id === $pet->partner_id ? 'selected' : '' }}>
              {{ $partner->name }}
            </option>
          @endforeach
        </select>
      </div>

      <!-- Veterinario -->
      <div class="mb-3">
        <label for="veterinary_id" class="form-label">Veterinario</label>
        <select name="veterinary_id" class="form-select">
          @foreach ($veterinaries as $veterinary)
            <option value="{{ $veterinary->id }}" {{ $veterinary->id === $pet->veterinary_id ? 'selected' : '' }}>
              {{ $veterinary->name }}
            </option>
          @endforeach
        </select>
      </div>

      <!-- Padrino -->
      <div class="mb-3">
        <label for="godfather_id" class="form-label">Padrino ({{$pet->getStatus()}})</label>
        <select name="godfather_id" class="form-select">
          <option value="" {{ !$pet->godfather_id ? 'selected' : '' }}>Ninguno seleccionado</option>
          @foreach ($godfathers as $godfather)
            <option value="{{ $godfather->id }}" {{ $godfather->id === $pet->godfather_id ? 'selected' : '' }}>
              {{ $godfather->name }}
            </option>
          @endforeach
        </select>
      </div>

      <!-- Botón de actualizar -->
      <div class="mt-4">
        <button type="submit" class="btn btn-success w-100">Actualizar</button>
      </div>
    </form>
  </div>
</x-layout>
