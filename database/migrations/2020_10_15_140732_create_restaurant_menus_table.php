<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRestaurantMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restaurant_menus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('restaurant_id')->nullable()->comment('foreign key dari tabel restaurants');
            $table->string('nama')->nullable()->comment('nama menu restaurant');
            $table->string('deskripsi')->nullable()->comment('deskripsi menu restaurant');
            $table->string('gambar')->nullable()->comment('gambar menu restaurant');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('restaurant_id')->references('id')->on('restaurants')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('restaurant_menus');
    }
}
