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

    @forelse($orders as $order)
      <div class="guide-card p-4 mb-3">
        <div class="d-flex flex-column flex-md-row justify-content-between gap-3">
          <div>
            <h2 class="h4 mb-1">Pedido #{{ $order->id }}</h2>
            <p class="text-secondary mb-0">Estado: {{ $order->status }}</p>
          </div>
          <div>
            <span class="guide-badge">{{ $order->status }}</span>
            <strong class="ms-3">{{ $order->total }}€</strong>
          </div>
        </div>
      </div>
    @empty
      <div class="guide-card p-4 text-center">
        <h2 class="h4">No tienes pedidos todavía</h2>
        <p class="text-secondary">Cuando compres una guía aparecerá aquí.</p>
        <a href="{{ url('/guias') }}" class="btn-primary">Ver guías</a>
      </div>
    @endforelse

  </div>
</section>
</main>
@endsection