@extends('front_assets.partials.master')

@section('title', $product->name . ' - Luxe Shop')

@section('content')
<section class="py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="row gx-4 gx-lg-5 align-items-center">

            <div class="col-md-6">
                @php
                $mainImage = $product->images->first()
                ? asset('images/full/' . $product->images->first()->url)
                : asset('images/placeholder.jpg');
                @endphp

                <div class="card shadow-sm border-0 mb-3">
                    <img class="card-img-top mb-5 mb-md-0 rounded"
                        src="{{ $mainImage }}"
                        alt="{{ $product->name }}"
                        style="object-fit: contain; max-height: 550px; padding: 25px;">
                </div>

                @if($product->images->count() > 1)
                <div class="d-flex gap-2 overflow-auto pb-2">
                    @foreach($product->images as $img)
                    <img src="{{ asset('images/100_100/' . $img->url) }}"
                        class="img-thumbnail"
                        alt="Thumbnail"
                        style="width: 85px; height: 85px; cursor: pointer; object-fit: cover;">
                    @endforeach
                </div>
                @endif
            </div>

            <div class="col-md-6">
                <div class="small mb-1 text-uppercase tracking-wider text-muted">SKU: #{{ str_pad($product->id, 5, '0', STR_PAD_LEFT) }}</div>
                <h1 class="display-5 fw-bolder">{{ $product->name }}</h1>

                <div class="fs-4 mb-4">
                    <span class="text-dark fw-bold">${{ number_format($product->price, 2) }}</span>
                </div>

                <h5 class="fw-bold mb-3">Description</h5>
                <p class="lead text-muted mb-5" style="font-size: 1.1rem; line-height: 1.7;">
                    {{ $product->description ?? 'No description available for this product.' }}
                </p>


                <form action="{{ route('cart.add', $product->id) }}" method="POST" class="d-flex align-items-end mb-4">
                    @csrf
                    <div class="me-3">
                        <label for="quantity" class="small text-muted mb-1 d-block">Quantity</label>
                        <input class="form-control text-center px-2"
                            id="quantity"
                            name="quantity"
                            type="number"
                            value="1"
                            min="1"
                            max="{{ $product->stock }}"
                            style="width: 70px; height: 56px; border-radius: 10px;" />
                    </div>

                    <button type="button" class="btn btn-dark add-to-cart-btn px-5 flex-grow-1" style="height: 56px; border-radius: 30px; font-weight: 600;">
                        <i class="bi-cart-fill me-2"></i>
                        Add to Cart
                    </button>
                </form>

                <hr class="my-5">

                <div class="row small text-muted">
                    <div class="col-6">
                        <strong>Category:</strong>
                        {{ $product->category->name ?? 'Uncategorized' }}
                    </div>
                    <div class="col-6">
                        <strong>Availability:</strong>
                        <span class="text-success">In Stock</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-light">
    <div class="container px-4 px-lg-5 mt-5">
        <h2 class="fw-bolder mb-4">Related Products</h2>
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">

            @forelse($relatedProducts as $related)
            <div class="col mb-5">
                @include('front_assets.partials.product_card', [
                'id' => $related->id,
                'name' => $related->name,
                'price' => $related->price,
                'image' => $related->images->first()
                ? asset('images/full/' . $related->images->first()->url)
                : asset('images/placeholder.jpg'),
                'badge' => null
                ])
            </div>
            @empty
            <div class="col-12 text-center text-muted">
                <p>No related products found in this category.</p>
            </div>
            @endforelse

        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $(document).on('click', '.add-to-cart-btn', function(e) {
            e.preventDefault();

            let button = $(this);
            let url = button.closest('form').attr('action');
            let qty = $('#quantity').val();

            button.prop('disabled', true).html('<i class="bi-hourglass-split"></i> Adding...');

            $.ajax({
                url: url,
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    quantity: qty
                },
                success: function(response) {
                    $('.cart-count').text(response.cart_count);

                    showNotification('success', 'Operation successfully', response.message);

                    button.prop('disabled', false).html('<i class="bi-cart-fill me-2"></i> Add to Cart');
                },
                error: function(xhr) {
                    let errorMessage = xhr.responseJSON?.message || 'Something went wrong!';

                    showNotification('error', 'Sorry!', errorMessage);

                    button.prop('disabled', false).html('<i class="bi-cart-fill me-2"></i> Add to Cart');
                }
            });
        });
    });
</script>
@endpush