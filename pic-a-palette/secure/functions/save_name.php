<?php
require "prepare_and_execute_sql.php";
session_start();

$name = $_POST['name'];
$userid = $_SESSION['userid'];
$paletteid = $_SESSION['paletteid'];

prepare_and_execute_sql("UPDATE pic_a_palette.user_palettes
                            SET name = '$name'
                            WHERE user_id = $userid AND
                                  palette_id = $paletteid");