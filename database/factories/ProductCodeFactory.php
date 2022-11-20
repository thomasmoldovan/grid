<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductCodeFactory extends Factory
{
    public function definition()
    {
        return [
            'product_id' => 1,
            'code' => substr(md5(rand()), 0, 6),
            'status' => 'active',
        ];
    }
}
