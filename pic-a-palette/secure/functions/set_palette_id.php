<?php
require "prepare_and_execute_sql.php";
session_start();

$_SESSION['paletteid'] = $_POST['paletteid'];
$_SESSION['editflag'] = true;

$userid = $_SESSION['userid'];
$paletteid = $_SESSION['paletteid'];

prepare_and_execute_sql("INSERT INTO pic_a_palette.user_palettes(user_id, palette_id, hex1, hex2, hex3, hex4, hex5, hex6, name)
                            SELECT user_id,
                                   -1,
                                   hex1,
                                   hex2,
                                   hex3,
                                   hex4,
                                   hex5,
                                   hex6,
                                   name
                                FROM pic_a_palette.user_palettes
                                    WHERE user_id = $userid AND
                                          palette_id = $paletteid");
prepare_and_execute_sql("INSERT INTO pic_a_palette.palette_count(count, user_id, palette_id, color_type)
                            SELECT count,
                                   user_id,
                                   -1,
                                   color_type
                                    FROM pic_a_palette.palette_count
                                    WHERE user_id = $userid AND
                                          palette_id = $paletteid");
prepare_and_execute_sql("INSERT INTO pic_a_palette.palette_hex(hex, user_id, palette_id, color_type)
                            SELECT hex,
                                   user_id,
                                   -1,
                                   color_type
                                    FROM pic_a_palette.palette_hex
                                    WHERE user_id = $userid AND
                                          palette_id = $paletteid");

echo 1;