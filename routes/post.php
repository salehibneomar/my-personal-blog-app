<?php

use App\Http\Controllers\Backend\PostController;
use Illuminate\Support\Facades\Route;

Route::prefix('post')->name('post.')->group(function(){
    Route::get('/', [PostController::class, 'index'])->name('all');
    Route::get('/deleted', [PostController::class, 'deletedMessages'])->name('deleted');
    Route::get('/create/{type}', [PostController::class, 'create'])->name('create');
    Route::post('/store/{type}', [PostController::class, 'store'])->name('store');
    Route::get('/delete/{id}', [PostController::class, 'destroy'])->name('delete');
    Route::get('/restore/{id}', [PostController::class, 'undoDelete'])->name('restore');
    Route::get('/show/{id}', [PostController::class, 'show'])->name('show');
    Route::get('/edit/{id}', [PostController::class, 'edit'])->name('edit');
    Route::post('/update/{type}/{id}', [PostController::class, 'update'])->name('update');
});