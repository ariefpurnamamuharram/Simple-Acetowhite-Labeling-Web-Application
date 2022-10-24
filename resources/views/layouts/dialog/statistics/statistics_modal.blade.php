<div class="modal fade" id="modalStatistics" tabindex="-1" role="dialog" aria-labelledby="modalStatisticsTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalStatisticsTitle">Statistik</h5>

                <button type="button" class="close" data-dismiss="modal" aria-labelledby="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-5">
                        <span>Total foto IVA diunggah:</span>
                    </div>

                    <div class="col-sm-7">
                        <span>{{ count(ImageUpload::get()) }} foto</span>
                    </div>
                </div>

                @if(UserDetails::where('email', Auth::user()->email)->first()->is_administrator == true)
                    <div class="row">
                        <div class="col-sm-5">
                            <span>Total foto IVA dilabel:</span>
                        </div>

                        <div class="col-sm-7">
                            <span>{{ count(array_unique(ImageLabel::whereRaw('NOT label = 99')->get()->pluck('filename')->all())) }} foto</span>
                        </div>
                    </div>
                @endif
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
