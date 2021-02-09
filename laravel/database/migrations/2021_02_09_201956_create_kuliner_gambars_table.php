<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKulinerGambarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kuliner_gambars', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('kuliner_id')->nullable()->comment('foreign key dari tabel kuliner');
            $table->string('gambar')->default(1)->nullable()->comment('gambar');
            $table->string('sumber')->default('')->nullable()->comment('sumber gambar');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('kuliner_id')->references('id')->on('kuliners')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kuliner_gambars');
    }
}
