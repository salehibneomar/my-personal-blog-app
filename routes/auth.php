<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use Illuminate\Support\Facades\Route;


Route::get('/author', [AuthenticatedSessionController::class, 'create'])
                ->middleware(['guest', 'prevent_back_history'])
                ->name('login');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])
                ->middleware(['guest', 'prevent_back_history'])
                ->name('login.store');

Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
                ->middleware(['guest', 'prevent_back_history'])
                ->name('password.request');

Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
                ->middleware(['guest', 'prevent_back_history'])
                ->name('password.email');

Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
                ->middleware(['guest', 'prevent_back_history'])
                ->name('password.reset');

Route::post('/reset-password', [NewPasswordController::class, 'store'])
                ->middleware(['guest', 'prevent_back_history'])
                ->name('password.update');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
                ->middleware(['auth', 'prevent_back_history'])
                ->name('logout');
