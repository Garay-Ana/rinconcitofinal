<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Rinconcito - Cocinas Ocultas</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --black: black;
            --white: white;
            --muyred: #e30a33;
            --rojomuy: #a11c2f;
            --cafemuy: #481d1d;
            --amarillomuy: #fad14a;
            --beigemuy: #f4eedb;
            --verdemuy: #4d7c0f;
        }

        body {
            background-color: var(--beigemuy);
            font-family: 'DM Sans', sans-serif;
            color: var(--cafemuy);
        }

        .navbar {
            background-color: var(--beigemuy);
        }

        .navbar-brand span {
            color: var(--white);
        }

        .navbar .btn {
            border: none;
            color: var(--white);
        }

        .btn-usuario {
            background-color: var(--muyred);
        }

        .btn-chef {
            background-color: var(--amarillomuy);
            color: var(--cafemuy);
        }

        .btn-repartidor {
            background-color: var(--cafemuy);
        }

        h2 {
            color: var(--rojomuy);
        }

        .carousel-caption {
            background-color: rgba(0, 0, 0, 0.6);
            border-radius: 12px;
        }

        .card-title {
            color: var(--rojomuy);
        }

        .btn-primary {
            background-color: var(--muyred);
            border: none;
        }

        .btn-primary:hover {
            background-color: #c20b2e;
        }

        footer {
            background-color: var(--white);
            border-top: 3px solid var(--amarillomuy);
        }

        .footer-icon {
            color: var(--rojomuy);
        }
        .logo-hover:hover {
    transform: scale(1.1);
}
.card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card:hover {
    transform: scale(1.05);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
    z-index: 10; /* Para que la card se vea sobre las demás */
    cursor: pointer;
}
.section-saludable {
    background-color:rgb(68, 3, 27); /* Verde muy claro */
    border: 2px dashed var(--amarillomuy);
    margin-top: 2rem;
    border-radius: 16px;
}

