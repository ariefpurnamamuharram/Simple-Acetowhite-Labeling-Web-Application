@extends('layouts.app2')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 mt-4">
                <div class="card">
                    <div class="card-header">Tandai Area Foto IVA</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th class="text-center">Posisi Marka (x0, y0, x1, y1)</th>
                                    <th class="text-center">Label</th>
                                    <th class="text-center">Deskripsi</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($files as $file)
                                    <tr>
                                        <td class="text-center align-middle"><span>{{ $file->id }}</span></td>
                                        <td class="text-center align-middle"><span>{{ $file->rect_x0 }}, {{ $file->rect_y0 }}, {{ $file->rect_x1 }}, {{ $file->rect_y1 }}</span>
                                        </td>
                                        <td class="text-center align-middle">
                                            @switch($file->label)
                                                @case(0)
                                                <span>Lesi Acetowhite</span>
                                                @break
                                                @case(99)
                                                <span>Lainnya</span>
                                                @break
                                                @default
                                                <span>Error</span>
                                            @endswitch
                                        </td>
                                        <td class="align-middle"><span>{{ $file->description }}</span></td>
                                        <td class="text-center">
                                            <a href="{{ route('image.mark.delete', $file->id) }}">
                                                <button class="btn btn-danger">Hapus</button>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <form action="{{ route('image.mark.store') }}" method="post" enctype="multipart/form-data"
                              class="mt-4">
                            {{ csrf_field() }}

                            <h4>Tambah Marka Baru</h4>

                            <hr/>

                            <input type="hidden" name="filename" id="filename" value="{{ $requestid }}"/>

                            <div class="form-row">
                                <div class="col">
                                    <span>Tandai area</span>
                                </div>
                                <div class="col">
                                    <input type="number" class="form-control" name="rectX0" id="rectX0"
                                           placeholder="rectX0">
                                </div>
                                <div class="col">
                                    <input type="number" class="form-control" name="rectY0" id="rectY0"
                                           placeholder="rectY0">
                                </div>
                                <div class="col">
                                    <input type="number" class="form-control" name="rectX1" id="rectX1"
                                           placeholder="rectX1">
                                </div>
                                <div class="col">
                                    <input type="number" class="form-control" name="rectY1" id="rectY1"
                                           placeholder="rectY1">
                                </div>
                                <div class="col">
                                    <button type="button" class="btn btn-warning" onclick="executeCanvas()"
                                            id="btnShowImage">Tampilkan
                                    </button>

                                    <button type="button" class="btn btn-warning" id="disabledBtnShowImage" disabled
                                            style="display: none;">Tampilkan
                                    </button>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="imageMarkLabel">Label</label>
                                <select class="form-control" id="imageMarkLabel" name="imageMarkLabel">
                                    <option value="0">Lesi Acetowhite</option>
                                    <option value="99">Lainnya</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="textDescription">Deskripsi</label>
                                <textarea class="form-control" id="textDescription" name="textDescription"
                                          rows="3"></textarea>
                            </div>

                            <div class="d-flex flex-row justify-content-end">
                                <button class="btn btn-warning">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center" style="margin-top: 36px">
            <div class="col-md-8">
                <h5 class="text-center">Area Penampil Gambar</h5>
            </div>
        </div>
        <div class="row justify-content-center mt-2">
            <canvas id="canvas"></canvas>
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
        var rect = {};
        var drag = false;
        var canvas = document.getElementById("canvas");
        var ctx = canvas.getContext("2d");
        var img = new Image();

        // Load image.
        img.src = "{{ url('files/images/iva/'.$requestid) }}";

        // setup canvas.
        function init() {
            canvas.width = img.width;
            canvas.height = img.height;
            ctx.drawImage(img, 0, 0);
            canvas.addEventListener('mousedown', mouseDown, false);
            canvas.addEventListener('mouseup', mouseUp, false);
            canvas.addEventListener('mousemove', mouseMove, false);
        }

        // Mouse down listener.
        function mouseDown(e) {
            rect.startX = e.pageX - this.offsetLeft;
            rect.startY = e.pageY - this.offsetTop;
            drag = true;
        }

        // Mouse up listener.
        function mouseUp(e) {
            drag = false;
        }

        // Mouse move listener.
        function mouseMove(e) {
            if (drag) {
                // Draw rectangle on canvas.
                ctx.clearRect(0, 0, img.width, img.height);
                ctx.drawImage(img, 0, 0);
                rect.w = (e.pageX - this.offsetLeft) - rect.startX;
                rect.h = (e.pageY - this.offsetTop) - rect.startY;
                ctx.strokeStyle = '#EFFD5F';
                ctx.strokeRect(rect.startX, rect.startY, rect.w, rect.h);

                // Redraw saved marks if any.
                @if(!empty($files))
                redrawMarksOnCanvas()
                @endif

                // Store x0, y0, x1, and y1 value.
                document.getElementById('rectX0').value = rect.startX;
                document.getElementById('rectY0').value = rect.startY;
                document.getElementById('rectX1').value = e.pageX - this.offsetLeft;
                document.getElementById('rectY1').value = e.pageY - this.offsetTop;
            }
        }

        // Redraw marks if any.
        function redrawMarksOnCanvas() {
            @foreach($files as $file)
            // Create blank drawing area.
            var blankCtx = null;
            blankCtx = canvas.getContext("2d");

            // Load x0, y0, x1, and y1 values.
            var x0 = '{{ $file->rect_x0 }}';
            var y0 = '{{ $file->rect_y0 }}';
            var x1 = '{{ $file->rect_x1 }}';
            var y1 = '{{ $file->rect_y1 }}';

            // Draw marks.
            blankCtx.strokeStyle = '#EFFD5F';
            blankCtx.strokeRect(x0, y0, x1 - x0, y1 - y0);

            // Draw mark label.
                @switch($file->label)
                @case(0)
            var markLabel = "ID: {{ $file->id }}; " + "Label: Lesi Acetowhite";
                @break
                @case(99)
            var markLabel = "ID: {{ $file->id }}; " + "Label: Lainnya";
                @break
                @default
            var markLabel = "ID: {{ $file->id }}; " + "Label: Error";
            @endswitch
                blankCtx.font = "16px Arial";
            blankCtx.textBaseline = "bottom";
            blankCtx.fillStyle = "black";
            blankCtx.fillText(markLabel, x0, y0);

            // Draw mark description.
            blankCtx.font = "14px Arial";
            blankCtx.textBaseline = "bottom";
            blankCtx.fillStyle = "black";
            blankCtx.fillText("Deskripsi: {{ $file->description }}", x0, y1);
            @endforeach
        }

        function executeCanvas() {
            // Initialize canvas.
            init();

            // Load saved marks if any.
            @if(!empty($files))
            redrawMarksOnCanvas()
            @endif

            // Disable image show button.
            document.getElementById('btnShowImage').style.display = "none";
            document.getElementById('disabledBtnShowImage').style.display = "block";
        }

        @if(session()->has('message'))
        $(window).on('load', function () {
            $('#modalTitle').html('Pemberitahuan');
            $('#modalBody').html('{{ session('message') }}');
            $('#modal').modal('show');
        });
        @endif
    </script>
@endsection
