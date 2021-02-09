<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingAplikasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setting_aplikasis', function (Blueprint $table) {
            $table->id();
            $table->string('nama_aplikasi');
            $table->string('versi_aplikasi');
            $table->text('tentang_kami');
            $table->text('ketentuan');
            $table->text('kebijakan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('setting_aplikasis');
    }
}
