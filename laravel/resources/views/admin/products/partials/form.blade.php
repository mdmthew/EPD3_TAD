<div class="row g-3">

  <div class="col-md-6">
    <label class="form-label">Nombre</label>
    <input
      type="text"
      name="name"
      class="form-control bg-dark text-light border-secondary rounded-3"
      value="{{ old('name', $product->name ?? '') }}"
      required
    >
  </div>

  <div class="col-md-3">
    <label class="form-label">Precio guía</label>
    <input
      type="number"
      step="0.01"
      name="price"
      class="form-control bg-dark text-light border-secondary rounded-3"
      value="{{ old('price', $product->price ?? '') }}"
      required
    >
  </div>

  <div class="col-md-3">
    <label class="form-label">Stock</label>
    <input
      type="number"
      name="stock"
      class="form-control bg-dark text-light border-secondary rounded-3"
      value="{{ old('stock', $product->stock ?? 10) }}"
      required
    >
  </div>

  <div class="col-12">
    <label class="form-label">Descripción</label>
    <textarea name="description" class="form-control bg-dark text-light border-secondary rounded-3" rows="4">{{ old('description', $product->description ?? '') }}</textarea>
  </div>

  <div class="col-md-6">
    <label class="form-label">Imagen</label>
    <input type="file" name="image" class="form-control bg-dark text-light border-secondary rounded-3">

    @if($product && $product->image)
      <img src="{{ asset($product->image) }}" class="img-fluid rounded mt-3" style="max-height:140px">
    @endif
  </div>

  <div class="col-md-3">
    <label class="form-label">Precio viaje</label>
    <select name="travel_price_level" class="form-select bg-dark text-light border-secondary rounded-3">
      <option value="1" {{ old('travel_price_level', $product->travel_price_level ?? 1) == 1 ? 'selected' : '' }}>$</option>
      <option value="2" {{ old('travel_price_level', $product->travel_price_level ?? 1) == 2 ? 'selected' : '' }}>$$</option>
      <option value="3" {{ old('travel_price_level', $product->travel_price_level ?? 1) == 3 ? 'selected' : '' }}>$$$</option>
    </select>
  </div>

  <div class="col-md-3 d-flex align-items-end">
    <div class="form-check">
      <input
        class="form-check-input"
        type="checkbox"
        name="is_active"
        value="1"
        id="is_active"
        {{ old('is_active', $product->is_active ?? true) ? 'checked' : '' }}
      >
      <label class="form-check-label" for="is_active">
        Visible en la web
      </label>
    </div>
  </div>

  <div class="col-12">
    <label class="form-label">Categorías</label>

    @foreach($categories->groupBy(fn($category) => $category->group->name ?? 'Sin grupo') as $groupName => $groupCategories)
        <div class="mb-4">
            <h3 class="h6 text-warning mb-3">
                {{ $groupName }}
            </h3>

            <div class="row g-2">
                @foreach($groupCategories as $category)
                    <div class="col-md-3">
                        <div class="form-check">
                            <input
                                class="form-check-input"
                                type="checkbox"
                                name="categories[]"
                                value="{{ $category->id }}"
                                id="category_{{ $category->id }}"
                                {{ $product && $product->categories->contains($category->id) ? 'checked' : '' }}
                            >

                            <label class="form-check-label" for="category_{{ $category->id }}">
                                {{ $category->name }}
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach
  </div>

</div>