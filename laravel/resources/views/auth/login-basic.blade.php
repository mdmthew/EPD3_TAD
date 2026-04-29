@extends('layouts.app')

@section('title', 'Iniciar sesión')

@section('content')

<main>
  <section class="guides-section py-5">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-8">

          <div class="section-header text-center mb-4">
            <span class="section-subtitle">ACCESO</span>
            <h1 class="section-title">Iniciar sesión</h1>
            <p class="section-description">Accede para comprar guías y consultar tus pedidos.</p>
          </div>

          <form method="POST" action="{{ route('login') }}" class="guide-card p-4">
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

            <div class="mb-3">
              <label for="password" class="form-label">Contraseña</label>
              <input
                type="password"
                id="password"
                name="password"
                class="form-control"
                required
              >

              @error('password')
                <div class="text-danger small mt-2">{{ $message }}</div>
              @enderror
            </div>

            <div class="d-flex justify-content-between align-items-center mb-4">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                <label class="form-check-label" for="remember">
                  Recordarme
                </label>
              </div>

              <a href="{{ route('password.request') }}" class="guide-details-link">
                ¿Olvidaste tu contraseña?
              </a>
            </div>

            <button type="submit" class="btn-primary w-100 justify-content-center">
              <span>Entrar</span>
              <i class="fas fa-arrow-right"></i>
            </button>

            <div class="text-center mt-4">
              <p class="text-secondary mb-0">
                ¿No tienes cuenta?
                <a href="{{ route('register') }}" class="guide-details-link">Regístrate</a>
              </p>
            </div>

          </form>

        </div>
      </div>
    </div>
  </section>
</main>

@endsection