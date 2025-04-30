<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuratKeluar;
use App\Models\SuratMasuk;
use Illuminate\Support\Facades\Auth; // Tambahkan Auth untuk mendapatkan pengguna yang login
use App\Models\User;

class PenggunaDashboardController extends Controller
{
    /**
     * Menampilkan halaman dashboard pengguna.
     */
    public function index()
    {
        $totalSuratMasuk = SuratMasuk::count(); // Hitung total surat masuk
        $totalSuratKeluar = SuratKeluar::count(); // Hitung total surat keluar

        // Kirim data total surat masuk dan keluar ke view
        return view('pengguna.dashboard', compact('totalSuratMasuk', 'totalSuratKeluar'));
    }

    /**
     * Menampilkan halaman pengaturan akun pengguna.
     */
    public function pengaturan()
    {
        // Ambil data pengguna yang sedang login
        $user = Auth::user();

        // Kirim data pengguna ke view 'pengaturan'
        return view('pengguna.pengaturan', compact('user'));
    }

    /**
     * Menyimpan perubahan data pengguna.
     */
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|min:8',
        ]);

        // Temukan pengguna berdasarkan ID
        $user = User::findOrFail($id);

        // Update data pengguna
        $user->name = $request->name;
        $user->email = $request->email;

        // Jika password diisi, update password
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        // Redirect kembali ke halaman pengaturan dengan pesan sukses
        return redirect()->route('pengguna.pengaturan')->with('success', 'Profil berhasil diperbarui.');
    }

    /**
     * Menampilkan halaman surat masuk.
     */
    public function suratMasuk()
    {
        $suratMasuk = \App\Models\SuratMasuk::all(); // Ambil semua data surat masuk
        return view('pengguna.surat_masuk', compact('suratMasuk'));
    }

    /**
     * Menampilkan halaman surat keluar.
     */
    public function suratKeluar()
    {
        $suratKeluar = \App\Models\SuratKeluar::all(); // Ambil semua data surat keluar
        return view('pengguna.surat_keluar', compact('suratKeluar'));
    }
}
