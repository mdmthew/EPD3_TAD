@extends('layouts.app')

@section('title', 'Admin usuarios')

@section('content')
<main>
<section class="guides-section py-5">
  <div class="container">

    <div class="section-header mb-4">
      <span class="section-subtitle">ADMIN</span>
      <h1 class="section-title">Gestión de usuarios</h1>
    </div>

    @if (session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
    @endif

    @if (session('error'))
      <div class="alert alert-danger">
        {{ session('error') }}
      </div>
    @endif

    <div class="guide-card p-4">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h4 mb-0">Usuarios</h2>
      </div>

      <table class="table table-dark table-hover align-middle">
        <thead>
          <tr>
            <th>Nombre</th>
            <th>Email</th>
            <th>Rol</th>
            <th>Fecha registro</th>
            <th class="text-end">Acciones</th>
          </tr>
        </thead>

        <tbody>
          @foreach($users as $user)
            <tr>
              <td>{{ $user->name }}</td>
              <td>{{ $user->email }}</td>
              <td>
                @if($user->role === 'admin')
                  <span class="guide-badge">Admin</span>
                @else
                  <span class="badge bg-secondary">Usuario</span>
                @endif
              </td>
              <td>{{ $user->created_at->format('d/m/Y H:i') }}</td>
              <td class="text-end">
                <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-warning">
                  Editar
                </a>

                @if($user->role !== 'admin')
                  <form method="POST" action="{{ route('admin.users.destroy', $user) }}" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger">
                      Eliminar
                    </button>
                  </form>
                @else
                  <button class="btn btn-sm btn-secondary" disabled>
                    Protegido
                  </button>
                @endif
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>

  </div>
</section>
</main>
@endsection