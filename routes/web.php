<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('index');
});

require __DIR__.'/auth.php';

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');
