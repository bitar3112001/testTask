<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

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
    return view('home');
});

Route::get('/admin/addRole',function(){
    return view('admin.Role.AddRole');
})->name('addRole');
Route::get('/admin/addEmployee',function(){
    return view('admin.Employee.AddEmployee');
})->name('addEmployee');
Route::get('/customer/addCustomer',function(){
    return view('customer.addCustomer');
})->name('addCustomer');

Route::get('/admin/task',[TaskController::class,'TaskView']);
