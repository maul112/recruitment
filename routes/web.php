<?php

use Illuminate\Support\Facades\Route;
// auth
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
// admin
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Pelamar\DashboardController as PelamarDashboard;
use App\Http\Controllers\Admin\LowonganController;
use App\Http\Controllers\Admin\PelamarsController;
use App\Http\Controllers\Admin\LamaranController;
use App\Http\Controllers\Admin\PsikotesController;
use App\Http\Controllers\Admin\WawancaraController;
use App\Http\Controllers\Admin\KontrakController;
use App\Http\Controllers\Pelamar\ProfilController;
use App\Http\Controllers\Pelamar\LowonganController as PelamarLowongan;
use App\Http\Controllers\Pelamar\PsikotesPelamarController;

// pelamar


/* ============ LANDING PAGE ============ */
Route::get('/', function () {
    return view('home');
});

/* ============ REKRUTMEN PAGE ============ */
Route::get('/rekrutmen', function () {
    return view('rekrutmen');
});

/* ============ AUTH ============ */
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/register', [RegisterController::class, 'index']);
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

/* ============ ADMIN ============ */
Route::get('/admin/dashboard', [AdminDashboard::class, 'index']);
Route::get('/admin/lowongan', [LowonganController::class, 'index']);
Route::get('/admin/lowongan/create', [LowonganController::class, 'create']);
Route::post('/admin/lowongan/store', [LowonganController::class, 'store']);
Route::get('/admin/lowongan/edit/{id}', [LowonganController::class, 'edit']);
Route::post('/admin/lowongan/update/{id}', [LowonganController::class, 'update']);
Route::post('/admin/lowongan/delete/{id}', [LowonganController::class, 'destroy']);
Route::get('/admin/pelamar', [PelamarsController::class, 'index'])->name('admin.pelamar.index');
Route::get('/admin/pelamar/{id}', [PelamarsController::class, 'show'])->name("admin.pelamar.show");
Route::post('/admin/pelamar/{id}/status', [PelamarsController::class, 'updateStatus']);
Route::delete('/admin/pelamar/{id}', [PelamarsController::class, 'destroy']);
Route::get('/admin/lamaran', [LamaranController::class, 'index'])->name('admin.lamaran.index');
Route::get('/admin/lamaran/edit/{id}', [LamaranController::class, 'edit'])->name('admin.lamaran.edit');
Route::post('/admin/lamaran/update/{id}', [LamaranController::class, 'update'])->name('admin.lamaran.update');
Route::get('/admin/psikotes', [PsikotesController::class,'index'])->name('admin.psikotes.index');
Route::get('/admin/psikotes/create', [PsikotesController::class,'create'])->name('admin.psikotes.create');
Route::post('/admin/psikotes/store', [PsikotesController::class,'store'])->name('admin.psikotes.store');
Route::get('/admin/psikotes/{id}', [PsikotesController::class,'show'])->name('admin.psikotes.show');
Route::post('/admin/psikotes/{psikotes}/nilai', [PsikotesController::class,'nilai'])->name('admin.psikotes.nilai');
Route::get('/admin/wawancara', [WawancaraController::class,'index'])->name('admin.wawancara.index');
Route::get('/admin/wawancara/create', [WawancaraController::class,'create'])->name('admin.wawancara.create');
Route::post('/admin/wawancara/store', [WawancaraController::class,'store'])->name('admin.wawancara.store');
Route::get('/admin/wawancara/{id}', [WawancaraController::class,'show'])->name('admin.wawancara.show');
Route::post('/admin/wawancara/{id}/update', [WawancaraController::class,'update'])->name('admin.wawancara.update');
Route::get('/admin/kontrak', [KontrakController::class,'index'])->name('admin.kontrak.index');
Route::get('/admin/kontrak/create', [KontrakController::class,'create'])->name('admin.kontrak.create');
Route::post('/admin/kontrak/store', [KontrakController::class,'store'])->name('admin.kontrak.store');
Route::get('/admin/kontrak/{id}', [KontrakController::class,'show'])->name('admin.kontrak.show');
Route::post('/admin/kontrak/{id}/update', [KontrakController::class,'update'])->name('admin.kontrak.update');
Route::post('/admin/soal-psikotes/store', [PsikotesController::class, 'store'])
     ->name('admin.soal_psikotes.store');
// EDIT SOAL
Route::get('/psikotes/soal/{id}/edit', [PsikotesController::class, 'editSoal'])
    ->name('admin.psikotes.edit');

// UPDATE SOAL
Route::put('/psikotes/soal/{id}/update', [PsikotesController::class, 'updateSoal'])
    ->name('admin.psikotes.update');

// DELETE SOAL
Route::delete('/psikotes/soal/{id}/delete', [PsikotesController::class, 'deleteSoal'])
    ->name('admin.psikotes.destroy');

/* ============ PELAMAR ============ */
Route::get('/pelamar/dashboard', [PelamarDashboard::class, 'index'])->name('pelamar.dashboard');
Route::get('/pelamar/psikotes', [PsikotesPelamarController::class, 'index'])->name('pelamar.psikotes');
Route::get('/pelamar/psikotes/kerjakan/{tipe}', [PsikotesPelamarController::class, 'kerjakan'])->name('pelamar.psikotes.kerjakan');
Route::post('/pelamar/psikotes/submit/{psikotes}', [PsikotesPelamarController::class, 'submit'])->name('pelamar.psikotes.submit');
Route::get('/pelamar/psikotes-selesai/{id}', [PsikotesPelamarController::class, 'selesai'])->name('pelamar.psikotes.selesai');
Route::get('/pelamar/profile', [ProfilController::class, 'index'])->name('pelamar.profile');
Route::post('/pelamar/profile', [ProfilController::class, 'update'])->name('pelamar.profile.update');
Route::get('/pelamar/lowongan', [PelamarLowongan::class, 'index']);
Route::get('/pelamar/lowongan/{id}', [PelamarLowongan::class, 'show'])->name('pelamar.lowongan.show');
Route::post('/pelamar/lowongan/{id}/apply', [PelamarLowongan::class, 'apply'])->name('pelamar.lowongan.apply');
Route::get('/pelamar/riwayat', [PelamarLowongan::class, 'riwayat'])->name('pelamar.riwayat');
Route::get('/pelamar/lamaran/{id}', [PelamarLowongan::class, 'detail'])->name('pelamar.lamaran.detail');
Route::get('pelamar/pengumuman', [PelamarLowongan::class, 'pengumuman'])->name('pelamar.pengumuman');