-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 11 feb 2026 om 13:27
-- Serverversie: 10.4.32-MariaDB
-- PHP-versie: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `products`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `categories`
--

CREATE TABLE `categories` (
  `category_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `orders`
--

CREATE TABLE `orders` (
  `order_id` int(10) UNSIGNED NOT NULL,
  `order_status_id` int(10) UNSIGNED NOT NULL,
  `pickup_number` int(10) UNSIGNED NOT NULL,
  `price_total` decimal(8,2) NOT NULL,
  `datetime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `products`
--

CREATE TABLE `products` (
  `product_id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `image_id` text NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(6,2) NOT NULL,
  `kcal` int(10) UNSIGNED NOT NULL,
  `available` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `products`
--

INSERT INTO `products` (`product_id`, `category_id`, `image_id`, `name`, `description`, `price`, `kcal`, `available`) VALUES
(1, 1, 'morningboostacaibwol.png', 'Morning Boost Açaí Bowl (VG)', 'Chilled blend of açaí and banana topped with granola, chia seeds, and coconut.', 7.50, 320, 1),
(2, 1, '0', 'The Garden Breakfast Wrap (V)', 'Whole-grain wrap with scrambled eggs, spinach, and yogurt-herb sauce.', 6.50, 280, 1),
(3, 1, '0', 'Peanut Butter & Cacao Toast (VG)', 'Sourdough toast with peanut butter, banana, and cacao nibs.', 5.00, 240, 1),
(4, 1, '0', 'Overnight Oats: Apple Pie Style (VG)', 'Oats with almond milk, apple, cinnamon, and walnuts.', 5.50, 290, 1),
(5, 2, '0', 'Tofu Power Tahini Bowl (VG)', 'Quinoa, maple-glazed tofu, sweet potato, kale, and tahini dressing.', 10.50, 480, 1),
(6, 2, '0', 'Mediterranean Falafel Bowl (VG)', 'Baked falafel, hummus, pickled onions, tomatoes, and cucumber.', 10.00, 440, 1),
(7, 2, '0', 'Warm Teriyaki Tempeh Bowl (VG)', 'Brown rice, tempeh, broccoli, carrots, and ginger-soy glaze.', 11.00, 500, 1),
(8, 3, '0', 'Zesty Chickpea Hummus Wrap (VG)', 'Spiced chickpeas, carrots, lettuce, and hummus in whole-wheat wrap.', 8.50, 410, 1),
(9, 3, '0', 'Avocado & Halloumi Toastie (V)', 'Grilled halloumi, avocado, and chili flakes on multigrain bread.', 9.00, 460, 1),
(10, 4, '0', 'Smoky BBQ Jackfruit Slider (VG)', 'Pulled jackfruit in BBQ sauce with crunchy slaw.', 7.50, 350, 1),
(11, 4, '0', 'Oven-Baked Sweet Potato Wedges (VG)', 'Seasoned with smoked paprika.', 4.50, 260, 1),
(12, 4, '0', 'Zucchini Fries (V)', 'Crispy breaded zucchini sticks.', 4.50, 190, 1),
(13, 4, '0', 'Baked Falafel Bites - 5pcs (VG)', 'Five baked falafel bites.', 5.00, 230, 1),
(14, 4, '0', 'Mini Veggie Platter & Hummus (VG)', 'Celery, carrots, cucumber with hummus.', 4.00, 160, 1),
(15, 5, '0', 'Classic Hummus (VG)', NULL, 1.00, 120, 1),
(16, 5, '0', 'Avocado Lime Crema (VG)', NULL, 1.00, 110, 1),
(17, 5, '0', 'Greek Yogurt Ranch (V)', NULL, 1.00, 90, 1),
(18, 5, '0', 'Spicy Sriracha Mayo (VG)', NULL, 1.00, 180, 1),
(19, 5, '0', 'Peanut Satay Sauce (VG)', NULL, 1.00, 200, 1),
(20, 6, '0', 'Green Glow Smoothie', 'Spinach, pineapple, cucumber, coconut water.', 3.50, 120, 1),
(21, 6, '0', 'Iced Matcha Latte', 'Lightly sweetened matcha with almond milk.', 3.00, 90, 1),
(22, 6, '0', 'Fruit-Infused Water', 'Lemon-mint, strawberry-basil, or cucumber-lime.', 1.50, 0, 1),
(23, 6, '0', 'Berry Blast Smoothie', 'Strawberries, blueberries, raspberries with almond milk.', 3.80, 140, 1),
(24, 6, '0', 'Citrus Cooler', 'Orange juice, sparkling water, hint of lime.', 3.00, 90, 1),
(25, 2, '0', 'The Supergreen Harvest (VG)', 'Massaged kale, edamame, avocado, cucumber, and toasted pumpkin seeds with lemon-olive oil.', 9.50, 310, 1);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexen voor tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD UNIQUE KEY `pickup_number` (`pickup_number`);

--
-- Indexen voor tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
