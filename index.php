<?php
declare(strict_types=1);

function getDatabaseConfig(): array
{
    return [
        'host' => '127.0.0.1',
        'user' => 'root',
        'pass' => '',
        'name' => 'products',
    ];
}

function createDatabaseConnection(array $config): mysqli
{
    return @new mysqli($config['host'], $config['user'], $config['pass'], $config['name']);
}

function getFallbackImages(): array
{
    return [
        1  => 'https://images.unsplash.com/photo-1590301157890-4810ed352733?w=600&fit=crop',
        2  => 'https://images.unsplash.com/photo-1626700051175-6818013e1d4f?w=600&fit=crop',
        3  => 'https://images.unsplash.com/photo-1525351484163-7529414344d8?w=600&fit=crop',
        4  => 'https://images.unsplash.com/photo-1517673400267-0251440c45dc?w=600&fit=crop',
        5  => 'https://images.unsplash.com/photo-1512621776951-a57141f2eefd?w=600&fit=crop',
        6  => 'https://images.unsplash.com/photo-1540420773420-3366772f4999?w=600&fit=crop',
        7  => 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=600&fit=crop',
        8  => 'https://images.unsplash.com/photo-1626700051175-6818013e1d4f?w=600&fit=crop',
        9  => 'https://images.unsplash.com/photo-1541519227354-08fa5d50c44d?w=600&fit=crop',
        10 => 'https://images.unsplash.com/photo-1550547660-d9450f859349?w=600&fit=crop',
        11 => 'https://images.unsplash.com/photo-1635608844692-af62c1a78ec7?w=600&fit=crop',
        12 => 'https://images.unsplash.com/photo-1579783483458-83d02f3c8670?w=600&fit=crop',
        13 => 'https://images.unsplash.com/photo-1593001874117-c99c800e3eb7?w=600&fit=crop',
        14 => 'https://images.unsplash.com/photo-1540420773420-3366772f4999?w=600&fit=crop',
        15 => 'https://images.unsplash.com/photo-1577805947697-89340abb6939?w=600&fit=crop',
        16 => 'https://images.unsplash.com/photo-1577805947697-89340abb6939?w=600&fit=crop',
        17 => 'https://images.unsplash.com/photo-1577805947697-89340abb6939?w=600&fit=crop',
        18 => 'https://images.unsplash.com/photo-1577805947697-89340abb6939?w=600&fit=crop',
        19 => 'https://images.unsplash.com/photo-1577805947697-89340abb6939?w=600&fit=crop',
        20 => 'https://images.unsplash.com/photo-1610970881699-44a5587cabec?w=600&fit=crop',
        21 => 'https://images.unsplash.com/photo-1536256263959-770b48d82b0a?w=600&fit=crop',
        22 => 'https://images.unsplash.com/photo-1560512823-829485b8bf24?w=600&fit=crop',
        23 => 'https://images.unsplash.com/photo-1553530666-ba11a7da3888?w=600&fit=crop',
        24 => 'https://images.unsplash.com/photo-1621263764928-df1444c5e859?w=600&fit=crop',
        25 => 'https://images.unsplash.com/photo-1512621776951-a57141f2eefd?w=600&fit=crop',
    ];
}

function buildCarouselFromProducts(array $items): array
{
    $seen = [];
    $images = [];
    foreach ($items as $item) {
        $img = $item['image'];
        if (!in_array($img, $seen, true)) {
            $seen[] = $img;
            $images[] = $img;
        }
    }
    return $images;
}

function getCategoryLabels(): array
{
    return [
        1 => 'Breakfast',
        2 => 'Bowls',
        3 => 'Wraps',
        4 => 'Dinner',
        5 => 'Sauce',
        6 => 'Drinks',
    ];
}

function buildCategories(array $categoryLabels): array
{
    $categories = [];
    foreach ($categoryLabels as $id => $label) {
        $categories[] = [
            'id'   => $id,
            'name' => $label,
        ];
    }
    return $categories;
}

function resolveProductTag(string $name): string
{
    if (strpos($name, '(VG)') !== false) {
        return 'VG';
    }

    if (strpos($name, '(V)') !== false) {
        return 'V';
    }

    return '';
}

function resolveProductImage(array $row, int $productId, array $fallbackImages): string
{
    if (!empty($row['image_id']) && $row['image_id'] !== '0') {
        return 'img/' . $row['image_id'];
    }

    return $fallbackImages[$productId] ?? 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=600&fit=crop';
}

