<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width. initial-scale=1">

    <title>Unggah Foto IVA</title>

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:200,600" rel="stylesheet">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">

    <!-- Dropzone -->
    <link rel="stylesheet" href="{{ asset('dropzone/css/dropzone.min.css') }}">

    <!-- Style -->
    <style>
        html, body {
            height: 100vh;
            background-color: white;
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <h3 class="jumbotron">Upload Foto IVA</h3>
    <form method="post" action="{{ route('file.store') }}" enctype="multipart/form-data" class="dropzone" id="dropzone">
        {{ csrf_field() }}
    </form>
    <div class="d-flex justify-content-start mt-4">
        <a href="{{ route('home') }}"><button type="button" class="btn btn-outline-dark">Kembali</button></a>
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

<!-- Dropzone -->
<script src="{{ asset('dropzone/js/dropzone.js') }}"></script>
<script type="text/javascript">
    Dropzone.options.dropzone = {
        maxFilesize: 12,
        renameFile: function(file) {
            var dt = new Date();
            var time = dt.getTime();
            return time+("_")+file.name;
        },
        acceptedFiles: ".jpeg,.jpg,.png",
        addRemoveLinks: false,
        timeout: 50000,
        success: function(file, response) {
            console.log(response);
        },
        error: function(file, response) {
            return false;
        }
    }
</script>
</body>
</html>
