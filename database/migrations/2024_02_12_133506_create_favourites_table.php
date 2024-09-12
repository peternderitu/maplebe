<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFavouritesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('favourites', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->unsignedInteger('user_id');
            $table->unsignedInteger('deal_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('deal_id')->references('id')->on('deals')->onDelete('cascade');

            $table->unique(['user_id', 'deal_id']); // Ensuring uniqueness of user_id and deal_id combination

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('favourites');
    }
}
