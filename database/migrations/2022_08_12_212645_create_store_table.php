<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('store', function (Blueprint $table) {
            $table->id();
            $table->foreignId('location_id')->references('id')->on('location');
            // $table->foreignId('category_id')->references('id')->on('category');
            $table->string('name');
            $table->string('image');
            $table->string('address');
            $table->string('link');
            $table->boolean('display')->nullable()->default(0);
            $table->boolean('status')->nullable()->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('store');
    }
};
