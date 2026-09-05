@use('App\Enums\UserRole')

<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand fw-bold text-uppercase" href="{{ route('shop.index') }}">LUXE SHOP</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0 fw-semibold">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('shop.index') ? 'active fw-bold' : '' }}"
                        href="{{ route('shop.index') }}">
                        Home
                    </a>
                </li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('about') ? 'active fw-bold' : '' }}" href="{{ route('about') }}">About</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->routeIs('shop.*') || request()->routeIs('product.show') ? 'active fw-bold' : '' }}"
                        href="#"
                        id="shopDropdown"
                        role="button"
                        data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Shop
                    </a>
                    <ul class="dropdown-menu border-0 shadow-sm" aria-labelledby="shopDropdown">
                        <li>
                            <a class="dropdown-item {{ request()->routeIs('shop.index') ? 'bg-light' : '' }}"
                                href="{{ route('shop.index') }}">
                                All Products
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item {{ request()->routeIs('shop.new') ? 'bg-light fw-bold' : '' }}"
                                href="{{ route('shop.new') }}">
                                New Arrivals
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>

            <div class="d-flex align-items-center">
                <a href="{{ route('cart.index') }}" class="btn btn-outline-dark rounded-pill px-3 me-3" type="button">
                    <i class="bi-cart-fill me-1"></i>
                    <span class="d-none d-md-inline">Cart</span>
                    <span class="badge bg-dark text-white ms-1 rounded-pill cart-count">
                        {{ session()->has('cart') ? count(session()->get('cart')) : 0 }}
                    </span>
                </a>
                @auth
                <div class="dropdown">
                    <button class="btn btn-link text-dark text-decoration-none dropdown-toggle p-0" type="button" id="userMenu" data-bs-toggle="dropdown">
                        <i class="bi-person-circle fs-5"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end border-0 shadow mt-2">
                        <li class="px-3 py-1 mt-1 small fw-bold text-muted text-uppercase">Welcome, {{ auth()->user()->name }}</li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        @if(auth()->user()->role === UserRole::ADMIN || auth()->user()->role === UserRole::EDITOR)
                        <li><a class="dropdown-item" href="{{ route('dashboard.index') }}"><i class="bi-speedometer2 me-2"></i> Dashboard</a></li>
                        @endif

                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger">
                                    <i class="bi-box-arrow-right me-2"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
                @else
                <a href="{{ route('login') }}" class="btn btn-sm btn-link text-dark text-decoration-none me-2">Login</a>
                <a href="{{ route('register') }}" class="btn btn-sm btn-dark rounded-pill px-3">Join Now</a>
                @endauth
            </div>
        </div>
    </div>
</nav>