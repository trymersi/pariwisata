<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObjekWisataDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('objek_wisata_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('objek_wisata_id')->nullable()->comment('foreign key dari tabel objekwisatas');
            $table->string('lembaga_pengelola')->nullable()->comment('lembaga pengelola dari objek wisata');
            $table->string('jenis_pemasaran')->nullable()->comment('jenis pemasaran dari objek wisata');
            $table->string('peraturan_uu')->nullable()->comment('peraturan perundang-undangan dari objek wisata');
            $table->string('stakeholders')->nullable()->comment('stakeholders dari objek wisata');
            $table->string('kontak_nama')->nullable()->comment('kontak nama dari pengelola objek wisata');
            $table->string('kontak_telepon')->nullable()->comment('kontak telepon dari pengelola objek wisata');
            $table->string('harga_tiket')->nullable()->comment('harga tiket dari objek wisata');
            $table->integer('halal')->default(1)->nullable()->comment('status halal dari objek wisata; 1 untuk halal 0 untuk tidak');
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
        Schema::dropIfExists('objek_wisata_details');
    }
}
