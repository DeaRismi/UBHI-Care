<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HasilKonselingController;
use App\Http\Controllers\JadwalKosongController;
use App\Http\Controllers\PengajuanController;
use Illuminate\Support\Facades\Route;

Route::middleware(['usersession:1,2,3'])->group(function () {
    Route::get('/', [DashboardController::class, 'index']);
});

Route::middleware(['usersession:2,3'])->group(function () {
    Route::get('hasil_konseling', [HasilKonselingController::class, 'index']);
});

Route::middleware(['usersession:1'])->group(function () {
    Route::get('pengajuan', [PengajuanController::class, 'index']);
    Route::post('pengajuan/store', [PengajuanController::class, 'ajukan']);
});

Route::middleware(['usersession:2'])->group(function () {
    Route::get('hasil_konseling', [HasilKonselingController::class, 'index']);
    Route::get('hasil_konseling/gethasil', [HasilKonselingController::class, 'gethasil']);
    Route::post('hasil_konseling/insert', [HasilKonselingController::class, 'inputhasil']);
    Route::get('jadwal_kosong', [JadwalKosongController::class, 'index']);
    Route::post('jadwal_kosong/insert', [JadwalKosongController::class, 'insert']);
    Route::post('riwayat', [HasilKonselingController::class, 'lihatriwayat']);

});



Route::middleware(['usersession:3'])->group(function () {

});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login_auth', [AuthController::class, 'login'])->name('login_auth');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register/store', [AuthController::class, 'register'])->name('register.store');

Route::get('logout', [AuthController::class,'logout']);