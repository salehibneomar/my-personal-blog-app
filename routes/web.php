<?php

use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\HomeController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact/store', [ContactController::class, 'store'])
     ->name('contact.store');

require __DIR__.'/auth.php';

Route::prefix('/author')
->name('author.')
->middleware(['auth', 'prevent_back_history'])
->group(function()
{
    Route::get('/dashboard', [DashboardController::class, 'index'])
         ->name('dashboard');

    require __DIR__.'/setting.php';
    require __DIR__.'/profile.php';
    require __DIR__.'/message.php';
});
