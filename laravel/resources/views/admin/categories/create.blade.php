@extends('layouts.app')

@section('title', 'Nueva categoría')

@section('content')
<main>
<section class="guides-section py-5">
  <div class="container">

    <div class="section-header mb-4">
      <span class="section-subtitle">ADMIN</span>
      <h1 class="section-title">Nueva categoría</h1>
    </div>

    <form method="POST" action="{{ route('admin.categories.store') }}" class="guide-card p-4">
      @csrf

      @include('admin.categories.partials.form', ['category' => null])

      <button type="submit" class="btn-primary mt-4">
        Crear categoría
      </button>
    </form>

  </div>
</section>
</main>
@endsection