<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ConfirmPasswordController extends Controller
{
    // Tampilkan form konfirmasi
    public function showConfirmForm()
    {
        return view('auth.confirm-password');
    }

    // Proses konfirmasi password
    public function confirm(Request $request)
    {
        $request->validate([
            'password' => ['required'],
        ]);

        if (! Hash::check($request->password, $request->user()->password)) {
            return back()->withErrors(['password' => 'Password tidak sesuai.']);
        }

        // Tandai waktu password dikonfirmasi (standar Laravel)
        $request->session()->put('auth.password_confirmed_at', time());

        // Arahkan ke halaman yang tadinya diminta
        return redirect()->intended(route('home'));
    }
}
