<?php
session_start();
require_once '../includes/connect.php';

if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['error' => 'Not logged in']);
    exit;
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // User info
    $stmt = $pdo->prepare("SELECT username, email, name, address, role, age FROM users WHERE id = ?");    $stmt->execute([$user_id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Favorites
    $favStmt = $pdo->prepare("
        SELECT m.id, m.name, m.image, v.color, v.width, v.height, v.depth
        FROM favorites f
        JOIN modules m ON f.module_id = m.id
        JOIN variants v ON v.module_id = m.id
        WHERE f.user_id = ?
    ");
    $favStmt->execute([$user_id]);
    $favorites = $favStmt->fetchAll(PDO::FETCH_ASSOC);

    // Simulations
    $simStmt = $pdo->prepare("SELECT id, name, room_width, room_height FROM simulations WHERE user_id = ?");
    $simStmt->execute([$user_id]);
    $simulations = $simStmt->fetchAll(PDO::FETCH_ASSOC);

    // For each simulation, load its items
    foreach ($simulations as &$sim) {
        $itemStmt = $pdo->prepare("
            SELECT si.id, si.module_id, m.name, m.image, si.x, si.y, si.w, si.h, si.rotation, si.scale
            FROM simulation_items si
            JOIN modules m ON si.module_id = m.id
            WHERE si.simulation_id = ?
        ");
        $itemStmt->execute([$sim['id']]);
        $sim['items'] = $itemStmt->fetchAll(PDO::FETCH_ASSOC);
    }

    echo json_encode([
        'username' => $user['username'],
        'email' => $user['email'],
        'name' => $user['name'],
        'address' => $user['address'],
        'role' => $user['role'],
        'age' => $user['age'],
        'favorites' => $favorites,
        'simulations' => $simulations
    ]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $stmt = $pdo->prepare("UPDATE users SET name = ?, email = ?, address = ?, age = ? WHERE id = ?");
    $stmt->execute([
        $data['name'] ?? '',
        $data['email'] ?? '',
        $data['address'] ?? '',
        isset($data['age']) ? intval($data['age']) : null,
        $user_id
    ]);
    echo json_encode(['success' => true]);
    exit;
}
?>