function fetchAvailableProducts(mysqli $mysqli, array $fallbackImages): array
{
    $items = [];
    $prodResult = $mysqli->query(
        'SELECT product_id, category_id, image_id, name, description, price, kcal, available
         FROM products WHERE available = 1 ORDER BY category_id, product_id'
    );

    if (!$prodResult) {
        return $items;
    }

    while ($row = $prodResult->fetch_assoc()) {
        $productId = (int)$row['product_id'];

        $items[] = [
            'id'          => $productId,
            'category_id' => (int)$row['category_id'],
            'title'       => $row['name'],
            'description' => $row['description'] ?? '',
            'kcal'        => (int)$row['kcal'],
            'price'       => (float)$row['price'],
            'tag'         => resolveProductTag($row['name']),
            'image'       => resolveProductImage($row, $productId, $fallbackImages),
        ];
    }

    $prodResult->free();
    return $items;
}

$dbError = '';
$items = [];
$fallbackImages = getFallbackImages();
$categories = buildCategories(getCategoryLabels());

$mysqli = createDatabaseConnection(getDatabaseConfig());
if ($mysqli->connect_errno) {
    $dbError = 'Kan geen verbinding maken met de database.';
} else {
    $mysqli->set_charset('utf8mb4');
    $items = fetchAvailableProducts($mysqli, $fallbackImages);
}

$carouselImages = buildCarouselFromProducts($items);

// Fallback als er geen productafbeeldingen zijn
if (empty($carouselImages)) {
    $carouselImages = array_values($fallbackImages);
}

// Upsell: 2 drankjes (cat 6) + 1 saus (cat 5)
$upsellDrinks = array_slice(array_values(array_filter($items, function($i) { return $i['category_id'] === 6; })), 0, 2);
$upsellSauces = array_slice(array_values(array_filter($items, function($i) { return $i['category_id'] === 5; })), 0, 1);
$upsellItems  = array_merge($upsellDrinks, $upsellSauces);
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Happy Herbivore – Self-Service Kiosk</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<!-- ═══════════════════════════════════════════════════════════════════════════════
     WELKOMSTSCHERM
     ═══════════════════════════════════════════════════════════════════════════════ -->
<div class="screen welcome-screen active" data-screen="welcome" id="welcome-screen">
    <!-- Carousel achtergrond -->
    <div class="carousel-bg">
        <?php foreach ($carouselImages as $idx => $imgUrl): ?>
            <div class="carousel-slide <?php echo $idx === 0 ? 'active' : ''; ?>" data-slide="<?php echo $idx; ?>">
                <div class="carousel-slide-inner">
                    <img src="<?php echo htmlspecialchars($imgUrl); ?>" alt="Food" loading="lazy">
                </div>
            </div>
        <?php endforeach; ?>
        <div class="carousel-overlay"></div>
    </div>

    <!-- Groene gloed effect -->
    <div class="welcome-glow"></div>


    



    <!-- Centraal content -->
    <div class="welcome-center">
        <div class="welcome-logo">
            <div class="welcome-logo-inner">
                <img class="welcome-dino-gif" src="img/dansendino.gif" autoplay loop muted playsinline/> 	
            </div>
        </div>
        <button class="welcome-start-btn" id="welcome-start-btn" data-i18n="welcome.start">
            Raak aan om te starten
        </button>
        <p class="welcome-tagline" data-i18n="welcome.tagline">Gezond &bull; Vers &bull; Plantaardig</p>
    </div>

   

    <!-- Taalkeuze -->
    <div class="language-selector">
        <button class="lang-btn active" data-lang="nl" title="Nederlands">
            <img src="https://flagcdn.com/w80/nl.png" alt="Nederlands">
        </button>
        <button class="lang-btn" data-lang="en" title="English">
            <img src="https://flagcdn.com/w80/gb.png" alt="English">
        </button>
        <button class="lang-btn" data-lang="fr" title="Français">
            <img src="https://flagcdn.com/w80/fr.png" alt="Français">
        </button>
        <button class="lang-btn" data-lang="de" title="Deutsch">
            <img src="https://flagcdn.com/w80/de.png" alt="Deutsch">
        </button>
    </div>
</div>

<!-- ═══════════════════════════════════════════════════════════════════════════════
     DINE-IN / TAKEAWAY KEUZE
     ═══════════════════════════════════════════════════════════════════════════════ -->
