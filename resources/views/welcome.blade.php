<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Simple Acetowhite Labeling</title>

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:200,600" rel="stylesheet">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">

    <!-- Style -->
    <style>
        html, body {
            height: 100vh;
            background-color: white;
        }
    </style>
</head>
<body>
<div class="container-fluid h-100">
    <div class="row h-100 align-items-center">
        <div class="col">
            <div class="d-flex align-items-center justify-content-center">
                <h1>Simple Acetowhite Labeling</h1>
            </div>
            <div class="d-flex justify-content-center align-items-center mt-2">
                <p style="text-align: center">Selamat datang di aplikasi web Simple Acetowhite Labeling. <br>Sistem ini membantu Anda dalam memberikan label dan manajemen koleksi foto pemeriksaan IVA.<br>Silakan pilih menu Anda.</p>
            </div>
            <div class="d-flex justify-content-center mt-2">
                <a href="{{ route('file.upload') }}" class="ml-2 mr-2"><button type="button" class="btn btn-outline-dark">Upload Foto IVA</button></a>
                <a href="{{ route('label.index') }}" class="ml-2 mr-2"><button type="button" class="btn btn-outline-dark">Label Foto IVA</button></a>
            </div>
            <div class="d-flex justify-content-center mt-4">
                <span>Dikembangkan untuk <span class="font-weight-bold">CerviCam Project</span> oleh Arief Purnama Muharram</span>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap -->
<script src="{{ asset('jquery/jquery-3.4.1.slim.min.js') }}"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"></script>
<script src="{{ asset('popper/popper.min.js') }}"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
<script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
</body>
</html>
