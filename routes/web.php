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

    Route::prefix('/restaurant')->group(function(){
        Route::resource('/','Backend\RestaurantController');
        Route::get('/table','Backend\RestaurantController@table');
        Route::get('/edit/{id}','Backend\RestaurantController@edit');
        Route::patch('/update/{id}','Backend\RestaurantController@update');
        Route::delete('/delete/{id}','Backend\RestaurantController@destroy');
        Route::get('list-objek-wisata/{id_kabupaten}','Backend\RestaurantController@getListObjekWisata');
        Route::prefix('/gambar')->group(function(){
            Route::get('/{id}','Backend\RestaurantController@gambarIndex');
            Route::get('/create/{restaurant_id}','Backend\RestaurantController@gambarCreate');
            Route::post('/store','Backend\RestaurantController@gambarStore');
            Route::get('/table/{restaurant_id}','Backend\RestaurantController@gambarTable');
            Route::get('/edit/{id}/{restaurant_id}','Backend\RestaurantController@gambarEdit');
            Route::patch('/update/{id}','Backend\RestaurantController@gambarUpdate');
            Route::delete('/delete/{id}','Backend\RestaurantController@gambarDestroy');
        });
        Route::prefix('/menu')->group(function(){
            Route::get('/{id}','Backend\RestaurantController@menuIndex');
            Route::get('/create/{restaurant_id}','Backend\RestaurantController@menuCreate');
            Route::post('/store','Backend\RestaurantController@menuStore');
            Route::get('/table/{restaurant_id}','Backend\RestaurantController@menuTable');
            Route::get('/edit/{id}/{restaurant_id}','Backend\RestaurantController@menuEdit');
            Route::patch('/update/{id}','Backend\RestaurantController@menuUpdate');
            Route::delete('/delete/{id}','Backend\RestaurantController@menuDestroy');
        });
    });

    Route::prefix('/cindramata')->group(function(){
        Route::resource('/','Backend\CendramataController');
        Route::get('/table','Backend\CendramataController@table');
        Route::get('/edit/{id}','Backend\CendramataController@edit');
        Route::patch('/update/{id}','Backend\CendramataController@update');
        Route::delete('/delete/{id}','Backend\CendramataController@destroy');
        Route::get('list-objek-wisata/{id_kabupaten}','Backend\CendramataController@getListObjekWisata');
        Route::prefix('/detail')->group(function(){
            Route::get('/{id}','Backend\CendramataController@detailIndex');
            Route::get('/create/{cindramata_id}','Backend\CendramataController@detailCreate');
            Route::post('/store','Backend\CendramataController@detailStore');
            Route::get('/table/{cindramata_id}','Backend\CendramataController@detailTable');
            Route::get('/edit/{id}/{cindramata_id}','Backend\CendramataController@detailEdit');
            Route::patch('/update/{id}','Backend\CendramataController@detailUpdate');
            Route::delete('/delete/{id}','Backend\CendramataController@detailDestroy');
        });
    });

    Route::prefix('/tempat-ibadah')->group(function(){
        Route::resource('/','Backend\TempatIbadahController');
        Route::get('/table','Backend\TempatIbadahController@table');
        Route::get('/edit/{id}','Backend\TempatIbadahController@edit');
        Route::patch('/update/{id}','Backend\TempatIbadahController@update');
        Route::delete('/delete/{id}','Backend\TempatIbadahController@destroy');
        Route::get('list-objek-wisata/{id_kabupaten}','Backend\TempatIbadahController@getListObjekWisata');
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

