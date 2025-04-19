<?php

use App\Livewire\NewsFeed;
use App\Livewire\Register;
use Illuminate\Support\Facades\Route;

Route::get('/', NewsFeed::class)->name('home');
Route::get('/register',Register::class)->name('register');
Route::get('/login',[])->name('show.login');