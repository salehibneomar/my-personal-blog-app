<?php

use App\Http\Controllers\Backend\DashboardController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('index');
});

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
});
