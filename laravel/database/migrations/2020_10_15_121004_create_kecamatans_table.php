<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKecamatansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kecamatans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('kabupaten_id')->nullable()->comment('foreign key dari tabel kabupatens');
            $table->string('nama')->nullable()->comment('nama kecamatan');
            $table->text('keterangan')->nullable()->comment('keterangan kecamatan');
            $table->string('gambar')->nullable()->comment('gambar kecamatan');
            $table->string('alamat')->nullable()->comment('alamat kecamatan');
            $table->string('latitude')->nullable()->comment('titik latitude kecamatan');
            $table->string('longitude')->nullable()->comment('titik longitude kecamatan');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('kabupaten_id')->references('id')->on('kabupatens')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kecamatans');
    }
}
