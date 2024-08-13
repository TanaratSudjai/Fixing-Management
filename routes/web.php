<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminManagement;
use App\Http\Controllers\RegistorController;
use Illuminate\Support\Facades\Route;

// Registration Routes
Route::get('register', [RegistorController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegistorController::class, 'register']);

// Authentication Routes
Route::get('/', [LoginController::class, 'showLoginForm'])->name('login.form');
Route::post('login', [LoginController::class, 'login'])->name('login');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Inactive Page Route
Route::get('/inactive', function () {
    return view('active');
})->name('active')->middleware('admin');

// Admin Routes
Route::middleware('admin')->group(function () {
    Route::get('/admin-add-employee', [PageController::class, 'adminPageAddEmployee'])->name('employee.add');
    Route::post('/admin/add-employee', [AdminController::class, 'AddEmployee'])->name('admin.addEmployee');
    Route::get('/employees', [AdminController::class, 'ListEmployee'])->name('employee.list');
    Route::get('/employee/edit/{id}', [AdminManagement::class, 'EditEmployee'])->name('employee.edit');
    Route::put('/employee/update/{id}', [AdminManagement::class, 'UpdateEmployee'])->name('employee.update');
    Route::delete('/employee/delete/{id}', [AdminManagement::class, 'DeleteEmployee'])->name('employee.delete');

    Route::get('/admin-add-product', [PageController::class, 'adminPageAddProduct'])->name('product.add');
    Route::post('/products/add', [AdminController::class, 'AddProduct'])->name('admin.addProduct');
    Route::get('/products', [AdminController::class, 'ListProduct'])->name('products.view');
    Route::get('/product/edit/{id}', [AdminManagement::class, 'EditProduct'])->name('product.edit');
    Route::put('/product/update/{id}', [AdminManagement::class, 'UpdateProduct'])->name('product.update');
    Route::delete('/product/delete/{id}', [AdminManagement::class, 'DeleteProduct'])->name('product.delete');
});

// Customer Routes
Route::middleware('customer')->group(function () {
    Route::get('/pagerepir', [PageController::class, 'PageCustomer'])->name('customer.dashboard');
    Route::get('/formrepir', [PageController::class, 'PageAddRepirCustomer'])->name('customer.addrepir');
});

// Employee Routes
Route::middleware('employee')->group(function () {
    Route::get('/employeeWorkList', [PageController::class, 'PageEmployee'])->name('employee.dashboard');
});
