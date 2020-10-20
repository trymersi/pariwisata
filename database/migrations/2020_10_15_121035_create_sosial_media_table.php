<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSosialMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sosial_media', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('id_tempat')->nullable()->comment('id tempat yang di deskripsikan didalan function');
            $table->string('kode_tempat')->nullable()->comment('kode tempat yang di deskripsikan didalan function');
            $table->string('kode_sosmed')->nullable()->comment('kode untuk mengetahui itu sosmed apa');
            $table->string('alamat_sosmed')->nullable()->comment('alamat sosmed bisa berupa username');
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
        Schema::dropIfExists('sosial_media');
    }
}
