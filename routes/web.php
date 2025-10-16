<?php

use App\Http\Controllers\BukuController;
use App\Http\Controllers\PenulisController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('buku.index');
});

// Route Resource untuk Buku
Route::resource('buku', BukuController::class);

// Route Resource untuk Penulis
Route::resource('penulis', PenulisController::class);