(function () {
    'use strict';

    /* ═══════════════════════════════════════════════════════════════════════════
       VERTALINGEN
       ═══════════════════════════════════════════════════════════════════════════ */
    const translations = {
        nl: {
            'welcome.start': 'Raak aan om te starten',
            'dine.title': 'Waar wil je eten?',
            'dine.here': 'Hier eten',
            'dine.takeaway': 'Meenemen',
            'welcome.tagline': 'Gezond \u2022 Vers \u2022 Plantaardig',
            'welcome.subtitle': 'Healthy in a hurry',
            'welcome.hint': 'Tik ergens om te beginnen',
            'category.1': 'Ontbijt',
            'category.2': 'Lunch en Diner',
            'category.3': 'Wraps en Sandwiches',
            'category.4': 'Bijgerechten',
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
            'common.inclTax': 'incl. 9% BTW',
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
            'dine.title': 'Where would you like to eat?',
            'dine.here': 'Eat here',
            'dine.takeaway': 'Takeaway',
            'welcome.tagline': 'Healthy \u2022 Fresh \u2022 Plant-Based',
            'welcome.subtitle': 'Healthy in a hurry',
            'welcome.hint': 'Tap anywhere to begin',
            'category.1': 'Breakfast',
            'category.2': 'Lunch and Dinner',
            'category.3': 'Wraps and Sandwiches',
            'category.4': 'Side Dishes',
            'category.5': 'Dips',
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
            'common.inclTax': 'incl. 9% tax',
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
            'dine.title': 'Où voulez-vous manger\u00a0?',
            'dine.here': 'Dans le restaurant',
            'dine.takeaway': '\u00c0 emporter',
            'welcome.tagline': 'Sain \u2022 Frais \u2022 V\u00e9g\u00e9tal',
            'welcome.subtitle': 'Healthy in a hurry',
            'welcome.hint': 'Appuyez n\'importe o\u00f9 pour commencer',
            'category.1': 'Petit-d\u00e9jeuner',
            'category.2': 'Diner et Lunch',
            'category.3': 'Wraps et Sandwichs',
            'category.4': 'Side Dishes',
            'category.5': 'Dips',
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
            'common.inclTax': 'TVA 9% incl.',
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
            'dine.title': 'Wo m\u00f6chten Sie essen?',
            'dine.here': 'Hier essen',
            'dine.takeaway': 'Mitnehmen',
            'welcome.tagline': 'Gesund \u2022 Frisch \u2022 Pflanzlich',
            'welcome.subtitle': 'Healthy in a hurry',
            'welcome.hint': 'Tippen Sie irgendwo, um zu beginnen',
            'category.1': 'Fr\u00fchst\u00fcck',
            'category.2': 'Diner und Lunch',
            'category.3': 'Wraps und Sandwiches',
            'category.4': 'Beilagen',
            'category.5': 'Dips',
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
            'common.inclTax': 'inkl. 9% MwSt',
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
       PRODUCTVERTALINGEN (per product_id)
       ═══════════════════════════════════════════════════════════════════════════ */
    const productTranslations = {
        1:  { nl: { name: 'Morning Boost Açaí Bowl (VG)',              desc: 'Gekoelde mix van açaí en banaan met granola, chiazaad en kokos.' },
              en: { name: 'Morning Boost Açaí Bowl (VG)',              desc: 'Chilled blend of açaí and banana topped with granola, chia seeds, and coconut.' },
              fr: { name: 'Bol Açaí Morning Boost (VG)',               desc: 'Mélange glacé d\'açaí et banane garni de granola, graines de chia et noix de coco.' },
              de: { name: 'Morning Boost Açaí Bowl (VG)',              desc: 'Gekühlte Açaí-Bananen-Mischung mit Granola, Chiasamen und Kokos.' } },
        2:  { nl: { name: 'De Tuinontbijt Wrap (V)',                   desc: 'Volkoren wrap met roerei, spinazie en yoghurt-kruidensaus.' },
              en: { name: 'The Garden Breakfast Wrap (V)',              desc: 'Whole-grain wrap with scrambled eggs, spinach, and yogurt-herb sauce.' },
              fr: { name: 'Wrap Petit-Déjeuner du Jardin (V)',         desc: 'Wrap complet avec œufs brouillés, épinards et sauce au yaourt.' },
              de: { name: 'Garten-Frühstückswrap (V)',                 desc: 'Vollkornwrap mit Rührei, Spinat und Joghurt-Kräutersoße.' } },
        3:  { nl: { name: 'Pindakaas & Cacao Toast (VG)',              desc: 'Zuurdesemtoast met pindakaas, banaan en cacaonibs.' },
              en: { name: 'Peanut Butter & Cacao Toast (VG)',          desc: 'Sourdough toast with peanut butter, banana, and cacao nibs.' },
              fr: { name: 'Toast Beurre de Cacahuète & Cacao (VG)',    desc: 'Toast au levain avec beurre de cacahuète, banane et éclats de cacao.' },
              de: { name: 'Erdnussbutter & Kakao Toast (VG)',          desc: 'Sauerteigtoast mit Erdnussbutter, Banane und Kakaonibs.' } },
        4:  { nl: { name: 'Overnight Oats: Appeltaart Stijl (VG)',     desc: 'Havermout met amandelmelk, appel, kaneel en walnoten.' },
              en: { name: 'Overnight Oats: Apple Pie Style (VG)',      desc: 'Oats with almond milk, apple, cinnamon, and walnuts.' },
              fr: { name: 'Overnight Oats : Façon Tarte aux Pommes (VG)', desc: 'Flocons d\'avoine au lait d\'amande, pomme, cannelle et noix.' },
              de: { name: 'Overnight Oats: Apfelkuchen Art (VG)',      desc: 'Haferflocken mit Mandelmilch, Apfel, Zimt und Walnüssen.' } },
        5:  { nl: { name: 'Tofu Power Tahini Bowl (VG)',               desc: 'Quinoa, esdoorn-geglazuurde tofu, zoete aardappel, boerenkool en tahinidressing.' },
              en: { name: 'Tofu Power Tahini Bowl (VG)',               desc: 'Quinoa, maple-glazed tofu, sweet potato, kale, and tahini dressing.' },
              fr: { name: 'Bol Tofu Power Tahini (VG)',                desc: 'Quinoa, tofu glacé à l\'érable, patate douce, chou kale et sauce tahini.' },
              de: { name: 'Tofu Power Tahini Bowl (VG)',               desc: 'Quinoa, ahornglasierter Tofu, Süßkartoffel, Grünkohl und Tahini-Dressing.' } },
        6:  { nl: { name: 'Mediterrane Falafel Bowl (VG)',             desc: 'Gebakken falafel, hummus, ingelegde ui, tomaten en komkommer.' },
              en: { name: 'Mediterranean Falafel Bowl (VG)',           desc: 'Baked falafel, hummus, pickled onions, tomatoes, and cucumber.' },
              fr: { name: 'Bol Falafel Méditerranéen (VG)',            desc: 'Falafel au four, houmous, oignons marinés, tomates et concombre.' },
              de: { name: 'Mediterrane Falafel Bowl (VG)',             desc: 'Gebackene Falafel, Hummus, eingelegte Zwiebeln, Tomaten und Gurke.' } },
        7:  { nl: { name: 'Warme Teriyaki Tempeh Bowl (VG)',           desc: 'Bruine rijst, tempeh, broccoli, wortels en gember-sojaglazing.' },
              en: { name: 'Warm Teriyaki Tempeh Bowl (VG)',            desc: 'Brown rice, tempeh, broccoli, carrots, and ginger-soy glaze.' },
              fr: { name: 'Bol Tempeh Teriyaki Chaud (VG)',            desc: 'Riz complet, tempeh, brocoli, carottes et glaçage gingembre-soja.' },
              de: { name: 'Warme Teriyaki Tempeh Bowl (VG)',           desc: 'Brauner Reis, Tempeh, Brokkoli, Karotten und Ingwer-Soja-Glasur.' } },
        8:  { nl: { name: 'Pittige Kikkererwten Hummus Wrap (VG)',     desc: 'Gekruide kikkererwten, wortels, sla en hummus in volkoren wrap.' },
              en: { name: 'Zesty Chickpea Hummus Wrap (VG)',           desc: 'Spiced chickpeas, carrots, lettuce, and hummus in whole-wheat wrap.' },
              fr: { name: 'Wrap Pois Chiches & Houmous (VG)',          desc: 'Pois chiches épicés, carottes, laitue et houmous en wrap complet.' },
              de: { name: 'Würziger Kichererbsen-Hummus-Wrap (VG)',    desc: 'Gewürzte Kichererbsen, Karotten, Salat und Hummus im Vollkornwrap.' } },
        9:  { nl: { name: 'Avocado & Halloumi Tostie (V)',             desc: 'Gegrilde halloumi, avocado en chilivlokken op meergranenbrood.' },
              en: { name: 'Avocado & Halloumi Toastie (V)',            desc: 'Grilled halloumi, avocado, and chili flakes on multigrain bread.' },
              fr: { name: 'Toastie Avocat & Halloumi (V)',             desc: 'Halloumi grillé, avocat et flocons de piment sur pain multicéréales.' },
              de: { name: 'Avocado & Halloumi Toastie (V)',            desc: 'Gegrillter Halloumi, Avocado und Chiliflocken auf Mehrkornbrot.' } },
        10: { nl: { name: 'Smoky BBQ Jackfruit Slider (VG)',           desc: 'Geplukte jackfruit in BBQ-saus met knapperige coleslaw.' },
              en: { name: 'Smoky BBQ Jackfruit Slider (VG)',           desc: 'Pulled jackfruit in BBQ sauce with crunchy slaw.' },
              fr: { name: 'Slider Jackfruit BBQ Fumé (VG)',            desc: 'Jackfruit effiloché en sauce BBQ avec salade croquante.' },
              de: { name: 'Smoky BBQ Jackfruit Slider (VG)',           desc: 'Pulled Jackfruit in BBQ-Soße mit knackigem Krautsalat.' } },
        11: { nl: { name: 'Ovengebakken Zoete Aardappel Partjes (VG)', desc: 'Gekruid met gerookte paprika.' },
              en: { name: 'Oven-Baked Sweet Potato Wedges (VG)',       desc: 'Seasoned with smoked paprika.' },
              fr: { name: 'Quartiers de Patate Douce au Four (VG)',    desc: 'Assaisonnés au paprika fumé.' },
              de: { name: 'Ofengebackene Süßkartoffelspalten (VG)',    desc: 'Gewürzt mit geräuchertem Paprika.' } },
        12: { nl: { name: 'Courgette Frietjes (V)',                    desc: 'Knapperig gepaneerde courgettesticks.' },
              en: { name: 'Zucchini Fries (V)',                        desc: 'Crispy breaded zucchini sticks.' },
              fr: { name: 'Frites de Courgette (V)',                   desc: 'Bâtonnets de courgette panés et croustillants.' },
              de: { name: 'Zucchini-Pommes (V)',                       desc: 'Knusprig panierte Zucchinisticks.' } },
        13: { nl: { name: 'Gebakken Falafel Bites - 5st (VG)',        desc: 'Vijf gebakken falafelhapjes.' },
              en: { name: 'Baked Falafel Bites - 5pcs (VG)',          desc: 'Five baked falafel bites.' },
              fr: { name: 'Bouchées de Falafel au Four - 5pcs (VG)',  desc: 'Cinq bouchées de falafel au four.' },
              de: { name: 'Gebackene Falafel Bites - 5 Stk. (VG)',   desc: 'Fünf gebackene Falafel-Häppchen.' } },
        14: { nl: { name: 'Mini Groenteplankje & Hummus (VG)',         desc: 'Bleekselderij, wortels, komkommer met hummus.' },
              en: { name: 'Mini Veggie Platter & Hummus (VG)',         desc: 'Celery, carrots, cucumber with hummus.' },
              fr: { name: 'Mini Plateau de Légumes & Houmous (VG)',    desc: 'Céleri, carottes, concombre avec houmous.' },
              de: { name: 'Mini Gemüseplatte & Hummus (VG)',           desc: 'Sellerie, Karotten, Gurke mit Hummus.' } },
        15: { nl: { name: 'Klassieke Hummus (VG)',                     desc: null },
              en: { name: 'Classic Hummus (VG)',                       desc: null },
              fr: { name: 'Houmous Classique (VG)',                    desc: null },
              de: { name: 'Klassischer Hummus (VG)',                   desc: null } },
        16: { nl: { name: 'Avocado Limoen Crema (VG)',                 desc: null },
              en: { name: 'Avocado Lime Crema (VG)',                   desc: null },
              fr: { name: 'Crème Avocat Citron Vert (VG)',             desc: null },
              de: { name: 'Avocado-Limetten-Crema (VG)',               desc: null } },
        17: { nl: { name: 'Griekse Yoghurt Ranch (V)',                 desc: null },
              en: { name: 'Greek Yogurt Ranch (V)',                    desc: null },
              fr: { name: 'Ranch au Yaourt Grec (V)',                  desc: null },
              de: { name: 'Griechischer Joghurt Ranch (V)',            desc: null } },
        18: { nl: { name: 'Pittige Sriracha Mayo (VG)',                desc: null },
              en: { name: 'Spicy Sriracha Mayo (VG)',                  desc: null },
              fr: { name: 'Mayo Sriracha Piquante (VG)',               desc: null },
              de: { name: 'Scharfe Sriracha Mayo (VG)',                desc: null } },
        19: { nl: { name: 'Pindasatésaus (VG)',                        desc: null },
              en: { name: 'Peanut Satay Sauce (VG)',                   desc: null },
              fr: { name: 'Sauce Satay Cacahuète (VG)',                desc: null },
              de: { name: 'Erdnuss-Satay-Soße (VG)',                   desc: null } },
        20: { nl: { name: 'Groene Gloed Smoothie',                     desc: 'Spinazie, ananas, komkommer, kokoswater.' },
              en: { name: 'Green Glow Smoothie',                       desc: 'Spinach, pineapple, cucumber, coconut water.' },
              fr: { name: 'Smoothie Éclat Vert',                       desc: 'Épinards, ananas, concombre, eau de coco.' },
              de: { name: 'Green Glow Smoothie',                       desc: 'Spinat, Ananas, Gurke, Kokoswasser.' } },
        21: { nl: { name: 'Ijskoude Matcha Latte',                     desc: 'Licht gezoete matcha met amandelmelk.' },
              en: { name: 'Iced Matcha Latte',                         desc: 'Lightly sweetened matcha with almond milk.' },
              fr: { name: 'Matcha Latte Glacé',                        desc: 'Matcha légèrement sucré au lait d\'amande.' },
              de: { name: 'Eisgekühlter Matcha Latte',                 desc: 'Leicht gesüßter Matcha mit Mandelmilch.' } },
        22: { nl: { name: 'Fruitwater',                                desc: 'Citroen-munt, aardbei-basilicum of komkommer-limoen.' },
              en: { name: 'Fruit-Infused Water',                       desc: 'Lemon-mint, strawberry-basil, or cucumber-lime.' },
              fr: { name: 'Eau Infusée aux Fruits',                    desc: 'Citron-menthe, fraise-basilic ou concombre-citron vert.' },
              de: { name: 'Fruchtwasser',                              desc: 'Zitrone-Minze, Erdbeere-Basilikum oder Gurke-Limette.' } },
        23: { nl: { name: 'Bessen Blast Smoothie',                     desc: 'Aardbeien, bosbessen, frambozen met amandelmelk.' },
              en: { name: 'Berry Blast Smoothie',                      desc: 'Strawberries, blueberries, raspberries with almond milk.' },
              fr: { name: 'Smoothie Explosion de Baies',               desc: 'Fraises, myrtilles, framboises au lait d\'amande.' },
              de: { name: 'Beeren Blast Smoothie',                     desc: 'Erdbeeren, Blaubeeren, Himbeeren mit Mandelmilch.' } },
        24: { nl: { name: 'Citrus Cooler',                             desc: 'Sinaasappelsap, bruiswater, vleugje limoen.' },
              en: { name: 'Citrus Cooler',                             desc: 'Orange juice, sparkling water, hint of lime.' },
              fr: { name: 'Citrus Cooler',                             desc: 'Jus d\'orange, eau pétillante, pointe de citron vert.' },
              de: { name: 'Citrus Cooler',                             desc: 'Orangensaft, Sprudelwasser, Hauch von Limette.' } },
        25: { nl: { name: 'De Supergroene Oogst (VG)',                 desc: 'Gemasseerde boerenkool, edamame, avocado, komkommer en geroosterde pompoenpitten met citroen-olijfolie.' },
              en: { name: 'The Supergreen Harvest (VG)',               desc: 'Massaged kale, edamame, avocado, cucumber, and toasted pumpkin seeds with lemon-olive oil.' },
              fr: { name: 'La Récolte Super Verte (VG)',               desc: 'Chou kale massé, edamame, avocat, concombre et graines de courge grillées à l\'huile d\'olive citronnée.' },
              de: { name: 'Die Supergrüne Ernte (VG)',                 desc: 'Massierter Grünkohl, Edamame, Avocado, Gurke und geröstete Kürbiskerne mit Zitronen-Olivenöl.' } }
    };

    /* ═══════════════════════════════════════════════════════════════════════════
       STATE
       ═══════════════════════════════════════════════════════════════════════════ */
    let currentLanguage = 'nl';
    let cart = [];
    let orderType = 'dine-in';
    let selectedUpsellItems = [];
    let upsellTimer = null;
    let upsellCountdown = 15;
    let confirmationTimer = null;
    let discountPercent = 0;

    // Check URL params and sessionStorage for QR discount
    (function detectDiscount() {
        var params = new URLSearchParams(window.location.search);
        if (params.get('promo') === 'KIOSK10') {
            try { sessionStorage.setItem('qrDiscount', 'KIOSK10'); } catch (e) {}
        }
        try {
            if (sessionStorage.getItem('qrDiscount') === 'KIOSK10') {
                discountPercent = 10;
            }
        } catch (e) {}
    })();

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

    var langFlagSrcs = {
        nl: 'https://flagcdn.com/w80/nl.png',
        en: 'https://flagcdn.com/w80/gb.png',
        fr: 'https://flagcdn.com/w80/fr.png',
        de: 'https://flagcdn.com/w80/de.png'
    };

    function setLanguage(lang) {
        currentLanguage = lang;
        document.querySelectorAll('.lang-btn, .sidebar-lang-btn').forEach(function (btn) {
            btn.classList.toggle('active', btn.dataset.lang === lang);
        });
        // Update active flag in toggle button
        var activeFlag = document.getElementById('sidebar-active-flag');
        if (activeFlag && langFlagSrcs[lang]) {
            activeFlag.src = langFlagSrcs[lang];
            activeFlag.alt = lang.toUpperCase();
        }
        // Close dropdown after selecting language
        closeLangDropdown();
        document.documentElement.lang = lang;
        updateAllTranslations();
        updateProductTranslations();
    }

    function translateProductCard(card, selectorH3, selectorDesc) {
        var pid = parseInt(card.dataset.productId, 10);
        var pt = productTranslations[pid];
        if (!pt || !pt[currentLanguage]) return;
        var tr = pt[currentLanguage];

        if (card.dataset.title !== undefined) card.dataset.title = tr.name;
        if (card.dataset.description !== undefined) card.dataset.description = tr.desc || '';

        var h3 = card.querySelector(selectorH3);
        if (h3) h3.textContent = tr.name;

        var descEl = card.querySelector(selectorDesc);
        if (descEl) descEl.textContent = tr.desc || '';
    }

    function updateProductTranslations() {
        document.querySelectorAll('.product-card').forEach(function (card) {
            translateProductCard(card, '.product-card-body h3', '.product-desc');
        });

        document.querySelectorAll('.upsell-card[data-product-id]').forEach(function (card) {
            translateProductCard(card, '.upsell-card-body h3', '.upsell-desc');
        });

        cart.forEach(function (item) {
            var pt = productTranslations[item.id];
            if (pt && pt[currentLanguage]) {
                item.title = pt[currentLanguage].name;
            }
        });
        updateCartUI();
    }

    function closeLangDropdown() {
        var dropdown = document.getElementById('sidebar-lang-dropdown');
        var toggle = document.getElementById('sidebar-lang-toggle');
        if (dropdown) dropdown.classList.remove('open');
        if (toggle) toggle.classList.remove('open');
    }

    // Toggle inklap taalvlaggen menu
    var sidebarLangToggle = document.getElementById('sidebar-lang-toggle');
    if (sidebarLangToggle) {
        sidebarLangToggle.addEventListener('click', function (e) {
            e.stopPropagation();
            var dropdown = document.getElementById('sidebar-lang-dropdown');
            var isOpen = dropdown && dropdown.classList.contains('open');
            if (isOpen) {
                closeLangDropdown();
            } else {
                if (dropdown) dropdown.classList.add('open');
                sidebarLangToggle.classList.add('open');
            }
        });
    }

    // Sluit dropdown bij klik buiten
    document.addEventListener('click', function () {
        closeLangDropdown();
    });

    /* ═══════════════════════════════════════════════════════════════════════════
       SCHERM NAVIGATIE
       ═══════════════════════════════════════════════════════════════════════════ */
    function resetToWelcome() {
        cart = [];
        selectedUpsellItems = [];
        discountPercent = 0;
        try { sessionStorage.removeItem('qrDiscount'); } catch (e) {}
        updateCartUI();
        renderProductActions();
        showScreen('welcome');
    }

    function showScreen(name) {
        document.querySelectorAll('.screen').forEach(function (s) {
            s.classList.toggle('active', s.dataset.screen === name);
        });
        // Bonprinter knop alleen zichtbaar op welkomstscherm
        var printerBtn = document.querySelector('.staff-printer-btn');
        if (printerBtn) printerBtn.style.display = (name === 'welcome') ? 'flex' : 'none';
        // Stop upsell timer als we weg navigeren
        if (name !== 'upsell' && upsellTimer) {
            clearInterval(upsellTimer);
            upsellTimer = null;
        }
        // Stop confirmation timer als we weg navigeren
        if (confirmationTimer) {
            clearTimeout(confirmationTimer);
            confirmationTimer = null;
        }
        // Start 5 seconden timer op bevestigingsscherm
        if (name === 'confirmation') {
            confirmationTimer = setTimeout(function () {
                confirmationTimer = null;
                resetToWelcome();
            }, 5000);
        }
    }

    /* ═══════════════════════════════════════════════════════════════════════════
       WELKOMSTSCHERM CAROUSEL
       ═══════════════════════════════════════════════════════════════════════════ */
    let currentSlide = 0;
    const slides = document.querySelectorAll('.carousel-slide');

    function nextSlide() {
        if (slides.length === 0) return;
        var prevIndex = currentSlide;
        currentSlide = (currentSlide + 1) % slides.length;

        // Oude slide blijft zichtbaar als achtergrond (geen transitie)
        slides[prevIndex].classList.add('carousel-prev');
        slides[prevIndex].classList.remove('active');

        // Nieuwe slide fades in bovenop
        slides[currentSlide].classList.add('active');

        // Na de fade-in de oude slide direct verbergen
        setTimeout(function () {
            slides[prevIndex].classList.remove('carousel-prev');

            // Reset zoom-animatie op oude slide voor volgende keer
            var inner = slides[prevIndex].querySelector('.carousel-slide-inner img');
            if (inner) {
                inner.style.animation = 'none';
                inner.offsetHeight;
                inner.style.animation = '';
            }
        }, 1400);
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

    /* Koppeling: welk product suggereert welke saus */
    var productPairings = {
        11: 16,  // Oven-Baked Sweet Potato Wedges → Avocado Lime Crema
        12: 17,  // Zucchini Fries               → Greek Yogurt Ranch
        13: 19,  // Baked Falafel Bites           → Peanut Satay Sauce
        14: 15   // Mini Veggie Platter & Hummus  → Classic Hummus
    };

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

        /* Toon suggestie als dit product een gekoppelde saus heeft */
        var pairedId = productPairings[productId];
        if (pairedId && !findCartItem(pairedId)) {
            showPairingSuggestion(pairedId);
        }
    }

    function showPairingSuggestion(sauceId) {
        var sauceCard = document.querySelector('.product-card[data-product-id="' + sauceId + '"]');
        if (!sauceCard) return;
        var modal = document.getElementById('pairing-modal');
        if (!modal) return;

        document.getElementById('pairing-img').src = sauceCard.dataset.image;
        document.getElementById('pairing-img').alt = sauceCard.dataset.title;
        document.getElementById('pairing-desc').textContent = sauceCard.dataset.title;
        document.getElementById('pairing-price').textContent =
            '+ € ' + parseFloat(sauceCard.dataset.price).toFixed(2).replace('.', ',');

        modal.style.display = 'flex';

        function close() {
            modal.style.display = 'none';
            document.getElementById('pairing-add').removeEventListener('click', onAdd);
            document.getElementById('pairing-skip').removeEventListener('click', close);
        }
        function onAdd() {
            addToCart(sauceId);
            close();
        }
        document.getElementById('pairing-add').addEventListener('click', onAdd);
        document.getElementById('pairing-skip').addEventListener('click', close);
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
        var discountAmount = discountPercent > 0 ? Math.round(subtotal * discountPercent) / 100 : 0;
        var total = subtotal - discountAmount;
        return { totalItems: totalItems, subtotal: subtotal, discountAmount: discountAmount, tax: 0, total: total, totalKcal: totalKcal };
    }

    function formatCurrency(value) {
        return '\u20AC' + value.toFixed(2).replace('.', ',');
    }

    function updateCartUI() {
        var totals = getCartTotals();
        var cartLabel = document.getElementById('cart-label');
        var cartTotal = document.getElementById('cart-total');
        var goReviewBtn = document.getElementById('go-review-btn');
        var discountBadge = document.getElementById('cart-discount-badge');

        if (cartLabel) {
            cartLabel.textContent = t('common.total') + ' (' + totals.totalItems + ' ' + t('common.items') + ')';
        }
        if (cartTotal) {
            cartTotal.textContent = formatCurrency(totals.total);
        }
        if (goReviewBtn) {
            goReviewBtn.disabled = cart.length === 0;
        }
        if (discountBadge) {
            discountBadge.style.display = discountPercent > 0 ? 'inline-flex' : 'none';
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
    function deleteItemFromCart(productId) {
        cart = cart.filter(function (item) { return item.id !== productId; });
        updateCartUI();
        renderProductActions();
        renderReview();
        // Als winkelwagen leeg: terug naar bestelscherm
        if (cart.length === 0) {
            showScreen('order');
        }
    }

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
                    '<div class="review-qty-controls">' +
                        '<button class="review-qty-btn review-qty-btn-minus" data-review-action="remove" data-id="' + item.id + '">\u2212</button>' +
                        '<span class="review-qty-value">' + item.qty + '</span>' +
                        '<button class="review-qty-btn review-qty-btn-plus" data-review-action="add" data-id="' + item.id + '">+</button>' +
                    '</div>' +
                    '<p class="review-item-price">' + formatCurrency(item.price * item.qty) + '</p>' +
                '</div>';
            container.appendChild(card);
        });

        // Delegated qty events in review
        container.querySelectorAll('[data-review-action]').forEach(function (btn) {
            btn.addEventListener('click', function () {
                var id = parseInt(btn.dataset.id, 10);
                if (btn.dataset.reviewAction === 'add') {
                    addToCart(id);
                } else {
                    removeFromCart(id);
                }
                if (cart.length === 0) {
                    showScreen('order');
                } else {
                    renderReview();
                }
            });
        });

        // Update totalen
        var totals = getCartTotals();
        var totalEl = document.getElementById('review-total');
        var kcalEl = document.getElementById('review-kcal');
        var discountRow = document.getElementById('discount-row');
        var discountValueEl = document.getElementById('review-discount-value');
        var subtotalRow = document.getElementById('subtotal-row');
        var subtotalValueEl = document.getElementById('review-subtotal-value');

        if (totalEl) totalEl.textContent = formatCurrency(totals.total);
        if (kcalEl) kcalEl.textContent = totals.totalKcal;

        if (discountRow) {
            discountRow.style.display = discountPercent > 0 ? 'flex' : 'none';
        }
        if (discountValueEl && discountPercent > 0) {
            discountValueEl.textContent = '− ' + formatCurrency(totals.discountAmount);
        }
        if (subtotalRow) {
            subtotalRow.style.display = discountPercent > 0 ? 'flex' : 'none';
        }
        if (subtotalValueEl && discountPercent > 0) {
            subtotalValueEl.textContent = formatCurrency(totals.subtotal);
        }
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
        return String(1 + Math.floor(Math.random() * 99));
    }

    function saveOrderForReceipt(pickupNumber) {
        var totals = getCartTotals();
        var orderData = {
            pickupNumber: pickupNumber,
            orderType: orderType,
            timestamp: new Date().toISOString(),
            items: cart.map(function (item) {
                return {
                    title: item.title,
                    qty: item.qty,
                    price: item.price
                };
            }),
            total: totals.total
        };
        try {
            localStorage.setItem('lastOrder', JSON.stringify(orderData));
        } catch (e) {
            console.warn('localStorage opslaan mislukt:', e);
        }
        triggerAutoPrint();
    }

    function triggerAutoPrint() {
        try {
            window.open('bonprinter.html', 'bonprinter', 'width=520,height=680');
        } catch (e) {
            console.warn('Bonprinter venster openen mislukt:', e);
        }
    }

    function finishOrder() {
        var numEl = document.getElementById('confirmation-number');
        var items = cart.map(function (item) {
            return { id: item.id, qty: item.qty, price: item.price };
        });

        if (items.length === 0) {
            console.log('Order niet verzonden: winkelwagen is leeg');
            var fallback = generateOrderNumber();
            if (numEl) numEl.textContent = fallback;
            saveOrderForReceipt(fallback);
            showScreen('confirmation');
            return;
        }

        var apiUrl = new URL('api/submit-order.php', window.location.href).href;
        console.log('Order verzenden naar', apiUrl, 'items:', items.length);
        fetch(apiUrl, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ items: items, order_type: orderType })
        })
            .then(function (res) {
                return res.text().then(function (text) {
                    try {
                        return JSON.parse(text);
                    } catch (e) {
                        console.error('Order API response:', text);
                        return { success: false };
                    }
                });
            })
            .then(function (data) {
                var pickupNum;
                if (data.success && data.pickup_display) {
                    console.log('Order opgeslagen:', data.pickup_display, 'order_id:', data.order_id);
                    pickupNum = data.pickup_display;
                    if (numEl) numEl.textContent = pickupNum;
                } else {
                    pickupNum = generateOrderNumber();
                    if (numEl) numEl.textContent = pickupNum;
                    if (data.error) console.error('Order API error:', data.error);
                }
                saveOrderForReceipt(pickupNum);
                showScreen('confirmation');
            })
            .catch(function (err) {
                console.error('Order API fetch failed:', err);
                var pickupNum = generateOrderNumber();
                if (numEl) numEl.textContent = pickupNum;
                saveOrderForReceipt(pickupNum);
                showScreen('confirmation');
            });
    }

    /* ═══════════════════════════════════════════════════════════════════════════
       EVENT HANDLERS
       ═══════════════════════════════════════════════════════════════════════════ */

    // Taalkeuze (welkomstscherm + bestelscherm sidebar)
    document.querySelectorAll('.lang-btn, .sidebar-lang-btn').forEach(function (btn) {
        btn.addEventListener('click', function (e) {
            e.stopPropagation();
            setLanguage(btn.dataset.lang);
        });
    });

    // Welkom -> Dine keuze
    function goToDineScreen() {
        showScreen('dine');
    }

    function goToOrderScreen() {
        showScreen('order');
        filterCategory(1);
        renderProductActions();
    }

    document.getElementById('welcome-start-btn').addEventListener('click', function (e) {
        e.stopPropagation();
        goToDineScreen();
    });

    document.getElementById('welcome-screen').addEventListener('click', function (e) {
        if (e.target.closest('.language-selector')) return;
        goToDineScreen();
    });

    // Dine keuze -> Bestelscherm
    document.getElementById('dine-here-btn').addEventListener('click', function () {
        orderType = 'dine-in';
        goToOrderScreen();
    });

    document.getElementById('takeaway-btn').addEventListener('click', function () {
        orderType = 'takeaway';
        goToOrderScreen();
    });

    document.getElementById('dine-back-btn').addEventListener('click', function () {
        showScreen('welcome');
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
        resetToWelcome();
    });

    /* ═══════════════════════════════════════════════════════════════════════════
       FULLSCREEN
       ═══════════════════════════════════════════════════════════════════════════ */
    function enterFullscreen() {
        var el = document.documentElement;
        if (el.requestFullscreen) el.requestFullscreen();
        else if (el.webkitRequestFullscreen) el.webkitRequestFullscreen();
        else if (el.mozRequestFullScreen) el.mozRequestFullScreen();
        else if (el.msRequestFullscreen) el.msRequestFullscreen();
    }

    function exitFullscreen() {
        if (document.exitFullscreen) document.exitFullscreen();
        else if (document.webkitExitFullscreen) document.webkitExitFullscreen();
        else if (document.mozCancelFullScreen) document.mozCancelFullScreen();
        else if (document.msExitFullscreen) document.msExitFullscreen();
    }

    // Automatisch fullscreen bij laden
    document.addEventListener('click', function onFirstClick() {
        enterFullscreen();
        document.removeEventListener('click', onFirstClick);
    }, { once: true });

    // Probeer ook direct fullscreen (werkt als browser het toestaat zonder interactie)
    try { enterFullscreen(); } catch (e) {}

    // 4-vinger tik = fullscreen uitzetten
    document.addEventListener('touchstart', function (e) {
        if (e.touches.length === 4) {
            exitFullscreen();
        }
    });

    /* ═══════════════════════════════════════════════════════════════════════════
       USB QR-SCANNER LISTENER
       ═══════════════════════════════════════════════════════════════════════════ */
    (function () {
        var scanBuffer = '';
        var scanTimer = null;
        var SCAN_TIMEOUT_MS = 80; // USB-scanners typen sneller dan mensen

        function activateDiscount() {
            discountPercent = 10;
            try { sessionStorage.setItem('qrDiscount', 'KIOSK10'); } catch (e) {}
            updateCartUI();
            var btn = document.getElementById('test-discount-btn');
            if (btn) {
                btn.classList.add('discount-active');
                btn.title = 'Korting actief – klik om te verwijderen';
            }
            // Toon kort een bevestigingsmelding
            showScanFeedback();
        }

        function showScanFeedback() {
            var existing = document.getElementById('scan-feedback-toast');
            if (existing) existing.remove();

            var toast = document.createElement('div');
            toast.id = 'scan-feedback-toast';
            toast.textContent = '✅ 10% QR-korting actief!';
            toast.style.cssText = [
                'position:fixed', 'bottom:40px', 'left:50%',
                'transform:translateX(-50%)',
                'background:#2d7a3a', 'color:#fff',
                'font-size:20px', 'font-weight:700',
                'padding:16px 32px', 'border-radius:16px',
                'box-shadow:0 8px 24px rgba(0,0,0,0.25)',
                'z-index:99999', 'pointer-events:none',
                'animation:badgePop 0.3s ease both'
            ].join(';');
            document.body.appendChild(toast);
            setTimeout(function () { toast.remove(); }, 3000);
        }

        document.addEventListener('keydown', function (e) {
            // Negeer toetsen die geen tekst produceren
            if (e.key.length > 1 && e.key !== 'Enter') return;

            if (e.key === 'Enter') {
                var code = scanBuffer.trim().toUpperCase();
                scanBuffer = '';
                clearTimeout(scanTimer);
                if (code === 'KIOSK10') {
                    activateDiscount();
                }
                return;
            }

            scanBuffer += e.key;
            clearTimeout(scanTimer);
            // Als er > 80ms geen nieuw karakter komt, reset de buffer (mensentypen)
            scanTimer = setTimeout(function () { scanBuffer = ''; }, SCAN_TIMEOUT_MS);
        });
    })();

    /* ═══════════════════════════════════════════════════════════════════════════
       INITIALISATIE
       ═══════════════════════════════════════════════════════════════════════════ */
    filterCategory(1);
    renderProductActions();
    updateCartUI();
    setLanguage('nl');

})();
