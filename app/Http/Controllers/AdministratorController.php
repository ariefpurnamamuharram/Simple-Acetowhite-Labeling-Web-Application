<?php

namespace App\Http\Controllers;

use App\ImageAreaMark;
use App\ImageLabel;
use App\ImageUpload;
use App\User;
use App\UserDetails;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdministratorController extends Controller
{
    public function __construct()
    {
        $this->middleware('check.administrator');
    }

    private function checkBoolValue($value)
    {
        if (!empty($value)) {
            return true;
        } else {
            return false;
        }
    }

    public function users()
    {
        $users = User::orderBy('name', "ASC")->paginate(8);

        return view('administrator.users.users_list', [
            'users' => $users,
        ]);
    }

    public function dashboard()
    {
        return view('administrator.dashboard.dashboard', [
            'files' => ImageUpload::orderBy('id', 'DESC')->paginate(8),
        ]);
    }

    public function dashboardInconclusiveImages()
    {
        // Get all images.
        $images = ImageUpload::orderBy('id', 'DESC')->get();

        // Initiate inconclusive images array.
        $inconclusiveImages = [];

        // Iterate through each of the images data.
        foreach ($images as $key => $value) {
            // Get all image labels.
            $imageLabels = ImageLabel::where('filename', $value->filename_post_iva)->get();

            // Check if count of the image labels is more than one.
            if (count($imageLabels) > 1) {
                // Initiate count positive and negative labels.
                $countPositives = 0;
                $countNegatives = 0;

                // Iterate through each of the image labels given.
                foreach ($imageLabels as $key2 => $value2) {
                    if ($value2->label == ImageUpload::IMAGE_LABEL_POSITIVE_CODE) {
                        $countPositives += 1;
                    }

                    if ($value2->label == ImageUpload::IMAGE_LABEL_NEGATIVE_CODE) {
                        $countNegatives += 1;
                    }
                }

                // If positive and negative image labels is fifty:fifty then assigned as inconclusive image.
                if ($countPositives == $countNegatives) {
                    array_push($inconclusiveImages, $value->filename_post_iva);
                }
            }
        }

        // Return view.
        return view('administrator.dashboard.inconclusive_images.dashboard', [
            'images' => $inconclusiveImages,
        ]);
    }

    public function imageAreaMarks($email, $filename)
    {
        return view('administrator.file.image_area_mark', [
            'filename' => $filename,
            'files' => ImageAreaMark::where([
                'filename' => $filename,
                'email' => $email,
            ])->get(),
        ]);
    }

    public function newUser()
    {
        return view('administrator.users.user_new');
    }

    public function storeUser(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'cbAdministrator' => 'nullable',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        UserDetails::create([
            'email' => $request->email,
            'is_administrator' => $this->checkBoolValue($request->cbAdministrator),
        ]);

        return redirect()
            ->back()
            ->with('message', 'Akun pengguna berhasil dibuat!');
    }

    public function deleteUser(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'email' => 'required',
        ]);

        // Delete records
        User::where('email', $request->email)->first()->delete();
        UserDetails::where('email', $request->email)->first()->delete();

        return redirect()
            ->back()
            ->with('message', 'Akun pengguna berhasil dihapus!');
    }
}
