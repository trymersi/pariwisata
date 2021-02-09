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

Route::prefix('/')->group(function(){
    Route::get('/','Frontend\HomeController@index');

    Route::prefix('/hubungi-kami')->group(function(){
        Route::get('/','Frontend\HomeController@contact');
        Route::post('/','Frontend\HomeController@contactSave');
    });
    Route::prefix('/kabupaten')->group(function(){
        Route::get('/{id}','Frontend\KabupatenController@index');
    });
    Route::prefix('/objek-wisata')->group(function(){
        Route::resource('/','Frontend\ObjekWisataController');
        Route::get('/{id}','Frontend\ObjekWisataController@show');
        Route::post('/rating','Frontend\ObjekWisataController@rating');
    });
    Route::prefix('/restoran')->group(function(){
        Route::resource('/','Frontend\RestaurantController');
        Route::get('/{id}','Frontend\RestaurantController@show');
        Route::post('/rating','Frontend\RestaurantController@rating');

    });
    Route::prefix('/hotel')->group(function(){
        Route::resource('/','Frontend\HotelController');
        Route::get('/{id}','Frontend\HotelController@show');
        Route::post('/rating','Frontend\HotelController@rating');
        

    });
    Route::prefix('/event')->group(function(){
        Route::resource('/','Frontend\EventController');
        Route::get('/{id}','Frontend\EventController@show');
    });
    Route::prefix('/tempat-ibadah')->group(function(){
        Route::resource('/','Frontend\TempatIbadahController');
        Route::get('/{id}','Frontend\TempatIbadahController@show');
        Route::post('/rating','Frontend\TempatIbadahController@rating');

    });
    Route::prefix('/berita')->group(function(){
        Route::resource('/','Frontend\BeritaController');
        Route::get('/{id}','Frontend\BeritaController@show');
        
    });
    Route::prefix('/kategori')->group(function(){
        Route::get('/{id}','Frontend\BeritaController@kategoriBerita');
    });
    Route::get('/pencarian-berita', ['as' => 'pencarian', 'uses' => 'Frontend\BeritaController@pencarian']);

});

