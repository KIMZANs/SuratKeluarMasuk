<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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
        return view('admin.akun', compact('user'));
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
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id, // Pastikan email unik kecuali untuk pengguna ini
            'password' => 'nullable|min:8', // Password opsional, minimal 8 karakter jika diisi
            'role' => 'required|in:penandatangan,reviewer', // Validasi role hanya boleh salah satu dari opsi
            'status' => 'required|in:active,inactive', // Validasi status hanya boleh active/inactive
        ]);

        // Update data pengguna
        $user->name = $request->name;
        $user->email = $request->email;

        // Jika password diisi, maka update password
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->role = $request->role;
        $user->status = $request->status;

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

    /**
     * Menghapus pengguna dari database.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // Temukan pengguna berdasarkan ID, jika tidak ditemukan akan memunculkan 404
        $user = User::findOrFail($id);

        // Hapus pengguna dari database
        $user->delete();

        // Redirect kembali ke halaman daftar pegawai dengan pesan sukses
        return redirect()->route('admin.pegawai')->with('success', 'Pengguna berhasil dihapus.');
    }
}