@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 mt-4">
                <div class="card">
                    <div class="card-header">Pengaturan Pengguna</div>

                    <div class="card-body">
                        <form action="{{ route('user.update') }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <h4><strong>Data Diri</strong></h4>

                            <hr/>

                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label">Nama</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="name" name="name"
                                           value="{{ Auth::user()->name }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="email" name="email"
                                           value="{{ Auth::user()->email }}">
                                </div>
                            </div>

                            <div class="d-flex justify-content-end mt-2">
                                <button type="submit" class="btn btn-warning">Simpan</button>
                            </div>
                        </form>

                        <form action="{{ route('user.change.password') }}" method="post" enctype="multipart/form-data"
                              class="mt-4">
                            {{ csrf_field() }}

                            <h4><strong>Password</strong></h4>

                            <hr/>

                            <p>Silakan isi kolom berikut jika Anda ingin merubah <em>password</em> Anda.</p>

                            <div class="form-group row">
                                <label for="password" class="col-sm-3 col-form-label">Password baru</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control" id="password" name="password">
                                </div>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-danger">Ubah Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Pemberitahuan</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-labelledby="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <p id="modalBody"></p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        @if(session()->has('message'))
        $(window).on('load', function () {
            $('#modalTitle').html('Pemberitahuan');
            $('#modalBody').html('{{ session('message') }}');
            $('#modal').modal('show');
        });
        @endif
    </script>
@endsection
