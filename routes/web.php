<?php

use App\Models\SesiAbsensi; // 1. Pastikan model ini di-import di paling atas
use Illuminate\Support\Facades\Route;

// Sesuaikan dengan URL route Anda (di sini tertulis /home)
Route::get('/home', function () {
    
    // 2. Ambil data dari database tabel sesi_absensis
    $sesiAbsen = SesiAbsensi::all(); 
    
    // 3. Kirim variabelnya ke dalam view menggunakan compact()
    return view('sesi_absen', compact('sesiAbsen'));
    
})->name('sesi_absen');