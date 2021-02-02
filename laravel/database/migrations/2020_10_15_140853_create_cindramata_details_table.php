<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCindramataDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cindramata_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('cindramata_id')->nullable()->comment('foreign key dari tabel cindramatas');
            $table->string('nama')->nullable()->comment('nama cindramata');
            $table->string('gambar')->nullable()->comment('gambar cindramata');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('cindramata_id')->references('id')->on('cindramatas')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cindramata_details');
    }
}
