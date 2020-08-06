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
                            <th class="align-middle">Nama</th>
                            <th class="align-middle">Email</th>
                            <th class="align-middle">Administrator</th>
                            <th class="align-middle">Aksi</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($users as $user)
                            <tr class="text-center">
                                <td class="align-middle">{{ $user->name }}</td>
                                <td class="align-middle"><span class="text-nowrap">{{ $user->email }}</span></td>
                                <td class="align-middle">
                                    <div class="d-flex justify-content-center">
                                        @if(UserDetails::where('email', $user->email)->first()->is_administrator == true)
                                            <span class="text-center">v</span>
                                        @else
                                            <span class="text-center">x</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="align-middle">
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

                <div class="mt-2">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
