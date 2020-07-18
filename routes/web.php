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
Route::get('/',function(){
    return redirect()->route('login');
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::Resource('konsumen', 'KonsumenController');
    Route::get('konsumen/api/data', 'KonsumenController@api')->name('konsumen.api.data');
    Route::Resource('transaksi', 'TransaksiController');
    Route::get('transaksi/api/data', 'TransaksiController@api')->name('transaksi.api.data');
    Route::post('konsumen.get_detail', 'KonsumenController@get_detail')->name('konsumen.get_detail');

    //route  - harga
    Route::Resource('harga', 'TmhargaController');
    Route::get('harga/api/data', 'TmhargaController@api')->name('harga.api.data');

});

Auth::routes();
