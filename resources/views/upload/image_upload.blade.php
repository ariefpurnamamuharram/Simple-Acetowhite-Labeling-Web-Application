@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm animate__animated animate__fadeInUp">
                    <div class="card-header" style="background-color: #FF357C!important;">
                        <span class="text-white">Upload Foto IVA</span>
                    </div>

                    <div class="card-body">
                        <div>
                            <span>Silakan unggah file foto pemeriksaan IVA Anda disini.</span>

                            <form method="post" action="{{ route('file.store') }}" enctype="multipart/form-data"
                                class="dropzone mt-2" id="dropzone">

                                @csrf

                            </form>

                            <span style="font-size: 0.85em;">(Maksimal ukuran setiap file 12 mb)</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<!-- Dropzone -->
@section('script')
    <script src="{{ asset('dropzone/js/dropzone.js') }}"></script>

    <script type="text/javascript">
        Dropzone.options.dropzone = {
            maxFilesize: 12,
            renameFile: function(file) {
                var dt = new Date();
                var time = dt.getTime();
                return time + "_" + file.name;
            },
            acceptedFiles: ".jpeg,.jpg,.png",
            addRemoveLinks: false,
            timeout: 5000000,
            success: function(file, response) {
                console.log(response);
            },
            error: function(file, response) {
                return false;
            }
        }
    </script>
@endsection
