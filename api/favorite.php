<?php
session_start();
require_once '../includes/connect.php';

if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['error' => 'Not logged in']);
    exit;
}

$user_id = $_SESSION['user_id'];
$module_id = intval($_POST['module_id'] ?? $_GET['module_id'] ?? 0);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Toggle favorite
    $stmt = $pdo->prepare("SELECT 1 FROM favorites WHERE user_id = ? AND module_id = ?");
    $stmt->execute([$user_id, $module_id]);
    if ($stmt->fetch()) {
        $pdo->prepare("DELETE FROM favorites WHERE user_id = ? AND module_id = ?")->execute([$user_id, $module_id]);
        echo json_encode(['favorited' => false]);
    } else {
        $pdo->prepare("INSERT INTO favorites (user_id, module_id) VALUES (?, ?)")->execute([$user_id, $module_id]);
        echo json_encode(['favorited' => true]);
    }
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $stmt = $pdo->prepare("SELECT 1 FROM favorites WHERE user_id = ? AND module_id = ?");
    $stmt->execute([$user_id, $module_id]);
    echo json_encode(['favorited' => (bool)$stmt->fetch()]);
    exit;
}
?>