@extends('layouts.app')

@section('title', 'Admin pedidos')

@section('content')
<main>
<section class="guides-section py-5">
  <div class="container">

    <div class="section-header mb-4">
      <span class="section-subtitle">ADMIN</span>
      <h1 class="section-title">Gestión de pedidos</h1>
    </div>

    @if (session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
    @endif

    @forelse($orders as $order)
      <div class="guide-card p-4 mb-4">
        <div class="d-flex flex-column flex-md-row justify-content-between gap-3 mb-3">
          <div>
            <h2 class="h4 mb-1">Pedido #{{ $order->id }}</h2>

            <p class="text-secondary mb-0">
              Cliente: {{ $order->user->name ?? 'Usuario eliminado' }}
            </p>

            <p class="text-secondary mb-0">
              Email: {{ $order->user->email ?? 'Sin email' }}
            </p>

            <p class="text-secondary mb-0">
              Fecha: {{ $order->created_at->format('d/m/Y H:i') }}
            </p>
          </div>

          <div class="text-md-end">
            <span class="guide-badge">
              @if($order->status === 'pending')
                Pendiente
              @elseif($order->status === 'completed')
                Completado
              @elseif($order->status === 'cancelled')
                Anulado
              @else
                {{ $order->status }}
              @endif
            </span>

            <strong class="ms-3">{{ number_format($order->total, 2) }}€</strong>
          </div>
        </div>

        <form method="POST" action="{{ route('admin.orders.updateStatus', $order) }}" class="mb-4">
          @csrf
          @method('PATCH')

          <div class="row g-3 align-items-end">
            <div class="col-md-4">
              <label class="form-label">Estado del pedido</label>
              <select name="status" class="form-select bg-dark text-light border-secondary rounded-3">
                <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>
                  Pendiente
                </option>
                <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>
                  Completado
                </option>
                <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>
                  Anulado
                </option>
              </select>
            </div>

            <div class="col-md-4">
              <button type="submit" class="btn-primary">
                Actualizar estado
              </button>
            </div>
          </div>
        </form>

        <div class="table-responsive mt-4">
          <table class="table table-dark table-borderless align-middle mb-0 rounded-4 overflow-hidden">
            <thead>
              <tr class="border-bottom border-secondary">
                <th class="py-3">Producto</th>
                <th class="py-3">Cantidad</th>
                <th class="py-3">Precio unidad</th>
                <th class="py-3">Subtotal</th>
              </tr>
            </thead>

            <tbody>
              @foreach($order->items as $item)
                <tr>
                  <td class="py-3">{{ $item->product->name ?? 'Producto eliminado' }}</td>
                  <td class="py-3">{{ $item->quantity }}</td>
                  <td class="py-3">{{ number_format($item->unit_price, 2) }}€</td>
                  <td class="py-3">{{ number_format($item->subtotal, 2) }}€</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    @empty
      <div class="guide-card p-4 text-center">
        <h2 class="h4">No hay pedidos todavía</h2>
        <p class="text-secondary mb-0">
          Cuando los usuarios realicen compras aparecerán aquí.
        </p>
      </div>
    @endforelse

  </div>
</section>
</main>
@endsection