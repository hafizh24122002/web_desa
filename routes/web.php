<?php

use App\Http\Controllers\MainVisitorController;
use App\Http\Controllers\MainAdminController;
use App\Http\Controllers\KependudukanController;
use App\Http\Controllers\KeluargaController;
use App\Http\Controllers\KesehatanController;
use App\Http\Controllers\StafController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\StatistikController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\BukuExportController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\DokumenController;
use App\Http\Controllers\InfoDesaController;
use App\Http\Controllers\TempDusunController;
use App\Http\Controllers\GenerateQrController;
use App\Http\Controllers\RtmController;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
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
Route::get('/', [MainVisitorController::class, 'index'])->name('visitor.home');
Route::get('/tentang-desa', [MainVisitorController::class, 'aboutDesa']);
Route::get('/geografis-desa', [MainVisitorController::class, 'geografisDesa']);
Route::get('/demografi-desa', [MainVisitorController::class, 'demografiDesa']);
Route::get('/artikel/{judul}', [MainVisitorController::class, 'bacaArtikel']);
Route::get('/struktur-organisasi', [MainVisitorController::class, 'strukturOrganisasi']);
Route::get('/perangkat-desa', [MainVisitorController::class, 'perangkatDesa']);
Route::get('/dokumen', [MainVisitorController::class, 'dokumen']);
Route::get('/dokumen/download/{filename}', [MainVisitorController::class, 'downloadDokumen']);

// session
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/forgot-password', [LoginController::class, 'forgotPasswordRequest'])->middleware('guest')->name('password.request');
Route::post('/forgot-password', [LoginController::class, 'forgotPasswordSubmit'])->middleware('guest')->name('password.email');
Route::get('/reset-password/{token}', [LoginController::class, 'passwordResetForm'])->middleware('guest')->name('password.reset');
Route::post('reset-password', [LoginController::class, 'passwordResetSubmit'])->middleware('guest')->name('password.update');
Route::get('/contact-form-captcha', [LoginController::class, 'indexCaptcha'])->name('password.forgot');
Route::post('/captcha-validation', [LoginController::class, 'captchaFormValidate']);
Route::get('/reload-captcha', [LoginController::class, 'reloadCaptcha']);

// debug
Route::get('/get-csrf-token', function () {
    return response()->json(['csrf_token' => csrf_token()]);
});

// email verification
Route::get('/verify-email', function () {
	$title = 'Email Verification';
	$current_page = 'Email Verification';
    return view('auth.verify-email', ['title' => $title, 'current_page' => $current_page]);
})->middleware('auth')->name('verification.notice');

