@extends('layouts.app')

@section('title', 'Mis pedidos')

@section('content')
<main>
<section class="guides-section py-5">
  <div class="container">
    <div class="section-header mb-4">
      <span class="section-subtitle">PEDIDOS</span>
      <h1 class="section-title">Estado de tus pedidos</h1>
    </div>

    <div class="guide-card p-4">
      <div class="d-flex flex-column flex-md-row justify-content-between gap-3">
        <div>
          <h2 class="h4 mb-1">Pedido #0001</h2>
          <p class="text-secondary mb-0">Guía Esencial de Bali · PDF digital</p>
        </div>
        <div>
          <span class="guide-badge">Completado</span>
          <strong class="ms-3">2€</strong>
        </div>
      </div>
    </div>
  </div>
</section>
</main>
@endsection