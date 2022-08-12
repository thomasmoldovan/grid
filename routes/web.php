<?php

use App\Http\Controllers\CategoryController;
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

Route::get('/category/all', [CategoryController::class, 'all'])->name('categories.all');
Route::post('/category/add', [CategoryController::class, 'add'])->name('categories.add');
Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('categories.edit');
Route::post('/category/update/{id}', [CategoryController::class, 'update']);
Route::get('/category/delete/{id}', [CategoryController::class, 'delete']);
Route::get('/category/restore/{id}', [CategoryController::class, 'restore']);
Route::get('/category/remove/{id}', [CategoryController::class, 'remove']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
