<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKabupatensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kabupatens', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama')->nullable()->comment('nama kabupaten');
            $table->string('slug');
            $table->text('keterangan')->nullable()->comment('keterangan kabupaten');
            $table->string('gambar')->nullable()->comment('gambar kabupaten');
            $table->string('alamat')->nullable()->comment('alamat kabupaten');
            $table->string('slug')->nullable()->comment('slug untuk url');
            $table->string('meta_description')->nullable()->comment('meta deskripsi');
            $table->string('meta_keywords')->nullable()->comment('meta keyword');
            $table->string('latitude')->nullable()->comment('titik latitude kabupaten');
            $table->string('longitude')->nullable()->comment('titik longitude kabupaten');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kabupatens');
    }
}
