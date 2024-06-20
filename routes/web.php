<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MasyarakatController;
use App\Http\Controllers\PenerimaKmsController;
use App\Http\Controllers\PencarianKmsController;


Route::get('/masyarakat', [MasyarakatController::class, 'index'])->name('masyarakat.index');
Route::get('/masyarakat/tambah', [MasyarakatController::class, 'create'])->name('masyarakat.create');
Route::post('/masyarakat/store', [MasyarakatController::class, 'store'])->name('masyarakat.store');
Route::get('/masyarakat/edit/{id}', [MasyarakatController::class, 'edit'])->name('masyarakat.edit');
Route::put('/masyarakat/update/{id}', [MasyarakatController::class, 'update'])->name('masyarakat.update');
Route::delete('/masyarakat/delete/{id}', [MasyarakatController::class, 'delete'])->name('masyarakat.delete');
Route::get('/masyarakat/destroy/{id}', [MasyarakatController::class, 'destroy'])->name('masyarakat.destroy');
Route::get('/masyarakat/show/{id}', [MasyarakatController::class, 'show'])->name('masyarakat.show');
Route::get('/masyarakat/report', [MasyarakatController::class, 'cetak'])->name('masyarakat.report');

// routes/web.php

Route::get('/penerima-kms', [PenerimaKmsController::class, 'index'])->name('penerima-kms.index');
Route::get('/penerima-kms/report', [PenerimaKmsController::class, 'cetak'])->name('penerima_kms.report');


Route::get('/', [PencarianKmsController::class, 'index']);
Route::get('/pencarian-kms', [PencarianKmsController::class, 'index']);


