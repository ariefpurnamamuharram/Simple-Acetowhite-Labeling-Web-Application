@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Edit Foto IVA</div>

                    <div class="card-body">
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
                                        <img src="{{ url('files/images/iva/'.$file->filename_pre_iva) }}"
                                             height="240px">
                                    @endif
                                    <h5 class="mt-2">Pre IVA</h5>
                                </div>
                                <div class="col">
                                    <img src="{{ url('files/images/iva/'.$file->filename_post_iva) }}" height="240px">
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
                                <h4>Tandai Area Foto</h4>
                                <div class="form-row">
                                    <div class="d-flex flex-row align-items-center">
                                        <a href="{{ route('image.mark', $file->filename_post_iva) }}" target="_blank"
                                           class="btn btn-warning">
                                            Tandai
                                        </a>
                                    </div>
                                    <div class="d-flex flex-row align-items-center" style="margin-left: 12px;">
                                        @if(!empty(\App\ImageAreaMark::where('filename', $file->filename_post_iva)->first()))
                                            <img src="{{ asset('assets/images/correct.png') }}" width="32px"
                                                 height="32px"/>
                                        @else
                                            <img src="{{ asset('assets/images/criss-cross.png') }}" width="32px"
                                                 height="32px"/>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mt-4">
                                <label for="lblIVA"><h4>Label Foto</h4></label>
                                <select name="lblIVA" class="form-control" id="lblIVA">
                                    <option selected disabled>-- Pilih Label Foto --</option>
                                    <option value="0"
                                            @if(empty($file)) @else @if($file->label == 0) selected=selected @endif @endif>
                                        Negatif
                                    </option>
                                    <option value="1"
                                            @if(empty($file)) @else @if($file->label == 1) selected=selected @endif @endif>
                                        Positif
                                    </option>
                                </select>
                            </div>

                            <div class="form-group mt-4">
                                <h4>Temuan Lain</h4>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="cbMetaplasiaRing"
                                           name="cbMetaplasiaRing"
                                           @if(empty($artifact)) @else @if($artifact->cbMetaplasiaRing == 1) checked=checked @endif @endif>
                                    <label class="form-check-label" for="cbMetaplasiaRing"><span class="font-italic">Metaplasia ring</span></label>
                                </div>

                                <div class="form-check mt-1">
                                    <input class="form-check-input" type="checkbox" id="cbIUD" name="cbIUD"
                                           @if(empty($artifact)) @else @if($artifact->cbIUD == 1) checked=checked @endif @endif>
                                    <label class="form-check-label" for="cbIUD">Tali IUD</label>
                                </div>

                                <div class="form-check mt-1">
                                    <input class="form-check-input" type="checkbox" id="cbMenstrualBlood"
                                           name="cbMenstrualBlood"
                                           @if(empty($artifact)) @else @if($artifact->cbMenstrualBlood == 1) checked=checked @endif @endif>
                                    <label class="form-check-label" for="cbMenstrualBlood">Darah menstruasi</label>
                                </div>

                                <div class="form-check mt-1">
                                    <input class="form-check-input" type="checkbox" id="cbSlime" name="cbSlime"
                                           @if(empty($artifact)) @else @if($artifact->cbSlime == 1) checked=checked @endif @endif>
                                    <label class="form-check-label" for="cbSlime">Lendir/mukus</label>
                                </div>

                                <div class="form-check mt-1">
                                    <input class="form-check-input" type="checkbox" id="cbFluorAlbus"
                                           name="cbFluorAlbus"
                                           @if(empty($artifact)) @else @if($artifact->cbFluorAlbus == 1) checked=checked @endif @endif>
                                    <label class="form-check-label" for="cbFluorAlbus"><span class="font-italic">Fluor albus</span></label>
                                </div>

                                <div class="form-check mt-1">
                                    <input class="form-check-input" type="checkbox" id="cbCervicitis"
                                           name="cbCervicitis"
                                           @if(empty($artifact)) @else @if($artifact->cbCervicitis == 1) checked=checked @endif @endif>
                                    <label class="form-check-label" for="cbCervicitis">Servisitis</label>
                                </div>

                                <div class="form-check mt-1">
                                    <input class="form-check-input" type="checkbox" id="cbPolyp" name="cbPolyp"
                                           @if(empty($artifact)) @else @if($artifact->cbPolyp == 1) checked=checked @endif @endif>
                                    <label class="form-check-label" for="cbPolyp">Polip</label>
                                </div>

                                <div class="form-check mt-1">
                                    <input class="form-check-input" type="checkbox" id="cbOvulaNabothi"
                                           name="cbOvulaNabothi"
                                           @if(empty($artifact)) @else @if($artifact->cbOvulaNabothi == 1) checked=checked @endif @endif>
                                    <label class="form-check-label" for="cbOvulaNabothi"><span class="font-italic">Ovula nabothi</span></label>
                                </div>

                                <div class="form-check mt-1">
                                    <input class="form-check-input" type="checkbox" id="cbEctropion" name="cbEctropion"
                                           @if(empty($artifact)) @else @if($artifact->cbEctropion == 1) checked=checked @endif @endif>
                                    <label class="form-check-label" for="cbEctropion">Ektropion</label>
                                </div>
                            </div>

                            <div class="form-group mt-4">
                                <label for="comment"><h4>Komentar</h4></label>
                                <textarea name="comment" class="form-control" rows="5"
                                          placeholder="Masukkan komentar bila ada...">@if(!empty($file->comment)){{ $file->comment }}@endif</textarea>
                            </div>

                            <input name="filename_post_iva" type="hidden" value="{{ $file->filename_post_iva }}">

                            <div class="row mt-4">
                                <div class="col">
                                    <div class="d-flex flex-row justify-content-between">
                                        <a href="{{ route('label.index') }}">
                                            <button type="button" class="btn btn-outline-dark">Kembali</button>
                                        </a>
                                        <button type="submit" class="btn btn-warning">Simpan</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
