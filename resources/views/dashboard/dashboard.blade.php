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
                                <form action="{{ route('file.search') }}" method="post"
                                      enctype="multipart/form-data">
                                    @csrf

                                    <div class="form-group row">
                                        <label for="search" class="col-form-label"></label>

                                        <div class="col">
                                            <input type="text"
                                                   class="form-control @error('search') is-invalid @enderror"
                                                   id="search" name="search"
                                                   placeholder="ID entri...">
                                        </div>

                                        <span class="invalid-feedback"
                                              role="alert">{{ $errors->first('search') }}</span>

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
                                    <th class="align-middle">ID</th>
                                    <th class="align-middle">Pratinjau</th>
                                    <th class="align-middle">Label</th>
                                    <th class="align-middle">Temuan</th>
                                    <th class="align-middle">Komentar</th>
                                    <th class="align-middle">Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($files as $file)
                                    <tr @if(!empty($file->filename_post_iva)))
                                        @if(!empty(ImageLabel::where(['filename' => $file->filename_post_iva, 'email' => Auth::user()->email])->first()))
                                        @switch(ImageLabel::where(['filename' => $file->filename_post_iva, 'email' => Auth::user()->email])->first()->label)
                                        @case(0)
                                        class="table-success"
                                        @break
                                        @case(1)
                                        class="table-danger"
                                        @break
                                        @endswitch
                                        @else
                                        class=""
                                        @endif

                                        @else

                                        @if(!empty(ImageLabel::where(['filename' => $file->filename, 'email' => Auth::user()->email])->first()))
                                        @switch(ImageLabel::where(['filename' => $file->filename, 'email' => Auth::user()->email])->first()->label)
                                        @case(0)
                                        class="table-success"
                                        @break
                                        @case(1)
                                        class="table-danger"
                                        @break
                                        @endswitch
                                        @else
                                        class=""
                                        @endif
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
                                                            src="@if(!empty($file->filename_post_iva)) {{ url('files/images/iva/'.$file->filename_post_iva) }} @else {{ url('files/images/iva/'.$file->filename) }} @endif"
                                                            height="72px">
                                                    </div>
                                                    <div class="d-flex flex-row justify-content-center mt-2">
                                                        <span class="font-weight-bold">Post IVA</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            @if(!empty($file->filename_post_iva))
                                                @if(!empty(ImageLabel::where(['filename' => $file->filename_post_iva, 'email' => Auth::user()->email])->first()))
                                                    @switch(ImageLabel::where(['filename' => $file->filename_post_iva, 'email' => Auth::user()->email])->first()->label)
                                                        @case(0)
                                                        <span>Negatif</span>
                                                        @break
                                                        @case(1)
                                                        <span>Positif</span>
                                                        @break
                                                        @default
                                                        <span style="font-style: italic">Belum dilabel</span>
                                                    @endswitch
                                                @else
                                                    <span style="font-style: italic">Belum dilabel</span>
                                                @endif

                                            @else

                                                @if(!empty(ImageLabel::where(['filename' => $file->filename, 'email' => Auth::user()->email])->first()))
                                                    @switch(ImageLabel::where(['filename' => $file->filename, 'email' => Auth::user()->email])->first()->label)
                                                        @case(0)
                                                        <span>Negatif</span>
                                                        @break
                                                        @case(1)
                                                        <span>Positif</span>
                                                        @break
                                                        @default
                                                        <span style="font-style: italic">Belum dilabel</span>
                                                    @endswitch
                                                @else
                                                    <span style="font-style: italic">Belum dilabel</span>
                                                @endif
                                            @endif
                                        </td>
                                        <td>
                                            @if(!empty($file->filename_post_iva))
                                                @if(!empty(ImageAreaMark::where(['filename' => $file->filename_post_iva, 'email' => Auth::user()->email])->get()))
                                                    <ul>
                                                        @foreach(array_unique(ImageAreaMark::where(['filename' => $file->filename_post_iva, 'email' => Auth::user()->email])->get()->pluck('label')->all()) as $mark)
                                                            @switch($mark)
                                                                @case(0)
                                                                <li>Lesi acetowhite</li>
                                                                @break
                                                                @case(1)
                                                                <li>Metaplasia ring</li>
                                                                @break
                                                                @case(2)
                                                                <li>Tali IUD</li>
                                                                @break
                                                                @case(3)
                                                                <li>Darah menstruasi</li>
                                                                @break
                                                                @case(4)
                                                                <li>Lendir/mukus</li>
                                                                @break
                                                                @case(5)
                                                                <li>Fluor albus</li>
                                                                @break
                                                                @case(6)
                                                                <li>Servisitis</li>
                                                                @break
                                                                @case(7)
                                                                <li>Polip</li>
                                                                @break
                                                                @case(8)
                                                                <li>Ovula nabothi</li>
                                                                @break
                                                                @case(9)
                                                                <li>Ektoprion</li>
                                                                @break
                                                                @case(10)
                                                                <li>Refleksi cahaya</li>
                                                                @break
                                                                @case(99)
                                                                <li>Lainnya</li>
                                                                @break
                                                            @endswitch
                                                        @endforeach
                                                    </ul>
                                                @endif

                                            @else

                                                @if(!empty(ImageAreaMark::where(['filename' => $file->filename, 'email' => Auth::user()->email])->get()))
                                                    <ul>
                                                        @foreach(array_unique(ImageAreaMark::where(['filename' => $file->filename, 'email' => Auth::user()->email])->get()->pluck('label')->all()) as $mark)
                                                            @switch($mark)
                                                                @case(0)
                                                                <li>Lesi acetowhite</li>
                                                                @break
                                                                @case(1)
                                                                <li>Metaplasia ring</li>
                                                                @break
                                                                @case(2)
                                                                <li>Tali IUD</li>
                                                                @break
                                                                @case(3)
                                                                <li>Darah menstruasi</li>
                                                                @break
                                                                @case(4)
                                                                <li>Lendir/mukus</li>
                                                                @break
                                                                @case(5)
                                                                <li>Fluor albus</li>
                                                                @break
                                                                @case(6)
                                                                <li>Servisitis</li>
                                                                @break
                                                                @case(7)
                                                                <li>Polip</li>
                                                                @break
                                                                @case(8)
                                                                <li>Ovula nabothi</li>
                                                                @break
                                                                @case(9)
                                                                <li>Ektoprion</li>
                                                                @break
                                                                @case(10)
                                                                <li>Refleksi cahaya</li>
                                                                @break
                                                                @case(99)
                                                                <li>Lainnya</li>
                                                                @break
                                                            @endswitch
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            @endif
                                        </td>
                                        <td>
                                            @if(!empty($file->filename_post_iva))
                                                @if(!empty(ImageLabel::where(['filename' => $file->filename_post_iva, 'email' => Auth::user()->email])->first()->comment))
                                                    <span>{{ ImageLabel::where(['filename' => $file->filename_post_iva, 'email' => Auth::user()->email])->first()->comment }}</span>
                                                @else
                                                    <span>-</span>
                                                @endif

                                            @else

                                                @if(!empty(ImageLabel::where(['filename' => $file->filename, 'email' => Auth::user()->email])->first()->comment))
                                                    <span>{{ ImageLabel::where(['filename' => $file->filename, 'email' => Auth::user()->email])->first()->comment }}</span>
                                                @else
                                                    <span>-</span>
                                                @endif
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
                                                           href="@if(!empty($file->filename_post_iva)) {{ route('file.edit', ["page" => $files->currentPage(), "requestid" => $file->filename_post_iva]) }} @else {{ route('file.edit', ["page" => $files->currentPage(), "requestid" => $file->filename]) }} @endif">
                                                            Edit Label Foto
                                                        </a>

                                                        @if(!empty(ImageLabel::where(['filename' => $file->filename, 'email' => Auth::user()->email])->first()))
                                                            <form action="{{ route('file.delete.label') }}"
                                                                  method="post" enctype="multipart/form-data">
                                                                @csrf

                                                                <input name="filename" type="hidden"
                                                                       value="@if(!empty($file->filename_post_iva)) {{ $file->filename_post_iva }} @else {{ $file->filename }} @endif">

                                                                <button type="submit" class="dropdown-item">Hapus Label
                                                                    Foto
                                                                </button>
                                                            </form>
                                                        @else
                                                            <button class="dropdown-item disabled" disabled>Hapus Label
                                                                Foto
                                                            </button>
                                                        @endif
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
