@extends('layouts.app')

@section('title', 'Admin productos')

@section('content')
<main>
<section class="guides-section py-5">
  <div class="container">

    <div class="section-header mb-4">
      <span class="section-subtitle">ADMIN</span>
      <h1 class="section-title">Gestión de productos</h1>
    </div>

    <div class="guide-card p-4">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h4 mb-0">Productos</h2>
        <a href="{{ route('admin.products.create') }}" class="btn-primary">
          Nuevo producto
        </a>
      </div>

      <table class="table table-dark table-hover align-middle">
        <thead>
          <tr>
            <th>Producto</th>
            <th>Precio</th>
            <th>Visible</th>
            <th>Categorías</th>
            <th class="text-end">Acciones</th>
          </tr>
        </thead>

        <tbody>
          @foreach($products as $product)
            <tr>
              <td>{{ $product->name }}</td>
              <td>{{ $product->price }}€</td>
              <td>
                @if($product->is_active)
                  <span class="guide-badge">Visible</span>
                @else
                  <span class="badge bg-secondary">Oculto</span>
                @endif
              </td>
              <td>
                @foreach($product->categories as $category)
                  <span class="badge bg-warning text-dark">{{ $category->name }}</span>
                @endforeach
              </td>
              <td class="text-end">
                <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-sm btn-warning">
                  Editar
                </a>

                <form method="POST" action="{{ route('admin.products.toggle', $product) }}" class="d-inline">
                  @csrf
                  @method('PATCH')
                  <button class="btn btn-sm btn-info">
                    {{ $product->is_active ? 'Ocultar' : 'Mostrar' }}
                  </button>
                </form>

                <form method="POST" action="{{ route('admin.products.destroy', $product) }}" class="d-inline">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-sm btn-danger">
                    Eliminar
                  </button>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>

  </div>
</section>
</main>
@endsection