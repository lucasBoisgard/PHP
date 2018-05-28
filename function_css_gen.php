<?php
/**
 * Created by PhpStorm.
 * User: lucas
 * Date: 24/05/18
 * Time: 07:48
 */
function    css_generator(array $name_images, $output/*, array $position*/)
{
    $i = 0;
    $pos = [0, "", 0, ""];
    $css = "";
    //$res = 0;
    foreach ($name_images as $key => $value) {
        $w = getSizeImage($value)[0];
        $h = getSizeImage($value)[1];
        if ($key > 0) {
            $pos[0] -= $w;
            $pos[1] = "px";
        }
        $css .= ".img" . ++$i . "\n{\n\twidth: $w;\n\theight: $h";
        $css .= " ;\n\tbackground-position: $pos[0]$pos[1] $pos[2];\n}\n";
    }
       // var_dump($pos);
    file_put_contents("css/$output" , $css);
}