<?php

use App\Http\Controllers\KlaimBarangController;
use App\Livewire\KlaimBarangComponent;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// routes/web.php

Route::get('klaimBarang',  [KlaimBarangController::class, 'klaimBarang'])->name('klaimBarang');
Route::get('statusProses',  [KlaimBarangController::class, 'statusProses'])->name('statusProses');


Route::get('/klaim-barang/{id}', [KlaimBarangController::class, 'klaimBarang'])->name('klaim-barang');
Route::post('/simpan-jawaban-konfirmasi', [KlaimBarangController::class, 'simpanJawabanKonfirmasi'])->name('simpan-jawaban-konfirmasi');
