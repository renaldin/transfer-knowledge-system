<?php

use App\Http\Controllers\User;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\Login;
use App\Http\Controllers\Klien;
use App\Http\Controllers\Note;
use App\Http\Controllers\Project;
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
    Route::post('/edit-profil/{id}', [User::class, 'profil']);
    Route::get('/ubah-password', [User::class, 'changePassword'])->name('ubah-password');
    Route::post('/ubah-password/{id}', [User::class, 'changePassword']);
    
    Route::get('/daftar-pengguna', [User::class, 'index'])->name('daftar-pengguna');
    Route::get('/detail-pengguna/{id}', [User::class, 'detail'])->name('detail-pengguna');
    Route::get('/tambah-pengguna', [User::class, 'new'])->name('tambah-pengguna');
    Route::post('/tambah-pengguna', [User::class, 'new']);
    Route::get('/edit-pengguna/{id}', [User::class, 'update'])->name('edit-pengguna');
    Route::post('/edit-pengguna/{id}', [User::class, 'update']);
    Route::get('/hapus-pengguna/{id}', [User::class, 'delete']);

    Route::get('/daftar-klien', [Klien::class, 'index'])->name('daftar-klien');
    Route::get('/detail-klien/{id}', [Klien::class, 'detail'])->name('detail-klien');
    Route::get('/tambah-klien', [Klien::class, 'new'])->name('tambah-klien');
    Route::post('/tambah-klien', [Klien::class, 'new']);
    Route::get('/edit-klien/{id}', [Klien::class, 'update'])->name('edit-klien');
    Route::post('/edit-klien/{id}', [Klien::class, 'update']);
    Route::get('/hapus-klien/{id}', [Klien::class, 'delete']);

    Route::get('/daftar-proyek', [Project::class, 'index'])->name('daftar-proyek');
    Route::get('/detail-proyek/{id}', [Project::class, 'detail'])->name('detail-proyek');
    Route::get('/tambah-proyek', [Project::class, 'new'])->name('tambah-proyek');
    Route::post('/tambah-proyek', [Project::class, 'new']);
    Route::get('/edit-proyek/{id}', [Project::class, 'update'])->name('edit-proyek');
    Route::post('/edit-proyek/{id}', [Project::class, 'update']);
    Route::get('/hapus-proyek/{id}', [Project::class, 'delete']);

    Route::get('/daftar-catatan', [Note::class, 'index'])->name('daftar-catatan');
    Route::get('/detail-catatan/{id}', [Note::class, 'detail'])->name('detail-catatan');
    Route::get('/tambah-catatan', [Note::class, 'new'])->name('tambah-catatan');
    Route::post('/tambah-catatan', [Note::class, 'new']);
    Route::get('/edit-catatan/{id}', [Note::class, 'update'])->name('edit-catatan');
    Route::post('/edit-catatan/{id}', [Note::class, 'update']);
    Route::get('/hapus-catatan/{id}', [Note::class, 'delete']);

    // Route::get('/daftar-note', [NoteDataTable::class, 'index'])->name('daftar-note');
    // Route::get('/daftar-note/json', [NoteDataTable::class, 'data'])->name('daftar-note-json');
    // Route::get('/user/json', [\App\Http\Controllers\UserController::class, 'data'])->name('user.data');
    // Route::get('/user', [\App\Http\Controllers\UserController::class, 'index'])->name('user.index');
    
    Route::group(['middleware' => 'klien'], function () {
        
        
    });

    Route::group(['middleware' => 'projectManager'], function () {
        
        
    });

    Route::group(['middleware' => 'ceo'], function () {

    });

    Route::group(['middleware' => 'cto'], function () {

    });
    
});
