<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "friend_manager";

// Kapcsolat létrehozása
$conn = new mysqli($servername, $username, $password, $dbname);
// Kapcsolat ellenőrzése
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

