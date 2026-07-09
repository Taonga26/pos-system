<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderDetailController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Route;


Route::middleware('guest')->group(function () {

    Route::get('/', function () {
        return view('home');
    });

    Route::post('/login', [AuthController::class, 'login']);

});

Route::middleware(['auth','role:Manager,Admin'])->group(function () {

    Route::resource('products', ProductController::class);

    Route::resource('inventory', InventoryController::class);

    Route::resource('ingredients', IngredientController::class);

    Route::resource('suppliers', SupplierController::class);

    Route::resource('analytics', ReportController::class);

    Route::resource('employees', EmployeeController::class);

});

Route::middleware('auth')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::resource('orders', OrderController::class);

    Route::resource('customers', CustomerController::class);

    Route::resource('payments', PaymentController::class);

    Route::resource('order-details', OrderDetailController::class);

});

Route::middleware(['auth','role:Admin'])->group(function () {

    Route::resource('admin', AdminController::class);

    Route::post('/register', [AuthController::class, 'register']);

});



