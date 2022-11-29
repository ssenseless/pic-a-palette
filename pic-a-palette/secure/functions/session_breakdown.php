<?php
header('Access-Control-Allow-Origin: http://localhost:3000');
session_start();
$user = $_SESSION['username'];
$id = $_SESSION['id'];
session_unset();
session_destroy();