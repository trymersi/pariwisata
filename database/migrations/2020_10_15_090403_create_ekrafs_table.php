<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEkrafsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ekrafs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('kabupaten_id')->nullable()->comment('foreign key dari tabel kabupatens');
            $table->foreignId('kategori_ekraf_id');
            $table->string('nama');
            $table->string('alamat');
            $table->string('nomor_kontak');
            $table->string('jenis_usaha');
            $table->string('status');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('kabupaten_id')->references('id')->on('kabupatens')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ekrafs');
    }
}
