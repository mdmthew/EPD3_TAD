@extends('layouts.app')

@section('title', 'Editar producto')

@section('content')
<main>
<section class="guides-section py-5">
  <div class="container">

    <div class="section-header mb-4">
      <span class="section-subtitle">ADMIN</span>
      <h1 class="section-title">Editar producto</h1>
    </div>

    <form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data" class="guide-card p-4">
      @csrf
      @method('PUT')

      @include('admin.products.partials.form', ['product' => $product])

      <button type="submit" class="btn-primary mt-4">
        Guardar cambios
      </button>
    </form>

  </div>
</section>
</main>
@endsection