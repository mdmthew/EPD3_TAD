@extends('layouts.app')

@section('title', 'Favoritos')

@section('content')
<main>
<section class="guides-section py-5">
  <div class="container">
    <div class="section-header mb-4">
      <span class="section-subtitle">FAVORITOS</span>
      <h1 class="section-title">Tus guías favoritas</h1>
      <p class="section-description">Aquí aparecen las guías que has guardado para ver más tarde.</p>
    </div>

    <div class="row g-4">
      @forelse($favorites as $product)
        <div class="col-md-6 col-xl-4">
          <article class="guide-card h-100">
            <div class="guide-header">
              <span class="guide-badge">FAVORITO</span>
              <div class="guide-price">{{ $product->price }}€</div>
            </div>

            <div class="guide-image">
              <img src="{{ $product->image ? asset($product->image) : 'https://images.unsplash.com/photo-1518509562904-e7ef99cdcc86?auto=format&fit=crop&w=800&q=80' }}" alt="{{ $product->name }}">
            </div>

            <div class="guide-content">
              <h3 class="guide-title">{{ $product->name }}</h3>
              <p class="guide-excerpt">{{ $product->description }}</p>
            </div>

            <div class="guide-actions">
              <a href="{{ url('/guias/' . $product->id) }}" class="guide-details-link">
                <i class="fas fa-info-circle"></i> Más detalles
              </a>

              <form method="POST" action="{{ route('favorites.remove', $product->id) }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="guide-details-btn">
                  <i class="fas fa-trash"></i> Quitar
                </button>
              </form>
            </div>
          </article>
        </div>
      @empty
        <div class="col-12">
          <div class="guide-card p-4 text-center">
            <h2 class="h4">Todavía no tienes favoritos</h2>
            <p class="text-secondary">Explora nuestras guías y guarda las que te interesen.</p>
            <a href="{{ url('/guias') }}" class="btn-primary">Ver guías</a>
          </div>
        </div>
      @endforelse
    </div>
  </div>
</section>
</main>
@endsection