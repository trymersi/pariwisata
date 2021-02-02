<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObjekWisataTempatIbadahsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('objek_wisata_tempat_ibadahs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('objek_wisata_id')->nullable()->comment('foreign key dari tabel objekwisatas');
            $table->unsignedBigInteger('tempat_ibadah_id')->nullable()->comment('foreign key dari tabel tempat_ibadahs');
            $table->string('jarak');
            $table->timestamps();
            $table->foreign('objek_wisata_id')->references('id')->on('objek_wisatas')->onDelete('set null');
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
        Schema::dropIfExists('objek_wisata_tempat_ibadahs');
    }
}
