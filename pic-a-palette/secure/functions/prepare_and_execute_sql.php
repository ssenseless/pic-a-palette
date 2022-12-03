<?php
function prepare_and_execute_sql($sql) {
    $servername = "localhost";
    $username = "ssenseless";
    $password = "";
    $db = "pic_a_palette";

    //create connection
    $conn = new mysqli($servername, $username, $password, $db);

    //check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }

    $result = $conn->query($sql);

    return $result;
}