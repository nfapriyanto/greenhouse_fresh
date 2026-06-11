<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Redirect setelah login
     */
    protected function redirectTo()
    {
        // Jika admin
        if (auth()->user()->role === 'admin') {

            return '/admin/dashboard';
        }

        // Jika pembeli / user
        return '/';
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}