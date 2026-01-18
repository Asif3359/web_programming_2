<?php
$hostName = "127.0.0.1";
$userName = "root";
$password = "";
$database = "test_db";

$conn = mysqli_connect($hostName, $userName, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
