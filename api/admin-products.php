<?php
declare(strict_types=1);

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, X-Admin-Pin');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit;
}

// PIN authentication via header
define('ADMIN_PIN', '1234');
$pin = $_SERVER['HTTP_X_ADMIN_PIN'] ?? '';
if ($pin !== ADMIN_PIN) {
    http_response_code(401);
    echo json_encode(['success' => false, 'error' => 'Unauthorized']);
    exit;
}

$config = ['host' => '127.0.0.1', 'user' => 'root', 'pass' => '', 'name' => 'products'];
$db = @new mysqli($config['host'], $config['user'], $config['pass'], $config['name']);
if ($db->connect_errno) {
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => 'Database connection failed']);
    exit;
}
$db->set_charset('utf8mb4');

$method = $_SERVER['REQUEST_METHOD'];
$resource = $_GET['resource'] ?? 'products';

// ── CATEGORIES ──────────────────────────────────────────────────────────────
if ($resource === 'categories') {
    if ($method === 'GET') {
        $rows = [];
        $res = $db->query('SELECT category_id, name, description FROM categories ORDER BY category_id');
        while ($row = $res->fetch_assoc()) $rows[] = $row;
        echo json_encode(['success' => true, 'data' => $rows]);
    } elseif ($method === 'POST') {
        $body = json_decode(file_get_contents('php://input'), true);
        $name = trim($body['name'] ?? '');
        $desc = trim($body['description'] ?? '');
        if (!$name) { http_response_code(400); echo json_encode(['success' => false, 'error' => 'Name required']); exit; }
        $stmt = $db->prepare('INSERT INTO categories (name, description) VALUES (?, ?)');
        $stmt->bind_param('ss', $name, $desc);
        $stmt->execute();
        echo json_encode(['success' => true, 'category_id' => $db->insert_id]);
    } elseif ($method === 'PUT') {
        $id = (int)($_GET['id'] ?? 0);
        $body = json_decode(file_get_contents('php://input'), true);
        $name = trim($body['name'] ?? '');
        $desc = trim($body['description'] ?? '');
        $stmt = $db->prepare('UPDATE categories SET name=?, description=? WHERE category_id=?');
        $stmt->bind_param('ssi', $name, $desc, $id);
        $stmt->execute();
        echo json_encode(['success' => true]);
    } elseif ($method === 'DELETE') {
        $id = (int)($_GET['id'] ?? 0);
        $stmt = $db->prepare('DELETE FROM categories WHERE category_id=?');
        $stmt->bind_param('i', $id);
        $stmt->execute();
        echo json_encode(['success' => true]);
    }
    exit;
}

// ── PRODUCTS ─────────────────────────────────────────────────────────────────
if ($method === 'GET') {
    $rows = [];
    $res = $db->query(
        'SELECT p.product_id, p.category_id, c.name AS category_name, p.image_id,
                p.name, p.description, p.price, p.kcal, p.available
         FROM products p
         LEFT JOIN categories c ON c.category_id = p.category_id
         ORDER BY p.category_id, p.name'
    );
    while ($row = $res->fetch_assoc()) $rows[] = $row;
    echo json_encode(['success' => true, 'data' => $rows]);

} elseif ($method === 'POST') {
    $body = json_decode(file_get_contents('php://input'), true);
    $name  = trim($body['name'] ?? '');
    $desc  = trim($body['description'] ?? '');
    $price = (float)($body['price'] ?? 0);
    $kcal  = (int)($body['kcal'] ?? 0);
    $catId = (int)($body['category_id'] ?? 0);
    $img   = trim($body['image_id'] ?? '0');
    if (!$name || !$catId) { http_response_code(400); echo json_encode(['success' => false, 'error' => 'Name and category required']); exit; }
    $stmt = $db->prepare('INSERT INTO products (category_id, image_id, name, description, price, kcal, available) VALUES (?,?,?,?,?,?,1)');
    $stmt->bind_param('isssdi', $catId, $img, $name, $desc, $price, $kcal);
    $stmt->execute();
    echo json_encode(['success' => true, 'product_id' => $db->insert_id]);

} elseif ($method === 'PUT') {
    $id   = (int)($_GET['id'] ?? 0);
    $body = json_decode(file_get_contents('php://input'), true);

    // Toggle-only update (available field)
    if (array_key_exists('available', $body) && count($body) === 1) {
        $avail = (int)$body['available'];
        $stmt = $db->prepare('UPDATE products SET available=? WHERE product_id=?');
        $stmt->bind_param('ii', $avail, $id);
        $stmt->execute();
        echo json_encode(['success' => true]);
        exit;
    }

    $name  = trim($body['name'] ?? '');
    $desc  = trim($body['description'] ?? '');
    $price = (float)($body['price'] ?? 0);
    $kcal  = (int)($body['kcal'] ?? 0);
    $catId = (int)($body['category_id'] ?? 0);
    $img   = trim($body['image_id'] ?? '0');

    // Preserve current category if none sent or invalid
    if ($catId <= 0) {
        $cur = $db->query("SELECT category_id FROM products WHERE product_id = $id");
        if ($cur && $row = $cur->fetch_assoc()) {
            $catId = (int)$row['category_id'];
        }
    }

    $stmt = $db->prepare('UPDATE products SET category_id=?, image_id=?, name=?, description=?, price=?, kcal=? WHERE product_id=?');
    $stmt->bind_param('isssdii', $catId, $img, $name, $desc, $price, $kcal, $id);
    if (!$stmt->execute()) {
        http_response_code(500);
        echo json_encode(['success' => false, 'error' => $stmt->error]);
        exit;
    }
    echo json_encode(['success' => true]);

} elseif ($method === 'DELETE') {
    $id = (int)($_GET['id'] ?? 0);
    $stmt = $db->prepare('DELETE FROM products WHERE product_id=?');
    $stmt->bind_param('i', $id);
    $stmt->execute();
    echo json_encode(['success' => true]);
}
