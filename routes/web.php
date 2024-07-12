<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\DashController as AdminDashController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware(['admin'])->group(function () {
    Route::get('dashboard-admin', [AdminDashController::class, 'index'])->name('admin');
    Route::get('dashboard-admin/mahasiswa', [AdminDashController::class, 'indexMahasiswa'])->name('indexMahasiswa');
    Route::post('dashboard-admin/mahasiswa/tambah', [AdminDashController::class, 'storeMahasiswa'])->name('StoreMahasiswa');
    Route::post('dashboard-admin/mahasiswa/{id}/update', [AdminDashController::class, 'updateMahasiswa'])->name('UpdateMahasiswa');
    // Route::delete('dashboard-admin/mahasiswa/delete/{id}', [AdminDashController::class, 'deleteMahasiswa'])->name('DeleteMahasiswa');
    Route::get('dashboard-admin/tenaga-kependidikan', [AdminDashController::class, 'indexTendik'])->name('indexTendik');
    Route::post('dashboard-admin/tenaga-kependidikan/tambah', [AdminDashController::class, 'storeTendik'])->name('StoreTendik');
    Route::put('dashboard-admin/tenaga-kependidikan/{id}/update', [AdminDashController::class, 'updateTendik'])->name('UpdateTendik');
    Route::delete('dashboard-admin/tenaga-kependidikan/delete/{id}', [AdminDashController::class, 'deleteTendik'])->name('DeleteTendik');
    // Route::get('dashboard-admin/profile/{id}', [AdminDashController::class, 'profile'])->name('ProfileAdmin');
    // Route::post('dashboard-admin/profile/{id}', [AdminDashController::class, 'updateProfile'])->name('UpdateProfileAdmin');
});
