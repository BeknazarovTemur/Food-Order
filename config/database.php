<?php

session_start();

define('SITEURL', 'http://localhost:8000/');
define('DB_HOST', 'localhost');
define('DB_NAME', 'food-order');
define('DB_USER', 'root');
define('DB_PASS', '');

$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS) or die(mysqli_error()); //Database Connection
$db = mysqli_select_db($conn, DB_NAME) or die(mysqli_error()); //Selecting Database

?>