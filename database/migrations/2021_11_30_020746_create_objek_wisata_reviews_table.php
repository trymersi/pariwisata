<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObjekWisataReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('objek_wisata_reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('objek_wisata_id')->nullable()->comment('foreign key dari tabel objekwisatas');
            $table->string('nama')->nullable()->comment('nama pemberi review');
            $table->string('email')->nullable()->comment('email pemberi review');
            $table->string('rating')->nullable()->comment('rating dalam format angka 1-5');
            $table->string('ulasan')->nullable()->comment('ulasan dari pengguna');
            $table->string('status')->default(0)->comment('0 belum di setujui 1 sudah');
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
        Schema::dropIfExists('objek_wisata_reviews');
    }
}
