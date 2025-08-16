<?php
session_start();
require_once '../includes/connect.php';

if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['error' => 'Not logged in']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $user_id = $_SESSION['user_id'];
    $stmt = $pdo->prepare("
    SELECT ci.id, ci.quantity, m.name, m.image, v.color, v.width, v.height, v.depth,
           IFNULL(v.price, m.price) AS price
    FROM cart_items ci
    JOIN cart c ON ci.cart_id = c.id
    JOIN modules m ON ci.module_id = m.id
    JOIN variants v ON ci.variant_id = v.id
    WHERE c.user_id = ?
");
    $stmt->execute([$user_id]);
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];

    // Add to cart
    if (isset($_POST['variant_id']) && isset($_POST['quantity'])) {
        $variant_id = intval($_POST['variant_id']);
        $quantity = intval($_POST['quantity']);

        // Find or create cart
        $stmt = $pdo->prepare("SELECT id FROM cart WHERE user_id = ?");
        $stmt->execute([$user_id]);
        $cart = $stmt->fetch();
        if (!$cart) {
            $pdo->prepare("INSERT INTO cart (user_id) VALUES (?)")->execute([$user_id]);
            $cart_id = $pdo->lastInsertId();
        } else {
            $cart_id = $cart['id'];
        }

        // Add to cart_items
        $stmt = $pdo->prepare("SELECT id, quantity FROM cart_items WHERE cart_id = ? AND module_id = (SELECT module_id FROM variants WHERE id = ?) AND variant_id = ?");
        $stmt->execute([$cart_id, $variant_id, $variant_id]);
        $item = $stmt->fetch();
        if ($item) {
            $pdo->prepare("UPDATE cart_items SET quantity = quantity + ? WHERE id = ?")->execute([$quantity, $item['id']]);
        } else {
            $pdo->prepare("INSERT INTO cart_items (cart_id, module_id, variant_id, quantity) VALUES (?, (SELECT module_id FROM variants WHERE id = ?), ?, ?)")
                ->execute([$cart_id, $variant_id, $variant_id, $quantity]);
        }
        echo json_encode(['success' => true]);
        exit;
    }

    // Update quantity
    if (isset($_POST['cart_item_id']) && isset($_POST['quantity'])) {
        $cart_item_id = intval($_POST['cart_item_id']);
        $quantity = intval($_POST['quantity']);
        if ($quantity < 1) {
            http_response_code(400);
            echo json_encode(['error' => 'Quantidade inválida']);
            exit;
        }
        $stmt = $pdo->prepare("UPDATE cart_items SET quantity = ? WHERE id = ?");
        $stmt->execute([$quantity, $cart_item_id]);
        echo json_encode(['success' => true]);
        exit;
    }

    // Checkout logic
    if (isset($_POST['checkout'])) {
        $age = intval($_POST['age'] ?? 0);
        $address = trim($_POST['address'] ?? '');
        if ($age < 18 || !$address) {
            http_response_code(400);
            echo json_encode(['error' => 'É necessário ter 18+ anos e preencher a morada.']);
            exit;
        }
        // Validate stock and deduct
        $stmt = $pdo->prepare("
            SELECT ci.id, ci.quantity, v.id as variant_id, v.stock
            FROM cart_items ci
            JOIN cart c ON ci.cart_id = c.id
            JOIN variants v ON ci.variant_id = v.id
            WHERE c.user_id = ?
        ");
        $stmt->execute([$user_id]);
        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($items as $item) {
            if ($item['quantity'] > $item['stock']) {
                http_response_code(400);
                echo json_encode(['error' => 'Sem stock suficiente para um ou mais produtos.']);
                exit;
            }
        }
        // Deduct stock
        foreach ($items as $item) {
            $pdo->prepare("UPDATE variants SET stock = stock - ? WHERE id = ?")->execute([$item['quantity'], $item['variant_id']]);
        }
        // Optionally: create order record here
        // Clear cart
        $stmt = $pdo->prepare("DELETE FROM cart_items WHERE cart_id IN (SELECT id FROM cart WHERE user_id = ?)");
        $stmt->execute([$user_id]);
        echo json_encode(['success' => true]);
        exit;
    }
}
?>