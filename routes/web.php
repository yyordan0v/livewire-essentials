<?php

use App\Livewire\Order\Index\Page;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/store/{store}/orders', Page::class)->name('store.orders');
