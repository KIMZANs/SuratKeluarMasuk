<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Periksa status pengguna
            $user = Auth::user();
            if ($user->status === 'inactive') {
                Auth::logout(); // Logout pengguna
                return back()->with('error', 'Akun Anda tidak aktif. Silakan hubungi admin.');
            }

            // Periksa role pengguna dan arahkan ke dashboard yang sesuai
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->role === 'penandatangan') {
                return redirect()->route('penandatangan.dashboard');
            } elseif ($user->role === 'reviewer') {
                return redirect()->route('reviewer.dashboard');
            }
        }

        // Jika login gagal, set flash message
        return back()->with('error', 'Email atau password salah atau belum terdaftar.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}