<?php

use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\dashboard\DashboardController;
use App\Http\Controllers\lokasi\AdminLokasiController;
use App\Http\Controllers\pemeliharaan\AdminPemeliharaanController;
use App\Http\Controllers\pemeriksaan\AdminPemeriksaanController;
use App\Http\Controllers\pompa\AdminPompaController;
use App\Http\Controllers\standar\AdminStandarController;
use App\Http\Controllers\unit_pompa\AdminUnitPompaController;
use App\Http\Controllers\user\AdminUserController;
use Illuminate\Support\Facades\Route;

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
Route::get('/dashboard-admin', function () {
    return view('dashboard.dashboard-admin');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/', [AuthController::class,'login'])->name('login');
Route::post('/authenticate', [AuthController::class,'authenticate'])->name('authenticate');
Route::post('/logout', [AuthController::class,'logout'])->name('logout');


Route::middleware(['auth'])->group(function () {
    
    
    Route::prefix('teknisi')->name('teknisi.')->middleware('CekUserLogin:1')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'dashboardTeknisi'])->name('dashboard');
    });

    Route::prefix('adm')->name('admin.')->middleware('CekUserLogin:1,2,3')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'dashboardAdmin'])->name('dashboard');
        
        // PENGGUNA
        Route::get('/user',[AdminUserController::class,'index'])->name('user');
        Route::post('/user/store',[AdminUserController::class,'store'])->name('store.user');
        Route::put('/user/update/{id}',[AdminUserController::class,'update'])->name('update.user');
        Route::delete('/user/delete/{id}',[AdminUserController::class,'delete'])->name('delete.user');
        
        // LOKASI
        Route::get('/lokasi',[AdminLokasiController::class,'index'])->name('lokasi');
        Route::post('/lokasi/store',[AdminLokasiController::class,'store'])->name('store.lokasi');
        Route::put('/lokasi/update/{id}',[AdminLokasiController::class,'update'])->name('update.lokasi');
        Route::delete('/lokasi/delete/{id}',[AdminLokasiController::class,'delete'])->name('delete.lokasi');

        // POMPA
        Route::get('/pompa',[AdminPompaController::class,'index'])->name('pompa');
        Route::get('/pompa-payloads',[AdminPompaController::class,'payload'])->name('payload.pompa');
        Route::get('/pompa-payloads/detail/{id}',[AdminPompaController::class,'detail_pompa'])->name('payload.pompa.detail');
        Route::post('/pompa-payloads/store',[AdminPompaController::class,'store'])->name('store.pompa');
        Route::put('/pompa-payloads/update/{id}',[AdminPompaController::class,'update'])->name('payload.pompa.update');
        Route::delete('/pompa-payloads/delete/{id}',[AdminPompaController::class,'delete'])->name('payload.pompa.delete');
        Route::put('/pompa-payloads/uplaod-dokumentasi/{id}',[AdminPompaController::class,'dokumentasiPompa'])->name('payload.pompa.dokumentasi');

        // UNIT POMPA
        Route::get('/unit-pompa',[AdminUnitPompaController::class,'index'])->name('unitpompa');
        Route::post('/unit-pompa/store',[AdminUnitPompaController::class,'store'])->name('store.unitpompa');
        Route::put('/unit-pompa/update/{id}',[AdminUnitPompaController::class,'update'])->name('update.unitpompa');
        Route::delete('/unit-pompa/delete/{id}',[AdminUnitPompaController::class,'delete'])->name('delete.unitpompa');

        // PEMERIKSAAN
        // LOKASI
        Route::get('/list-lokasi',[AdminPemeriksaanController::class,'lokasi'])->name('list.lokasi');
        Route::get('/list-pompa/{id}',[AdminPemeriksaanController::class,'listPompaPerLokasi'])->name('list.pompa');
        Route::get('/pemeriksaan-pompa/{id}/{tanggal}',[AdminPemeriksaanController::class,'pemeriksaan'])->name('pemeriksaan');
        Route::get('/export-pemeriksaan',[AdminPemeriksaanController::class,'exportBulananPDF'])->name('export.pemeriksaan');

        Route::post('/store/pemeriksaan/main-pump',[AdminPemeriksaanController::class,'storePemeriksaanMainPump'])->name('store.pemeriksaan.mainpump');
        Route::post('/store/pemeriksaan/charging-pump',[AdminPemeriksaanController::class,'storePemeriksaanChargingPump'])->name('store.pemeriksaan.chargingpump');

        //PEMELIHARAAN
        Route::get('/pemeliharaan-pompa/{id}/{tanggal}',[AdminPemeliharaanController::class,'index'])->name('pemeliharaan');
        Route::post('/store/pemeliharaan',[AdminPemeliharaanController::class,'storePemeliharaan'])->name('store.pemeliharaan');
        Route::get('/export/pemeliharaan/{id}',[AdminPemeliharaanController::class,'exportExcel'])->name('export.pemeliharaan');
        Route::put('/dokumentasi/pemeliharaan/{id}',[AdminPemeliharaanController::class,'dokumentasiPemeliharaan'])->name('dokumentasi.pemeliharaan');

        //STANDAR
        Route::get('/daftar-standar',[AdminStandarController::class,'index'])->name('standar');
        Route::get('/standar/main-pump',[AdminStandarController::class,'standarMainPump'])->name('standar.mainpump');
        Route::post('/action/standar-mainpump',[AdminStandarController::class,'storeStandarMainPump'])->name('store.standar.mainpump');
        
        Route::get('/standar/charging-pump',[AdminStandarController::class,'standarChargingPump'])->name('standar.chargingpump');
        Route::post('/action/standar-chargingpump',[AdminStandarController::class,'storeStandarChargingPump'])->name('store.standar.chargingpump');
    });
    

    Route::prefix('pertamina')->name('pertamina.')->middleware('CekUserLogin:3')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'dashboardPertamina'])->name('dashboard');
    });

});