<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $id = Category::get()->last() ? Category::get()->last()->id : 0;

        return [
            'parent_id' => $id + 1,
            'category_icon' => 'bi bi-gem',
            'category_color' => "#".substr(md5(rand()), 0, 6),
            'category_name' => fake()->word(),
        ];
    }
}
