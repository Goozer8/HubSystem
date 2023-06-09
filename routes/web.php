<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\EmployeeController;
use App\Http\Controllers\Backend\CustomerController;
use App\Http\Controllers\Backend\SupplierController;
use App\Http\Controllers\Backend\SalaryController;
use App\Http\Controllers\Backend\AttendenceController;
use App\Http\Controllers\Backend\CategoryController;



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
});

Route::get('/dashboard', function () {
    return view('index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/admin/logout', [AdminController::class, 'AdminDestroy'])->name('admin.logout');

Route::get('/logout', [AdminController::class, 'AdminLogoutPage'])->name('admin.logout.page');


Route::middleware(['auth'])->group(function(){
    
    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');

    Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');


    /// Employee All Route
    Route::controller(EmployeeController::class)->group(function(){
        Route::get('/all/employee', 'AllEmployee')->name('all.employee');
        Route::get('/add/employee', 'AddEmployee')->name('add.employee');
        Route::post('/store/employee', 'StoreEmployee')->name('employee.store');
        Route::get('/edit/employee/{id}', 'EditEmployee')->name('edit.employee');
        Route::post('/employee/update', 'UpdateEmployee')->name('update.employee');
        Route::get('/delete/employee/{id}', 'DeleteEmployee')->name('delete.employee');

    });
    /// Customer All Route
    Route::controller(CustomerController::class)->group(function(){
        Route::get('/all/customer', 'AllCustomer')->name('all.customer');
        Route::get('/add/customer', 'AddCustomer')->name('add.customer');
        Route::post('/store/customer', 'StoreCustomer')->name('customer.store');
        Route::get('/edit/customer/{id}', 'EditCustomer')->name('edit.customer');
        Route::post('/customer/update', 'CustomerUpdate')->name('update.customer');
        Route::get('/delete/customer/{id}', 'DeleteCustomer')->name('delete.customer');
    });

    /// Supplier All Route
    Route::controller(SupplierController::class)->group(function(){
        Route::get('/all/supplier', 'AllSupplier')->name('all.supplier');
        Route::get('/add/supplier', 'AddSupplier')->name('add.supplier');
        Route::post('/store/supplier', 'StoreSupplier')->name('supplier.store');
        Route::get('/edit/supplier/{id}', 'EditSupplier')->name('edit.supplier');
        Route::post('/supplier/update', 'UpdateSupplier')->name('update.supplier');
        Route::get('/delete/supplier/{id}', 'DeleteSupplier')->name('delete.supplier');
        Route::get('/details/supplier/{id}', 'DetailsSupplier')->name('details.supplier');
    });

    /// Salary All Route
    Route::controller(SalaryController::class)->group(function(){
        Route::get('/add/advance/salary', 'AddAdvanceSalary')->name('add.advance.salary');
        Route::post('/advance/salary/salary', 'AdvanceSalaryStore')->name('advance.salary.store');
        Route::get('/all/advance/salary', 'AllAdvanceSalary')->name('all.advance.salary');
        Route::get('/edit/advance/salary/{id}','EditAdvanceSalary')->name('edit.advance.salary');
        Route::post('/advance/salary/update','AdvanceSalaryUpdate')->name('advance.salary.update');
    });
///
    Route::controller(SalaryController::class)->group(function(){
        Route::get('/pay/salary', 'PaySalary')->name('pay.salary');
        Route::get('/pay/now/salary{id}', 'PayNowSalary')->name('pay.now.salary');
        Route::post('/employee/salary/store', 'EmployeeSalaryStore')->name('employee.salary.store');
        route::get('/month/salary', 'MonthSalary')->name('month.salary');
    });

    /// Attendence All Route
    Route::controller(AttendenceController::class)->group(function(){
        Route::get('/employee/attend/list', 'EmployeeAttendenceList')->name('employee.attend.list');
        Route::get('/employee/attend/add', 'AddEmployeeAttendence')->name('add.employee.attend');
        Route::post('/employee/attend/store', 'EmployeeAttendenceStore')->name('employee.attend.store');
        Route::get('/edit/employee/attend/{date}', 'EditEmployeeAttendence')->name('employee.attend.edit');
        Route::get('/view/employee/attend/{date}','ViewEmployeeAttendence')->name('employee.attend.view'); 
    });

    /// Category All Route
    Route::controller(CategoryController::class)->group(function(){
        Route::get('/all/category', 'AllCategory')->name('all.category');

    });


});