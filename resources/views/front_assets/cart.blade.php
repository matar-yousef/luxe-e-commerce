@extends('front_assets.partials.master')

@section('content')
<div class="container py-5" style="min-height: 60vh;">
    <div class="row">
        <div class="col-12">
            <h2 class="display-6 fw-bold mb-4 border-bottom pb-3">Shopping Cart</h2>
        </div>
    </div>

    @if(session('cart') && count(session('cart')) > 0)
    <div class="row mt-4">
        <div class="col-lg-8">
            <div class="table-responsive shadow-sm rounded border">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light text-uppercase small fw-bold">
                        <tr>
                            <th class="ps-4 py-3">Product</th>
                            <th class="py-3">Price</th>
                            <th class="py-3">Quantity</th>
                            <th class="py-3">Subtotal</th>
                            <th class="py-3"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $total = 0 @endphp
                        @foreach(session('cart') as $id => $details)
                        @php $total += $details['price'] * $details['quantity'] @endphp
                        <tr>
                            <td class="ps-4">
                                <div class="d-flex align-items-center">
                                    <img src="{{ asset('images/100_100/' . $details['image']) }}"
                                        alt="{{ $details['name'] }}"
                                        class="rounded border"
                                        style="width: 70px; height: 70px; object-fit: cover;">
                                    <div class="ms-3">
                                        <h6 class="mb-0 fw-bold">{{ $details['name'] }}</h6>
                                    </div>
                                </div>
                            </td>
                            <td class="fw-medium">${{ number_format($details['price'], 2) }}</td>
                            <td>
                                <span class="badge bg-light text-dark border px-3 py-2">{{ $details['quantity'] }}</span>
                            </td>
                            <td class="fw-bold text-dark">${{ number_format($details['price'] * $details['quantity'], 2) }}</td>
                            <td class="text-end pe-4">
                                <form action="{{ route('cart.remove', $id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm text-danger border-0 p-0" onclick="return confirm('Are you sure?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm p-4 bg-light">
                <h5 class="fw-bold mb-4">Order Summary</h5>
                <div class="d-flex justify-content-between mb-2">
                    <span>Subtotal</span>
                    <span>${{ number_format($total, 2) }}</span>
                </div>
                <div class="d-flex justify-content-between mb-4">
                    <span>Shipping</span>
                    <span class="text-success">Free</span>
                </div>
                <hr>
                <div class="d-flex justify-content-between mb-4">
                    <span class="h5 fw-bold">Total</span>
                    <span class="h5 fw-bold text-primary">${{ number_format($total, 2) }}</span>
                </div>
                <a href="{{ route('checkout.index') }}" class="btn btn-dark w-100 py-3 rounded-pill fw-bold">
                    Proceed to Checkout <i class="bi bi-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
    </div>
    @else
    <div class="text-center py-5">
        <i class="bi bi-cart-x display-1 text-muted"></i>
        <h4 class="mt-3 text-muted">Your cart is empty</h4>
        <a href="{{ route('shop.index') }}" class="btn btn-outline-dark mt-4 px-5 rounded-pill">Start Shopping</a>
    </div>
    @endif
</div>
@endsection