<?php
declare(strict_types=1);

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, OPTIONS');
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

// Date range from query params
$range  = $_GET['range'] ?? 'week';
$from   = $_GET['from'] ?? null;
$to     = $_GET['to'] ?? null;

switch ($range) {
    case 'today':
        $dateFilter = "DATE(o.datetime) = CURDATE()";
        break;
    case 'month':
        $dateFilter = "o.datetime >= DATE_FORMAT(NOW(), '%Y-%m-01')";
        break;
    case 'custom':
        $f = $db->real_escape_string($from ?? date('Y-m-d', strtotime('-7 days')));
        $t = $db->real_escape_string($to ?? date('Y-m-d'));
        $dateFilter = "DATE(o.datetime) BETWEEN '$f' AND '$t'";
        break;
    default: // week
        $dateFilter = "o.datetime >= DATE_SUB(NOW(), INTERVAL 7 DAY)";
}

// ── Summary stats ────────────────────────────────────────────────────────────
$summary = ['total_orders' => 0, 'total_revenue' => 0.0, 'avg_order_value' => 0.0];
$res = $db->query("SELECT COUNT(*) AS total_orders, SUM(price_total) AS total_revenue, AVG(price_total) AS avg_order_value FROM orders o WHERE $dateFilter");
if ($row = $res->fetch_assoc()) {
    $summary['total_orders']    = (int)$row['total_orders'];
    $summary['total_revenue']   = round((float)$row['total_revenue'], 2);
    $summary['avg_order_value'] = round((float)$row['avg_order_value'], 2);
}

// ── Top 10 products ──────────────────────────────────────────────────────────
$topProducts = [];
$res = $db->query(
    "SELECT p.name, SUM(oi.quantity) AS total_qty
     FROM order_items oi
     JOIN orders o ON o.order_id = oi.order_id
     LEFT JOIN products p ON p.product_id = oi.product_id
     WHERE $dateFilter
     GROUP BY oi.product_id
     ORDER BY total_qty DESC
     LIMIT 10"
);
while ($row = $res->fetch_assoc()) {
    $topProducts[] = ['name' => $row['name'], 'qty' => (int)$row['total_qty']];
}

// ── Orders per hour of day ───────────────────────────────────────────────────
$byHour = array_fill(0, 24, 0);
$res = $db->query(
    "SELECT HOUR(o.datetime) AS hr, COUNT(*) AS cnt
     FROM orders o
     WHERE $dateFilter
     GROUP BY hr"
);
while ($row = $res->fetch_assoc()) {
    $byHour[(int)$row['hr']] = (int)$row['cnt'];
}

// ── Revenue per day ──────────────────────────────────────────────────────────
$byDay = [];
$res = $db->query(
    "SELECT DATE(o.datetime) AS day, COUNT(*) AS cnt, SUM(price_total) AS revenue
     FROM orders o
     WHERE $dateFilter
     GROUP BY day
     ORDER BY day"
);
while ($row = $res->fetch_assoc()) {
    $byDay[] = ['day' => $row['day'], 'count' => (int)$row['cnt'], 'revenue' => round((float)$row['revenue'], 2)];
}

// ── Order history (last 100) ─────────────────────────────────────────────────
$history = [];
$res = $db->query(
    "SELECT o.order_id, o.pickup_number, o.price_total, o.datetime, s.name AS status_name
     FROM orders o
     LEFT JOIN order_statuses s ON s.status_id = o.order_status_id
     WHERE $dateFilter
     ORDER BY o.datetime DESC
     LIMIT 100"
);
while ($order = $res->fetch_assoc()) {
    $oid = (int)$order['order_id'];
    $items = [];
    $ir = $db->query("SELECT oi.quantity, p.name AS product_name FROM order_items oi LEFT JOIN products p ON p.product_id = oi.product_id WHERE oi.order_id = $oid");
    while ($item = $ir->fetch_assoc()) $items[] = $item;
    $order['items'] = $items;
    $history[] = $order;
}

echo json_encode([
    'success'     => true,
    'summary'     => $summary,
    'top_products' => $topProducts,
    'by_hour'     => $byHour,
    'by_day'      => $byDay,
    'history'     => $history,
]);
