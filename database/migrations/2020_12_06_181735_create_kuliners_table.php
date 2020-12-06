<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKulinersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kuliners', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kabupaten_id')->nullable()->comment('foreign key dari tabel kabupatens');
            $table->string('alamat')->nullable()->comment('alamat dari objek wisata');
            $table->string('title')->nullable()->comment('nama judul');
            $table->text('isi')->comment('isi artikel');
            $table->string('meta_description');
            $table->string('meta_keyword');
            $table->string('slug');
            $table->string('thumbnail');
            $table->string('status')->default(0)->nullable()->comment('status verifikasi objek wisata; 0 untuk diajukan');
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
        Schema::dropIfExists('kuliners');
    }
}
