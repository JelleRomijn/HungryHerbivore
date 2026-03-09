<?php
declare(strict_types=1);
session_start();

define('ADMIN_PIN', '1234');

// ── Database migration: ensure order_statuses table exists ───────────────────
function getAdminDb(): mysqli {
    $config = ['host' => '127.0.0.1', 'user' => 'root', 'pass' => '', 'name' => 'products'];
    $db = @new mysqli($config['host'], $config['user'], $config['pass'], $config['name']);
    if (!$db->connect_errno) {
        $db->set_charset('utf8mb4');
        $db->query("CREATE TABLE IF NOT EXISTS order_statuses (
            status_id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
            name VARCHAR(50) NOT NULL
        )");
        $db->query("INSERT IGNORE INTO order_statuses (status_id, name) VALUES (1,'Wacht'),(2,'Bezig'),(3,'Klaar')");
        $db->query("UPDATE orders SET order_status_id = 3 WHERE order_status_id IS NULL OR order_status_id = 0");

        $db->query("CREATE TABLE IF NOT EXISTS categories (
            category_id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
            name VARCHAR(100) NOT NULL,
            description TEXT DEFAULT ''
        )");
        $db->query("INSERT IGNORE INTO categories (category_id, name) VALUES
            (1,'Breakfast'),(2,'Bowls'),(3,'Wraps'),(4,'Dinner'),(5,'Sauce'),(6,'Drinks')");
    }
    return $db;
}

// ── PIN login ─────────────────────────────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['pin'])) {
    if ($_POST['pin'] === ADMIN_PIN) {
        $_SESSION['admin_auth'] = true;
        header('Location: admin.php');
        exit;
    } else {
        $loginError = 'Onjuiste PIN, probeer opnieuw.';
    }
}

if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: admin.php');
    exit;
}