Route::get('/verify-email/request', function () {
    auth()->user()->sendEmailVerificationNotification();
	return back()
		->with('success', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/verify-email/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
	return redirect()->to('/admin/dashboard');
})->middleware(['auth', 'signed'])->name('verification.verify');

// fetch coordinates
Route::get('/get-coordinates', function () {
    $geojsonFilePath = storage_path('app/koordinat_wilayah/coordinates.geojson');
    if (file_exists($geojsonFilePath)) {
        $contents = Storage::get('koordinat_wilayah/coordinates.geojson');
        return response()->json(json_decode($contents));
    }
    abort(404);
});

Route::middleware(['auth'])->group(function () {
	// route admin
	Route::get('/admin/dashboard', [MainAdminController::class, 'index']);

	Route::middleware(['role'])->group(function () {
		Route::get('/admin/user-manager', [MainAdminController::class, 'userManager']);
		Route::get('/admin/user-manager/new-user', [MainAdminController::class, 'newUser']);
		Route::post('/admin/user-manager/new-user', [MainAdminController::class, 'addUser']);
		Route::get('/admin/user-manager/edit-user/{user:username}', [MainAdminController::class, 'editUser']);
		Route::put('/admin/user-manager/edit-user/{user:username}', [MainAdminController::class, 'editUserSubmit']);
		Route::delete('/admin/user-manager/{user:username}', [MainAdminController::class, 'deleteUser']);
	});

	// Route::middleware(['verified.staf'])->group(function () {
		// route staf
		Route::get('/staf/buat-qr', [GenerateQrController::class, 'embedSrc']);
		Route::post('/staf/buat-qr', [GenerateQrController::class, 'generate']);
		Route::post('/staf/download-qr', [GenerateQrController::class, 'download']);

		Route::get('/staf/kependudukan/penduduk', [KependudukanController::class, 'kependudukan']);
		Route::get('/staf/kependudukan/penduduk/new-penduduk/{type}', [KependudukanController::class, 'pendudukNew']);
		Route::post('/staf/kependudukan/penduduk/new-penduduk/{type}', [KependudukanController::class, 'pendudukNewSubmit']);
		Route::get('/staf/kependudukan/penduduk/edit-penduduk/{penduduk:nik}', [KependudukanController::class, 'pendudukEdit']);
		Route::put('/staf/kependudukan/penduduk/edit-penduduk/{penduduk:nik}', [KependudukanController::class, 'pendudukEditSubmit']);
		Route::get('/staf/kependudukan/penduduk/edit-penduduk/status-dasar/{penduduk:nik}', [KependudukanController::class, 'pendudukStatusDasarEdit']);
		Route::put('/staf/kependudukan/penduduk/edit-penduduk/status-dasar/{penduduk:nik}', [KependudukanController::class, 'pendudukStatusDasarEditSubmit']);
		Route::delete('/staf/kependudukan/penduduk/{penduduk:nik}', [KependudukanController::class, 'pendudukDelete']);
		Route::get('/staf/kependudukan/penduduk/get-data/{nama}', [KependudukanController::class, 'getDataPenduduk']);
		Route::get('/staf/kependudukan/penduduk/get-data/tanggal-lahir/{nik}', [KependudukanController::class, 'getTanggalLahir']);

		Route::get('/staf/kependudukan/keluarga', [KeluargaController::class, 'keluarga']);
		Route::get('/staf/kependudukan/keluarga/new-keluarga', [KeluargaController::class, 'keluargaNew']);
		Route::post('/staf/kependudukan/keluarga/new-keluarga', [KeluargaController::class, 'keluargaNewSubmit']);
		Route::get('/staf/kependudukan/keluarga/edit-keluarga/{helper_penduduk_keluarga:no_kk}', [KeluargaController::class, 'keluargaEdit']);
		Route::put('/staf/kependudukan/keluarga/edit-keluarga/{helper_penduduk_keluarga:no_kk}', [KeluargaController::class, 'keluargaEditSubmit']);
		Route::delete('/staf/kependudukan/keluarga/{helper_penduduk_keluarga:no_kk}', [KeluargaController::class, 'keluargaDelete']);
		Route::get('/staf/kependudukan/keluarga/daftar-anggota/{helper_penduduk_keluarga:no_kk}', [KeluargaController::class, 'daftarKeluarga']);
		Route::get('/staf/kependudukan/keluarga', [KeluargaController::class, 'keluarga']);
		Route::get('/staf/kependudukan/rtm', [RtmController::class, 'rtm']);
		Route::get('/staf/kependudukan/rtm/new-rtm', [RtmController::class, 'rtmNew']);
		Route::post('/staf/kependudukan/rtm/new-rtm', [RtmController::class, 'rtmNewSubmit']);
		Route::get('/staf/kependudukan/rtm/edit-rtm{helper_penduduk_rtm:no_rtm}', [RtmController::class, 'rtmEdit']);
		Route::put('/staf/kependudukan/rtm/edit-rtm/{helper_penduduk_rtm:no_rtm}', [RtmController::class, 'rtmEditSubmit']);
		Route::delete('/staf/kependudukan/rtm/{helper_penduduk_rtm:no_rtm}', [RtmController::class, 'rtmDelete']);
		Route::get('/staf/kependudukan/rtm/anggota/{helper_penduduk_rtm:no_rtm}', [RtmController::class, 'daftarRtm']);
		Route::get('/staf/kependudukan/keluarga/daftar-anggota/{helper_penduduk_keluarga:no_kk}/new-anggota', [KeluargaController::class, 'daftarKeluargaNew']);
		Route::post('/staf/kependudukan/keluarga/daftar-anggota/{helper_penduduk_keluarga:no_kk}/new-anggota', [KeluargaController::class, 'daftarKeluargaNewSubmit']);
		Route::get('/staf/kependudukan/keluarga/daftar-anggota/edit-hubungan/{penduduk:nik}', [KeluargaController::class, 'hubunganKeluargaEdit']);
		Route::put('/staf/kependudukan/keluarga/daftar-anggota/edit-hubungan/{penduduk:nik}', [KeluargaController::class, 'hubunganKeluargaEditSubmit']);
		Route::delete('/staf/kependudukan/keluarga/daftar-anggota/{helper_penduduk_keluarga:no_kk}', [KeluargaController::class, 'daftarKeluargaDelete']);

		Route::get('/staf/statistik/statistik-kependudukan', [StatistikController::class, 'statistik']);

		Route::get('/staf/kesehatan/posyandu', [KesehatanController::class, 'posyandu']);
		Route::get('/staf/kesehatan/posyandu/new-posyandu', [KesehatanController::class, 'posyanduNew']);
		Route::post('/staf/kesehatan/posyandu/new-posyandu', [KesehatanController::class, 'posyanduNewSubmit']);
		Route::get('/staf/kesehatan/posyandu/edit-posyandu/{id}', [KesehatanController::class, 'posyanduEdit']);
		Route::put('/staf/kesehatan/posyandu/edit-posyandu/{id}', [KesehatanController::class, 'posyanduEditSubmit']);
		Route::delete('staf/kesehatan/posyandu/{id}', [KesehatanController::class, 'posyanduDelete']);
		Route::get('/staf/kesehatan/kia', [KesehatanController::class, 'kia']);
		Route::get('/staf/kesehatan/kia/new-kia', [KesehatanController::class, 'kiaNew']);
		Route::post('staf/kesehatan/kia/new-kia', [KesehatanController::class, 'kiaNewSubmit']);
		Route::get('/staf/kesehatan/kia/edit-kia/{id}', [KesehatanController::class, 'kiaEdit']);
		Route::put('/staf/kesehatan/kia/edit-kia/{id}', [KesehatanController::class, 'kiaEditSubmit']);
		Route::delete('/staf/kesehatan/kia/{id}', [KesehatanController::class, 'kiaDelete']);
		Route::get("/staf/kesehatan/pemantauan", [KesehatanController::class, 'pemantauan']);
		Route::get("/staf/kesehatan/pemantauan/new-pemantauan-ibu", [KesehatanController::class, 'pemantauanIbuNew']);
		Route::post("/staf/kesehatan/pemantauan/new-pemantauan-ibu", [KesehatanController::class, 'pemantauanIbuNewSubmit']);
		Route::get('/staf/kesehatan/pemantauan/edit-pemantauan-ibu/{id}', [KesehatanController::class, 'pemantauanIbuEdit']);
		Route::put('/staf/kesehatan/pemantauan/edit-pemantauan-ibu/{id}', [KesehatanController::class, 'pemantauanIbuEditSubmit']);
		Route::delete('staf/kesehatan/pemantauan/ibu/{id}', [KesehatanController::class, 'pemantauanIbuDelete']);
		Route::get('staf/kesehatan/pemantauan/new-pemantauan-anak', [KesehatanController::class, 'pemantauanAnakNew']);
		Route::post('staf/kesehatan/pemantauan/new-pemantauan-anak', [KesehatanController::class, 'pemantauanAnakNewSubmit']);
		Route::get('staf/kesehatan/pemantauan/edit-pemantauan-anak/{id}', [KesehatanController::class, 'pemantauanAnakEdit']);
		Route::put('staf/kesehatan/pemantauan/edit-pemantauan-anak/{id}', [KesehatanController::class, 'pemantauanAnakEditSubmit']);
		Route::delete('staf/kesehatan/pemantauan/anak/{id}', [KesehatanController::class, 'pemantauanAnakDelete']);
		Route::get('staf/kesehatan/pemantauan/new-sasaran-paud', [KesehatanController::class, 'sasaranPaudNew']);
		Route::post('staf/kesehatan/pemantauan/new-sasaran-paud', [KesehatanController::class, 'sasaranPaudNewSubmit']);
		Route::get('staf/kesehatan/pemantauan/edit-sasaran-paud/{id}', [KesehatanController::class, 'sasaranPaudEdit']);
		Route::put('staf/kesehatan/pemantauan/edit-sasaran-paud/{id}', [KesehatanController::class, 'sasaranPaudEditSubmit']);
		Route::delete('staf/kesehatan/pemantauan/paud/{id}', [KesehatanController::class, 'sasaranPaudDelete']);
    	Route::get('staf/kesehatan/pemantauan/scorecard', [KesehatanController::class, 'scorecard']);

		Route::get('/staf/manajemen-staf/', [StafController::class, 'pohonStaf']);
		Route::get('/staf/manajemen-staf/get-data', [StafController::class, 'getDataStaf']);
		Route::get('/staf/manajemen-staf/daftar-staf', [StafController::class, 'daftarStaf']);
		Route::get('/staf/manajemen-staf/new-staf', [StafController::class, 'stafNew']);
		Route::post('/staf/manajemen-staf/new-staf', [StafController::class, 'stafNewSubmit']);
		Route::get('/staf/manajemen-staf/edit-staf/{id}', [StafController::class, 'stafEdit']);
		Route::put('/staf/manajemen-staf/edit-staf/{id}', [StafController::class, 'stafEditSubmit']);
		Route::delete('/staf/manajemen-staf/{id}', [StafController::class, 'stafDelete']);

		Route::get('/staf/manajemen-web/dashboard', [ArtikelController::class, 'dashboard']);
		Route::get('/staf/manajemen-web/artikel', [ArtikelController::class, 'articleManager']);
		Route::get('/staf/manajemen-web/artikel/new-artikel', [ArtikelController::class, 'artikelNew']);
		Route::post('/staf/manajemen-web/artikel/new-artikel', [ArtikelController::class, 'artikelNewSubmit']);
		Route::get('/staf/manajemen-web/artikel/edit-artikel/{id}', [ArtikelController::class, 'artikelEdit']);
		Route::put('/staf/manajemen-web/artikel/edit-artikel/{id}', [ArtikelController::class, 'artikelEditSubmit']);
		Route::delete('/staf/manajemen-web/artikel/{id}', [ArtikelController::class, 'artikelDelete']);
		Route::post('/staf/manajemen-web/artikel/upload-image', [ArtikelController::class, 'storeImage']);

		Route::get('/staf/manajemen-web/banner', [BannerController::class, 'bannerManager']);
		Route::get('/staf/manajemen-web/banner/new-banner', [BannerController::class, 'bannerNew']);
		Route::post('/staf/manajemen-web/banner/new-banner', [BannerController::class, 'bannerNewSubmit']);
		Route::get('/staf/manajemen-web/banner/edit-banner/{no_urut}', [BannerController::class, 'bannerEdit']);
		Route::put('/staf/manajemen-web/banner/edit-banner/{no_urut}', [BannerController::class, 'bannerEditSubmit']);
		Route::delete('/staf/manajemen-web/banner/{id}', [BannerController::class, 'bannerDelete']);

		Route::get('/staf/manajemen-web/agenda', [AgendaController::class, 'agendaManager']);
		Route::get('/staf/manajemen-web/agenda/new-agenda', [AgendaController::class, 'agendaNew']);
		Route::post('/staf/manajemen-web/agenda/new-agenda', [AgendaController::class, 'agendaNewSubmit']);
		Route::get('/staf/manajemen-web/agenda/edit-agenda/{id}', [AgendaController::class, 'agendaEdit']);
		Route::put('/staf/manajemen-web/agenda/edit-agenda/{id}', [AgendaController::class, 'agendaEditSubmit']);
		Route::delete('/staf/manajemen-web/agenda/{id}', [AgendaController::class, 'agendaDelete']);
		Route::post('/staf/manajemen-web/agenda/upload-image', [AgendaController::class, 'storeImage']);

		Route::get('/staf/manajemen-web/dokumen', [DokumenController::class, 'dokumenManager']);
		Route::get('/staf/manajemen-web/dokumen/new-dokumen', [DokumenController::class, 'dokumenNew']);
		Route::post('/staf/manajemen-web/dokumen/new-dokumen', [DokumenController::class, 'dokumenNewSubmit']);
		Route::get('/staf/manajemen-web/dokumen/edit-dokumen/{id}', [DokumenController::class, 'dokumenEdit']);
		Route::put('/staf/manajemen-web/dokumen/edit-dokumen/{id}', [DokumenController::class, 'dokumenEditSubmit']);
		Route::delete('/staf/manajemen-web/dokumen/{id}', [DokumenController::class, 'dokumenDelete']);
		Route::get('/staf/manajemen-web/dokumen/{dokumen:filename}', [DokumenController::class, 'dokumenDownload']);
		Route::get('/staf/manajemen-web/dokumen/preview/{dokumen:filename}', [DokumenController::class, 'dokumenShow']);

		Route::get('/staf/layanan-surat/buat-surat', [SuratController::class, 'suratNew']);
		Route::get('/staf/layanan-surat/buat-surat/{surat:nama}', [SuratController::class, 'suratNewInput']);
		Route::post('/staf/layanan-surat/buat-surat/{surat:nama}', [SuratController::class, 'suratNewInputSubmit']);
		Route::get('/staf/layanan-surat/arsip-surat', [SuratController::class, 'arsipSurat']);
		Route::get('/staf/layanan-surat/arsip-surat/{arsip:filename}', [SuratController::class, 'suratDownload']);
		Route::get('/staf/layanan-surat/arsip-surat/edit-surat/{id}/{filename}', [SuratController::class, 'suratEdit']);
		Route::put('/staf/layanan-surat/arsip-surat/edit-surat/{id}/{filename}', [SuratController::class, 'suratEditSubmit']);
		Route::delete('/staf/layanan-surat/arsip-surat/{id}/{filename}', [SuratController::class, 'suratDelete']);

		Route::get('/staf/buku-administrasi-desa/administrasi-umum', [BukuController::class, 'kependudukan']);
		Route::get('/staf/buku-administrasi-desa/administrasi-penduduk', [BukuController::class, 'bukuIndukKependudukan']);
		Route::get('/staf/buku-administrasi-desa/get-data/{type}', [BukuController::class, 'getData'])->name('buku.getData');
		Route::post('/staf/buku-administrasi-desa/export/{type}/{month}/{year}', [BukuExportController::class, 'bukuExport'])->name('buku.export');

		Route::get('/staf/info-desa/identitas-desa', [InfoDesaController::class, 'showDataDesa'])->name('desa.data');
		Route::get('/staf/info-desa/identitas-desa/edit', [InfoDesaController::class, 'editDataDesa'])->name('desa.edit');
		Route::put('/staf/info-desa/identitas-desa/update', [InfoDesaController::class, 'updateDataDesa'])->name('desa.update');
		Route::get('/staf/info-desa/identitas-desa/kantor', [InfoDesaController::class, 'showLokasiKantor'])->name('desa.kantorDesa');
		Route::get('/staf/info-desa/identitas-desa/kantor/edit', [InfoDesaController::class, 'editLokasiKantor']);
		Route::put('/staf/info-desa/identitas-desa/kantor/update', [InfoDesaController::class, 'updateLokasiKantor']);
		Route::get('/staf/info-desa/identitas-desa/wilayah', [InfoDesaController::class, 'showPetaWilayah'])->name('desa.petaWilayah');
		Route::get('/staf/info-desa/identitas-desa/wilayah/edit', [InfoDesaController::class, 'editPetaWilayah']);
		Route::put('/staf/info-desa/identitas-desa/wilayah/update', [InfoDesaController::class, 'updatePetaWilayah']);

		Route::get('/staf/info-desa/dusun', [InfoDesaController::class, 'dusunManager']);
		Route::get('/staf/info-desa/dusun/new-dusun', [InfoDesaController::class, 'dusunNew']);
		Route::post('/staf/info-desa/dusun/new-dusun', [InfoDesaController::class, 'dusunNewSubmit']);
		Route::get('/staf/info-desa/dusun/edit-dusun/{helper_dusun:id}', [InfoDesaController::class, 'dusunEdit']);
		Route::put('/staf/info-desa/dusun/edit-dusun/{helper_dusun:id}', [InfoDesaController::class, 'dusunEditSubmit']);
		Route::delete('/staf/info-desa/dusun/{helper_dusun:id}', [InfoDesaController::class, 'dusunDelete']);
		Route::get('/staf/info-desa/rt/{wilayah_dusun:id}', [InfoDesaController::class, 'rtManager']);
		Route::get('/staf/info-desa/rt/new-rt/{wilayah_dusun:id}', [InfoDesaController::class, 'rtNew']);
		Route::post('/staf/info-desa/rt/new-rt/{id_wilayah_dusun}', [InfoDesaController::class, 'rtNewSubmit']);
		Route::get('/staf/info-desa/rt/edit-rt/{helper_rt:id}', [InfoDesaController::class, 'rtEdit']);
		Route::put('/staf/info-desa/rt/edit-dusun/{helper_rt:id}', [InfoDesaController::class, 'rtEditSubmit']);
		Route::delete('/staf/info-desa/rt/{id_wilayah_dusun}/{helper_rt:id}', [InfoDesaController::class, 'rtDelete']);
		Route::get('/staf/info-desa/rt/get-data/{idDusun}', [InfoDesaController::class, 'getRtData']);
	// });
});
