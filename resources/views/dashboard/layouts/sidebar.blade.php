<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <a href="{{ url('/dashboard') }}" class="brand-link">
    <img src="{{asset('dashboard-dist/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Luxe Shop</span>
  </a>

  <div class="sidebar">
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{asset('dashboard-dist/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">{{ Auth::user()->name }}</a>
      </div>
    </div>

    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a href="{{ route('dashboard.index') }}" class="nav-link {{ request()->routeIs('dashboard.index') ? 'active' : '' }}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ route('dashboard.products.index') }}"
            class="nav-link {{ request()->routeIs('dashboard.products.*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-shopping-bag"></i>
            <p>Products</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('dashboard.categories.index') }}" class="nav-link {{ request()->routeIs('dashboard.categories.*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-list"></i>
            <p>Categories</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('dashboard.orders.index') }}"
            class="nav-link {{ request()->routeIs('dashboard.orders.*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-shopping-cart"></i>
            <p>Orders</p>
          </a>
        </li>
        <li class="nav-item mt-5 pt-5 border-top">
          <form method="POST" action="{{ route('logout') }}" id="logout-form">
            @csrf
            <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>Logout</p>
            </a>
          </form>
        </li>
      </ul>
    </nav>
  </div>
</aside>