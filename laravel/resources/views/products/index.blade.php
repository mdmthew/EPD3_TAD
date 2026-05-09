@extends('layouts.app')

@section('title', 'Guías')

@section('content')
<main>
<section class="guides-section py-5">
  <div class="container">
    <div class="section-header mb-4">
      <span class="section-subtitle">COLECCIÓN DE GUÍAS</span>
      <h1 class="section-title">Destinos cuidadosamente seleccionados</h1>
      <p class="section-description">Cada guía es el resultado de semanas de exploración y documentación.</p>
    </div>

    <div class="row g-4 align-items-start">
      <div class="col-lg-3">
        <div class="guide-card p-4 sticky-top" style="top:110px">
          <h2 class="h5 mb-3">Filtrar</h2>
          <div class="form-check mb-2"><input class="form-check-input" type="checkbox" id="f1"><label class="form-check-label" for="f1">Europa</label></div>
          <div class="form-check mb-2"><input class="form-check-input" type="checkbox" id="f2"><label class="form-check-label" for="f2">Asia</label></div>
          <div class="form-check mb-2"><input class="form-check-input" type="checkbox" id="f3"><label class="form-check-label" for="f3">Low cost</label></div>
          <button class="btn-secondary mt-3 w-100">Aplicar</button>
        </div>
      </div>

      <div class="col-lg-9">
        <div class="row g-4">

          @forelse($products ?? [] as $product)
            <div class="col-md-6 col-xl-4">
              <article class="guide-card h-100">
                <div class="guide-header">
                  <span class="guide-badge">GUÍA DIGITAL</span>
                  <div class="guide-price">{{ $product->price }}€</div>
                </div>

                <div class="guide-image">
                  @php
                    $image = $product->image
                        ? (filter_var($product->image, FILTER_VALIDATE_URL) ? $product->image : asset($product->image))
                        : 'https://images.unsplash.com/photo-1518509562904-e7ef99cdcc86?auto=format&fit=crop&w=800&q=80';
                  @endphp

                  <img src="{{ $image }}" alt="{{ $product->name }}">
                </div>

                <div class="guide-content">
                  <h3 class="guide-title">{{ $product->name }}</h3>
                  <p class="guide-excerpt">{{ $product->description }}</p>
                </div>

                <div class="guide-actions">
                  @auth
                    <form method="POST" action="{{ route('cart.add') }}">
                      @csrf
                      <input type="hidden" name="product_id" value="{{ $product->id }}">
                      <button type="submit" class="guide-buy-btn">
                        <i class="fas fa-shopping-bag"></i> Añadir al carrito
                      </button>
                    </form>

                    <form method="POST" action="{{ route('favorites.add', $product->id) }}">
                      @csrf
                      <button type="submit" class="guide-details-btn">
                        <i class="fas fa-heart"></i> Favorito
                      </button>
                    </form>
                  @else
                    <a href="{{ route('login') }}" class="guide-buy-btn">
                      <i class="fas fa-shopping-bag"></i> Añadir al carrito
                    </a>

                    <a href="{{ route('login') }}" class="guide-details-link">
                      <i class="fas fa-heart"></i> Favorito
                    </a>
                  @endauth

                  <a href="{{ route('guides.show', $product->id) }}" class="guide-details-link">
                    <i class="fas fa-info-circle"></i> Más detalles
                  </a>
                </div>
              </article>
            </div>
          @empty

            <div class="col-12">
              <div class="guide-card p-4 text-center">
                <h2 class="h4">No hay productos disponibles</h2>
                <p class="text-secondary mb-0">Crea productos en la base de datos para que aparezcan aquí.</p>
              </div>
            </div>

          @endforelse

        </div>
      </div>
    </div>
  </div>
</section>
</main>
@endsection