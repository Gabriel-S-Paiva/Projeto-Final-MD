<?php
session_start();
require_once '../includes/connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['user_id'])) {
        http_response_code(401);
        echo json_encode(['error' => 'Not logged in']);
        exit;
    }
    $user_id = $_SESSION['user_id'];
    $data = json_decode(file_get_contents('php://input'), true);

    // Handle delete
    if (isset($data['action']) && $data['action'] === 'delete' && isset($data['id'])) {
        $stmt = $pdo->prepare("DELETE FROM simulations WHERE id = ? AND user_id = ?");
        $stmt->execute([$data['id'], $user_id]);
        $stmt2 = $pdo->prepare("DELETE FROM simulation_items WHERE simulation_id = ?");
        $stmt2->execute([$data['id']]);
        echo json_encode(['success' => true]);
        exit;
    }

    // Handle rename
    if (isset($data['action']) && $data['action'] === 'rename' && isset($data['id'], $data['name'])) {
        $stmt = $pdo->prepare("UPDATE simulations SET name = ? WHERE id = ? AND user_id = ?");
        $stmt->execute([$data['name'], $data['id'], $user_id]);
        echo json_encode(['success' => true]);
        exit;
    }

    // Save simulation
    $room_width = isset($data['room_width']) ? intval($data['room_width']) : null;
    $room_height = isset($data['room_height']) ? intval($data['room_height']) : null;
    $name = isset($data['name']) ? trim($data['name']) : null;

    $stmt = $pdo->prepare("INSERT INTO simulations (user_id, room_width, room_height, name, created_at) VALUES (?, ?, ?, ?, NOW())");
    $stmt->execute([$user_id, $room_width, $room_height, $name]);
    $simulation_id = $pdo->lastInsertId();

    if (!empty($data['modules']) && is_array($data['modules'])) {
        $itemStmt = $pdo->prepare("INSERT INTO simulation_items (simulation_id, module_id, x, y, w, h, rotation, scale) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        foreach ($data['modules'] as $mod) {
            $itemStmt->execute([
                $simulation_id,
                intval($mod['module']['id']),
                intval($mod['x']),
                intval($mod['y']),
                intval($mod['w']),
                intval($mod['h']),
                floatval($mod['rotation']),
                floatval($mod['scale'])
            ]);
        }
    }

    echo json_encode(['success' => true, 'simulation_id' => $simulation_id]);
    exit;
}
?>