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
        <h2 class="h4 mb-0">Guías publicadas</h2>
        <button class="btn-primary">Nuevo producto</button>
      </div>

      <table class="table table-dark table-hover align-middle">
        <thead>
          <tr>
            <th>Producto</th>
            <th>Precio</th>
            <th>Estado</th>
            <th class="text-end">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Guía Esencial de Bali</td>
            <td>2€</td>
            <td><span class="guide-badge">Activa</span></td>
            <td class="text-end">
              <button class="btn btn-sm btn-warning">Editar</button>
              <button class="btn btn-sm btn-danger">Eliminar</button>
            </td>
          </tr>
          <tr>
            <td>Guía Completa de Italia</td>
            <td>2€</td>
            <td><span class="guide-badge">Activa</span></td>
            <td class="text-end">
              <button class="btn btn-sm btn-warning">Editar</button>
              <button class="btn btn-sm btn-danger">Eliminar</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</section>
</main>
@endsection