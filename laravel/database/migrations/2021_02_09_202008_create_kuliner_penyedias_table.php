<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKulinerPenyediasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kuliner_penyedias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('kuliner_id')->nullable()->comment('foreign key dari tabel kuliner');
            $table->unsignedBigInteger('ekraf_id')->nullable()->comment('foreign key dari tabel ekrafs');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('ekraf_id')->references('id')->on('ekrafs')->onDelete('set null');
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
        Schema::dropIfExists('kuliner_penyedias');
    }
}
