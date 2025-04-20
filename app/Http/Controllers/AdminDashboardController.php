<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Jabatan;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Logika untuk dashboard admin
        return view('Admin.dashboard');
    }

    public function indexPegawai(Request $request)
    {
        $search = $request->input('search');

        // Ambil data pengguna dengan filter pencarian
        $users = User::where('role', '!=', 'admin')
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%")
                             ->orWhere('nip', 'like', "%{$search}%");
            })
            ->get();

        return view('Admin.pegawai', compact('users'));
    }

    public function toggleStatus($id)
    {
        // Temukan pengguna berdasarkan ID
        $user = User::findOrFail($id);

        // Ubah status: jika 'active', ubah ke 'inactive', dan sebaliknya
        $user->status = $user->status === 'active' ? 'inactive' : 'active';

        // Simpan perubahan ke database
        $user->save();

        // Redirect kembali ke halaman daftar pegawai dengan pesan sukses
        return redirect()->route('admin.pegawai')->with('success', 'Status pengguna berhasil diubah.');
    }

    public function indexJabatan(Request $request)
    {
        $search = $request->input('search');

        // Ambil data jabatan dengan filter pencarian
        $jabatans = Jabatan::when($search, function ($query, $search) {
            return $query->where('nama_jabatan', 'like', "%{$search}%");
        })->get();

        return view('Admin.jabatan', compact('jabatans'));
    }

    public function storeJabatan(Request $request)
    {
        $request->validate([
            'nama_jabatan' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        Jabatan::create([
            'nama_jabatan' => $request->nama_jabatan,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('admin.jabatan')->with('success', 'Jabatan berhasil ditambahkan.');
    }
}
