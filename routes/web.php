<?php

use App\Http\Controllers\MainVisitorController;
use App\Http\Controllers\MainAdminController;
use App\Http\Controllers\KependudukanController;
use App\Http\Controllers\KeluargaController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SuratController;
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

// route admin
Route::get('/admin/dashboard', [MainAdminController::class, 'index'])->middleware('auth');

Route::get('/admin/user-manager', [MainAdminController::class, 'userManager'])->middleware('auth');
Route::get('/admin/user-manager/new-user', [MainAdminController::class, 'newUser'])->middleware('auth');
Route::post('/admin/user-manager/new-user', [MainAdminController::class, 'addUser'])->middleware('auth');
Route::get('/admin/user-manager/edit-user/{user:username}', [MainAdminController::class, 'editUser'])->middleware('auth');
Route::put('/admin/user-manager/edit-user/{user:username}', [MainAdminController::class, 'editUserSubmit'])->middleware('auth');
Route::delete('/admin/user-manager/{user:username}', [MainAdminController::class, 'deleteUser'])->middleware('auth');

// route staf
Route::get('/staf/kependudukan/penduduk', [KependudukanController::class, 'kependudukan'])->middleware('auth');
Route::get('/staf/kependudukan/penduduk/new-penduduk', [KependudukanController::class, 'pendudukNew'])->middleware('auth');
Route::post('/staf/kependudukan/penduduk/new-penduduk', [KependudukanController::class, 'pendudukNewSubmit'])->middleware('auth');
Route::get('/staf/kependudukan/penduduk/edit-penduduk/{penduduk:nik}', [KependudukanController::class, 'pendudukEdit'])->middleware('auth');
Route::put('/staf/kependudukan/penduduk/edit-penduduk/{penduduk:nik}', [KependudukanController::class, 'pendudukEditSubmit'])->middleware('auth');
Route::delete('/staf/kependudukan/penduduk/{penduduk:nik}', [KependudukanController::class, 'pendudukDelete'])->middleware('auth');

Route::get('/staf/kependudukan/keluarga', [KeluargaController::class, 'keluarga'])->middleware('auth');
Route::get('/staf/kependudukan/keluarga/new-keluarga', [KeluargaController::class, 'keluargaNew'])->middleware('auth');
Route::post('/staf/kependudukan/keluarga/new-keluarga', [KeluargaController::class, 'keluargaNewSubmit'])->middleware('auth');
Route::get('/staf/kependudukan/keluarga/edit-keluarga/{keluarga:no_kk}', [KeluargaController::class, 'keluargaEdit'])->middleware('auth');
Route::put('/staf/kependudukan/keluarga/edit-keluarga/{keluarga:no_kk}', [KeluargaController::class, 'keluargaEditSubmit'])->middleware('auth');
Route::delete('/staf/kependudukan/keluarga/{keluarga:no_kk}', [KeluargaController::class, 'keluargaDelete'])->middleware('auth');

// TODO #10
Route::get('/staf/manajemen-web/dashboard', [ArtikelController::class, 'dashboard'])->middleware('auth');
Route::get('/staf/manajemen-web/artikel', [ArtikelController::class, 'articleManager'])->middleware('auth');

Route::get('/staf/layanan-surat/buat-surat', [SuratController::class, 'suratNew'])->middleware('auth');
Route::get('/staf/layanan-surat/buat-surat/{surat:nama}', [SuratController::class, 'suratNewInput'])->middleware('auth');
Route::post('/staf/layanan-surat/buat-surat/{surat:nama}', [SuratController::class, 'suratNewInputSubmit'])->middleware('auth');
Route::get('/staf/layanan-surat/buat-surat/get-data/{penduduk:nama}', [SuratController::class, 'getDataPenduduk'])->middleware('auth');
Route::get('/staf/layanan-surat/arsip-surat', [SuratController::class, 'arsipSurat'])->middleware('auth');
Route::get('/staf/layanan-surat/arsip-surat/lihat-surat/{arsip:filename}', [SuratController::class, 'lihatSurat'])->middleware('auth');
Route::delete('/staf/layanan-surat/arsip-surat/{arsip:id}', [SuratController::class, 'hapusSurat'])->middleware('auth');

// session
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);