<div class="screen dine-screen" data-screen="dine">
    <div class="dine-bg"></div>
    <div class="welcome-glow"></div>

    <div class="dine-center">
        <h1 class="dine-title" data-i18n="dine.title">Waar wil je eten?</h1>
        <div class="dine-options">
            <button class="dine-btn" id="dine-here-btn">
                <div class="dine-btn-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 11l19-9-9 19-2-8-8-2z"/>
                    </svg>
                </div>
                <span data-i18n="dine.here">Hier eten</span>
            </button>
            <button class="dine-btn" id="takeaway-btn">
                <div class="dine-btn-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/>
                        <line x1="3" y1="6" x2="21" y2="6"/>
                        <path d="M16 10a4 4 0 0 1-8 0"/>
                    </svg>
                </div>
                <span data-i18n="dine.takeaway">Meenemen</span>
            </button>
        </div>
    </div>

    <button class="dine-back-btn" id="dine-back-btn">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/>
        </svg>
    </button>
</div>

<!-- ═══════════════════════════════════════════════════════════════════════════════
     BESTELSCHERM
     ═══════════════════════════════════════════════════════════════════════════════ -->
<div class="screen order-screen" data-screen="order">
    <!-- Sidebar met categorieën -->
    <aside class="order-sidebar">
        <div class="sidebar-header">
            <div class="sidebar-brand">
                <img class="sidebar-logo-text" src="img/logo_big_complete_transparent.png" alt="Happy Herbivore">
            </div>
            <p class="sidebar-subtitle" data-i18n="common.selectCategory">Selecteer een categorie</p>
        </div>
        <div class="sidebar-categories">
            <?php foreach ($categories as $cat): ?>
                <button
                    class="category-btn<?php echo $cat['id'] === 1 ? ' active' : ''; ?>"
                    data-category-id="<?php echo (int)$cat['id']; ?>"
                    data-i18n="category.<?php echo (int)$cat['id']; ?>"
                >
                    <?php echo htmlspecialchars($cat['name']); ?>
                </button>
            <?php endforeach; ?>
        </div>

        <!-- Taalvlaggen onderaan sidebar - inklap menu -->
        <div class="sidebar-lang-flags">
            <div class="sidebar-lang-dropdown" id="sidebar-lang-dropdown">
                <button class="sidebar-lang-btn active" data-lang="nl" title="Nederlands">
                    <img src="https://flagcdn.com/w80/nl.png" alt="NL">
                    <span class="sidebar-lang-btn-label">Nederlands</span>
                </button>
                <button class="sidebar-lang-btn" data-lang="en" title="English">
                    <img src="https://flagcdn.com/w80/gb.png" alt="EN">
                    <span class="sidebar-lang-btn-label">English</span>
                </button>
                <button class="sidebar-lang-btn" data-lang="fr" title="Français">
                    <img src="https://flagcdn.com/w80/fr.png" alt="FR">
                    <span class="sidebar-lang-btn-label">Français</span>
                </button>
                <button class="sidebar-lang-btn" data-lang="de" title="Deutsch">
                    <img src="https://flagcdn.com/w80/de.png" alt="DE">
                    <span class="sidebar-lang-btn-label">Deutsch</span>
                </button>
            </div>
            <button class="sidebar-lang-toggle" id="sidebar-lang-toggle" title="Taal kiezen">
                <img class="sidebar-lang-toggle-flag" id="sidebar-active-flag" src="https://flagcdn.com/w80/nl.png" alt="NL">
                <span class="sidebar-lang-toggle-label">Taal / Language</span>
                <svg class="sidebar-lang-toggle-arrow" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="18 15 12 9 6 15"/></svg>
            </button>
        </div>
    </aside>

    <!-- Hoofd content -->
    <div class="order-main">
        <div class="order-header">
            <h1 id="category-title" data-i18n="category.1">Breakfast</h1>
            <p data-i18n="common.selectItems">Selecteer je items</p>
        </div>

        <div class="menu-grid-wrapper">
            <div class="menu-grid">
                <?php foreach ($items as $item): ?>
                    <div class="product-card"
                         data-category-id="<?php echo (int)$item['category_id']; ?>"
                         data-product-id="<?php echo (int)$item['id']; ?>"
                         data-title="<?php echo htmlspecialchars($item['title']); ?>"
                         data-price="<?php echo number_format($item['price'], 2, '.', ''); ?>"
                         data-kcal="<?php echo (int)$item['kcal']; ?>"
                         data-image="<?php echo htmlspecialchars($item['image']); ?>"
                         data-tag="<?php echo htmlspecialchars($item['tag']); ?>"
                         data-description="<?php echo htmlspecialchars($item['description']); ?>"
                    >
                        <div class="product-card-img">
                            <img src="<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['title']); ?>" loading="lazy">
                            <?php if ($item['tag']): ?>
                                <span class="product-badge"><?php echo htmlspecialchars($item['tag']); ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="product-card-body">
                            <h3><?php echo htmlspecialchars($item['title']); ?></h3>
                            <p class="product-desc"><?php echo htmlspecialchars($item['description']); ?></p>
                            <p class="product-kcal"><?php echo (int)$item['kcal']; ?> kcal</p>
                            <div class="product-card-footer">
                                <span class="product-price">&euro;<?php echo number_format($item['price'], 2, ',', ''); ?></span>
                                <div class="product-actions">
                                    <!-- JS voegt hier add-knop of qty-controls toe -->
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Cart footer -->
        <div class="cart-footer">
            <div class="cart-info">
                <div class="cart-icon-box">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/>
                        <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/>
                    </svg>
                </div>
                <div class="cart-text">
                    <div class="cart-label" id="cart-label">Total (0 items)</div>
                    <div class="cart-amount" id="cart-total">&euro;0,00</div>
                </div>
                <span id="cart-discount-badge" class="cart-discount-badge" style="display:none">10% korting</span>
            </div>
            <button class="review-order-btn" id="go-review-btn" disabled data-i18n="common.reviewOrder">
                Bestelling Bekijken
            </button>
        </div>
    </div>
