<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CartController;
use App\Http\Controllers\API\FavoriteController;
use App\Http\Controllers\API\MainController;
use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\API\PaymentController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\UserAddressController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::prefix('users')->group(function () {
        Route::post('/change/password', [UserController::class, 'changePassword']);
        Route::get('/address', [UserController::class, 'getAddress']);
        Route::get('user', [UserController::class, 'index'])->name('api.users.index');
        Route::post('/', [UserController::class, 'store'])->name('api.users.store');
        Route::put('/update', [UserController::class, 'update'])->name('api.users.update');
        Route::delete('{id}', [UserController::class, 'destroy'])->name('api.users.destroy');
        Route::get('{id}/edit-address', [UserController::class, 'editAddress'])->name('api.users.editAddress');
        Route::put('update-address', [UserController::class, 'updateAddress'])->name('api.users.updateAddress');
    });

    Route::apiResources([
        'favourites' => FavoriteController::class,
    ]);
    Route::apiResources([
        'carts' => CartController::class,
    ]);
});


Route::middleware('auth:sanctum')->group(function () {
    Route::post('/orders', [OrderController::class, 'placeOrder']);
    Route::get('/orders/{id}', [OrderController::class, 'getOrder']);
    Route::get('/user/orders', [OrderController::class, 'getUserOrders']);
    Route::post('/orders/{id}/cancel', [OrderController::class, 'cancelOrder']);
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/user/{user}/addresses', [UserAddressController::class, 'getUserAddresses']);
Route::get('/category', [MainController::class, 'category']);
Route::get('/product', [MainController::class, 'product']);
Route::get('/product/{category}', [MainController::class, 'productCategory']);
Route::get('{id}/product', [MainController::class, 'singleProduct']);
Route::get('/brand', [MainController::class, 'brand']);

Route::post('payment/request', [PaymentController::class, 'handleRequest'])->name('payment.request');
Route::post('payment/notify', [PaymentController::class, 'handleNotify'])->name('payment.notify');
