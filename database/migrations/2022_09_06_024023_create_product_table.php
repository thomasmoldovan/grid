<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->references('id')->on('category');
            $table->foreignId('store_id')->references('id')->on('store');
            $table->integer("product_type");
            $table->string("product_name");
            $table->text("product_description");
            $table->string("product_image");
            $table->integer("product_quantity")->nullable();
            $table->integer("product_price");
            $table->integer("product_old_price")->nullable();
            $table->boolean("display_discount")->nullable();
            $table->boolean("hot")->nullable();
            $table->boolean("deal_of_the_day")->nullable();
            $table->timestamp("start_date")->nullable();
            $table->timestamp("end_date")->nullable();
            $table->integer("views")->default(0);
            $table->integer("status")->nullable()->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('product');
    }
};
