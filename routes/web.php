<?php

use App\Http\Controllers\User;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HistoryController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('signin');
});
Route::post('signin', [UserController::class, 'login']);
Route::get('signup/page', [UserController::class, 'signupPage']);
Route::get('/tiktactoe', [UserController::class, 'tiktactoe']);
Route::post('/register/employee', [EmployeeController::class, 'register']);

Route::group(['middleware' => 'admin'],function () {
    //DashBoard
    Route::get('dashboard', [UserController::class, 'dashboard']);


    //Users
    // Route::get('users', [UserController::class, 'users']);
    // Route::get('create/user', [UserController::class, 'createUser']);
    // Route::post('add/user', [UserController::class, 'addUser']);
    // Route::post('change/user/password', [UserController::class, 'changeUserPassword']);
    // Route::get('delete/user/{id}', [UserController::class, 'delete_user']);
    // Route::get('edit/user/{id}', [UserController::class, 'editUser']);
    // Route::post('update/user', [UserController::class, 'updateUser']);


    //Employees
    Route::get('employees', [EmployeeController::class, 'employees']);
    Route::get('create/emp', [EmployeeController::class, 'createEmp']);
    Route::post('add/emp', [EmployeeController::class, 'addEmp']);
    Route::get('edit/emp/{id}', [EmployeeController::class, 'editEmp']);
    Route::post('update/emp', [EmployeeController::class, 'updateEmp']);
    Route::get('delete/emp/{id}', [EmployeeController::class, 'deleteEmp']);


    //Attendance
    Route::get('attendance', [AttendanceController::class, 'index']);
    Route::get('attendance/employees', [AttendanceController::class, 'attendanceEmployees']);
    Route::get('inn/{id}', [AttendanceController::class, 'inn']);
    Route::get('out/{id}', [AttendanceController::class, 'out']);
    Route::get('wfh/{id}', [AttendanceController::class, 'wfh']);
    Route::get('leave/{id}', [AttendanceController::class, 'leave']);


    //Attendance History
    Route::get('attendance/history', [HistoryController::class, 'index']);
});

Route::group(['middleware' => 'employee'], function () {
    Route::get('home', [UserController::class, 'dashboard']);
});

//Logout
Route::get('/logout', [UserController::class, 'logout']);
