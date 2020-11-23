<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObjekWisatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('objek_wisatas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('kabupaten_id')->nullable()->comment('foreign key dari tabel kabupatens');
            $table->unsignedBigInteger('kecamatan_id')->nullable()->comment('foreign key dari tabel kecamatans');
            $table->string('nama')->nullable()->comment('nama dari objek wisata');
            $table->string('slug');
            $table->text('deskripsi')->nullable()->comment('deskripsi dari objek wisata');
            $table->string('jenis')->nullable()->comment('jenis jenis,alam atau buatan');
            $table->string('video_promosi')->nullable()->comment('link video promosi yang dari youtube ex: <iframe width="1237" height="696" src="https://www.youtube.com/embed/3oL4e24Dzyk" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>');
            $table->string('gambar_header')->nullable()->comment('gambar untuk header page objek wisata');
            $table->string('desa')->nullable()->comment('desa dari objek wisata');
            $table->string('latitude')->nullable()->comment('titik latitude dari objek wisata');
            $table->string('longitude')->nullable()->comment('titik longitude dari objek wisata');
            $table->string('alamat')->nullable()->comment('alamat dari objek wisata');
            $table->string('status')->default(0)->nullable()->comment('status verifikasi objek wisata; 0 untuk diajukan');
            $table->string('jarak_provinsi')->nullable()->comment('jarak provinsi ke objek wisata');
            $table->string('jarak_kabuten')->nullable()->comment('jarak kabupaten ke objek wisata');
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
        Schema::dropIfExists('objek_wisatas');
    }
}
