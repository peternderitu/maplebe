<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMicroBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('micro_blogs', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->unsignedInteger('category_id')->nullable();
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('category_id')->references('id')->on('categories');
            

            $table->string('title');
            $table->text('description');
            $table->dateTime('end_date')->nullable();
            $table->dateTime('start_date')->nullable();
            $table->string('image_url')->nullable();
            $table->text('discount_url'); 
            $table->string('discount_code')->nullable();
            $table->decimal('original_price', 10, 2);
            $table->decimal('discounted_price', 10, 2); //this is percentage
            $table->integer('status')->default(1);// 1 - approved, 2 - not approved, 3 - rejected
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('micro_blogs');
    }
}
