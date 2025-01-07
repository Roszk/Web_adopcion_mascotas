<x-layout>
  <div class="container">
    <h1 class="my-4 text-center text-primary">Registrar Final Feliz para {{ $pet->name }}</h1>

    <form action="{{ route('happy-endings.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <input type="hidden" name="pet_id" value="{{ $pet->id }}">

      <div class="form-group">
        <label for="story">Historia</label>
        <textarea name="story" class="form-control" rows="3" required></textarea>
      </div>

      <div class="form-group">
        <label for="location">Ubicación</label>
        <input type="text" name="location" class="form-control" required>
      </div>

      <div class="form-group">
        <label for="images">Imágenes</label>
        <input type="file" name="images[]" class="form-control" multiple required>
      </div>

      <button type="submit" class="btn btn-primary mt-3">Registrar Final Feliz</button>
    </form>
  </div>
</x-layout>
