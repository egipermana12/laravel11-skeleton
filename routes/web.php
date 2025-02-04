<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Counter;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::group(['middleware' => ['role:admin']], function () {
    Route::get('anggota', Counter::class);
});

require __DIR__.'/auth.php';
