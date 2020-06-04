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
                                           value="{{ Auth::user()->email }}" disabled>
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

                        <section class="mt-4">

                            <h4><strong>API Token</strong></h4>

                            <hr/>

                            <p>
                                Gunakan API Token berikut untuk mengakses sistem melalui metode API. Anda disarankan
                                untuk tidak menghasilkan atau menghapusnya jika tidak tahu atau belum akan
                                menggunakannya.<br><br><strong>Perhatian! API Token ini bersifat rahasia. Anda dilarang
                                    untuk membagikannya kepada siapapun. Kerahasiaan API Token ini menjadi tanggung
                                    jawab Anda.</strong>
                            </p>

                            @if(!empty(User::where('email', Auth::user()->email)->first()->api_token))
                                <div class="form-row bg-success text-light p-2 rounded">
                                    <div class="col">
                                        <span class="font-italic">
                                        {{ User::where('email', Auth::user()->email)->first()->api_token }}
                                        </span>
                                    </div>
                                </div>
                            @else
                                <div class="form-row bg-danger text-light p-2 rounded">
                                    <span class="font-italic">Belum ada API Token dihasilkan</span>
                                </div>
                            @endif

                            <div class="form-row" style="margin-top: 24px;">
                                <div class="col"></div>
                                <div class="d-flex justify-content-end">
                                    @if(!empty(User::where('email', Auth::user()->email)->first()->api_token))
                                        <form id="revoke-api-token-form" action="{{ route('user.revoke.api.token') }}"
                                              method="post" enctype="multipart/form-data" class="d-none">
                                            @csrf
                                        </form>

                                        <button type="button" class="btn btn-danger"
                                                onclick="event.preventDefault(); document.getElementById('revoke-api-token-form').submit();">
                                            Hapus Token
                                        </button>
                                    @endif

                                    <form id="generate-api-token-form" action="{{ route('user.generate.api.token') }}"
                                          method="post" enctype="multipart/form-data" class="d-none">
                                        @csrf
                                    </form>

                                    <button type="button" class="btn btn-warning" style="margin-left: 12px;"
                                            onclick="event.preventDefault(); document.getElementById('generate-api-token-form').submit();">
                                        Generate Token
                                    </button>
                                </div>
                            </div>
                        </section>
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
