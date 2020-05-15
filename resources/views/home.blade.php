@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    <h4 class="text-center">Selamat Datang</h4>
                    <h2 class="text-center font-weight-bold">{{ Auth::User()->name }}</h2>
                    <hr>
                    <div class="d-flex flex-row justify-content-center mt-4">
                        <a href="{{ route('file.upload') }}" class="ml-2 mr-2"><button class="btn btn-outline-dark">Unggah Foto IVA</button></a>
                        <a href="{{ route('label.index') }}" class="ml-2 mr-2"><button class="btn btn-outline-dark">Label Foto IVA</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
