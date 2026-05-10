@extends('layouts.app')

@section('title', 'Admin categorías')

@section('content')
<main>
<section class="guides-section py-5">
  <div class="container">

    <div class="section-header mb-4">
      <span class="section-subtitle">ADMIN</span>
      <h1 class="section-title">Gestión de categorías</h1>
    </div>

    @if (session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
    @endif

    <div class="guide-card p-4">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h4 mb-0">Categorías</h2>
        <a href="{{ route('admin.categories.create') }}" class="btn-primary">
          Nueva categoría
        </a>
      </div>

      <table class="table table-dark table-hover align-middle">
        <thead>
          <tr>
            <th>Categoría</th>
            <th>Grupo</th>
            <th>Slug</th>
            <th>Productos</th>
            <th class="text-end">Acciones</th>
          </tr>
        </thead>

        <tbody>
          @foreach($categories as $category)
            <tr>
              <td>{{ $category->name }}</td>
              <td>
                <span class="badge bg-warning text-dark">
                  {{ $category->group->name ?? 'Sin grupo' }}
                </span>
              </td>
              <td>{{ $category->slug }}</td>
              <td>{{ $category->products->count() }}</td>
              <td class="text-end">
                <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-sm btn-warning">
                  Editar
                </a>

                <form method="POST" action="{{ route('admin.categories.destroy', $category) }}" class="d-inline">
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