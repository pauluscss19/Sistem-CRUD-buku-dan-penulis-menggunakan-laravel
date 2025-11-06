<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\ProyekController;


// Routes untuk Mahasiswa
Route::resource('mahasiswas', MahasiswaController::class);

// Routes untuk Dosen
Route::resource('dosens', DosenController::class);

// Routes untuk Proyek
Route::resource('proyeks', ProyekController::class);