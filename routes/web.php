<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| USER CONTROLLERS
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\ConfirmPasswordController;

/*
|--------------------------------------------------------------------------
| ADMIN CONTROLLERS
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\SupplierController;

/*
|--------------------------------------------------------------------------
| HOME
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])
    ->name('home');

/*
|--------------------------------------------------------------------------
| CART
|--------------------------------------------------------------------------
*/

Route::prefix('cart')->name('cart.')->group(function () {

    Route::get('/', [CartController::class, 'index'])
        ->name('index');

    Route::post('/add/{id}', [CartController::class, 'add'])
        ->whereNumber('id')
        ->name('add');

    Route::get('/remove/{id}', [CartController::class, 'remove'])
        ->whereNumber('id')
        ->name('remove');

    Route::get('/clear', [CartController::class, 'clear'])
        ->name('clear');
});

/*
|--------------------------------------------------------------------------
| CHECKOUT
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/checkout', [OrderController::class, 'checkout'])
        ->name('checkout.show');

    Route::post('/checkout', [OrderController::class, 'placeOrder'])
        ->name('checkout.place');
});

/*
|--------------------------------------------------------------------------
| USER AUTH
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | LOGIN
    |--------------------------------------------------------------------------
    */

    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.post');

    /*
    |--------------------------------------------------------------------------
    | REGISTER
    |--------------------------------------------------------------------------
    */

    Route::get('/register', [AuthController::class, 'showRegister'])
        ->name('register.show');

    Route::post('/register', [AuthController::class, 'register'])
        ->name('register.post');
});

/*
|--------------------------------------------------------------------------
| USER LOGOUT
|--------------------------------------------------------------------------
*/

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

/*
|--------------------------------------------------------------------------
| CONFIRM PASSWORD
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/password/confirm', [ConfirmPasswordController::class, 'showConfirmForm'])
        ->name('password.confirm');

    Route::post('/password/confirm', [ConfirmPasswordController::class, 'confirm'])
        ->name('password.confirm.post');
});

/*
|--------------------------------------------------------------------------
| USER AREA
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | USER DASHBOARD
    |--------------------------------------------------------------------------
    */

    Route::get('/user/dashboard', [HomeController::class, 'index'])
        ->name('user.dashboard');

    /*
    |--------------------------------------------------------------------------
    | PROFILE
    |--------------------------------------------------------------------------
    */

    Route::get('/profile', [UserController::class, 'profile'])
        ->name('user.profile');

    /*
    |--------------------------------------------------------------------------
    | ORDERS
    |--------------------------------------------------------------------------
    */

    Route::get('/orders', [OrderController::class, 'myOrders'])
        ->name('orders.mine');

    Route::get('/orders/{id}', [OrderController::class, 'showMyOrder'])
        ->whereNumber('id')
        ->name('orders.show');

    /*
    |--------------------------------------------------------------------------
    | PAYMENT
    |--------------------------------------------------------------------------
    */

    Route::get('/payment', [PaymentController::class, 'showForm'])
        ->name('payment.form');

    Route::post('/payment', [PaymentController::class, 'processPayment'])
        ->name('payment.process');

    Route::get('/payment/upload', [PaymentController::class, 'uploadForm'])
        ->name('payment.upload.form');

    Route::post('/payment/upload', [PaymentController::class, 'upload'])
        ->name('payment.upload');
});

/*
|--------------------------------------------------------------------------
| ADMIN AREA
|--------------------------------------------------------------------------
*/

Route::prefix('admin')
    ->name('admin.')
    ->group(function () {

    /*
    |--------------------------------------------------------------------------
    | ADMIN LOGIN
    |--------------------------------------------------------------------------
    */

    Route::get('/login', [AdminAuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AdminAuthController::class, 'login'])
        ->name('login.post');

    /*
    |--------------------------------------------------------------------------
    | ADMIN AUTH
    |--------------------------------------------------------------------------
    */

    Route::middleware('auth:admin')->group(function () {

        /*
        |--------------------------------------------------------------------------
        | ADMIN DASHBOARD
        |--------------------------------------------------------------------------
        */

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        /*
        |--------------------------------------------------------------------------
        | ADMIN LOGOUT
        |--------------------------------------------------------------------------
        */

        Route::post('/logout', [AdminAuthController::class, 'logout'])
            ->name('logout');

        /*
        |--------------------------------------------------------------------------
        | PRODUCTS
        |--------------------------------------------------------------------------
        */

        Route::prefix('products')
            ->name('products.')
            ->group(function () {

            Route::get('/', [AdminController::class, 'products'])
                ->name('index');

            Route::get('/create', [AdminController::class, 'createProduct'])
                ->name('create');

            Route::post('/', [AdminController::class, 'storeProduct'])
                ->name('store');

            Route::get('/{id}/edit', [AdminController::class, 'editProduct'])
                ->whereNumber('id')
                ->name('edit');

            Route::put('/{id}', [AdminController::class, 'updateProduct'])
                ->whereNumber('id')
                ->name('update');

            Route::delete('/{id}', [AdminController::class, 'deleteProduct'])
                ->whereNumber('id')
                ->name('destroy');
        });

        /*
        |--------------------------------------------------------------------------
        | SUPPLIERS
        |--------------------------------------------------------------------------
        */

        Route::prefix('suppliers')
            ->name('suppliers.')
            ->group(function () {

            Route::get('/', [SupplierController::class, 'index'])
                ->name('index');

            Route::get('/create', [SupplierController::class, 'create'])
                ->name('create');

            Route::post('/', [SupplierController::class, 'store'])
                ->name('store');
        });

        /*
        |--------------------------------------------------------------------------
        | ADMIN ORDERS
        |--------------------------------------------------------------------------
        */

        Route::get('/orders', [OrderController::class, 'orders'])
            ->name('orders');

        Route::put('/orders/{order}', [OrderController::class, 'update'])
            ->whereNumber('order')
            ->name('orders.update');

        Route::delete('/orders/{order}', [OrderController::class, 'destroy'])
            ->whereNumber('order')
            ->name('orders.destroy');

        /*
        |--------------------------------------------------------------------------
        | REPORTS
        |--------------------------------------------------------------------------
        */

        Route::prefix('reports')
            ->name('reports.')
            ->group(function () {

            Route::get('/sales', [ReportController::class, 'sales'])
                ->name('sales.index');

            Route::get('/sales/export/csv', [ReportController::class, 'exportCsv'])
                ->name('sales.export.csv');

            Route::get('/sales/export/pdf', [ReportController::class, 'exportPdf'])
                ->name('sales.export.pdf');
        });
    });
});