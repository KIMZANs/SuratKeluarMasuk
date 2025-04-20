<?php
// filepath: c:\xampp\htdocs\Surat\routes\web.php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\PenandatanganDashboardController;
use App\Http\Controllers\ReviewerDashboardController;
use App\Http\Controllers\UserController; // Pastikan UserController diimpor

// Route untuk menampilkan halaman login
Route::get('/', function () {
    return view('login'); // Pastikan file login.blade.php ada di resources/views
})->name('login');

// Route untuk memproses login
Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate');

// Route untuk logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Route untuk admin dashboard
Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

// Route untuk penandatangan dashboard
Route::get('/penandatangan/dashboard', [PenandatanganDashboardController::class, 'index'])->name('penandatangan.dashboard');

// Route untuk reviewer dashboard
Route::get('/reviewer/dashboard', [ReviewerDashboardController::class, 'index'])->name('reviewer.dashboard');

Route::get('/admin/jabatan', [AdminDashboardController::class, 'indexJabatan'])->name('admin.jabatan');

Route::post('/admin/jabatan/store', [AdminDashboardController::class, 'storeJabatan'])->name('admin.jabatan.store');

Route::get('/admin/pegawai', [AdminDashboardController::class, 'indexPegawai'])->name('admin.pegawai');

Route::post('/admin/pegawai/{id}/toggle-status', [AdminDashboardController::class, 'toggleStatus'])->name('admin.pegawai.toggleStatus');

Route::post('/admin/pegawai/store', [AdminDashboardController::class, 'storePegawai'])->name('admin.pegawai.store');

Route::get('/admin/goljabatan', function () {
    return view('Admin.goljabatan');
})->name('admin.goljabatan');

// Route untuk mengedit akun
Route::get('/akun/{name}/edit', [UserController::class, 'edit'])->name('akun.edit'); // Route untuk halaman edit akun
Route::put('/akun/{name}', [UserController::class, 'update'])->name('akun.update'); // Route untuk menyimpan perubahan akun

// Route untuk menghapus akun pengguna
Route::delete('/akun/{id}', [UserController::class, 'destroy'])->name('akun.destroy');