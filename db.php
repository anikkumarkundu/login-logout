<?php
$host = "localhost";
$user = "root";       // XAMPP default
$pass = "AnikMysql2005@";           // XAMPP default
$dbname = "myformdb";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error);
}
?>
