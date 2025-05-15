<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\PaypalController;
use App\Http\Controllers\ProductModelController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';

Route::get('/', function () {
    return new App\Http\Resources\LoginResource(Auth::user());
});

Route::prefix('cart')->group(function () {
    Route::get('/', [CartController::class, 'show']);
    Route::post('/product/{id}', [CartController::class, 'storeProduct']);
    Route::delete('/lines', [CartController::class, 'destroyCartLines']);

    Route::post('/coupon/{code}', [CartController::class, 'storeCoupon']);
    Route::delete('/coupon', [CartController::class, 'destroyCoupon']);
});

Route::post('/checkout', [CheckoutController::class, 'store']);

Route::prefix('user')->middleware('auth')->group(function () {
    Route::put('/', [UserController::class, 'update']);
    Route::delete('/', [UserController::class, 'destroy']);

    Route::get('/favorites', [UserController::class, 'indexFavorites']);
    Route::post('/favorite/{productId}', [UserController::class, 'storeFavorite']);
    Route::delete('/favorite/{productId}', [UserController::class, 'destroyFavorite']);

    Route::get('/orders', [UserController::class, 'indexOrders']);
    Route::get('/comments', [UserController::class, 'indexComments']);
});

Route::post('/newsletter', [NewsletterController::class, 'store']);
Route::delete('/newsletter', [NewsletterController::class, 'destroy'])->middleware('auth');
Route::get('/newsletter/{token}', [NewsletterController::class, 'destroyByToken']);

Route::get('/category/{id}', [CategoryController::class, 'show']);
Route::post('/category/byUrl', [CategoryController::class, 'showByUrl']);

Route::prefix('product')->group(function () {
    Route::get('/', [ProductModelController::class, 'index']);
    Route::get('/news', [ProductModelController::class, 'index'])->defaults('filterNews', true);

    Route::get('/{id}', [ProductModelController::class, 'show']);
    Route::post('/byUrl', [ProductModelController::class, 'showByUrl']);

    Route::get('/{id}/comments', [ProductModelController::class, 'indexComment']);
    Route::post('/{id}/comment', [ProductModelController::class, 'storeComment'])->middleware('auth');
});

Route::get('/menu', [MenuController::class, 'index']);
Route::get('/menu/{id}', [MenuController::class, 'show']);

Route::get('/search', [SearchController::class, 'search'])->name('search');

Route::get('/payment/{ammount?}', [PaypalController::class, 'payment'])->name('paypal.payment');
Route::get('/return', [PaypalController::class, 'return'])->name('paypal.return');
Route::get('/cancel', [PaypalController::class, 'cancel'])->name('paypal.cancel');

Route::prefix('test')->group(function () {
    Route::get('/deleteUser', [TestController::class, 'deleteUser']);
    Route::get('/changeStatus/{status}', [TestController::class, 'changeStatus']);
    Route::get('/cache', [TestController::class, 'cache']);
    Route::get('/changeModel/{action}', [TestController::class, 'changeModel']);
    Route::get('/email/orderCreated', [TestController::class, 'testEmail'])->defaults('action', 'orderCreated');
    Route::get('/email/orderSended', [TestController::class, 'testEmail'])->defaults('action', 'orderSended');
    Route::get('/email/unsubscribedUser', [TestController::class, 'testEmail'])->defaults('action', 'unsubscribedUser');
});
