<?php

use App\Http\Controllers\Admin\AdminsController;
use App\Http\Controllers\Admin\campaign_deliveriesController;
use App\Http\Controllers\Admin\campaignsController;
use App\Http\Controllers\Admin\CampsController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\donorsController;
use App\Http\Controllers\Admin\familiesController;
use App\Http\Controllers\Admin\givingsController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Home\complanintsController;
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

Route::get('/', [HomeController::class, 'index'])->name('home');

// Route::get('/complain', [complanintsController::class, 'index'])->name('home.complain');
// Route::post('/complaints/store', [complanintsController::class, 'store'])->name('complaints.store');

// Route::get('/camps',      [HomeController::class, 'camps_name'])->name('camps.list'); 
// Route::post('/dashboard/campaigns/{id}/change-status', [CampaignsController::class, 'changeStatus'])
//     ->name('campaigns.changeStatus');

Route::group(['prefix' => 'dashboard'], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');


    //categories Routes:
    Route::group(['prefix' => 'categories'], function () {
        Route::get('/', action: [CategoriesController::class, 'index'])->name('categories.index');
        Route::post('/AjaxDT', [CategoriesController::class, 'AjaxDT']);
        Route::get('/create', [CategoriesController::class, 'create'])->name('categories.create');
        Route::post('/store', [CategoriesController::class, 'store'])->name('categories.store');
        Route::get('/edit/{id}', [CategoriesController::class, 'edit'])->name('categories.edit');
        Route::post('/update/{id}', [CategoriesController::class, 'update'])->name('categories.update');
        Route::get('/delete/{id}', [CategoriesController::class, 'delete'])->name('categories.delete');
    });

    Route::group(['prefix' => 'admins'], function () {
        Route::get('/', action: [AdminsController::class, 'index'])->name('admins.index');
        Route::post('/AjaxDT', action: [AdminsController::class, 'AjaxDT']);
        Route::get('/create', [AdminsController::class, 'create'])->name('admins.create');
        Route::post('/store', [AdminsController::class, 'store'])->name('admins.store');
        Route::get('/edit/{id}', [AdminsController::class, 'edit'])->name('admins.edit');
        Route::post('/update/{id}', [AdminsController::class, 'update'])->name('admins.update');
        Route::get('/delete/{id}', [AdminsController::class, 'delete'])->name('admins.delete');
    });


    Route::group(['prefix' => 'campaigns'], function () {
        Route::get('/',        [CampaignsController::class, 'index'])->name('campaigns.index');
        Route::post('/AjaxDT',  [CampaignsController::class, 'AjaxDT']);
        Route::get('/create',  [CampaignsController::class, 'create'])->name('campaigns.create');
        Route::post('/store',  [campaignsController::class, 'store'])->name('campaigns.store');
        Route::get('/edit/{id}',   [CampaignsController::class, 'edit'])->name('campaigns.edit');
        Route::post('/update/{id}', [CampaignsController::class, 'update'])->name('campaigns.update');
        Route::get('/delete/{id}', [CampaignsController::class, 'delete'])->name('campaigns.delete');
        Route::get('/category_quantity/{id}', [CampaignsController::class, 'category_quantity'])->name('category_quantity');
    });

    Route::group(['prefix' => 'camps'], function () {
        Route::get('/',        [campsController::class, 'index'])->name('camps.index');
        Route::post('/AjaxDT', action: [campsController::class, 'AjaxDT']);
        Route::get('/create',  [campsController::class, 'create'])->name('camps.create');
        Route::post('/store',  [campsController::class, 'store'])->name('camps.store');
        Route::get('/edit/{id}',   [campsController::class, 'edit'])->name('camps.edit');
        Route::post('/update/{id}', [CampsController::class, 'update'])->name('camps.update');
        Route::get('/delete/{id}', [campsController::class, 'delete'])->name('camps.delete');
    });


    Route::group(['prefix' => 'families'], function () {
        Route::get('/',        [familiesController::class, 'index'])->name('families.index');
        Route::post('/AjaxDT', action: [familiesController::class, 'AjaxDT']);
        Route::get('/create',  [familiesController::class, 'create'])->name('families.create');
        Route::post('/store',  [familiesController::class, 'store'])->name('families.store');
        Route::get('/edit/{id}',   [familiesController::class, 'edit'])->name('families.edit');
        Route::post('/update/{id}', [familiesController::class, 'update'])->name('families.update');
        Route::get('/delete/{id}', [familiesController::class, 'delete'])->name('families.delete');
    });
    Route::group(['prefix' => 'givings'], function () {
        Route::get('/',        [givingsController::class, 'index'])->name('givings.index');
        Route::post('/AjaxDT', action: [givingsController::class, 'AjaxDT']);
        Route::get('/create',  [givingsController::class, 'create'])->name('givings.create');
        Route::post('/store',  [givingsController::class, 'store'])->name('givings.store');
        Route::get('/edit/{id}',   [givingsController::class, 'edit'])->name('givings.edit');
        Route::post('/update/{id}', [givingsController::class, 'update'])->name('givings.update');
        Route::get('/delete/{id}', [givingsController::class, 'delete'])->name('givings.delete');
    });
    Route::group(['prefix' => 'donors'], function () {
        Route::get('/',        [donorsController::class, 'index'])->name('donors.index');
        Route::post('/AjaxDT', action: [donorsController::class, 'AjaxDT']);
        Route::get('/create',  [donorsController::class, 'create'])->name('donors.create');
        Route::post('/store',  [donorsController::class, 'store'])->name('donors.store');
        Route::get('/edit/{id}',   [donorsController::class, 'edit'])->name('donors.edit');
        Route::post('/update/{id}', [donorsController::class, 'update'])->name('donors.update');
        Route::get('/delete/{id}', [donorsController::class, 'delete'])->name('donors.delete');
    });
    Route::group(['prefix' => 'campaign_deliveries'], function () {
        Route::get('/',        [campaign_deliveriesController::class, 'index'])->name('campaign_deliveries.index');
        Route::post('/AjaxDT', action: [campaign_deliveriesController::class, 'AjaxDT']);
        Route::get('/create',  [campaign_deliveriesController::class, 'create'])->name('campaign_deliveries.create');
        Route::post('/store',  [campaign_deliveriesController::class, 'store'])->name('campaign_deliveries.store');
        Route::get('/edit/{id}',   [campaign_deliveriesController::class, 'edit'])->name('campaign_deliveries.edit');
        Route::post('/update/{id}', [campaign_deliveriesController::class, 'update'])->name('campaign_deliveries.update');
        Route::get('/delete/{id}', [campaign_deliveriesController::class, 'delete'])->name('campaign_deliveries.delete');
    });
});
