<?php

use App\Http\Controllers\User;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\Employee;
use App\Http\Controllers\CadreDevelopment;
use App\Http\Controllers\Assignment;
use App\Http\Controllers\Login;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\NoteDataTable;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => 'revalidate'], function () {
    
    Route::get('/', [Login::class, 'index'])->name('login');
    Route::post('/login', [Login::class, 'loginProcess']);
    Route::get('/logout', [Login::class, 'logout'])->name('logout');
    Route::get('/lupa-password', [Login::class, 'forgotPassword']);
    Route::post('/lupa-password', [Login::class, 'forgotPassword']);
    Route::get('/reset-password/{id}', [Login::class, 'resetPassword']);
    Route::post('/reset-password/{id}', [Login::class, 'resetPassword']);

    Route::get('/dashboard', [Dashboard::class, 'index'])->name('dashboard');

    Route::get('/profil', [User::class, 'profil'])->name('profil');
    Route::post('/profil/{id}', [User::class, 'profil']);
    Route::get('/ubah-password', [User::class, 'changePassword'])->name('ubah-password');
    Route::post('/ubah-password/{id}', [User::class, 'changePassword']);
    
    Route::get('/data-pengguna', [User::class, 'index'])->name('data-pengguna');
    Route::get('/detail-pengguna/{id}', [User::class, 'detail'])->name('detail-pengguna');
    Route::get('/tambah-pengguna', [User::class, 'new'])->name('tambah-pengguna');
    Route::post('/tambah-pengguna', [User::class, 'new']);
    Route::get('/edit-pengguna/{id}', [User::class, 'update'])->name('edit-pengguna');
    Route::post('/edit-pengguna/{id}', [User::class, 'update']);
    Route::get('/hapus-pengguna/{id}', [User::class, 'delete']);

    Route::get('/data-karyawan', [Employee::class, 'index'])->name('data-karyawan');
    Route::get('/detail-karyawan/{id}', [Employee::class, 'detail'])->name('detail-karyawan');
    Route::get('/tambah-karyawan', [Employee::class, 'new'])->name('tambah-karyawan');
    Route::post('/tambah-karyawan', [Employee::class, 'new']);
    Route::get('/edit-karyawan/{id}', [Employee::class, 'update'])->name('edit-karyawan');
    Route::post('/edit-karyawan/{id}', [Employee::class, 'update']);
    Route::get('/hapus-karyawan/{id}', [Employee::class, 'delete']);

    Route::get('/data-kaderisasi', [CadreDevelopment::class, 'index'])->name('data-kaderisasi');
    Route::get('/detail-kaderisasi/{id}', [CadreDevelopment::class, 'detail'])->name('detail-kaderisasi');
    Route::get('/tambah-kaderisasi', [CadreDevelopment::class, 'new'])->name('tambah-kaderisasi');
    Route::post('/tambah-kaderisasi', [CadreDevelopment::class, 'new']);
    Route::get('/edit-kaderisasi/{id}', [CadreDevelopment::class, 'update'])->name('edit-kaderisasi');
    Route::post('/edit-kaderisasi/{id}', [CadreDevelopment::class, 'update']);
    Route::get('/hapus-kaderisasi/{id}', [CadreDevelopment::class, 'delete']);

    Route::get('/data-penugasan', [Assignment::class, 'index'])->name('data-penugasan');
    Route::get('/detail-penugasan/{id}', [Assignment::class, 'detail'])->name('detail-penugasan');
    Route::get('/tambah-penugasan', [Assignment::class, 'new'])->name('tambah-penugasan');
    Route::post('/tambah-penugasan', [Assignment::class, 'new']);
    Route::get('/edit-penugasan/{id}', [Assignment::class, 'update'])->name('edit-penugasan');
    Route::post('/edit-penugasan/{id}', [Assignment::class, 'update']);
    Route::get('/hapus-penugasan/{id}', [Assignment::class, 'delete']);

    // Route::get('/pengguna', [User::class, 'user'])->name('pengguna');
    // Route::get('/pengguna/json', [User::class, 'json'])->name('pengguna-json');
    // Route::get('/data-pengguna', [User::class, 'user'])->name('data-pengguna');
    // Route::get('/data-pengguna/json', [User::class, 'data'])->name('data-pengguna-json');
    
    Route::group(['middleware' => 'hrd'], function () {
        
    });

    Route::group(['middleware' => 'manager'], function () {
        
    });

    Route::group(['middleware' => 'pelamar'], function () {

    });
    
});
