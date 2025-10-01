<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AhpSawController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('dashboard');
});

Route::get('/hitungtarif', function () {
    return view('hitungtarif');
});

// Debug route
Route::get('/debug-ahp', function () {
    $kota = App\Models\Kota::all();
    return response()->json(['kota_count' => $kota->count(), 'kota' => $kota]);
});

// Test route
Route::get('/test-ahp', function () {
    $kota = App\Models\Kota::all();
    return view('ahp-saw.test', compact('kota'));
});

// Routes untuk sistem AHP & SAW
Route::prefix('ahp-saw')->name('ahp-saw.')->group(function () {
    Route::get('/', [AhpSawController::class, 'index'])->name('index');
    Route::get('/create', [AhpSawController::class, 'create'])->name('create');
    Route::post('/store', [AhpSawController::class, 'store'])->name('store');
    Route::get('/matriks', [AhpSawController::class, 'matriks'])->name('matriks');
    Route::get('/perhitungan', [AhpSawController::class, 'perhitungan'])->name('perhitungan');
    Route::post('/hitung', [AhpSawController::class, 'hitung'])->name('hitung');
    Route::get('/hasil', [AhpSawController::class, 'hasil'])->name('hasil');
    Route::get('/perbandingan', [AhpSawController::class, 'perbandingan'])->name('perbandingan');
    Route::post('/bandingkan', [AhpSawController::class, 'bandingkan'])->name('bandingkan');
    Route::get('/hitung-tarif', [AhpSawController::class, 'hitungTarif'])->name('hitung-tarif');
});

// Routes untuk Authentication
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Routes untuk Admin Panel (dilindungi middleware)
Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/hasil', [AdminController::class, 'hasil'])->name('hasil');
    Route::get('/perbandingan', [AdminController::class, 'perbandingan'])->name('perbandingan');
    Route::post('/reset-perhitungan', [AdminController::class, 'resetPerhitungan'])->name('reset-perhitungan');
    
    // Routes untuk kelola kota
    Route::prefix('kota')->name('kota.')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('index');
        Route::get('/create', [AdminController::class, 'create'])->name('create');
        Route::post('/store', [AdminController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [AdminController::class, 'edit'])->name('edit');
        Route::put('/{id}', [AdminController::class, 'update'])->name('update');
        Route::delete('/{id}', [AdminController::class, 'destroy'])->name('destroy');
    });
});