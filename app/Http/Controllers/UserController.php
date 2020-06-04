<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('user.index');
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

    public function generateApiToken(Request $request): RedirectResponse
    {
        User::where('email', Auth::user()->email)->first()->update([
            'api_token' => Str::random(60),
        ]);

        return redirect()
            ->back()
            ->with('message', 'API Token berhasil dihasilkan!');
    }

    public function revokeApiToken(Request $request): RedirectResponse
    {
        User::where('email', Auth::user()->email)->first()->update([
            'api_token' => null,
        ]);

        return redirect()
            ->back()
            ->with('message', 'API Token berhasil dihapus!');
    }
}
