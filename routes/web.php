<?php

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

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/home','HomeController@index')->name('home');
Route::Resource('konsumen', 'KonsumenController');
Route::get('konsumen/api', 'KonsumenController@api')->name('konsumen.api');
Route::Resource('transaksi', 'TransaksiController');
Route::get('transaksi/api', 'KonsumenController@api')->name('transaksi.api');
