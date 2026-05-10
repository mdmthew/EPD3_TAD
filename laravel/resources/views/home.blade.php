@extends('layouts.app')

@section('title', 'Inicio')

@section('content')
<section class="wyve-hero">
  <div class="hero-container">
    <div class="hero-content">
      <div class="hero-badge">Guías de viaje desde 2€</div>

      <h1 class="hero-title">
        Descubre el mundo sin <span class="highlight">arruinarte</span>
      </h1>

      <p class="hero-description">
        Guías prácticas creadas por ingenieros viajeros. Experiencias reales, precios imposibles. Todo desde 2€ por guía.
      </p>

      <div class="hero-actions">
        <a href="{{ url('/guias') }}" class="btn-primary">
          <span>Explorar Guías</span>
          <i class="fas fa-arrow-right"></i>
        </a>
        <a href="{{ url('/nosotros') }}" class="btn-secondary">Conocer a los creadores</a>
      </div>

      <div class="hero-stats d-flex flex-wrap gap-5">
        <div class="stat">
          <span class="stat-number">Desde 2€</span>
          <span class="stat-label">por guía</span>
        </div>

        <div class="stat">
          <span class="stat-number">100%</span>
          <span class="stat-label">experiencias reales</span>
        </div>

        <div class="stat">
          <span class="stat-number">24h</span>
          <span class="stat-label">entrega digital</span>
        </div>
      </div>
    </div>
    <div class="hero-visual guides-carousel">
      @foreach($featuredProducts as $index => $product)
        @php
          $image = $product->image
              ? (filter_var($product->image, FILTER_VALIDATE_URL) ? $product->image : asset($product->image))
              : 'https://images.unsplash.com/photo-1518509562904-e7ef99cdcc86?auto=format&fit=crop&w=800&q=80';
        @endphp

        <a href="{{ route('guides.show', $product->id) }}" class="guide-card-overlay card-{{ $index + 1 }}" style="background-image: linear-gradient(rgba(0,0,0,.35), rgba(0,0,0,.85)), url('{{ $image }}'); background-size: cover; background-position: center;">
          <span class="guide-date">Guía</span>
          <h3 class="guide-card-title">{{ $product->name }}</h3>
          <p class="guide-card-meta">{{ number_format($product->price, 2) }}€ · Guía digital</p>
          <span class="guide-card-tag">{{ $product->name }}</span>
        </a>
      @endforeach
    </div>
  </div>
</section>
@endsection