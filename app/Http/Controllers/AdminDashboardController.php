<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Jabatan;
use App\Models\GolonganJabatan;
use App\Models\SuratKeluar;
use App\Models\SuratMasuk;
use App\Models\UnitKerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Hitung jumlah pegawai aktif dan tidak aktif
        $pegawaiActive = \App\Models\User::where('status', 'active')->where('role', '!=', 'admin')->count();
        $pegawaiInactive = \App\Models\User::where('status', 'inactive')->where('role', '!=', 'admin')->count();
        $totalSuratMasuk = SuratMasuk::count();
        $totalSuratKeluar = SuratKeluar::count();


        // Kirim data ke view
        return view('Admin.dashboard', compact('pegawaiActive', 'pegawaiInactive', 'totalSuratMasuk', 'totalSuratKeluar'));
    }

    public function indexPegawai(Request $request)
    {
        $search = $request->input('search'); // Ambil input pencarian
        $users = User::where('role', '!=', 'admin') // Filter agar admin tidak muncul
            ->when($search, function ($query, $search) {
                return $query->where(function ($query) use ($search) {
                    $query->where('nama', 'like', "%{$search}%")
                          ->orWhere('nip', 'like', "%{$search}%");
                });
            })
            ->paginate(10);

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
            'nama' => 'required|string|max:255',
            'nip' => 'required|string|max:20|unique:users,nip',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|in:pengguna,reviewer,penandatangan',
            'password' => 'required|string|min:8',
            'unit_kerja' => 'required|in:Unit Kerja 1,Unit Kerja 2,Unit Kerja 3', // Ganti dengan unit kerja yang sesuai
        ]);

        User::create([
            'nama' => $request->nama,
            'nip' => $request->nip,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
            'unit_kerja' => $request->unit_kerja,
            'status' => 'inactive', // Default status
        ]);

        return redirect()->route('admin.pegawai')->with('success', 'Pegawai berhasil ditambahkan.');
    }

    // Contoler untuk Jabatan
    public function indexJabatan(Request $request)
    {
        $search = $request->input('search');

        $jabatans = Jabatan::when($search, function ($query, $search) {
            return $query->where('nama_jabatan', 'like', "%{$search}%");
        })->paginate(2);

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

    public function updateJabatan(Request $request, $id)
    {
        $request->validate([
            'nama_jabatan' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        $jabatan = Jabatan::findOrFail($id);
        $jabatan->update([
            'nama_jabatan' => $request->nama_jabatan,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('admin.jabatan')->with('success', 'Jabatan berhasil diperbarui.');
    }

    public function destroyJabatan($id)
    {
        $jabatan = Jabatan::findOrFail($id);
        $jabatan->delete();

        return redirect()->route('admin.jabatan')->with('success', 'Jabatan berhasil dihapus.');
    }

    // Contoler untuk Jabatan Golongan
    public function indexGolonganJabatan(Request $request)
    {
        $search = $request->input('search');

        $golonganJabatan = GolonganJabatan::when($search, function ($query, $search) {
            return $query->where('nama_jabatan', 'like', "%{$search}%");
        })->paginate(10);

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

    public function updateGolonganJabatan(Request $request, $id)
    {
        $request->validate([
            'nama_jabatan' => 'required|string|max:255',
            'nama_golongan' => 'nullable|string',
        ]);

        $golonganJabatan = GolonganJabatan::findOrFail($id);
        $golonganJabatan->update([
            'nama_jabatan' => $request->nama_jabatan,
            'nama_golongan' => $request->nama_golongan,  // make sure this matches the input name in the form
        ]);

        return redirect()->route('admin.goljabatan')->with('success', 'Jabatan Golongan berhasil diperbarui.');
    }

    public function destroyGolonganJabatan($id)
    {
        $golonganJabatan = GolonganJabatan::findOrFail($id);
        $golonganJabatan->delete();

        return redirect()->route('admin.goljabatan')->with('success', 'Jabatan Golongan berhasil dihapus.');
    }

    public function storeSuratMasuk(Request $request)
    {
        $request->validate([
            'nomor_surat' => 'required|array',
            'nomor_surat.*' => 'required|string',
            'pengirim' => 'required|string',
            'tembusan' => 'nullable|array',
            'tanggal' => 'required|date',
            'sifat' => 'required|string',
            'perihal' => 'required|string',
        ]);

        $nomorSurat = implode('/', $request->nomor_surat);

        // Convert the date to the correct format
        $formattedDate = Carbon::createFromFormat('d F Y', $request->tanggal_masuk)->format('Y-m-d');

        SuratMasuk::create([
            'nomor_surat' => $nomorSurat,
            'pengirim' => $request->pengirim,
            'tembusan' => $request->tembusan ? implode(', ', $request->tembusan) : null,
            'tanggal' => $formattedDate,
            'sifat' => $request->sifat,
            'perihal' => $request->perihal,
        ]);

        return redirect()->route('admin.surat_masuk')->with('success', 'Surat masuk berhasil ditambahkan.');
    }

    public function indexsurat_masuk()
    {
        // Ambil semua data dari tabel surat_masuk
        $suratmasuk = \App\Models\SuratMasuk::all();

        // Logika untuk dashboard surat masuk
        return view('Admin.surat_masuk', compact('suratmasuk'));
    }

    public function showSuratMasuk($id)
    {
        $surat = SuratMasuk::findOrFail($id);
        return response()->json($surat); // Kirim data sebagai JSON untuk modal
    }

    public function updateSuratMasuk(Request $request, $id)
    {
        $surat = SuratMasuk::findOrFail($id);
        $surat->update($request->all());

        return redirect()->route('admin.surat_masuk')->with('success', 'Surat masuk berhasil diperbarui.');
    }

    public function deleteSuratMasuk($id)
    {
        $surat = SuratMasuk::findOrFail($id);
        $surat->delete();

        return redirect()->route('admin.surat_masuk')->with('success', 'Surat masuk berhasil dihapus.');
    }

    public function indexsurat_keluar()
    {
        // Ambil semua data dari tabel surat_keluar
        $suratKeluar = \App\Models\SuratKeluar::all();

        // Kirim data ke view
        return view('Admin.surat_keluar', compact('suratKeluar'));
    }
}