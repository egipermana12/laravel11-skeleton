<?php

use App\Livewire\Pages\Akun;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Livewire\Pages\Anggota;
use App\Livewire\Pages\JurnalUmum;
use App\Livewire\Pages\Simpanan;
use App\Livewire\Pages\Simpanan\SimpananAdd;
use App\Livewire\Pages\Users;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('anggota', Anggota::class)->name('anggota')->middleware(['permission:anggota.read|anggota.write']);
});

Route::middleware(['auth', 'verified'])->prefix('transaksianggota')->group(function () {
    Route::prefix('simpanan')->group(function () {
        Route::get('/', Simpanan::class)->name('transaksianggota.simpanan')->middleware(['permission:simpanan.read|simpanan.write']);
        Route::get('add', SimpananAdd::class)->name('transaksianggota.simpanan.add')->middleware(['permission:simpanan.write']);
    });
});

Route::middleware(['auth', 'verified'])->prefix('transaksiakutansi')->group(function () {
    Route::prefix('jurnalumum')->group(function () {
        Route::get('/', JurnalUmum::class)->name('transaksiakutansi.jurnalumum')->middleware(['permission:transaksi.read|transaksi.write']);
        Route::get('/exportPDF', [JurnalUmum::class, 'exportPDF'])->name('jurnalumumPDF')->middleware(['permission:transaksi.read|transaksi.write']);
        Route::get('/exportEXCEL', [JurnalUmum::class, 'exportExcel'])->name('jurnalumumEXCEL')->middleware(['permission:transaksi.read|transaksi.write']);
    });
});

Route::middleware(['auth', 'verified'])->prefix('administrasi')->group(function () {
    Route::get('users', Users::class)->name('administrasi.users');
});

Route::middleware(['auth', 'verified'])->prefix('master')->group(function () {
    Route::get('akun', Akun::class)->name('master.akun');
});

Route::get('/image/{filename}', function ($filename) {
    $path = Storage::disk('private')->path("images/anggota/{$filename}");

    if (!file_exists($path)) {
        abort(404, 'File not found');
    }

    return response()->file($path);
})->middleware(['auth', 'verified']);

require __DIR__ . '/auth.php';
