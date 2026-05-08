@extends('layouts.app')

@section('title', 'Carrito')

@section('content')
<main>
<section class="guides-section py-5">
  <div class="container">

    <div class="section-header mb-4">
      <span class="section-subtitle">CARRITO</span>
      <h1 class="section-title">Resumen de compra</h1>
      <p class="section-description">
        Revisa tus guías antes de confirmar el pedido.
      </p>
    </div>

    @php
        $total = 0;
    @endphp

    @if($cart && $cart->items->count())

        @foreach($cart->items as $item)

            @php
                $subtotal = $item->quantity * $item->unit_price;
                $total += $subtotal;
            @endphp

            <div class="guide-card p-4 mb-4">
              <div class="row align-items-center g-3">

                <div class="col-md-2">
                  <img
                    class="img-fluid rounded-4"
                    src="{{ $item->product->image ?? 'https://images.unsplash.com/photo-1518509562904-e7ef99cdcc86?auto=format&fit=crop&w=500&q=80' }}"
                    alt="{{ $item->product->name }}"
                  >
                </div>

                <div class="col-md-4">
                  <h2 class="h4 mb-1">
                    {{ $item->product->name }}
                  </h2>

                  <p class="text-secondary mb-0">
                    {{ number_format($item->unit_price, 2) }} €
                    por unidad
                  </p>
                </div>

                <div class="col-md-3">
                  <div class="d-flex align-items-center gap-2">

                    {{-- BOTÓN - --}}
                    <form method="POST" action="{{ route('cart.item.decrease', $item) }}">
                      @csrf
                      <button type="submit" class="btn btn-outline-dark">
                        -
                      </button>
                    </form>

                    <span class="fw-bold px-2">
                      {{ $item->quantity }}
                    </span>

                    {{-- BOTÓN + --}}
                    <form method="POST" action="{{ route('cart.item.increase', $item) }}">
                      @csrf
                      <button type="submit" class="btn btn-outline-dark">
                        +
                      </button>
                    </form>

                  </div>
                </div>

                <div class="col-md-2">
                  <strong>
                    {{ number_format($subtotal, 2) }} €
                  </strong>
                </div>

                <div class="col-md-1 text-end">

                  {{-- ELIMINAR --}}
                  <form method="POST" action="{{ route('cart.item.destroy', $item) }}">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger btn-sm">
                      X
                    </button>
                  </form>

                </div>

              </div>
            </div>

        @endforeach

        {{-- TOTAL --}}
        <div class="guide-card p-4 mt-4">

          <div class="d-flex justify-content-between align-items-center">

            <div>
              <h3 class="mb-0">
                Total del carrito
              </h3>
            </div>

            <div>
              <h2 class="mb-0">
                {{ number_format($total, 2) }} €
              </h2>
            </div>

          </div>

          <div class="text-end mt-4">

            <form method="POST" action="{{ route('checkout') }}">
              @csrf

              <button type="submit" class="btn-primary">
                Finalizar compra
              </button>
            </form>

          </div>

        </div>

    @else

        <div class="guide-card p-5 text-center">
          <h2 class="mb-3">Tu carrito está vacío</h2>

          <a href="{{ route('guides.index') }}" class="btn-primary">
            Ver guías
          </a>
        </div>

    @endif

  </div>
</section>
</main>
@endsection