.card-saludable {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card-saludable:hover {
    transform: scale(1.05);
    box-shadow: 0 8px 20px rgba(0, 128, 0, 0.2);
    z-index: 10;
}
.ofertas-especiales {
    background-color:rgb(239, 224, 188); /* Color diferente para la sección, por ejemplo un amarillo claro */
    border-top: 4px solid var(--rojomuy);
    border-bottom: 4px solid var(--rojomuy);
}
.precio {
    color: var(--verdemuy); /* Puedes usar otra como --rojomuy o un valor personalizado como #e30a33 */
    font-size: 1.1rem; /* Opcional: agranda el texto */
}


    </style>
</head>
<body>
   <nav class="navbar navbar-expand-lg shadow-sm px-4 py-3">
    <div class="container-fluid d-flex align-items-center justify-content-between">
        <a class="navbar-brand d-flex align-items-center" href="/">
            <img src="{{ asset('images/logo.png') }}" 
                alt="Rinconcito Logo" 
                title="Rinconcito - Sabor que llega hasta tu puerta"
                class="me-2 logo-hover"
                style="height: 100px; transition: transform 0.3s ease;">
            <span class="fs-4 fw-bold"></span>
        </a>

        <!-- Formulario de filtro al lado derecho -->
        <form method="GET" action="{{ url('/') }}" class="d-flex gap-2 align-items-center">
            <div class="input-group input-group-sm" style="max-width: 140px;">
                <span class="input-group-text" id="min-price-label">Precio Mín</span>
                <input type="number" step="0.01" class="form-control form-control-sm" id="min_price" name="min_price" value="{{ old('min_price', $minPrice) }}" aria-label="Precio mínimo" aria-describedby="min-price-label">
            </div>
            <div class="input-group input-group-sm" style="max-width: 140px;">
                <span class="input-group-text" id="max-price-label">Precio Máx</span>
                <input type="number" step="0.01" class="form-control form-control-sm" id="max_price" name="max_price" value="{{ old('max_price', $maxPrice) }}" aria-label="Precio máximo" aria-describedby="max-price-label">
            </div>
           
            
            <button type="submit" class="btn btn-primary btn-sm">Buscar</button>
        </form>

        <!-- Botones de roles a la derecha, en pantallas grandes -->
        <div class="d-none d-lg-flex ms-3 gap-3">
            <a class="btn btn-usuario px-3 py-2 rounded fw-bold fs-6" href="{{ route('register', ['rol' => 'cliente']) }}">Usuario</a>
            <a class="btn btn-chef px-3 py-2 rounded fw-bold fs-6" href="{{ route('register', ['rol' => 'chef']) }}">Chef</a>
            <a class="btn btn-repartidor px-3 py-2 rounded fw-bold fs-6" href="/acceso/repartidor">Repartidor</a>
            <a class="btn btn-admin px-3 py-2 rounded fw-bold fs-6" href="{{ route('admin.dashboard') }}">Administrador</a>
        </div>
    </div>
</nav>

   <section class="ofertas-especiales py-5">
    <div class="container">
        @if($platosEnOferta->count() > 0)
        <h2 class="text-center mb-4 fw-semibold">Ofertas Especiales</h2>
        <div id="carouselOfertas" class="carousel slide mb-5" data-bs-ride="carousel">
            <div class="carousel-inner rounded shadow" style="height: 400px;">
                @foreach($platosEnOferta as $index => $plato)
                    <div class="carousel-item @if($index == 0) active @endif h-100">
                        <img src="{{ asset($plato->imagen) }}" class="d-block w-100 h-100 object-fit-cover" alt="{{ $plato->nombre }}">
                        <div class="carousel-caption bg-dark bg-opacity-50 rounded p-3">
                            <h5 class="text-white fw-bold">{{ $plato->nombre }}</h5>
                            <p class="text-light">{{ $plato->descripcion }}</p>
                            <p class="text-warning fw-bold">
                                Oferta: {{ $plato->descuento_porcentaje }}% de descuento
                            </p>
                            <p class="text-decoration-line-through" style="color: #e5e7eb;">
                                Precio original: <span style="color: #f87171;">${{ number_format($plato->precio, 2) }}</span>
                            </p>
                            <p class="fw-bold" style="color: #22c55e;">
                                Precio con descuento: ${{ number_format($plato->precioConDescuento(), 2) }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselOfertas" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Anterior</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselOfertas" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Siguiente</span>
            </button>
        </div>
        @endif
    </div>
</section>

</div>


    <div class="container mt-5">
        @if($platos->count() > 0)
            <h2 class="mb-4 text-center">Platos Destacados</h2>
            <div id="carouselPlatos" class="carousel slide mb-5" data-bs-ride="carousel">
                <div class="carousel-inner rounded shadow" style="height: 400px;">
                    @foreach($platos->take(3) as $index => $plato)
                        <div class="carousel-item @if($index == 0) active @endif h-100">
                            <img src="{{ asset($plato->imagen) }}" class="d-block w-100 h-100 object-fit-cover" alt="{{ $plato->nombre }}">
                            <div class="carousel-caption p-3">
                                <h5 class="text-white fw-bold">{{ $plato->nombre }}</h5>
                                <p class="text-light">{{ $plato->descripcion }}</p>
                                <p class="text-light fw-bold">Precio: ${{ number_format($plato->precio, 2) }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselPlatos" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Anterior</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselPlatos" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Siguiente</span>
                </button>
            </div>
            <h2 class="mb-4 text-center">Menú</h2>
            <div class="row">
                @foreach($platos as $plato)
                    <div class="col-md-4 mb-4">
                        <div class="card shadow-sm h-100">
                            <img src="{{ asset($plato->imagen) }}" class="card-img-top" style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title">{{ $plato->nombre }}</h5>
                                <p class="card-text">{{ $plato->descripcion }}</p>
                                <p class="card-text precio fw-bold">Precio: ${{ number_format($plato->precio, 2) }}</p>
                                @if(!empty($plato->ingredientes))
                                    <div class="mb-2">
                                        <strong>Ingredientes:</strong>
                                        <ul class="list-unstyled ms-3 mt-1">
                                            @foreach(explode(',', $plato->ingredientes) as $ingrediente)
                                                <li><i class="bi bi-dot"></i> {{ trim($ingrediente) }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                @if(isset($plato->cantidad))
                                    <p class="card-text"><strong>Cantidad disponible:</strong> 
                                        @if($plato->cantidad > 0)
                                            {{ $plato->cantidad }}
                                        @else
                                            Agotado
                                        @endif
                                    </p>
                                @endif
                                <a href="{{ route('login') }}" class="btn btn-primary w-100">Ver más</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
<!-- Agrega este bloque al final de la vista welcome.blade.php, justo antes del footer -->

<div class="container mt-5">
    <h2 class="text-center mb-4 fw-semibold">Reseñas de Clientes</h2>

    @auth
    <form method="POST" action="{{ route('guardarResena') }}" class="mb-4">
        @csrf
        <div class="mb-3">
            <label for="plato_id" class="form-label">Selecciona un platillo</label>
            <select class="form-select" id="plato_id" name="plato_id" required>
                <option value="" disabled selected>Elige un platillo</option>
                @foreach($platos as $plato)
                    <option value="{{ $plato->id }}">{{ $plato->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Calificación</label>
            <select class="form-select" name="calificacion" required>
                <option value="" disabled selected>Elige una calificación</option>
                @for ($i = 1; $i <= 5; $i++)
                    <option value="{{ $i }}">{{ $i }} estrella{{ $i > 1 ? 's' : '' }}</option>
                @endfor
            </select>
        </div>
        <div class="mb-3">
            <label for="comentario" class="form-label">Comentario (opcional)</label>
            <textarea class="form-control" id="comentario" name="comentario" rows="3" maxlength="1000"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Enviar Reseña</button>
    </form>
    @else
    <p class="text-center">Por favor <a href="{{ route('login') }}">inicia sesión</a> para calificar y reseñar.</p>
    @endauth

@foreach($reseñas as $resena)
    <div class="reseña">
        <div class="usuario">{{ $resena->user->name ?? 'Usuario' }}</div>
        <div class="calificacion">
            @for ($i = 0; $i < $resena->calificacion; $i++)
                <i class="bi bi-star-fill"></i>
            @endfor
            @for ($i = $resena->calificacion; $i < 5; $i++)
                <i class="bi bi-star"></i>
            @endfor
        </div>
        <div class="comentario">{{ $resena->comentario }}</div>
        <div class="plato text-muted mt-1">Platillo: {{ $resena->plato->nombre ?? 'Desconocido' }}</div>
    </div>
@endforeach
</div>

<style>
.reseña {
    border: 1px solid #a11c2f;
    border-radius: 8px;
    padding: 1rem;
    margin-bottom: 1rem;
    background-color: #f4eedb;
}

.reseña .usuario {
    font-weight: bold;
    color: #a11c2f;
}

.reseña .calificacion {
    color: #fad14a;
}

.reseña .comentario {
    margin-top: 0.5rem;
}
</style>


<footer class="mt-5 pt-5 pb-4">
    <div class="container text-center">
        <h4 class="mb-4">Contáctanos</h4>
        <div class="row justify-content-center mb-3 text-start">
            <div class="col-md-3 mb-3">
                <a href="https://wa.me/573001112233" target="_blank" class="text-decoration-none text-dark d-flex align-items-center gap-2 justify-content-center">
                    <i class="bi bi-whatsapp fs-4 text-success"></i>
                    <span>+57 310 3718829</span>
                </a>
            </div>
            <div class="col-md-3 mb-3">
                <a href="mailto:soporte@rinconcito.com" class="text-decoration-none text-dark d-flex align-items-center gap-2 justify-content-center">
                    <i class="bi bi-envelope-fill fs-4 text-danger"></i>
                    <span>soporte@rinconcito.com</span>
                </a>
            </div>
            <div class="col-md-3 mb-3">
                <a href="https://instagram.com/rinconcitoapp" target="_blank" class="text-decoration-none text-dark d-flex align-items-center gap-2 justify-content-center">
                    <i class="bi bi-instagram fs-4 text-warning"></i>
                    <span>@rinconcitoapp</span>
                </a>
            </div>
        </div>
        <p class="text-muted mt-3 mb-0">&copy; {{ date('Y') }} Rinconcito. Todos los derechos reservados.</p>
    </div>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
