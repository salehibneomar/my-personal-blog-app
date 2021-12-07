<?php

use App\Http\Controllers\Backend\SettingController;
use Illuminate\Support\Facades\Route;

Route::prefix('setting')->name('setting.')->group(function(){
    Route::get('/', [SettingController::class, 'edit'])
    ->name('edit');
    Route::post('/general', [SettingController::class, 'updateGeneral'])
    ->name('general');
    Route::post('/logo', [SettingController::class, 'updateLogo'])
    ->name('logo');
});