<?php

use App\Http\Controllers\MainVisitorController;
use App\Http\Controllers\MainAdminController;
use App\Http\Controllers\KependudukanController;
use App\Http\Controllers\KeluargaController;
use App\Http\Controllers\KesehatanController;
use App\Http\Controllers\StafController;
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
Route::get('/tentang-desa', [MainVisitorController::class, 'aboutDesa']);
Route::get('/geografis-desa', [MainVisitorController::class, 'geografisDesa']);
Route::get('/demografi-desa', [MainVisitorController::class, 'demografiDesa']);
Route::get('/artikel/{judul}', [MainVisitorController::class, 'bacaArtikel']);

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
Route::get('/staf/kependudukan/penduduk/get-data/{nama}', [KependudukanController::class, 'getDataPenduduk'])->middleware('auth');
Route::get('/staf/kependudukan/penduduk/get-data/tanggal-lahir/{nik}', [KependudukanController::class, 'getTanggalLahir'])->middleware('auth');

Route::get('/staf/kependudukan/keluarga', [KeluargaController::class, 'keluarga'])->middleware('auth');
Route::get('/staf/kependudukan/keluarga/new-keluarga', [KeluargaController::class, 'keluargaNew'])->middleware('auth');
Route::post('/staf/kependudukan/keluarga/new-keluarga', [KeluargaController::class, 'keluargaNewSubmit'])->middleware('auth');
Route::get('/staf/kependudukan/keluarga/edit-keluarga/{keluarga:no_kk}', [KeluargaController::class, 'keluargaEdit'])->middleware('auth');
Route::put('/staf/kependudukan/keluarga/edit-keluarga/{keluarga:no_kk}', [KeluargaController::class, 'keluargaEditSubmit'])->middleware('auth');
Route::delete('/staf/kependudukan/keluarga/{keluarga:no_kk}', [KeluargaController::class, 'keluargaDelete'])->middleware('auth');

Route::get('/staf/kesehatan/posyandu', [KesehatanController::class, 'posyandu'])->middleware('auth');
Route::get('/staf/kesehatan/posyandu/new-posyandu', [KesehatanController::class, 'posyanduNew'])->middleware('auth');
Route::post('/staf/kesehatan/posyandu/new-posyandu', [KesehatanController::class, 'posyanduNewSubmit'])->middleware('auth');
Route::get('/staf/kesehatan/posyandu/edit-posyandu/{id}', [KesehatanController::class, 'posyanduEdit'])->middleware('auth');
Route::put('/staf/kesehatan/posyandu/edit-posyandu/{id}', [KesehatanController::class, 'posyanduEditSubmit'])->middleware('auth');
Route::delete('staf/kesehatan/posyandu/{id}', [KesehatanController::class, 'posyanduDelete'])->middleware('auth');
Route::get('/staf/kesehatan/kia', [KesehatanController::class, 'kia'])->middleware('auth');
Route::get('/staf/kesehatan/kia/new-kia', [KesehatanController::class, 'kiaNew'])->middleware('auth');
Route::post('staf/kesehatan/kia/new-kia', [KesehatanController::class, 'kiaNewSubmit'])->middleware('auth');
Route::get('/staf/kesehatan/kia/edit-kia/{id}', [KesehatanController::class, 'kiaEdit'])->middleware('auth');
Route::put('/staf/kesehatan/kia/edit-kia/{id}', [KesehatanController::class, 'kiaEditSubmit'])->middleware('auth');
Route::delete('/staf/kesehatan/kia/{id}', [KesehatanController::class, 'kiaDelete'])->middleware('auth');
Route::get("/staf/kesehatan/pemantauan", [KesehatanController::class, 'pemantauan'])->middleware('auth');
Route::get("/staf/kesehatan/pemantauan/new-pemantauan-ibu", [KesehatanController::class, 'pemantauanIbuNew'])->middleware('auth');
Route::post("/staf/kesehatan/pemantauan/new-pemantauan-ibu", [KesehatanController::class, 'pemantauanIbuNewSubmit'])->middleware('auth');
Route::get('/staf/kesehatan/pemantauan/edit-pemantauan-ibu/{id}', [KesehatanController::class, 'pemantauanIbuEdit'])->middleware('auth');
Route::put('/staf/kesehatan/pemantauan/edit-pemantauan-ibu/{id}', [KesehatanController::class, 'pemantauanIbuEditSubmit'])->middleware('auth');
Route::delete('staf/kesehatan/pemantauan/ibu/{id}', [KesehatanController::class, 'pemantauanIbuDelete'])->middleware('auth');
Route::get('staf/kesehatan/pemantauan/new-pemantauan-anak', [KesehatanController::class, 'pemantauanAnakNew'])->middleware('auth');
Route::post('staf/kesehatan/pemantauan/new-pemantauan-anak', [KesehatanController::class, 'pemantauanAnakNewSubmit'])->middleware('auth');
Route::get('staf/kesehatan/pemantauan/edit-pemantauan-anak/{id}', [KesehatanController::class, 'pemantauanAnakEdit'])->middleware('auth');
Route::put('staf/kesehatan/pemantauan/edit-pemantauan-anak/{id}', [KesehatanController::class, 'pemantauanAnakEditSubmit'])->middleware('auth');
Route::delete('staf/kesehatan/pemantauan/anak/{id}', [KesehatanController::class, 'pemantauanAnakDelete'])->middleware('auth');
Route::get('staf/kesehatan/pemantauan/new-sasaran-paud', [KesehatanController::class, 'sasaranPaudNew'])->middleware('auth');

