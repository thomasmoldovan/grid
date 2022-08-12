<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function all()
    {
        return view('admin.stores.all');
    }
}
