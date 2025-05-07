<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Jabatan;
use App\Models\GolonganJabatan;
use App\Models\SuratKeluar;
use App\Models\SuratMasuk;
use App\Models\UnitKerja;
use App\Models\TembusanSuratMasuk;
use App\Models\TembusanSuratKeluar;
use App\Models\TujuanSuratKeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

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
                return $query->where('nama', 'like', "%{$search}%")
                    ->orWhere('nip', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            })
            ->paginate(10); // Gunakan paginate() untuk mendukung pagination

        $jabatans = Jabatan::all();
        $golongan_jabatans = GolonganJabatan::all();
        $unit_kerjas = UnitKerja::all();

        return view('Admin.pegawai', compact('users', 'jabatans', 'golongan_jabatans', 'unit_kerjas'));
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
            'password' => 'required|string|min:8',
            'role' => 'required|in:pengguna,reviewer,penandatangan',
            'jabatan' => 'required|exists:jabatan,id',
            'golongan_jabatan' => 'required|exists:golongan_jabatan,id',
            'unit_kerja' => 'required|exists:unit_kerja,id',
        ]);

        User::create([
            'nama' => $request->nama,
            'nip' => $request->nip,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'jabatan' => $request->jabatan,
            'golongan_jabatan' => $request->golongan_jabatan,
            'unit_kerja' => $request->unit_kerja,
            'status' => 'inactive', // Default status
        ]);

        return redirect()->route('admin.pegawai')->with('success', 'Pegawai berhasil ditambahkan.');
    }

    public function updatePegawai(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'required|string|max:20|unique:users,nip,' . $id,
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required|in:pengguna,reviewer,penandatangan',
            'jabatan' => 'required|exists:jabatan,id',
            'golongan_jabatan' => 'required|exists:golongan_jabatan,id',
            'unit_kerja' => 'required|exists:unit_kerja,id',
            'password' => 'nullable|string|min:8', // password bisa dikosongkan kalau tidak diubah
        ]);

        $user->nama = $request->nama;
        $user->nip = $request->nip;
        $user->tempat_lahir = $request->tempat_lahir;
        $user->tanggal_lahir = $request->tanggal_lahir;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->jabatan = $request->jabatan;
        $user->golongan_jabatan = $request->golongan_jabatan;
        $user->unit_kerja = $request->unit_kerja;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('admin.pegawai')->with('success', 'Pegawai berhasil diperbarui.');
    }

    public function destroyPegawai($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.pegawai')->with('success', 'Pegawai berhasil dihapus.');
    }

    // Contoler untuk Jabatan
    public function indexJabatan(Request $request)
    {
        $search = $request->input('search');

        $jabatans = Jabatan::when($search, function ($query, $search) {
            return $query->where('nama_jabatan', 'like', "%{$search}%");
        })->paginate(10);

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

        // Tambahkan flash message
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

        // Tambahkan flash message
        return redirect()->route('admin.jabatan')->with('success', 'Jabatan berhasil diperbarui.');
    }

    public function destroyJabatan($id)
    {
        $jabatan = Jabatan::findOrFail($id);

        // Periksa apakah jabatan masih digunakan oleh pengguna
        $usersCount = \App\Models\User::where('jabatan', $id)->count();
        if ($usersCount > 0) {
            return redirect()->route('admin.jabatan')->with('error', 'Jabatan tidak dapat dihapus karena masih digunakan oleh pengguna.');
        }

        $jabatan->delete();

        // Tambahkan flash message
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

        return redirect()->route('admin.goljabatan')->with('success', 'Jabatan Golongan berhasil ditambahkan.');
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

        // Periksa apakah golongan jabatan masih digunakan oleh pengguna
        $usersCount = \App\Models\User::where('golongan_jabatan', $id)->count();
        if ($usersCount > 0) {
            return redirect()->route('admin.goljabatan')->with('error', 'Jabatan Golongan tidak dapat dihapus karena masih digunakan oleh pengguna.');
        }

        $golonganJabatan->delete();

        return redirect()->route('admin.goljabatan')->with('success', 'Jabatan Golongan Jabatan berhasil dihapus.');
    }

    // Contoler untuk Unit Kerja
    public function indexUnitkerja(Request $request)
    {
        $search = $request->input('search');

        $unitKerja = UnitKerja::when($search, function ($query, $search) {
            return $query->where('nama_unitkerja', 'like', "%{$search}%");
        })->paginate(2);

        return view('Admin.unitkerja', compact('unitKerja'));
    }

    public function storeUnitkerja(Request $request)
    {
        $request->validate([
            'nama_unitkerja' => 'required|string|max:255',
            'kode_unitkerja' => 'required|string|max:255',
        ]);

        UnitKerja::create([
            'nama_unitkerja' => $request->nama_unitkerja,
            'kode_unitkerja' => $request->kode_unitkerja,
        ]);

        return redirect()->route('admin.unitkerja')->with('success', 'Unit Kerja berhasil ditambahkan.');
    }

    public function updateUnitkerja(Request $request, $id)
    {
        $request->validate([
            'nama_unitkerja' => 'required|string|max:255',
            'kode_unitkerja' => 'required|string|max:255',
        ]);

        $unitKerja = UnitKerja::findOrFail($id);
        $unitKerja->update([
            'nama_unitkerja' => $request->nama_unitkerja,
            'kode_unitkerja' => $request->kode_unitkerja,  // make sure this matches the input name in the form
        ]);

        return redirect()->route('admin.unitkerja')->with('success', 'Unit Kerja berhasil diperbarui.');
    }

    public function destroyUnitkerja($id)
    {
        $unitKerja = UnitKerja::findOrFail($id);
        $unitKerja->delete();

        return redirect()->route('admin.unitkerja')->with('success', 'Unit Kerja berhasil dihapus.');
    }

    // Contoler untuk Surat Masuk
    public function indexsurat_masuk()
    {
        // Ambil semua data dari tabel surat_masuk
        $suratmasuk = SuratMasuk::latest()->paginate(10);

        // Logika untuk dashboard surat masuk
        return view('Admin.surat_masuk', compact('suratmasuk'));
    }

    public function indexSurat_masuk_tambah()
    {
        $jabatans = Jabatan::all();
        $unitKerja = UnitKerja::all();

        return view('Admin.surat_masuk_tambah', compact('jabatans', 'unitKerja'));
    }

    public function indexSurat_masuk_edit($id)
    {
        $suratmasuk = SuratMasuk::with('tembusans')->findOrFail($id);
        $jabatans = Jabatan::all();
        $unitKerja = UnitKerja::all();

        return view('Admin.surat_masuk_edit', compact('suratmasuk', 'jabatans', 'unitKerja'));
    }

    public function indexSurat_masuk_view($id)
    {
        $suratmasuk = SuratMasuk::with(['unitKerja', 'tembusans.jabatan', 'tembusans.unitKerja'])->findOrFail($id);

        return view('Admin.surat_masuk_view', compact('suratmasuk'));
    }

    public function storeSuratMasuk(Request $request)
    {
        // Validasi input
        $request->validate([
            'nomor_surat' => 'required|array|min:2',
            'nomor_surat.*' => 'required|string',
            'unit_kerja_id' => 'required',
            'pengirim' => 'required',
            'tanggal' => 'required|date',
            'sifat' => 'required|string',
            'perihal' => 'required|string',
            'tembusan' => 'required|array',
            'tembusan.*' => 'required',
        ]);

        try {
            // Ambil data unit kerja untuk mendapatkan kode
            $unitKerja = UnitKerja::find($request->unit_kerja_id);
            $kodeUnitKerja = $unitKerja ? $unitKerja->kode_unitkerja : '';

            // Gabungkan nomor surat dengan kode unit kerja
            $nomorSuratParts = $request->nomor_surat;
            $nomorSuratParts[] = $kodeUnitKerja;
            $nomorSurat = implode('/', $nomorSuratParts);

            // Menyimpan SuratMasuk
            $suratMasuk = SuratMasuk::create([
                'nomor_surat' => $nomorSurat,
                'pengirim' => $request->pengirim,
                'tanggal' => $request->tanggal,
                'sifat' => $request->sifat,
                'perihal' => $request->perihal,
            ]);

            // Menyimpan data Tembusan ke tabel tembusan_suratmasuk
            if (is_array($request->tembusan)) {
                foreach ($request->tembusan as $jabatanId) {
                    TembusanSuratMasuk::create([
                        'surat_masuk_id' => $suratMasuk->id,
                        'jabatan_id' => $jabatanId,
                        'unit_kerja_id' => $request->unit_kerja_id,
                    ]);
                }
            }

            return redirect()->route('admin.surat_masuk')->with('success', 'Surat masuk beserta tembusan berhasil ditambahkan.');
        } catch (\Exception $e) {
            // Tangkap error dan kembalikan dengan pesan
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    public function showSuratMasuk($id)
    {
        $surat = SuratMasuk::findOrFail($id);
        return response()->json($surat); // Kirim data sebagai JSON untuk modal
    }

    public function updateSuratMasuk(Request $request, $id)
    {
        // Validasi input, sesuaikan dengan kebutuhan Anda
        $request->validate([
            'nomor_surat' => 'required|array|min:2',
            'nomor_surat.*' => 'required|string',
            'unit_kerja_id' => 'required',
            'pengirim' => 'required',
            'tanggal' => 'required|date',
            'sifat' => 'required|string',
            'perihal' => 'required|string',
            'tembusan' => 'nullable|array', // Tembusan bisa tidak diubah
            'tembusan.*' => 'nullable|exists:jabatan,id', // Pastikan ID jabatan valid
        ]);

        try {
            DB::beginTransaction();
            // Temukan surat masuk yang akan diupdate
            $suratMasuk = SuratMasuk::findOrFail($id);

            // Ambil data unit kerja untuk mendapatkan kode (jika diperlukan perubahan unit kerja)
            $unitKerjaBaru = UnitKerja::find($request->unit_kerja_id);
            $kodeUnitKerjaBaru = $unitKerjaBaru ? $unitKerjaBaru->kode_unitkerja : '';

            // Gabungkan nomor surat dengan kode unit kerja yang baru (jika ada perubahan unit kerja)
            $nomorSuratParts = $request->nomor_surat;
            $nomorSuratParts[] = $kodeUnitKerjaBaru;
            $nomorSuratBaru = implode('/', $nomorSuratParts);

            // Update data SuratMasuk
            $suratMasuk->update([
                'nomor_surat' => $nomorSuratBaru,
                'pengirim' => $request->pengirim,
                'tanggal' => $request->tanggal,
                'sifat' => $request->sifat,
                'perihal' => $request->perihal,
            ]);

            // Sinkronisasi data tembusan
            if ($request->has('tembusan')) {
                // Hapus semua tembusan terkait dengan surat masuk ini
                TembusanSuratMasuk::where('surat_masuk_id', $suratMasuk->id)->delete();

                // Tambahkan tembusan yang baru dipilih
                foreach ($request->tembusan as $jabatanId) {
                    TembusanSuratMasuk::create([
                        'surat_masuk_id' => $suratMasuk->id,
                        'jabatan_id' => $jabatanId,
                        'unit_kerja_id' => $request->unit_kerja_id, // Gunakan unit kerja yang baru
                    ]);
                }
            } else {
                // Jika tidak ada tembusan yang dikirimkan saat update, hapus semua tembusan yang ada
                TembusanSuratMasuk::where('surat_masuk_id', $suratMasuk->id)->delete();
            }

            DB::commit();
            return redirect()->route('admin.surat_masuk')->with('success', 'Surat masuk berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal memperbarui: ' . $e->getMessage())->withInput();
        }
    }

    public function destroySuratMasuk($id)
    {
        $surat = SuratMasuk::findOrFail($id);

        TembusanSuratMasuk::where('surat_masuk_id', $surat->id)->delete();

        $surat->delete();

        return redirect()->route('admin.surat_masuk')->with('success', 'Surat masuk berhasil dihapus.');
    }

    // Contoler untuk Surat Keluar
    public function indexsurat_keluar()
    {
        // Ambil semua data dari tabel surat_masuk
        $suratkeluar = Suratkeluar::latest()->paginate(10);

        // Logika untuk dashboard surat masuk
        return view('Admin.surat_keluar', compact('suratkeluar'));
    }

    public function indexSurat_keluar_tambah()
    {
        $jabatans = Jabatan::all();
        $unitKerja = UnitKerja::all();

        return view('Admin.surat_keluar_tambah', compact('jabatans', 'unitKerja'));
    }

    public function indexSurat_keluar_edit($id)
    {
        $suratkeluar = SuratKeluar::with(['tembusans', 'tujuans'])->findOrFail($id);
        $jabatans = Jabatan::all();
        $unitKerja = UnitKerja::all();

        return view('Admin.surat_keluar_edit', compact('suratkeluar', 'jabatans', 'unitKerja'));
    }

    public function storeSuratKeluar(Request $request)
    {
        // Validasi input
        $request->validate([
            'nomor_surat' => 'required|array|min:2',
            'nomor_surat.*' => 'required|string',
            'unit_kerja_id' => 'required|exists:unit_kerja,id',
            'pengirim' => 'required|exists:jabatan,id',
            'tanggal' => 'required|date',
            'sifat' => 'required|string',
            'perihal' => 'required|string',
            'isi_surat' => 'required|string',
            'tembusan' => 'nullable|array',
            'tembusan.*' => 'nullable|exists:jabatan,id',
            'tujuan' => 'required|array',
            'tujuan.*' => 'required|exists:jabatan,id',
        ]);

        try {
            DB::beginTransaction();

            // Ambil data unit kerja untuk mendapatkan kode
            $unitKerja = UnitKerja::find($request->unit_kerja_id);
            $kodeUnitKerja = $unitKerja ? $unitKerja->kode_unitkerja : '';

            // Gabungkan nomor surat dengan kode unit kerja
            $nomorSuratParts = $request->nomor_surat;
            $nomorSuratParts[] = $kodeUnitKerja;
            $nomorSurat = implode('/', $nomorSuratParts);

            // Menyimpan SuratKeluar
            $suratKeluar = SuratKeluar::create([
                'nomor_surat' => $nomorSurat,
                'pengirim' => $request->pengirim,
                'tanggal' => $request->tanggal,
                'sifat' => $request->sifat,
                'perihal' => $request->perihal,
                'isi_surat' => $request->isi_surat,
            ]);

            // Menyimpan data Tembusan ke tabel tembusan_suratkeluar
            if (is_array($request->tembusan)) {
                foreach ($request->tembusan as $jabatanId) {
                    if (!empty($jabatanId)) {
                        TembusanSuratkeluar::create([
                            'surat_keluar_id' => $suratKeluar->id,
                            'jabatan_id' => $jabatanId,
                            'unit_kerja_id' => $request->unit_kerja_id,
                        ]);
                    }
                }
            }

            // Menyimpan data Tujuan ke tabel tujuan_suratkeluar
            if (is_array($request->tujuan)) {
                foreach ($request->tujuan as $jabatanId) {
                    TujuanSuratKeluar::create([
                        'surat_keluar_id' => $suratKeluar->id,
                        'jabatan_id' => $jabatanId,
                        'unit_kerja_id' => $request->unit_kerja_id,
                    ]);
                }
            }

            DB::commit();
            return redirect()->route('admin.surat_keluar')->with('success', 'Surat keluar beserta tembusan dan tujuan berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollBack();
            // Tangkap error dan kembalikan dengan pesan
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    public function showSuratKeluar($id)
    {
        $surat = SuratKeluar::findOrFail($id);
        return response()->json($surat); // Kirim data sebagai JSON untuk modal
    }

    public function updateSuratKeluar(Request $request, $id)
    {
        $request->validate([
            'nomor_surat' => 'required|array|min:2',
            'nomor_surat.*' => 'required|string',
            'unit_kerja_id' => 'required|exists:unit_kerja,id',
            'pengirim' => 'required|exists:jabatan,id',
            'tanggal' => 'required|date',
            'sifat' => 'required|string',
            'perihal' => 'required|string',
            'isi_surat' => 'required|string',
            'tembusan' => 'nullable|array',
            'tembusan.*' => 'nullable|exists:jabatan,id',
            'tujuan' => 'required|array',
            'tujuan.*' => 'required|exists:jabatan,id',
        ]);

        try {
            DB::beginTransaction();

            $suratKeluar = SuratKeluar::findOrFail($id);

            $unitKerja = UnitKerja::find($request->unit_kerja_id);
            $kodeUnitKerja = $unitKerja ? $unitKerja->kode_unitkerja : '';

            $nomorSuratParts = $request->nomor_surat;
            $nomorSuratParts[] = $kodeUnitKerja;
            $nomorSurat = implode('/', $nomorSuratParts);

            $suratKeluar->update([
                'nomor_surat' => $nomorSurat,
                'pengirim' => $request->pengirim,
                'tanggal' => $request->tanggal,
                'sifat' => $request->sifat,
                'perihal' => $request->perihal,
                'isi_surat' => $request->isi_surat,
            ]);

            // Hapus tembusan dan tujuan lama
            TembusanSuratkeluar::where('surat_keluar_id', $id)->delete();
            TujuanSuratKeluar::where('surat_keluar_id', $id)->delete();

            // Tambah ulang tembusan
            if ($request->tembusan) {
                foreach ($request->tembusan as $jabatanId) {
                    TembusanSuratkeluar::create([
                        'surat_keluar_id' => $id,
                        'jabatan_id' => $jabatanId,
                        'unit_kerja_id' => $request->unit_kerja_id,
                    ]);
                }
            }

            // Tambah ulang tujuan
            foreach ($request->tujuan as $jabatanId) {
                TujuanSuratKeluar::create([
                    'surat_keluar_id' => $id,
                    'jabatan_id' => $jabatanId,
                    'unit_kerja_id' => $request->unit_kerja_id,
                ]);
            }

            DB::commit();
            return redirect()->route('admin.surat_keluar')->with('success', 'Surat keluar berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengupdate: ' . $e->getMessage())->withInput();
        }
    }

    public function destroySuratKeluar($id)
    {
        $surat = SuratKeluar::findOrFail($id);

        TembusanSuratkeluar::where('surat_keluar_id', $surat->id)->delete();
        TujuanSuratKeluar::where('surat_keluar_id', $surat->id)->delete();

        $surat->delete();

        return redirect()->route('admin.surat_keluar')->with('success', 'Surat masuk berhasil dihapus.');
    }
}
