<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompanyProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FasilitasController;
use App\Http\Controllers\JenisWisataController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\PaketWisataController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\PengaturanController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/signin', [AuthController::class, 'index'])->name('login');
Route::post('/signin', [AuthController::class, 'login'])->name('signin');
Route::post('/registrasi', [AuthController::class, 'registrasi'])->name('registrasi');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/', [CompanyProfileController::class, 'index'])->name('home');

Route::middleware(['role:admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/user', [UserController::class, 'index'])->name('user');
    Route::post('/user', [UserController::class, 'store'])->name('user.store');
    Route::put('/user/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');

    Route::get('/pengaturan', [PengaturanController::class, 'index'])->name('pengaturan.index');
    Route::put('/pengaturan/{id}', [PengaturanController::class, 'update'])->name('pengaturan.update');
    Route::post('/slider', [PengaturanController::class, 'storeSlider'])->name('slider.store');
    Route::put('/slider/{id}', [PengaturanController::class, 'updateSlider'])->name('slider.update');

    Route::get('/paket-wisata', [PaketWisataController::class, 'index'])->name('paketwisata.index');
    Route::get('/paket-wisata/create', [PaketWisataController::class, 'create'])->name('paketwisata.create');
    Route::post('/paket-wisata/store', [PaketWisataController::class, 'store'])->name('paketwisata.store');
    Route::put('/paket-wisata/{id}', [PaketWisataController::class, 'update'])->name('paketwisata.update');
    Route::delete('/paket-wisata/{id}', [PaketWisataController::class, 'destroy'])->name('paketwisata.destroy');
    Route::get('/paket-wisata/{id}', [PaketWisataController::class, 'edit'])->name('paketwisata.edit');
    Route::get('/paket-wisata/{id}/show', [PaketWisataController::class, 'show'])->name('paketwisata.show');
    
    Route::get('/jenis-wisata', [JenisWisataController::class, 'index'])->name('jeniswisata.index');
    Route::post('/jenis-wisata', [JenisWisataController::class, 'store'])->name('jeniswisata.store');
    Route::put('/jenis-wisata/{id}', [JenisWisataController::class, 'update'])->name('jeniswisata.update');
    Route::delete('/jenis-wisata/{id}', [JenisWisataController::class, 'destroy'])->name('jeniswisata.destroy');

    Route::get('/fasilitas', [FasilitasController::class, 'index'])->name('fasilitas.index');
    Route::post('/fasilitas', [FasilitasController::class, 'store'])->name('fasilitas.store');
    Route::put('/fasilitas/{id}', [FasilitasController::class, 'update'])->name('fasilitas.update');
    Route::delete('/fasilitas/{id}', [FasilitasController::class, 'destroy'])->name('fasilitas.destroy');

    Route::get('/layanan', [LayananController::class, 'index'])->name('layanan.index');
    Route::post('/layanan', [LayananController::class, 'store'])->name('layanan.store');
    Route::put('/layanan/{id}', [LayananController::class, 'update'])->name('layanan.update');
    Route::delete('/layanan/{id}', [LayananController::class, 'destroy'])->name('layanan.destroy');

    Route::get('/pemesanan', [PemesananController::class, 'index'])->name('pemesanan.index');
    Route::post('/pemesanan', [PemesananController::class, 'store'])->name('pemesanan.store');
    Route::get('/pemesanan/create', [PemesananController::class, 'create'])->name('pemesanan.create');
    Route::put('/pemesanan/{id}', [PemesananController::class, 'update'])->name('pemesanan.update');
    Route::delete('/pemesanan/{id}', [PemesananController::class, 'destroy'])->name('pemesanan.destroy');
});