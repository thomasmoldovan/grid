<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Location;
use Database\Seeders\LocationSeeder;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {

        $locations = Location::all();
        $categories = Category::whereColumn("id", "parent_id")->get();

        return view("/home", compact('locations', 'categories'));
    }
}
