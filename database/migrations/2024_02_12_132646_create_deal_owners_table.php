<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDealOwnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deal_owners', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->string('email')->unique();
            $table->string('password');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('profile_picture')->nullable(); // Nullable as profile picture might not be set initially
            $table->string('payment_customer_id')->nullable(); // One needs this in order to charge a customer later
            $table->string('payment_saved_status')->nullable(); // After generating the customer id, this should be 'processing'
                                                                // After successfully saving card, this should change to 'saved'
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deal_owners');
    }
}
