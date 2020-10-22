<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLabelMetasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('label_metas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('label_id')->nullable()->comment('foreign key dari tabel label');
            $table->unsignedBigInteger('post_id')->nullable()->comment('foreign key dari tabel post');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('label_id')->references('id')->on('labels')->onDelete('set null');
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('label_metas');
    }
}
