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

Route::group(['prefix' => 'dashboard',  'middleware' => 'auth'],function()
{
    Route::get('/', "Backend\DashboardController@index");

    Route::prefix('/kabupaten')->group(function(){
        Route::resource('/','Backend\KabupatenController');
        Route::get('/table','Backend\KabupatenController@table');
        Route::get('/edit/{id}','Backend\KabupatenController@edit');
        Route::patch('/update/{id}','Backend\KabupatenController@update');
        Route::delete('/delete/{id}','Backend\KabupatenController@destroy');
    });

    Route::prefix('/pengguna')->group(function(){
        Route::resource('/','Backend\PenggunaController');
        Route::get('/table','Backend\PenggunaController@table');
        Route::get('/edit/{id}','Backend\PenggunaController@edit');
        Route::patch('/update/{id}','Backend\PenggunaController@update');
        Route::delete('/delete/{id}','Backend\PenggunaController@destroy');
    });

    Route::prefix('/kategori-ekraf')->group(function(){
        Route::resource('/','Backend\KategoriEkrafController');
        Route::get('/table','Backend\KategoriEkrafController@table');
        Route::get('/edit/{id}','Backend\KategoriEkrafController@edit');
        Route::patch('/update/{id}','Backend\KategoriEkrafController@update');
        Route::delete('/delete/{id}','Backend\KategoriEkrafController@destroy');
    });

    Route::prefix('/ekraf')->group(function(){
        Route::resource('/','Backend\EkrafController');
        Route::get('/table','Backend\EkrafController@table');
        Route::get('/edit/{id}','Backend\EkrafController@edit');
        Route::patch('/update/{id}','Backend\EkrafController@update');
        Route::delete('/delete/{id}','Backend\EkrafController@destroy');
    });
});

