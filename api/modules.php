<?php
require_once '../includes/connect.php'; // PDO $pdo

$stmt = $pdo->query("SELECT * FROM modules");
$modules = $stmt->fetchAll(PDO::FETCH_ASSOC);

header('Content-Type: application/json');
echo json_encode($modules);
?>