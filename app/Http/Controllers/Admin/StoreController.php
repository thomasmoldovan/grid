<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\Store;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StoreController extends Controller
{

    protected $rules = [
        "name" => "required|unique:store|min:3|max:125",
        "image" => "required|mimes:jpg,jpeg,png"
    ];

    protected $messages = [
        "name.required" => "You must enter a store name",
        "name.unique" => "Store already exists",
        "name.max" => "Store name to long. Maximum 125 characters allowed",
        "name.min" => "Store name to short. Enter at least 3 characters",
        "image.required" => "Store image required",
        "image.mimes" => "Invalid image type"
    ];

    public function all()
    {
        // $stores = Store::oldest()->paginate(10);
        // $locations = Location::where("active", "=", 1)->get();

        return view('admin.stores.index');
    }

    public function add(Request $request) {
        if (empty($request)) return;

        $validation = Validator::make($request->all(), $this->rules, $this->messages);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $last_image = $this->extract_image_from_request($request);

        $store = new Store();
        $store->location_id = $request->location_id;
        $store->name = $request->name;
        $store->address = $request->address;
        $store->link = $request->link;
        $store->image = $last_image;
        $store->display = $request->display == "on" ? true : false;
        // $store->created_at = Carbon::now();

        $store->save();

        $toaster_message = [
            "toaster_status" => "success",
            "toaster_title" => "Success",
            "toaster_message" => "Store successfully saved"
        ];

        return redirect()->back()->with($toaster_message);
    }

    public function edit(int $id) {
        $store = Store::find($id);

        if (empty($store)) {
            // store not found
            $toaster_message = [
                "toaster_status" => "error",
                "toaster_title" => "Error",
                "toaster_message" => "Store not found"
            ];

            return redirect()->back()->with($toaster_message);
        }

        $locations = Location::where("active", "=", 1)->get();

        return view("admin/stores/edit", compact("store", "locations"));
    }

    public function update(Request $request, $id) {
        if (empty($request) || !is_numeric($id)) return;

        $store = Store::find($id);

        // if ($store->name != $request->name) {
            unset($this->rules['image']);
            $validation = Validator::make($request->all(), $this->rules, $this->messages);

            if ($validation->fails()) {
                return redirect()->back()->withErrors($validation)->withInput();
            }

            // $update_data["name"] = $request->name;
        // }

        if (!empty($request->image)) {
            $request->validate(["image" => "mimes:jpg,jpeg,png"]);

            try {
                unlink($store->image);
            } catch (\Throwable $th) {
                // image not found so nothing to do
            }

            $store->image =$this->extract_image_from_request($request);
        }

        // if ($request->address != $store->address) $update_data["address"] = $request->address;
        // if ($request->link != $store->link) $update_data["link"] = $request->link;
        // if ($request->display == "on") $update_data["display"] = true; else $update_data["display"] = false;
        // if ($request->location_id != $store->location_id) $update_data["location_id"] = $request->location_id;

        $store->location_id = $request->location_id;
        $store->name = $request->name;
        $store->address = $request->address;
        $store->link = $request->link;
        $store->display = $request->display == "on" ? true : false;
        // $store->created_at = Carbon::now();

        $store->save();

        // if (count($update_data) > 0) {
        //     Store::find($id)->update($update_data);
        //     $toaster_message = "Store successfully updated";
        // } else {
        //     $toaster_message = "Nothing to update";
        // }

        $toaster_message = [
            "toaster_status" => "success",
            "toaster_title" => "Success",
            "toaster_message" => "Store successfully updated"
        ];

        return redirect()->route("stores.all")->with($toaster_message);
    }

    public function delete(int $id) {
        $store = Store::find($id);

        if (empty($store)) {
            // store not found
            $toaster_message = [
                "toaster_status" => "error",
                "toaster_title" => "Error",
                "toaster_message" => "Store not found"
            ];

            return redirect()->back()->with($toaster_message);
        }

        // if store found, we check to see if it has any products
        // if it does, we do cannot delete the store
        // if ($store->products()->count() > 0) {
        //     $toaster_message = [
        //         "toaster_status" => "error",
        //         "toaster_title" => "Error",
        //         "toaster_message" => "Store has products. Cannot delete store"
        //     ];

        //     return redirect()->back()->with($toaster_message);
        // } 
        
        // we delete the store image from the server
        try {
            unlink($store->image);
        } catch (\Throwable $th) {
            // image not found so nothing to do
        }

        $store->delete();
        $toaster_message = [
            "toaster_status" => "success",
            "toaster_title" => "Success",
            "toaster_message" => "Store successfully deleted"
        ];

        return redirect()->back()->with($toaster_message);
    }

    public function extract_image_from_request(Request $request) {
        if (empty($request)) return;

        $current_store_image = $request->file('image');
        $unique_image_id = hexdec(uniqid());
        $image_extension = strtolower($current_store_image->getClientOriginalExtension());
        $image_name = $unique_image_id.".".$image_extension;
        $upload_location = "images/stores/";
        $current_store_image->move($upload_location, $image_name);
        $last_image = $upload_location.$image_name;

        return $last_image;
    }
}
