<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class RegisterController extends Controller
{
    /**
     * Menampilkan halaman register.
     */
    public function create()
    {
        return view('admin.register'); // Pastikan file register.blade.php ada di folder resources/views
    }

    /**
     * Menyimpan data registrasi.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'nip' => 'required|string|max:20|unique:users,nip',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'role' => 'required|in:penandatangan,reviewer',
        ]);

        // Buat pengguna baru dengan status 'inactive'
        User::create([
            'name' => $request->name,
            'nip' => $request->nip,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
            'status' => 'inactive',
        ]);

        // Set flash message
        return redirect()->route('admin.pegawai')->with('success', 'Akun pegawai berhasil dibuat.');
    }
}