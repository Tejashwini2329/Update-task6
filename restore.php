<?php
include 'db.php';
header('Content-Type: application/json');

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    echo json_encode(["error" => "Unauthorized access"]);
    exit;
}

$id = intval($_POST['id']);
$stmt = $conn->prepare("SELECT name, category, price, description FROM product_history WHERE product_id=? ORDER BY updated_at DESC LIMIT 1");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$previousData = $result->fetch_assoc();

if ($previousData) {
    $stmt = $conn->prepare("UPDATE products SET name=?, category=?, price=?, description=? WHERE id=?");
    $stmt->bind_param("ssdsi", $previousData['name'], $previousData['category'], $previousData['price'], $previousData['description'], $id);
    $stmt->execute();

    echo json_encode(["message" => "Product restored successfully"]);
} else {
    echo json_encode(["error" => "No previous version found"]);
}
?>
