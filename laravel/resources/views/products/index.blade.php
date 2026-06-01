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

    <div class="row g-4 align-items-start guides-layout">
      <div class="col-lg-3 guides-sidebar">
        <div class="guide-card p-4 sticky-top" style="top:110px">

            <h2 class="h5 mb-4">
              <i class="fas fa-filter"></i> Filtrar
            </h2>

            <form method="GET" action="{{ route('guides.index') }}" id="filtersForm">

              <div class="accordion accordion-flush" id="filtersAccordion">

                @foreach($categoryGroups as $group)

                  <div class="accordion-item bg-transparent border-0 mb-3">

                    <h3 class="accordion-header" id="heading_{{ $group->id }}">
                      <button
                        class="accordion-button collapsed filter-accordion-btn"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#collapse_{{ $group->id }}"
                        aria-expanded="false"
                        aria-controls="collapse_{{ $group->id }}"
                      >
                        {{ $group->name }}
                      </button>
                    </h3>

                    <div
                      id="collapse_{{ $group->id }}"
                      class="accordion-collapse collapse"
                      aria-labelledby="heading_{{ $group->id }}"
                      data-bs-parent="#filtersAccordion"
                    >
                      <div class="accordion-body px-0 pt-3">

                        @foreach($group->categories as $category)

                          <div class="form-check mb-2">

                            <input
                              class="form-check-input filter-input"
                              type="checkbox"
                              name="categories[]"
                              value="{{ $category->id }}"
                              id="category_{{ $category->id }}"
                              {{ in_array($category->id, request('categories', [])) ? 'checked' : '' }}
                            >

                            <label
                              class="form-check-label"
                              for="category_{{ $category->id }}"
                            >
                              {{ $category->name }}
                            </label>

                          </div>

                        @endforeach
                      </div>
                    </div>
                  </div>
                @endforeach
              </div>
                <div class="mt-4">
                  <h3 class="h6 mb-3">Precio del viaje</h3>

                  <div class="d-flex justify-content-between small mb-1">
                    <span>$</span>
                    <span>$$$</span>
                  </div>

                  <input
                    type="range"
                    min="1"
                    max="3"
                    step="1"
                    name="travel_price_level"
                    value="{{ request('travel_price_level', 3) }}"
                    class="form-range filter-input"
                  >
                </div>
            </form>
          </div>
        </div>

      <div class="col-lg-9 guides-products">
        <div class="row g-4">

          @forelse($products ?? [] as $product)
            <div class="col-md-6 col-xl-4">
              <article
                  class="guide-card h-100 position-relative guide-clickable"
                  onclick="window.location='{{ route('guides.show', $product->id) }}'"
                  style="cursor:pointer;"
              >
                <div class="guide-header">
                  <span class="guide-badge">GUÍA DIGITAL</span>
                  <div class="guide-price">{{ $product->price }}€</div>
                </div>

                <div class="guide-image">
                  @php
                    $image = $product->image
                        ? (filter_var($product->image, FILTER_VALIDATE_URL)
                            ? $product->image
                            : asset($product->image))
                        : 'https://images.unsplash.com/photo-1518509562904-e7ef99cdcc86?auto=format&fit=crop&w=800&q=80';
                  @endphp

                  <img src="{{ $image }}" alt="{{ $product->name }}">
                </div>

                <div class="guide-content">
                  <h3 class="guide-title">{{ $product->name }}</h3>
                  <p class="guide-excerpt">{{ $product->description }}</p>
                </div>

                <div class="guide-actions position-relative" onclick="event.stopPropagation();"> 
                @auth

                  <form method="POST" action="{{ route('cart.add') }}">
                    @csrf

                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                    <button type="submit" class="guide-buy-btn">
                      <i class="fas fa-cart-plus"></i>
                      Añadir
                    </button>
                  </form>

                  @php
                    $isFavorite = Auth::user()
                        ->favoriteProducts()
                        ->where('products.id', $product->id)
                        ->exists();
                  @endphp

                  @if($isFavorite)
                    <form method="POST" action="{{ route('favorites.remove', $product->id) }}">
                      @csrf
                      @method('DELETE')

                      <button type="submit" class="guide-fav-btn" title="Quitar de favoritos">
                        <i class="fas fa-heart-broken"></i>
                      </button>
                    </form>
                  @else
                    <form method="POST" action="{{ route('favorites.add', $product->id) }}">
                      @csrf

                      <button type="submit" class="guide-fav-btn" title="Añadir a favoritos">
                        <i class="fas fa-heart"></i>
                      </button>
                    </form>
                  @endif

                @else
                  <a href="{{ route('login') }}" class="guide-buy-btn">
                    <i class="fas fa-cart-plus"></i>
                    Añadir
                  </a>

                  <a href="{{ route('login') }}" class="guide-fav-btn">
                    <i class="fas fa-heart"></i>
                  </a>

                @endauth
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

<script>
  document.querySelectorAll('.filter-input').forEach(input => {
      input.addEventListener('change', () => {
          document.getElementById('filtersForm').submit();
      });
  });
</script>
@endsection