<?php
$host = "localhost";
$user = "root";
$pass = ""; // default in XAMPP
$dbname = "memi"; // your database name

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
