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

Route::get('counter', Counter::class);

require __DIR__.'/auth.php';
