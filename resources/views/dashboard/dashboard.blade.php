@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="background-color: #FF357C!important;">
                        <span class="text-white">Manajer Label Foto IVA</span>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <form method="post" action="{{ route('file.search') }}"
                                      enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="form-group row">
                                        <label for="search" class="col-form-label"></label>
                                        <div class="col">
                                            <input type="text" class="form-control" id="search" name="search"
                                                   placeholder="ID entri...">
                                        </div>
                                        <button type="submit" class="btn btn-primary">Cari</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="table-responsive mt-2">
                            <table class="table table-hover">
                                <thead>
                                <tr class="text-center"
                                    style="background-color: #FBE0DC!important; color: #241D4C!important;">
                                    <th>ID</th>
                                    <th>Pratinjau</th>
                                    <th>Label</th>
                                    <th>Temuan</th>
                                    <th>Komentar</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($files as $file)
                                    <tr @if(!empty(ImageLabel::where(['filename' => $file->filename_post_iva, 'email' => Auth::user()->email])->first()->label)) @switch(ImageLabel::where(['filename' => $file->filename_post_iva, 'email' => Auth::user()->email])->first()->label)
                                        @case(0)
                                        class="table-success"
                                        @break
                                        @case(1)
                                        class="table-danger"
                                        @break
                                        @endswitch
                                        @else class=""
                                        @endif>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <span class="text-center">{{ $file->id }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="d-flex flex-row justify-content-center">
                                                        @if(empty($file->filename_pre_iva))
                                                            <img src="{{ asset('assets/images/no-image.png') }}"
                                                                 height="72px">
                                                        @else
                                                            <img
                                                                src="{{ url('files/images/iva/'.$file->filename_pre_iva) }}"
                                                                height="72px">
                                                        @endif
                                                    </div>
                                                    <div class="d-flex flex-row justify-content-center mt-2">
                                                        <span class="font-weight-bold">Pre IVA</span>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="d-flex flex-row justify-content-center">
                                                        <img
                                                            src="{{ url('files/images/iva/'.$file->filename_post_iva) }}"
                                                            height="72px">
                                                    </div>
                                                    <div class="d-flex flex-row justify-content-center mt-2">
                                                        <span class="font-weight-bold">Post IVA</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">@if(!empty(ImageLabel::where(['filename' => $file->filename_post_iva, 'email' => Auth::user()->email])->first()->label))
                                                @switch(ImageLabel::where(['filename' => $file->filename_post_iva, 'email' => Auth::user()->email])->first()->label)
                                                    @case(0)
                                                    <span>Negatif</span>
                                                    @break
                                                    @case(1)
                                                    <span>Positif</span>
                                                    @break
                                                @endswitch
                                            @else
                                                <span style="font-style: italic">Belum dilabel</span>
                                            @endif
                                        </td>
                                        <td>
                                            //
                                        </td>
                                        <td>
                                            @if(!empty(ImageLabel::where(['filename' => $file->filename_post_iva, 'email' => Auth::user()->email])->first()->label))
                                                <span>{{ ImageLabel::where(['filename' => $file->filename_post_iva, 'email' => Auth::user()->email])->first()->label }}</span>
                                            @else
                                                <span>-</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <div class="dropdown">
                                                    <button class="btn btn-secondary dropdown-toggle" type="button"
                                                            id="dropdownActionButton" data-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="false">
                                                        Pilih aksi
                                                    </button>

                                                    <div class="dropdown-menu" aria-labelledby="dropdownActionButton">
                                                        <a class="dropdown-item"
                                                           href="{{ route('file.edit', $file->filename_post_iva) }}">
                                                            Edit Label Foto
                                                        </a>

                                                        <a class="dropdown-item disabled" href="#">
                                                            Hapus Foto
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
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
