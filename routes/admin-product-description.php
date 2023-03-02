<?php

use App\Http\Controllers\ProductDescriptionController;
use Illuminate\Support\Facades\Route;

Route::prefix('/description')->group(function(){
    Route::any('/edit-dr-description', [ProductDescriptionController::class, 'edit_dr_description'])->name('admin.product.dr_description');

});