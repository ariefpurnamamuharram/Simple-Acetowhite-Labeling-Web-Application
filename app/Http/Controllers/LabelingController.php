<?php

namespace App\Http\Controllers;

use App\ImageArtifact;
use App\ImageMark;
use App\ImageUpload;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class LabelingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $files = ImageUpload::orderBy('id', 'DESC')->paginate(8);

        return view('label.labelindex', compact([
            'files'
        ]));
    }

    public function showPositives()
    {
        $files = ImageUpload::orderBy('id', 'DESC')->where('label', 1)->paginate(8);

        return view('label.labelindex', compact([
            'files'
        ]));
    }

    public function showNegatives()
    {
        $files = ImageUpload::orderBy('id', 'DESC')->where('label', 0)->paginate(8);

        return view('label.labelindex', compact([
            'files'
        ]));
    }

    public function showNotLabelled()
    {
        $files = ImageUpload::orderBy('id', 'DESC')->where('label', 99)->paginate(8);

        return view('label.labelindex', compact([
            'files'
        ]));
    }

    public function search(Request $request)
    {
        $file = ImageUpload::where('id', $request->search)->first();

        if (!empty($file)) {
            return view('label.labeledit', compact([
                'file'
            ]));
        } else {
            return view('error.filenotfound');
        }
    }

    public function edit($requestid)
    {
        $file = ImageUpload::where('filename_post_iva', $requestid)->first();
        $artifact = ImageArtifact::where('filename', $requestid)->first();

        return view('label.labeledit', compact([
            'file',
            'artifact',
        ]));
    }

    public function update(Request $request)
    {
        // Get IVA label and editor name.
        $lblIVA = null;
        $editor = null;
        if (isset($request->lblIVA)) {
            $lblIVA = $request->lblIVA;
            $editor = Auth::User()->name;
        } else {
            $lblIVA = 99;
            $editor = '';
        }

        // Get image comment.
        $comment = null;
        if (!empty($request->comment)) {
            $comment = $request->comment;
        } else {
            $comment = '-';
        }

        // Get pre IVA image.
        $filenamePreIVA = null;
        if (!empty($request->preIVAImage)) {
            $image = $request->file('preIVAImage');
            $imageName = $image->getClientOriginalName();

            // Image will be put in files public folder.
            $ext = pathinfo($imageName, PATHINFO_EXTENSION);
            $filename = Str::random(24);
            $filenameWithExt = $filename . "." . $ext;

            // Move image to public folder.
            $image->move(public_path('files/images/iva'), $filenameWithExt);

            $filenamePreIVA = $filenameWithExt;
        } else {
            $filenamePreIVA = '';
        }

        ImageUpload::where('filename_post_iva', $request->filename_post_iva)->update([
            'filename_pre_iva' => $filenamePreIVA,
            'path_pre_iva' => $filenamePreIVA,
            'edited_by' => $editor,
            'label' => $lblIVA,
            'comment' => $comment
        ]);

        ImageArtifact::where('filename', $request->filename_post_iva)->update([
            'cbMetaplasiaRing' => $this->getImageArtifactValue($request->has('cbMetaplasiaRing')),
            'cbIUD' => $this->getImageArtifactValue($request->has('cbIUD')),
            'cbMenstrualBlood' => $this->getImageArtifactValue($request->has('cbMenstrualBlood')),
            'cbSlime' => $this->getImageArtifactValue($request->has('cbSlime')),
            'cbFluorAlbus' => $this->getImageArtifactValue($request->has('cbFluorAlbus')),
            'cbCervicitis' => $this->getImageArtifactValue($request->has('cbCervicitis')),
            'cbPolyp' => $this->getImageArtifactValue($request->has('cbPolyp')),
            'cbOvulaNabothi' => $this->getImageArtifactValue($request->has('cbOvulaNabothi')),
            'cbEctropion' => $this->getImageArtifactValue($request->has('cbEctropion'))
        ]);

        return redirect()
            ->route('label.index')
            ->with('success', 'Data foto berhasil diperbaharui');
    }

    private function getImageArtifactValue($value)
    {
        if (!empty($value)) {
            return true;
        } else {
            return false;
        }
    }

    public function mark($request): RedirectResponse
    {
        $imageMark = null;
        if (ImageMark::where('filename', $request)->value('is_marked') === 0) {
            $imageMark = true;
        } else {
            $imageMark = false;
        }

        ImageMark::where('filename', $request)->update([
            'is_marked' => $imageMark,
        ]);

        return redirect()
            ->back()
            ->with('success', 'Tanda foto berhasil berubah.');
    }

    public function delete($request): RedirectResponse
    {
        ImageUpload::where('filename_post_iva', $request)->first()->delete();
        ImageArtifact::where('filename', $request)->first()->delete();

        return redirect()
            ->back()
            ->withSuccess(sprintf("Data berhasil dihapus"));
    }
}
