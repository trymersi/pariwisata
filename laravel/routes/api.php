<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API Routes for your application. These
| Routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('get-home','ServiceController@getHome');

Route::prefix('/get-objek-wisata')->group(function(){
    Route::post('/','ServiceController@getObjekWisata');
    Route::post('/detail','ServiceController@getObjekWisataDetail');
});

Route::prefix('/get-hotel')->group(function(){
    Route::post('/','ServiceController@getHotel');
    Route::post('/detail','ServiceController@getHotelDetail');
});

Route::prefix('/get-tempat-ibadah')->group(function(){
    Route::post('/','ServiceController@getTempatIbadah');
    Route::post('/detail','ServiceController@getTempatIbadahDetail');
});

Route::prefix('/get-restoran')->group(function(){
    Route::post('/','ServiceController@getRestoran');
    Route::post('/detail','ServiceController@getRestoranDetail');
});

Route::prefix('/get-ekraf')->group(function(){
    Route::post('/','ServiceController@getEkraf');
    Route::post('/detail','ServiceController@getEkrafDetail');
});

Route::prefix('/get-event')->group(function(){
    Route::post('/','ServiceController@getEvent');
    Route::post('/detail','ServiceController@getEventDetail');
});

Route::prefix('/get-cendramata')->group(function(){
    Route::post('/','ServiceController@getCendramata');
    Route::post('/detail','ServiceController@getCendramataDetail');
});

Route::prefix('/get-desa-wisata')->group(function(){
    Route::post('/','ServiceController@getDesaWisata');
    Route::post('/detail','ServiceController@getDesaWisataDetail');
});

Route::prefix('/get-kuliner')->group(function(){
    Route::post('/','ServiceController@getKuliner');
    Route::post('/detail','ServiceController@getKulinerDetail');
});

Route::prefix('/get-pemandu')->group(function(){
    Route::post('/','ServiceController@getPemandu');
    Route::post('/detail','ServiceController@getPemanduDetail');
});

Route::prefix('/get-berita')->group(function(){
    Route::post('/','ServiceController@getBerita');
    Route::post('/detail','ServiceController@getBeritaDetail');
});

Route::prefix('/get-sadar-wisata')->group(function(){
    Route::post('/','ServiceController@getSadarWisata');
    Route::post('/detail','ServiceController@getSadarWisataDetail');
});

Route::prefix('/get-travel')->group(function(){
    Route::post('/','ServiceController@getTravel');
    Route::post('/detail','ServiceController@getTravelDetail');
});

Route::prefix('/get-kabupaten')->group(function(){
    Route::post('/','ServiceController@getKabupaten');
    Route::post('/detail','ServiceController@getKabupatenDetail');
});


