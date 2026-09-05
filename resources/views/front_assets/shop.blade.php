@extends('front_assets.partials.master')

@section('title', 'Shop - Luxe Shop')

@section('content')
<header class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5 text-center text-white">
        <h1 class="display-4 fw-bolder">Elevate Your Style</h1>
        <p class="lead fw-normal text-white-50 mb-0">Exclusive Collection 2026</p>
    </div>
</header>

<section class="py-5 bg-light">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            @foreach($products as $product)
            <div class="col mb-5">
                @php
                $firstImage = $product->images->first();

                $imageName = $firstImage ? $firstImage->url : 'placeholder.jpg';
                $imagePath = asset('images/full/' . $imageName);
                @endphp

                @include('front_assets.partials.product_card', [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'image' => $imagePath,
                'badge' => null
                ])
            </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center">
            {{ $products->links() }}
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
            let form = button.closest('form');
            let url = form.attr('action');

            button.prop('disabled', true);

            $.ajax({
                url: url,
                method: "POST",
                data: form.serialize(),
                success: function(response) {
                    $('.cart-count').text(response.cart_count);

                    showNotification('success', 'Operation successfully', response.message);

                    button.prop('disabled', false);
                },
                error: function(xhr) {
                    let errorMessage = xhr.responseJSON?.message || 'Something went wrong!';

                    showNotification('error', 'Sorry!', errorMessage);

                    button.prop('disabled', false);
                }
            });
        });
    });
</script>
@endpush