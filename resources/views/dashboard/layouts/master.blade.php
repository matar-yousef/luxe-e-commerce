<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Luxe Shop | Dashboard</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('dashboard-dist/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard-dist/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard-dist/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">

    <script src="{{ asset('dashboard-dist/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('dashboard-dist/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        @include('dashboard.layouts.navbar')
        @include('dashboard.layouts.sidebar')

        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">Luxe Dashboard</h1>
                        </div>
                    </div>
                </div>
            </div>

            @yield('content')
        </div>

        @include('dashboard.layouts.footer')

    </div>



    <script src="{{asset('dashboard/plugins/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('dashboard/dist/js/adminlte.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @stack('js')
</body>

</html>