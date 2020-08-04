<!-- Navbar -->
<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ route('dashboard') }}">
            <span class="navbar-title">Simple Acetowhite Labeling</span>
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
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

                        <a class="dropdown-item" href="{{ route('dashboard.show.not.labelled') }}">
                            Semua Foto Belum Dilabel
                        </a>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-dark font-weight-bold" href="{{ route('file.upload') }}">Unggah Foto</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-dark font-weight-bold" href="#" role="button" data-toggle="modal"
                       data-target="#modalStatistics">Statistik</a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">
                <!-- Guest navbar -->
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
                        <a id="navbarDropdown" class="nav-link dropdown-toggle text-dark font-weight-bold" href="#"
                           role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
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
