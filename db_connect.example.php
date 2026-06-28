<?php

$servername = "your_host";
$username = "your_username";
$password = "your_password";
$dbname = "your_database";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    mysqli_set_charset($conn, "utf8mb4");
} catch (Exception $e) {
    die("Connection failed.");
}
?>