<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDesaWisatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('desa_wisatas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kabupaten_id')->nullable()->comment('foreign key dari tabel kabupatens');
            $table->unsignedBigInteger('kecamatan_id')->nullable()->comment('foreign key dari tabel kecamatans');
            $table->string('nama')->nullable()->comment('nama dari desa wisata');
            $table->string('alamat')->nullable()->comment('alamat dari desa wisata');
            $table->string('potensi_wisata')->nullable()->comment('alamat dari desa wisata');
            $table->string('kontak')->nullable()->comment('alamat dari desa wisata');
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
        Schema::dropIfExists('desa_wisatas');
    }
}
