<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\JadwalPiketController;
use App\Http\Controllers\Admin\PersonelController;

// Home route
Route::get('/', function () {
    return redirect()->route('dashboard');
})->name('home');

// Authentication routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/admin-login', [AuthController::class, 'showAdminLogin'])->name('admin-login');
    Route::post('/admin-login', [AuthController::class, 'adminLogin'])->name('admin-login.post');
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// User dashboard routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/jadwal/{jadwalPiket}', [DashboardController::class, 'show'])->name('jadwal.show');
});

// Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Jadwal Piket routes
    Route::resource('jadwal-piket', JadwalPiketController::class);
    Route::get('/jadwal-piket/bulk/create', [JadwalPiketController::class, 'bulkCreate'])->name('jadwal-piket.bulk-create');
    Route::post('/jadwal-piket/bulk', [JadwalPiketController::class, 'bulkStore'])->name('jadwal-piket.bulk-store');

    // Personel routes
    Route::resource('personel', PersonelController::class);
});

