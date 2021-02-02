<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_website');
            $table->string('keterangan_website');
            $table->string('alamat_kantor');
            $table->string('icon');
            $table->string('email');
            $table->string('notel');
            $table->string('logo_website');
            $table->string('gambar_login');
            $table->string('meta_description');
            $table->string('meta_keywords');
            $table->string('longitude');
            $table->string('latitude');
            $table->string('slider_gambar_utama');
            $table->string('slider_gambar_objek_wisata');
            $table->string('slider_gambar_objek_event');
            $table->string('slider_gambar_objek_restoran');
            $table->string('slider_gambar_objek_hotel');
            $table->string('gambar_promosi_satu');
            $table->string('gambar_promosi_dua');
            $table->string('video_promosi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
