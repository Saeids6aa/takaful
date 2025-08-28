<?php

use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['prefix' => 'dashboard'], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    //categories Routes:
    Route::group(['prefix' => 'categories'], function () {
        Route::get('/', action: [CategoriesController::class, 'index'])->name('categories.index');
        Route::post('/AjaxDT', [CategoriesController::class, 'AjaxDT']);
        Route::get('/create', [CategoriesController::class, 'create'])->name('categories.create');
        Route::post('/store', [CategoriesController::class, 'store'])->name('categories.store');
        Route::get('/delete/{id}', [CategoriesController::class, 'delete'])->name('categories.delete');
        
    });
});
