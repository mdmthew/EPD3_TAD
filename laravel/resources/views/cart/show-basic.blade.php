{{-- TODO: Reemplazar esta vista básica por una interfaz con Bootstrap --}}


<h1>Carrito</h1>

@if($cart && $cart->items->count())
    <ul>
        @foreach($cart->items as $item)
            <li>
                {{ $item->product->name }} 
                ({{ $item->quantity }} x {{ $item->unit_price }} €)
            </li>
        @endforeach
    </ul>
@else
    <p>Carrito vacío</p>
@endif