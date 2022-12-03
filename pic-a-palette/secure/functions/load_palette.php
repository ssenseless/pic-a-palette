<?php
require "prepare_and_execute_sql.php";
session_start();

$userid = $_SESSION['userid'];
$paletteid = $_SESSION['paletteid'];

$query = prepare_and_execute_sql("SELECT *
                                    FROM pic_a_palette.user_palettes
                                    WHERE user_id = $userid AND
                                          palette_id = $paletteid");
$row_num = mysqli_num_rows($query);
$row = $query->fetch_assoc();
if ($row_num == 0) {
    echo 0;
}
else {
    $retval = array(
        'a' => $row['hex1'],
        'b' => $row['hex2'],
        'c' => $row['hex3'],
        'd' => $row['hex4'],
        'e' => $row['hex5'],
        'f' => $row['hex6']
    );
    echo json_encode($retval);
}

