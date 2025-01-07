<x-layout>
  <div class="container">
    <h1 class="my-4 text-center text-primary">Editar Final Feliz</h1>

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

    <!-- Formulario para editar el final feliz -->
    <form action="{{ route('happy-endings.update', $happyEnding->id) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      <div class="mb-3">
        <label for="pet_id" class="form-label">Seleccionar Mascota</label>
        <select name="pet_id" id="pet_id" class="form-select" required>
          <option value="">Selecciona una mascota</option>
          @foreach ($pets as $pet)
            <option value="{{ $pet->id }}" {{ $pet->id == $happyEnding->pet_id ? 'selected' : '' }}>
              {{ $pet->name }}
            </option>
          @endforeach
        </select>
        @error('pet_id')
          <div class="text-danger">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="story" class="form-label">Historia</label>
        <textarea name="story" id="story" class="form-control" rows="4" required>{{ old('story', $happyEnding->story) }}</textarea>
        @error('story')
          <div class="text-danger">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="location" class="form-label">Ubicación</label>
        <input type="text" name="location" id="location" class="form-control" value="{{ old('location', $happyEnding->location) }}" required>
        @error('location')
          <div class="text-danger">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="images" class="form-label">Imágenes</label>
        <input type="file" name="images[]" id="images" class="form-control" multiple>
        <small class="form-text text-muted">Puedes subir múltiples imágenes (máx. 2MB por imagen).</small>
        @error('images')
          <div class="text-danger">{{ $message }}</div>
        @enderror

        <!-- Mostrar imágenes actuales si las hay -->
        @if($happyEnding->images)
          @php
            $images = json_decode($happyEnding->images);
          @endphp
          <div class="mt-2">
            <h6>Imágenes actuales:</h6>
            @foreach ($images as $image)
              <img src="{{ asset('storage/' . $image) }}" alt="Imagen actual"
              class="img-thumbnail" style="width: 100px; height: 100px;
              object-fit: cover; object-position: top; aspect-ratio: 1;">
            @endforeach
          </div>
        @endif
      </div>

      <button type="submit" class="btn btn-primary">Guardar Cambios</button>
    </form>
  </div>
</x-layout>
