<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSadarWisataDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sadar_wisata_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sadar_wisata_id')->nullable()->comment('foreign key dari tabel sadar wisata');
            $table->unsignedBigInteger('desa_wisata_id')->nullable()->comment('foreign key dari tabel desawisata');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('sadar_wisata_id')->references('id')->on('sadar_wisatas')->onDelete('set null');
            $table->foreign('desa_wisata_id')->references('id')->on('desa_wisatas')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sadar_wisata_details');
    }
}
