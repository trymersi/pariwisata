<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('kabupaten_id')->nullable()->comment('foreign key dari tabel kabupatens');
            $table->unsignedBigInteger('objek_wisata_id')->nullable()->comment('foreign key dari tabel objek_wisatas');
            $table->string('nama')->nullable()->comment('nama event');
            $table->string('slug');
            $table->date('tanggal_mulai')->nullable()->comment('tanggal mulai event');
            $table->date('tanggal_selesai')->nullable()->comment('tanggal selesai event');
            $table->string('gambar_header')->nullable()->comment('gambar untuk header page event');
            $table->integer('status')->default(0)->nullable()->comment('status pengajuan event; 0 untuk diajukan');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('kabupaten_id')->references('id')->on('kabupatens')->onDelete('set null');
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
        Schema::dropIfExists('events');
    }
}
