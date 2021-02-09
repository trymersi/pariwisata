<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObjekWisataAmenitasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('objek_wisata_amenitas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('objek_wisata_id')->nullable()->comment('foreign key dari tabel objekwisatas');
            $table->integer('tempat_parkir')->default(1)->nullable()->comment('status tempat parkir objek wisata; 1 untuk ada 0 untuk tidak');
            $table->integer('fasilitas_kesehatan')->default(1)->nullable()->comment('status fasilitas kesehatan objek wisata; 1 untuk ada 0 untuk tidak');
            $table->integer('fasilitas_perbelanjaan')->default(1)->nullable()->comment('status fasilitas perbelanjaan objek wisata; 1 untuk ada 0 untuk tidak');
            $table->integer('listrik')->default(1)->nullable()->comment('status listrik objek wisata; 1 untuk ada 0 untuk tidak');
            $table->string('sinyal_provider')->nullable()->comment('sinyal provider yang tersedia didalam objek wisata');
            $table->integer('street_furniture')->default(1)->nullable()->comment('status street furniture objek wisata; 1 untuk ada 0 untuk tidak');
            $table->integer('bengkel')->default(1)->nullable()->comment('status bengkel objek wisata; 1 untuk ada 0 untuk tidak');
            $table->integer('money_changer')->default(0)->nullable()->comment('status money changer objek wisata; 1 untuk ada 0 untuk tidak');
            $table->integer('tempat_sewa_kendaraan')->default(0)->nullable()->comment('status tempat sewa kendaraan changer objek wisata; 1 untuk ada 0 untuk tidak');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('objek_wisata_id')->references('id')->on('objek_wisatas')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('objek_wisata_amenitas');
    }
}
