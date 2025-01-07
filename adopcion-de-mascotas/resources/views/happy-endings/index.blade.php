<x-layout>
  <div class="container">
    <h1 class="my-4 text-center text-primary">Finales Felices</h1>

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

    <!-- Mostrar mascotas adoptadas -->
    <h2 class="mt-5">Mascotas Adoptadas</h2>
    <div class="row">
      @foreach ($adopted_pets as $pet)
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
                <a href="{{ route('happy-endings.create', ['petId' => $pet->id]) }}" class="btn btn-outline-primary btn-sm">Registrar final feliz</a>
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>

    <!-- Mostrar lista de Finales Felices -->
    <h2 class="mt-2">Finales Felices</h2>
    <div class="row">
    @foreach ($happyEndings as $happyEnding)
        <div class="col-md-4 col-sm-6 mb-4">
        <div class="card h-100 shadow-lg border-light">
            <div class="card-body">
            <h5 class="card-title text-primary">{{ $happyEnding->pet->name }}</h5>
            <p class="card-text">
                <strong>Historia:</strong> {{ Str::limit($happyEnding->story, 100) }}<br>
                <strong>Ubicación:</strong> {{ $happyEnding->location }}<br>
            </p>

            <!-- Mostrar la primera imagen -->
            @if($happyEnding->images)
                @php
                $images = json_decode($happyEnding->images);
                @endphp
                @if(count($images) > 0)
                <img src="{{ asset('storage/' . $images[0]) }}"
                class="card-img-top" alt="Imagen final feliz" style="height:
                200px; object-fit: cover; object-position: top;">
                @endif
            @endif

            <div class="d-flex justify-content-between mt-3">
                <a href="{{ route('happy-endings.edit', $happyEnding->id) }}" class="btn btn-outline-primary btn-sm">Editar</a>
                <form action="{{ route('happy-endings.destroy', $happyEnding->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este final feliz?');">
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
