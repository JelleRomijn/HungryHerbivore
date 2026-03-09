<?php
declare(strict_types=1);

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, PATCH, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, X-Admin-Pin');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit;
}

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

if ($method === 'GET') {
    // Return orders with status 1 (Wacht) and 2 (Bezig), and status 3 (Klaar) from last 10 minutes
    $rows = [];
    $res = $db->query(
        "SELECT o.order_id, o.pickup_number, o.price_total, o.datetime, o.order_status_id,
                s.name AS status_name
         FROM orders o
         LEFT JOIN order_statuses s ON s.status_id = o.order_status_id
         WHERE o.order_status_id IN (1,2)
            OR (o.order_status_id = 3 AND o.datetime >= NOW() - INTERVAL 10 MINUTE)
         ORDER BY o.datetime ASC"
    );
    while ($order = $res->fetch_assoc()) {
        $orderId = (int)$order['order_id'];
        $items = [];
        $itemRes = $db->query(
            "SELECT oi.quantity, oi.price, p.name AS product_name
             FROM order_items oi
             LEFT JOIN products p ON p.product_id = oi.product_id
             WHERE oi.order_id = $orderId"
        );
        while ($item = $itemRes->fetch_assoc()) {
            $items[] = $item;
        }
        $order['items'] = $items;
        $rows[] = $order;
    }
    echo json_encode(['success' => true, 'data' => $rows]);

} elseif ($method === 'PATCH') {
    $id   = (int)($_GET['id'] ?? 0);
    $body = json_decode(file_get_contents('php://input'), true);
    $newStatus = (int)($body['order_status_id'] ?? 0);
    if (!$id || !$newStatus) {
        http_response_code(400);
        echo json_encode(['success' => false, 'error' => 'Missing id or status']);
        exit;
    }
    $stmt = $db->prepare('UPDATE orders SET order_status_id=? WHERE order_id=?');
    $stmt->bind_param('ii', $newStatus, $id);
    $stmt->execute();
    echo json_encode(['success' => true]);
} else {
    http_response_code(405);
    echo json_encode(['success' => false, 'error' => 'Method not allowed']);
}
