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

    
    Route::get('/setting','SettingController@index')->name('setting');
    Route::get('/edit-setting/{id}','SettingController@edit')->name('edit-setting');
    Route::get('/edit-setting-anggaran/{id}','SettingController@editanggaran')->name('edit-setting-anggaran');
    Route::post('/update-setting-anggaran/{id}','SettingController@updateAnggaran')->name('update-anggaran'); 
    Route::post('/update-setting-kadis/{id}','SettingController@updateKadis')->name('update-kadis'); 
    Route::post('/update-setting-bendahara/{id}','SettingController@updateBendahara')->name('update-bendahara'); 
    Route::get('/cari-pegawai-setting','SettingController@cari')->name('cari-pegawai-setting'); 

    Route::get('/pptk','PptkController@index')->name('pptk');
    Route::get('/create-pptk','PptkController@create')->name('create-pptk');
    Route::post('/store-pptk/{id}','PptkController@store')->name('store-pptk');
    Route::delete('/delete-pptk/{id}','PptkController@delete')->name('delete-pptk');
    Route::get('/cari-pegawai-pptk','PptkController@cari')->name('cari-pegawai-pptk'); 

    Route::get('/user','UserController@index')->name('user');
    Route::delete('/delete-user/{id}','UserController@delete')->name('delete-user');
    
    Route::get('/sppd','SppdController@index')->name('sppd');
    Route::get('/create-sppd','SppdController@create')->name('create-sppd');
    Route::post('/store-sppd','SppdController@store')->name('store-sppd');
    Route::get('/edit-sppd/{id}','SppdController@edit')->name('edit-sppd');
    Route::delete('/delete-sppd/{id}','SppdController@delete')->name('delete-sppd');
    Route::post('/update-sppd/{id}','SppdController@update')->name('update-sppd'); 
    
    Route::get('/tambah-pegawai-sppd','PegawaiSppdController@store')->name('cari-pegawai-sppd');
    Route::get('/create-pegawai-sppd/{id}','PegawaiSppdController@create')->name('create-pegawai-sppd');
    Route::delete('/delete-petugas-sppd/data','PegawaiSppdController@delete')->name('delete-pegawai-sppd');

    Route::get('/cetak_sppd/{id}','SppdController@cetak')->name('cetak-sppd');

});