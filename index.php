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

function getCarouselImages(): array
{
    return [
        'https://images.unsplash.com/photo-1590301157890-4810ed352733?w=1200&fit=crop',
        'https://images.unsplash.com/photo-1512621776951-a57141f2eefd?w=1200&fit=crop',
        'https://images.unsplash.com/photo-1525351484163-7529414344d8?w=1200&fit=crop',
        'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=1200&fit=crop',
        'https://images.unsplash.com/photo-1540420773420-3366772f4999?w=1200&fit=crop',
        'https://images.unsplash.com/photo-1550547660-d9450f859349?w=1200&fit=crop',
        'https://images.unsplash.com/photo-1536256263959-770b48d82b0a?w=1200&fit=crop',
        'https://images.unsplash.com/photo-1610970881699-44a5587cabec?w=1200&fit=crop',
    ];
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
    if (str_contains($name, '(VG)')) {
        return 'VG';
    }

    if (str_contains($name, '(V)')) {
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
$carouselImages = getCarouselImages();
$categories = buildCategories(getCategoryLabels());

$mysqli = createDatabaseConnection(getDatabaseConfig());
if ($mysqli->connect_errno) {
    $dbError = 'Kan geen verbinding maken met de database.';
} else {
    $mysqli->set_charset('utf8mb4');
    $items = fetchAvailableProducts($mysqli, $fallbackImages);
}
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
            <img src="https://img.notionusercontent.com/s3/prod-files-secure%2F0216a67a-859e-4730-996f-5d51b31fa395%2F7c10c1b1-c60b-4e04-9ea3-40cb0fe1a6e1%2Flogo_big_complete_transparent.png/size/w=410?exp=1770726629&sig=2foQVcUIt5aUn5Z5VLv574VSUUBQp01M09NmTKkuJjE&id=2e769bb8-092d-815e-a424-f2becdccb3a2&table=block" alt="Happy Herbivore Logo">
        </div>
        <p class="welcome-tagline-top" data-i18n="welcome.subtitle">Healthy in a hurry</p>
        <button class="welcome-start-btn" id="welcome-start-btn" data-i18n="welcome.start">
            Raak aan om te starten
        </button>
        <p class="welcome-tagline" data-i18n="welcome.tagline">Gezond &bull; Vers &bull; Plantaardig</p>
    </div>

    <!-- Hint onderaan -->
    <div class="welcome-hint">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="6 9 12 15 18 9"/>
        </svg>
        <span data-i18n="welcome.hint">Tik ergens om te beginnen</span>
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
     BESTELSCHERM
     ═══════════════════════════════════════════════════════════════════════════════ -->
<div class="screen order-screen" data-screen="order">
    <!-- Sidebar met categorieën -->
    <aside class="order-sidebar">
        <div class="sidebar-header">
            <div class="sidebar-brand">
                <img class="sidebar-logo-small" src="https://img.notionusercontent.com/s3/prod-files-secure%2F0216a67a-859e-4730-996f-5d51b31fa395%2F58edc398-a183-41b1-b8b5-a800367697dc%2Flogo_big_dinosaur_transparent.png/size/w=410?exp=1770459616&sig=gt1jbJEyKpuPhxyZY1ZOFtXnBDrxpt-kMoT97wHIyiM&id=2e769bb8-092d-815e-a27b-e5132b99e81a&table=block" alt="Happy Herbivore Dino">
                <img class="sidebar-logo-text" src="https://img.notionusercontent.com/s3/prod-files-secure%2F0216a67a-859e-4730-996f-5d51b31fa395%2F41dca380-aef7-4a7c-bbdb-04294d9580f3%2Flogo_big_happy_herbivore_transparent.png/size/w=410?exp=1770459615&sig=AbXzOoDRUjawRQQldgwgfUb97uOujwIU3mk5nDv0eg0&id=2e769bb8-092d-817c-aef9-decb4d448961&table=block" alt="Happy Herbivore">
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
                                <span class="product-price">&euro;<?php echo number_format($item['price'], 2); ?></span>
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
            <div class="review-totals-row">
                <span data-i18n="common.subtotal">Subtotaal</span>
                <span id="review-subtotal">&euro;0,00</span>
            </div>
            <div class="review-totals-row">
                <span><span data-i18n="common.tax">BTW</span> (9%)</span>
                <span id="review-tax">&euro;0,00</span>
            </div>
            <div class="review-totals-divider"></div>
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
        <div class="upsell-countdown" id="upsell-countdown">15s</div>
        <h1 data-i18n="upsell.title">Maak het nog beter! &#127793;</h1>
        <p data-i18n="upsell.subtitle">Voeg deze gezonde extras toe aan je bestelling</p>
    </div>

    <div class="upsell-items-wrapper">
        <div class="upsell-grid" id="upsell-grid">
            <div class="upsell-card" data-upsell-id="u1" data-upsell-price="3.99">
                <div class="upsell-card-img">
                    <img src="https://images.unsplash.com/photo-1526318472351-c75fcf070305?w=400&fit=crop" alt="Chia Seed Pudding" loading="lazy">
                    <div class="upsell-selected-overlay">
                        <div class="upsell-check-circle">
                            <svg viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="upsell-card-body">
                    <h3>Chia Seed Pudding</h3>
                    <p class="upsell-desc">Vanilla chia pudding with berries</p>
                    <div class="upsell-card-bottom">
                        <span class="upsell-price">+&euro;3,99</span>
                        <span class="upsell-status not-added" data-i18n="common.add">Toevoegen</span>
                    </div>
                </div>
            </div>

            <div class="upsell-card" data-upsell-id="u2" data-upsell-price="4.50">
                <div class="upsell-card-img">
                    <img src="https://images.unsplash.com/photo-1600271886742-f049cd451bba?w=400&fit=crop" alt="Fresh Pressed Juice" loading="lazy">
                    <div class="upsell-selected-overlay">
                        <div class="upsell-check-circle">
                            <svg viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="upsell-card-body">
                    <h3>Fresh Pressed Juice</h3>
                    <p class="upsell-desc">Add a vitamin-packed juice</p>
                    <div class="upsell-card-bottom">
                        <span class="upsell-price">+&euro;4,50</span>
                        <span class="upsell-status not-added" data-i18n="common.add">Toevoegen</span>
                    </div>
                </div>
            </div>

            <div class="upsell-card" data-upsell-id="u3" data-upsell-price="2.99">
                <div class="upsell-card-img">
                    <img src="https://images.unsplash.com/photo-1607623814075-e51df1bdc82f?w=400&fit=crop" alt="Energy Protein Ball" loading="lazy">
                    <div class="upsell-selected-overlay">
                        <div class="upsell-check-circle">
                            <svg viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="upsell-card-body">
                    <h3>Energy Protein Ball</h3>
                    <p class="upsell-desc">Dates, nuts &amp; cacao</p>
                    <div class="upsell-card-bottom">
                        <span class="upsell-price">+&euro;2,99</span>
                        <span class="upsell-status not-added" data-i18n="common.add">Toevoegen</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="upsell-footer">
        <div class="upsell-footer-inner">
            <button class="upsell-skip-btn" id="upsell-skip-btn">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
                </svg>
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
    </div>

    <!-- Bovenste balk: bedankje + order naam -->
    <div class="conf-top-bar">
        <div class="conf-thanks">
            <h2 data-i18n="confirmation.thanks">Thanks!</h2>
            <p data-i18n="confirmation.ready">Your order will be ready soon!</p>
        </div>
        <div class="conf-order-name">
            <div class="conf-name-value" id="confirmation-number">A-101</div>
            <div class="conf-name-label" data-i18n="confirmation.orderName">Order name</div>
        </div>
    </div>

    <!-- Ruimte voor achtergrond (logo zit in de foto) -->
    <div class="conf-center-spacer"></div>

    <!-- Onderste balk: taalvlaggen + nieuwe bestelling knop -->
    <div class="conf-bottom-bar">
        <div class="conf-lang-flags">
            <button class="conf-lang-btn" data-lang="nl" title="Nederlands">
                <img src="https://flagcdn.com/w80/nl.png" alt="NL">
            </button>
            <button class="conf-lang-btn" data-lang="en" title="English">
                <img src="https://flagcdn.com/w80/gb.png" alt="EN">
            </button>
            <button class="conf-lang-btn" data-lang="fr" title="Français">
                <img src="https://flagcdn.com/w80/fr.png" alt="FR">
            </button>
            <button class="conf-lang-btn" data-lang="de" title="Deutsch">
                <img src="https://flagcdn.com/w80/de.png" alt="DE">
            </button>
        </div>
        <button class="conf-new-order-btn" id="new-order-btn" data-i18n="confirmation.newOrder">
            Place new order.
        </button>
    </div>
</div>

<script src="assets/js/app.js"></script>
</body>
</html>
