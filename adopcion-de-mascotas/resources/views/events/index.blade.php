<x-layout>
  <div class="container">
    <h1 class="my-4 text-center text-primary">Eventos</h1>

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

    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div>
    @endif

    <form method="POST" action="{{ route('events.store') }}" class="p-4 mb-5 bg-light rounded shadow-sm">
      @csrf

      <h2 class="mb-4 text-secondary">Agregar evento</h2>

      <div class="row g-3">
        <div class="col-md-6">
          <label for="name" class="form-label">Nombre del Evento</label>
          <input name="name" type="text" class="form-control" value="{{ old('name', '') }}" required>
        </div>

        <div class="col-md-6">
          <label for="date" class="form-label">Fecha y Hora</label>
          <input name="date" type="datetime-local" class="form-control" value="{{ old('date') }}" required>
        </div>

        <div class="col-md-6">
          <label for="user_name" class="form-label">Nombre del Usuario</label>
          <input name="user_name" type="text" class="form-control" value="{{ old('user_name', '') }}" required>
        </div>

        <div class="col-md-6">
          <label for="user_phone" class="form-label">Teléfono del Usuario</label>
          <input name="user_phone" type="text" class="form-control" value="{{ old('user_phone') }}" required>
        </div>

        <div class="col-12">
          <label for="location" class="form-label">Ubicación</label>
          <input name="location" type="text" class="form-control" value="{{ old('location', 'México') }}" required>
        </div>

        <div class="col-12">
          <label for="description" class="form-label">Descripción</label>
          <textarea name="description" class="form-control" rows="4" required>{{ old('description') }}</textarea>
        </div>
      </div>

      <div class="mt-4">
        <button type="submit" class="btn btn-success w-100">Añadir Evento</button>
      </div>
    </form>

    <!-- Grid responsivo -->
    <div class="row">
      @foreach ($events as $event)
        <div class="col-md-4 col-sm-6 mb-4">
          <div class="card h-100 shadow-sm">
            <div class="card-body">
              <h5 class="card-title text-primary">{{ $event->name }}</h5>
              <p class="card-text">
                <strong>Fecha:</strong> {{  $event->date }}<br>
                <strong>Ubicación:</strong> {{ $event->location }}<br>
                <strong>Usuario:</strong> {{ $event->user_name }}<br>
                <strong>Teléfono:</strong> {{ $event->user_phone }}<br>
                <strong>Descripción:</strong> {{ $event->description }}<br>
              </p>

              <!-- Botones -->
              <div class="d-flex justify-content-between">
                <a href="{{ route('events.edit', $event->id) }}" class="btn btn-outline-primary btn-sm">Editar</a>
                <form action="{{ route('events.destroy', $event->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este evento?');">
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
