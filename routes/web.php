<?php

use App\Livewire\Order\Index\Page;
use App\Livewire\TodoList;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/store/{store}/orders', Page::class)
    ->can('view', 'store')
    ->name('store.orders');

if ($user = User::first()) {
    auth()->login($user);
}

Route::get('/', TodoList::class);
//Route::get('/optimistic', TodoListOptimistic::class);
