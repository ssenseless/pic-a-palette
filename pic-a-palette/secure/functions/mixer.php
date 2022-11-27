<?php

require "color.php";
require "prepare_and_execute_sql.php";

function mixer($userid, $paletteid, $color_array) {
    $how_many_colors = array();
    $final_six_color_assoc = array();
    $final_six_colors = array();

    foreach ($color_array as $color) {
        $query = prepare_and_execute_sql("SELECT *
                                            FROM palette_hex
                                            WHERE color_type = '$color->type' AND
                                                  user_id = $userid AND
                                                  palette_id = $paletteid");
        if ($query->num_rows == 0) {
            prepare_and_execute_sql("INSERT INTO palette_count(count, user_id, palette_id, color_type)
                                        VALUES (1, $userid, $paletteid, '$color->type')");
            prepare_and_execute_sql("INSERT INTO palette_hex(hex, user_id, palette_id, color_type)
                                        VALUES ('$color->hex', $userid, $paletteid, '$color->type')");
        }
        else if ($query->num_rows < 6) {
            prepare_and_execute_sql("INSERT INTO palette_hex(hex, user_id, palette_id, color_type)
            VALUES ('$color->hex', $userid, $paletteid, '$color->type')");

            prepare_and_execute_sql("UPDATE palette_count 
                                        SET count = count + 1
                                        WHERE color_type = '$color->type' AND
                                              user_id = $userid AND
                                              palette_id = $paletteid");
        }
        else {
            mix($userid, $paletteid, $color);
        }
    }
    
    $query = prepare_and_execute_sql("SELECT * 
                                        FROM pic_a_palette.palette_count 
                                        ORDER BY count DESC 
                                        LIMIT 6");

    while ($row = $query->fetch_assoc()) {
        array_push($final_six_color_assoc, $row);
    }

    $query = prepare_and_execute_sql("SELECT SUM(inner_table.count) AS count 
                                        FROM (SELECT count 
                                                FROM palette_count 
                                                ORDER BY count DESC 
                                                LIMIT 6) AS inner_table");
    $total = $query->fetch_assoc()['count'];
    for ($i = 0, $j = 0; $i < 6 && $j < 6; $j++) {
        $count = 1;
        $numer = $final_six_color_assoc[$j]['count'];

        if ($numer == null) {
            echo "oh shit";
        }
        
        $percent = round(($numer / $total) * 100);
        $i++;

        if ($percent >= 25) {
            $count++;
            $i++;
            if ($percent >= 40) {
                $count++;
                $i++;
                if ($percent >= 55) {
                    $count++;
                    $i++;
                    if ($percent >= 70) {
                        $count++;
                        $i++;
                        if ($percent >= 85) {
                            $count++;
                            $i++;
                        }
                    }
                }
            }
        }
        array_push($how_many_colors, array(
            'color_type' => $final_six_color_assoc[$j]['color_type'], 
            'count' => $count)
        );
    }

    foreach ($how_many_colors as $row) {
        $row_color_type = $row['color_type'];
        $row_count = $row['count'];

        $query = prepare_and_execute_sql("SELECT hex 
                                            FROM palette_hex
                                            WHERE user_id = $userid AND
                                                palette_id = $paletteid AND
                                                color_type = '$row_color_type' 
                                            ORDER BY RAND()
                                            LIMIT $row_count");
        while ($color = $query->fetch_assoc()) {
            array_push($final_six_colors, new color(-1, -1, -1, $color['hex']));
        }
    }
    
    return $final_six_colors;
}

function mix($userid, $paletteid, $color) {
    $query = prepare_and_execute_sql("SELECT hex
                                        FROM palette_hex
                                        WHERE user_id = $userid AND
                                              palette_id = $paletteid AND
                                              color_type = '$color->type'");

    $flag = 0;

    for ($i = 0; $i < 6; $i++) {
        $temp_col = new color(-1, -1, -1, $query->fetch_assoc()['hex']);

        //b + (c(a-b)) / 10
        $r = round($temp_col->r + ((rand(2, 8) * ($color->r - $temp_col->r)) / 10));
        $g = round($temp_col->g + ((rand(2, 8) * ($color->g - $temp_col->g)) / 10));
        $b = round($temp_col->b + ((rand(2, 8) * ($color->b - $temp_col->b)) / 10));
        $mixed_col = new color($r, $g, $b, null);

        if ($mixed_col->type != $color->type) {
            mixer($userid, $paletteid, array($mixed_col));
            $flag++;
        }
        else {
            prepare_and_execute_sql("UPDATE palette_hex
                                        SET hex = '$mixed_col->hex'
                                        WHERE user_id = $userid AND
                                              palette_id = $paletteid AND
                                              color_type = '$mixed_col->type' AND
                                              hex = '$color->hex'");
        }
    }
    if ($flag < 4) {
        prepare_and_execute_sql("UPDATE palette_count 
                                    SET count = count + 1
                                    WHERE color_type = '$mixed_col->type' AND
                                          user_id = $userid AND
                                          palette_id = $paletteid");
    }
}