@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row align-items-center mt-4">
            <div class="col">
                <div class="d-flex justify-content-center">
                    <div class="animate__animated animate__flipInY animate__delay-1s">
                        <img src="{{ asset('assets/images/cervicam.png') }}" height="160px" alt="CerviCam logo"/>
                    </div>
                </div>

                <div class="d-flex justify-content-center mt-2">
                    <h1 class="text-center" style="color: #FF357C!important;">Simple Acetowhite Labeling</h1>
                </div>

                <div class="d-flex justify-content-center mt-2">
                    <p class="text-center" style="text-align: center">
                        Selamat datang di aplikasi web Simple Acetowhite Labeling</p>
                </div>

                <div class="d-flex justify-content-center mt-2">
                    <a href="{{ route('login') }}" class="ml-2 mr-2">
                        <button type="button" class="btn"
                                style="background-color: #FF357C!important; color: #ffffff!important;">
                            Masuk
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
