<div class="modal fade" id="modalChangePassword" tabindex="-1" role="dialog" aria-labelledby="modalChangePasswordTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalChangePasswordTitle">Ubah Password</h5>

                <button type="button" class="close" data-dismiss="modal" aria-labelledby="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="change-password" action="{{ route('password.change') }}" method="post"
                      enctype="multipart/form-data">
                    @csrf

                    <div class="form-group row">
                        <div class="col-sm-4 col-form-label">
                            <label for="currentPassword">Password lama</label>
                        </div>

                        <div class="col-sm-8">
                            <input type="password" id="currentPassword" name="currentPassword"
                                   class="form-control @error('currentPassword') is-invalid @enderror"
                                   placeholder="Password lama Anda">

                            <span class="invalid-feedback" role="alert">{{ $errors->first('currentPassword') }}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-4 col-form-label">
                            <label for="password">Password baru</label>
                        </div>

                        <div class="col-sm-8">
                            <input type="password" id="password" name="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   placeholder="Password baru Anda">

                            <span class="invalid-feedback" role="alert">{{ $errors->first('password') }}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-4 col-form-label">
                            <label for="password_confirmation">Konfirmasi password</label>
                        </div>

                        <div class="col-sm-8">
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                   class="form-control @error('password_confirmation') is-invalid @enderror"
                                   placeholder="Konfirmasi password Anda">

                            <span class="invalid-feedback"
                                  role="alert">{{ $errors->first('password_confirmation') }}</span>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>

                <button type="submit" class="btn btn-warning"
                        onclick="event.preventDefault(); document.getElementById('change-password').submit();">Simpan
                </button>
            </div>
        </div>
    </div>
</div>
