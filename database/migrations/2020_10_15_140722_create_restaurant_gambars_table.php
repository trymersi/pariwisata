<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRestaurantGambarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restaurant_gambars', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('restaurant_id')->nullable()->comment('foreign key dari tabel restaurants');
            $table->string('gambar')->nullable()->comment('gambar restaurant');
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
        Schema::dropIfExists('restaurant_gambars');
    }
}
