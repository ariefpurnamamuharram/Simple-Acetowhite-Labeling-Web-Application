<?php

namespace App\Http\Controllers;

use App\ImageAreaMark;
use App\ImageLabel;
use App\ImageUpload;
use App\User;
use App\UserDetails;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
        $images_preiva = DB::table('image_labels')
            ->join('image_uploads', 'image_labels.filename', '=', 'image_uploads.filename_pre_iva')
            ->select('image_uploads.id', 'image_labels.email')
            ->whereRaw('NOT image_labels.label = 99')
            ->get();
        $images_postiva = DB::table('image_labels')
            ->join('image_uploads', 'image_labels.filename', '=', 'image_uploads.filename_post_iva')
            ->select('image_uploads.id', 'image_labels.email')
            ->whereRaw('NOT image_labels.label = 99')
            ->get();

        return view('administrator.users.users_list', [
            'users' => $users,
            'images_preiva' => $images_preiva,
            'images_postiva' => $images_postiva,
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
                        $countPositives++;
                    }

                    if ($value2->label == ImageUpload::IMAGE_LABEL_NEGATIVE_CODE) {
                        $countNegatives++;
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

    public function resetUserPassword(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'password' => 'required',
            'userEmail' => 'required',
        ]);

        if (Hash::check($request->password, Auth::user()->password)) {
            $newPassword = Str::random(8);
            $user = User::where('email', $request->userEmail)->first();

            $user->update([
                'password' => Hash::make($newPassword),
            ]);

            return redirect()
                ->back()
                ->with('message', sprintf('Password %s telah diubah menjadi %s. Password hanya dapat dilihat sekali, harap mencatat password baru tersebut.', $user->name, $newPassword));
        } else {
            return redirect()
                ->back()
                ->with('message', 'Password yang Anda masukkan salah!');
        }
    }

    public function changeUserRole(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'userEmail' => 'required',
        ]);

        $user = User::where('email', $request->userEmail)->first();
        $userDetail = UserDetails::where('email', $user->email)->first();

        if ($userDetail->is_administrator == true) {
            $userDetail->update([
                'is_administrator' => false,
            ]);
        } else {
            $userDetail->update([
                'is_administrator' => true,
            ]);
        }

        return redirect()
            ->back()
            ->with('message', sprintf('Hak akses akun %s berhasil diubah.', $user->name));
    }
}
