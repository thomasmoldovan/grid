<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("description")->nullable();
            $table->string("value");
            $table->string("status")->default(1);
            $table->timestamps();
        });

        DB::insert("insert into `settings` (`name`, `value`, `status`) values('OPEN_ITEM_TARGET_WINDOW','_blank','0')");
        DB::insert("insert into `settings` (`name`, `value`, `status`) values('SOCIAL_LINKS_FACEBOOK','http://facebook.com','0')");
        DB::insert("insert into `settings` (`name`, `value`, `status`) values('SOCIAL_LINKS_TWITTER','http://twitter.com','0')");
        DB::insert("insert into `settings` (`name`, `value`, `status`) values('SOCIAL_LINKS_INSTAGRAM','http://instagram.com','0')");
        DB::insert("insert into `settings` (`name`, `value`, `status`) values('SOCIAL_LINKS_LINKEDIN','http://linkedin.com','0')");
        DB::insert("insert into `settings` (`name`, `value`, `status`) values('SETTINGS_WEBSITE_NAME','Laravela','1')");
        DB::insert("insert into `settings` (`name`, `value`, `status`) values('SETTINGS_WEBSITE_URL','','1')");
        DB::insert("insert into `settings` (`name`, `value`, `status`) values('SETTINGS_NEW_WINDOW_TARGET','_blank','1')");
        DB::insert("insert into `settings` (`name`, `value`, `status`) values('SETTINGS_DISLPAY_LOCATIONS','Yes','1')");
        DB::insert("insert into `settings` (`name`, `value`, `status`) values('SETTINGS_CACHE_TIME','86400','1')");
        DB::insert("insert into `settings` (`name`, `value`, `status`) values('CONTACT_ADDRESS','A108 Adam Street <br> New York, NY 535022<br>United States <br>','1')");
        DB::insert("insert into `settings` (`name`, `value`, `status`) values('CONTACT_PHONE','+1 5589 55488 55','1')");
        DB::insert("insert into `settings` (`name`, `value`, `status`) values('CONTACT_EMAIL','info@example.com','1')");
        DB::insert("insert into `settings` (`name`, `value`, `status`) values('CONTACT_DISPLAY','0','1')");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
