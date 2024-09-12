<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;


class CreateDealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deals', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            
            $table->unsignedInteger('admin_id')->nullable(); //this is because an admin can also make a deal
            $table->unsignedInteger('category_id');
            $table->unsignedInteger('deal_owner_id')->nullable();
            $table->foreign('admin_id')->references('id')->on('admins');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('deal_owner_id')->references('id')->on('deal_owners');

            $table->string('title');
            $table->text('description');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->decimal('original_price', 10, 2);
            $table->string('discount_code')->nullable();
            $table->text('discount_url')->nullable();
            $table->decimal('discount', 10, 2); //this is percentage
            $table->decimal('discounted_price', 10, 2); //this is calculated by (original_price - (original_price * (discount/100)))
            $table->string('image_url')->nullable(); // Nullable as the image URL might not be set initially
            $table->string('logo_url')->nullable(); // Nullable as the image URL might not be set initially
            $table->string('brand_name')->nullable(); // Nullable as the do may not add a business name
            $table->integer('status')->default(2); // 1 - approved, 2 - not approved, 3 - rejected
            $table->integer('isAffiliate')->default(0); //0 - false, 1 - true
            $table->string('unique_deal_identifier')->default((string) Str::uuid());
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deals');
    }
}
