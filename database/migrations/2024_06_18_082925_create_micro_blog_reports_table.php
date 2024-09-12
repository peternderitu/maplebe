<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('micro_blog_reports', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->unsignedInteger('micro_blogs_id')->nullable();
            $table->unsignedInteger('reporting_reasons_id')->nullable();
            $table->foreign('micro_blogs_id')->references('id')->on('micro_blogs');
            $table->foreign('reporting_reasons_id')->references('id')->on('reporting_reasons');
            
            $table->string('reason')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('micro_blog_reports');
    }
};
