<?php

namespace App\Http\Middleware;

use App\UserDetails;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckAdministrator
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (UserDetails::where('email', Auth::user()->email)->first()->is_administrator == true) {
            return $next($request);
        } else {
            return redirect()
                ->route('dashboard')
                ->with('message', 'Operasi ilegal! Anda tidak diizinkan untuk mengakses halaman ini.');
        }
    }
}
