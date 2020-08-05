<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="@auth {{ route('dashboard') }} @else {{ route('welcome') }} @endauth">
            <span class="navbar-title">Simple Acetowhite Labeling</span>
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            @auth
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-dark font-weight-bold" href="#" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Dasbor
                        </a>

                        <div class="dropdown-menu animate__animated animate__fadeInDown">
                            <a class="dropdown-item" href="{{ route('dashboard') }}">
                                Semua Foto
                            </a>

                            <a class="dropdown-item" href="{{ route('dashboard.show.positives') }}">
                                Semua Foto IVA Positif
                            </a>

                            <a class="dropdown-item" href="{{ route('dashboard.show.negatives') }}">
                                Semua Foto IVA Negatif
                            </a>

                            @if(UserDetails::where('email', Auth::user()->email)->first()->is_administrator == true)
                                <div class="dropdown-divider"></div>

                                <div class="dropdown-header">Administrator</div>

                                <a class="dropdown-item" href="{{ route('administrator.dashboard') }}">
                                    Ringkasan Seluruh Foto
                                </a>

                                <a class="dropdown-item" href="#">
                                    Unduh Seluruh Foto IVA Positif
                                </a>

                                <a class="dropdown-item" href="#">
                                    Unduh Seluruh Foto IVA Negatif
                                </a>
                            @endif
                        </div>
                    </li>

                    @if(UserDetails::where('email', Auth::user()->email)->first()->is_administrator == true)
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-dark font-weight-bold" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Administrator
                            </a>

                            <div class="dropdown-menu animate__animated animate__fadeInDown">
                                <div class="dropdown-header">Pengaturan Pengguna</div>

                                <a class="dropdown-item" href="{{ route('administrator.users') }}">
                                    Daftar Pengguna
                                </a>

                                <a class="dropdown-item" href="{{ route('administrator.new.user') }}">
                                    Tambah Pengguna
                                </a>
                            </div>
                        </li>
                    @endif

                    <li class="nav-item">
                        <a class="nav-link text-dark font-weight-bold" href="{{ route('file.upload') }}">Unggah Foto</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-dark font-weight-bold" href="#" role="button" data-toggle="modal"
                           data-target="#modalStatistics">Statistik</a>
                    </li>
                </ul>
            @endauth

            <ul class="navbar-nav ml-auto">
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Masuk</a>
                    </li>

                    <!-- Register link -->
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
                        <a id="navbarDropdown" class="nav-link dropdown-toggle text-dark" href="#"
                           role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <span
                                class="font-weight-bold">{{ Auth::user()->name }}</span> @if(UserDetails::where('email', Auth::user()->email)->first()->is_administrator == true)
                                <span>(Administrator)</span>@endif
                        </a>

                        <div class="dropdown-menu dropdown-menu-right animate__animated animate__fadeInDown"
                             aria-labelledby="navbarDropdown">
                            <section>
                                <div class="dropdown-header font-weight-bold">Akun Saya</div>

                                <a class="dropdown-item" role="button" href="#" data-toggle="modal"
                                   data-target="#modalChangePassword">Ubah Password</a>

                                <a class="dropdown-item" href="{{ route('user.settings') }}">Pengaturan Akun</a>
                            </section>

                            <div class="dropdown-divider"></div>

                            <section>
                                <div class="dropdown-header font-weight-bold">Tentang</div>

                                <a class="dropdown-item" role="button" href="#" data-toggle="modal"
                                   data-target="#modalAbout">Tentang</a>
                            </section>

                            <div class="dropdown-divider"></div>

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
