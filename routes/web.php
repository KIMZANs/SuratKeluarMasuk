<?php
// filepath: c:\xampp\htdocs\Surat\routes\web.php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\PenggunaDashboardController;
use App\Http\Controllers\PenandatanganDashboardController;
use App\Http\Controllers\ReviewerDashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\PasswordResetController;

// Halaman utama (login)
Route::get('/', function () {
    return view('login');
})->name('login');

// Route untuk login
Route::get('/login', function () {
    return view('login');
})->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate');

Route::get('password/reset', [PasswordResetController::class, 'showResetForm'])->name('password.request');
Route::post('password/email', [PasswordResetController::class, 'sendResetLink'])->name('password.email');
Route::get('password/reset/{token}', [PasswordResetController::class, 'showNewPasswordForm'])->name('password.reset');
Route::post('password/reset', [PasswordResetController::class, 'resetPassword'])->name('password.update');

// Route untuk logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Route untuk admin dashboard
Route::prefix('admin')->group(function () {
    // Route untuk Dashboard Admin
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    // Route untuk Jabatan
    Route::get('/jabatan', [AdminDashboardController::class, 'indexJabatan'])->name('admin.jabatan');
    Route::post('/jabatan/store', [AdminDashboardController::class, 'storeJabatan'])->name('admin.jabatan.store');
    Route::put('/jabatan/{id}', [AdminDashboardController::class, 'updateJabatan'])->name('admin.jabatan.update');
    Route::delete('/jabatan/{id}', [AdminDashboardController::class, 'destroyJabatan'])->name('admin.jabatan.destroy');
    // Route untuk Jabatan Golongan
    Route::get('/goljabatan', [AdminDashboardController::class, 'indexGolonganJabatan'])->name('admin.goljabatan');
    Route::post('/goljabatan/store', [AdminDashboardController::class, 'storeGolonganJabatan'])->name('admin.goljabatan.store');
    Route::put('/goljabatan/{id}', [AdminDashboardController::class, 'updateGolonganJabatan'])->name('admin.goljabatan.update');
    Route::delete('/goljabatan/{id}', [AdminDashboardController::class, 'destroyGolonganJabatan'])->name('admin.goljabatan.destroy');
    // Route untuk Unit Kerja
    Route::get('/unitkerja', [AdminDashboardController::class, 'indexUnitkerja'])->name('admin.unitkerja');
    Route::post('/unitkerja/store', [AdminDashboardController::class, 'storeUnitkerja'])->name('admin.unitkerja.store');
    Route::put('/unitkerja/{id}', [AdminDashboardController::class, 'updateUnitkerja'])->name('admin.unitkerja.update');
    Route::delete('/unitkerja/{id}', [AdminDashboardController::class, 'destroyUnitkerja'])->name('admin.unitkerja.destroy');
    // Route untuk Pengguna
    Route::get('/pegawai', [AdminDashboardController::class, 'indexPegawai'])->name('admin.pegawai');
    Route::post('/pegawai/{id}/toggle-status', [AdminDashboardController::class, 'toggleStatus'])->name('admin.pegawai.toggleStatus');
    Route::post('/pegawai/store', [AdminDashboardController::class, 'storePegawai'])->name('admin.pegawai.store');
    Route::put('/pegawai/{id}', [AdminDashboardController::class, 'updatePegawai'])->name('admin.pegawai.update');
    Route::delete('/pegawai/{id}', [AdminDashboardController::class, 'destroyPegawai'])->name('admin.pegawai.destroy');

    Route::get('/surat_masuk', [AdminDashboardController::class, 'indexSurat_masuk'])->name('admin.surat_masuk');
    Route::post('/admin/surat_masuk', [AdminDashboardController::class, 'storeSuratMasuk'])->name('admin.surat_masuk.store');
    Route::get('/surat_keluar', [AdminDashboardController::class, 'indexSurat_keluar'])->name('admin.surat_keluar');
    Route::get('/surat_masuk/{id}', [AdminDashboardController::class, 'showSuratMasuk'])->name('admin.surat_masuk.show');
    Route::post('/surat_masuk/{id}/update', [AdminDashboardController::class, 'updateSuratMasuk'])->name('admin.surat_masuk.update');
    Route::delete('/surat_masuk/{id}', [AdminDashboardController::class, 'deleteSuratMasuk'])->name('admin.surat_masuk.delete');
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

Route::get('/provinsi', [UserController::class, 'getProvinsi']);