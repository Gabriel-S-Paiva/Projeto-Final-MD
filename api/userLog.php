<?php
require_once '../includes/connect.php';
session_start();

$data = json_decode(file_get_contents('php://input'), true);

$username = trim($data['username'] ?? '');
$password = $data['password'] ?? '';

$stmt = $pdo->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
$stmt->execute([$username, $username]);
$user = $stmt->fetch();

if ($user && password_verify($password, $user['password_hash'])) {
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['role'] = $user['role']; // <-- Add this line
    echo json_encode(['success' => true, 'role' => $user['role']]);
} else {
    http_response_code(401);
    echo json_encode(['error' => 'Credenciais inválidas.']);
}