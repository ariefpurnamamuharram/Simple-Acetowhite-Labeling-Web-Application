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
                                                <button type="button" class="dropdown-item"
                                                        data-toggle="modal"
                                                        data-target="#resetPassword"
                                                        data-email="{{ $user->email }}">
                                                    Reset password
                                                </button>

                                                @if(UserDetails::where('email', $user->email)->first()->email != Auth::user()->email)
                                                    <button type="button" class="dropdown-item"
                                                            data-toggle="modal"
                                                            data-target="#changeUserRole"
                                                            data-email="{{ $user->email }}">
                                                        @if(UserDetails::where('email', $user->email)->first()->is_administrator == true)
                                                            Jadikan sebagai pengguna biasa
                                                        @else
                                                            Jadikan sebagai administrator
                                                        @endif
                                                    </button>
                                                @endif
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

    <!-- Reset user password -->
    <div class="modal fade" id="resetPassword" tabindex="-1" role="dialog" aria-labelledby="resetPasswordLabel">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="resetPasswordLabel">Reset Password Pengguna</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <p>Apakah Anda yakin untuk melanjutkan? Silakan masukkan password Anda untuk melanjutkan.</p>
                    <form id="reset-user-password-form" action="{{ route('administrator.reset.user.password') }}"
                          method="post"
                          enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" id="userEmail" name="userEmail">

                        <div class="form-group row">
                            <div class="col-md-2">
                                <label for="password" class="col-form-label font-weight-bold">Password<span
                                        class="text-danger">*</span></label>
                            </div>

                            <div class="col-md-10">
                                <input id="password" name="password" type="password"
                                       class="form-control @error('password') is-invalid @enderror"
                                       placeholder="Masukkan password Anda">

                                <span class="invalid-feedback" role="alert">
                                    {{ $errors->first('password') }}
                                </span>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-warning"
                            onclick="event.preventDefault(); document.getElementById('reset-user-password-form').submit();">
                        Lanjutkan
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Change user's role -->
    <div class="modal fade" id="changeUserRole" tabindex="-1" role="dialog" aria-labelledby="changeUserRoleLabel">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changeUserRoleTitle">Konfirmasi</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <p>Apakah Anda yakin untuk mengubah hak akses pengguna tersebut?</p>

                    <form id="change-user-role-form" action="{{ route('administrator.change.user.role') }}"
                          method="post" enctype="multipart/form-data"
                          class="d-none">
                        @csrf

                        <input type="hidden" id="userEmail" name="userEmail">
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-warning"
                            onclick="event.preventDefault(); document.getElementById('change-user-role-form').submit();">
                        Lanjutkan
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $('#resetPassword').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var email = button.data('email');

            var modal = $(this)
            modal.find('.modal-body #userEmail').val(email)
        })

        $('#changeUserRole').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var email = button.data('email');

            var modal = $(this)
            modal.find('.modal-body #userEmail').val(email)
        })
    </script>
@endsection
