(function () {
    'use strict';

    /* ═══════════════════════════════════════════════════════════════════════════
       VERTALINGEN
       ═══════════════════════════════════════════════════════════════════════════ */
    const translations = {
        nl: {
            'welcome.start': 'Raak aan om te starten',
            'welcome.tagline': 'Gezond \u2022 Vers \u2022 Plantaardig',
            'welcome.subtitle': 'Healthy in a hurry',
            'welcome.hint': 'Tik ergens om te beginnen',
            'category.1': 'Ontbijt',
            'category.2': 'Bowls',
            'category.3': 'Wraps',
            'category.4': 'Diner',
            'category.5': 'Sauzen',
            'category.6': 'Dranken',
            'common.selectCategory': 'Selecteer een categorie',
            'common.selectItems': 'Selecteer je items',
            'common.add': 'Toevoegen',
            'common.total': 'Totaal',
            'common.items': 'items',
            'common.reviewOrder': 'Bestelling Bekijken',
            'common.confirmOrder': 'Bevestig Bestelling',
            'common.editOrder': 'Bestelling Wijzigen',
            'common.subtotal': 'Subtotaal',
            'common.tax': 'BTW',
            'review.title': 'Bekijk je bestelling',
            'review.subtitle': 'Controleer je items voordat je afrekent',
            'review.qty': 'Aantal',
            'upsell.title': 'Maak het nog beter! \u{1F331}',
            'upsell.subtitle': 'Voeg deze gezonde extras toe aan je bestelling',
            'upsell.noThanks': 'Nee Bedankt',
            'upsell.addItems': 'Items Toevoegen',
            'upsell.selectItems': 'Selecteer items om toe te voegen',
            'upsell.added': 'Toegevoegd',
            'confirmation.thanks': 'Bedankt!',
            'confirmation.ready': 'Je bestelling is zo klaar!',
            'confirmation.orderName': 'Bestelnummer',
            'confirmation.newOrder': 'Nieuwe bestelling plaatsen.',
        },
        en: {
            'welcome.start': 'Touch to Start',
            'welcome.tagline': 'Healthy \u2022 Fresh \u2022 Plant-Based',
            'welcome.subtitle': 'Healthy in a hurry',
            'welcome.hint': 'Tap anywhere to begin',
            'category.1': 'Breakfast',
            'category.2': 'Bowls',
            'category.3': 'Wraps',
            'category.4': 'Dinner',
            'category.5': 'Sauces',
            'category.6': 'Drinks',
            'common.selectCategory': 'Select a category',
            'common.selectItems': 'Select your items',
            'common.add': 'Add',
            'common.total': 'Total',
            'common.items': 'items',
            'common.reviewOrder': 'Review Order',
            'common.confirmOrder': 'Confirm Order',
            'common.editOrder': 'Edit Order',
            'common.subtotal': 'Subtotal',
            'common.tax': 'Tax',
            'review.title': 'Review Your Order',
            'review.subtitle': 'Check your items before checkout',
            'review.qty': 'Qty',
            'upsell.title': 'Boost Your Order! \u{1F331}',
            'upsell.subtitle': 'Add these healthy extras to complete your meal',
            'upsell.noThanks': 'No Thanks',
            'upsell.addItems': 'Add Items',
            'upsell.selectItems': 'Select Items to Add',
            'upsell.added': 'Added',
            'confirmation.thanks': 'Thanks!',
            'confirmation.ready': 'Your order will be ready soon!',
            'confirmation.orderName': 'Order name',
            'confirmation.newOrder': 'Place new order.',
        },
        fr: {
            'welcome.start': 'Touchez pour commencer',
            'welcome.tagline': 'Sain \u2022 Frais \u2022 V\u00e9g\u00e9tal',
            'welcome.subtitle': 'Healthy in a hurry',
            'welcome.hint': 'Appuyez n\'importe o\u00f9 pour commencer',
            'category.1': 'Petit-d\u00e9jeuner',
            'category.2': 'Bols',
            'category.3': 'Wraps',
            'category.4': 'D\u00eener',
            'category.5': 'Sauces',
            'category.6': 'Boissons',
            'common.selectCategory': 'S\u00e9lectionnez une cat\u00e9gorie',
            'common.selectItems': 'S\u00e9lectionnez vos articles',
            'common.add': 'Ajouter',
            'common.total': 'Total',
            'common.items': 'articles',
            'common.reviewOrder': 'V\u00e9rifier la commande',
            'common.confirmOrder': 'Confirmer la commande',
            'common.editOrder': 'Modifier la commande',
            'common.subtotal': 'Sous-total',
            'common.tax': 'TVA',
            'review.title': 'V\u00e9rifiez votre commande',
            'review.subtitle': 'V\u00e9rifiez vos articles avant de payer',
            'review.qty': 'Qt\u00e9',
            'upsell.title': 'Am\u00e9liorez votre commande! \u{1F331}',
            'upsell.subtitle': 'Ajoutez ces extras sains pour compl\u00e9ter votre repas',
            'upsell.noThanks': 'Non merci',
            'upsell.addItems': 'Ajouter des articles',
            'upsell.selectItems': 'S\u00e9lectionnez des articles \u00e0 ajouter',
            'upsell.added': 'Ajout\u00e9',
            'confirmation.thanks': 'Merci !',
            'confirmation.ready': 'Votre commande sera pr\u00eate bient\u00f4t !',
            'confirmation.orderName': 'Num\u00e9ro de commande',
            'confirmation.newOrder': 'Passer une nouvelle commande.',
        },
        de: {
            'welcome.start': 'Zum Starten ber\u00fchren',
            'welcome.tagline': 'Gesund \u2022 Frisch \u2022 Pflanzlich',
            'welcome.subtitle': 'Healthy in a hurry',
            'welcome.hint': 'Tippen Sie irgendwo, um zu beginnen',
            'category.1': 'Fr\u00fchst\u00fcck',
            'category.2': 'Bowls',
            'category.3': 'Wraps',
            'category.4': 'Abendessen',
            'category.5': 'So\u00dfen',
            'category.6': 'Getr\u00e4nke',
            'common.selectCategory': 'W\u00e4hlen Sie eine Kategorie',
            'common.selectItems': 'W\u00e4hlen Sie Ihre Artikel',
            'common.add': 'Hinzuf\u00fcgen',
            'common.total': 'Gesamt',
            'common.items': 'Artikel',
            'common.reviewOrder': 'Bestellung \u00fcberpr\u00fcfen',
            'common.confirmOrder': 'Bestellung best\u00e4tigen',
            'common.editOrder': 'Bestellung bearbeiten',
            'common.subtotal': 'Zwischensumme',
            'common.tax': 'MwSt',
            'review.title': '\u00dcberpr\u00fcfen Sie Ihre Bestellung',
            'review.subtitle': '\u00dcberpr\u00fcfen Sie Ihre Artikel vor dem Bezahlen',
            'review.qty': 'Menge',
            'upsell.title': 'Verbessern Sie Ihre Bestellung! \u{1F331}',
            'upsell.subtitle': 'F\u00fcgen Sie diese gesunden Extras hinzu',
            'upsell.noThanks': 'Nein Danke',
            'upsell.addItems': 'Artikel hinzuf\u00fcgen',
            'upsell.selectItems': 'W\u00e4hlen Sie Artikel zum Hinzuf\u00fcgen',
            'upsell.added': 'Hinzugef\u00fcgt',
            'confirmation.thanks': 'Danke!',
            'confirmation.ready': 'Ihre Bestellung ist bald fertig!',
            'confirmation.orderName': 'Bestellnummer',
            'confirmation.newOrder': 'Neue Bestellung aufgeben.',
        }
    };

    /* ═══════════════════════════════════════════════════════════════════════════
       STATE
       ═══════════════════════════════════════════════════════════════════════════ */
    let currentLanguage = 'nl';
    let cart = [];
    let selectedUpsellItems = [];
    let upsellTimer = null;
    let upsellCountdown = 15;

    /* ═══════════════════════════════════════════════════════════════════════════
       TAAL SYSTEEM
       ═══════════════════════════════════════════════════════════════════════════ */
    function t(key) {
        return (translations[currentLanguage] && translations[currentLanguage][key]) || key;
    }

    function updateAllTranslations() {
        document.querySelectorAll('[data-i18n]').forEach(function (el) {
            var key = el.getAttribute('data-i18n');
            var text = t(key);
            if (el.tagName === 'INPUT' || el.tagName === 'TEXTAREA') {
                el.placeholder = text;
            } else {
                el.textContent = text;
            }
        });
        // Update dynamische elementen
        updateCartUI();
        renderProductActions();
    }

    function setLanguage(lang) {
        currentLanguage = lang;
        // Update welkomstscherm vlaggen
        document.querySelectorAll('.lang-btn').forEach(function (btn) {
            btn.classList.toggle('active', btn.dataset.lang === lang);
        });
        // Update bevestigingsscherm vlaggen
        document.querySelectorAll('.conf-lang-btn').forEach(function (btn) {
            btn.classList.toggle('active', btn.dataset.lang === lang);
        });
        document.documentElement.lang = lang;
        updateAllTranslations();
    }

    /* ═══════════════════════════════════════════════════════════════════════════
       SCHERM NAVIGATIE
       ═══════════════════════════════════════════════════════════════════════════ */
    function showScreen(name) {
        document.querySelectorAll('.screen').forEach(function (s) {
            s.classList.toggle('active', s.dataset.screen === name);
        });
        // Stop upsell timer als we weg navigeren
        if (name !== 'upsell' && upsellTimer) {
            clearInterval(upsellTimer);
            upsellTimer = null;
        }
    }

    /* ═══════════════════════════════════════════════════════════════════════════
       WELKOMSTSCHERM CAROUSEL
       ═══════════════════════════════════════════════════════════════════════════ */
    let currentSlide = 0;
    const slides = document.querySelectorAll('.carousel-slide');

    function nextSlide() {
        if (slides.length === 0) return;
        slides[currentSlide].classList.remove('active');
        // Reset animation door inner opnieuw te forcen
        var inner = slides[currentSlide].querySelector('.carousel-slide-inner img');
        if (inner) {
            inner.style.animation = 'none';
            inner.offsetHeight; // trigger reflow
            inner.style.animation = '';
        }
        currentSlide = (currentSlide + 1) % slides.length;
        slides[currentSlide].classList.add('active');
    }

    if (slides.length > 0) {
        setInterval(nextSlide, 4000);
    }

    /* ═══════════════════════════════════════════════════════════════════════════
       WINKELWAGEN
       ═══════════════════════════════════════════════════════════════════════════ */
    function findCartItem(productId) {
        return cart.find(function (item) { return item.id === productId; });
    }

    function addToCart(productId) {
        var card = document.querySelector('.product-card[data-product-id="' + productId + '"]');
        if (!card) return;
        var existing = findCartItem(productId);
        if (existing) {
            existing.qty += 1;
        } else {
            cart.push({
                id: productId,
                title: card.dataset.title,
                price: parseFloat(card.dataset.price),
                kcal: parseInt(card.dataset.kcal, 10),
                image: card.dataset.image,
                tag: card.dataset.tag,
                description: card.dataset.description,
                qty: 1
            });
        }
        updateCartUI();
        renderProductActions();
    }

    function removeFromCart(productId) {
        var existing = findCartItem(productId);
        if (!existing) return;
        if (existing.qty > 1) {
            existing.qty -= 1;
        } else {
            cart = cart.filter(function (item) { return item.id !== productId; });
        }
        updateCartUI();
        renderProductActions();
    }

    function getCartTotals() {
        var totalItems = 0;
        var subtotal = 0;
        var totalKcal = 0;
        cart.forEach(function (item) {
            totalItems += item.qty;
            subtotal += item.qty * item.price;
            totalKcal += item.qty * item.kcal;
        });
        var tax = subtotal * 0.09;
        var total = subtotal + tax;
        return { totalItems: totalItems, subtotal: subtotal, tax: tax, total: total, totalKcal: totalKcal };
    }

    function formatCurrency(value) {
        return '\u20AC' + value.toFixed(2).replace('.', ',');
    }

    function updateCartUI() {
        var totals = getCartTotals();
        var cartLabel = document.getElementById('cart-label');
        var cartTotal = document.getElementById('cart-total');
        var goReviewBtn = document.getElementById('go-review-btn');

        if (cartLabel) {
            cartLabel.textContent = t('common.total') + ' (' + totals.totalItems + ' ' + t('common.items') + ')';
        }
        if (cartTotal) {
            cartTotal.textContent = formatCurrency(totals.total);
        }
        if (goReviewBtn) {
            goReviewBtn.disabled = cart.length === 0;
        }
    }

    /* ═══════════════════════════════════════════════════════════════════════════
       PRODUCT ACTIES RENDEREN (Add / +- knoppen)
       ═══════════════════════════════════════════════════════════════════════════ */
    function renderProductActions() {
        document.querySelectorAll('.product-card').forEach(function (card) {
            var productId = parseInt(card.dataset.productId, 10);
            var actionsEl = card.querySelector('.product-actions');
            if (!actionsEl) return;

            var item = findCartItem(productId);
            if (!item || item.qty === 0) {
                actionsEl.innerHTML =
                    '<button class="add-btn" data-action="add" data-id="' + productId + '">' +
                    '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>' +
                    t('common.add') +
                    '</button>';
            } else {
                actionsEl.innerHTML =
                    '<div class="qty-controls">' +
                    '<button class="qty-btn qty-btn-minus" data-action="remove" data-id="' + productId + '">&minus;</button>' +
                    '<span class="qty-value">' + item.qty + '</span>' +
                    '<button class="qty-btn qty-btn-plus" data-action="add" data-id="' + productId + '">+</button>' +
                    '</div>';
            }
        });
    }

    // Delegated event handling voor product acties
    document.querySelector('.menu-grid').addEventListener('click', function (e) {
        var btn = e.target.closest('[data-action]');
        if (!btn) return;
        var action = btn.dataset.action;
        var id = parseInt(btn.dataset.id, 10);
        if (action === 'add') addToCart(id);
        else if (action === 'remove') removeFromCart(id);
    });

    /* ═══════════════════════════════════════════════════════════════════════════
       CATEGORIE FILTERING
       ═══════════════════════════════════════════════════════════════════════════ */
    var currentCategory = 1;

    function filterCategory(catId) {
        currentCategory = catId;
        document.querySelectorAll('.product-card').forEach(function (card) {
            card.style.display = parseInt(card.dataset.categoryId, 10) === catId ? '' : 'none';
        });
        // Update actieve knop
        document.querySelectorAll('.category-btn').forEach(function (btn) {
            btn.classList.toggle('active', parseInt(btn.dataset.categoryId, 10) === catId);
        });
        // Update titel
        var titleEl = document.getElementById('category-title');
        if (titleEl) {
            titleEl.textContent = t('category.' + catId);
        }
    }

    document.querySelectorAll('.category-btn').forEach(function (btn) {
        btn.addEventListener('click', function () {
            filterCategory(parseInt(btn.dataset.categoryId, 10));
        });
    });

    /* ═══════════════════════════════════════════════════════════════════════════
       REVIEW SCHERM RENDEREN
       ═══════════════════════════════════════════════════════════════════════════ */
    function renderReview() {
        var container = document.getElementById('review-items-list');
        if (!container) return;
        container.innerHTML = '';

        cart.forEach(function (item) {
            var card = document.createElement('div');
            card.className = 'review-item-card';
            card.innerHTML =
                '<img class="review-item-img" src="' + item.image + '" alt="' + item.title + '">' +
                '<div class="review-item-info">' +
                    '<div class="review-item-name-row">' +
                        '<span class="review-item-name">' + item.title + '</span>' +
                        (item.tag ? '<span class="review-item-badge">' + item.tag + '</span>' : '') +
                    '</div>' +
                    '<p class="review-item-desc">' + item.description + '</p>' +
                    '<p class="review-item-kcal">' + item.kcal + ' kcal</p>' +
                '</div>' +
                '<div class="review-item-right">' +
                    '<p class="review-item-qty">' + t('review.qty') + ': ' + item.qty + '</p>' +
                    '<p class="review-item-price">' + formatCurrency(item.price * item.qty) + '</p>' +
                '</div>';
            container.appendChild(card);
        });

        // Update totalen
        var totals = getCartTotals();
        var subEl = document.getElementById('review-subtotal');
        var taxEl = document.getElementById('review-tax');
        var totalEl = document.getElementById('review-total');
        var kcalEl = document.getElementById('review-kcal');

        if (subEl) subEl.textContent = formatCurrency(totals.subtotal);
        if (taxEl) taxEl.textContent = formatCurrency(totals.tax);
        if (totalEl) totalEl.textContent = formatCurrency(totals.total);
        if (kcalEl) kcalEl.textContent = totals.totalKcal;
    }

    /* ═══════════════════════════════════════════════════════════════════════════
       UPSELL SCHERM
       ═══════════════════════════════════════════════════════════════════════════ */
    function startUpsellCountdown() {
        upsellCountdown = 15;
        selectedUpsellItems = [];
        updateUpsellUI();

        var countdownEl = document.getElementById('upsell-countdown');
        if (upsellTimer) clearInterval(upsellTimer);

        upsellTimer = setInterval(function () {
            upsellCountdown--;
            if (countdownEl) countdownEl.textContent = upsellCountdown + 's';
            if (upsellCountdown <= 0) {
                clearInterval(upsellTimer);
                upsellTimer = null;
                finishOrder();
            }
        }, 1000);
    }

    function toggleUpsellItem(upsellId) {
        var idx = selectedUpsellItems.indexOf(upsellId);
        if (idx >= 0) {
            selectedUpsellItems.splice(idx, 1);
        } else {
            selectedUpsellItems.push(upsellId);
        }
        updateUpsellUI();
    }

    function updateUpsellUI() {
        document.querySelectorAll('.upsell-card').forEach(function (card) {
            var uid = card.dataset.upsellId;
            var isSelected = selectedUpsellItems.indexOf(uid) >= 0;
            card.classList.toggle('selected', isSelected);
            var statusEl = card.querySelector('.upsell-status');
            if (statusEl) {
                if (isSelected) {
                    statusEl.textContent = t('upsell.added');
                    statusEl.className = 'upsell-status added';
                } else {
                    statusEl.textContent = t('common.add');
                    statusEl.className = 'upsell-status not-added';
                }
            }
        });

        // Update add-knop
        var addBtn = document.getElementById('upsell-add-btn');
        if (addBtn) {
            if (selectedUpsellItems.length > 0) {
                var totalUpcharge = 0;
                selectedUpsellItems.forEach(function (uid) {
                    var card = document.querySelector('.upsell-card[data-upsell-id="' + uid + '"]');
                    if (card) totalUpcharge += parseFloat(card.dataset.upsellPrice);
                });
                addBtn.textContent = t('upsell.addItems') + ' (+' + formatCurrency(totalUpcharge) + ')';
                addBtn.disabled = false;
            } else {
                addBtn.textContent = t('upsell.selectItems');
                addBtn.disabled = true;
            }
        }
    }

    // Upsell kaart klik
    document.querySelectorAll('.upsell-card').forEach(function (card) {
        card.addEventListener('click', function () {
            toggleUpsellItem(card.dataset.upsellId);
        });
    });

    /* ═══════════════════════════════════════════════════════════════════════════
       BESTELNUMMER GENEREREN
       ═══════════════════════════════════════════════════════════════════════════ */
    function generateOrderNumber() {
        var letters = ['A', 'B', 'C', 'D'];
        var letter = letters[Math.floor(Math.random() * letters.length)];
        var number = 100 + Math.floor(Math.random() * 900);
        return letter + '-' + number;
    }

    function finishOrder() {
        var numEl = document.getElementById('confirmation-number');
        if (numEl) numEl.textContent = generateOrderNumber();
        showScreen('confirmation');
    }

    /* ═══════════════════════════════════════════════════════════════════════════
       EVENT HANDLERS
       ═══════════════════════════════════════════════════════════════════════════ */

    // Taalkeuze (welkomstscherm)
    document.querySelectorAll('.lang-btn').forEach(function (btn) {
        btn.addEventListener('click', function (e) {
            e.stopPropagation();
            setLanguage(btn.dataset.lang);
        });
    });

    // Taalkeuze (bevestigingsscherm)
    document.querySelectorAll('.conf-lang-btn').forEach(function (btn) {
        btn.addEventListener('click', function () {
            setLanguage(btn.dataset.lang);
        });
    });

    // Welkom -> Bestellen (knop + klik overal op het welkomstscherm)
    function goToOrderScreen() {
        showScreen('order');
        filterCategory(1);
        renderProductActions();
    }

    document.getElementById('welcome-start-btn').addEventListener('click', function (e) {
        e.stopPropagation();
        goToOrderScreen();
    });

    // Klik overal op welkomstscherm om te starten (behalve op taalknoppen)
    document.getElementById('welcome-screen').addEventListener('click', function (e) {
        if (e.target.closest('.language-selector')) return;
        goToOrderScreen();
    });

    // Bestellen -> Review
    document.getElementById('go-review-btn').addEventListener('click', function () {
        if (cart.length === 0) return;
        renderReview();
        showScreen('review');
    });

    // Review -> Terug naar bestellen
    document.getElementById('review-back-btn').addEventListener('click', function () {
        showScreen('order');
    });

    document.getElementById('edit-order-btn').addEventListener('click', function () {
        showScreen('order');
    });

    // Review -> Upsell
    document.getElementById('confirm-order-btn').addEventListener('click', function () {
        showScreen('upsell');
        startUpsellCountdown();
    });

    // Upsell -> Skip
    document.getElementById('upsell-skip-btn').addEventListener('click', function () {
        if (upsellTimer) clearInterval(upsellTimer);
        upsellTimer = null;
        finishOrder();
    });

    // Upsell -> Toevoegen
    document.getElementById('upsell-add-btn').addEventListener('click', function () {
        if (upsellTimer) clearInterval(upsellTimer);
        upsellTimer = null;
        finishOrder();
    });

    // Bevestiging -> Nieuwe bestelling
    document.getElementById('new-order-btn').addEventListener('click', function () {
        cart = [];
        selectedUpsellItems = [];
        updateCartUI();
        renderProductActions();
        showScreen('welcome');
    });

    /* ═══════════════════════════════════════════════════════════════════════════
       INITIALISATIE
       ═══════════════════════════════════════════════════════════════════════════ */
    filterCategory(1);
    renderProductActions();
    updateCartUI();
    setLanguage('nl');

})();
