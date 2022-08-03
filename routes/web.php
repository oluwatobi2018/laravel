<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserManageController;
use App\Http\Controllers\DataController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/login');
});

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'admin'], function () {
Route::get('/users',  [UserManageController::class, 'index'])->name('usersManagement')->middleware('auth');
Route::get('/getUsers',  [UserManageController::class, 'getUser'])->name('getUsers')->middleware('auth');
Route::get('/user_save',  [UserManageController::class, 'user_save'])->name('userSaved')->middleware('auth');
Route::get('/user_delete',  [UserManageController::class, 'user_delete'])->name('user_delete')->middleware('auth');
Route::get('/approve',  [UserManageController::class, 'approve'])->name('approve')->middleware('auth');

Route::get('/data',  [DataController::class, 'index'])->name('dataManagement')->middleware('auth');
Route::get('/data_save',  [DataController::class, 'data_save'])->name('data_save')->middleware('auth');
Route::get('/data_delete',  [DataController::class, 'data_delete'])->name('data_delete')->middleware('auth');
});



