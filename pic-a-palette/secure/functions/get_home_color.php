<?php
require "./palettize.php";
header('Access-Control-Allow-Origin: http://localhost:3000');

$array = [];
$key = 'a';
$photo = substr($_POST['src'], -7);
$palette = new palettize("../data/permanent/" . $photo);

foreach ($palette->color as $color) {
    $array[$key] = $color->hex;
    $key++;
}

$json = json_encode($array);

echo $json;