<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->unsignedInteger('deal_owner_id');
            $table->foreign('deal_owner_id')->references('id')->on('deal_owners');
            $table->unsignedInteger('deal_id');
            $table->foreign('deal_id')->references('id')->on('deals');
            $table->integer('quantity');
            $table->float('amount'); //for accounting purposes
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
