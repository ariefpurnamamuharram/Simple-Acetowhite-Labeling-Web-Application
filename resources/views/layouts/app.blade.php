<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Title -->
    <title>Simple Acetowhite Labeling</title>

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:200,600" rel="stylesheet">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/cervicam.png') }}">

    <!-- Dropzone -->
    <link rel="stylesheet" href="{{ asset('dropzone/css/dropzone.min.css') }}">

    <!-- Scripts -->
    <!-- Disable default app javascript. -->
    <!--<script src="{{ asset('js/app.js') }}" defer></script>-->

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Custom style -->
    @yield('style')

</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                Simple Acetowhite Labeling
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Masuk</a>
                        </li>
                        @if(Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">Daftar</a>
                            </li>
                        @endif
                        <li class="nav-item">
                            <a class="nav-link" role="button" href="#" data-toggle="modal"
                               data-target="#modalAbout">Tentang</a>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('home') }}">Beranda</a>

                                <a class="dropdown-item" href="{{ route('label.index') }}">Dasbor Label Foto IVA</a>

                                <a class="dropdown-item" href="{{ route('file.upload') }}">Unggah Foto IVA</a>

                                <a class="dropdown-item" href="{{ route('user.settings') }}">Pengaturan Akun</a>

                                <a class="dropdown-item" role="button" href="#" data-toggle="modal"
                                   data-target="#modalAbout">Tentang</a>

                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onClick="event.preventDefault(); document.getElementById('logout-form').submit();">Keluar</a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>

    <div class="modal fade" id="modalAbout" tabindex="-1" role="dialog" aria-labelledby="modalAboutTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAboutTitle">Tentang</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-labelledby="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <h3 class="text-center">Simple Acetowhite Labeling</h3>
                    <p class="text-center">Sistem Manajemen Koleksi Foto Pemeriksaan IVA Serviks</p>
                    <p class="text-center">Versi 2020.01.01<br>Dirilis pada tanggal 18 Mei 2020</p>
                    <p class="text-center"><strong>Dibuat oleh</strong><br><a class="text-dark"
                                                                              href="http://linkedin.com/in/ariefpurnamamuharram"
                                                                              target="_blank">Arief Purnama Muharram</a>
                    </p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

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

@yield('script')
</body>
</html>
