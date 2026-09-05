<div class="card h-100 shadow-sm border-0 product-item">
    @php $productUrl = route('shop.show', $id); @endphp

    @if(isset($badge))
    <div class="badge {{ $badgeColor ?? 'bg-dark' }} text-white position-absolute" style="top: 0.5rem; right: 0.5rem; z-index: 10;">{{ $badge }}</div>
    @endif

    <a href="{{ $productUrl }}" class="text-decoration-none">
        <div class="card-img-container">
            <img class="card-img-top" src="{{ $image }}" alt="{{ $name }}" />
        </div>
    </a>

    <div class="card-body p-4 text-center d-flex flex-column">
        <div class="flex-grow-1">
            <a href="{{ $productUrl }}" class="text-decoration-none text-dark">
                <h5 class="fw-bolder text-truncate">{{ $name }}</h5>
            </a>
            <p class="text-muted small">${{ number_format($price, 2) }}</p>
        </div>

        <div class="d-grid gap-2 mt-auto">
            @auth
            <form action="{{ route('cart.add', $id) }}" method="POST" class="w-100 m-0">
                @csrf
                <input type="hidden" name="quantity" value="1">
                <button type="button" class="btn btn-dark w-100 py-2 add-to-cart-btn">
                    <i class="bi-cart-plus me-1"></i> Add to Cart
                </button>
            </form>
            @else
            <a href="{{ route('login') }}" class="btn btn-dark w-100 py-2">
                <i class="bi-cart-plus me-1"></i> Add to Cart
            </a>
            @endauth

            <a href="{{ $productUrl }}" class="btn btn-outline-dark w-100 py-2">
                View Details
            </a>
        </div>
    </div>
</div>