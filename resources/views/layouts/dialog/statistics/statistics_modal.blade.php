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
                        <span>Total foto IVA positif:</span>
                    </div>

                    <div class="col-sm-7">
                        <span>{{ count(ImageUpload::where('label', 1)->get()) }} foto</span>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-5">
                        <span>Total foto IVA negatif</span>
                    </div>

                    <div class="col-sm-7">
                        <span>{{ count(ImageUpload::where('label', 0)->get()) }} foto</span>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-5">
                        <span>Total foto belum dilabel:</span>
                    </div>

                    <div class="col-sm-7">
                        <span>{{ count(ImageUpload::where('label', 99)->get()) }} foto</span>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
