<?php
/**
 * Created by PhpStorm.
 * User: wac
 * Date: 24/05/18
 * Time: 09:27
 */

require("function_css_gen.php");
require ("my_scandir.php");
require ("loading.php");




/**
 * @param   string      $image          Image for check size
 * @param   bool        $resize         If is true resize all images
 * @param   int         $resize_value   Size used for resize all images
 * @return  array                       Contain image_X and image_y
 */
function 	getSizeImage($image, $resize = false, $resize_value = 0)
{
    $size = array();
    if ($resize === false) {
        $size[0] = (getimagesize($image))[0];
        $size[1] = (getimagesize($image))[1];
    } else if ($resize === true) {
        $size[0] = $resize_value;
        $size[1] = $resize_value;
    }
    return $size;
}

/**
 * @param resource  $sprite
 * @param string    $image_src
 * @param array     $size_img
 * @param array     $size_sprite
 * @param bool      $checkLine
 * add $image_src in $sprite with background transparent
 */
function 	mergeImage(&$sprite, $image_src, $size_img, $size_sprite/*, $checkLine*/)
{
    $source = $sprite;
    $image_src = imagecreatefrompng($image_src);
    $height_max = $size_img[1] > $size_sprite[1] ? $size_img[1] : $size_sprite[1];
    $img = imagecreatetruecolor($size_sprite[0] + $size_img[0]
        , $height_max);
    $background = imagecolorallocatealpha($img, 0, 0, 0, 127);

    imagefill($img, 0, 0, $background);
    imagesavealpha($img, true);
    imagecopy($img, $source, 0, 0, 0, 0, $size_sprite[0], $size_sprite[1]);
    imagecopy($img, $image_src, $size_sprite[0], 0, 0, 0, $size_img[0], $size_img[1]);
    imagedestroy($image_src);
    $sprite = $img;
}
/**
 * @param array $images
 */
function 	merge_helper($images, $output)
{
    $i = 1;
    foreach ($images as $key => $value) {
        show_status($i, count($images));
        if ($key == 0)
            $sprite = imagecreatefrompng($value);
        else {
            $size_img = (array)getSizeImage($value);
            imagepng($sprite, $output);
            $size_sprite = (array)getSizeImage($output);
            mergeImage($sprite, $value, $size_img, $size_sprite/*, false*/);
        }
        $i++;
    }
    imagepng($sprite, "sprite.png");
}

/**
 * @param $path_image
 * @return array
 */



