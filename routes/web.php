<?php

use App\Http\Controllers\User;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\DetailInvoice;
use App\Http\Controllers\Invoice;
use App\Http\Controllers\Login;
use App\Http\Controllers\Product;
use App\Http\Controllers\Sales;
use App\Http\Controllers\SalesDetail;
use App\Http\Controllers\Site;
use App\Http\Controllers\SiteDetail;
use App\Http\Controllers\Stock;
use App\Http\Controllers\StockAll;
use App\Http\Controllers\StockIn;
use App\Http\Controllers\StockInAll;
use App\Http\Controllers\StockOpname;
use App\Http\Controllers\Store;
use App\Http\Controllers\StoreAr;
use App\Http\Controllers\TargetStore;
use Illuminate\Support\Facades\Route;

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
    Route::get('/ubah-password', [User::class, 'ubahPassword'])->name('ubah-password');
    Route::post('/ubah-password/{id}', [User::class, 'ubahPassword']);
    
    Route::get('/daftar-user', [User::class, 'index'])->name('daftar-user');
    Route::get('/tambah-user', [User::class, 'new'])->name('tambah-user');
    Route::post('/tambah-user', [User::class, 'new']);
    Route::get('/edit-user/{id}', [User::class, 'update'])->name('edit-user');
    Route::post('/edit-user/{id}', [User::class, 'update']);
    Route::get('/hapus-user/{id}', [User::class, 'delete']);
    
    Route::group(['middleware' => 'klien'], function () {
        
        
    });

    Route::group(['middleware' => 'projectManager'], function () {
        
        
    });

    Route::group(['middleware' => 'ceo'], function () {

    });

    Route::group(['middleware' => 'cto'], function () {

    });
    
});
