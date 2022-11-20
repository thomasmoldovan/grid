<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{

    public function run()
    {
        Category::factory(7)->create();

        $categories = Category::all();

        foreach($categories as &$category) {
            $category->parent_id = $category->id;
            $category->save();
        }

        foreach($categories as &$category) {
            Category::factory(random_int(2,4))->create(['parent_id' => $category->id]); // create subcategories
        }

        // Category::factory(1)
        //     ->has(Category::factory()->count(3))
        //     ->create();
    }
}
