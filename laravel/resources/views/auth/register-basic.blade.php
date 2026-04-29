@extends('layouts.app')

@section('title', 'Registro')

@section('content')

<main>
  <section class="guides-section py-5">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-8">

          <div class="section-header text-center mb-4">
            <span class="section-subtitle">CUENTA NUEVA</span>
            <h1 class="section-title">Crear cuenta</h1>
            <p class="section-description">Regístrate para guardar favoritos, comprar guías y ver tus pedidos.</p>
          </div>

          <form method="POST" action="{{ route('register') }}" class="guide-card p-4">
            @csrf

            <div class="mb-3">
              <label for="name" class="form-label">Nombre</label>
              <input
                type="text"
                id="name"
                name="name"
                class="form-control"
                value="{{ old('name') }}"
                required
                autofocus
              >

              @error('name')
                <div class="text-danger small mt-2">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-3">
              <label for="email" class="form-label">Correo electrónico</label>
              <input
                type="email"
                id="email"
                name="email"
                class="form-control"
                value="{{ old('email') }}"
                required
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

            <div class="mb-4">
              <label for="password_confirmation" class="form-label">Confirmar contraseña</label>
              <input
                type="password"
                id="password_confirmation"
                name="password_confirmation"
                class="form-control"
                required
              >
            </div>

            <button type="submit" class="btn-primary w-100 justify-content-center">
              <span>Crear cuenta</span>
              <i class="fas fa-user-plus"></i>
            </button>

            <div class="text-center mt-4">
              <p class="text-secondary mb-0">
                ¿Ya tienes cuenta?
                <a href="{{ route('login') }}" class="guide-details-link">Inicia sesión</a>
              </p>
            </div>

          </form>

        </div>
      </div>
    </div>
  </section>
</main>

@endsection