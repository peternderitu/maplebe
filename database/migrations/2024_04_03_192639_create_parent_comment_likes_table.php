<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParentCommentLikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parent_comment_likes', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->unsignedInteger('user_id');
            $table->unsignedInteger('parent_comment_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('parent_comment_id')->references('id')->on('parent_comments');
            
            // user_id INT,
            // comment_id INT,
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parent_comment_likes');
    }
}
