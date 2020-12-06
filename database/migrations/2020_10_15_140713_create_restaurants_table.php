<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRestaurantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restaurants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('kabupaten_id')->nullable()->comment('foreign key dari tabel kabupatens');
            $table->unsignedBigInteger('objek_wisata_id')->nullable()->comment('foreign key dari tabel objekwisatas');
            $table->string('nama')->nullable()->comment('nama restaurant');
            $table->string('slug');
            $table->text('deskripsi')->nullable()->comment('deskripsi restaurant');
            $table->string('alamat')->nullable()->comment('alamat restaurant');
            $table->string('gambar')->nullable()->comment('gambar restaurant');
            $table->string('nomor_kontak')->nullable()->comment('nomor kontak restaurant');
            $table->integer('halal')->default(1)->nullable()->comment('status halal dari restaurant; 1 untuk halal 0 untuk tidak');
            $table->string('latitude')->nullable()->comment('titik latitude restaurant');
            $table->string('longitude')->nullable()->comment('titik longitude restaurant');
            $table->integer('status')->default(0)->nullable()->comment('status pengajuan restaurant; 0 untuk diajukan');
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
        Schema::dropIfExists('restaurants');
    }
}
