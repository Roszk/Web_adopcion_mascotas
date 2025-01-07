<!-- resources/views/events/edit.blade.php -->

<x-layout>
  <div class="container">
    <h1 class="my-4 text-center text-primary">Editar Evento</h1>

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

    <form method="POST" action="{{ route('events.update', $event->id) }}" class="p-4 mb-5 bg-light rounded shadow-sm">
      @csrf
      @method('PUT')

      <h2 class="mb-4 text-secondary">Editar evento</h2>

      <div class="row g-3">
        <div class="col-md-6">
          <label for="name" class="form-label">Nombre del Evento</label>
          <input name="name" type="text" class="form-control" value="{{ old('name', $event->name) }}" required>
        </div>

        <div class="col-md-6">
          <label for="date" class="form-label">Fecha y Hora</label>
          <input name="date" type="datetime-local" class="form-control" value="{{ old('date', \Carbon\Carbon::parse($event->date)->format('Y-m-d\TH:i')) }}" required>
        </div>

        <div class="col-md-6">
          <label for="user_name" class="form-label">Nombre del Usuario</label>
          <input name="user_name" type="text" class="form-control" value="{{ old('user_name', $event->user_name) }}" required>
        </div>

        <div class="col-md-6">
          <label for="user_phone" class="form-label">Teléfono del Usuario</label>
          <input name="user_phone" type="text" class="form-control" value="{{ old('user_phone', $event->user_phone) }}" required>
        </div>

        <div class="col-12">
          <label for="location" class="form-label">Ubicación</label>
          <input name="location" type="text" class="form-control" value="{{ old('location', $event->location) }}" required>
        </div>

        <div class="col-12">
          <label for="description" class="form-label">Descripción</label>
          <textarea name="description" class="form-control" rows="4" required>{{ old('description', $event->description) }}</textarea>
        </div>
      </div>

      <div class="mt-4">
        <button type="submit" class="btn btn-success w-100">Actualizar Evento</button>
      </div>
    </form>
  </div>
</x-layout>
