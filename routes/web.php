<?php

use App\Livewire\Pages\Akun;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Livewire\Pages\Anggota;
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

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('simpanan', Simpanan::class)->name('simpanan')->middleware(['permission:simpanan.read|simpanan.write']);
    Route::get('simpanan/add', SimpananAdd::class)->name('simpanan.add')->middleware(['permission:simpanan.write']);
});



Route::prefix('administrasi')->group(function () {
    Route::get('users', Users::class)->name('administrasi.users');
})->middleware(['auth', 'verified']);

Route::prefix('master')->group(function () {
    Route::get('akun', Akun::class)->name('master.akun');
})->middleware(['auth', 'verified']);

Route::get('/image/{filename}', function ($filename) {
    $path = Storage::disk('private')->path("images/anggota/{$filename}");

    if (!file_exists($path)) {
        abort(404, 'File not found');
    }

    return response()->file($path);
})->middleware(['auth', 'verified']);

require __DIR__ . '/auth.php';
