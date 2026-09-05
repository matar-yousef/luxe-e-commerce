@extends('front_assets.partials.master')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-dark text-white">
                    <h4 class="mb-0">Payment & Shipping Details</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('checkout.store') }}" method="POST">
                        @csrf
                        <h5 class="mb-3 text-muted">Shipping Information</h5>
                        <div class="mb-3">
                            <label class="form-label">Phone Number</label>
                            <input type="text" name="phone" class="form-control" placeholder="05xxxxxxxx" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Shipping Address</label>
                            <textarea name="address" class="form-control" rows="2" placeholder="City, Street, Building..." required></textarea>
                        </div>

                        <hr>

                        <h5 class="mb-3 text-muted">Card Information</h5>
                        <div class="mb-3">
                            <label class="form-label">Cardholder Name</label>
                            <input type="text" class="form-control" placeholder="Yousef Matar">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Card Number</label>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="0000 0000 0000 0000">
                                <span class="input-group-text"><i class="bi bi-credit-card"></i></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Expiry Date</label>
                                <input type="text" class="form-control" placeholder="MM/YY">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">CVV</label>
                                <input type="text" class="form-control" placeholder="123">
                            </div>
                        </div>

                        <hr>
                        <button type="submit" class="btn btn-primary w-100 btn-lg">Place Order & Pay Now</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection