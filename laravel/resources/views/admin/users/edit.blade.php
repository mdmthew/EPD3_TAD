@extends('layouts.app')

@section('title', 'Editar usuario')

@section('content')
<main>
<section class="guides-section py-5">
  <div class="container">

    <div class="section-header mb-4">
      <span class="section-subtitle">ADMIN</span>
      <h1 class="section-title">Editar usuario</h1>
    </div>

    <form method="POST" action="{{ route('admin.users.update', $user) }}" class="guide-card p-4">
      @csrf
      @method('PUT')

      @include('admin.users.partials.form', ['user' => $user])

      <button type="submit" class="btn-primary mt-4">
        Guardar cambios
      </button>
    </form>

  </div>
</section>
</main>
@endsection