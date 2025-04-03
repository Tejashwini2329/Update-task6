<?php


session_start();
$servername = "localhost";
$username = "root";
$password = "";
$database = "product_db";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if user is logged in
function checkRole($role) {
    return isset($_SESSION['role']) && $_SESSION['role'] === $role;
}



?>
