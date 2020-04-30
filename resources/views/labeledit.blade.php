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
                                        <img src="{{ url('files/images/iva/'.$file->filename_pre_iva) }}" height="240px">
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

                            <div class="row mt-4">
                                <div class="col">
                                    <div class="d-flex flex-row justify-content-between">
                                        <a href="{{ route('label.index') }}"><button type="button" class="btn btn-outline-dark">Kembali</button></a>
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
