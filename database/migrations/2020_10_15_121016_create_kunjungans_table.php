<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKunjungansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kunjungans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('objek_wisata_id')->nullable()->comment('foreign key dari tabel objek_wisatas');
            $table->integer('lokal')->nullable()->comment('nilai pengunjung lokal');
            $table->integer('internasional')->nullable()->comment('nilai pengunjung internasional');
            $table->string('bulan')->nullable()->comment('bulan saat pengunjung datang masing-masing antara lokal atau internasional');
            $table->string('tahun')->nullable()->comment('tahun saat pengunjung datang masing-masing antara lokal atau internasional');
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
        Schema::dropIfExists('kunjungans');
    }
}
