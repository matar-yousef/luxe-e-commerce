<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>@yield('title', 'Luxe Shop - Premium Selection')</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @stack('scripts')
    <style>
        .navbar-collapse {
            justify-content: center;
        }

        .card-img-top {
            aspect-ratio: 1 / 1;
            width: 100%;
            object-fit: contain;
            background-color: #ffffff;
            padding: 15px;
        }

        html,
        body {
            height: 100%;
        }
    </style>
</head>


<body class="d-flex flex-column min-vh-100">

    @include('front_assets.partials.navbar')

    <main class="flex-grow-1">
        @yield('content')
    </main>

    @include('front_assets.partials.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="{{ asset('js/notifications.js') }}"></script>

    <script>
        @if(session('success'))
        showNotification('success', 'Operation successfully', "{{ session('success') }}");
        @endif

        @if(session('error'))
        showNotification('error', 'Error!', "{{ session('error') }}");
        @endif
    </script>

    @stack('scripts')
</body>

</html>