<?php

use App\Livewire\Dashboard;
use App\Livewire\Login;
use App\Livewire\NewsFeed;
use App\Livewire\Register;
use Illuminate\Support\Facades\Route;

Route::get('/', NewsFeed::class)->name('home');
Route::get('/register', Register::class)->name('register');
Route::get('/login', Login::class)->name('login');
Route::get('/dashboard', Dashboard::class)->name('dashboard')->middleware('auth');