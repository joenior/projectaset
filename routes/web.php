<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LabelController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\GrafikController;
use App\Http\Controllers\SatuanController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\DataUserController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KeuanganController;
use App\Http\Controllers\PengadaanController;
use App\Http\Controllers\PenghapusanAsetController;
use App\Http\Controllers\StatistikController;
use App\Http\Controllers\StatusPengadaanController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\GedungController;
use App\Http\Controllers\LantaiController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\SubkategoriController;
use App\Http\Controllers\SubdivisiController;
use App\Http\Controllers\PemindahanController;

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


Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/home', [GrafikController::class, 'index']);

Route::resource('/barang', BarangController::class);
Route::resource('/kategori', KategoriController::class);
Route::resource('/gedung', GedungController::class);
Route::resource('/lantai', LantaiController::class);
Route::resource('/ruangan', RuanganController::class);
Route::resource('/satuan', SatuanController::class);
Route::resource('/subkategori', SubkategoriController::class);
Route::resource('/subdivisi', SubdivisiController::class);

Route::resource('/laporan', LaporanController::class);
Route::get('cetak', [LaporanController::class, 'cetak'])->name('cetak');
Route::get('/statistik', [StatistikController::class, 'index']);
Route::get('/label', [LabelController::class, 'index']);
Route::get('/keuangan/laporan-keuangan', [KeuanganController::class, 'cetakLaporanKeuangan']);
Route::resource('/keuangan', KeuanganController::class);

Route::resource('/penghapusan-aset', PenghapusanAsetController::class);
Route::put('/penghapusan-aset/restore/{id}', [PenghapusanAsetController::class, 'restore']);

Route::get('/reset-password', [ResetPasswordController::class, 'index']);
Route::put('/reset-password', [ResetPasswordController::class, 'resetPassword']);
Route::get('barang/label/{id}', [BarangController::class, 'cetakLabel']);

Route::middleware(['auth'])->group(function(){
    Route::resource('/permintaan', StatusPengadaanController::class);
    Route::resource('/datauser', DataUserController::class);
    Route::resource('/pengadaan', PengadaanController::class);
    Route::resource('/gedung', GedungController::class);
    Route::resource('/lantai', LantaiController::class);
    Route::resource('/ruangan', RuanganController::class);
});

Route::middleware(['auth', 'role:admin,unit'])->group(function(){
    Route::get('/laporan', [LaporanController::class, 'index']);
    Route::get('/laporan/cetak', [LaporanController::class, 'cetak']);
});

Route::middleware(['auth', 'role:admin,yayasan,unit'])->group(function(){
    Route::resource('/barang', BarangController::class);
});
Route::group(['middleware' => ['auth', 'role:admin']], function(){
    Route::resource('/datauser', DataUserController::class);
    Route::get('permintaan/laporan-pengadaan/{id}', [StatusPengadaanController::class, 'cetakPengadaanBarang']);
});

Route::get('/pemindahan', [PemindahanController::class, 'index'])->name('pemindahan.index');
Route::get('/pemindahan/create/{id}', [PemindahanController::class, 'create'])->name('pemindahan.create');
Route::post('/pemindahan/store/{id}', [PemindahanController::class, 'store'])->name('pemindahan.store');
Route::delete('/pemindahan/{id}', [PemindahanController::class, 'destroy'])->name('pemindahan.destroy');

Route::group(['middleware' => ['auth', 'role:yayasan']], function(){
    Route::put('/permintaan/{id}/setuju', [StatusPengadaanController::class, 'setPersetujuan'])->name('permintaan.setuju');
    Route::put('/permintaan/{id}/tolak', [StatusPengadaanController::class, 'setPenolakan'])->name('permintaan.tolak');
});

Route::group(['middleware' => ['auth', 'role:yayasan']], function () {
    Route::get('/permintaan/create', [StatusPengadaanController::class, 'create']);
    Route::post('/permintaan', [StatusPengadaanController::class, 'store']);
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/pengadaan-disetujui', [PengadaanController::class, 'approved'])->name('pengadaan.approved');
});

Route::post('/barang/from-pengadaan/{id}', [BarangController::class, 'storeFromPengadaan'])->name('barang.storeFromPengadaan');

Route::delete('/satuan/{satuan}', [SatuanController::class, 'destroy'])->name('satuan.destroy');

Route::get('/api/subdivisi/{subkategori_id}', [SubdivisiController::class, 'getSubdivisiBySubkategori']);

Route::delete('/barang/bulk-delete', [BarangController::class, 'bulkDelete'])->name('barang.bulkDelete');

Route::get('/api/lantai/{gedung_id}', [LantaiController::class, 'getLantaiByGedung']);

Route::get('/barang/{id}/calculate-depreciation', [BarangController::class, 'calculateDepreciation'])->name('barang.calculateDepreciation');

Route::get('/pemindahan/{id}', [PemindahanController::class, 'show'])->name('pemindahan.show');