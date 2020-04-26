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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::group(['middleware'=>'auth'],function(){
    Route::get('/dashboard','PageController@dashboard')->name('dashboard');

    Route::get('/pegawai','PegawaiController@index')->name('pegawai');
    Route::get('/create-pegawai','PegawaiController@create')->name('create-pegawai');
    Route::post('/store-pegawai','PegawaiController@store')->name('store-pegawai');
    Route::get('/edit-pegawai/{id}','PegawaiController@edit')->name('edit-pegawai');
    Route::post('/update-pegawai/{id}','PegawaiController@update')->name('update-pegawai');    
    Route::delete('/delete-pegawai/{id}','PegawaiController@delete')->name('delete-pegawai');
    Route::get('/cari-pegawai','PegawaiController@cari')->name('cari-pegawai'); 

    Route::get('/sppd','SppdController@index')->name('sppd');
    Route::get('/setting','SettingController@index')->name('setting');
    Route::get('/pptk','PptkController@index')->name('pptk');
});