<?php

namespace App\Http\Controllers;

use App\ImageArtifact;
use App\ImageLabel;
use App\ImageUpload;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            'files' => ImageLabel::where([
                'email' => Auth::user()->email,
                'label' => self::LABEL_POSITIVE_CODE])->orderBy('id', 'DESC')->paginate(8),
        ]);
    }

    public function showNegatives()
    {
        return view('dashboard.dashboard', [
            'files' => ImageLabel::where([
                'email' => Auth::user()->email,
                'label' => self::LABEL_NEGATIVE_CODE])->orderBy('id', 'DESC')->paginate(8),
        ]);
    }

    public function edit($requestid)
    {
        if (empty(ImageLabel::where(['filename' => $requestid, 'email' => Auth::user()->email])->first())) {
            ImageLabel::create([
                'filename' => $requestid,
                'email' => Auth::user()->email,
            ]);
        }

        return view('file.file_edit', [
            'file' => ImageLabel::where(['filename' => $requestid, 'email' => Auth::user()->email])->first(),
        ]);
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'filename_post_iva' => 'required',
            'lblIVA' => 'required',
            'comment' => 'nullable',
        ]);

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

            // Record file.
            ImageUpload::where('filename_post_iva', $request->filename_post_iva)->first()->update([
                'filename_pre_iva' => $filenameWithExt,
                'path_pre_iva' => $filenameWithExt,
            ]);
        }

        if (!empty(ImageLabel::where(['filename' => $request->filename_post_iva, 'email' => Auth::user()->email])->get())) {
            ImageLabel::where([
                'filename' => $request->filename_post_iva,
                'email' => Auth::user()->email,
            ])->first()->update([
                'label' => $request->lblIVA,
                'comment' => $request->comment,
            ]);
        } else {
            ImageLabel::create([
                'filename' => $request->filename_post_iva,
                'email' => Auth::user()->email,
                'label' => $request->lblIVA,
                'comment' => $request->comment,
            ]);
        }

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
