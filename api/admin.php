<?php
session_start();
require_once '../includes/connect.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    http_response_code(403);
    echo json_encode(['error' => 'Acesso negado']);
    exit;
}

$action = $_GET['action'] ?? $_POST['action'] ?? '';

if ($action === 'deliveries') {
    // Get all completed carts/orders
    $stmt = $pdo->query("SELECT o.id, o.user_id, o.date, u.name as user_name, o.total FROM orders o JOIN users u ON o.user_id = u.id ORDER BY o.date DESC");
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($orders as &$order) {
        $itemStmt = $pdo->prepare("SELECT m.name, oi.quantity FROM order_items oi JOIN modules m ON oi.module_id = m.id WHERE oi.order_id = ?");
        $itemStmt->execute([$order['id']]);
        $order['items'] = $itemStmt->fetchAll(PDO::FETCH_ASSOC);
    }
    echo json_encode($orders);
    exit;
}

if ($action === 'products') {
    $stmt = $pdo->query("SELECT * FROM modules");
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
    exit;
}

if ($action === 'users') {
    $stmt = $pdo->query("SELECT id, username, name, email, role, age FROM users");
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
    exit;
}

// Add/edit/delete/restock products, edit/delete/change role users, etc.
// Implement each action as needed, always returning JSON and updating DB.
?>