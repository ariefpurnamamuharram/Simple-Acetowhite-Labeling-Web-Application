@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Upload Foto IVA</div>

                    <div class="card-body">
                        <span>Silakan unggah file foto pemeriksaan IVA Anda disini.</span>
                        <form method="post" action="{{ route('file.store') }}" enctype="multipart/form-data" class="dropzone mt-2" id="dropzone">
                            {{ csrf_field() }}
                        </form>
                        <div class="d-flex justify-content-start mt-4">
                            <a href="{{ route('home') }}"><button type="button" class="btn btn-outline-dark">Kembali</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<!-- Dropzone -->

<script src="{{ asset('dropzone/js/dropzone.js') }}"></script>
<script type="text/javascript">
    Dropzone.options.dropzone = {
        maxFilesize: 12,
        renameFile: function(file) {
            var dt = new Date();
            var time = dt.getTime();
            return time+"_"+file.name;
        },
        acceptedFiles: ".jpeg,.jpg,.png",
        addRemoveLinks: false,
        timeout: 50000,
        success: function(file, response) {
            console.log(response);
        },
        error: function(file, response) {
            return false;
        }
    }
</script>
