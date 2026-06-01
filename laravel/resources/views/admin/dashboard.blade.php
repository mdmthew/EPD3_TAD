@extends('layouts.app')

@section('title', 'Panel administrador')

@section('content')
<main>
<section class="guides-section py-5">
  <div class="container">
    <div class="section-header mb-4">
      <span class="section-subtitle">ADMIN</span>
      <h1 class="section-title">Panel de administración</h1>
    </div>

    <div class="row g-4">

      <div class="col-md-6 col-xl-3">
        <div class="guide-card p-4 h-100">
          <h2 class="h5">Productos</h2>
          <p class="text-secondary">Crear, editar, ocultar o eliminar productos.</p>
          <a href="{{ route('admin.products.index') }}" class="btn-primary mt-3">
            Gestionar
          </a>
        </div>
      </div>

      <div class="col-md-6 col-xl-3">
        <div class="guide-card p-4 h-100">
          <h2 class="h5">Categorías</h2>
          <p class="text-secondary">Gestionar categorías de productos.</p>
          <a href="{{ route('admin.categories.index') }}" class="btn-primary mt-3">
            Gestionar
          </a>
        </div>
      </div>

      <div class="col-md-6 col-xl-3">
        <div class="guide-card p-4 h-100">
          <h2 class="h5">Pedidos</h2>
          <p class="text-secondary">Consulta y actualización de pedidos.</p>
          <a href="{{ route('admin.orders.index') }}" class="btn-primary mt-3">
            Ver pedidos
          </a>
        </div>
      </div>

      <div class="col-md-6 col-xl-3">
        <div class="guide-card p-4 h-100">
          <h2 class="h5">Usuarios</h2>
          <p class="text-secondary">Editar usuarios y controlar roles.</p>
          <a href="{{ route('admin.users.index') }}" class="btn-primary mt-3">
            Gestionar
          </a>
        </div>
      </div>

      <div class="col-md-6 col-xl-3">
        <div class="guide-card p-4 h-100">
          <h2 class="h5">Favoritos</h2>
          <p class="text-secondary">Consulta qué guías son más guardadas por los usuarios.</p>
          <a href="{{ route('admin.favorites.index') }}" class="btn-primary mt-3">
            Ver estadísticas
          </a>
        </div>
      </div>

    </div>
  </div>
</section>
</main>
@endsection