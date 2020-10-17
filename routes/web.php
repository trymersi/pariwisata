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

    Route::prefix('/kecamatan')->group(function(){
        Route::resource('/','Backend\KecamatanController');
        Route::get('/table','Backend\KecamatanController@table');
        Route::get('/edit/{id}','Backend\KecamatanController@edit');
        Route::patch('/update/{id}','Backend\KecamatanController@update');
        Route::delete('/delete/{id}','Backend\KecamatanController@destroy');
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

    Route::prefix('/objek-wisata')->group(function(){
        Route::resource('/','Backend\ObjekWisataController');
        Route::get('/table','Backend\ObjekWisataController@table');
        Route::get('/edit/{id}','Backend\ObjekWisataController@edit');
        Route::patch('/update/{id}','Backend\ObjekWisataController@update');
        Route::delete('/delete/{id}','Backend\ObjekWisataController@destroy');
        Route::get('list-kecamatan/{id_kabupaten}','Backend\ObjekWisataController@getListKecamatan');
        Route::prefix('/gambar')->group(function(){
            Route::get('/{id}','Backend\ObjekWisataController@gambarIndex');
            Route::get('/create/{id_objek_wisata}','Backend\ObjekWisataController@gambarCreate');
            Route::post('/store','Backend\ObjekWisataController@gambarStore');
            Route::get('/table/{id_objek_wisata}','Backend\ObjekWisataController@gambarTable');
            Route::get('/edit/{id}/{id_objek_wisata}','Backend\ObjekWisataController@gambarEdit');
            Route::patch('/update/{id}','Backend\ObjekWisataController@gambarUpdate');
            Route::delete('/delete/{id}','Backend\ObjekWisataController@gambarDestroy');
        });
        Route::prefix('/aksesibilitas')->group(function(){
            Route::get('/{id}','Backend\ObjekWisataController@aksesibilitasCreate');
            Route::post('/store','Backend\ObjekWisataController@aksesibilitasStore');
            Route::patch('/update/{id}','Backend\ObjekWisataController@aksesibilitasUpdate');
        });

        Route::prefix('/amenitas')->group(function(){
            Route::get('/{id}','Backend\ObjekWisataController@amenitasCreate');
            Route::post('/store','Backend\ObjekWisataController@amenitasStore');
            Route::patch('/update/{id}','Backend\ObjekWisataController@amenitasUpdate');
        });

        Route::prefix('/detail')->group(function(){
            Route::get('/{id}','Backend\ObjekWisataController@detailCreate');
            Route::post('/store','Backend\ObjekWisataController@detailStore');
            Route::patch('/update/{id}','Backend\ObjekWisataController@detailUpdate');
        });
    });

    Route::prefix('/hotel')->group(function(){
        Route::resource('/','Backend\HotelController');
        Route::get('/table','Backend\HotelController@table');
        Route::get('/edit/{id}','Backend\HotelController@edit');
        Route::patch('/update/{id}','Backend\HotelController@update');
        Route::delete('/delete/{id}','Backend\HotelController@destroy');
        Route::get('list-kecamatan/{id_kabupaten}','Backend\HotelController@getListKecamatan');
        Route::prefix('/gambar')->group(function(){
            Route::get('/{id}','Backend\HotelController@gambarIndex');
            Route::get('/create/{id_objek_wisata}','Backend\HotelController@gambarCreate');
            Route::post('/store','Backend\HotelController@gambarStore');
            Route::get('/table/{id_objek_wisata}','Backend\HotelController@gambarTable');
            Route::get('/edit/{id}/{id_objek_wisata}','Backend\HotelController@gambarEdit');
            Route::patch('/update/{id}','Backend\HotelController@gambarUpdate');
            Route::delete('/delete/{id}','Backend\HotelController@gambarDestroy');
        });
    });
});

