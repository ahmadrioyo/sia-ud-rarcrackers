<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AkuntanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OwnerController;
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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/main', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

// login 
Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/login-proses', [LoginController::class, 'login'])->name('login-proses');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// admin 
Route::group(['prefix' => 'admin', 'middleware'=>['auth','permission:view_admin'], 'as' => 'admin.'], function(){
    Route::get('/user', [AdminController::class, 'user'])->name('user');
    Route::post('/store', [AdminController::class, 'store'])->name('user.store');
    Route::get('/edit/{id}', [AdminController::class, 'edit'])->name('user.edit');
    Route::put('/update/{id}', [AdminController::class, 'update'])->name('user.update');
    Route::delete('/delete/{id}', [AdminController::class, 'delete'])->name('user.delete');
});

// akuntan 
Route::group(['prefix' => 'akuntan', 'middleware'=>['auth','permission:view_akuntan'], 'as' => 'akuntan.'], function(){
    Route::get('/', [AkuntanController::class, 'index'])->name('index');

    // transaksi
    Route::get('/transaksi', [AkuntanController::class, 'transaksi'])->name('transaksi');
    Route::post('/store/transaksi', [AkuntanController::class, 'storeTransaksi'])->name('transaksi.store');
    Route::put('/update/transaksi/{id}', [AkuntanController::class, 'updatetransaksi'])->name('transaksi.update');
    Route::delete('/delete/transaksi/{id}', [AkuntanController::class, 'deletetransaksi'])->name('transaksi.delete');

    // data akun    
    Route::get('/akun', [AkuntanController::class, 'akun'])->name('akun');
    Route::post('/store/akun', [AkuntanController::class, 'storeAkun'])->name('akun.store');
    Route::put('/update/akun/{id}', [AkuntanController::class, 'updateAkun'])->name('akun.update');
    Route::delete('/delete/akun/{id}', [AkuntanController::class, 'deleteakun'])->name('akun.delete');
    
    Route::get('/kelompok', [AkuntanController::class, 'kelompok'])->name('kelompok');
    Route::post('/store/kelompok', [AkuntanController::class, 'storekelompok'])->name('kelompok.store'); 
    Route::put('/update/kelompok/{id}', [AkuntanController::class, 'updatekelompok'])->name('kelompok.update');
    Route::delete('/delete/kelompok/{id}', [AkuntanController::class, 'deletekelompok'])->name('kelompok.delete');

    Route::get('/tipe', [AkuntanController::class, 'tipe'])->name('tipe');
    Route::post('/store/tipe', [AkuntanController::class, 'storeTipe'])->name('tipe.store'); 
    Route::put('/update/tipe/{id}', [AkuntanController::class, 'updatetipe'])->name('tipe.update');
    Route::delete('/delete/tipe/{id}', [AkuntanController::class, 'deletetipe'])->name('tipe.delete');

    // jurnal
    Route::get('/jurnal', [AkuntanController::class, 'jurnal'])->name('jurnal');
    Route::get('/tambah/jurnal', [AkuntanController::class, 'tambahjurnal'])->name('jurnal.tambah'); 
    Route::post('/store/jurnal', [AkuntanController::class, 'storejurnal'])->name('jurnal.store'); 
    Route::get('/jurnal/search', [AkuntanController::class, 'search'])->name('jurnal.search');
    Route::get('/edit/jurnal/{id}', [AkuntanController::class, 'editjurnal'])->name('jurnal.edit');
    Route::put('/update/jurnal/{id}', [AkuntanController::class, 'updateJurnal'])->name('jurnal.update');
    Route::delete('/delete/jurnal{id}', [AkuntanController::class, 'deletejurnal'])->name('jurnal.delete');

    // buku besar 
    Route::get('/buku-besar', [AkuntanController::class, 'bukubesar'])->name('buku-besar');
    // laba rugi 
    Route::get('/laba-rugi', [AkuntanController::class, 'labaRugi'])->name('laba-rugi');
    // perubahan modal 
    Route::get('/perubahan-modal', [AkuntanController::class, 'perubahanmodal'])->name('perubahan-modal');
    // arus kas
    Route::get('/arus-kas', [AkuntanController::class, 'aruskas'])->name('arus-kas');
    // neraca keuangan
    Route::get('/neraca-keuangan', [AkuntanController::class, 'neracakeuangan'])->name('neraca-keuangan');
});

// owner 
Route::group(['prefix' => 'owner', 'middleware'=>['auth','permission:view_owner'], 'as' => 'owner.'], function(){
    Route::get('/', [OwnerController::class, 'index'])->name('index');
    // Riwayat transaksi
    Route::get('/transaksi', [OwnerController::class, 'transaksi'])->name('transaksi');
    // jurnal
    Route::get('/jurnal', [OwnerController::class, 'jurnal'])->name('jurnal');
    Route::get('/jurnal/search', [OwnerController::class, 'search'])->name('jurnal.search');
    // buku besar 
    Route::get('/buku-besar', [OwnerController::class, 'bukubesar'])->name('buku-besar');
    // laba rugi
    Route::get('/laba-rugi', [OwnerController::class, 'labarugi'])->name('laba-rugi');
    // perubahan modal 
    Route::get('/perubahan-modal', [OwnerController::class, 'perubahanmodal'])->name('perubahan-modal');
    // arus kas
    Route::get('/arus-kas', [OwnerController::class, 'aruskas'])->name('arus-kas');
    // neraca keuangan
    Route::get('/neraca-keuangan', [OwnerController::class, 'neracakeuangan'])->name('neraca-keuangan');
});