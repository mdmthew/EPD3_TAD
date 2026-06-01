@extends('layouts.app')

@section('title', 'Admin favoritos')

@section('content')
<main>
<section class="guides-section py-5">
  <div class="container">

    <div class="section-header mb-4">
      <span class="section-subtitle">ADMIN</span>
      <h1 class="section-title">Estadísticas de favoritos</h1>
      <p class="section-description">
        Consulta qué guías son más guardadas como favoritas por los usuarios.
      </p>
    </div>

    <div class="guide-card p-4">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h4 mb-0">Guías favoritas</h2>

        <a href="{{ route('admin.products.index') }}" class="btn-primary">
          Gestionar productos
        </a>
      </div>

      <table class="table table-dark table-hover align-middle">
        <thead>
          <tr>
            <th>Guía</th>
            <th>Precio</th>
            <th>Favoritos</th>
            <th>Visible</th>
            <th class="text-end">Acciones</th>
          </tr>
        </thead>

        <tbody>
          @forelse($products as $product)
            <tr>
              <td>{{ $product->name }}</td>

              <td>{{ number_format($product->price, 2) }}€</td>

              <td>
                <span class="guide-badge">
                  {{ $product->favorites_count }}
                </span>
              </td>

              <td>
                @if($product->is_active)
                  <span class="guide-badge">Visible</span>
                @else
                  <span class="badge bg-secondary">Oculto</span>
                @endif
              </td>

              <td class="text-end">
                <a href="{{ route('guides.show', $product->id) }}" class="btn btn-sm btn-info">
                  Ver
                </a>

                <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-sm btn-warning">
                  Editar
                </a>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="5" class="text-center py-4">
                Todavía no hay favoritos registrados.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

  </div>
</section>
</main>
@endsection