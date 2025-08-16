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

    // Optional: receive room dimensions and name
    $room_width = isset($data['room_width']) ? intval($data['room_width']) : null;
    $room_height = isset($data['room_height']) ? intval($data['room_height']) : null;
    $name = isset($data['name']) ? trim($data['name']) : null;

    // Insert simulation record
    $stmt = $pdo->prepare("INSERT INTO simulations (user_id, room_width, room_height, name, created_at) VALUES (?, ?, ?, ?, NOW())");
    $stmt->execute([$user_id, $room_width, $room_height, $name]);
    $simulation_id = $pdo->lastInsertId();

    // Insert simulation_items
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