<?php

use App\Http\Controllers\RequestController;
use Illuminate\Support\Facades\Route;

Route::prefix('/request')->group(function(){
    Route::get('', [RequestController::class, 'index'])->name('request.index');
    Route::post('/add', [RequestController::class, 'add'])->name('request.add');
    Route::get('/get-all', [RequestController::class, 'get_all'])->name('request.get_all');
    Route::get('/get/{id}', [RequestController::class, 'get'])->name('request.get');
});