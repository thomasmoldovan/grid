<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\StoreController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Mail\Mailer;
use Illuminate\Contracts\Mail\Mailable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

    Route::get('/category/all', [CategoryController::class, 'all'])->name('categories.all');
    Route::post('/category/add', [CategoryController::class, 'add'])->name('categories.add');
    Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::post('/category/update/{id}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/category/delete/{id}', [CategoryController::class, 'delete'])->name('categories.delete');
    Route::get('/category/restore/{id}', [CategoryController::class, 'restore']);
    Route::get('/category/remove/{id}', [CategoryController::class, 'remove']);

    Route::get('/store/all', [StoreController::class, 'all'])->name('stores.all');
    Route::post('/store/add', [StoreController::class, 'add'])->name('stores.add');
    Route::get('/store/edit/{id}', [StoreController::class, 'edit'])->name('stores.edit');
    Route::post('/store/update/{id}', [StoreController::class, 'update'])->name('stores.update');
    Route::delete('/store/delete/{id}', [StoreController::class, 'delete'])->name('stores.delete');
    Route::get('/store/restore/{id}', [StoreController::class, 'restore']);
    Route::get('/store/remove/{id}', [StoreController::class, 'remove']);

    Route::get('/locations/all', [LocationController::class, 'all'])->name('locations.all');
    Route::post('/locations/add', [LocationController::class, 'add'])->name('locations.add');
    Route::get('/locations/edit/{id}', [LocationController::class, 'edit'])->name('locations.edit');
    Route::post('/locations/update/{id}', [LocationController::class, 'update']);
    Route::delete('/locations/delete/{id}', [LocationController::class, 'delete'])->name('locations.delete');
    Route::get('/locations/restore/{id}', [LocationController::class, 'restore']);
    Route::get('/locations/remove/{id}', [LocationController::class, 'remove']);

    Route::get('/product/all', [ProductController::class, 'all'])->name('products.all');
    Route::get('/product/create', [ProductController::class, 'create'])->name('create_product');
    Route::post('/product/add', [ProductController::class, 'add'])->name('add_product');
    Route::get('/product/edit/{id}', [ProductController::class, 'edit']);
    Route::post('/product/update/{id}', [ProductController::class, 'update']);
    Route::get('/product/delete/{id}', [ProductController::class, 'delete']);
    Route::get('/product/view/{id}', [ProductController::class, 'view']);
    Route::post('/getProductStoreLocation', [ProductController::class, 'getProductStoreLocation']);
    Route::post('/setProductDefaultImage', [ProductController::class, 'setProductDefaultImage']);
});

Route::get('/browse/{category}/{subcategory?}', [HomeController::class, 'browseCategory'])->name('category.browse');

// Mail
Route::get('send-mail', function () {   
    $details = [
        'title' => 'Mail from ItSolutionStuff.com',
        'body' => 'This is for testing email using smtp',
        'qrcode' => base64_encode('Thomas')
    ];
   
    Mail::to('thomashimself@gmail.com')->send(new Mailer($details));   
    dd("Email is Sent.");
});

// QR Code
Route::get('/qrcode', function () {
  
    QrCode::size(500)
        ->format('png')
        ->generate('ItSolutionStuff.com', public_path('images/qrcode.png'));
    
  return view('qrcode');
    
});

require __DIR__ . '/auth.php';
