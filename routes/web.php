<?php

use App\Http\Controllers\EmployeeManagement;
use App\Http\Controllers\ManagaementRepirController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminManagement;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegistorController;
use App\Http\Controllers\RepirController;
use Illuminate\Support\Facades\Route;
// routes/web.php






// Registration Routes
Route::get('register', [RegistorController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegistorController::class, 'register']);

// Authentication Routes
Route::get('/', [LoginController::class, 'showLoginForm'])->name('login.form');
Route::post('login', [LoginController::class, 'login'])->name('login');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

// Inactive Page Route
Route::get('/inactive', function () {
    return view('active');
})->name('active')->middleware('admin');

// Admin Routes
Route::middleware('admin')->group(function () {
    
    Route::get('/pdf-customer', [PDFController::class, 'Gpdf'])->name('pdf.customer');

    // Route::get('/admin/add-employee', [PageController::class, 'adminPageAddEmployee'])->name('employee.add');
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

    Route::get('/listrepair/req', [ManagaementRepirController::class, 'RepirList'])->name('customer.repir');
    Route::get('/repair/selectemployee/{id}', [ManagaementRepirController::class, 'selectemployee'])->name('repair.selectemployee');
    Route::put('/repair/update/{id}', [ManagaementRepirController::class, 'update'])->name('repair.update');
    Route::get('/dashboard/admin', [AdminController::class, 'Dashboard'])->name('admin.dashboard');
});

// Customer Routes
Route::middleware('customer')->group(function () {
    Route::get('/pagerepir', [PageController::class, 'PageCustomer'])->name('customer.dashboard');
    Route::get('/formrepir', [PageController::class, 'PageAddRepirCustomer'])->name('customer.addrepir');
    // Store a new repair request
    Route::get('/listrepair', [RepirController::class, 'RepirList'])->name('repairs.list');
    Route::post('/repairs', [RepirController::class, 'AddRepir'])->name('repairs.store');
    Route::get('/repairs/{id}', [RepirController::class, 'edit'])->name('repairs.edit');
    Route::put('/repairsupdate/{id}/req', [RepirController::class, 'update'])->name('repairs.update');
    Route::delete('/repairsupdate/{id}/delete', [RepirController::class, 'destroy'])->name('repairscustomer.delete');

    // ----------------------
    Route::get('/profile/customer/view', [ProfileController::class, 'getProfileCustomer'])->name('profileCustomer.view');
});

// Employee Routes
Route::middleware('employee')->group(function () {
    Route::get('/employeeWorkList', [PageController::class, 'PageEmployee'])->name('employee.dashboard');
    Route::get('/work_employee', [EmployeeManagement::class, 'listwork'])->name('employee.work');
    Route::get('/repair/repair/{id}', [EmployeeManagement::class, 'selectProduct'])->name('repair.selectproduct');
    Route::put('/repair/{id}/updateProduct', [EmployeeManagement::class, 'updateProduct'])->name('repair.updateProduct');
    Route::get('/repair/warningstatus/{id}', [EmployeeManagement::class, 'statuswarning'])->name('repair.warning');
    Route::put('/repair/{id}/statusupdate', [EmployeeManagement::class, 'updateStatus'])->name('repair.updateStatus');
    Route::put('/repair/{id}/statusupdatedone', [EmployeeManagement::class, 'done'])->name('repair.done');

    // -------------
    Route::get('/profile/employee/view', [ProfileController::class, 'getProfile'])->name('profile.view');
});