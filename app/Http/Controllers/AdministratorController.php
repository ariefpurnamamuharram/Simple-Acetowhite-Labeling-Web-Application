<?php

namespace App\Http\Controllers;

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
