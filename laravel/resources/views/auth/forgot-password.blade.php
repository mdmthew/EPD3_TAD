@extends('layouts.app')

@section('title', 'Recuperar contraseña')

@section('content')

<main>
  <section class="guides-section py-5">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-8">

          <div class="section-header text-center mb-4">
            <span class="section-subtitle">RECUPERACIÓN</span>
            <h1 class="section-title">¿Olvidaste tu contraseña?</h1>
            <p class="section-description">
              Introduce tu correo y te enviaremos un enlace para restablecerla.
            </p>
          </div>

          @if (session('status'))
            <div class="alert alert-success">
              {{ session('status') }}
            </div>
          @endif

          <form method="POST" action="{{ route('password.email') }}" class="guide-card p-4">
            @csrf

            <div class="mb-3">
              <label for="email" class="form-label">Correo electrónico</label>

              <input
                type="email"
                id="email"
                name="email"
                class="form-control"
                value="{{ old('email') }}"
                required
                autofocus
              >

              @error('email')
                <div class="text-danger small mt-2">{{ $message }}</div>
              @enderror
            </div>

            <button type="submit" class="btn-primary w-100 justify-content-center">
              <span>Enviar enlace</span>
              <i class="fas fa-envelope"></i>
            </button>

            <div class="text-center mt-4">
              <a href="{{ route('login') }}" class="guide-details-link">
                Volver al login
              </a>
            </div>

          </form>

        </div>
      </div>
    </div>
  </section>
</main>

@endsection