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
use App\Http\Controllers\Store;
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

Route::get('/download-ktp/{fileName}', [Store::class, 'downloadKtp']);
Route::post('/tambah-invoice', [Invoice::class, 'new']);

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

    Route::get('/daftar-store', [Store::class, 'index'])->name('daftar-store');
    Route::get('/tambah-store', [Store::class, 'new'])->name('tambah-store');
    Route::post('/tambah-store', [Store::class, 'new']);
    Route::get('/edit-store/{id}', [Store::class, 'update'])->name('edit-store');
    Route::post('/edit-store/{id}', [Store::class, 'update']);
    Route::get('/hapus-store/{id}', [Store::class, 'delete']);
    Route::get('/detail-store/{id}', [Store::class, 'byId'])->name('detail-store');
    Route::post('/status/{id}', [Store::class, 'updateStatus']);

    Route::get('/daftar-target-store', [TargetStore::class, 'index'])->name('daftar-target-store');
    Route::get('/tambah-target-store', [TargetStore::class, 'new'])->name('tambah-target-store');
    Route::post('/tambah-target-store', [TargetStore::class, 'new']);
    Route::get('/edit-target-store/{id}', [TargetStore::class, 'update'])->name('edit-target-store');
    Route::post('/edit-target-store/{id}', [TargetStore::class, 'update']);
    Route::get('/hapus-target-store/{id}', [TargetStore::class, 'delete']);
    Route::get('/detail-target-store/{id}', [TargetStore::class, 'byId'])->name('detail-target-store');
    Route::post('/status-target-store/{id}', [TargetStore::class, 'updateStatus']);
    

    Route::get('/detail-site-user/{id}', [User::class, 'detail'])->name('detail-site-user');
    Route::post('/tambah-site-user/{id}', [User::class, 'newSite']);

    Route::get('/hapus-detail-site/{id_site_detail}', [SiteDetail::class, 'delete']);
    
    Route::get('/daftar-user', [User::class, 'index'])->name('daftar-user');
    Route::get('/tambah-user', [User::class, 'new'])->name('tambah-user');
    Route::post('/tambah-user', [User::class, 'new']);
    Route::get('/edit-user/{id}', [User::class, 'update'])->name('edit-user');
    Route::post('/edit-user/{id}', [User::class, 'update']);
    Route::get('/hapus-user/{id}', [User::class, 'delete']);

    Route::get('/daftar-site', [Site::class, 'index'])->name('daftar-site');
    Route::get('/tambah-site', [Site::class, 'new'])->name('tambah-site');
    Route::post('/tambah-site', [Site::class, 'new']);
    Route::get('/edit-site/{id}', [Site::class, 'update'])->name('edit-site');
    Route::post('/edit-site/{id}', [Site::class, 'update']);
    Route::get('/hapus-site/{id}', [Site::class, 'delete']);

    Route::get('/daftar-produk', [Product::class, 'index'])->name('daftar-produk');
    Route::get('/tambah-produk', [Product::class, 'new'])->name('tambah-produk');
    Route::post('/tambah-produk', [Product::class, 'new']);
    Route::get('/edit-produk/{id}', [Product::class, 'update'])->name('edit-produk');
    Route::post('/edit-produk/{id}', [Product::class, 'update']);
    Route::get('/hapus-produk/{id}', [Product::class, 'delete']);
    
    Route::get('/stok-produk/{id_product}', [Stock::class, 'index']);
    Route::post('/tambah-stok', [Stock::class, 'new']);
    Route::post('/edit-stok/{id}', [Stock::class, 'update']);
    Route::get('/hapus-stok/{id}/{id_product}', [Stock::class, 'delete']);
    
    Route::get('/daftar-detail-site/{id_site}', [SiteDetail::class, 'index'])->name('daftar-detail-site');
    Route::post('/tambah-detail-site/{id_site}', [SiteDetail::class, 'new']);

    Route::get('/daftar-invoice', [Invoice::class, 'index'])->name('daftar-invoice');
    Route::get('/edit-invoice/{id}', [Invoice::class, 'update'])->name('edit-invoice');
    Route::post('/edit-invoice/{id}', [Invoice::class, 'update']);
    Route::get('/hapus-invoice/{id}', [Invoice::class, 'delete']);
    Route::get('/detail-invoice/{id}', [DetailInvoice::class, 'index'])->name('detail-invoice');
    Route::get('/edit-detail-invoice/{id}', [DetailInvoice::class, 'update']);

    Route::get('/daftar-penjualan', [Sales::class, 'index'])->name('daftar-penjualan');
    Route::get('/tambah-penjualan', [Sales::class, 'new'])->name('tambah-penjualan');
    Route::post('/tambah-penjualan', [Sales::class, 'new']);
    Route::get('/edit-penjualan/{id}', [Sales::class, 'update'])->name('edit-penjualan');
    Route::post('/edit-penjualan/{id}', [Sales::class, 'update']);
    Route::get('/hapus-penjualan/{id}', [Sales::class, 'delete']);
    Route::post('/bayar-penjualan/{id}', [Sales::class, 'pay']);
    
    Route::get('/detail-penjualan/{id_sales}', [SalesDetail::class, 'index']);
    Route::get('/tambah-detail-penjualan/{id_sales}', [SalesDetail::class, 'new'])->name('tambah-detail-penjualan');
    Route::post('/tambah-detail-penjualan/{id_sales}', [SalesDetail::class, 'new']);
    Route::get('/edit-detail-penjualan/{id}/{id_sales}', [SalesDetail::class, 'update'])->name('edit-detail-penjualan');
    Route::post('/edit-detail-penjualan/{id}/{id_sales}', [SalesDetail::class, 'update']);
    Route::get('/hapus-detail-penjualan/{id}/{id_sales}', [SalesDetail::class, 'delete']);
    
    Route::group(['middleware' => 'administrator'], function () {
        
        
    });

    Route::group(['middleware' => 'admincabang'], function () {
        
        
    });

    Route::group(['middleware' => 'sales'], function () {

    });
    
});
