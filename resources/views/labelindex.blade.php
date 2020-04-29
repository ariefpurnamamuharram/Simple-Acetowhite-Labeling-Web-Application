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
<div class="container-fluid">
    <h3 class="jumbotron">Label Foto IVA</h3>
    @if(session('success'))
        <div class="container-fluid mt-3">
            <div class="row">
                <div class="col">
                    <div class="d-flex align-items-center justify-content-center">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <h4>Peringatan</h4>
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="container-fluid mt-2">
        <div class="row">
            <div class="col">
                <div class="panel-body">
                    <p>
                        <a href="{{ route('file.upload') }}"><button type="button" class="btn btn-outline-dark">Unggah File</button></a>
                    </p>

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Pratinjau</th>
                                    <th>Nama File</th>
                                    <th>Label</th>
                                    <th>Komentar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($files as $file)
                                <tr>
                                    <td>
                                        <div class="row">
                                            <div class="col">
                                                <div class="d-flex flex-row justify-content-center">
                                                    @if(empty($file->filename_pre_iva))
                                                        <img src="{{ asset('assets/images/no-image.png') }}" height="124px">
                                                    @else
                                                        <img src="{{ url('files/'.$file->filename_pre_iva) }}" height="124px">
                                                    @endif
                                                </div>
                                                <div class="d-flex flex-row justify-content-center mt-2">
                                                    <span class="font-weight-bold">Pre IVA</span>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="d-flex flex-row justify-content-center">
                                                    <img src="{{ url('files/'.$file->filename_post_iva) }}" height="124px">
                                                </div>
                                                <div class="d-flex flex-row justify-content-center mt-2">
                                                    <span class="font-weight-bold">Post IVA</span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="row ml-2">
                                            <span><span class="font-weight-bold">Pre IVA: </span>
                                                @if(empty($file->filename_pre_iva))
                                                    <span>-</span>
                                                @else
                                                    <span>{{ $file->filename_pre_iva }}</span>
                                                @endif
                                            </span>
                                        </div>
                                        <div class="row mt-2 ml-2">
                                            <span><span class="font-weight-bold">Post IVA: </span>{{ $file->filename_post_iva }}</span>
                                        </div>
                                    </td>
                                    <td>@switch($file->label)
                                            @case(0)
                                                <span>Negatif</span>
                                            @break
                                            @case(1)
                                                <span>Positif</span>
                                            @break
                                            @case(98)
                                                <span style="font-style: italic">Undeterminate</span>
                                            @break
                                            @default
                                                <span style="font-style: italic">Belum dilabel</span>
                                        @endswitch
                                    </td>
                                    <td>
                                        @if(empty($file->comment))
                                            <span>-</span>
                                        @else
                                            <span>{{ $file->comment }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('label.delete', $file->id) }}"><button type="button" class="btn btn-danger">Hapus</button></a>
                                        <a href="{{ route('label.edit', $file->id) }}"><button type="button" class="btn btn-warning">Edit</button></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <a href="{{ route('home') }}"><button type="button" class="btn btn-outline-dark">Kembali</button></a>
                </div>
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
