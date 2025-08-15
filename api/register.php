<?php
require_once '../includes/connect.php';

$data = json_decode(file_get_contents('php://input'), true);

$username = trim($data['username']);
$email = trim($data['email']);
$name = trim($data['name']);
$password = $data['password'];

if (!$username || !$email || !$name || !$password) {
    http_response_code(400);
    echo json_encode(['error' => 'Todos os campos são obrigatórios.']);
    exit;
}

$hash = password_hash($password, PASSWORD_DEFAULT);

try {
    $stmt = $pdo->prepare("INSERT INTO users (username, email, password_hash, name) VALUES (?, ?, ?, ?)");
    $stmt->execute([$username, $email, $hash, $name]);
    echo json_encode(['success' => true]);
} catch (PDOException $e) {
    http_response_code(400);
    echo json_encode(['error' => 'Username ou email já existe.']);
}
?>