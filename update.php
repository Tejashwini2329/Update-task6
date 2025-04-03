<?php
include 'db.php';
header('Content-Type: application/json');

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Get data from AJAX request
$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
$name = isset($_POST['name']) ? trim($_POST['name']) : '';
$category = isset($_POST['category']) ? trim($_POST['category']) : '';
$price = isset($_POST['price']) ? floatval($_POST['price']) : 0.0;
$description = isset($_POST['description']) ? trim($_POST['description']) : '';

if ($id == 0 || empty($name) || empty($category) || empty($description)) {
    echo json_encode(["error" => "Invalid input"]);
    exit;
}

// Prepare and execute the update query
$stmt = $conn->prepare("UPDATE products SET name=?, category=?, price=?, description=? WHERE id=?");
$stmt->bind_param("ssdsi", $name, $category, $price, $description, $id);

if ($stmt->execute()) {
    echo json_encode(["message" => "Product updated successfully"]);
} else {
    echo json_encode(["error" => "Update failed: " . $stmt->error]);
}
?>
