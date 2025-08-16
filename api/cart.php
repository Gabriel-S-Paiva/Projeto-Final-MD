<?php
session_start();
require_once '../includes/connect.php';

if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['error' => 'Not logged in']);
    exit;
}

$user_id = $_SESSION['user_id'];
$variant_id = intval($_POST['variant_id'] ?? 0);
$quantity = intval($_POST['quantity'] ?? 1);

// Find or create cart
$stmt = $pdo->prepare("SELECT id FROM cart WHERE user_id = ?");
$stmt->execute([$user_id]);
$cart = $stmt->fetch();
if (!$cart) {
    $pdo->prepare("INSERT INTO cart (user_id) VALUES (?)")->execute([$user_id]);
    $cart_id = $pdo->lastInsertId();
} else {
    $cart_id = $cart['id'];
}

// Add to cart_items
$stmt = $pdo->prepare("SELECT id, quantity FROM cart_items WHERE cart_id = ? AND module_id = (SELECT module_id FROM variants WHERE id = ?) AND variant_id = ?");
$stmt->execute([$cart_id, $variant_id, $variant_id]);
$item = $stmt->fetch();
if ($item) {
    $pdo->prepare("UPDATE cart_items SET quantity = quantity + ? WHERE id = ?")->execute([$quantity, $item['id']]);
} else {
    $pdo->prepare("INSERT INTO cart_items (cart_id, module_id, variant_id, quantity) VALUES (?, (SELECT module_id FROM variants WHERE id = ?), ?, ?)")->execute([$cart_id, $variant_id, $variant_id, $quantity]);
}
echo json_encode(['success' => true]);
?>