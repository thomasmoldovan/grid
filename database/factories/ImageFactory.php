<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $img = imagecreate(500, 300);
        $bgcolor = imagecolorallocate($img, 150, 200, 180);
        $fontcolor = imagecolorallocate($img, 120, 60, 200);
        imagestring($img, 20, 150, 60, "Demo Text4", $fontcolor);
        header("Content-Type: image/png");
        $unique_image_id = hexdec(uniqid());
        $name = "images/fake/".$unique_image_id.".png";
        imagepng($img, $name);

        return [
            "product_id" => 1,
            "name" => $name
        ];
    }
}
