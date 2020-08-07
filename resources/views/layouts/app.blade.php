<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Simple Acetowhite Labeling</title>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:200,600" rel="stylesheet">

    <link rel="shortcut icon" href="{{ asset('assets/images/cervicam.png') }}">

    <!-- Dropzone -->
    <link rel="stylesheet" href="{{ asset('dropzone/css/dropzone.min.css') }}">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/animate.min.css') }}" rel="stylesheet">
    <style>
        @font-face {
            font-family: Product Sans;
            src: url("{{ asset('assets/fonts/ps_regular.ttf') }}");
        }

        html, body {
            font-family: Product Sans, sans-serif;
            background-color: #ffffff !important;
            height: 100%;
        }

        footer {
            font-size: 0.75em;
            padding: 12px;
        }

        ul {
            padding: 0 0 0 18px;
        }

        .copyright {
            font-family: sans-serif;
        }

        .navbar-title {
            font-weight: bold;
            color: #FF357C;
        }

        .page-content {
            flex: 1 0 auto;
        }
    </style>
    @yield('style')
</head>
<body class="d-flex flex-column">
<div id="app" class="page-content">
    <!-- Navbar -->
    @include('layouts.navbar.navbar')

    <main class="py-4">
        @yield('content')
    </main>
</div>

<!-- Footer -->
<footer>
    <hr/>

    <div class="d-flex justify-content-center">
        <span class="text-nowrap text-center">Copyright <span class="copyright">&copy;</span> 2020 CerviCam Research Group</span>
    </div>
</footer>

<!-- About modal -->
@include('layouts.dialog.about.about_modal')

<!-- Message modal -->
@include('layouts.dialog.message.message_modal')

@auth
    <!-- Statistics modal -->
    @include('layouts.dialog.statistics.statistics_modal')

    <!-- Change password modal -->
    @include('layouts.dialog.password.change_password_modal')
@endauth

<!-- Bootstrap script -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>

<!-- Message modal script -->
@include('layouts.dialog.message.message_script')

<!-- Custom scripts -->
@yield('script')
</body>
</html>
