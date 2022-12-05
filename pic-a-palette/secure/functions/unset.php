<?php
require "prepare_and_execute_sql.php";
session_start();

$userid = $_SESSION['userid'];
unset($_SESSION['paletteid']);

if (isset($_SESSION['editflag'])) {
unset($_SESSION['editflag']);

prepare_and_execute_sql("DELETE 
                            FROM pic_a_palette.user_palettes
                            WHERE user_id = $userid
                            AND palette_id = -1");
prepare_and_execute_sql("DELETE 
                            FROM pic_a_palette.palette_hex
                            WHERE user_id = $userid
                            AND palette_id = -1");
prepare_and_execute_sql("DELETE 
                            FROM pic_a_palette.palette_count
                            WHERE user_id = $userid
                            AND palette_id = -1");
}