@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @if(session('success'))
                <div class="container-fluid">
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

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-2">
                                Manajer Label Foto IVA
                            </div>
                            <div class="col-sm-10">
                                <div class="d-flex flex-row justify-content-end">
                                    <form method="post" action="{{ route('label.search') }}" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <div class="form-group row">
                                            <label for="search" class="col-form-label"></label>
                                            <div class="col">
                                                <input type="text" class="form-control" id="search" name="search" placeholder="ID entri...">
                                            </div>
                                            <button type="submit" class="btn btn-primary">Cari</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="d-flex flex-row justify-content-between">
                            <a href="{{ route('home') }}"><button class="btn btn-outline-dark">Kembali</button></a>

                            <div class="d-flex flex-row">
                                <div class="btn-group mr-2">
                                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Unduh
                                    </button>

                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('download.positive.iva') }}">Koleksi Foto IVA Positif</a>
                                        <a class="dropdown-item" href="{{ route('download.negative.iva') }}">Koleksi Foto IVA Negatif</a>
                                    </div>
                                </div>

                                <a href="{{ route('file.upload') }}"><button class="btn btn-primary">Unggah File</button></a>
                            </div>
                        </div>

                        <div class="table-responsive mt-4">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Pratinjau</th>
                                    <th>Deskripsi File</th>
                                    <th>Label</th>
                                    <th>Komentar</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($files as $file)
                                    <tr>
                                        <td>{{ $file->id }}</td>
                                        <td>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="d-flex flex-row justify-content-center">
                                                        @if(empty($file->filename_pre_iva))
                                                            <img src="{{ asset('assets/images/no-image.png') }}" height="72px">
                                                        @else
                                                            <img src="{{ url('files/images/iva/'.$file->filename_pre_iva) }}" height="72px">
                                                        @endif
                                                    </div>
                                                    <div class="d-flex flex-row justify-content-center mt-2">
                                                        <span class="font-weight-bold">Pre IVA</span>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="d-flex flex-row justify-content-center">
                                                        <img src="{{ url('files/images/iva/'.$file->filename_post_iva) }}" height="72px">
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
                                            <hr>
                                            <div class="row mt-2 ml-2">
                                                <span><span class="font-weight-bold">Diunggah oleh: </span>{{ $file->posted_by }}</span>
                                            </div>
                                            <div class="row mt-2 ml-2">
                                                <span><span class="font-weight-bold">Dilabel oleh: </span>
                                                    @if(!empty($file->edited_by))
                                                        <span>{{ $file->edited_by }}</span>
                                                    @else
                                                        <span>-</span>
                                                    @endif
                                                </span>
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
                                            <a href="{{ route('label.edit', $file->id) }}"><button class="btn btn-warning">Edit</button></a>
                                            <a href="{{ route('label.delete', $file->id) }}"><button class="btn btn-danger">Hapus</button></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-2">
                            {{ $files->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
