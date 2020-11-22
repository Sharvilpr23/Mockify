<?php

$dbservername = "localhost";
$dbusername = "root";
$dbpassword = "qazwsx2312!";
$dbname = "Mockify";

$conn = new mysqli($dbservername, $dbusername, $dbpassword, $dbname);

if ($conn -> connect_errno) {
    printf("Connect failed: %s\n", $conn->connect_error);
    exit();
}
   