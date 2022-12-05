<?php
require 'prepare_and_execute_sql.php';
session_start();

$userid = $_SESSION['userid'];
$query = prepare_and_execute_sql("SELECT *
                                    FROM pic_a_palette.user_palettes
                                    WHERE user_id = $userid
                                    ORDER BY palette_id");

$retval = array();
$index = 1;
while ($row = $query->fetch_assoc()) {
    if ($row == null) {
        break;
    }
    array_push($retval, array(
        "name" => $row['name'],
        "a" => $row['hex1'],
        "b" => $row['hex2'],
        "c" => $row['hex3'],
        "d" => $row['hex4'],
        "e" => $row['hex5'],
        "f" => $row['hex6'],
        "paletteid" => $row['palette_id']
    ));
}
echo json_encode($retval);
