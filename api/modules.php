<?php
require_once '../includes/connect.php';

if (isset($_GET['id'])) {
    $stmt = $pdo->prepare("SELECT * FROM modules WHERE id = ?");
    $stmt->execute([$_GET['id']]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    // Get variants
    $vstmt = $pdo->prepare("SELECT * FROM variants WHERE module_id = ?");
    $vstmt->execute([$_GET['id']]);
    $product['variants'] = $vstmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($product);
    exit;
}

$stmt = $pdo->query("SELECT * FROM modules");
$modules = $stmt->fetchAll(PDO::FETCH_ASSOC);

header('Content-Type: application/json');
echo json_encode($modules);
?>