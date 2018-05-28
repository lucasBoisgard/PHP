<?php

require "makeSprite.php";


/*
 *  ****TIME****
 */
$time_start = microtime(true);


function 	check_args($argc, $argv)
{
    $name_sprite_output  = "sprite.png";
    $name_css_output     = "style.css";

    if ($argc > 1) {
        $option = $argv[1];
        if ($option == "-r" || $option == "-recursive")
            $pic = my_scanDir($argv[2], true);
        else if (($option == "-i") || substr($option, 0, 14) == "-output-image=")
        {
            $name_sprite_output = (substr($option, 14));
            $pic = my_scanDir($argv[2], false);
        } else if (($option == "-i") || substr($option, 0, 14) == "-output-style=")
        {
            $name_css_output = (substr($option, 14));
            $pic = my_scanDir($argv[2], false);
        } else if (!is_dir($option) || $option == '-h' || $option == '-help')
            echo file_get_contents("man");
        else
            $pic = my_scanDir($argv[1], false);
        if (is_array($pic)) {
            merge_helper($pic, $name_sprite_output);
            css_generator($pic, $name_css_output);
        }
    }
}

if ($argc > 1)
{
    check_args($argc, $argv);
}
else
    echo file_get_contents("man");


/*
 *  ****TIME****
 */
$time_end = microtime(true);
$time = $time_end - $time_start;
	echo $time . "s for exec\n";