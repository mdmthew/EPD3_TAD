<div class="row g-3">

  <div class="col-md-6">
    <label class="form-label">Nombre</label>
    <input
      type="text"
      name="name"
      class="form-control bg-dark text-light border-secondary rounded-3"
      value="{{ old('name', $user->name ?? '') }}"
      required
    >

    @error('name')
      <small class="text-danger">{{ $message }}</small>
    @enderror
  </div>

  <div class="col-md-6">
    <label class="form-label">Email</label>
    <input
      type="email"
      name="email"
      class="form-control bg-dark text-light border-secondary rounded-3"
      value="{{ old('email', $user->email ?? '') }}"
      required
    >

    @error('email')
      <small class="text-danger">{{ $message }}</small>
    @enderror
  </div>

  <div class="col-md-6">
    <label class="form-label">Rol</label>

    @if($user->role === 'admin')
      <input type="hidden" name="role" value="admin">

      <input
        type="text"
        class="form-select bg-dark text-light border-secondary rounded-3"
        value="Administrador"
        disabled
      >

      <small class="text-secondary">
        Los usuarios administradores no pueden cambiar de rol desde este panel.
      </small>
    @else
      <select name="role" class="form-select bg-dark text-light border-secondary rounded-3" required>
        <option value="user" {{ old('role', $user->role ?? '') === 'user' ? 'selected' : '' }}>
          Usuario
        </option>
        <option value="admin" {{ old('role', $user->role ?? '') === 'admin' ? 'selected' : '' }}>
          Administrador
        </option>
      </select>
    @endif

    @error('role')
      <small class="text-danger">{{ $message }}</small>
    @enderror
  </div>

</div>