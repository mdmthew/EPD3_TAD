@extends('layouts.app')

@section('title', $product->name ?? 'Detalle de guía')

@section('content')
<main>
<section class="guide-detail py-5">
  <div class="container">

    <div class="guide-detail-header mb-4">
      <span class="guide-badge">Guía digital</span>
      <h1 class="guide-detail-title display-5 fw-bold mt-3">
        {{ $product->name }}
      </h1>
      <p class="guide-detail-subtitle lead text-secondary">
        {{ $product->description }}
      </p>
    </div>

    <div class="row g-4 align-items-start">
      <div class="col-lg-8">
        <div id="guideCarousel" class="carousel slide guide-detail-gallery" data-bs-ride="carousel">
          <div class="carousel-inner rounded-4 overflow-hidden">
            <div class="carousel-item active">
              <img src="https://images.unsplash.com/photo-1518509562904-e7ef99cdcc86?auto=format&fit=crop&w=1200&q=80" class="d-block w-100 img-fluid" alt="{{ $product->name }}">
            </div>
            <div class="carousel-item">
              <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=1200&q=80" class="d-block w-100 img-fluid" alt="{{ $product->name }}">
            </div>
            <div class="carousel-item">
              <img src="https://images.unsplash.com/photo-1537953773345-d172ccf13cf1?auto=format&fit=crop&w=1200&q=80" class="d-block w-100 img-fluid" alt="{{ $product->name }}">
            </div>
          </div>

          <button class="carousel-control-prev" type="button" data-bs-target="#guideCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
          </button>

          <button class="carousel-control-next" type="button" data-bs-target="#guideCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
          </button>
        </div>
      </div>

      <div class="col-lg-4">
        <aside class="guide-card p-4 h-100">
          <div class="guide-detail-price mb-3">
            <span class="price-main">{{ number_format($product->price, 2) }}€</span>
            <span class="price-label d-block text-secondary">Guía digital en PDF</span>
          </div>

          <div class="d-grid gap-2">
            @auth
              <form method="POST" action="{{ route('cart.add') }}">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">

                <button type="submit" class="btn-primary w-100 justify-content-center">
                  <span>Añadir al carrito</span>
                  <i class="fas fa-shopping-cart"></i>
                </button>
              </form>

              <form method="POST" action="{{ route('favorites.add', $product->id) }}">
                @csrf
                <button type="submit" class="btn-secondary w-100">
                  <i class="fas fa-heart"></i> Añadir a favoritos
                </button>
              </form>
            @else
              <a href="{{ route('login') }}" class="btn-primary w-100 justify-content-center">
                <span>Añadir al carrito</span>
                <i class="fas fa-shopping-cart"></i>
              </a>

              <a href="{{ route('login') }}" class="btn-secondary w-100">
                <i class="fas fa-heart"></i> Añadir a favoritos
              </a>
            @endauth
          </div>

          <p class="guide-detail-note mt-3 mb-0 text-secondary">
            Recibirás un PDF con enlaces directos a alojamientos, vuelos y actividades.
          </p>
        </aside>
      </div>
    </div>

    <div class="row g-4 mt-2">
      <div class="col-lg-8">
        <article class="guide-card p-4 h-100">
          <h2 class="h3 mb-3">Qué incluye esta guía</h2>
          <ul class="mb-0">
            <li>Itinerarios adaptados a distintos presupuestos.</li>
            <li>Mapa con recomendaciones y puntos importantes.</li>
            <li>Consejos prácticos para ahorrar tiempo y dinero.</li>
          </ul>
        </article>
      </div>

      <div class="col-lg-4">
        <div class="guide-card p-4 h-100">
          <h2 class="h5 mb-3">Datos rápidos</h2>
          <div class="progress mb-3">
            <div class="progress-bar bg-warning" style="width: 80%">80% ahorro</div>
          </div>
          <div class="badge bg-success me-2">Accesible</div>
          <div class="badge bg-info text-dark">PDF</div>
        </div>
      </div>
    </div>

  </div>
</section>
</main>
@endsection