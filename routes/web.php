<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StoreController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

    Route::get('/category/all', [CategoryController::class, 'all'])->name('categories.all');
    Route::post('/category/add', [CategoryController::class, 'add'])->name('categories.add');
    Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::post('/category/update/{id}', [CategoryController::class, 'update'])->name('categories.update');
    Route::get('/category/delete/{id}', [CategoryController::class, 'delete'])->name('categories.delete');
    Route::get('/category/restore/{id}', [CategoryController::class, 'restore']);
    Route::get('/category/remove/{id}', [CategoryController::class, 'remove']);

    Route::get('/store/all', [StoreController::class, 'all'])->name('stores.all');
    Route::post('/store/add', [StoreController::class, 'add'])->name('stores.add');
    Route::get('/store/edit/{id}', [StoreController::class, 'edit'])->name('stores.edit');
    Route::post('/store/update/{id}', [StoreController::class, 'update']);
    Route::get('/store/delete/{id}', [StoreController::class, 'delete']);
    Route::get('/store/restore/{id}', [StoreController::class, 'restore']);
    Route::get('/store/remove/{id}', [StoreController::class, 'remove']);

    Route::get('/locations/all', [LocationController::class, 'all'])->name('locations.all');
    Route::post('/locations/add', [LocationController::class, 'add'])->name('locations.add');
    Route::get('/locations/edit/{id}', [LocationController::class, 'edit'])->name('locations.edit');
    Route::post('/locations/update/{id}', [LocationController::class, 'update']);
    Route::get('/locations/delete/{id}', [LocationController::class, 'delete']);
    Route::get('/locations/restore/{id}', [LocationController::class, 'restore']);
    Route::get('/locations/remove/{id}', [LocationController::class, 'remove']);
});

require __DIR__ . '/auth.php';
