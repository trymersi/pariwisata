<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObjekWisataGambarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('objek_wisata_gambars', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('objek_wisata_id')->nullable()->comment('foreign key dari tabel objekwisatas');
            $table->integer('gambar')->default(1)->nullable()->comment('gambar');
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
        Schema::dropIfExists('objek_wisata_gambars');
    }
}
