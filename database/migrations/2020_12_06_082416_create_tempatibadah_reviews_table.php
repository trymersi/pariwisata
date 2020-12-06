<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTempatibadahReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tempatibadah_reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tempat_ibadah_id')->nullable()->comment('foreign key dari tabel Hotels');
            $table->string('nama')->nullable()->comment('nama pemberi review');
            $table->string('email')->nullable()->comment('email pemberi review');
            $table->string('rating')->nullable()->comment('rating dalam format angka 1-5');
            $table->string('ulasan')->nullable()->comment('ulasan dari pengguna');
            $table->string('status')->default(0)->comment('0 belum di setujui 1 sudah');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('tempat_ibadah_id')->references('id')->on('tempat_ibadahs')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tempatibadah_reviews');
    }
}
