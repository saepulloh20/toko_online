<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\isAdmin;
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

Auth::routes(['verify' => true]);

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/categories', [App\Http\Controllers\CategoryController::class, 'index'])->name('categories');
Route::get('/categories/{id}', [App\Http\Controllers\CategoryController::class, 'detail'])->name('categories-detail');
Route::get('/detail/{id}', [App\Http\Controllers\DetailController::class, 'index'])->name('detail');
Route::post('/detail/{id}', [App\Http\Controllers\DetailController::class, 'add'])->name('detail-add');

Route::get('/success', [App\Http\Controllers\CartController::class, 'success'])->name('success');


Route::POST('/checkout/callback', [App\Http\Controllers\CheckoutController::class, 'callback'])->name('midtrans-callback');

Route::get('/register/success', [App\Http\Controllers\Auth\RegisterController::class, 'success'])->name('register-success');




Route::group(['middleware' => ['auth']], function () {
    Route::get('/cart', [App\Http\Controllers\CartController::class, 'index'])->name('cart');
    Route::delete('/cart/{id}', [App\Http\Controllers\CartController::class, 'delete'])->name('cart-delete');

    Route::POST('/checkout', [App\Http\Controllers\CheckoutController::class, 'process'])->name('checkout');

    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');


    Route::get('/dashboard/products', [App\Http\Controllers\DashboardProductController::class, 'index'])->name('dashboard/products');
    Route::get('/dashboard/products/create', [App\Http\Controllers\DashboardProductController::class, 'create'])->name('dashboard/products-create');
    Route::post('/dashboard/products', [App\Http\Controllers\DashboardProductController::class, 'store'])->name('dashboard-products-store');
    Route::get('/dashboard/products/{id}', [App\Http\Controllers\DashboardProductController::class, 'details'])->name('dashboard/products-details');
    Route::post('/dashboard/products/{id}', [App\Http\Controllers\DashboardProductController::class, 'update'])->name('dashboard/products-update');

    Route::post('/dashboard/products/gallery/upload', [App\Http\Controllers\DashboardProductController::class, 'uploadGallery'])->name('dashboard/products-gallery-upload');
    Route::get('/dashboard/products/gallery/delete/{id}', [App\Http\Controllers\DashboardProductController::class, 'deleteGallery'])->name('dashboard/products-gallery-delete');



    Route::get('/dashboard/transactions', [App\Http\Controllers\DashboardTransactionsController::class, 'index'])->name('dashboard/transactions');
    Route::get('/dashboard/transactions/{id}', [App\Http\Controllers\DashboardTransactionsController::class, 'details'])->name('dashboard-transactions-details');
    Route::post('/dashboard/transactions/{id}', [App\Http\Controllers\DashboardTransactionsController::class, 'update'])->name('dashboard/transactions-update');

    Route::get('/dashboard/setting', [App\Http\Controllers\DashboardSettingController::class, 'store'])->name('dashboard-settings-store');
    Route::get('/dashboard/account', [App\Http\Controllers\DashboardSettingController::class, 'account'])->name('dashboard-settings-account');
    Route::post('/dashboard/account/{redirect}', [App\Http\Controllers\DashboardSettingController::class, 'update'])->name('dashboard-settings-redirect');
});



Route::prefix('admin')
    ->namespace('')
    ->middleware(['auth', 'admin'])
    ->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin-dashboard');
        Route::resource('category', App\Http\Controllers\Admin\CategoryController::class);
        Route::resource('user', App\Http\Controllers\Admin\UserController::class);
        Route::resource('product-gallery', App\Http\Controllers\Admin\ProductGalleryController::class);
        Route::get('/product/transaction-detail/{id}', [App\Http\Controllers\Admin\TransactionController::class, 'details'])->name('dashboard/products-details-admin');


        Route::get('products', [App\Http\Controllers\Admin\DashboardProductController::class, 'index'])->name('admin-products');
        Route::get('products/create', [App\Http\Controllers\Admin\DashboardProductController::class, 'create'])->name('admin-products/create');
        Route::post('products/store', [App\Http\Controllers\Admin\DashboardProductController::class, 'store'])->name('admin-products/store');
        Route::get('/products/{id}', [App\Http\Controllers\Admin\DashboardProductController::class, 'details'])->name('admin/products-details');
        Route::post('/products/{id}', [App\Http\Controllers\Admin\DashboardProductController::class, 'update'])->name('admin/products-update');
        Route::post('/products/delete/{id}', [App\Http\Controllers\Admin\DashboardProductController::class, 'destroy'])->name('admin/products-destroy');

        Route::get('validation', [App\Http\Controllers\Admin\DashboardValidationController::class, 'index'])->name('admin-validation');

        Route::get('size', [App\Http\Controllers\Admin\DashboardSizeController::class, 'index'])->name('admin-size');
        Route::get('size/create', [App\Http\Controllers\Admin\DashboardSizeController::class, 'create'])->name('admin-size/create');
        Route::post('size/store', [App\Http\Controllers\Admin\DashboardSizeController::class, 'store'])->name('admin-size/store');

        Route::get('stock', [App\Http\Controllers\Admin\DashboardStockController::class, 'index'])->name('admin-stock');
        Route::get('stock/create', [App\Http\Controllers\Admin\DashboardStockController::class, 'create'])->name('admin-stock/create');
        Route::post('stock/store', [App\Http\Controllers\Admin\DashboardStockController::class, 'store'])->name('admin-stock/store');

        Route::post('product/upload', [App\Http\Controllers\Admin\DashboardProductController::class, 'uploadGallery'])->name('products-gallery-upload');
        Route::get('product/delete/{id}', [App\Http\Controllers\Admin\DashboardProductController::class, 'deleteGallery'])->name('products-gallery-delete');

        Route::get('/transactions', [App\Http\Controllers\Admin\TransactionController::class, 'index'])->name('transactions');
        Route::get('/transactions/{id}', [App\Http\Controllers\Admin\TransactionController::class, 'details'])->name('transactions-details');
        Route::post('/transactions/{id}', [App\Http\Controllers\Admin\TransactionController::class, 'update'])->name('transactions-update');
    });


Auth::routes();
