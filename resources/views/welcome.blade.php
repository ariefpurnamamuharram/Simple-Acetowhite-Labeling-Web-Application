@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row align-items-center mt-4">
            <div class="col">
                <div class="d-flex align-items-center justify-content-center mt-2">
                    <h1>Simple Acetowhite Labeling</h1>
                </div>
                <div class="d-flex justify-content-center align-items-center mt-2">
                    <p style="text-align: center">Selamat datang di aplikasi web Simple Acetowhite Labeling. <br>Sistem ini membantu Anda dalam memberikan label dan manajemen koleksi foto pemeriksaan IVA.</p>
                </div>
                <div class="d-flex justify-content-center">
                    <a href="{{ route('login') }}" class="ml-2 mr-2"><button type="button" class="btn btn-outline-dark">Login</button></a>
                </div>
                <div class="d-flex justify-content-center mt-4">
                    <span>Dikembangkan untuk <span class="font-weight-bold">CerviCam Project</span> oleh Arief Purnama Muharram</span>
                </div>
                <div class="d-flex justify-content-center">
                    <span>&copy; Arief Purnama Muharram 2020</span>
                </div>
            </div>
        </div>
    </div>
@endsection
