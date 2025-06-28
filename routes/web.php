<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PengawasController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\ChinningController;
use App\Http\Controllers\PullupController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AtletController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FirebaseController;


// Login routes
Route::get('/', function () {
    return view('home');
})->name('home');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/chinup', [ChinningController::class, 'index'])->name('chinning');

// Route::get('/', [BerandaController::class, 'index']);
Route::post('/pengawas/analyze', [PengawasController::class, 'analyze'])->name('pengawas.analyze');
Route::post('/atur-dominasi', [ChinningController::class, 'aturDominasi'])->name('atur-dominasi');
Route::get('/pullup', [PullupController::class, 'index'])->name('pullup.index');
Route::post('/pullup/dominasi', [PullupController::class, 'aturDominasi'])->name('pullup.aturDominasi');
    

Route::post('/jadwal/store', [ScheduleController::class, 'store'])->name('jadwal.store');


// Role: Admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    
    Route::post('/store-user', [AdminController::class, 'storeUser'])->name('storeUser');
    Route::get('/tambah-pengawas', [AdminController::class, 'tambahPengawas'])->name('tambahPengawas');
    Route::get('/jadwal-pengawas', [AdminController::class, 'jadwalPengawas'])->name('jadwalPengawas');
    Route::get('/jadwal-atlet', [AdminController::class, 'jadwalAtlet'])->name('jadwalAtlet');
    Route::get('/tambah-atlet', [AdminController::class, 'tambahAtlet'])->name('tambahAtlet');
    // USER
    Route::get('/daftar-user', [AdminController::class, 'daftarUser'])->name('daftarUser');
    Route::get('/tambah-user', [AdminController::class, 'tambahUser'])->name('tambahUser');
    Route::get('/user/{id}/edit', [AdminController::class, 'editUser'])->name('editUser');
    Route::put('/user/{id}', [AdminController::class, 'updateUser'])->name('updateUser');
    Route::delete('/user/{id}', [AdminController::class, 'destroyUser'])->name('destroyUser');



    // JADWAL
    Route::get('/jadwal/{id}/edit', [AdminController::class, 'editJadwal'])->name('editJadwal');
    Route::put('/jadwal/{id}', [AdminController::class, 'updateJadwal'])->name('updateJadwal');
    Route::delete('/jadwal/{id}', [AdminController::class, 'destroyJadwal'])->name('destroyJadwal');
    Route::get('/jadwal/create/{type}', [ScheduleController::class, 'create'])->name('jadwal.create');
    Route::get('/jadwal-gabungan', [ScheduleController::class, 'jadwalGabungan'])->name('jadwalGabungan');




    // route jadwal.store sudah ada
});


// Role: Pengawas
Route::middleware(['auth', 'role:pengawas'])->group(function () {
    // Route::get('/pengawas/dashboard', [PengawasController::class, 'index'])->name('pengawas.dashboard');
    Route::get('/pengawas', [PengawasController::class, 'index'])->name('pengawas.index');


    Route::get('/pengawas/jenis-latihan', [PengawasController::class, 'showJenisLatihan'])->name('pengawas.jenisLatihan');
    Route::get('/pengawas/input-parameter', [PengawasController::class, 'showInputParameter'])->name('pengawas.inputParameter');
    Route::post('/pengawas/analyze', [PengawasController::class, 'analyze'])->name('pengawas.analyze');

    Route::get('/firebase/data', [FirebaseController::class, 'showData']);
    Route::get('/chinup', [PengawasController::class, 'chinupDashboard'])->name('chinup.dashboard');
    Route::post('/firebase/reset', [PengawasController::class, 'resetTimer']);
    Route::get('/pengawas/history-monitoring', [PengawasController::class, 'historyMonitoring'])->name('pengawas.historyMonitoring');
    Route::get('/jadwal-latihan', [PengawasController::class, 'viewJadwal'])->name('jadwal.index');
});

// Role: Atlet
Route::middleware(['auth', 'role:atlet'])->group(function () {
    Route::get('/atlet/dashboard', [AtletController::class, 'index'])->name('atlet.dashboard');
});

//Role: Firebase
// Route::get('/monitoring', [FirebaseController::class, 'showData']);
