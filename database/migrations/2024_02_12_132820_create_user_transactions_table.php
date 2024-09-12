<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->unsignedInteger('user_id');
            $table->unsignedInteger('deal_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('deal_id')->references('id')->on('deals');

            $table->decimal('transaction_amount', 10, 2); // Calculated using original price - discounted price from Deals table
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_transactions');
    }
}
