<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{

    public function definition()
    {
        return [
            'parent_id' => 1,
            'icon' => 'bi bi-gem',
            'color' => "#".substr(md5(rand()), 0, 6),
            'name' => fake()->word(),
        ];
    }
}
