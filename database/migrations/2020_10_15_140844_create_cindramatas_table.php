<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCindramatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cindramatas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('kabupaten_id')->nullable()->comment('foreign key dari tabel kabupatens');
            $table->unsignedBigInteger('objek_wisata_id')->nullable()->comment('foreign key dari tabel objekwisatas');
            $table->string('nama')->nullable()->comment('nama cindramata');
            $table->string('slug');
            $table->string('nomor_kontak')->nullable()->comment('nomor kontak cindramata');
            $table->string('gambar')->nullable()->comment('gambar cindramata');
            $table->string('alamat')->nullable()->comment('alamat hotel');
            $table->integer('status')->default(0)->nullable()->comment('status pengajuan tempat ibadah; 0 untuk diajukan');
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
        Schema::dropIfExists('cindramatas');
    }
}
