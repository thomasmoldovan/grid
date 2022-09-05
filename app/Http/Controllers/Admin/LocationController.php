<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class LocationController extends Controller
{
    public function all()
    {
        return view('admin.locations.index');
    }
}
