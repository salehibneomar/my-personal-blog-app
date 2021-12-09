<?php

use App\Http\Controllers\Backend\ProfileController;
use Illuminate\Support\Facades\Route;

Route::prefix('profile')->name('profile.')->group(function(){
    Route::get('/', [ProfileController::class, 'index'])->name('view');
    Route::get('/edit', [ProfileController::class, 'edit'])->name('edit');
    Route::post('/general', [ProfileController::class, 'updateGeneral'])->name('general');
    Route::post('/image', [ProfileController::class, 'updateImage'])->name('image');
    Route::post('/banner', [ProfileController::class, 'updateBanner'])->name('banner');
    Route::post('/password', [ProfileController::class, 'updatePassword'])->name('password');
});