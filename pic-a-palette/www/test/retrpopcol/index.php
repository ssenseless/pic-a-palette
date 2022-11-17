<?php

require "../../../secure/functions/palettize.php";

//bayesian probability func.? call Ben.

for ($num = 1; $num <= 41; $num++) {
    $palette = new palettize("../../../secure/data/permanent/1" . sprintf('%02d', $num) . ".jpg");

    // $image_num = 'Image 1' . sprintf('%02d', $num);
    // echo $image_num;
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
                    echo '<td>(' . $palette->color[$i]->r . ', ' . $palette->color[$i]->g . ', ' . $palette->color[$i]->b . ')</td>';
                }
                ?>
            </tr>
            <tr>
                <?php 
                echo '<td>HSV</td>';
                for ($i = 0; $i < 6; $i++) {
                    echo '<td>(' . round($palette->color[$i]->h) . ', ' . round($palette->color[$i]->s * 100) . '%, ' . round($palette->color[$i]->v * 100) . '%)</td>';
                }
                ?>
            </tr>
            <tr>
                <?php 
                echo '<td>HEX</td>';
                for ($i = 0; $i < 6; $i++) {
                    echo '<td>' . $palette->color[$i]->hex . '</td>';
                }
                ?>
            </tr>
            <tr>
                <td></td>
                <?php
                for ($i = 0; $i < 6; $i++) {
                    echo '<td style = "background-color:' . $palette->color[$i]->hex . '"></td>';
                }
                ?>
            </tr>
        </tbody>
    </table>
<?php
}
?>

<style>
    table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
        padding: 10px;
}
</style>