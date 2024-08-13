<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminManagement;
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
use App\Http\Controllers\RegistorController;





Route::get('register', [RegistorController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegistorController::class, 'register']);
Route::get('/', [LoginController::class, 'showLoginForm'])->name('login.form');

// การล็อกอิน
Route::post('login', [LoginController::class, 'login'])->name('login');
// การออกจากระบบ
Route::post('logout', [LoginController::class, 'logout'])->name('logout');


Route::get('/inactive', function () {
    return view('active');
})->name('active')->middleware('admin');


//admin
Route::get('/admin-add-employee', [PageController::class, 'adminPageAddEmployee'])->name('employee.add')->middleware('admin');
Route::post('/admin/add-employee', [AdminController::class, 'addEmployee'])->name('admin.addEmployee')->middleware('admin');
Route::get('/employees', [AdminController::class, 'ListEmployee'])->name('employee.list')->middleware('admin');
Route::get('/employee/edit/{id}', [AdminManagement::class, 'EditEmployee'])->name('employee.edit')->middleware('admin');
Route::put('/employee/update/{id}', [AdminManagement::class, 'UpdateEmployee'])->name('employee.update')->middleware('admin');
Route::delete('/employee/delete/{id}', [AdminManagement::class, 'DeleteEmployee'])->name('employee.delete')->middleware('admin');

Route::get('/admin-add-product', [PageController::class, 'adminPageAddProduct'])->name('product.add')->middleware('admin');
Route::post('/products/add', [AdminController::class, 'AddProduct'])->name('admin.addProduct')->middleware('admin');
Route::get('/products', [AdminController::class, 'ListProduct'])->name('products.view')->middleware('admin');
Route::get('/product/edit/{id}', [AdminManagement::class, 'EditProduct'])->name('product.edit')->middleware('admin');
Route::put('/product/update/{id}', [AdminManagement::class, 'UpdateProduct'])->name('product.update')->middleware('admin');
Route::delete('/product/delete/{id}', [AdminManagement::class, 'DeleteProduct'])->name('product.delete')->middleware('admin');
//admin



//customer
Route::get('/pagerepir', [PageController::class, 'PageCustomer'])->name('customer.dashboard')->middleware('customer');
Route::get('/formrepir', [PageController::class, 'PageAddRepirCustomer'])->name('customer.addrepir')->middleware('customer');
//customer


//employee
Route::get('/employeeWorkList',[PageController::class, 'PageEmployee'])->name('employee.dashboard')->middleware('employee');

