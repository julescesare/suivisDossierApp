<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Voler Admin Dashboard</title>

    <link rel="stylesheet" href="{{ asset('admin/assets/css/bootstrap.css') }}">

    <link rel="stylesheet" href="{{ asset('admin/assets/vendors/chartjs/Chart.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/vendors/simple-datatables/style.css') }}">

    <link rel="stylesheet" href="{{ asset('admin/assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/app.css') }}">
    <link rel="shortcut icon" href="{{ asset('admin/assets/images/favicon.svg') }}" type="image/x-icon">
</head>

<body>
    <div id="app">
        <!-- Sidebar -->
        @include('partials.sidebar')
        <div id="main">
            <!-- Navbar -->
            @include('partials.header')
            <!-- Main Content -->
            <div class="main-content container-fluid">
                <div class="container-fluid">

                    @if(session('success'))

                    <div class="alert alert-success alert-dismissible fade show ">

                        {{ session('success') }}

                        <button type="button"
                            class="btn-close"
                            data-bs-dismiss="alert">
                        </button>

                    </div>

                    @endif

                    @if(session('error'))

                    <div class="alert alert-danger color-danger alert-dismissible fade show">

                        {{ session('error') }}

                        <button type="button"
                            class="btn-close"
                            data-bs-dismiss="alert">
                        </button>

                    </div>

                    @endif

                </div>
                @yield('content')
                <!-- Footer -->
                @include('partials.footer')
            </div>
        </div>
        <script src="{{ asset('admin/assets/js/feather-icons/feather.min.js') }}"></script>
        <script src="{{ asset('admin/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
        <script src="{{ asset('admin/assets/js/app.js') }}"></script>

        <script src="{{ asset('admin/assets/vendors/chartjs/Chart.min.js') }}"></script>
        <script src="{{ asset('admin/assets/vendors/apexcharts/apexcharts.min.js') }}"></script>
        <script src="{{ asset('admin/assets/js/pages/dashboard.js') }}"></script>

        <script src="{{ asset('admin/assets/js/main.js') }}"></script>
        <script src="{{ asset('admin/assets/vendors/simple-datatables/simple-datatables.js') }}"></script>
        <script src="{{ asset('admin/assets/js/vendors.js') }}"></script>

</body>

</html>