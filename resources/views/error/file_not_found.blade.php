@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Error</div>

                <div class="card-body">
                    <div class="d-flex flex-row">
                        <span>File tidak ditemukan</span>
                    </div>
                    <div class="d-flex flex-row mt-3">
                        <a href="{{ route('file.index') }}"><button class="btn btn-outline-dark">Kembali</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
