@extends('front_assets.partials.master')

@section('content')
<div class="container py-5">
    <div class="row align-items-center">
        <div class="col-md-6">
            <h1 class="display-4 fw-bold mb-4">About Luxe Shop</h1>
            <p class="lead text-muted">
                Welcome to Luxe Shop, where style meets technology. Established in 2026, we are dedicated to providing a premium shopping experience.
            </p>
            <p>
                Our mission is to curate an exclusive collection of high-quality products, from the latest electronics like the <strong>HP Pavilion</strong> to the finest fashion pieces like our <strong>Urban Street Jackets</strong>.
            </p>
            <div class="mt-4">
                <span class="badge bg-dark p-2">Premium Quality</span>
                <span class="badge bg-dark p-2">Fast Delivery</span>
                <span class="badge bg-dark p-2">Secure Payment</span>
            </div>
        </div>
        <div class="col-md-6 text-center">
            <img src="{{ asset('images/about-luxe.png') }}" alt="Luxe Shop Interior" class="img-fluid rounded shadow-lg">
        </div>
    </div>

    <hr class="my-5">

    <div class="row text-center">
        <div class="col-md-4">
            <h3>Our Vision</h3>
            <p>To become the leading destination for luxury and performance products globally.</p>
        </div>
        <div class="col-md-4">
            <h3>Innovation</h3>
            <p>Utilizing modern technologies like <strong>Laravel 11</strong> to ensure a seamless and secure user experience.</p>
        </div>
        <div class="col-md-4">
            <h3>Support</h3>
            <p>Our team is available 24/7 to assist you with any inquiries regarding your orders.</p>
        </div>
    </div>
</div>
@endsection