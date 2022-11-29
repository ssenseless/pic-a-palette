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

    $username = 'ssenseless';
    $password = 'oh yeah';

    $result = $conn->query($sql);

    if ($result === false) {
        die("error");
    }
    return $result;
}