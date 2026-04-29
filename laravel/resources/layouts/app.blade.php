<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Viajes Pa Pobres')</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap">
    <link rel="stylesheet" href="{{ asset('css/web_guides.css') }}">
</head>
<body>

<nav class="main-nav navbar navbar-expand-lg navbar-dark sticky-top">
    <div class="nav-container container">
        <a class="navbar-brand nav-brand" href="{{ url('/') }}">
            <div class="logo-wrapper">
                <div class="logo-symbol">VPP</div>
                <div class="logo-text">
                    <span class="logo-main">VIAJES PA POBRES</span>
                    <span class="logo-sub">Guías para viajar, sin tener que gastar</span>
                </div>
            </div>
        </a>

        <button class="navbar-toggler mobile-menu-btn" type="button" data-bs-toggle="collapse" data-bs-target="#mainMenu">
            <i class="fas fa-bars"></i>
        </button>

        <div class="collapse navbar-collapse nav-links" id="mainMenu">
            <a href="{{ url('/') }}" class="nav-link">Inicio</a>
            <a href="{{ url('/guias') }}" class="nav-link">Guías</a>
            <a href="{{ url('/nosotros') }}" class="nav-link">Nosotros</a>
            <a href="{{ url('/carrito') }}" class="nav-link">Carrito</a>
            <a href="{{ url('/pedidos') }}" class="nav-link">Mis pedidos</a>
            <a href="{{ url('/guias') }}" class="nav-cta">Comprar guía</a>
        </div>
    </div>
</nav>

@yield('content')

<footer class="site-footer py-4">
    <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center gap-2">
        <p class="mb-0">© {{ date('Y') }} Viajes Pa Pobres</p>
        <a href="{{ url('/nosotros#contacto') }}">Contacto</a>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('js/web_guides.js') }}"></script>
</body>
</html>