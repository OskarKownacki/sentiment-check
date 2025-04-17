<?php

use App\Livewire\NewsFeed;
use App\Livewire\Navbar;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;

Route::get('/', NewsFeed::class)->name('home');