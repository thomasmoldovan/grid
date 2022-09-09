<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Location;
use Database\Seeders\LocationSeeder;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public $locations;
    public $categories;

    public function __construct()
    {
        $this->locations = Location::where("active", "=", 1)->get();
        $this->categories = Category::whereColumn("id", "parent_id")->get();
    }

    public function index() 
    {
        return view("/home", [
            'locations' => $this->locations, 
            'categories' => $this->categories
        ]);
    }

    public function browseCategory($category, $subcategory = "")
    {
        // $locations = Location::where("active", "=", 1)->get();
        // $categories = Category::whereColumn("id", "parent_id")->get();

        // $all_categories = Category::groupBy("parent_id")->get();
        $all_categories = Category::whereColumn("id", "parent_id")->with("children")->get();

        return view("front.categories.browse-category", [
            'locations' => $this->locations, 
            'categories' => $this->categories, 
            'all_categories' => $all_categories
        ]);
    }
}
