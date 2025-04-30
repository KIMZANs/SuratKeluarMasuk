<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    /**
     * Menampilkan halaman edit akun.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        // Temukan pengguna berdasarkan ID, jika tidak ditemukan akan memunculkan 404
        $user = User::findOrFail($id);

        // Kirim data pengguna ke view 'akun'
        return view('admin.pengaturan', compact('user'));
    }

    /**
     * Memperbarui data akun pengguna di database.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        // Temukan pengguna berdasarkan ID, jika tidak ditemukan akan memunculkan 404
        $user = User::findOrFail($id);

        // Validasi input dari form
        $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'required|string|max:255|unique:users,nip,' . $id, // Pastikan NIP unik kecuali untuk pengguna ini
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'email' => 'required|email|unique:users,email,' . $id, // Pastikan email unik kecuali untuk pengguna ini
            'password' => 'nullable|min:8', // Password opsional, minimal 8 karakter jika diisi
        ]);

        // Update data pengguna
        $user->nama = $request->nama;
        $user->nip = $request->nip;
        $user->tempat_lahir = $request->tempat_lahir;
        $user->tanggal_lahir = $request->tanggal_lahir;
        $user->email = $request->email;

        // Jika password diisi, maka update password
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        // Simpan perubahan ke database
        $user->save();

        // Redirect ke dashboard sesuai role
        if ($user->role === 'penandatangan') {
            return redirect()->route('penandatangan.dashboard')->with('success', 'Akun berhasil diperbarui.');
        } elseif ($user->role === 'reviewer') {
            return redirect()->route('reviewer.dashboard')->with('success', 'Akun berhasil diperbarui.');
        } else {
            return redirect()->route('admin.dashboard')->with('success', 'Akun berhasil diperbarui.');
        }
    }

    public function getProvinsi()
    {
        // Ambil data dari API
        $response = Http::get('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json');

        // Ubah ke array
        $provinsi = $response->json();

        // Kirim ke view
        return view('wilayah.provinsi', compact('provinsi'));
    }
}