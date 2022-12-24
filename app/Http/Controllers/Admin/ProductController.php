<?php

namespace App\Http\Controllers\Admin;

use App\Models\Store;
use App\Models\Category;
use App\Models\Product;
use App\Models\Image;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function __construct() {
        if (is_null(Auth::user())) return redirect("/");
    }

    public function all() {
        $products = Product::all();
        foreach ($products as $product) {
            $product->product_description = Str::limit($product->product_description, 100, "...");
        }
        return view("admin/products/index", compact("products"));
    }

    public function view($id) {
        $product = Product::with("category", "subcategory")->find($id);
        $product->views = $product->views + 1;
        $product->save();

        $images = Image::where("product_id", $id)->get();

        // $categories = Category::where("parent_id", null)->get();
        $stores = Store::where("display", 1)->get();
        $products = Product::all();
        // $locations = Location::all();

        return view("layouts/products/view", compact("product", "stores", "products", "images"));
    }

    public function create() {
        // $categories = Category::all();
        // $stores = Store::all();
        return view("admin/products/create");
    }

    public function add(Request $request) {
        if (empty($request)) return;

        $product = new Product();

        $product->category_id = (int)$request->category;
        $product->subcategory_id = 1;
        $product->store_id = (int)$request->store;

        // $product->product_type = 1;
        $product->product_name = $request->name;
        $product->product_description = $request->description;

        $product->product_quantity = (int)$request->quantity;
        $product->product_price = number_format($request->price, 2);
        $product->product_old_price = number_format($request->old_price, 2);

        // $product->display_discount = $request->display_discount == "on" ? true : false;
        // $product->hot = $request->hot == "on" ? true : false;
        // $product->deal_of_the_day = $request->deal_of_the_day == "on" ? true : false;

        $product->start_date = $request->start_date;
        $product->end_date = $request->end_date;

        $product->status_id = 1;

        if (!empty($request->product_image)) {
            $validate = $request->validate([
                "image" => "mimes:jpg,png"
            ],
            [
                "image.mimes" => "Invalid image type"
            ]);

            $last_images = $this->extract_images_from_request($request);
            $product->product_image = $last_images[0];
        }

        $product->save();

        if (!empty($last_images)) {
            foreach ($last_images as $key => $image) {
                $product_image = new Image();
                $product_image->product_id = $product->id;
                $product_image->name = $image;
                if ($key == 0) {
                    $product_image->default = true;
                }
                $product_image->save();
            }
        }

        $toaster_message = [
            "toaster_status" => "success",
            "toaster_title" => "Success",
            "toaster_message" => "Product successfully saved"
        ];

        return redirect()->route("all_products")->with($toaster_message);
    }

    public function edit($id) {
        if (!is_numeric($id)) return;

        // $product = Product::find($id);

        // $categories = Category::all();
        // $stores = Store::all();
        return view("admin/products/edit", compact("product", "categories", "stores"));
    }

    public function update(Request $request, $id) {
        if (empty($request) || !is_numeric($id)) return;

        $product = Product::with("images")->find($id);

        $product->category_id = (int)$request->category;
        $product->subcategory_id = 1;
        $product->store_id = (int)$request->store;

        // $product->product_type = 1;
        $product->product_name = $request->name;
        $product->product_description = $request->description;
        $product->product_quantity = (int)$request->quantity;
        $product->product_price = number_format($request->price, 2);
        $product->product_old_price = number_format($request->old_price, 2);

        $product->display_discount = $request->display_discount == "on" ? true : false;
        $product->hot = $request->hot == "on" ? true : false;
        $product->deal_of_the_day = $request->deal_of_the_day == "on" ? true : false;

        $product->start_date = $request->start_date;
        $product->end_date = $request->end_date;

        $product->status_id = 1;

        if (!empty($request->product_image)) {
            $validate = $request->validate([
                "product_image.*" => "mimes:jpg,png"
            ],
            [
                "product_image.mimes" => "Invalid image type"
            ]);

            try {
                foreach ($product->images as $image) {
                    unlink($image->name);
                    $delete_image = Image::find($image->id)->first()->delete();
                }
            } catch (\Throwable $th) {
                // Oh well :)
            }
            $last_images = $this->extract_images_from_request($request);
            $product->product_image = $last_images[0];
        }

        $product->save();

        if (!empty($last_images)) {
            foreach ($last_images as $key => $image) {
                $product_image = new Image();
                $product_image->product_id = $product->id;
                $product_image->name = $image;
                if ($key == 0) {
                    $product_image->default = true;
                }
                $product_image->save();
            }
        }

        $toaster_message = [
            "toaster_status" => "success",
            "toaster_title" => "Success",
            "toaster_message" => "Product updated"
        ];

        return redirect()->route("all_products")->with($toaster_message);
    }

    public function delete($id) {
        if (!is_numeric($id)) return;

        Product::find($id)->delete();

        $toaster_message = [
            "toaster_status" => "success",
            "toaster_title" => "Success",
            "toaster_message" => "Product deleted"
        ];

        return redirect()->route("all_products")->with($toaster_message);
    }

    public function getProductStoreLocation(Request $request) {
        $id = $request->input("store_id");
        if (!is_numeric($id)) return;

        $store = Store::find($id);
        $address = $store->address;

        return response()->json(["address" => $address]);
    }

    public function setProductDefaultImage(Request $request) {
        $image_path = $request->input("image_path");
        $image_path = str_replace("http://localhost/laravela/public/", "", $image_path);
        $product_id = $request->input("product_id");

        $image = Image::where([
            "product_id" => $product_id
        ])->update([
            "default" => false
        ]);

        $image = Image::where([
            "name" => $image_path,
            "product_id" => $product_id
        ])->first();
        $image->default = true;
        $image->save();

        $product = Product::where([
            "id" => $product_id
        ])->first();
        $product->product_image = $image_path;
        $product->save();

        $toaster_message = [
            "toaster_status" => "success",
            "toaster_title" => "Success",
            "toaster_message" => "Image set as default"
        ];

        return response()->json(["message" => $toaster_message]);
    }

    public function extract_images_from_request(Request $request) {
        if (empty($request)) return;

        // extract multiple images
        $images = $request->file("product_image");
        $last_images = [];
        foreach ($images as $image) {
            $unique_image_id = hexdec(uniqid());
            $image_extension = strtolower($image->getClientOriginalExtension());
            $image_name = $unique_image_id.".".$image_extension;
            $upload_location = "";
            $image->move($upload_location, $image_name);
            $last_images[] = $upload_location.$image_name;
        }

        return $last_images;
    }
}
