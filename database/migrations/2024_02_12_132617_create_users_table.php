<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->string('username')->unique()->nullable();
            $table->string('email')->unique();
            $table->string('studentEmail')->unique()->nullable();
            $table->boolean('studentEmailVerified')->default(false);//0 is false and 1 is true
            $table->string('password');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('profile_picture')->nullable(); // Nullable as profile picture might not be set initially
            $table->index(['email', 'username']); // Indexing for faster search
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
