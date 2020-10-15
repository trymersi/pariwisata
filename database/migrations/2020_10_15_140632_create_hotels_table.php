<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotels', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('kabupaten_id')->nullable()->comment('foreign key dari tabel kabupatens');
            $table->unsignedBigInteger('objek_wisata_id')->nullable()->comment('foreign key dari tabel objekwisatas');
            $table->string('nama')->nullable()->comment('nama hotel');
            $table->string('deskripsi')->nullable()->comment('deskripsi hotel');
            $table->string('gambar')->nullable()->comment('gambar hotel');
            $table->string('layanan')->nullable()->comment('layanan hotel');
            $table->string('jenis')->nullable()->comment('jenis hotel; melati atau berbintang sekian');
            $table->string('alamat')->nullable()->comment('alamat hotel');
            $table->string('latitude')->nullable()->comment('titik latitude hotel');
            $table->string('longitude')->nullable()->comment('titik longitude hotel');
            $table->integer('status')->default(0)->nullable()->comment('status pengajuan hotel; 0 untuk diajukan');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('kabupaten_id')->references('id')->on('kabupatens')->onDelete('set null');
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
        Schema::dropIfExists('hotels');
    }
}
