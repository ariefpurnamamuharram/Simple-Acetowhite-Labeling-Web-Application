<?php

namespace App\Http\Controllers;

use App\ImageAreaMark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ImageAreaMarkController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($requestid)
    {
        $files = ImageAreaMark::where('filename', $requestid)->get();

        return view('label.imageareamark', compact([
            'requestid',
            'files',
        ]));
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'filename' => 'required',
            'rectX0' => 'required',
            'rectY0' => 'required',
            'rectX1' => 'required',
            'rectY1' => 'required',
            'imageMarkLabel' => 'required',
            'textDescription' => 'nullable',
        ]);

        if (!empty($validate->passes())) {
            ImageAreaMark::create([
                'filename' => $request->filename,
                'rect_x0' => $request->rectX0,
                'rect_y0' => $request->rectY0,
                'rect_x1' => $request->rectX1,
                'rect_y1' => $request->rectY1,
                'label' => $request->imageMarkLabel,
                'description' => $this->markDescription($request->textDescription)
            ]);

            return redirect()
                ->back()
                ->with('message', 'Data berhasil disimpan!');
        } else {
            return redirect()
                ->back()
                ->with('message', 'Gagal menyimpan! Periksa kembali isian Anda.');
        }
    }

    public function delete($requestid)
    {
        ImageAreaMark::where('id', $requestid)->first()->delete();

        return redirect()
            ->back()
            ->with('message', 'Markah berhasil dihapus!');
    }

    private function markDescription($value)
    {
        if (empty($value)) {
            return "";
        } else {
            return $value;
        }
    }
}
