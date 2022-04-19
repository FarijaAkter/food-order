<?php

session_start();
ob_start();

//creare constants to store non repeatting values

define('LOCALHOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'food-order');


$conn = mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die(mysqli_error());//database connection

$db_select = mysqli_select_db($conn,DB_NAME) or die(mysqli_error());//selecting database
// $res= mysqli_query($conn, $sql) or die(mysqli_error());


?>