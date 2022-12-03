<?php
require "prepare_and_execute_sql.php";
session_start();

$userid = $_SESSION['userid'];

if (isset($_SESSION['paletteid'])) {
    $paletteid = $_SESSION['paletteid'];
    unset($_SESSION['paletteid']);
}
else {
    $paletteid = $_POST['paletteid'];
}


prepare_and_execute_sql("DELETE 
                            FROM pic_a_palette.user_palettes 
                            WHERE user_id = $userid AND
                                  palette_id = $paletteid");
prepare_and_execute_sql("DELETE 
                            FROM pic_a_palette.palette_count 
                            WHERE user_id = $userid AND
                                  palette_id = $paletteid");
prepare_and_execute_sql("DELETE 
                            FROM pic_a_palette.palette_hex
                            WHERE user_id = $userid AND
                                  palette_id = $paletteid");

if (isset($_SESSION['editflag']) && $_SESSION['editflag'] == true) {
    prepare_and_execute_sql("INSERT INTO pic_a_palette.user_palettes(user_id, palette_id, hex1, hex2, hex3, hex4, hex5, hex6, name)
                            SELECT user_id,
                                   $paletteid,
                                   hex1,
                                   hex2,
                                   hex3,
                                   hex4,
                                   hex5,
                                   hex6,
                                   name
                                FROM pic_a_palette.user_palettes
                                    WHERE user_id = $userid AND
                                          palette_id = -1");
    prepare_and_execute_sql("INSERT INTO pic_a_palette.palette_count(count, user_id, palette_id, color_type)
                                SELECT count,
                                       user_id,
                                       $paletteid,
                                       color_type
                                        FROM pic_a_palette.palette_count
                                        WHERE user_id = $userid AND
                                              palette_id = -1");
    prepare_and_execute_sql("INSERT INTO pic_a_palette.palette_hex(hex, user_id, palette_id, color_type)
                                SELECT hex,
                                       user_id,
                                       $paletteid,
                                       color_type
                                        FROM pic_a_palette.palette_hex
                                        WHERE user_id = $userid AND
                                              palette_id = -1");

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
    unset($_SESSION['editflag']);
}