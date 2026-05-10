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
        <div class="d-flex flex-column flex-md-row justify-content-between gap-3 mb-3">
          <div>
            <h2 class="h4 mb-1">Pedido #{{ $order->id }}</h2>
            <p class="text-secondary mb-0">Estado: {{ $order->status }}</p>
            <p class="text-secondary mb-0">Fecha: {{ $order->created_at->format('d/m/Y H:i') }}</p>
          </div>

          <div>
            <span class="guide-badge">{{ $order->status }}</span>
            <strong class="ms-3">{{ number_format($order->total, 2) }}€</strong>
          </div>
        </div>

        <div class="table-responsive mt-3">
          <table class="table align-middle">
            <thead>
              <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio unidad</th>
                <th>Subtotal</th>
              </tr>
            </thead>
            <tbody>
              @foreach($order->items as $item)
                <tr>
                  <td>{{ $item->product->name ?? 'Producto eliminado' }}</td>
                  <td>{{ $item->quantity }}</td>
                  <td>{{ number_format($item->unit_price, 2) }}€</td>
                  <td>{{ number_format($item->subtotal, 2) }}€</td>
                </tr>
              @endforeach
            </tbody>
          </table>
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