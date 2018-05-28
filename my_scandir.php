<?php

/**
 * @param  string  $path        Path access of images
 * @param  bool    $recursive   Check if this function search recursively or not in the directory
 * @return array                Array of all images
 */
function    my_scanDir($path, $recursive = true)
{
    static $files_png = array();
    static $i = 0;
    $dir = opendir($path);
    while ($file = readdir($dir)) {
        if ($file !== "." && $file !== "..") {
            if (is_dir("$path/$file") && $recursive == true) {
                my_scanDir("$path/$file");
            }
            else if (is_file("$path/$file"))
            {
                if (exif_imagetype("$path/$file") == 3)
                {
                    $files_png[$i] = "$path/$file";
                    $i++;
                }
            }
        }
    }
    return $files_png;
}