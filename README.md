# Happy Herbivore – Kiosk Systeem

Zelfbedieningskiosk voor **Happy Herbivore**, een plantaardig restaurantconcept.
Gebouwd met PHP, MySQL en vanilla JavaScript. Geen frameworks.

---

## Wat is er gemaakt

### Kiosk (`index.php`)
De klant-facing bestelinterface op het scherm in het restaurant.

- [x] Welkomstscherm met automatische beeldcarrousel (wisselende productfoto's)
- [x] Taalkeuze: Nederlands, Engels, Frans en Duits
- [x] Keuze tussen "Hier eten" en "Meenemen"
- [x] Productmenu opgedeeld in 6 categorieën (Ontbijt, Lunch/Diner, Wraps, Bijgerechten, Sauzen, Dranken)
- [x] Winkelwagen met aantal-knoppen per product
- [x] Reviewscherm met overzicht, aanpassen en verwijderen van items
- [x] Upsell-scherm (15 seconden timer, automatisch doorgaan)
- [x] Saugsgestie popup bij toevoegen van bijgerechten (product pairing)
- [x] QR-kortingscode scannen via USB-scanner (10% korting)
- [x] Bevestigingsscherm met bestelnummer (automatisch terug na 5 seconden)
- [x] Fullscreen modus (automatisch + 4-vinger tik om te verlaten)
- [x] Dagelijkse reset van bestelnummers (1–99, cycling)
- [x] Alle productteksten vertaald per taal

---

### Bonprinter (`bonprinter.html`)
Aparte pagina voor de medewerker om bonnen te printen via USB-thermische printer.

- [x] Automatisch ophalen van laatste bestelling uit `localStorage`
- [x] Visuele bon-preview op het scherm
- [x] Printen via WebUSB (ESC/POS protocol) naar thermische printer
- [x] Automatische printerdetectie bij laden van de pagina
- [x] Handmatig printer selecteren via knop
- [x] Testbon afdrukken zonder echte bestelling
- [x] QR-code op de bon (link naar kortingspagina)
- [x] Debug console voor diagnosedoeleinden

---

### Admin paneel (`admin.php`)
Beveiligd beheerpaneel voor medewerkers (toegang via PIN-code: `1234`).

- [x] PIN-login met sessiebeheer
- [x] Live orderoverzicht met automatisch verversen
- [x] Orderstatus bijwerken: Wacht → Bezig → Klaar
- [x] Productbeheer: beschikbaarheid aan/uit zetten
- [x] Analyticsoverzicht: omzet, populaire producten, orderstatistieken

---

### API (`api/`)

| Bestand | Functie |
|---|---|
| `submit-order.php` | Bestelling opslaan in de database (POST) |
| `admin-orders.php` | Orders ophalen en status bijwerken (GET/PATCH) |
| `admin-products.php` | Producten ophalen en aanpassen (GET/PATCH) |
| `admin-analytics.php` | Statistieken ophalen (GET) |

---

### Database

Tabellen in MySQL:

| Tabel | Inhoud |
|---|---|
| `products` | 25 producten met prijs, kcal, categorie en afbeelding |
| `categories` | 6 categorieën |
| `orders` | Bestellingen met pickup-nummer, totaal en status |
| `order_items` | Regelitems per bestelling (product, aantal, prijs) |
| `order_statuses` | Statussen: Wacht (1), Bezig (2), Klaar (3) |

SQL-bestanden: `products (5).sql` en `db/order_items.sql`

---

### QR-korting (`qr.html`)
Landingspagina voor klanten die de QR-code op de bon scannen.
Activeert automatisch 10% korting (`?promo=KIOSK10`) bij de volgende bestelling.

---

## Live server

- **URL:** `https://u240903.gluwebsite.nl`
- **Database host:** `localhost`
- **Database naam:** `u240903_kiosk`
- **Database gebruiker:** `u240903_kiosk`