</div>

<!-- ═══════════════════════════════════════════════════════════════════════════════
     REVIEW SCHERM
     ═══════════════════════════════════════════════════════════════════════════════ -->
<div class="screen review-screen" data-screen="review">
    <div class="review-header">
        <div class="review-header-inner">
            <button class="review-back-btn" id="review-back-btn">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/>
                </svg>
            </button>
            <div>
                <h1 data-i18n="review.title">Bekijk je bestelling</h1>
                <p data-i18n="review.subtitle">Controleer je items voordat je afrekent</p>
            </div>
        </div>
    </div>

    <div class="review-items-wrapper">
        <div class="review-items-list" id="review-items-list">
            <!-- Dynamisch gevuld via JS -->
        </div>
        <div style="margin-top: 24px;">
            <button class="edit-order-btn" id="edit-order-btn">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                </svg>
                <span data-i18n="common.editOrder">Bestelling Wijzigen</span>
            </button>
        </div>
    </div>

    <div class="review-footer">
        <div class="kcal-counter">
            <span>Kcal:</span>
            <span class="kcal-total" id="review-kcal">0</span>
        </div>
        <div class="review-totals">
            <div class="review-totals-divider"></div>
            <div class="review-totals-row subtotal-row" id="subtotal-row" style="display:none">
                <span>Subtotaal</span>
                <span class="subtotal-value" id="review-subtotal-value">&euro;0,00</span>
            </div>
            <div class="review-totals-row discount-row" id="discount-row" style="display:none">
                <span class="discount-label-text">🏷 10% QR-korting</span>
                <span class="discount-value" id="review-discount-value">− &euro;0,00</span>
            </div>
            <div class="review-totals-row total-row">
                <span data-i18n="common.total">Totaal</span>
                <span class="total-value" id="review-total">&euro;0,00</span>
            </div>
        </div>
        <button class="confirm-order-btn" id="confirm-order-btn" data-i18n="common.confirmOrder">
            Bevestig Bestelling
        </button>
    </div>
</div>

<!-- ═══════════════════════════════════════════════════════════════════════════════
     UPSELL SCHERM
     ═══════════════════════════════════════════════════════════════════════════════ -->