Route::group(['prefix' => 'dashboard',  'middleware' => 'auth'],function()
{
    Route::get('/', "Backend\DashboardController@index");


    Route::prefix('/pengaturan')->group(function(){
        Route::resource('/','Backend\SettingController');
        Route::get('/edit/{id}','Backend\SettingController@edit');
        Route::patch('/update/{id}','Backend\SettingController@update');
        Route::delete('/delete/{id}','Backend\SettingController@destroy');
    });

    Route::prefix('/pengaturan-aplikasi')->group(function(){
        Route::resource('/','Backend\AppSettingController');
        Route::get('/edit/{id}','Backend\AppSettingController@edit');
        Route::patch('/update/{id}','Backend\AppSettingController@update');
        Route::delete('/delete/{id}','Backend\AppSettingController@destroy');
    });

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
        Route::prefix('/sosial-media')->group(function(){
            Route::get('/{id}','Backend\ObjekWisataController@sosmedIndex');
            Route::get('/create/{id_tempat}','Backend\ObjekWisataController@sosmedCreate');
            Route::post('/store','Backend\ObjekWisataController@sosmedStore');
            Route::get('/table/{id_tempat}','Backend\ObjekWisataController@sosmedTable');
            Route::get('/edit/{id}/{id_tempat}','Backend\ObjekWisataController@sosmedEdit');
            Route::patch('/update/{id}','Backend\ObjekWisataController@sosmedUpdate');
            Route::delete('/delete/{id}','Backend\ObjekWisataController@sosmedDestroy');
        });

        Route::prefix('/hotel')->group(function(){
            Route::get('/{id}','Backend\ObjekWisataController@hotelIndex');
            Route::get('/create/{id_objek_wisata}','Backend\ObjekWisataController@hotelCreate');
            Route::post('/store','Backend\ObjekWisataController@hotelStore');
            Route::get('/table/{id_objek_wisata}','Backend\ObjekWisataController@hotelTable');
            Route::delete('/delete/{id}','Backend\ObjekWisataController@hotelDestroy');
        });

        Route::prefix('/restaurant')->group(function(){
            Route::get('/{id}','Backend\ObjekWisataController@restaurantIndex');
            Route::get('/create/{id_objek_wisata}','Backend\ObjekWisataController@restaurantCreate');
            Route::post('/store','Backend\ObjekWisataController@restaurantStore');
            Route::get('/table/{id_objek_wisata}','Backend\ObjekWisataController@restaurantTable');
            Route::delete('/delete/{id}','Backend\ObjekWisataController@restaurantDestroy');
        });

        Route::prefix('/tempat-ibadah')->group(function(){
            Route::get('/{id}','Backend\ObjekWisataController@tempatIbadahIndex');
            Route::get('/create/{id_objek_wisata}','Backend\ObjekWisataController@tempatIbadahCreate');
            Route::post('/store','Backend\ObjekWisataController@tempatIbadahStore');
            Route::get('/table/{id_objek_wisata}','Backend\ObjekWisataController@tempatIbadahTable');
            Route::delete('/delete/{id}','Backend\ObjekWisataController@tempatIbadahDestroy');
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
        Route::prefix('/sosial-media')->group(function(){
            Route::get('/{id}','Backend\RestaurantController@sosmedIndex');
            Route::get('/create/{id_tempat}','Backend\RestaurantController@sosmedCreate');
            Route::post('/store','Backend\RestaurantController@sosmedStore');
            Route::get('/table/{id_tempat}','Backend\RestaurantController@sosmedTable');
            Route::get('/edit/{id}/{id_tempat}','Backend\RestaurantController@sosmedEdit');
            Route::patch('/update/{id}','Backend\RestaurantController@sosmedUpdate');
            Route::delete('/delete/{id}','Backend\RestaurantController@sosmedDestroy');
        });
    });

    Route::prefix('/cindramata')->group(function(){
        Route::resource('/','Backend\CendramataController');
        Route::get('/table','Backend\CendramataController@table');
        Route::get('/edit/{id}','Backend\CendramataController@edit');
        Route::patch('/update/{id}','Backend\CendramataController@update');
        Route::delete('/delete/{id}','Backend\CendramataController@destroy');
        Route::get('list-objek-wisata/{id_kabupaten}','Backend\CendramataController@getListObjekWisata');
        Route::prefix('/gambar')->group(function(){
            Route::get('/{id}','Backend\CendramataController@gambarIndex');
            Route::get('/create/{id_event}','Backend\CendramataController@gambarCreate');
            Route::post('/store','Backend\CendramataController@gambarStore');
            Route::get('/table/{id_event}','Backend\CendramataController@gambarTable');
            Route::delete('/delete/{id}','Backend\CendramataController@gambarDestroy');
        });
        Route::prefix('/penyedia')->group(function(){
            Route::get('/{id}','Backend\CendramataController@penyediaIndex');
            Route::get('/create/{id_objek_wisata}','Backend\CendramataController@penyediaCreate');
            Route::post('/store','Backend\CendramataController@penyediaStore');
            Route::get('/table/{id_objek_wisata}','Backend\CendramataController@penyediaTable');
            Route::delete('/delete/{id}','Backend\CendramataController@penyediaDestroy');
        });

        Route::prefix('/detail')->group(function(){
            Route::get('/{id}','Backend\CendramataController@detailIndex');
            Route::get('/create/{cindramata_id}','Backend\CendramataController@detailCreate');
            Route::post('/store','Backend\CendramataController@detailStore');
            Route::get('/table/{cindramata_id}','Backend\CendramataController@detailTable');
            Route::get('/edit/{id}/{cindramata_id}','Backend\CendramataController@detailEdit');
            Route::patch('/update/{id}','Backend\CendramataController@detailUpdate');
            Route::delete('/delete/{id}','Backend\CendramataController@detailDestroy');
        });
        Route::prefix('/sosial-media')->group(function(){
            Route::get('/{id}','Backend\CendramataController@sosmedIndex');
            Route::get('/create/{id_tempat}','Backend\CendramataController@sosmedCreate');
            Route::post('/store','Backend\CendramataController@sosmedStore');
            Route::get('/table/{id_tempat}','Backend\CendramataController@sosmedTable');
            Route::get('/edit/{id}/{id_tempat}','Backend\CendramataController@sosmedEdit');
            Route::patch('/update/{id}','Backend\CendramataController@sosmedUpdate');
            Route::delete('/delete/{id}','Backend\CendramataController@sosmedDestroy');
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
        Route::prefix('/sosial-media')->group(function(){
            Route::get('/{id}','Backend\HotelController@sosmedIndex');
            Route::get('/create/{id_tempat}','Backend\HotelController@sosmedCreate');
            Route::post('/store','Backend\HotelController@sosmedStore');
            Route::get('/table/{id_tempat}','Backend\HotelController@sosmedTable');
            Route::get('/edit/{id}/{id_tempat}','Backend\HotelController@sosmedEdit');
            Route::patch('/update/{id}','Backend\HotelController@sosmedUpdate');
            Route::delete('/delete/{id}','Backend\HotelController@sosmedDestroy');
        });
    });

    Route::prefix('/kategori-berita')->group(function(){
        Route::resource('/','Backend\PostCategoryController');
        Route::get('/table','Backend\PostCategoryController@table');
        Route::get('/edit/{id}','Backend\PostCategoryController@edit');
        Route::patch('/update/{id}','Backend\PostCategoryController@update');
        Route::delete('/delete/{id}','Backend\PostCategoryController@destroy');
    });

    Route::prefix('/label')->group(function(){
        Route::resource('/','Backend\LabelController');
        Route::get('/table','Backend\LabelController@table');
        Route::get('/edit/{id}','Backend\LabelController@edit');
        Route::patch('/update/{id}','Backend\LabelController@update');
        Route::delete('/delete/{id}','Backend\LabelController@destroy');
    });

    Route::prefix('/berita')->group(function(){
        Route::resource('/','Backend\PostController');
        Route::get('/table','Backend\PostController@table');
        Route::get('/edit/{id}','Backend\PostController@edit');
        Route::patch('/update/{id}','Backend\PostController@update');
        Route::delete('/delete/{id}','Backend\PostController@destroy');
    });

    Route::prefix('/event')->group(function(){
        Route::resource('/','Backend\EventController');
        Route::get('/table','Backend\EventController@table');
        Route::get('/edit/{id}','Backend\EventController@edit');
        Route::patch('/update/{id}','Backend\EventController@update');
        Route::delete('/delete/{id}','Backend\EventController@destroy');
        Route::prefix('/gambar')->group(function(){
            Route::get('/{id}','Backend\EventController@gambarIndex');
            Route::get('/create/{id_event}','Backend\EventController@gambarCreate');
            Route::post('/store','Backend\EventController@gambarStore');
            Route::get('/table/{id_event}','Backend\EventController@gambarTable');
            Route::delete('/delete/{id}','Backend\EventController@gambarDestroy');
        });
    });

    Route::prefix('/link-terkait')->group(function(){
        Route::resource('/','Backend\LinkTerkaitController');
        Route::get('/table','Backend\LinkTerkaitController@table');
        Route::get('/edit/{id}','Backend\LinkTerkaitController@edit');
        Route::patch('/update/{id}','Backend\LinkTerkaitController@update');
        Route::delete('/delete/{id}','Backend\LinkTerkaitController@destroy');
    });

    Route::prefix('/review')->group(function(){
        Route::prefix('/objek-wisata')->group(function(){
            Route::get('/','Backend\ReviewController@objekWisata');
            Route::get('/table','Backend\ReviewController@tableObjekWisata');
            Route::post('/simpan','Backend\ReviewController@statusObjekWisata');
            Route::post('/setaktiv','Backend\ReviewController@setAktivObjekWisata');
            Route::post('/setnonaktiv','Backend\ReviewController@setNonAktivObjekWisata');
            Route::delete('/delete/{id}','Backend\ReviewController@hapusObjekWisata');
            
        });
    });

    Route::prefix('/pertanyaan')->group(function(){
        Route::get('/','Backend\ContactController@index');
        Route::get('/table','Backend\ContactController@table');
    });

    Route::prefix('/sadar-wisata')->group(function(){
        Route::resource('/','Backend\SadarWisataController');
        Route::get('/table','Backend\SadarWisataController@table');
        Route::get('/edit/{id}','Backend\SadarWisataController@edit');
        Route::patch('/update/{id}','Backend\SadarWisataController@update');
        Route::delete('/delete/{id}','Backend\SadarWisataController@destroy');
    });

    Route::prefix('/pemandu-wisata')->group(function(){
        Route::resource('/','Backend\PemanduController');
        Route::get('/table','Backend\PemanduController@table');
        Route::get('/edit/{id}','Backend\PemanduController@edit');
        Route::patch('/update/{id}','Backend\PemanduController@update');
        Route::delete('/delete/{id}','Backend\PemanduController@destroy');
        Route::get('/objek-wisata/{id}','Backend\PemanduController@objekWisataByKab');
    });

    Route::prefix('/desa-wisata')->group(function(){
        Route::resource('/','Backend\DesaWisataController');
        Route::get('/table','Backend\DesaWisataController@table');
        Route::get('/edit/{id}','Backend\DesaWisataController@edit');
        Route::patch('/update/{id}','Backend\DesaWisataController@update');
        Route::delete('/delete/{id}','Backend\DesaWisataController@destroy');
    });

    Route::prefix('/travel')->group(function(){
        Route::resource('/','Backend\TravelController');
        Route::get('/table','Backend\TravelController@table');
        Route::get('/edit/{id}','Backend\TravelController@edit');
        Route::patch('/update/{id}','Backend\TravelController@update');
        Route::delete('/delete/{id}','Backend\TravelController@destroy');
    });

    Route::prefix('/iklan')->group(function(){
        Route::resource('/','Backend\IklanController');
        Route::get('/table','Backend\IklanController@table');
        Route::get('/edit/{id}','Backend\IklanController@edit');
        Route::patch('/update/{id}','Backend\IklanController@update');
        Route::delete('/delete/{id}','Backend\IklanController@destroy');
    });

    Route::prefix('/kunjungan')->group(function(){
        Route::resource('/','Backend\KunjunganController');
        Route::get('/table','Backend\KunjunganController@table');
        Route::get('/edit/{id}','Backend\KunjunganController@edit');
        Route::patch('/update/{id}','Backend\KunjunganController@update');
        Route::delete('/delete/{id}','Backend\KunjunganController@destroy');
    });

    Route::prefix('/kuliner')->group(function(){
        Route::resource('/','Backend\KulinerController');
        Route::get('/table','Backend\KulinerController@table');
        Route::get('/edit/{id}','Backend\KulinerController@edit');
        Route::patch('/update/{id}','Backend\KulinerController@update');
        Route::delete('/delete/{id}','Backend\KulinerController@destroy');
        Route::prefix('/gambar')->group(function(){
            Route::get('/{id}','Backend\KulinerController@gambarIndex');
            Route::get('/create/{id_event}','Backend\KulinerController@gambarCreate');
            Route::post('/store','Backend\KulinerController@gambarStore');
            Route::get('/table/{id_event}','Backend\KulinerController@gambarTable');
            Route::delete('/delete/{id}','Backend\KulinerController@gambarDestroy');
        });
        Route::prefix('/penyedia')->group(function(){
            Route::get('/{id}','Backend\KulinerController@penyediaIndex');
            Route::get('/create/{id_objek_wisata}','Backend\KulinerController@penyediaCreate');
            Route::post('/store','Backend\KulinerController@penyediaStore');
            Route::get('/table/{id_objek_wisata}','Backend\KulinerController@penyediaTable');
            Route::delete('/delete/{id}','Backend\KulinerController@penyediaDestroy');
        });
    });

});

