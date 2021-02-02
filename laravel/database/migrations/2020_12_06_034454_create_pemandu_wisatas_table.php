<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemanduWisatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemandu_wisatas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kabupaten_id')->nullable()->comment('foreign key dari tabel kabupatens');
            $table->unsignedBigInteger('objek_wisata_id')->nullable()->comment('foreign key dari tabel objekwisatas');
            $table->string('nama')->nullable()->comment("nama pemandu wisata");
            $table->string('bahasa')->nullable()->comment("bahasa bahasa yang dikuasai oleh pemandu wisata");
            $table->string('alamat')->nullable()->comment("Alamat dari pemandu wisata");
            $table->string('nomor_kontak')->nullable()->comment("nomor kontak dari pemandu wisata");
            $table->string('status')->nullable()->comment('statusnya');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('objek_wisata_id')->references('id')->on('objek_wisatas')->onDelete('set null');
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
        Schema::dropIfExists('pemandu_wisatas');
    }
}
