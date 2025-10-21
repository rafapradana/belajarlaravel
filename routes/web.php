<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\adminController;
use App\Http\Controllers\siswaController;
use App\Http\Controllers\kontenController;
use App\Http\Controllers\kbmController;

Route::get('/', [kontenController::class, 'landing'])->name('landing');
Route::get('/detil/{id}', [kontenController::class, 'detil'])->name('detil');
Route::get('/login', [adminController::class, 'formLogin'])->name('login');
Route::post('/login', [adminController::class, 'prosesLogin'])->name('login.post');
Route::get('/register', [adminController::class, 'formRegister'])->name('register');
Route::post('/register', [adminController::class, 'prosesRegister'])->name('register.post');

// Routes yang membutuhkan autentikasi
Route::middleware(['ceklogin'])->group(function () {

    Route::get('/home', [siswaController::class, 'home'])->name('home');
    
    // Ajax routes untuk data siswa
    Route::get('/siswa/data', [siswaController::class, 'getData'])->name('siswa.data');
    Route::get('/siswa/search', [siswaController::class, 'search'])->name('siswa.search');
    
    // Routes khusus admin - membutuhkan role admin
    Route::middleware(['cekadmin'])->group(function () {
        Route::get('/siswa/create', [siswaController::class, 'create'])->name('siswa.create');
        Route::post('/siswa/store', [siswaController::class, 'store'])->name('siswa.store');
        Route::get('/siswa/{id}/edit', [siswaController::class, 'edit'])->name('siswa.edit');
        Route::post('/siswa/{id}/update', [siswaController::class, 'update'])->name('siswa.update');
        Route::get('/siswa/{id}/delete', [siswaController::class, 'destroy'])->name('siswa.delete');
        
        // Routes KBM khusus admin
        Route::get('/kbm/create', [kbmController::class, 'create'])->name('kbm.create');
        Route::post('/kbm', [kbmController::class, 'store'])->name('kbm.store');
        Route::get('/kbm/{id}/edit', [kbmController::class, 'edit'])->name('kbm.edit');
        Route::put('/kbm/{id}', [kbmController::class, 'update'])->name('kbm.update');
        Route::delete('/kbm/{id}', [kbmController::class, 'destroy'])->name('kbm.destroy');
    });

    // Routes KBM yang bisa diakses semua role yang login
    Route::get('/kbm', [kbmController::class, 'index'])->name('kbm.index');

    Route::get('/logout', [adminController::class, 'logout'])->name('logout');
});


