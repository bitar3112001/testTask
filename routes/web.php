<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\PaymentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Role;
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
})->name('login')->middleware('guest');
Route::post('/login',[Controller::class,'logIn']);
Route::get('/register',function(){ return view('register');});
Route::post('/regis',[Controller::class,'register']);

Route::middleware(['auth' ])->group(function () {

Route::get('/logout',[Controller::class,'logout']);
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


Route::post('/saveboard',[TaskController::class,'saveBoard'])->middleware('checkRole');
Route::post('/savetask',[TaskController::class,'saveTask'])->middleware('checkRole');
Route::post('/deletetask',[TaskController::class,'DeleteTask'])->middleware('checkRole');
Route::post('/deleteboard',[TaskController::class,'DeleteBoard'])->middleware('checkRole');
Route::post('/savedescription',[TaskController::class,'saveDescription'])->middleware('checkRole');
Route::post('/getdescription/{id}',[TaskController::class,'getDescription']);
Route::post('/savecomment',[TaskController::class,'saveComment']);
Route::post('/getcomments/{id}',[TaskController::class,'getCommnets']);
Route::delete('/deltecomment/{id}',[TaskController::class,'DeleteCommnet']);

Route::put('/edittaskname',[TaskController::class,'editTaskName'])->middleware('checkRole');
Route::put('/editcomment',[TaskController::class,'editComment']);
Route::put('/dragtasks',[TaskController::class,'DragTasks'])->middleware('checkRole');
// Acounting start

Route::get('/payments/create', [PaymentController::class, 'create'])->name('payments.create');
Route::post('/payments', [PaymentController::class, 'store'])->name('payments.store');

// Accounting end

Route::get('/checkRole', function (Request $request) {
    // Get the authenticated user
    $user = Auth::user();
    Log::info($user);
    Log::info('star');
    if (!$user) {
        Log::info('ali 1');

        return response()->json(['success' => false, 'message' => 'User not authenticated'], 401);
    }

    // Get the user's role
    $role = Role::where('employee_id', $user->id)->first();
    Log::info($role);

    // Check if the user has the "Admin" role
    if ($role && $role->access_role === "Admin") {
        Log::info('ali 2');
        return response()->json(['success' => true], 200);
    } else {
        Log::info('ali 3');
        return response()->json(['success' => false], 200);
    }

})->name('checkrole');




});
Route::put('/editboardname',[TaskController::class,'editBoardName'])->middleware('checkRole');
