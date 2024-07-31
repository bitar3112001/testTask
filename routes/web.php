<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\PaymentController;

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


//Login & register
Route::get('/', function () {
    return view('login');
});

Route::post('/login',[Controller::class,'logIn']);
Route::get('/register',function(){ return view('register');});
Route::post('/regis',[Controller::class,'register']);

//home
Route::get('/home',function(){return view('home');});

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
Route::post('/admin/task',[TaskController::class,'NewTask']);
Route::get('/admin/assignment',[TaskController::class,'AssignmentView']);

Route::post('/admin/assignment',[TaskController::class,'NewAssignment']);
Route::put('/admin/assignment/end/{id}', [TaskController::class, 'EndAssignment']);
Route::put('/admin/assignment/{id}', [TaskController::class, 'AssignmentEdit']);
Route::get('/admin/task/managment/{id}',[TaskController::class,'Manage_Task_View']);
//  Route::put('/admin/assignment/end/{id}', [TaskController::class, 'endproject']);
//Route::get('/admin/assignment',[TaskController::class,'AssignmentView']);
//Route::post('/admin/assignment',[TaskController::class,'NewProject']);

Route::get('/admin/task/test',[TaskController::class,'test']);

//Route::post('/admin/assignment',[TaskController::class,'NewProject']);


Route::post('/saveboard',[TaskController::class,'saveBoard']);
Route::post('/savetask',[TaskController::class,'saveTask']);
Route::post('/deletetask',[TaskController::class,'DeleteTask']);
Route::post('/deleteboard',[TaskController::class,'DeleteBoard']);
Route::post('/savedescription',[TaskController::class,'saveDescription']);
Route::post('/getdescription/{id}',[TaskController::class,'getDescription']);
Route::post('/savecomment',[TaskController::class,'saveComment']);
Route::post('/getcomments/{id}',[TaskController::class,'getCommnets']);
Route::delete('/deltecomment/{id}',[TaskController::class,'DeleteCommnet']);
Route::put('/editboardname',[TaskController::class,'editBoardName']);
Route::put('/edittaskname',[TaskController::class,'editTaskName']);
Route::put('/editcomment',[TaskController::class,'editComment']);
Route::put('/dragtasks',[TaskController::class,'DragTasks']);
// Acounting start

Route::get('/payments/create', [PaymentController::class, 'create'])->name('payments.create');
Route::post('/payments', [PaymentController::class, 'store'])->name('payments.store');

// Accounting end

