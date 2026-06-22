<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\OfficeController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::get('/clear-cache-all', function() {
    Artisan::call('cache:clear');
    Artisan::call('route:cache');
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('config:cache');
    dd("Cache Clear All");
});


Route::get('/', [HomeController::class, 'index']);


    Route::get('/office', [OfficeController::class, 'index'])->name('offices.index');
    Route::get('/office/list', [OfficeController::class, 'get_office_index'])->name('offices.list');
    Route::post('/office/store', [OfficeController::class, 'store']);
    Route::post('/office/validate/{action}', [OfficeController::class, 'validate']);
    Route::get('/office/edit/{office}', [OfficeController::class, 'edit']);
    Route::put('/office/edit/{office}', [OfficeController::class, 'update']);
    Route::get('/office/delete/{office}',[OfficeController::class, 'delete']);
