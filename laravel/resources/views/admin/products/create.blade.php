@extends('layouts.app')

@section('title', 'Nuevo producto')

@section('content')
<main>
<section class="guides-section py-5">
  <div class="container">

    <div class="section-header mb-4">
      <span class="section-subtitle">ADMIN</span>
      <h1 class="section-title">Nuevo producto</h1>
    </div>

    <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data" class="guide-card p-4">
      @csrf

      @include('admin.products.partials.form', ['product' => null])

      <button type="submit" class="btn-primary mt-4">
        Crear producto
      </button>
    </form>

  </div>
</section>
</main>
@endsection