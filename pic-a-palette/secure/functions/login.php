<?php
require "./prepare_and_execute_sql.php";
header('Access-Control-Allow-Origin: http://localhost:3000');

$username = $_POST["username"];
$password = $_POST["password"];

$query = prepare_and_execute_sql("SELECT *
                                    FROM pic_a_palette.user
                                    WHERE username = '$username' AND
                                          password = '$password'");

if (mysqli_num_rows($query) == 1) {
    session_start();

    $_SESSION["username"] = $username;
    $_SESSION["password"] = $password;
    $_SESSION["userid"] = $query->fetch_assoc()['userid'];
    
    echo 1;
} else {
    echo 0;
}