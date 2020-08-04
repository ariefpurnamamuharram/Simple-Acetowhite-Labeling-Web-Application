<?php

namespace App\Http\Controllers;

use App\ImageArtifact;
use App\ImageUpload;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    private const LABEL_POSITIVE_CODE = 1;

    private const LABEL_NEGATIVE_CODE = 0;

    private const LABEL_UNKNOWN_CODE = 99;

    private function checkBoolValue($value)
    {
        if (!empty($value)) {
            return true;
        } else {
            return false;
        }
    }

    public function index()
    {
        return view('dashboard.dashboard', [
            'files' => ImageUpload::orderBy('id', 'DESC')->paginate(8),
        ]);
    }

    public function showPositives()
    {
        return view('dashboard.dashboard', [
            'files' => ImageUpload::orderBy('id', 'DESC')->where('label', self::LABEL_POSITIVE_CODE)->paginate(8),
        ]);
    }

    public function showNegatives()
    {
        return view('dashboard.dashboard', [
            'files' => ImageUpload::orderBy('id', 'DESC')->where('label', self::LABEL_NEGATIVE_CODE)->paginate(8),
        ]);
    }

    public function showNotLabelled()
    {
        return view('dashboard.dashboard', [
            'files' => ImageUpload::orderBy('id', 'DESC')->where('label', self::LABEL_UNKNOWN_CODE)->paginate(8),
        ]);
    }

    public function edit($requestid)
    {
        return view('file.file_edit', [
            'file' => ImageUpload::where('filename_post_iva', $requestid)->first(),
            'artifact' => ImageArtifact::where('filename', $requestid)->first(),
        ]);
    }

    public function update(Request $request)
    {
        // Get IVA file and editor name.
        if (isset($request->lblIVA)) {
            $lblIVA = $request->lblIVA;
        } else {
            $lblIVA = ImageUpload::IMAGE_NOT_LABELED_CODE;
        }

        // Get pre IVA image.
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
            'label' => $lblIVA,
            'comment' => $request->comment
        ]);

        ImageArtifact::where('filename', $request->filename_post_iva)->update([
            'cbMetaplasiaRing' => $this->checkBoolValue($request->has('cbMetaplasiaRing')),
            'cbIUD' => $this->checkBoolValue($request->has('cbIUD')),
            'cbMenstrualBlood' => $this->checkBoolValue($request->has('cbMenstrualBlood')),
            'cbSlime' => $this->checkBoolValue($request->has('cbSlime')),
            'cbFluorAlbus' => $this->checkBoolValue($request->has('cbFluorAlbus')),
            'cbCervicitis' => $this->checkBoolValue($request->has('cbCervicitis')),
            'cbPolyp' => $this->checkBoolValue($request->has('cbPolyp')),
            'cbOvulaNabothi' => $this->checkBoolValue($request->has('cbOvulaNabothi')),
            'cbEctropion' => $this->checkBoolValue($request->has('cbEctropion'))
        ]);

        return redirect()
            ->route('dashboard')
            ->with('message', 'Data foto berhasil diperbaharui');
    }

    public function delete($request): RedirectResponse
    {
        File::delete(public_path('files/images/iva/' . $request));

        ImageUpload::where('filename_post_iva', $request)->first()->delete();
        ImageArtifact::where('filename', $request)->first()->delete();

        return redirect()
            ->back()
            ->with('message', 'Data berhasil dihapus');
    }
}
