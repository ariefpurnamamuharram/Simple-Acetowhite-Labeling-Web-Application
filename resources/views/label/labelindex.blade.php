@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="container">
                                <span>Manajer Label Foto IVA</span>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <form method="post" action="{{ route('label.search') }}"
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

                            <div class="col-sm-9">
                                <div class="d-flex flex-row justify-content-end">
                                    <div class="btn-group mr-2">
                                        <button type="button" class="btn btn-primary dropdown-toggle"
                                                data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                            Unduh
                                        </button>

                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ route('download.positive.iva') }}">Koleksi
                                                Foto IVA Positif</a>
                                            <a class="dropdown-item" href="{{ route('download.negative.iva') }}">Koleksi
                                                Foto IVA Negatif</a>
                                        </div>
                                    </div>

                                    <a href="{{ route('file.upload') }}">
                                        <button class="btn btn-primary">Unggah Foto IVA</button>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive mt-4">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th class="text-center">Pratinjau</th>
                                    <th class="text-center">Deskripsi File</th>
                                    <th class="text-center">Label</th>
                                    <th class="text-center">Fitur/Artefak</th>
                                    <th class="text-center">Komentar</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($files as $file)
                                    <tr>
                                        <td>
                                            <div class="row ml-2 mr-2">
                                                <span class="text-center">{{ $file->id }}</span><br>
                                            </div>
                                            @if(\App\ImageMark::where('filename', $file->filename_post_iva)->value('is_marked') === 1)
                                                <div class="row ml-2 mr-2 mt-2">
                                                    <div
                                                        class="d-flex flex-column align-items-center justify-content-center">
                                                        <img src="{{ asset('assets/images/flag.png') }}" height="18px">
                                                    </div>
                                                </div>
                                            @else
                                            @endif
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
                                        <td>
                                            <div class="row ml-2 mr-2">
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
                                            @if(!empty(\App\ImageArtifact::where('filename', $file->filename_post_iva)->value('cbMetaplasiaRing')))
                                                @switch(\App\ImageArtifact::where('filename', $file->filename_post_iva)->value('cbMetaplasiaRing'))
                                                    @case(1)
                                                    <span>- <span class="font-italic">Metaplasia ring</span></span>
                                                    @break
                                                    @default
                                                @endswitch
                                            @else
                                            @endif
                                            <br>@if(!empty(\App\ImageArtifact::where('filename', $file->filename_post_iva)->value('cbIUD')))
                                                @switch(\App\ImageArtifact::where('filename', $file->filename_post_iva)->value('cbIUD'))
                                                    @case(1)
                                                    <span>- Tali IUD</span>
                                                    @break
                                                    @default
                                                @endswitch
                                            @else
                                            @endif
                                            <br>@if(!empty(\App\ImageArtifact::where('filename', $file->filename_post_iva)->value('cbMenstrualBlood')))
                                                @switch(\App\ImageArtifact::where('filename', $file->filename_post_iva)->value('cbMenstrualBlood'))
                                                    @case(1)
                                                    <span>- Darah menstruasi</span>
                                                    @break
                                                    @default
                                                @endswitch
                                            @else
                                            @endif
                                            <br>@if(!empty(\App\ImageArtifact::where('filename', $file->filename_post_iva)->value('cbSlime')))
                                                @switch(\App\ImageArtifact::where('filename', $file->filename_post_iva)->value('cbSlime'))
                                                    @case(1)
                                                    <span>- Lendir/mukus</span>
                                                    @break
                                                    @default
                                                @endswitch
                                            @else
                                            @endif
                                            <br>@if(!empty(\App\ImageArtifact::where('filename', $file->filename_post_iva)->value('cbFluorAlbus')))
                                                @switch(\App\ImageArtifact::where('filename', $file->filename_post_iva)->value('cbFluorAlbus'))
                                                    @case(1)
                                                    <span>- <span class="font-italic">Fluor albus</span></span>
                                                    @break
                                                    @default
                                                @endswitch
                                            @else
                                            @endif
                                            <br>@if(!empty(\App\ImageArtifact::where('filename', $file->filename_post_iva)->value('cbCervicitis')))
                                                @switch(\App\ImageArtifact::where('filename', $file->filename_post_iva)->value('cbCervicitis'))
                                                    @case(1)
                                                    <span>- Servisitis</span>
                                                    @break
                                                    @default
                                                @endswitch
                                            @else
                                            @endif
                                            <br>@if(!empty(\App\ImageArtifact::where('filename', $file->filename_post_iva)->value('cbCarcinoma')))
                                                @switch(\App\ImageArtifact::where('filename', $file->filename_post_iva)->value('cbCarcinoma'))
                                                    @case(1)
                                                    <span>- Karsinoma</span>
                                                    @break
                                                    @default
                                                @endswitch
                                            @else
                                            @endif
                                            <br>@if(!empty(\App\ImageArtifact::where('filename', $file->filename_post_iva)->value('cbPolyp')))
                                                @switch(\App\ImageArtifact::where('filename', $file->filename_post_iva)->value('cbPolyp'))
                                                    @case(1)
                                                    <span>- Polip</span>
                                                    @break
                                                    @default
                                                @endswitch
                                            @else
                                            @endif
                                            <br>@if(!empty(\App\ImageArtifact::where('filename', $file->filename_post_iva)->value('cbOvulaNabothi')))
                                                @switch(\App\ImageArtifact::where('filename', $file->filename_post_iva)->value('cbOvulaNabothi'))
                                                    @case(1)
                                                    <span>- <span class="font-italic">Ovula Nabothi</span></span>
                                                    @break
                                                    @default
                                                @endswitch
                                            @else
                                            @endif
                                            <br>@if(!empty(\App\ImageArtifact::where('filename', $file->filename_post_iva)->value('cbEctropion')))
                                                @switch(\App\ImageArtifact::where('filename', $file->filename_post_iva)->value('cbEctropion'))
                                                    @case(1)
                                                    <span>- Ektropion</span>
                                                    @break
                                                    @default
                                                @endswitch
                                            @else
                                            @endif
                                        </td>
                                        <td>
                                            @if(empty($file->comment))
                                                <span>-</span>
                                            @else
                                                <span>{{ $file->comment }}</span>
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
                                                           href="{{ route('label.edit', $file->id) }}">Edit</a>
                                                        <a class="dropdown-item"
                                                           href="{{ route('label.mark', $file->id) }}">
                                                            @if(\App\ImageMark::where('filename', $file->filename_post_iva)->value('is_marked') === 0)
                                                                <span>Tandai</span>
                                                            @else
                                                                <span>Buang tanda</span>
                                                            @endif
                                                        </a>
                                                        <a class="dropdown-item"
                                                           href="{{ route('label.delete', $file->id) }}">Hapus</a>
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

    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Pemberitahuan</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-labelledby="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <p id="modalBody"></p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        @if(session()->has('success'))
        $(window).on('load', function () {
            $('#modalTitle').html('Pemberitahuan');
            $('#modalBody').html('{{ session('success') }}');
            $('#modal').modal('show');
        });
        @endif
    </script>
@endsection
