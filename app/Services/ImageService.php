<?php

namespace App\Http\Service;

use Illuminate\Http\Request;

class ImageService
{
    public function extract_images_from_request(Request $request, $field) {
        if (empty($request)) return;

        // extract multiple images
        $images = $request->file($field);
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