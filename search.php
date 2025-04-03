<?php
include 'db.php';
header('Content-Type: application/json');

$id = intval($_POST['id']);
$stmt = $conn->prepare("SELECT name, category, price, description FROM products WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();


if ($data) {
    echo json_encode($data);
} else {
    echo json_encode(["error" => "Product not found"]);
}
?>
