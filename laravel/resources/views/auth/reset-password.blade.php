@extends('layouts.app')

@section('title', 'Nueva contraseña')

@section('content')

<main>
  <section class="guides-section py-5">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-8">

          <div class="section-header text-center mb-4">
            <span class="section-subtitle">SEGURIDAD</span>
            <h1 class="section-title">Crear nueva contraseña</h1>
            <p class="section-description">
              Introduce tu nueva contraseña para recuperar el acceso a tu cuenta.
            </p>
          </div>

          <form method="POST" action="{{ route('password.update') }}" class="guide-card p-4">
            @csrf

            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div class="mb-3">
              <label for="email" class="form-label">Correo electrónico</label>

              <input
                type="email"
                id="email"
                name="email"
                class="form-control"
                value="{{ old('email', $request->email) }}"
                required
                autofocus
              >

              @error('email')
                <div class="text-danger small mt-2">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-3">
              <label for="password" class="form-label">Nueva contraseña</label>

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
              <span>Restablecer contraseña</span>
              <i class="fas fa-key"></i>
            </button>

          </form>

        </div>
      </div>
    </div>
  </section>
</main>

@endsection