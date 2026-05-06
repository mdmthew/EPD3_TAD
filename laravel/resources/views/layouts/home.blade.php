@extends('layouts.app')

@section('title', 'Inicio')

@section('content')
<section class="wyve-hero">
  <div class="hero-container">
    <div class="hero-content">
      <div class="hero-badge">Guías de viaje a 2€</div>

      <h1 class="hero-title">
        Descubre el mundo sin <span class="highlight">arruinarte</span>
      </h1>

      <p class="hero-description">
        Guías prácticas creadas por ingenieros viajeros. Experiencias reales, precios imposibles. Todo por solo 2€ por guía.
      </p>

      <div class="hero-actions">
        <a href="{{ url('/guias') }}" class="btn-primary">
          <span>Explorar Guías</span>
          <i class="fas fa-arrow-right"></i>
        </a>
        <a href="{{ url('/nosotros') }}" class="btn-secondary">Conocer a los creadores</a>
      </div>

      <div class="hero-stats">
        <div class="stat"><span class="stat-number">2€</span><span class="stat-label">por guía</span></div>
        <div class="stat"><span class="stat-number">100%</span><span class="stat-label">experiencias reales</span></div>
        <div class="stat"><span class="stat-number">24h</span><span class="stat-label">entrega digital</span></div>
      </div>
    </div>

    <div class="hero-visual guides-carousel">
      <a href="{{ url('/guias/bali') }}" class="guide-card-overlay card-1">
        <span class="guide-date">Guía</span>
        <h3 class="guide-card-title">Guía Esencial de Bali</h3>
        <p class="guide-card-meta">Isla de los dioses · 2€</p>
        <span class="guide-card-tag">Bali</span>
      </a>

      <a href="{{ url('/guias/italia') }}" class="guide-card-overlay card-2">
        <span class="guide-date">Guía</span>
        <h3 class="guide-card-title">Guía Completa de Italia</h3>
        <p class="guide-card-meta">Coliseo, Toscana y más · 2€</p>
        <span class="guide-card-tag">Italia</span>
      </a>

      <a href="{{ url('/guias') }}" class="guide-card-overlay card-3">
        <span class="guide-date">Próximamente</span>
        <h3 class="guide-card-title">Tu próximo destino</h3>
        <p class="guide-card-meta">Vota el siguiente viaje</p>
        <span class="guide-card-tag">Explorar</span>
      </a>
    </div>
  </div>
</section>
@endsection