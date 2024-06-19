<?php
$dbhost = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "archi_db";

$connection = mysqli_connect($dbhost, $dbusername, $dbpassword,  $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
