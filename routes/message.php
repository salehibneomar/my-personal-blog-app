<?php

use App\Http\Controllers\Backend\MessageController;
use Illuminate\Support\Facades\Route;

Route::prefix('message')->name('message.')->group(function(){
    Route::get('/', [MessageController::class, 'index'])->name('all');
    Route::get('/deleted', [MessageController::class, 'deletedMessages'])->name('deleted');
    Route::get('/delete/{id}', [MessageController::class, 'destroy'])->name('delete');
    Route::get('/restore/{id}', [MessageController::class, 'undoDelete'])->name('restore');
    Route::get('/details/{id}', [MessageController::class, 'details'])->name('details');
});