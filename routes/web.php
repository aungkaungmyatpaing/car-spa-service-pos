<?php

use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CartController;
use App\Http\Controllers\Backend\CashierController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ColorController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\DurationController;
use App\Http\Controllers\Backend\InvoiceController;
use App\Http\Controllers\Backend\InvoiceHistoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ServiceController;
use App\Http\Controllers\Backend\SizeController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/admin/login', [AuthController::class, 'getLoginPage'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'adminLogin'])->name('adminLogin');


Route::middleware(['auth'])->group(function () {
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');

    Route::resource('carts', CartController::class);
    Route::get('cashier', [CashierController::class, 'index'])->name('cashier.index');
    Route::put('cart/{cartId}/update-quantity', [CartController::class, 'updateQuantity']);
    Route::get('cart/total-price', [CartController::class, 'getTotalPrice']);
    Route::post('cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');

    Route::resource('invoices', InvoiceController::class);
    Route::get('invoice/{invoiceId}/print', [InvoiceController::class, 'print'])->name('invoice.print');
    Route::get('invoice-history/{invoiceId}/print', [InvoiceHistoryController::class, 'print'])->name('invoiceHistories.print');

});

Route::middleware(['auth', 'superAdmin'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('users', UserController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('sub_categories', SubCategoryController::class);
    Route::resource('durations', DurationController::class);
    Route::resource('sizes', SizeController::class);
    Route::resource('services', ServiceController::class);
    Route::resource('invoiceHistories', InvoiceHistoryController::class);
    Route::get('service/{serviceId}/barcode/print', [ServiceController::class, 'print'])->name('service.barcode.print');
});
