<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\ProductCode;
use Illuminate\Database\Seeder;

class ProductCodeSeeder extends Seeder
{
    public function run()
    {
        ProductCode::factory(10)->create();
    }
}
