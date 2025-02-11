<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Counter;
use App\Livewire\Pages\Users;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::prefix('master')->group(function () {
    Route::get('anggota', Counter::class)->name('master.anggota');
})->middleware(['auth', 'role:admin', 'verified']);

Route::prefix('administrasi')->group(function () {
    Route::get('users', Users::class)->name('administrasi.users');
})->middleware(['auth', 'verified']);

require __DIR__.'/auth.php';
