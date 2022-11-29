<?php

require_once "../../../secure/functions/mixer.php";
require_once "../../../secure/functions/palettize.php";

$num = 16;

$palettize = new palettize("../../../secure/data/permanent/1" . sprintf('%02d', $num) . ".jpg");
$palette = mixer(1, 1, $palettize->color);



?>
<table>
    <thead>
        <tr>
            <th></th>
            <?php
            for ($i = 0; $i < 6; $i++) {
                echo '<th>Color ' . $i + 1 . '</th>';
            }
            ?>
        </tr>
    </thead>
    <tbody>
        <tr>
            <?php 
            echo '<td>RGB</td>';
            for ($i = 0; $i < 6; $i++) {
                echo '<td>(' . $palette[$i]->r . ', ' . $palette[$i]->g . ', ' . $palette[$i]->b . ')</td>';
            }
            ?>
        </tr>
        <tr>
            <?php 
            echo '<td>HSV</td>';
            for ($i = 0; $i < 6; $i++) {
                echo '<td>(' . round($palette[$i]->h) . ', ' . round($palette[$i]->s * 100) . '%, ' . round($palette[$i]->v * 100) . '%)</td>';
            }
            ?>
        </tr>
        <tr>
            <?php 
            echo '<td>HEX</td>';
            for ($i = 0; $i < 6; $i++) {
                echo '<td>' . $palette[$i]->hex . '</td>';
            }
            ?>
        </tr>
        <tr>
            <td></td>
            <?php
            for ($i = 0; $i < 6; $i++) {
                echo '<td style = "background-color:' . $palette[$i]->hex . '"></td>';
            }
            ?>
        </tr>
    </tbody>
</table>

<style>
    table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
        padding: 10px;
}
</style>
