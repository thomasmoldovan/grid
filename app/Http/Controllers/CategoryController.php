<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    protected $rules = [
        "category_name" => "required|unique:categories|min:3|max:125"
    ];

    protected $messages = [
        "category_name.required" => "Category name is required",
        "category_name.unique" => "Category name is already taken",
        "category_name.min" => "Category name must be at least 3 characters",
        "category_name.max" => "Category name must be less than 125 characters"
    ];

    public function all() {
        $categories = Category::with("parent")->get();
        $parents = Category::whereColumn("id", "parent_id")->get();

        return view('admin.categories.all', compact('categories', 'parents'));
    }

    public function add(Request $request) {
        if (empty($request)) return;

        $validation = Validator::make($request->all(), $this->rules, $this->messages);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $category = new Category();
        $category->parent_id = $request->parent ? $request->parent : 0;
        $category->category_icon = $request->category_icon;
        $category->category_color = $request->category_color;
        $category->category_name = $request->category_name;
        $category->save();

        if (is_null($request->parent)) {
            $category->parent_id = $category->id;
            $category->save();            
            return redirect()->route('categories.all')->with('success', 'Category added successfully');
        } else {
            return redirect()->route('categories.all')->with('success', 'Subcategory added successfully');
        }

        $toaster_message = [
            "toaster_status" => "success",
            "toaster_title" => "Success",
            "toaster_message" => "Category successfully saved"
        ];

        return redirect()->back()->with($toaster_message);
    }

    public function edit($id = null) {
        if (!is_numeric($id)) return;

        $current_category = Category::find($id);
        $categories = Category::whereColumn("id", "parent_id")->get();
        return view("admin.categories.edit", compact("current_category", "categories"));
    }

    public function update(Request $request, $id) {
        if (empty($request) || !is_numeric($id)) return;

        $current_category = Category::find($id);

        $update_data = [];
        if ($request->category_name != $current_category->category_name) {
            $validation = Validator::make($request->all(), $this->rules, $this->messages);

            if ($validation->fails()) {
                return redirect()->back()->withErrors($validation)->withInput();
            }

            $update_data["category_name"] = $request->category_name;
        }

        if ($request->parent_id != $current_category->parent_id) {
            $update_data["parent_id"] = $request->parent_id ? $request->parent_id : $current_category->id;
        } else {
            $update_data["parent_id"] = $current_category->parent_id;
        }

        if ($request->category_icon != $current_category->category_icon) $update_data["category_icon"] = $request->category_icon;
        if ($request->category_color != $current_category->category_color) $update_data["category_color"] = $request->category_color;

        if (count($update_data) > 0) {
            Category::find($id)->update($update_data);
            $toaster_message = "Category successfully updated";
        } else {
            $toaster_message = "Nothing to update";
        }

        $toaster_message = [
            "toaster_status" => "success",
            "toaster_title" => "Success",
            "toaster_message" => $toaster_message
        ];

        return redirect()->route("categories.all")->with($toaster_message);
    }

    public function delete($id = null) {
        if (!is_numeric($id)) return;

        Category::find($id)->delete();

        $toaster_message = [
            "toaster_status" => "success",
            "toaster_title" => "Success",
            "toaster_message" => "Category deleted"
        ];

        return redirect()->route("categories.all")->with($toaster_message);
    }
}
