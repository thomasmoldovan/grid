<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LocationController extends Controller
{

    protected $rules = [
        "location_name" => "required|unique:locations|min:3|max:125"
    ];

    protected $messages = [
        "location_name.required" => "Please enter a location name",
        "location_name.unique" => "This location name is already in use",
        "location_name.min" => "The location name must be at least 3 characters long",
        "location_name.max" => "The location name must be less than 125 characters long"
    ];

    public function all()
    {
        return view('admin.locations.all');
    }

    // public function edit($id) {
    //     if (!is_numeric($id)) return;

    //     $current_location = Location::find($id);
    //     return view("admin/locations/edit", compact("current_location"));
    // }

    public function add(Request $request) {
        if (!$request->isMethod('post') || empty($request)) return;

        $validation = Validator::make($request->all(), $this->rules, $this->messages);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $location = new Location();
        $location->location_name = $request->location_name;
        $location->active = 1;
        $location->save();

        $toaster_message = [
            "toaster_status" => "success",
            "toaster_title" => "Success",
            "toaster_message" => "Category successfully saved"
        ];

        return redirect()->back()->with($toaster_message);
    }
}
