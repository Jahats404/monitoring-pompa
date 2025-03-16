<?php

use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\dashboard\DashboardController;
use App\Http\Controllers\lokasi\AdminLokasiController;
use App\Http\Controllers\pompa\AdminPompaController;
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
        
    });

    Route::prefix('admin')->name('admin.')->middleware('CekUserLogin:2')->group(function () {
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
    });
    

    Route::prefix('pertamina')->name('pertamina.')->middleware('CekUserLogin:3')->group(function () {

    });

});