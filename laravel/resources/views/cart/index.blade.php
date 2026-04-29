@extends('layouts.app')

@section('title', 'Carrito')

@section('content')
<main>
<section class="guides-section py-5">
  <div class="container">
    <div class="section-header mb-4">
      <span class="section-subtitle">CARRITO</span>
      <h1 class="section-title">Resumen de compra</h1>
      <p class="section-description">Revisa tus guías antes de confirmar el pedido.</p>
    </div>

    <div class="guide-card p-4">
      <div class="row align-items-center g-3">
        <div class="col-md-2">
          <img class="img-fluid rounded-4" src="https://images.unsplash.com/photo-1518509562904-e7ef99cdcc86?auto=format&fit=crop&w=500&q=80" alt="Bali">
        </div>
        <div class="col-md-6">
          <h2 class="h4 mb-1">Guía Esencial de Bali</h2>
          <p class="text-secondary mb-0">Guía digital en PDF</p>
        </div>
        <div class="col-md-2">
          <strong>2€</strong>
        </div>
        <div class="col-md-2 text-md-end">
          <a href="{{ url('/pedidos') }}" class="btn-primary">Comprar</a>
        </div>
      </div>
    </div>
  </div>
</section>
</main>
@endsection