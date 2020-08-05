@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="font-weight-bold" style="color: #FF357C!important;">
            Tambah Pengguna Baru
        </h2>

        <hr/>

        <form action="{{ route('administrator.store.user') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="name">Nama lengkap</label>

                <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror"
                       placeholder="Nama lengkap Anda">

                <span class="invalid-feedback" role="alert">{{ $errors->first('name') }}</span>
            </div>

            <div class="form-group">
                <label for="email">Email</label>

                <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror"
                       placeholder="Alamat email Anda">

                <span class="invalid-feedback" role="alert">{{ $errors->first('email') }}</span>
            </div>

            <div class="form-group">
                <label for="password">Password</label>

                <input type="password" id="password" name="password"
                       class="form-control @error('password') is-invalid @enderror"
                       placeholder="Masukkan pasword baru Anda">

                <span class="invalid-feedback" role="alert">{{ $errors->first('password') }}</span>
            </div>

            <div class="form-group">
                <label for="password_confirmation">Konfirmasi password</label>

                <input type="password" id="password_confirmation" name="password_confirmation"
                       class="form-control @error('password_confirmation') is-invalid @enderror"
                       placeholder="Konfirmasi password baru Anda">

                <span class="invalid-feedback" role="alert">{{ $errors->first('password_confirmation') }}</span>
            </div>

            <section>
                <h4 class="mt-4">Administrator</h4>

                <hr/>

                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input @error('cbAdministrator') is-invalid @enderror"
                           id="cbAdministrator" name="cbAdministrator"
                           value="1">

                    <label class="form-check-label" for="cbAdministrator">Daftarkan sebagai akun Administrator</label>

                    <span class="invalid-feedback" role="alert">{{ $errors->first('cbAdministrator') }}</span>
                </div>
            </section>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
@endsection
