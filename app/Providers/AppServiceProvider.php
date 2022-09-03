<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Location;
use App\Models\Settings;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $settings = Settings::all();
        foreach ($settings as $setting) {
            $settings[$setting->name] = $setting->value;
        }

        View::share('settings', $settings);
    }
}
