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
            $table->string('keterangan')->nullable()->comment('keterangan kabupaten');
            $table->string('gambar')->nullable()->comment('gambar kabupaten');
            $table->string('alamat')->nullable()->comment('alamat kabupaten');
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
