<?php

namespace App\Http\Livewire;

use Illuminate\Http\Request;

trait WithImages
{
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
