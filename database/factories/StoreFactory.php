<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Location;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Store>
 */
class StoreFactory extends Factory
{

    public function definition()
    {
        return [
            'category_id' => Category::inRandomOrder()->first()->id,
            'location_id' => Location::inRandomOrder()->first()->id,
            'store_name' => fake()->name(),
            'store_image' => "https://api.lorem.space/image/movie?w=160&h=80",
            'store_address' => fake()->address(),
            'store_link' => fake()->url(),
            'display' => 1,
            'status_id' => 1,
        ];
    }
}
