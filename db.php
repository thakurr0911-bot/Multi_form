<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "test";

$link = new mysqli($servername, $username, $password, $database);

if ($link->connect_error) {
    die("Connection failed: " . $link->connect_error);
}
?>

