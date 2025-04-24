<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Jabatan;
use App\Models\GolonganJabatan;
use App\Models\SuratKeluar;
use App\Models\SuratMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Hitung jumlah pegawai aktif dan tidak aktif
    $pegawaiActive = \App\Models\User::where('status', 'active')->where('role', '!=', 'admin')->count();
    $pegawaiInactive = \App\Models\User::where('status', 'inactive')->where('role', '!=', 'admin')->count();

    // Kirim data ke view
        return view('Admin.dashboard', compact('pegawaiActive', 'pegawaiInactive'));
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

    public function storePegawai(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nip' => 'required|string|max:20|unique:users,nip',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|in:pengguna,reviewer,penandatangan',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi untuk foto
            'unit_kerja' => 'required|string|max:255',
            'password' => 'required|string|min:8',
        ]);

        User::create([
            'name' => $request->name,
            'nip' => $request->nip,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
            'photo' => $request->file('photo') ? $request->file('photo')->store('photos', 'public') : null, // Simpan foto jika ada
            'unit_kerja' => $request->unit_kerja,
            'status' => 'inactive', // Default status
        ]);

        return redirect()->route('admin.pegawai')->with('success', 'Pegawai berhasil ditambahkan.');
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

    public function indexGolonganJabatan()
    {
        $golonganJabatan = GolonganJabatan::all(); // Ambil semua data golongan jabatan
        return view('Admin.goljabatan', compact('golonganJabatan'));
    }

    public function storeGolonganJabatan(Request $request)
    {
        $request->validate([
            'nama_jabatan' => 'required|string|max:255',
            'nama_golongan' => 'required|string|max:255',
        ]);

        GolonganJabatan::create([
            'nama_jabatan' => $request->nama_jabatan,
            'nama_golongan' => $request->nama_golongan,
        ]);

        return redirect()->route('admin.goljabatan')->with('success', 'Golongan Jabatan berhasil ditambahkan.');
    }

    public function indexsurat_masuk()
    {
        // Logika untuk dashboard surat masuk
        return view('Admin.surat_masuk');
    }

    public function indexsurat_keluar()
    {
        // Ambil semua data dari tabel surat_keluar
        $suratKeluar = \App\Models\SuratKeluar::all();

        // Kirim data ke view
        return view('Admin.surat_keluar', compact('suratKeluar'));
    }
}