$authed = !empty($_SESSION['admin_auth']);
if ($authed) {
    getAdminDb(); // run migration
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>HungryHerbivore Admin</title>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<style>
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

:root {
    --green:      #3a7d44;
    --green-light:#e8f5e9;
    --green-dark: #2c5f34;
    --orange:     #e07b29;
    --red:        #d32f2f;
    --bg:         #f4f6f4;
    --card:       #ffffff;
    --text:       #1a2e1c;
    --muted:      #6b8a6f;
    --border:     #d0e0d2;
    --radius:     12px;
    --shadow:     0 2px 12px rgba(0,0,0,.08);
}

body { font-family: 'Segoe UI', system-ui, sans-serif; background: var(--bg); color: var(--text); min-height: 100vh; }

/* ── PIN SCREEN ── */
.pin-screen {
    min-height: 100vh; display: flex; align-items: center; justify-content: center;
    background: linear-gradient(135deg, var(--green-dark) 0%, var(--green) 100%);
}
.pin-card {
    background: var(--card); border-radius: 20px; padding: 48px 40px;
    width: 360px; text-align: center; box-shadow: 0 20px 60px rgba(0,0,0,.25);
}
.pin-logo { font-size: 48px; margin-bottom: 12px; }
.pin-title { font-size: 22px; font-weight: 700; color: var(--green-dark); margin-bottom: 6px; }
.pin-subtitle { font-size: 14px; color: var(--muted); margin-bottom: 28px; }
.pin-input {
    width: 100%; padding: 14px 18px; border: 2px solid var(--border); border-radius: 10px;
    font-size: 24px; text-align: center; letter-spacing: 8px; outline: none;
    transition: border-color .2s;
}
.pin-input:focus { border-color: var(--green); }
.pin-btn {
    margin-top: 16px; width: 100%; padding: 14px; background: var(--green); color: #fff;
    border: none; border-radius: 10px; font-size: 16px; font-weight: 600; cursor: pointer;
    transition: background .2s;
}
.pin-btn:hover { background: var(--green-dark); }
.pin-error { margin-top: 14px; color: var(--red); font-size: 14px; }

/* ── LAYOUT ── */
.admin-layout { display: flex; min-height: 100vh; }

.sidebar {
    width: 220px; background: var(--green-dark); color: #fff; flex-shrink: 0;
    display: flex; flex-direction: column;
}
.sidebar-brand {
    padding: 24px 20px 20px; border-bottom: 1px solid rgba(255,255,255,.15);
}
.sidebar-brand h1 { font-size: 17px; font-weight: 700; line-height: 1.2; }
.sidebar-brand p { font-size: 11px; opacity: .65; margin-top: 3px; }

.sidebar-nav { flex: 1; padding: 16px 0; }
.nav-item {
    display: flex; align-items: center; gap: 12px; padding: 13px 20px;
    cursor: pointer; font-size: 14px; font-weight: 500; transition: background .15s;
    border: none; background: none; color: #fff; width: 100%; text-align: left;
}
.nav-item:hover { background: rgba(255,255,255,.1); }
.nav-item.active { background: rgba(255,255,255,.18); }
.nav-icon { font-size: 18px; width: 22px; text-align: center; }

.sidebar-footer { padding: 16px 20px; border-top: 1px solid rgba(255,255,255,.15); }
.logout-btn {
    display: block; width: 100%; padding: 10px; background: rgba(255,255,255,.12);
    color: #fff; border: none; border-radius: 8px; font-size: 13px; cursor: pointer;
    transition: background .15s;
}
.logout-btn:hover { background: rgba(255,255,255,.22); }

.main-content { flex: 1; padding: 32px; overflow-y: auto; }

/* ── TABS ── */
.tab-panel { display: none; }
.tab-panel.active { display: block; }

/* ── HEADER ── */
.page-header {
    display: flex; align-items: center; justify-content: space-between; margin-bottom: 28px;
}
.page-title { font-size: 26px; font-weight: 700; color: var(--green-dark); }

/* ── BUTTONS ── */
.btn {
    display: inline-flex; align-items: center; gap: 6px; padding: 9px 18px;
    border-radius: 8px; border: none; cursor: pointer; font-size: 14px; font-weight: 600;
    transition: opacity .15s, background .15s; white-space: nowrap;
}
.btn-primary { background: var(--green); color: #fff; }
.btn-primary:hover { background: var(--green-dark); }
.btn-secondary { background: var(--green-light); color: var(--green-dark); }
.btn-secondary:hover { background: #d0ebcf; }
.btn-danger { background: #fdecea; color: var(--red); }
.btn-danger:hover { background: #f9c9c4; }
.btn-warning { background: #fff3e0; color: var(--orange); }
.btn-warning:hover { background: #ffe0b2; }
.btn-sm { padding: 5px 12px; font-size: 12px; }

/* ── CARDS ── */
.card {
    background: var(--card); border-radius: var(--radius); box-shadow: var(--shadow);
    padding: 24px; margin-bottom: 24px;
}
.card-title { font-size: 16px; font-weight: 700; margin-bottom: 16px; color: var(--green-dark); }

/* ── TABLE ── */
.tbl-wrap { overflow-x: auto; border-radius: var(--radius); }
table { width: 100%; border-collapse: collapse; font-size: 14px; }
thead th { background: var(--green-light); color: var(--green-dark); font-weight: 600; padding: 11px 14px; text-align: left; }
tbody td { padding: 11px 14px; border-bottom: 1px solid var(--border); vertical-align: middle; }
tbody tr:last-child td { border-bottom: none; }
tbody tr:hover { background: #f9fbf9; }

/* ── TOGGLE ── */
.toggle { position: relative; display: inline-block; width: 40px; height: 22px; }
.toggle input { opacity: 0; width: 0; height: 0; }
.toggle-slider {
    position: absolute; inset: 0; background: #ccc; border-radius: 22px; cursor: pointer;
    transition: background .2s;
}
.toggle-slider::before {
    content: ''; position: absolute; left: 3px; top: 3px; width: 16px; height: 16px;
    background: #fff; border-radius: 50%; transition: transform .2s;
}
.toggle input:checked + .toggle-slider { background: var(--green); }
.toggle input:checked + .toggle-slider::before { transform: translateX(18px); }

/* ── BADGE ── */
.badge {
    display: inline-block; padding: 3px 10px; border-radius: 20px; font-size: 12px; font-weight: 600;
}
.badge-wait   { background: #fff3e0; color: #e65100; }
.badge-busy   { background: #e3f2fd; color: #1565c0; }
.badge-done   { background: var(--green-light); color: var(--green-dark); }

/* ── KDS ── */
.kds-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; }
.kds-column-title {
    font-size: 15px; font-weight: 700; padding: 10px 16px; border-radius: 10px 10px 0 0;
    text-align: center;
}
.kds-col-wait  .kds-column-title { background: #fff3e0; color: #e65100; }
.kds-col-busy  .kds-column-title { background: #e3f2fd; color: #1565c0; }
.kds-col-done  .kds-column-title { background: var(--green-light); color: var(--green-dark); }

.kds-cards { display: flex; flex-direction: column; gap: 12px; margin-top: 8px; }

.kds-card {
    background: var(--card); border-radius: var(--radius); box-shadow: var(--shadow);
    padding: 16px; border-left: 4px solid transparent;
}
.kds-col-wait .kds-card  { border-left-color: #e65100; }
.kds-col-busy .kds-card  { border-left-color: #1565c0; }
.kds-col-done .kds-card  { border-left-color: var(--green); }

.kds-card-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px; }
.kds-order-num { font-size: 22px; font-weight: 800; color: var(--green-dark); }
.kds-time { font-size: 12px; color: var(--muted); }
.kds-items { font-size: 13px; line-height: 1.8; color: var(--text); margin-bottom: 12px; }
.kds-card-footer { display: flex; gap: 8px; }

/* ── STAT TILES ── */
.stat-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-bottom: 24px; }
.stat-tile { background: var(--card); border-radius: var(--radius); box-shadow: var(--shadow); padding: 22px 24px; }
.stat-tile-label { font-size: 13px; color: var(--muted); font-weight: 500; margin-bottom: 6px; }
.stat-tile-value { font-size: 32px; font-weight: 800; color: var(--green-dark); }
.stat-tile-sub   { font-size: 13px; color: var(--muted); margin-top: 2px; }

/* ── CHARTS ── */
.chart-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 24px; margin-bottom: 24px; }
.chart-wrap { background: var(--card); border-radius: var(--radius); box-shadow: var(--shadow); padding: 20px; }
.chart-wrap canvas { max-height: 280px; }

/* ── DATE FILTER ── */
.filter-bar { display: flex; gap: 10px; align-items: center; flex-wrap: wrap; margin-bottom: 24px; }
.filter-btn {
    padding: 7px 16px; border: 2px solid var(--border); border-radius: 20px; background: var(--card);
    font-size: 13px; cursor: pointer; font-weight: 500; color: var(--muted); transition: all .15s;
}
.filter-btn.active { border-color: var(--green); background: var(--green); color: #fff; }
.filter-custom { display: flex; gap: 8px; align-items: center; }
.filter-custom input {
    padding: 6px 10px; border: 2px solid var(--border); border-radius: 8px; font-size: 13px;
}

/* ── MODAL ── */
.modal-overlay {
    display: none; position: fixed; inset: 0; background: rgba(0,0,0,.5);
    z-index: 1000; align-items: center; justify-content: center;
}
.modal-overlay.open { display: flex; }
.modal {
    background: var(--card); border-radius: 16px; padding: 32px; width: 520px;
    max-width: 95vw; max-height: 90vh; overflow-y: auto; box-shadow: 0 20px 60px rgba(0,0,0,.25);
}
.modal-title { font-size: 20px; font-weight: 700; color: var(--green-dark); margin-bottom: 24px; }
.form-group { margin-bottom: 18px; }
.form-label { display: block; font-size: 13px; font-weight: 600; color: var(--muted); margin-bottom: 6px; }
.form-input, .form-select, .form-textarea {
    width: 100%; padding: 10px 14px; border: 2px solid var(--border); border-radius: 8px;
    font-size: 14px; outline: none; transition: border-color .2s; font-family: inherit;
}
.form-input:focus, .form-select:focus, .form-textarea:focus { border-color: var(--green); }
.form-textarea { min-height: 80px; resize: vertical; }
.form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
.modal-actions { display: flex; gap: 10px; justify-content: flex-end; margin-top: 24px; }

/* ── TOAST ── */
.toast {
    position: fixed; bottom: 30px; right: 30px; background: var(--green-dark); color: #fff;
    padding: 14px 22px; border-radius: 10px; font-size: 14px; font-weight: 600;
    box-shadow: 0 8px 24px rgba(0,0,0,.2); transform: translateY(80px); opacity: 0;
    transition: transform .3s, opacity .3s; z-index: 2000;
}
.toast.show { transform: translateY(0); opacity: 1; }
.toast.error { background: var(--red); }

/* ── EMPTY STATE ── */
.empty-state { text-align: center; padding: 40px; color: var(--muted); font-size: 15px; }

@media (max-width: 900px) {
    .kds-grid { grid-template-columns: 1fr; }
    .chart-grid { grid-template-columns: 1fr; }
    .stat-grid  { grid-template-columns: 1fr; }
}
</style>
</head>
<body>

<?php if (!$authed): ?>
<!-- ══════════════ PIN LOGIN ══════════════ -->
<div class="pin-screen">
    <div class="pin-card">
        <div class="pin-logo">🌿</div>
        <div class="pin-title">HungryHerbivore</div>
        <div class="pin-subtitle">Admin Panel — voer PIN in</div>
        <form method="POST">
            <input class="pin-input" type="password" name="pin" placeholder="••••"
                   inputmode="numeric" maxlength="10" autofocus autocomplete="off">
            <button class="pin-btn" type="submit">Inloggen</button>
            <?php if (!empty($loginError)): ?>
                <div class="pin-error"><?= htmlspecialchars($loginError) ?></div>
            <?php endif; ?>
        </form>
    </div>
</div>

<?php else: ?>
<!-- ══════════════ ADMIN PANEL ══════════════ -->
<div class="admin-layout">

    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="sidebar-brand">
            <h1>🌿 HungryHerbivore</h1>
            <p>Admin Panel</p>
        </div>
        <nav class="sidebar-nav">
            <button class="nav-item active" onclick="switchTab('mms')">
                <span class="nav-icon">🍽️</span> Menu Beheer
            </button>
            <button class="nav-item" onclick="switchTab('kds')">
                <span class="nav-icon">👨‍🍳</span> Keuken Display
            </button>
            <button class="nav-item" onclick="switchTab('analyse')">
                <span class="nav-icon">📊</span> Analyse
            </button>
        </nav>
        <div class="sidebar-footer">
            <a href="index.php" style="display:block;color:#fff;text-align:center;font-size:12px;margin-bottom:10px;opacity:.7;text-decoration:none;">← Terug naar kiosk</a>
            <a href="admin.php?logout=1" style="text-decoration:none;">
                <button class="logout-btn" style="background:#c0392b;font-weight:700;font-size:14px;padding:12px;">🔒 Uitloggen</button>
            </a>
        </div>
    </aside>

    <!-- Main -->
    <main class="main-content">

        <!-- ══ TAB: MENU BEHEER ══ -->
        <div class="tab-panel active" id="tab-mms">
            <div class="page-header">
                <h2 class="page-title">Menu Beheer</h2>
                <button class="btn btn-primary" onclick="openProductModal()">+ Nieuw product</button>
            </div>

            <!-- Products table -->
            <div class="card">
                <div class="card-title" style="display:flex;justify-content:space-between;align-items:center;">
                    Producten
                    <input type="text" id="productSearch" placeholder="Zoeken..." oninput="filterProducts()"
                           style="padding:7px 12px;border:2px solid var(--border);border-radius:8px;font-size:13px;outline:none;">
                </div>
                <div class="tbl-wrap">
                    <table id="productTable" style="table-layout:fixed;width:100%;">
                        <colgroup>
                            <col style="width:35%">
                            <col style="width:18%">
                            <col style="width:9%">
                            <col style="width:8%">
                            <col style="width:12%">
                            <col style="width:18%">
                        </colgroup>
                        <thead>
                            <tr>
                                <th>Naam</th>
                                <th>Categorie</th>
                                <th style="text-align:right">Prijs</th>
                                <th style="text-align:right">Kcal</th>
                                <th style="text-align:center">Beschikbaar</th>
                                <th style="text-align:center">Acties</th>
                            </tr>
                        </thead>
                        <tbody id="productTbody">
                            <tr><td colspan="6" class="empty-state">Laden...</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Categories table -->
            <div class="card">
                <div class="card-title" style="display:flex;justify-content:space-between;align-items:center;">
                    Categorieën
                    <button class="btn btn-secondary btn-sm" onclick="openCatModal()">+ Categorie</button>
                </div>
                <div class="tbl-wrap">
                    <table>
                        <thead>
                            <tr><th>ID</th><th>Naam</th><th>Beschrijving</th><th>Acties</th></tr>
                        </thead>
                        <tbody id="catTbody">
                            <tr><td colspan="4" class="empty-state">Laden...</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- ══ TAB: KEUKEN DISPLAY ══ -->
        <div class="tab-panel" id="tab-kds">
            <div class="page-header">
                <h2 class="page-title">Keuken Display</h2>
                <span id="kds-last-update" style="font-size:13px;color:var(--muted);"></span>
            </div>
            <div class="kds-grid">
                <div class="kds-col-wait">
                    <div class="kds-column-title">⏳ Wacht</div>
                    <div class="kds-cards" id="kds-wait"></div>
                </div>
                <div class="kds-col-busy">
                    <div class="kds-column-title">🔥 Bezig</div>
                    <div class="kds-cards" id="kds-busy"></div>
                </div>
                <div class="kds-col-done">
                    <div class="kds-column-title">✅ Klaar</div>
                    <div class="kds-cards" id="kds-done"></div>
                </div>
            </div>
        </div>

        <!-- ══ TAB: ANALYSE ══ -->
        <div class="tab-panel" id="tab-analyse">
            <div class="page-header">
                <h2 class="page-title">Order Analyse</h2>
            </div>

            <div class="filter-bar">
                <button class="filter-btn" onclick="setRange('today')">Vandaag</button>
                <button class="filter-btn active" onclick="setRange('week')">Deze week</button>
                <button class="filter-btn" onclick="setRange('month')">Deze maand</button>
                <button class="filter-btn" onclick="setRange('custom')">Aangepast</button>
                <div class="filter-custom" id="custom-range" style="display:none;">
                    <input type="date" id="dateFrom">
                    <span style="color:var(--muted)">t/m</span>
                    <input type="date" id="dateTo">
                    <button class="btn btn-primary btn-sm" onclick="loadAnalytics()">Toepassen</button>
                </div>
            </div>

            <div class="stat-grid">
                <div class="stat-tile">
                    <div class="stat-tile-label">Totaal orders</div>
                    <div class="stat-tile-value" id="stat-orders">—</div>
                </div>
                <div class="stat-tile">
                    <div class="stat-tile-label">Totale omzet</div>
                    <div class="stat-tile-value" id="stat-revenue">—</div>
                </div>
                <div class="stat-tile">
                    <div class="stat-tile-label">Gemiddelde bestelwaarde</div>
                    <div class="stat-tile-value" id="stat-avg">—</div>
                </div>
            </div>

            <div class="chart-grid">
                <div class="chart-wrap">
                    <div class="card-title">Top 10 producten</div>
                    <canvas id="chartProducts"></canvas>
                </div>
                <div class="chart-wrap">
                    <div class="card-title">Orders per uur</div>
                    <canvas id="chartHour"></canvas>
                </div>
            </div>

            <div class="card">
                <div class="card-title">Omzet per dag</div>
                <canvas id="chartDay" style="max-height:200px;"></canvas>
            </div>

            <div class="card">
                <div class="card-title">Ordergeschiedenis</div>
                <div class="tbl-wrap">
                    <table>
                        <thead>
                            <tr><th>Datum & tijd</th><th>Order #</th><th>Items</th><th>Totaal</th><th>Status</th></tr>
                        </thead>
                        <tbody id="historyTbody">
                            <tr><td colspan="5" class="empty-state">Selecteer een periode</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </main>
</div>

<!-- ══ MODALS ══ -->
<!-- Product modal -->
<div class="modal-overlay" id="productModal">
    <div class="modal">
        <div class="modal-title" id="productModalTitle">Nieuw product</div>
        <input type="hidden" id="editProductId">
        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Naam *</label>
                <input class="form-input" id="pName" placeholder="Naam product">
            </div>
            <div class="form-group">
                <label class="form-label">Categorie *</label>
                <select class="form-select" id="pCategory"></select>
            </div>
        </div>
        <div class="form-group">
            <label class="form-label">Beschrijving</label>
            <textarea class="form-textarea" id="pDesc" placeholder="Omschrijving..."></textarea>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Prijs (€) *</label>
                <input class="form-input" id="pPrice" type="number" step="0.01" min="0" placeholder="0.00">
            </div>
            <div class="form-group">
                <label class="form-label">Kcal</label>
                <input class="form-input" id="pKcal" type="number" min="0" placeholder="0">
            </div>
        </div>
        <div class="form-group">
            <label class="form-label">Afbeelding (bestandsnaam of URL)</label>
            <input class="form-input" id="pImage" placeholder="bijv. burger.jpg of https://...">
        </div>
        <div class="modal-actions">
            <button class="btn btn-secondary" onclick="closeModal('productModal')">Annuleren</button>
            <button class="btn btn-primary" onclick="saveProduct()">Opslaan</button>
        </div>
    </div>
</div>

<!-- Category modal -->
<div class="modal-overlay" id="catModal">
    <div class="modal">
        <div class="modal-title" id="catModalTitle">Nieuwe categorie</div>
        <input type="hidden" id="editCatId">
        <div class="form-group">
            <label class="form-label">Naam *</label>
            <input class="form-input" id="cName" placeholder="Categorienaam">
        </div>
        <div class="form-group">
            <label class="form-label">Beschrijving</label>
            <textarea class="form-textarea" id="cDesc" placeholder="Omschrijving..."></textarea>
        </div>
        <div class="modal-actions">
            <button class="btn btn-secondary" onclick="closeModal('catModal')">Annuleren</button>
            <button class="btn btn-primary" onclick="saveCategory()">Opslaan</button>
        </div>
    </div>
</div>

<!-- Toast -->
<div class="toast" id="toast"></div>

<script>
const PIN = '<?= ADMIN_PIN ?>';

// ── Helpers ──────────────────────────────────────────────────────────────────
function api(url, opts = {}) {
    opts.headers = Object.assign({ 'Content-Type': 'application/json', 'X-Admin-Pin': PIN }, opts.headers || {});
    return fetch(url, opts).then(r => r.json());
}

function toast(msg, isError = false) {
    const el = document.getElementById('toast');
    el.textContent = msg;
    el.className = 'toast' + (isError ? ' error' : '') + ' show';
    setTimeout(() => el.classList.remove('show'), 3000);
}

function eur(v) { return '€ ' + parseFloat(v || 0).toFixed(2).replace('.', ','); }

function fmtTime(dt) {
    const d = new Date(dt);
    return d.toLocaleTimeString('nl-NL', { hour: '2-digit', minute: '2-digit' });
}
function fmtDateTime(dt) {
    const d = new Date(dt);
    return d.toLocaleDateString('nl-NL', { day: '2-digit', month: '2-digit', year: 'numeric' })
         + ' ' + d.toLocaleTimeString('nl-NL', { hour: '2-digit', minute: '2-digit' });
}

// ── Tab switching ─────────────────────────────────────────────────────────────
let activeTab = 'mms';
function switchTab(tab) {
    document.querySelectorAll('.tab-panel').forEach(p => p.classList.remove('active'));
    document.querySelectorAll('.nav-item').forEach(n => n.classList.remove('active'));
    document.getElementById('tab-' + tab).classList.add('active');
    document.querySelectorAll('.nav-item')[['mms','kds','analyse'].indexOf(tab)].classList.add('active');
    activeTab = tab;
    if (tab === 'mms') loadProducts();
    if (tab === 'kds') startKdsPolling();
    if (tab === 'analyse') loadAnalytics();
}

// ══════════════════════════════════════════════════════════════════════════════
// TAB 1: MENU BEHEER
// ══════════════════════════════════════════════════════════════════════════════
let allProducts = [], allCategories = [];

function loadProducts() {
    Promise.all([
        api('api/admin-products.php'),
        api('api/admin-products.php?resource=categories')
    ]).then(([pr, cr]) => {
        allProducts   = pr.data || [];
        allCategories = cr.data || [];
        renderProducts(allProducts);
        renderCategories(allCategories);
        populateCategorySelect();
    }).catch(err => {
        toast('Fout bij laden: ' + err.message, true);
        console.error('loadProducts error:', err);
    });
}

function renderProducts(list) {
    const tbody = document.getElementById('productTbody');
    if (!list.length) { tbody.innerHTML = '<tr><td colspan="6" class="empty-state">Geen producten gevonden.</td></tr>'; return; }
    tbody.innerHTML = list.map(p => `
        <tr>
            <td style="vertical-align:middle;">
                <strong style="display:block;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">${esc(p.name)}</strong>
                <small style="color:var(--muted);display:block;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">${esc(p.description||'')}</small>
            </td>
            <td style="vertical-align:middle;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">${esc(p.category_name||'')}</td>
            <td style="vertical-align:middle;text-align:right;white-space:nowrap;">${eur(p.price)}</td>
            <td style="vertical-align:middle;text-align:right;white-space:nowrap;">${p.kcal || '—'}</td>
            <td style="vertical-align:middle;text-align:center;">
                <label class="toggle">
                    <input type="checkbox" ${p.available == 1 ? 'checked' : ''} onchange="toggleAvailable(${p.product_id}, this.checked)">
                    <span class="toggle-slider"></span>
                </label>
            </td>
            <td style="vertical-align:middle;text-align:center;">
                <div style="display:inline-flex;gap:6px;justify-content:center;">
                    <button class="btn btn-warning btn-sm" onclick="editProduct(${p.product_id})">✏️ Bewerk</button>
                    <button class="btn btn-danger btn-sm" style="padding:5px 10px;" onclick="deleteProduct(${p.product_id})">🗑️</button>
                </div>
            </td>
        </tr>
    `).join('');
}

function filterProducts() {
    const q = document.getElementById('productSearch').value.toLowerCase();
    renderProducts(allProducts.filter(p => p.name.toLowerCase().includes(q) || (p.category_name||'').toLowerCase().includes(q)));
}

function renderCategories(list) {
    const tbody = document.getElementById('catTbody');
    if (!list.length) { tbody.innerHTML = '<tr><td colspan="4" class="empty-state">Geen categorieën.</td></tr>'; return; }
    tbody.innerHTML = list.map(c => `
        <tr>
            <td>${c.category_id}</td>
            <td><strong>${esc(c.name)}</strong></td>
            <td>${esc(c.description||'—')}</td>
            <td style="display:flex;gap:6px;">
                <button class="btn btn-warning btn-sm" onclick="editCategory(${c.category_id})">✏️ Bewerk</button>
                <button class="btn btn-danger btn-sm" onclick="deleteCategory(${c.category_id})">🗑️</button>
            </td>
        </tr>
    `).join('');
}

function populateCategorySelect() {
    const sel = document.getElementById('pCategory');
    sel.innerHTML = '<option value="" disabled>— Kies categorie —</option>' +
        allCategories.map(c => `<option value="${c.category_id}">${esc(c.name)}</option>`).join('');
}

function esc(s) { return String(s).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;'); }

// Product modal
function openProductModal() {
    document.getElementById('productModalTitle').textContent = 'Nieuw product';
    document.getElementById('editProductId').value = '';
    document.getElementById('pName').value = '';
    document.getElementById('pDesc').value = '';
    document.getElementById('pPrice').value = '';
    document.getElementById('pKcal').value = '';
    document.getElementById('pImage').value = '';
    populateCategorySelect();
    document.getElementById('pCategory').value = '';
    openModal('productModal');
}

function editProduct(id) {
    const p = allProducts.find(x => String(x.product_id) === String(id));
    if (!p) { toast('Product niet gevonden', true); return; }
    document.getElementById('productModalTitle').textContent = 'Product bewerken';
    document.getElementById('editProductId').value = p.product_id;
    document.getElementById('pName').value = p.name;
    document.getElementById('pDesc').value = p.description || '';
    document.getElementById('pPrice').value = p.price;
    document.getElementById('pKcal').value = p.kcal || '';
    document.getElementById('pImage').value = p.image_id || '';
    populateCategorySelect();
    document.getElementById('pCategory').value = p.category_id;
    openModal('productModal');
}

function saveProduct() {
    const id    = document.getElementById('editProductId').value;
    const catVal = parseInt(document.getElementById('pCategory').value, 10);
    const body  = {
        name:        document.getElementById('pName').value.trim(),
        description: document.getElementById('pDesc').value.trim(),
        price:       parseFloat(document.getElementById('pPrice').value) || 0,
        kcal:        parseInt(document.getElementById('pKcal').value, 10) || 0,
        category_id: catVal,
        image_id:    document.getElementById('pImage').value.trim() || '0',
    };
    if (!body.name) { toast('Naam is verplicht', true); return; }
    if (!catVal || isNaN(catVal)) { toast('Categorie is verplicht', true); return; }
    const url    = id ? `api/admin-products.php?id=${id}` : 'api/admin-products.php';
    const method = id ? 'PUT' : 'POST';
    api(url, { method, body: JSON.stringify(body) }).then(r => {
        if (r.success) { toast(id ? 'Product bijgewerkt' : 'Product toegevoegd'); closeModal('productModal'); loadProducts(); }
        else toast(r.error || 'Fout', true);
    }).catch(function(err) { toast('Netwerkfout: ' + err.message, true); });
}

function toggleAvailable(id, checked) {
    api(`api/admin-products.php?id=${id}`, { method: 'PUT', body: JSON.stringify({ available: checked ? 1 : 0 }) })
        .then(r => { if (!r.success) toast('Fout bij opslaan', true); });
}

function deleteProduct(id) {
    const p = allProducts.find(x => String(x.product_id) === String(id));
    const name = p ? p.name : 'dit product';
    if (!confirm(`Weet je zeker dat je "${name}" wilt verwijderen?`)) return;
    api(`api/admin-products.php?id=${id}`, { method: 'DELETE' }).then(r => {
        if (r.success) { toast('Product verwijderd'); loadProducts(); }
        else toast(r.error || 'Fout', true);
    });
}

// Category modal
function openCatModal() {
    document.getElementById('catModalTitle').textContent = 'Nieuwe categorie';
    document.getElementById('editCatId').value = '';
    document.getElementById('cName').value = '';
    document.getElementById('cDesc').value = '';
    openModal('catModal');
}
function editCategory(id) {
    const c = allCategories.find(x => String(x.category_id) === String(id));
    if (!c) { toast('Categorie niet gevonden', true); return; }
    document.getElementById('catModalTitle').textContent = 'Categorie bewerken';
    document.getElementById('editCatId').value = c.category_id;
    document.getElementById('cName').value = c.name;
    document.getElementById('cDesc').value = c.description || '';
    openModal('catModal');
}
function saveCategory() {
    const id   = document.getElementById('editCatId').value;
    const body = { name: document.getElementById('cName').value.trim(), description: document.getElementById('cDesc').value.trim() };
    if (!body.name) { toast('Naam is verplicht', true); return; }
    const url    = id ? `api/admin-products.php?resource=categories&id=${id}` : 'api/admin-products.php?resource=categories';
    const method = id ? 'PUT' : 'POST';
    api(url, { method, body: JSON.stringify(body) }).then(r => {
        if (r.success) { toast(id ? 'Categorie bijgewerkt' : 'Categorie toegevoegd'); closeModal('catModal'); loadProducts(); }
        else toast(r.error || 'Fout', true);
    });
}
function deleteCategory(id) {
    const c = allCategories.find(x => String(x.category_id) === String(id));
    const name = c ? c.name : 'deze categorie';
    if (!confirm(`Weet je zeker dat je categorie "${name}" wilt verwijderen? Producten worden NIET verwijderd.`)) return;
    api(`api/admin-products.php?resource=categories&id=${id}`, { method: 'DELETE' }).then(r => {
        if (r.success) { toast('Categorie verwijderd'); loadProducts(); }
        else toast(r.error || 'Fout', true);
    });
}

// Modal open/close
function openModal(id)  { document.getElementById(id).classList.add('open'); }
function closeModal(id) { document.getElementById(id).classList.remove('open'); }
document.querySelectorAll('.modal-overlay').forEach(o => o.addEventListener('click', function(e) {
    if (e.target === this) this.classList.remove('open');
}));

// ══════════════════════════════════════════════════════════════════════════════
// TAB 2: KEUKEN DISPLAY
// ══════════════════════════════════════════════════════════════════════════════
let kdsInterval = null;

function startKdsPolling() {
    loadKds();
    if (kdsInterval) clearInterval(kdsInterval);
    kdsInterval = setInterval(loadKds, 4000);
}

function loadKds() {
    api('api/admin-orders.php').then(r => {
        if (!r.success) return;
        const wait = r.data.filter(o => o.order_status_id == 1);
        const busy = r.data.filter(o => o.order_status_id == 2);
        const done = r.data.filter(o => o.order_status_id == 3);
        renderKdsColumn('kds-wait', wait, 1);
        renderKdsColumn('kds-busy', busy, 2);
        renderKdsColumn('kds-done', done, 3);
        document.getElementById('kds-last-update').textContent = 'Bijgewerkt: ' + new Date().toLocaleTimeString('nl-NL');
    });
}

function renderKdsColumn(elId, orders, statusId) {
    const el = document.getElementById(elId);
    if (!orders.length) { el.innerHTML = '<div class="empty-state" style="padding:20px;font-size:13px;">Geen orders</div>'; return; }
    el.innerHTML = orders.map(o => {
        const itemsHtml = o.items.map(i => `${i.quantity}× ${esc(i.product_name)}`).join('<br>');
        const nextBtn = statusId === 1
            ? `<button class="btn btn-primary btn-sm" onclick="updateStatus(${o.order_id}, 2)">▶ Start</button>`
            : statusId === 2
            ? `<button class="btn btn-secondary btn-sm" onclick="updateStatus(${o.order_id}, 3)">✔ Klaar</button>`
            : '';
        return `
            <div class="kds-card">
                <div class="kds-card-header">
                    <span class="kds-order-num">#${o.pickup_number}</span>
                    <span class="kds-time">${fmtTime(o.datetime)}</span>
                </div>
                <div class="kds-items">${itemsHtml}</div>
                <div class="kds-card-footer">
                    ${nextBtn}
                    <span style="margin-left:auto;font-size:13px;font-weight:600;color:var(--muted)">${eur(o.price_total)}</span>
                </div>
            </div>`;
    }).join('');
}

function updateStatus(orderId, newStatus) {
    api(`api/admin-orders.php?id=${orderId}`, {
        method: 'PATCH',
        body: JSON.stringify({ order_status_id: newStatus })
    }).then(r => {
        if (r.success) loadKds();
        else toast('Status bijwerken mislukt', true);
    });
}

// Stop KDS polling when leaving tab
document.querySelectorAll('.nav-item').forEach(btn => btn.addEventListener('click', function() {
    if (activeTab !== 'kds' && kdsInterval) {
        clearInterval(kdsInterval);
        kdsInterval = null;
    }
}));

// ══════════════════════════════════════════════════════════════════════════════
// TAB 3: ANALYSE
// ══════════════════════════════════════════════════════════════════════════════
let currentRange = 'week';
let chartProducts = null, chartHour = null, chartDay = null;

function setRange(range) {
    currentRange = range;
    document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
    event.target.classList.add('active');
    document.getElementById('custom-range').style.display = range === 'custom' ? 'flex' : 'none';
    if (range !== 'custom') loadAnalytics();
}

function loadAnalytics() {
    let url = `api/admin-analytics.php?range=${currentRange}`;
    if (currentRange === 'custom') {
        const f = document.getElementById('dateFrom').value;
        const t = document.getElementById('dateTo').value;
        if (!f || !t) { toast('Kies een begindatum en einddatum', true); return; }
        url += `&from=${f}&to=${t}`;
    }
    api(url).then(r => {
        if (!r.success) { toast('Kon analyse niet laden', true); return; }

        // Stats
        document.getElementById('stat-orders').textContent  = r.summary.total_orders;
        document.getElementById('stat-revenue').textContent = eur(r.summary.total_revenue);
        document.getElementById('stat-avg').textContent     = eur(r.summary.avg_order_value);

        // Top products chart
        const labels = r.top_products.map(p => p.name);
        const data   = r.top_products.map(p => p.qty);
        if (chartProducts) chartProducts.destroy();
        chartProducts = new Chart(document.getElementById('chartProducts'), {
            type: 'bar',
            data: { labels, datasets: [{ label: 'Aantal verkocht', data, backgroundColor: '#3a7d44aa', borderColor: '#3a7d44', borderWidth: 1 }] },
            options: { indexAxis: 'y', plugins: { legend: { display: false } }, scales: { x: { beginAtZero: true } } }
        });

        // Hours chart
        const hours = Array.from({length: 24}, (_, i) => i + ':00');
        if (chartHour) chartHour.destroy();
        chartHour = new Chart(document.getElementById('chartHour'), {
            type: 'bar',
            data: { labels: hours, datasets: [{ label: 'Orders', data: r.by_hour, backgroundColor: '#e07b2966' }] },
            options: { plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true } } }
        });

        // Day revenue chart
        const dayLabels  = r.by_day.map(d => d.day);
        const dayRevenue = r.by_day.map(d => d.revenue);
        if (chartDay) chartDay.destroy();
        chartDay = new Chart(document.getElementById('chartDay'), {
            type: 'line',
            data: { labels: dayLabels, datasets: [{ label: 'Omzet (€)', data: dayRevenue, borderColor: '#3a7d44', backgroundColor: '#3a7d4422', tension: 0.3, fill: true }] },
            options: { plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true } } }
        });

        // History table
        const tbody = document.getElementById('historyTbody');
        if (!r.history.length) {
            tbody.innerHTML = '<tr><td colspan="5" class="empty-state">Geen orders in deze periode.</td></tr>';
            return;
        }
        tbody.innerHTML = r.history.map(o => {
            const items = o.items.map(i => `${i.quantity}× ${esc(i.product_name)}`).join(', ');
            const badge = o.order_status_id == 1 ? 'badge-wait' : o.order_status_id == 2 ? 'badge-busy' : 'badge-done';
            return `<tr>
                <td>${fmtDateTime(o.datetime)}</td>
                <td>#${o.pickup_number}</td>
                <td style="max-width:260px;white-space:normal;">${items}</td>
                <td>${eur(o.price_total)}</td>
                <td><span class="badge ${badge}">${esc(o.status_name||'—')}</span></td>
            </tr>`;
        }).join('');
    });
}

// ── Initialise ───────────────────────────────────────────────────────────────
loadProducts();
</script>

<?php endif; ?>
</body>
</html>
