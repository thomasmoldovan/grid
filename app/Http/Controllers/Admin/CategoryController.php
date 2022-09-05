<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function all() 
    {
        return view('admin.categories.index');
    }
}
