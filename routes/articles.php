<?php

use App\Http\Controllers\AccessController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\BlogPostController;
use App\Http\Controllers\MethodController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

Route::prefix('/articles')->group(function(){
    Route::any('', [ArticleController::class, 'get'])->name('admin.article');
    Route::any('add',[BlogPostController::class, 'add'])->name('admin.article.add');
});