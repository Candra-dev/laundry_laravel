<?php

use App\Http\Controllers\LaporanCrontroller;
use App\Transaksi;
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

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/profile', 'ProfileController@index')->name('profile');
Route::put('/profile', 'ProfileController@update')->name('profile.update');

Route::get('/user', 'BasicController@index')->name('user');

Route::get('/pelanggan', 'PelangganController@index')->name('pelanggan');

Route::get('/produk', 'ProdukController@index')->name('produk');

Route::get('/transaksi', 'TransaksiController@index')->name('transaksi');

Route::get('/laporan', TransaksiController::class . '@show')->name('laporan');

Route::middleware('auth')->group(function() {
    Route::resource('basic', BasicController::class);
});

Route::middleware('auth')->group(function() {
    Route::resource('customer', PelangganController::class);
});

Route::middleware('auth')->group(function() {
    Route::resource('kategori', ProdukController::class);
});

Route::middleware('auth')->group(function() {
    Route::resource('transaction', TransaksiController::class);
});
