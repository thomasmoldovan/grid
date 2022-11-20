<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('product_code', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id');
            $table->string("code");
            $table->string("status");
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_code');
    }
};
