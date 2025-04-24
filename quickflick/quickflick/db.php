<?php
$host = '127.0.0.1';
$port = 8111;
$user = 'root';
$password = ''; 
$dbname = 'movie_project';

$conn = new mysqli($host, $user, $password, $dbname, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
