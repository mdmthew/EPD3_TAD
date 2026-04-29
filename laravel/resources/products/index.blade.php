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
          <div class="col-md-6 col-xl-4">
            <article class="guide-card h-100">
              <div class="guide-header"><span class="guide-badge">BARONG EXPERIENCES</span><div class="guide-price">2€</div></div>
              <div class="guide-image"><img src="https://images.unsplash.com/photo-1518509562904-e7ef99cdcc86?auto=format&fit=crop&w=800&q=80" alt="Bali"></div>
              <div class="guide-content"><h3 class="guide-title">Guía Esencial de Bali</h3><p class="guide-excerpt">La isla de los dioses desde templos secretos hasta playas espectaculares.</p></div>
              <div class="guide-actions">
                <a href="{{ url('/carrito') }}" class="guide-buy-btn"><i class="fas fa-shopping-bag"></i> Comprar ahora</a>
                <a href="{{ url('/guias/bali') }}" class="guide-details-link"><i class="fas fa-info-circle"></i> Más detalles</a>
              </div>
            </article>
          </div>

          <div class="col-md-6 col-xl-4">
            <article class="guide-card h-100">
              <div class="guide-header"><span class="guide-badge">NUEVA</span><div class="guide-price">2€</div></div>
              <div class="guide-image"><img src="https://images.unsplash.com/photo-1525874684015-58379d421a52?auto=format&fit=crop&w=800&q=80" alt="Italia"></div>
              <div class="guide-content"><h3 class="guide-title">Guía Completa de Italia</h3><p class="guide-excerpt">Del Coliseo a la Costa Amalfitana, con rutas por pueblos toscanos.</p></div>
              <div class="guide-actions">
                <a href="{{ url('/carrito') }}" class="guide-buy-btn"><i class="fas fa-shopping-bag"></i> Comprar ahora</a>
                <a href="{{ url('/guias/italia') }}" class="guide-details-link"><i class="fas fa-info-circle"></i> Más detalles</a>
              </div>
            </article>
          </div>

          <div class="col-md-6 col-xl-4">
            <article class="guide-card h-100 coming-soon">
              <div class="guide-header"><span class="guide-badge">PRÓXIMAMENTE</span><div class="guide-price">—</div></div>
              <div class="guide-image"><img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=800&q=80" alt="Japón"></div>
              <div class="guide-content"><h3 class="guide-title">Guía de Japón low cost</h3><p class="guide-excerpt">Ciudades, templos y transporte eficiente con presupuesto ajustado.</p></div>
              <div class="guide-actions">
                <button class="guide-details-btn"><i class="fas fa-clock"></i> En preparación</button>
                <a href="{{ url('/nosotros#contacto') }}" class="guide-details-link"><i class="fas fa-bell"></i> Avisarme</a>
              </div>
            </article>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</main>
@endsection