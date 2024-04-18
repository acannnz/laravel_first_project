<?php

use App\Models\User;
use App\Models\Admin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SesiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TugasController;
use App\Http\Controllers\TugasUserController;
use App\Models\DataUser;
use App\Models\Tugas;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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


Route::middleware(['guest'])->group(function () {
    Route::get('/', [SesiController::class, 'index'])->name('login');
    Route::post('/', [SesiController::class, 'login']);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [SesiController::class, 'logout']);

    Route::middleware('userAkses:admin')->group(function () {
        Route::get('/admin', [AdminController::class, 'index']);
        Route::get('/home', [DashboardController::class, 'index']);
        Route::get('/admin/{id}/tambahProfil', [AdminController::class, 'tambahProfil']);
        Route::post('/admin/{id}/tambahProfil', [AdminController::class, 'fungsiTambahProfil']);
        Route::resource('admin', AdminController::class);
        Route::get('/classroom/{id}/tampilanJawabanFile', [TugasController::class, 'cekFile']);
    });
    Route::middleware('userAkses:user')->group(function () {
        Route::get('/user', [UserController::class, 'index']);
        Route::resource('user', UserController::class);
        Route::get('/userClassroom', [TugasUserController::class, 'tampilanUserClassroom']);
        Route::get('/userClassroom/{id}/formJawaban', [TugasUserController::class, 'tampilanJawabClassroom']);
        Route::post('/userClassroom/{id}/formJawaban', [TugasUserController::class, 'fungsiJawabClassroom']);
        Route::get('/userClassroom/{id}/tampilanJawabanFile', [TugasUserController::class, 'cekFile']);
        Route::get('/userClassroom/tampilanJawaban', [TugasUserController::class, 'cekJawaban']);
    });
    Route::get('/classroom', [TugasController::class, 'index']);
    Route::resource('classroom', TugasController::class);
    Route::get('/classroom/{id}/tambahTugas', [TugasController::class, 'tambahTugasForm']);
    Route::post('/classroom/{id}/tambahTugas', [TugasController::class, 'fungsitambahTugas']);
    Route::get('/classroom/{id}/detailTugas', [TugasController::class, 'daftarTugas']);
    Route::get('/classroom/{id}/tampilanJawaban', [TugasController::class, 'daftarJawaban']);
});
