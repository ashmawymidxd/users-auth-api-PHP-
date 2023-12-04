<?php
ini_set('display_errors', 0);
session_start();

define('DB_TYPE', 'mysql');
define('DB_HOST', 'localhost');
define('DB_NAME', 'last');
define('DB_USER', 'root');
define('DB_PASSWORD', '');

$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Additional configuration or initialization code can go here

?>