Route::get('/staf/manajemen-staf/', [StafController::class, 'pohonStaf'])->middleware('auth');
Route::get('/staf/manajemen-staf/get-data', [StafController::class, 'getDataStaf'])->middleware('auth');
Route::get('/staf/manajemen-staf/daftar-staf', [StafController::class, 'daftarStaf'])->middleware('auth');
Route::get('/staf/manajemen-staf/new-staf', [StafController::class, 'stafNew'])->middleware('auth');
Route::post('/staf/manajemen-staf/new-staf', [StafController::class, 'stafNewSubmit'])->middleware('auth');
Route::get('/staf/manajemen-staf/edit-staf/{id}', [StafController::class, 'stafEdit'])->middleware('auth');
Route::put('/staf/manajemen-staf/edit-staf/{id}', [StafController::class, 'stafEditSubmit'])->middleware('auth');
Route::delete('/staf/manajemen-staf/{id}', [StafController::class, 'stafDelete'])->middleware('auth');

Route::get('/staf/manajemen-web/dashboard', [ArtikelController::class, 'dashboard'])->middleware('auth');
Route::get('/staf/manajemen-web/artikel', [ArtikelController::class, 'articleManager'])->middleware('auth');
Route::get('/staf/manajemen-web/artikel/new-artikel', [ArtikelController::class, 'artikelNew'])->middleware('auth');
Route::post('/staf/manajemen-web/artikel/new-artikel', [ArtikelController::class, 'artikelNewSubmit'])->middleware('auth');
Route::get('/staf/manajemen-web/artikel/edit-artikel/{id}', [ArtikelController::class, 'artikelEdit'])->middleware('auth');
Route::put('/staf/manajemen-web/artikel/edit-artikel/{id}', [ArtikelController::class, 'artikelEditSubmit'])->middleware('auth');
Route::delete('/staf/manajemen-web/artikel/{id}', [ArtikelController::class, 'artikelDelete'])->middleware('auth');
Route::post('/staf/manajemen-web/artikel/upload-image', [ArtikelController::class, 'storeImage'])->middleware('auth');

Route::get('/staf/layanan-surat/buat-surat', [SuratController::class, 'suratNew'])->middleware('auth');
Route::get('/staf/layanan-surat/buat-surat/{surat:nama}', [SuratController::class, 'suratNewInput'])->middleware('auth');
Route::post('/staf/layanan-surat/buat-surat/{surat:nama}', [SuratController::class, 'suratNewInputSubmit'])->middleware('auth');
Route::get('/staf/layanan-surat/arsip-surat', [SuratController::class, 'arsipSurat'])->middleware('auth');
Route::get('/staf/layanan-surat/arsip-surat/{arsip:filename}', [SuratController::class, 'suratDownload'])->middleware('auth');
Route::get('/staf/layanan-surat/arsip-surat/edit-surat/{id}/{filename}', [SuratController::class, 'suratEdit'])->middleware('auth');
Route::put('/staf/layanan-surat/arsip-surat/edit-surat/{id}/{filename}', [SuratController::class, 'suratEditSubmit'])->middleware('auth');
Route::delete('/staf/layanan-surat/arsip-surat/{id}/{filename}', [SuratController::class, 'suratDelete'])->middleware('auth');

// session
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

