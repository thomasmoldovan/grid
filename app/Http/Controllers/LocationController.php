<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function all()
    {
        return view('admin.locations.all');
    }
}
