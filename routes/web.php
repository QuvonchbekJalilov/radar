<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\API\PaymentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserAddressController;
use App\Http\Controllers\UserController;
use App\Models\Category;
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

Route::get('/', function () {
    return view('welcome');
})->name('index');


Route::get('/admin', [AuthController::class, 'login'])->name('login');
Route::post('/authenticate', [AuthController::class, 'authenticate'])->name('authenticate');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/change/password', [AuthController::class, 'changePassword']);
Route::post('/change/password', [AuthController::class, 'changePasswordCheck']);
Route::get('/admin/category/search', [CategoryController::class, 'search'])->name('category.search');
Route::get('categories/data', [CategoryController::class, 'getData'])->name('categories.data');
Route::get('products/data', [ProductController::class, 'getData'])->name('products.data');
Route::get('users/data', [UserController::class, 'getData'])->name('users.data');
Route::get('orders/data', [OrderController::class, 'data'])->name('orders.data');
Route::get('users/{user}/edit-address', [UserController::class, 'editAddress'])->name('user.edit-address');
Route::post('users/{user}/update-address', [UserController::class, 'updateAddress'])->name('user.update-address');
Route::get('orders/data', [OrderController::class, 'data'])->name('orders.data');
Route::post('/order/update-payment-status', [OrderController::class, 'updatePaymentStatus'])->name('order.updatePaymentStatus');
Route::post('/order/update-shipping-status', [OrderController::class, 'updateShippingStatus'])->name('order.updateShippingStatus');


Route::middleware(['checkAdmin:admin', 'auth'])->group(function () {
    Route::group(['prefix' => 'admin'], function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
        Route::resource('category', CategoryController::class);
        Route::resource('brands', BrandController::class);
        // routes/web.php
Route::get('/brands/data', [BrandController::class, 'getData'])->name('brands.data');

        Route::resource('product', ProductController::class);
        Route::resource('user', UserController::class);
        Route::resource('order', OrderController::class);

    });
});

Route::get('/fail', [PaymentController::class, 'failure'])->name('payment.return');
Route::get('/{lang}', function ($lang) {
    session(['lang' => $lang]);
    return back();
})->where('lang', 'en|ru|uz');
