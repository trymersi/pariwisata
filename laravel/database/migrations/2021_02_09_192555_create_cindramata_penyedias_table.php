<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCindramataPenyediasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cindramata_penyedias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('cindramata_id')->nullable()->comment('foreign key dari tabel cindramata');
            $table->unsignedBigInteger('ekraf_id')->nullable()->comment('foreign key dari tabel ekrafs');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('ekraf_id')->references('id')->on('ekrafs')->onDelete('set null');
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
        Schema::dropIfExists('cindramata_penyedias');
    }
}
