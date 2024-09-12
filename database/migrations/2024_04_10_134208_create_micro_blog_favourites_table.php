<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMicroBlogFavouritesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('micro_blog_favourites', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->unsignedInteger('user_id');
            $table->unsignedInteger('micro_blog_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('micro_blog_id')->references('id')->on('micro_blogs')->onDelete('cascade');

            $table->unique(['user_id', 'micro_blog_id']); // Ensuring uniqueness of user_id and micro_blog_id combination
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('micro_blog_favourites');
    }
}
