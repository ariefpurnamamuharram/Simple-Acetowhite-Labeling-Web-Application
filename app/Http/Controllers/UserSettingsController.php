<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserSettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function update(Request $request): RedirectResponse
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if (!empty($validate->passes())) {
            User::where('id', Auth::user()->id)->first()->update([
                'name' => $request->name,
            ]);

            return redirect()
                ->back()
                ->with('message', 'Data diri Anda berhasil dibubah.');
        } else {
            return redirect()
                ->back()
                ->with('message', 'Kolom nama tidak boleh kosong');
        }
    }

    public function changePassword(Request $request): RedirectResponse
    {
        $validate = Validator::make($request->all(), [
            'password' => 'required'
        ]);

        if (!empty($validate->passes())) {
            User::where('id', Auth::user()->id)->first()->update([
                'password' => Hash::make($request->password),
            ]);

            return redirect()
                ->back()
                ->with('message', 'Password Anda berhasil diubah.');
        } else {
            return redirect()
                ->back()
                ->with('message', 'Kolom password tidak boleh dikosongkan.');
        }
    }

    public function index()
    {
        return view('user.index');
    }
}
