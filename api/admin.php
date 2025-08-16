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
    $modules = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($modules as &$mod) {
        $variantStmt = $pdo->prepare("SELECT * FROM variants WHERE module_id = ?");
        $variantStmt->execute([$mod['id']]);
        $mod['variants'] = $variantStmt->fetchAll(PDO::FETCH_ASSOC);
        $mod['stock'] = array_sum(array_column($mod['variants'], 'stock'));
    }
    echo json_encode($modules);
    exit;
}

if ($action === 'add_product') {
    $data = json_decode(file_get_contents('php://input'), true);
    $stmt = $pdo->prepare("INSERT INTO modules (name, image, width, height, depth, description, type, color, compatible_with, price) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([
        $data['name'], $data['image'], $data['width'], $data['height'], $data['depth'],
        $data['description'] ?? '', $data['type'] ?? '', $data['color'] ?? '', $data['compatible_with'] ?? '', $data['price']
    ]);
    echo json_encode(['success' => true]);
    exit;
}

if ($action === 'edit_product') {
    $data = json_decode(file_get_contents('php://input'), true);
    $stmt = $pdo->prepare("UPDATE modules SET name=?, image=?, width=?, height=?, depth=?, description=?, type=?, color=?, compatible_with=?, price=? WHERE id=?");
    $stmt->execute([
        $data['name'], $data['image'], $data['width'], $data['height'], $data['depth'],
        $data['description'] ?? '', $data['type'] ?? '', $data['color'] ?? '', $data['compatible_with'] ?? '', $data['price'], $data['id']
    ]);
    echo json_encode(['success' => true]);
    exit;
}

if ($action === 'delete_product') {
    $id = intval($_POST['id'] ?? $_GET['id'] ?? 0);
    $stmt = $pdo->prepare("DELETE FROM modules WHERE id=?");
    $stmt->execute([$id]);
    echo json_encode(['success' => true]);
    exit;
}

if ($action === 'restock_product') {
    $id = intval($_POST['id'] ?? $_GET['id'] ?? 0);
    $amount = intval($_POST['amount'] ?? $_GET['amount'] ?? 1);
    // Restock all variants for this module
    $stmt = $pdo->prepare("UPDATE variants SET stock = stock + ? WHERE module_id=?");
    $stmt->execute([$amount, $id]);
    echo json_encode(['success' => true]);
    exit;
}

if ($action === 'restock_variant') {
    $id = intval($_POST['id'] ?? $_GET['id'] ?? 0);
    $amount = intval($_POST['amount'] ?? $_GET['amount'] ?? 1);
    $stmt = $pdo->prepare("UPDATE variants SET stock = stock + ? WHERE id=?");
    $stmt->execute([$amount, $id]);
    echo json_encode(['success' => true]);
    exit;
}

if ($action === 'edit_variant') {
    $data = json_decode(file_get_contents('php://input'), true);
    $stmt = $pdo->prepare("UPDATE variants SET color=?, width=?, height=?, depth=?, stock=?, price=? WHERE id=?");
    $stmt->execute([
        $data['color'], $data['width'], $data['height'], $data['depth'], $data['stock'], $data['price'], $data['id']
    ]);
    echo json_encode(['success' => true]);
    exit;
}

if ($action === 'add_variant') {
    $data = json_decode(file_get_contents('php://input'), true);
    $stmt = $pdo->prepare("INSERT INTO variants (module_id, color, width, height, depth, stock, price) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([
        $data['module_id'], $data['color'], $data['width'], $data['height'], $data['depth'], $data['stock'], $data['price']
    ]);
    echo json_encode(['success' => true]);
    exit;
}

if ($action === 'users') {
    $stmt = $pdo->query("SELECT id, username, name, email, role, age FROM users");
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
    exit;
}

if ($action === 'edit_user') {
    $data = json_decode(file_get_contents('php://input'), true);
    $stmt = $pdo->prepare("UPDATE users SET name=?, email=?, age=?, role=? WHERE id=?");
    $stmt->execute([
        $data['name'], $data['email'], $data['age'], $data['role'], $data['id']
    ]);
    echo json_encode(['success' => true]);
    exit;
}


if ($action === 'delete_user') {
    $id = intval($_POST['id'] ?? $_GET['id'] ?? 0);

    // Delete related records
    $pdo->prepare("DELETE FROM order_items WHERE order_id IN (SELECT id FROM orders WHERE user_id=?)")->execute([$id]);
    $pdo->prepare("DELETE FROM orders WHERE user_id=?")->execute([$id]);
    $pdo->prepare("DELETE FROM cart_items WHERE cart_id IN (SELECT id FROM cart WHERE user_id=?)")->execute([$id]);
    $pdo->prepare("DELETE FROM cart WHERE user_id=?")->execute([$id]);
    $pdo->prepare("DELETE FROM favorites WHERE user_id=?")->execute([$id]);
    $pdo->prepare("DELETE FROM simulations WHERE user_id=?")->execute([$id]);
    // Now delete the user
    $stmt = $pdo->prepare("DELETE FROM users WHERE id=?");
    if ($stmt->execute([$id])) {
        echo json_encode(['success' => true]);
    } else {
        http_response_code(500);
        echo json_encode(['error' => 'Erro ao eliminar utilizador.']);
    }
    exit;
}

if ($action === 'change_role') {
    $id = intval($_POST['id'] ?? $_GET['id'] ?? 0);
    $role = $_POST['role'] ?? $_GET['role'] ?? 'user';
    $stmt = $pdo->prepare("UPDATE users SET role=? WHERE id=?");
    $stmt->execute([$role, $id]);
    echo json_encode(['success' => true]);
    exit;
}
?>