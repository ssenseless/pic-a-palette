<?php
require_once "prepare_and_execute_sql.php";
session_start();

$userid = $_SESSION['userid'];
$query = prepare_and_execute_sql("SELECT * 
                                    FROM pic_a_palette.user_palettes
                                    WHERE user_id = $userid");
$numrows = mysqli_num_rows($query);


if ($numrows == 10) {
    echo -1;
} 
else {
    $_SESSION['paletteid'] = $numrows + 1;
    echo 1;
}