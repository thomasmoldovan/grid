<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('image', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->references('id')->on('product');
            $table->string("name");
            $table->boolean("default");
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('image');
    }
};
