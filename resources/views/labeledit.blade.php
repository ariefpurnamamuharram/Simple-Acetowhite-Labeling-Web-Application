<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width. initial-scale=1">

    <title>Label IVA</title>

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
<div class="container-fluid mt-0 mb-4">
    <h3 class="jumbotron">Edit Label Foto IVA</h3>
    <form action="{{ route('label.update') }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="row col">
            <h4>Foto IVA</h4>
        </div>

        <div class="row mb-4">
            <div class="col">
                @if(empty($file->filename_pre_iva))
                    <img src="{{ asset('assets/images/no-image.png') }}" height="240px">
                @else
                    <img src="{{ url('files/'.$file->filename_pre_iva) }}" height="240px">
                @endif
                <h5 class="mt-2">Pre IVA</h5>
            </div>
            <div class="col">
                <img src="{{ url('files/'.$file->filename_post_iva) }}" height="240px">
                <h5 class="mt-2">Post IVA</h5>
            </div>
        </div>

        @if(empty($file->filename_pre_iva))
            <div class="form-group mt-4">
                <label for="preIVAImage"><h4>Unggah Foto Pre IVA</h4></label>
                <input name="preIVAImage" type="file" class="form-control-file">
            </div>
        @else
            <input name="preIVAImage" type="hidden" value="">
        @endif

        <div class="form-group mt-4">
            <label for="lblIVA"><h4>Label foto</h4></label>
            <select name="lblIVA" class="form-control" id="labelIVA">
                <option value="0" @if(empty($file)) @else @if($file->label == 0) selected=selected @endif @endif>Negatif</option>
                <option value="1" @if(empty($file)) @else @if($file->label == 1) selected=selected @endif @endif>Positif</option>
                <option value="98" @if(empty($file)) @else @if($file->label == 98) selected=selected @endif @endif>Undeterminate</option>
            </select>
        </div>

        <div class="form-group mt-4">
            <label for="comment"><h4>Komentar</h4></label>
            <textarea name="comment" class="form-control" rows="5">@if(!empty($file->comment)){{ $file->comment }}@endif</textarea>
        </div>

        <input name="id" type="hidden" value="{{ $file->id }}">

        <div class="row mt-4 mb-4">
            <div class="col">
                <div class="d-flex flex-row justify-content-between">
                    <a href="{{ route('label.index') }}"><button type="button" class="btn btn-outline-dark">Kembali</button></a>
                    <button type="submit" class="btn btn-warning">Simpan</button>
                </div>
            </div>
        </div>
    </form>
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
