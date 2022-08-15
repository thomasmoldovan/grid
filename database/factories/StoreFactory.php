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
            'location_id' => Location::inRandomOrder()->first()->id,
            // 'category_id' => Category::inRandomOrder()->first()->id,
            'name' => fake()->name(),
            'image' => "https://picsum.photos/200/300",
            'address' => fake()->address(),
            'link' => fake()->url(),
            'display' => 1,
            'status' => 1,
        ];
    }
}
