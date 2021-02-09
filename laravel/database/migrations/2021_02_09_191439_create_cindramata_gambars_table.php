<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCindramataGambarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cindramata_gambars', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('cindramata_id')->nullable()->comment('foreign key dari tabel cindramata');
            $table->string('gambar')->default(1)->nullable()->comment('gambar');
            $table->string('sumber')->default('')->nullable()->comment('sumber gambar');
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
        Schema::dropIfExists('cindramata_gambars');
    }
}
