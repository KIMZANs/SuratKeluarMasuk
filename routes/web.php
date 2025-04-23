<?php
// filepath: c:\xampp\htdocs\Surat\routes\web.php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\PenggunaDashboardController;
use App\Http\Controllers\PenandatanganDashboardController;
use App\Http\Controllers\ReviewerDashboardController;
use App\Http\Controllers\UserController;

// Halaman utama (login)
Route::get('/', function () {
    return view('login');
})->name('login');

// Route untuk login
Route::get('/login', function () {
    return view('login');
})->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate');

// Route untuk logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Route untuk admin dashboard
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/jabatan', [AdminDashboardController::class, 'indexJabatan'])->name('admin.jabatan');
    Route::post('/jabatan/store', [AdminDashboardController::class, 'storeJabatan'])->name('admin.jabatan.store');
    Route::get('/pegawai', [AdminDashboardController::class, 'indexPegawai'])->name('admin.pegawai');
    Route::post('/pegawai/{id}/toggle-status', [AdminDashboardController::class, 'toggleStatus'])->name('admin.pegawai.toggleStatus');
    Route::post('/pegawai/store', [AdminDashboardController::class, 'storePegawai'])->name('admin.pegawai.store');
    Route::get('/goljabatan', [AdminDashboardController::class, 'indexGolonganJabatan'])->name('admin.goljabatan');
    Route::post('/goljabatan/store', [AdminDashboardController::class, 'storeGolonganJabatan'])->name('admin.goljabatan.store');
    Route::get('/surat_masuk', [AdminDashboardController::class, 'indexSurat_masuk'])->name('admin.surat_masuk');
    Route::get('/surat_keluar', [AdminDashboardController::class, 'indexSurat_keluar'])->name('admin.surat_keluar');
});

// Route untuk pengguna dashboard
Route::prefix('pengguna')->group(function () {
    Route::get('/dashboard', [PenggunaDashboardController::class, 'index'])->name('pengguna.dashboard');
    Route::get('/surat-masuk', [PenggunaDashboardController::class, 'suratMasuk'])->name('pengguna.surat_masuk');
    Route::get('/surat-keluar', [PenggunaDashboardController::class, 'suratKeluar'])->name('pengguna.surat_keluar');
    Route::get('/pengaturan', [PenggunaDashboardController::class, 'pengaturan'])->name('pengguna.pengaturan');
    Route::put('/pengaturan/{id}', [PenggunaDashboardController::class, 'update'])->name('pengaturan.update');
});

// Route untuk penandatangan dashboard
Route::get('/penandatangan/dashboard', [PenandatanganDashboardController::class, 'index'])->name('penandatangan.dashboard');

// Route untuk reviewer dashboard
Route::get('/reviewer/dashboard', [ReviewerDashboardController::class, 'index'])->name('reviewer.dashboard');

// Route untuk akun pengguna
Route::prefix('akun')->group(function () {
    Route::get('/{name}/edit', [UserController::class, 'edit'])->name('akun.edit');
    Route::put('/{name}', [UserController::class, 'update'])->name('akun.update');
    Route::delete('/{id}', [UserController::class, 'destroy'])->name('akun.destroy');
});