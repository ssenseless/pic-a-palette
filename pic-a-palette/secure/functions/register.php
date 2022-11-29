<?php
require "./prepare_and_execute_sql.php";
header('Access-Control-Allow-Origin: http://localhost:3000');

$username = $_POST["username"];
$password = $_POST["password"];

$query = prepare_and_execute_sql("SELECT *
                                    FROM pic_a_palette.user
                                    WHERE username = '$username'");
if (mysqli_num_rows($query) != 0) {
    echo 2;
} else {
    $query = prepare_and_execute_sql("INSERT INTO pic_a_palette.user(username, password)
                                        VALUES ('$username', '$password')");
    if (!$query) {
        echo 0;
    } else {
        $query = prepare_and_execute_sql("SELECT *
                                            FROM pic_a_palette.user
                                            WHERE username = '$username'");
        session_start();

        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        $_SESSION['userid'] =  $query->fetch_assoc()['userid'];

        echo 1;
    }
}