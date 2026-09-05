<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="name">Product Name</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name', $product->name ?? '') }}" placeholder="Enter name">
            @error('name') <span class="invalid-feedback">{{ $message }}</span> @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="price">Price ($)</label>
            <input type="number" step="0.01" name="price" class="form-control @error('price') is-invalid @enderror"
                value="{{ old('price', $product->price ?? '') }}" placeholder="0.00">
            @error('price') <span class="invalid-feedback">{{ $message }}</span> @enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="stock">Stock</label>
            <input type="number" name="stock" class="form-control @error('stock') is-invalid @enderror"
                value="{{ old('stock', $product->stock ?? '') }}" placeholder="0">
            @error('stock') <span class="invalid-feedback">{{ $message }}</span> @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-3">
            <label for="category_id" class="fw-bold">Category</label>
            <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror">
                <option value="">-- Select Category --</option>
                @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="image" class="fw-bold">Product Image</label>
            <div class="d-flex align-items-start">
                @if(isset($product) && $product->images->isNotEmpty())
                <div class="mr-3">
                    <img src="{{ asset('images/full/' . $product->images->first()->url) }}"
                        class="img-thumbnail shadow-sm"
                        style="width: 80px; height: 80px; object-fit: cover; border-radius: 8px;">
                    <small class="d-block text-center text-muted">Current</small>
                </div>
                @endif

                <div class="flex-grow-1">
                    <input type="file" name="image" class="form-control-file @error('image') is-invalid @enderror">
                    <small class="text-muted mt-2 d-block">
                        @if(isset($product))
                        Select a new image to replace the current one
                        @else
                        Please upload a main image for the product
                        @endif
                    </small>
                </div>
            </div>
            @error('image') <span class="text-danger small">{{ $message }}</span> @enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control @error('description') is-invalid @enderror"
                rows="3" placeholder="Enter product description...">{{ old('description', $product->description ?? '') }}</textarea>
            @error('description') <span class="invalid-feedback">{{ $message }}</span> @enderror
        </div>
    </div>
</div>