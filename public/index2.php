<?php

// $img = imagecreate(500, 300);
// $bgcolor = imagecolorallocate($img, 150, 200, 180);
// $fontcolor = imagecolorallocate($img, 120, 60, 200);
// imagestring($img, 20, 150, 60, "Demo Text4", $fontcolor);
// // header("Content-Type: image/png");
// $image = imagepng($img, "images/fake/file.png");

$img = imagecreate(500, 300);
$bgcolor = imagecolorallocate($img, 150, 200, 180);
$fontcolor = imagecolorallocate($img, 120, 60, 200);
$unique_image_id = hexdec(uniqid());
imagestring($img, 20, 150, 60, $unique_image_id, $fontcolor);
// header("Content-Type: image/png");
$name = "images/fake/".$unique_image_id.".png";
$image = imagepng($img, $name);

