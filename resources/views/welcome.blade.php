@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row align-items-center mt-4">
            <div class="col">
                <div class="d-flex align-items-center justify-content-center mt-2">
                    <h1 class="text-center">Simple Acetowhite Labeling</h1>
                </div>
                <div class="d-flex justify-content-center align-items-center mt-2">
                    <p class="text-center" style="text-align: center">Selamat datang di aplikasi web Simple Acetowhite
                        Labeling. <br>Sistem
                        ini membantu Anda dalam memberikan label dan manajemen koleksi foto pemeriksaan IVA.</p>
                </div>
                <div class="d-flex justify-content-center">
                    <a href="{{ route('login') }}" class="ml-2 mr-2">
                        <button type="button" class="btn btn-outline-dark">Login</button>
                    </a>
                </div>
                <div class="d-flex justify-content-center mt-4">
                    <span class="text-center">Dikembangkan untuk <span class="font-weight-bold">CerviCam Project</span> oleh <a
                            class="text-dark" href="http://linkedin.com/in/ariefpurnamamuharram" target="_blank">Arief Purnama Muharram</a></span>
                </div>
                <div class="d-flex justify-content-center mt-2">
                    <span class="text-center">&copy; <a class="text-dark"
                                                        href="http://linkedin.com/in/ariefpurnamamuharram"
                                                        target="_blank">Arief Purnama Muharram</a> 2020</span>
                </div>
            </div>
        </div>
    </div>
@endsection
