<div class="row g-3">

  <div class="col-md-6">
    <label class="form-label">Nombre</label>
    <input
      type="text"
      name="name"
      class="form-control bg-dark text-light border-secondary rounded-3"
      value="{{ old('name', $category->name ?? '') }}"
      required
    >

    @error('name')
      <small class="text-danger">{{ $message }}</small>
    @enderror
  </div>

  <div class="col-md-6">
    <label class="form-label">Grupo</label>
    <select name="category_group_id" class="form-select bg-dark text-light border-secondary rounded-3" required>
      <option value="">Selecciona un grupo</option>

      @foreach($groups as $group)
        <option
          value="{{ $group->id }}"
          {{ old('category_group_id', $category->category_group_id ?? '') == $group->id ? 'selected' : '' }}
        >
          {{ $group->name }}
        </option>
      @endforeach
    </select>

    @error('category_group_id')
      <small class="text-danger">{{ $message }}</small>
    @enderror
  </div>

  <div class="col-md-6">
    <label class="form-label">Slug</label>
    <input
      type="text"
      name="slug"
      class="form-control bg-dark text-light border-secondary rounded-3"
      value="{{ old('slug', $category->slug ?? '') }}"
      placeholder="Se genera automáticamente si lo dejas vacío"
    >

    @error('slug')
      <small class="text-danger">{{ $message }}</small>
    @enderror
  </div>

</div>