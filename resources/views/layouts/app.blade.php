<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>@yield('title') | DEMO Pilotexc</title>

        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}"">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- App style -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        @yield('head')
    </head>

    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">

            <!-- Top Navbar -->
            @include('layouts.components.navbar')

            <!-- Sidebar -->
            @include('layouts.components.sidebar')

            <!-- Content -->
            @include('layouts.components.content')

            <!-- Footer -->
            @include('layouts.components.footer')
        </div>

        <!-- SCRIPTS -->
        <script src="{{ asset('js/app.js') }}"></script>

        @yield('script')
    </body>
</html>
