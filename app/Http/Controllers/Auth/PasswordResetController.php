<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class PasswordResetController extends Controller
{
    // Menampilkan form untuk meminta reset password
    public function showResetForm()
    {
        return view('reset');
    }

    // Mengirimkan link reset password ke email
    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        // Cari pengguna berdasarkan email
        $user = \App\Models\User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Email tidak ditemukan atau tidak terdaftar.']);
        }

        // Buat token reset password
        $token = app('auth.password.broker')->createToken($user);

        // Buat URL reset password
        $resetUrl = url(route('password.reset', ['token' => $token, 'email' => $request->email]));

        // Kirim email menggunakan view kustom
        Mail::send('reset-password', ['resetUrl' => $resetUrl], function ($message) use ($request) {
            $message->to($request->email)
                    ->subject('Reset Password Notification');
        });

        return back()->with(['status' => 'Link reset password telah dikirim ke email Anda.']);
    }

    // Menampilkan form untuk memasukkan password baru
    public function showNewPasswordForm($token)
    {
        return view('new-password', ['token' => $token]);
    }

    // Memproses reset password
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }
}