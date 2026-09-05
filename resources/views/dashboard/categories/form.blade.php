<div class="form-group">
    <label for="name">Category Name</label>
    <input type="text" name="name"
        class="form-control @error('name') is-invalid @enderror"
        id="name"
        placeholder="Enter Category Name"
        value="{{ old('name', $category->name ?? '') }}">
    @error('name')
    <span class="invalid-feedback">{{ $message }}</span>
    @enderror
</div>

<div class="form-group">
    <label for="description">Description</label>
    <textarea name="description"
        class="form-control @error('description') is-invalid @enderror"
        rows="4"
        placeholder="Enter Category Description">{{ old('description', $category->description ?? '') }}</textarea>
    @error('description')
    <span class="invalid-feedback">{{ $message }}</span>
    @enderror
</div>