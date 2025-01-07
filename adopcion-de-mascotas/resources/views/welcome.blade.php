<x-layout>
  <div class="container">
    <h1 class="text-center my-4 text-primary">Bienvenido al Proyecto de Gestión de Mascotas</h1>
    <p class="lead text-center mb-5">Este proyecto tiene como objetivo facilitar la gestión de mascotas y sus datos asociados, como los usuarios, eventos y finales felices.</p>

    <!-- Grid para organizar las tarjetas en dos filas -->
    <div class="row ">
      <!-- Fila 1: Usuarios y Mascotas -->
      <div class="col-md-6 mb-4">
        <div class="card shadow-sm border-light d-flex flex-column">
          <div class="card-body">
            <h3 class="card-title text-primary">Usuarios</h3>
            <p class="card-text">Gestiona los usuarios del sistema, como socios, padrinos y veterinarios.</p>
            <a href="{{ route('users.index') }}" class="btn btn-primary">Ver Usuarios</a>
          </div>
        </div>
      </div>
      <div class="col-md-6 mb-4">
        <div class="card shadow-sm border-light d-flex flex-column">
          <div class="card-body">
            <h3 class="card-title text-primary">Mascotas</h3>
            <p class="card-text">Administra las mascotas, incluyendo sus fotos, edades, tipos y relaciones con socios, veterinarios y padrinos.</p>
            <a href="{{ route('pets.index') }}" class="btn btn-primary">Ver Mascotas</a>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <!-- Fila 2: Eventos y Finales Felices -->
      <div class="col-md-6 mb-4">
        <div class="card shadow-sm border-light d-flex flex-column">
          <div class="card-body">
            <h3 class="card-title text-primary">Eventos</h3>
            <p class="card-text">Gestiona los eventos relacionados con las mascotas y sus actividades.</p>
            <a href="{{ route('events.index') }}" class="btn btn-primary">Ver Eventos</a>
          </div>
        </div>
      </div>
      <div class="col-md-6 mb-4">
        <div class="card shadow-sm border-light d-flex flex-column">
          <div class="card-body">
            <h3 class="card-title text-primary">Finales Felices</h3>
            <p class="card-text">Registra y visualiza los finales felices de las mascotas adoptadas o rehabilitadas.</p>
            <a href="{{ route('happy-endings.index') }}" class="btn btn-primary">Ver Finales Felices</a>
          </div>
        </div>
      </div>
    </div>

    <h2 class="text-center my-2 text-secondary">Mascota random del día</h2>

    <div class="text-center mb-5">
      <div id="imageContainer" class="mx-auto" style="object-fit: contain; max-height: 400px;"></div>
    </div>
  </div>

  <script>
  // Función para cargar una imagen o video aleatorio de perro al cargar la página
  window.onload = function() {
    const apiUrl = 'https://random.dog/woof.json';

    fetch(apiUrl)
      .then(response => response.json())
      .then(data => {
        const fileUrl = data.url;
        let contentElement;

        // Verificar si el archivo es una imagen o un video
        if (fileUrl.endsWith('.mp4')) {
          contentElement = `<video controls class="img-fluid shadow-sm" style="max-width: 100%; height: auto; border-radius: 8px; max-height: 400px;">
                              <source src="${fileUrl}" type="video/mp4">
                            </video>`;
        } else {
          contentElement = `<img src="${fileUrl}" alt="Random Dog" class="img-fluid shadow-sm" style="max-width: 100%; height: auto; border-radius: 8px; max-height: 400px;">`;
        }

        // Insertar el contenido en el contenedor
        document.getElementById('imageContainer').innerHTML = contentElement;
      })
      .catch(error => console.error('Error al cargar el contenido:', error));
  };
  </script>

</x-layout>
