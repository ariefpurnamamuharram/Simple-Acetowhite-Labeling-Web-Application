@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="font-weight-bold" style="color: #FF357C!important;">Daftar Pengguna</h2>

        <hr/>

        <div class="row justify-content-center">
            <div class="col-md-12 mt-2">
                <div class="table-responsive mt-2">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr class="text-center text-white" style="background-color: #FF357C!important;">
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Administrator</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach(User::orderBy('name', "DESC")->get() as $user)
                            <tr class="text-center align-middle">
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <div class="form-group">
                                            <input id="isAdministrator" type="checkbox" class="form-check-input"
                                                   disabled
                                                   @if(UserDetails::where('email', $user->email)->first()->is_administrator == true) checked="checked" @endif>

                                            <label for="isAdministrator" class="d-none col-form-label"></label>
                                        </div>
                                    </div>
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
                                                <form action="{{ route('administrator.delete.user') }}" method="post"
                                                      enctype="multipart/form-data">
                                                    @csrf

                                                    <input type="hidden" name="email" value="{{ $user->email }}">

                                                    <button class="dropdown-item" type="submit">
                                                        Hapus pengguna
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
