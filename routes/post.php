<?php

use App\Http\Controllers\Backend\PostController;
use Illuminate\Support\Facades\Route;

Route::prefix('post')->name('post.')->group(function(){
    Route::get('/', [PostController::class, 'index'])->name('all');
    Route::get('/create/{type}', [PostController::class, 'create'])->name('create');
});