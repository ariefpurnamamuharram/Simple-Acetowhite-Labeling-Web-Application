@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <h2 class="font-weight-bold" style="color: #FF357C!important;">
            <span>Dasbor Ringkasan</span>
        </h2>

        <hr/>

        <div class="table-responsive mt-2">
            <table class="table table-hover">
                <thead>
                <tr class="text-center text-white" style="background-color: #FF357C!important;">
                    <th>ID</th>
                    <th>Pratinjau</th>
                    <th>Ekspertise Kolektif</th>
                </tr>
                </thead>

                <tbody>
                @foreach($files as $file)
                    <tr>
                        <td class="text-center">{{ $file->id }}</td>
                        <td class="text-center">
                            <div class="row">
                                <div class="col">
                                    <div class="d-flex justify-content-center">
                                        @if(empty($file->filename_pre_iva))
                                            <img src="{{ asset('assets/images/no-image.png') }}" height="72px">
                                        @else
                                            <img src="{{ url('files/images/iva/'.$file->filename_pre_iva) }}"
                                                 height="72px">
                                        @endif
                                    </div>

                                    <div class="d-flex justify-content-center">
                                        <span class="font-weight-bold">Pre IVA</span>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="d-flex justify-content-center">
                                        <img src="{{ url('files/images/iva/'.$file->filename_post_iva) }}"
                                             height="72px">
                                    </div>

                                    <div class="d-flex justify-content-center">
                                        <span class="font-weight-bold">Post IVA</span>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="accordion">
                                <ul>
                                    @foreach(ImageLabel::where('filename', $file->filename_post_iva)->get() as $image)
                                        @if($image->label != ImageUpload::IMAGE_NOT_LABELED_CODE)
                                            <li>
                                                <a class="text-decoration-none font-weight-bold">
                                                    {{ User::where('email', $image->email)->first()->name }} @switch($image->label)
                                                        @case(ImageUpload::IMAGE_LABEL_POSITIVE_CODE)
                                                        <span class="text-danger">(Positif)</span>
                                                        @break
                                                        @case(ImageUpload::IMAGE_LABEL_NEGATIVE_CODE)
                                                        <span class="text-success">(Negatif)</span>
                                                        @break
                                                    @endswitch
                                                </a> @if(!empty(ImageAreaMark::where(['filename' => $image->filename, 'email' => $image->email])->first()))
                                                    <a href="{{ route('image.mark', $image->filename) }}"
                                                       target="_blank">[Marka]</a>
                                                @endif<br>
                                                <span><span class="font-weight-bold">Komentar: </span>{{ $image->comment }}</span>
                                            </li><br>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
