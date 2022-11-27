<?php
require "palettize.php";

$array = [];
$key = 'a';
$photo = substr($_GET['src'], -7);
$palette = new palettize("../data/permanent/" . $photo);

foreach ($palette->color as $color) {
    $array[$key] = $color->hex;
    $key++;
}

$json = json_encode($array);

echo $json;