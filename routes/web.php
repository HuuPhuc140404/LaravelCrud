<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

//
// Trong routes/web.php
Route::get('/users', [UserController::class, 'loadAllUsers'])->name('users');
Route::get('add/user', [UserController::class, 'loadAddUserForm'])->name('AddUserForm');


Route::post('add/user', [UserController::class, 'AddUser'])->name('AddUser');
Route::get('edit/{id}', [UserController::class, 'loadEditUserForm']);
Route::get('delete/{id}', [UserController::class, 'deleteUser']);

Route::post('edit/user', [UserController::class, 'EditUser'])->name('EditUser');
