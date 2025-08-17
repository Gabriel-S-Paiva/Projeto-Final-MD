<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    http_response_code(403);
    echo json_encode(['error' => 'Acesso negado']);
    exit;
}

$targetDir = "../Assets/Imgs/";
if (!isset($_FILES['image']) || !isset($_POST['filename'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Ficheiro ou nome em falta']);
    exit;
}

$filename = preg_replace('/[^a-zA-Z0-9_\-\.]/', '', $_POST['filename']);
$targetFile = $targetDir . $filename;

if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
    echo json_encode(['success' => true, 'path' => "Assets/Imgs/$filename"]);
} else {
    http_response_code(500);
    echo json_encode(['error' => 'Falha ao guardar imagem']);
}
?>