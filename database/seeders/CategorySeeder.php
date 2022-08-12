<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
            Category::factory(3)->create()->each(function ($category) {
                Category::factory(1)->create(['parent_id' => Category::inRandomOrder()->first()]); // create subcategories
            });
        }
    }
}
