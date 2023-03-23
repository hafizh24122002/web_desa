<?php

use App\Http\Controllers\MainVisitorController;
use App\Http\Controllers\MainAdminController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Carbon\Carbon;

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

// route pengunjung
Route::get('/', [MainVisitorController::class, 'index']);
Route::get('/tentang-desa', [MainVisitorController::class, 'aboutDesa']);
Route::get('/geografis-desa', [MainVisitorController::class, 'geografisDesa']);
Route::get('/demografi-desa', [MainVisitorController::class, 'demografiDesa']);

// route admin
Route::get('/admin/dashboard', [MainAdminController::class, 'index'])->middleware('auth');
Route::get('/admin/user-manager', [MainAdminController::class, 'userManager'])->middleware('auth');
Route::get('/admin/user-manager/new-user', [MainAdminController::class, 'newUser'])->middleware('auth');
Route::post('/admin/user-manager/new-user', [MainAdminController::class, 'addUser'])->middleware('auth');
Route::get('/admin/user-manager/edit-user/{user:username}', [MainAdminController::class, 'editUser'])->middleware('auth');
Route::put('/admin/user-manager/edit-user/{user:username}', [MainAdminController::class, 'editUserSubmit'])->middleware('auth');
Route::delete('/admin/user-manager/{user:username}', [MainAdminController::class, 'deleteUser'])->middleware('auth');

// session
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);
