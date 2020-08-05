@extends('layouts.app')

@section('style')
    <style>
        #canvas {
            cursor: crosshair;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <canvas id="canvas" width="0" height="0"></canvas>
        </div>

        <div id="imagePreviewBox" class="row ml-1 mr-1" style="border: 2px dashed #656564; min-height: 240px;">
            <div class="col">
                <div style="margin-top: 72px;">
                    <div class="row justify-content-center">
                        <p class="text-center">Area Penampil Gambar</p>
                    </div>
                    <div class="row justify-content-center">
                        <button type="button" class="btn btn-warning" onclick="executeCanvas()"
                                id="btnShowImage">Tampilkan
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col mt-4">
                <div class="card shadow-sm" id="imageAreaMarkWindow">
                    <div class="card-header" style="background-color: #FF357C!important;">
                        <span class="text-white">Tandai Area Foto IVA</span>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th class="text-center">Label</th>
                                    <th class="text-center">Deskripsi</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                                </thead>

                                <tbody>
                                @if(!empty($files))
                                    @foreach($files as $file)
                                        <tr class="text-center align-middle">
                                            <td>
                                                <span>{{ $file->id }}</span>
                                            </td>

                                            <td>
                                                @switch($file->label)
                                                    @case(0)
                                                    <span>Lesi acetowhite</span>
                                                    @break
                                                    @case(1)
                                                    <span>Metaplasia ring</span>
                                                    @break
                                                    @case(2)
                                                    <span>Tali IUD</span>
                                                    @break
                                                    @case(3)
                                                    <span>Darah menstruasi</span>
                                                    @break
                                                    @case(4)
                                                    <span>Lendir/mukus</span>
                                                    @break
                                                    @case(5)
                                                    <span>Fluor albus</span>
                                                    @break
                                                    @case(6)
                                                    <span>Servisitis</span>
                                                    @break
                                                    @case(7)
                                                    <span>Polip</span>
                                                    @break
                                                    @case(8)
                                                    <span>Ovula nabothi</span>
                                                    @break
                                                    @case(9)
                                                    <span>Ektoprion</span>
                                                    @break
                                                    @case(10)
                                                    <span>Refleksi cahaya</span>
                                                    @break
                                                    @case(99)
                                                    <span>Lainnya</span>
                                                    @break
                                                @endswitch
                                            </td>

                                            <td>
                                                <span>{{ $file->description }}</span>
                                            </td>

                                            <td class="text-center">
                                                <a href="{{ route('image.mark.delete', $file->id) }}">
                                                    <button class="btn btn-danger">Hapus</button>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>

                        <form action="{{ route('image.mark.store') }}" method="post" enctype="multipart/form-data"
                              class="mt-4">
                            {{ csrf_field() }}

                            <h4>Tambah Marka Baru</h4>

                            <hr/>

                            <input type="hidden" name="filename" id="filename" value="{{ $requestid }}"/>

                            <div class="form-row" style="display: none;">
                                <div class="col">
                                    <span>Tandai area</span>
                                </div>
                                <div class="col">
                                    <input type="hidden" class="form-control" name="rectX0" id="rectX0"
                                           placeholder="rectX0">
                                </div>
                                <div class="col">
                                    <input type="hidden" class="form-control" name="rectY0" id="rectY0"
                                           placeholder="rectY0">
                                </div>
                                <div class="col">
                                    <input type="hidden" class="form-control" name="rectX1" id="rectX1"
                                           placeholder="rectX1">
                                </div>
                                <div class="col">
                                    <input type="hidden" class="form-control" name="rectY1" id="rectY1"
                                           placeholder="rectY1">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="staticMarkArea" class="col-form-label">
                                    <strong>Tandai area foto</strong>
                                </label>

                                <input type="text" readonly class="form-control-plaintext" id="staticMarkArea"
                                       value="Seleksi area pada gambar untuk menambahkan tanda baru.">
                            </div>

                            <div class="form-group">
                                <label for="imageMarkLabel" class="col-form-label"><strong>Label</strong></label>

                                <select class="form-control @error('imageMarkLabel') is-invalid @enderror"
                                        id="imageMarkLabel" name="imageMarkLabel">
                                    <option selected disabled>-- Pilih label temuan --</option>
                                    <option value="0">Lesi acetowhite</option>
                                    <option value="1">Metaplasia ring</option>
                                    <option value="2">Tali IUD</option>
                                    <option value="3">Darah menstruasi</option>
                                    <option value="4">Lendir/mukus</option>
                                    <option value="5">Fluor albus</option>
                                    <option value="6">Servisitis</option>
                                    <option value="7">Polip</option>
                                    <option value="8">Ovula nabothi</option>
                                    <option value="9">Ektoprion</option>
                                    <option value="10">Refleksi cahaya</option>
                                    <option value="99">Lainnya</option>
                                </select>

                                <span class="invalid-feedback"
                                      role="alert">{{ $errors->first('imageMarkLabel') }}</span>
                            </div>

                            <div class="form-group">
                                <label for="textDescription" class="col-form-label"><strong>Deskripsi</strong></label>

                                <textarea class="form-control" id="textDescription" name="textDescription"
                                          rows="5" placeholder="Tambahkan deskripsi temuan jika ada"></textarea>
                            </div>

                            <div class="d-flex flex-row justify-content-end">
                                <button class="btn btn-warning">Simpan</button>
                            </div>
                        </form>
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

                // Create constants.
                const canvasW = 480;

                // Load image.
                img.src = "{{ url('files/images/iva/'.$requestid) }}";

                // setup canvas.
                function init() {
                    canvas.width = canvasW;
                    canvas.height = Math.round(canvasW * img.height / img.width);
                    ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
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
                        ctx.clearRect(0, 0, canvas.width, canvas.height);
                        ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
                        rect.w = (e.pageX - this.offsetLeft) - rect.startX;
                        rect.h = (e.pageY - this.offsetTop) - rect.startY;
                        ctx.strokeStyle = '#EFFD5F';
                        ctx.strokeRect(rect.startX, rect.startY, rect.w, rect.h);

                        // Redraw saved marks if any.
                        @if(!empty($files))
                        redrawMarksOnCanvas()
                        @endif

                        // Get scaling factor.
                        var scalingFactor = Math.round(img.width / canvas.width);

                        // Store x0, y0, x1, and y1 value.
                        document.getElementById('rectX0').value = rect.startX * scalingFactor;
                        document.getElementById('rectY0').value = rect.startY * scalingFactor;
                        document.getElementById('rectX1').value = (e.pageX - this.offsetLeft) * scalingFactor;
                        document.getElementById('rectY1').value = (e.pageY - this.offsetTop) * scalingFactor;
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

                    // Get scaling factor.
                    var scalingFactor = Math.round(img.width / canvas.width);

                    // Draw marks.
                    blankCtx.strokeStyle = '#EFFD5F';
                    blankCtx.strokeRect(Math.round(x0 / scalingFactor), Math.round(y0 / scalingFactor), Math.round((x1 - x0) / scalingFactor), Math.round((y1 - y0) / scalingFactor));

                    // Draw mark file.
                    @switch($file->label)
                    @case(0)
                    var markLabel = "ID: {{ $file->id }}; " + "Label: Lesi acetowhite";
                    @break
                    @case(1)
                    var markLabel = "ID: {{ $file->id }}; " + "Label: Metaplasia ring";
                    @break
                    @case(2)
                    var markLabel = "ID: {{ $file->id }}; " + "Label: Tali IUD";
                    @break
                    @case(3)
                    var markLabel = "ID: {{ $file->id }}; " + "Label: Darah menstruasi";
                    @break
                    @case(4)
                    var markLabel = "ID: {{ $file->id }}; " + "Label: Lendir/mukus";
                    @break
                    @case(5)
                    var markLabel = "ID: {{ $file->id }}; " + "Label: Fluor albus";
                    @break
                    @case(6)
                    var markLabel = "ID: {{ $file->id }}; " + "Label: Servisitis";
                    @break
                    @case(7)
                    var markLabel = "ID: {{ $file->id }}; " + "Label: Polip";
                    @break
                    @case(8)
                    var markLabel = "ID: {{ $file->id }}; " + "Label: Ovula nabothi";
                    @break
                    @case(9)
                    var markLabel = "ID: {{ $file->id }}; " + "Label: Ektoprion";
                    @break
                    @case(10)
                    var markLabel = "ID: {{ $file->id }}; " + "Label: Refleksi cahaya";
                    @break
                    @case(99)
                    var markLabel = "ID: {{ $file->id }}; " + "Label: Lainnya";
                    @break
                    @default
                    var markLabel = "ID: {{ $file->id }}; " + "Label: Error";
                    @endswitch
                        blankCtx.font = "14px Arial";
                    blankCtx.textBaseline = "bottom";
                    blankCtx.fillStyle = "black";
                    blankCtx.fillText(markLabel, Math.round(x0 / scalingFactor), Math.round(y0 / scalingFactor) - 3);

                    // Draw mark description.
                    blankCtx.font = "12px Arial";
                    blankCtx.textBaseline = "top";
                    blankCtx.fillStyle = "black";
                    blankCtx.fillText("Deskripsi: {{ $file->description }}", Math.round(x0 / scalingFactor), Math.round(y1 / scalingFactor) + 6);
                    @endforeach
                }

                function executeCanvas() {
                    // Initialize canvas.
                    init();

                    // Load saved marks if any.
                    @if(!empty($files))
                    redrawMarksOnCanvas()
                    @endif

                    // Hide imageViewBody.
                    document.getElementById('imagePreviewBox').style.display = "none";
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
