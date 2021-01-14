<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSadarWisatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sadar_wisatas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kabupaten_id')->nullable()->comment('foreign key dari tabel kabupatens');
            $table->unsignedBigInteger('kecamatan_id')->nullable()->comment('foreign key dari tabel kecamatans');
            $table->string('nama')->nullable()->comment('nama dari sadar wisata');
            $table->string('alamat')->nullable()->comment('alamat dari sadar wisata');
            $table->string('kontak')->nullable()->comment('alamat dari sadar wisata');
            $table->string('status')->nullable()->comment('statusnya');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('kabupaten_id')->references('id')->on('kabupatens')->onDelete('set null');
            $table->foreign('kecamatan_id')->references('id')->on('kecamatans')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sadar_wisatas');
    }
}
