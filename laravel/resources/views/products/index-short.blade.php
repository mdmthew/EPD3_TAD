<h1>Productos</h1>

@foreach($products as $product)
    <div>
        <h3>{{ $product->name }}</h3>
        <p>{{ $product->price }} €</p>

        <form method="POST" action="/cart/add">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <button type="submit">Añadir al carrito</button>
        </form>
    </div>
@endforeach