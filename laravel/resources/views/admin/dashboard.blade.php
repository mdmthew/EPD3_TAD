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
      <div class="col-md-4"><div class="guide-card p-4"><h2 class="h5">Productos</h2><a href="{{ url('/admin/productos') }}" class="btn-primary mt-3">Gestionar</a></div></div>
      <div class="col-md-4"><div class="guide-card p-4"><h2 class="h5">Pedidos</h2><a href="{{ url('/admin/pedidos') }}" class="btn-primary mt-3">Ver pedidos</a></div></div>
      <div class="col-md-4"><div class="guide-card p-4"><h2 class="h5">Usuarios</h2><p class="text-secondary mb-0">Control de acceso usuario/admin.</p></div></div>
    </div>
  </div>
</section>
</main>
@endsection