<?php
require "mixer.php";
require "palettize.php";

session_start();

$key = 'a';
$array = [];

$palette_to_mix = new palettize("../data/permanent/" . $_POST['src'] . ".jpg");
$color_array = $palette_to_mix->color;
unset($palette_to_mix);

$colors = mixer($_SESSION["userid"], 
                $_SESSION["paletteid"], 
                $color_array);

foreach ($colors as $hex) {
    $array[$key] = $hex;
    $key++;
}

echo json_encode($array);