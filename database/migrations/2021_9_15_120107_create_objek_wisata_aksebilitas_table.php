<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObjekWisataAksebilitasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('objek_wisata_aksebilitas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('objek_wisata_id')->nullable()->comment('foreign key dari tabel objekwisatas');
            $table->string('kondisi_jalan_menuju')->nullable()->comment('kondisi jalan menuju objek wisata');
            $table->string('kondisi_jalan_dalam')->nullable()->comment('kondisi jalan didalam objek wisata');
            $table->string('jenis_transportasi')->nullable()->comment('jenis tranportasi ke objek wisata');
            $table->string('biaya')->nullable()->comment('biaya menuju ke objek wisata');
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
        Schema::dropIfExists('objek_wisata_aksebilitas');
    }
}
