<?php
$host = 'localhost';
$dbname = 'users_db';
$username = 'root';
$password = ''; // change if you have a MySQL password

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>