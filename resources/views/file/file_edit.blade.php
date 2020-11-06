@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card shadow-sm animate__animated animate__fadeInUp">
                    <div class="card-header" style="background-color: #FF357C!important;">
                        <span class="text-white">Edit Label Foto IVA</span>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('file.update') }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <section>
                                <h4>Foto IVA</h4>

                                <hr/>

                                <div class="row mb-4">
                                    <div class="col">
                                        @if(empty($file->filename_pre_iva))
                                            <img src="{{ asset('assets/images/no-image.png') }}" height="240px"
                                                 alt="Pre-IVA image">
                                        @else
                                            <img
                                                src="{{ url('files/images/iva/'.ImageUpload::where('filename_post_iva', $file->filename)->first()->filename_pre_iva) }}"
                                                height="240px" alt="Pre-IVA image">
                                        @endif

                                        <h5 class="mt-2">Pre-IVA</h5>
                                    </div>
                                    <div class="col">
                                        <img
                                            src="{{ url('files/images/iva/'.ImageUpload::where('filename_post_iva', $file->filename)->first()->filename_post_iva) }}"
                                            height="240px" alt="Post IVA image">

                                        <h5 class="mt-2">Post IVA</h5>
                                    </div>
                                </div>

                                @if(empty(ImageUpload::where('filename_post_iva', $file->filename)->first()->filename_pre_iva))
                                    <div class="form-group mt-4">
                                        <h4>Foto Pre-IVA</h4>

                                        <hr/>

                                        <div class="custom-file">
                                            <input type="file"
                                                   class="custom-file-input @error('preIVAImage') is-invalid @enderror"
                                                   id="preIVAImage"
                                                   name="preIVAImage">

                                            <label for="preIVAImage" class="custom-file-label">
                                                Unggah Foto Pre IVA
                                            </label>

                                            <span class="invalid-feedback"
                                                  role="alert">{{ $errors->first('preIVAImage') }}</span>
                                        </div>
                                    </div>
                                @endif
                            </section>

                            <div class="form-group mt-4">
                                <h4>Hasil IVA</h4>

                                <hr/>

                                <label for="lblIVA">
                                    Pilih pelabelan foto IVA Anda<span class="text-danger">*</span>
                                </label>

                                <select name="lblIVA" id="lblIVA"
                                        class="form-control @error('lblIVA') is-invalid @enderror">
                                    <option disabled
                                            @if($file->label == ImageUpload::IMAGE_NOT_LABELED_CODE) selected="selected" @endif>
                                        -- Pilih label --
                                    </option>

                                    <option value="{{ ImageUpload::IMAGE_LABEL_NEGATIVE_CODE }}"
                                            @if($file->label == ImageUpload::IMAGE_LABEL_NEGATIVE_CODE) selected="selected" @endif>
                                        Negatif
                                    </option>

                                    <option value="{{ ImageUpload::IMAGE_LABEL_POSITIVE_CODE }}"
                                            @if($file->label == ImageUpload::IMAGE_LABEL_POSITIVE_CODE) selected @endif>
                                        Positif
                                    </option>
                                </select>

                                <span class="invalid-feedback" role="alert">{{ $errors->first('lblIVA') }}</span>
                            </div>

                            <div class="form-group mt-4">
                                <h4>Tandai Area Foto</h4>

                                <hr/>

                                <div class="form-row ml-1">
                                    <div class="d-flex flex-row align-items-center">
                                        <a href="{{ route('image.mark', $file->filename) }}" target="_blank"
                                           class="btn btn-warning">
                                            Tandai
                                        </a>
                                    </div>

                                    <div class="d-flex flex-row align-items-center" style="margin-left: 12px;">
                                        @if(!empty(ImageAreaMark::where(['filename' => $file->filename, 'email' => Auth::user()->email])->first()))
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
                                <h4>Komentar</h4>

                                <hr/>

                                <label for="comment" class="d-none"></label>

                                <textarea id="comment" name="comment" class="form-control" rows="5"
                                          placeholder="Masukkan komentar bila ada...">@if(!empty($file->comment)){{ $file->comment }}@endif</textarea>
                            </div>

                            <input name="filename_post_iva" type="hidden" value="{{ $file->filename }}">

                            <div class="row mt-4">
                                <div class="col">
                                    <div class="d-flex flex-row justify-content-between">
                                        @if(!empty($page))
                                            <a href="{{ route('dashboard', ["page" => $page]) }}">
                                                <button type="button" class="btn btn-outline-dark">Kembali</button>
                                            </a>
                                        @else
                                            <a href="{{ route('dashboard') }}">
                                                <button type="button" class="btn btn-outline-dark">Kembali</button>
                                            </a>
                                        @endif

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

@section('script')
    <script type="text/javascript">
        $('#preIVAImage').on('change', function () {
            var filename = $(this).val().replace('C:\\fakepath\\', '');
            $(this).next('.custom-file-label').html(filename);
        });
    </script>
@endsection
