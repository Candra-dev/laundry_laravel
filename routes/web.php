<?php

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
    return view('welcome');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/profile', 'ProfileController@index')->name('profile');
Route::put('/profile', 'ProfileController@update')->name('profile.update');

Route::get('/user', 'BasicController@index')->name('user');

Route::get('/pelanggan', 'PelangganController@index')->name('pelanggan');

Route::get('/produk', function () {
    return view('produk');
})->name('produk');

Route::get('/transaksi', function () {
    return view('transaksi');
})->name('transaksi');

Route::get('/laporan', function () {
    return view('laporan');
})->name('laporan');

Route::middleware('auth')->group(function() {
    Route::resource('basic', BasicController::class);
});

Route::middleware('auth')->group(function() {
    Route::resource('customer', PelangganController::class);
});