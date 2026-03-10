<?php
declare(strict_types=1);

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'error' => 'Method not allowed']);
    exit;
}

$config = [
    'host' => 'localhost',
    'user' => 'u240903_kiosk',
    'pass' => '2dVMTZjGJ4YzBDdShtMG',
    'name' => 'u240903_kiosk',
];

$mysqli = @new mysqli($config['host'], $config['user'], $config['pass'], $config['name']);
if ($mysqli->connect_errno) {
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => 'Database connection failed']);
    exit;
}
$mysqli->set_charset('utf8mb4');

$input = file_get_contents('php://input');
$data = json_decode($input, true);

if (!is_array($data) || empty($data['items'])) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'Invalid or empty order']);
    exit;
}

$items = $data['items'];
$subtotal = 0.0;

foreach ($items as $item) {
    $qty = (int)($item['qty'] ?? 0);
    $price = (float)($item['price'] ?? 0);
    if ($qty > 0 && $price >= 0) {
        $subtotal += $qty * $price;
    }
}

$tax = round($subtotal * 0.09, 2);
$total = round($subtotal + $tax, 2);

// ── Dagelijkse reset: verwijder alle orders van vorige dagen ─────────────────
$mysqli->query(
    "DELETE oi FROM order_items oi
     INNER JOIN orders o ON o.order_id = oi.order_id
     WHERE DATE(o.datetime) < CURDATE()"
);
$mysqli->query("DELETE FROM orders WHERE DATE(datetime) < CURDATE()");

// ── Genereer pickup nummer 1–99 (cycling) ───────────────────────────────────
$pickupNumber = 1;
$res = $mysqli->query('SELECT pickup_number FROM orders ORDER BY datetime DESC LIMIT 1');
if ($res && $row = $res->fetch_assoc()) {
    $last = (int)$row['pickup_number'];
    $pickupNumber = ($last % 99) + 1;
}
if ($res) { $res->free(); }
$displayNumber = (string)$pickupNumber;

// Als dit nummer al bestaat (zou niet mogen na reset, maar als extra zekerheid):
// verwijder de oude bestelling met dit nummer zodat UNIQUE constraint vrij is
$delRes = $mysqli->query("SELECT order_id FROM orders WHERE pickup_number = $pickupNumber LIMIT 1");
if ($delRes && $oldRow = $delRes->fetch_assoc()) {
    $oldOrderId = (int)$oldRow['order_id'];
    $mysqli->query("DELETE FROM order_items WHERE order_id = $oldOrderId");
    $mysqli->query("DELETE FROM orders WHERE order_id = $oldOrderId");
}
if ($delRes) { $delRes->free(); }

$mysqli->begin_transaction();
try {
    $stmt = $mysqli->prepare(
        'INSERT INTO orders (order_status_id, pickup_number, price_total, datetime) VALUES (1, ?, ?, NOW())'
    );
    if (!$stmt) {
        throw new RuntimeException('Prepare failed: ' . $mysqli->error);
    }
    $stmt->bind_param('id', $pickupNumber, $total);
    $stmt->execute();
    $orderId = (int)$mysqli->insert_id;
    $stmt->close();

    $itemStmt = $mysqli->prepare(
        'INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)'
    );
    if (!$itemStmt) {
        throw new RuntimeException('Prepare order_items failed: ' . $mysqli->error);
    }

    foreach ($items as $item) {
        $productId = (int)($item['id'] ?? 0);
        $qty = (int)($item['qty'] ?? 0);
        $price = (float)($item['price'] ?? 0);
        if ($productId > 0 && $qty > 0) {
            $itemStmt->bind_param('iiid', $orderId, $productId, $qty, $price);
            $itemStmt->execute();
        }
    }
    $itemStmt->close();

    $mysqli->commit();
    echo json_encode([
        'success' => true,
        'order_id' => $orderId,
        'pickup_number' => $pickupNumber,
        'pickup_display' => $displayNumber,
        'total' => $total,
    ]);
} catch (Throwable $e) {
    $mysqli->rollback();
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => 'Order save failed: ' . $e->getMessage()]);
}
