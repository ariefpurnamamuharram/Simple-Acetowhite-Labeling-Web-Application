<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function changePassword(Request $request): RedirectResponse
    {
        $validate = Validator::make($request->all(), [
            'password' => 'required'
        ]);

        $this->validate($request, [
            'currentPassword' => 'required',
            'password' => 'required|min:8|confirmed'
        ]);

        if (Hash::check($request->currentPassword, Auth::user()->password)) {
            User::where('id', Auth::user()->id)->first()->update([
                'password' => Hash::make($request->password),
            ]);

            return redirect()
                ->back()
                ->with('message', 'Password Anda berhasil diubah!');
        } else {
            return redirect()
                ->back()
                ->with('message', 'Password Anda saat in salah!');
        }
    }
}
