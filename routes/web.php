<?php

use App\Livewire\EditProfile;
use App\Livewire\Signup;
use Illuminate\Support\Facades\Route;

Route::get('/profile', EditProfile::class);
Route::get('/signup', Signup::class);
