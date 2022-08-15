<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LocationController extends Controller
{

    protected $rules = [
        "name" => "required|unique:location|min:3|max:125"
    ];

    protected $messages = [
        "name.required" => "Please enter a location name",
        "name.unique" => "This location name is already in use",
        "name.min" => "The location name must be at least 3 characters long",
        "name.max" => "The location name must be less than 125 characters long"
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
        $location->name = $request->name;
        $location->active = 1;
        $location->save();

        $toaster_message = [
            "toaster_status" => "success",
            "toaster_title" => "Success",
            "toaster_message" => "Category successfully saved"
        ];

        return redirect()->back()->with($toaster_message);
    }

    public function delete(int $id) {

        $location = Location::find($id);

        if ($location->store()->count() > 0) {
            $toaster_message = [
                "toaster_status" => "error",
                "toaster_title" => "Error",
                "toaster_message" => "This location is currently in use and cannot be deleted"
            ];

            return redirect()->back()->with($toaster_message);
        }

        $location->delete();

        $toaster_message = [
            "toaster_status" => "success",
            "toaster_title" => "Success",
            "toaster_message" => "Location deleted"
        ];

        return redirect()->back()->with($toaster_message);
    }
}
