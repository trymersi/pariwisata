<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kabupaten_id')->nullable()->comment('foreign key dari tabel kabupatens');
            $table->unsignedBigInteger('objek_wisata_id')->nullable()->comment('foreign key dari tabel objekwisatas');
            $table->unsignedBigInteger('post_category_id')->nullable()->comment('foreign key dari tabel post categories');
            $table->string('title')->nullable()->comment('nama judul');
            $table->string('slug');
            $table->text('isi')->comment('isi artikel');
            $table->string('thumbnail');
            $table->string('meta_description');
            $table->string('meta_keyword');
            $table->integer('status')->default(0)->nullable()->comment('status pengajuan berita; 0 untuk diajukan');
            $table->integer('dilihat')->default(0)->nullable()->comment('jumlah berapa kali artikel dilihat');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('kabupaten_id')->references('id')->on('kabupatens')->onDelete('set null');
            $table->foreign('objek_wisata_id')->references('id')->on('objek_wisatas')->onDelete('set null');
            $table->foreign('post_category_id')->references('id')->on('post_categories')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