<div class="screen upsell-screen" data-screen="upsell">
    <div class="upsell-header">
        <div class="upsell-header-content">
            <h1 data-i18n="upsell.title">Maak het compleet</h1>
            <p data-i18n="upsell.subtitle">Voeg een drankje of saus toe aan je bestelling</p>
        </div>
        <div class="upsell-countdown" id="upsell-countdown">30s</div>
    </div>

    <div class="upsell-items-wrapper">
        <div class="upsell-grid" id="upsell-grid">
            <?php foreach ($upsellItems as $idx => $upsell): ?>
            <div class="upsell-card"
                 data-upsell-id="u<?php echo $idx + 1; ?>"
                 data-product-id="<?php echo (int)$upsell['id']; ?>"
                 data-upsell-price="<?php echo number_format($upsell['price'], 2, '.', ''); ?>">
                <div class="upsell-card-img">
                    <img src="<?php echo htmlspecialchars($upsell['image']); ?>" alt="<?php echo htmlspecialchars($upsell['title']); ?>" loading="lazy">
                    <div class="upsell-selected-overlay">
                        <div class="upsell-check-circle">
                            <svg viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"/>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="upsell-card-body">
                    <h3><?php echo htmlspecialchars($upsell['title']); ?></h3>
                    <p class="upsell-desc"><?php echo htmlspecialchars($upsell['description']); ?></p>
                    <div class="upsell-card-bottom">
                        <span class="upsell-price">+&euro;<?php echo number_format($upsell['price'], 2, ',', ''); ?></span>
                        <span class="upsell-status not-added" data-i18n="common.add">Toevoegen</span>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="upsell-footer">
        <div class="upsell-footer-inner">
            <button class="upsell-skip-btn" id="upsell-skip-btn">
                <span data-i18n="upsell.noThanks">Nee Bedankt</span>
            </button>
            <button class="upsell-add-btn" id="upsell-add-btn" disabled data-i18n="upsell.selectItems">
                Selecteer items om toe te voegen
            </button>
        </div>
    </div>
</div>

<!-- ═══════════════════════════════════════════════════════════════════════════════
     BEVESTIGINGSSCHERM (restaurant achtergrond)
     ═══════════════════════════════════════════════════════════════════════════════ -->
<div class="screen confirmation-screen" data-screen="confirmation">
    <!-- Restaurant achtergrond -->
    <div class="conf-bg">
        <img src="img/restaurant-bg.png" alt="Happy Herbivore Restaurant">
        <div class="conf-bg-overlay"></div>
    </div>

    <!-- Content wrapper -->
    <div class="conf-content">
        <!-- Bevestigingskaart -->
        <div class="conf-card">
            <div class="conf-card-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="20 6 9 17 4 12"/>
                </svg>
            </div>
            <h2 class="conf-card-title" data-i18n="confirmation.thanks">Thanks!</h2>
            <p class="conf-card-subtitle" data-i18n="confirmation.ready">Your order will be ready soon!</p>

            <div class="conf-order-badge">
                <span class="conf-order-label" data-i18n="confirmation.orderName">Order name</span>
                <span class="conf-order-number" id="confirmation-number">A-101</span>
            </div>
        </div>

        <!-- Onderste balk: nieuwe bestelling knop -->
        <div class="conf-bottom-bar">
            <button class="conf-new-order-btn" id="new-order-btn" data-i18n="confirmation.newOrder">
                Nieuwe bestelling plaatsen
            </button>
        </div>
    </div>
</div>

<!-- ══ PRODUCT SUGGESTIE MODAL ══ -->
<div id="pairing-modal" style="
    display:none; position:fixed; inset:0; z-index:9000;
    background:rgba(0,0,0,0.55); align-items:center; justify-content:center;
">
    <div style="
        background:#fff; border-radius:24px; padding:40px 36px; max-width:480px; width:90%;
        box-shadow:0 24px 64px rgba(0,0,0,0.25); text-align:center; position:relative;
    ">
        <img id="pairing-img" src="" alt="" style="
            width:180px; height:180px; object-fit:cover; border-radius:16px;
            margin-bottom:16px; display:block; margin-left:auto; margin-right:auto;
            box-shadow:0 4px 16px rgba(0,0,0,0.12);
        ">
        <h2 style="font-size:22px; font-weight:800; color:#1a2e1c; margin-bottom:8px;" id="pairing-title">Lekker erbij!</h2>
        <p style="font-size:15px; color:#6b8a6f; margin-bottom:6px;" id="pairing-desc"></p>
        <p style="font-size:22px; font-weight:700; color:#3a7d44; margin-bottom:28px;" id="pairing-price"></p>
        <div style="display:flex; gap:14px; justify-content:center;">
            <button id="pairing-skip" style="
                flex:1; padding:16px; border-radius:14px; border:2px solid #d0e0d2;
                background:#fff; font-size:16px; font-weight:600; color:#6b8a6f; cursor:pointer;
            ">Nee, dank je</button>
            <button id="pairing-add" style="
                flex:1; padding:16px; border-radius:14px; border:none;
                background:#3a7d44; color:#fff; font-size:16px; font-weight:700; cursor:pointer;
            ">Ja, voeg toe!</button>
        </div>
    </div>
</div>

<script src="assets/js/app.js?v=<?php echo time(); ?>"></script>
</body>
</html>
