<?php

use App\Http\Controllers\Backend\PostController;
use Illuminate\Support\Facades\Route;

Route::prefix('post')->name('post.')->group(function(){
    Route::get('/', [PostController::class, 'index'])->name('all');
    Route::get('/deleted', [PostController::class, 'deletedMessages'])->name('deleted');
    Route::get('/{type}', [PostController::class, 'create'])->name('create');
    Route::post('/store/{type}', [PostController::class, 'store'])->name('store');
    Route::get('/delete/{id}', [PostController::class, 'destroy'])->name('delete');
    Route::get('/restore/{id}', [PostController::class, 'undoDelete'])->name('restore');
});