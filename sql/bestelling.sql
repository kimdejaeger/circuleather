-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: mysql:3306
-- Gegenereerd op: 11 sep 2026 om 15:12
-- Serverversie: 8.0.46
-- PHP-versie: 8.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `circuleather`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `bestelling`
--

CREATE TABLE `bestelling` (
  `id` int NOT NULL,
  `klant_id` int NOT NULL,
  `product_id` int NOT NULL,
  `hoeveelheid` int NOT NULL,
  `bestelnummer` varchar(8) NOT NULL,
  `status` varchar(128) NOT NULL,
  `besteldatum` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Gegevens worden geëxporteerd voor tabel `bestelling`
--

INSERT INTO `bestelling` (`id`, `klant_id`, `product_id`, `hoeveelheid`, `bestelnummer`, `status`, `besteldatum`) VALUES
(1, 1, 1, 5, '100001', 'In behandeling', '2026-08-01 09:15:00'),
(2, 1, 15, 10, '100001', 'In behandeling', '2026-08-01 09:15:00'),
(3, 2, 27, 4, '100002', 'Verzonden', '2026-08-02 11:30:00'),
(4, 2, 42, 8, '100002', 'Verzonden', '2026-08-02 11:30:00'),
(5, 3, 8, 6, '100003', 'Afgeleverd', '2026-08-03 14:20:00'),
(6, 3, 56, 3, '100003', 'Afgeleverd', '2026-08-03 14:20:00'),
(7, 3, 73, 12, '100003', 'Afgeleverd', '2026-08-03 14:20:00'),
(8, 4, 19, 7, '100004', 'In behandeling', '2026-08-04 10:45:00'),
(9, 4, 91, 15, '100004', 'In behandeling', '2026-08-04 10:45:00'),
(10, 5, 34, 5, '100005', 'Verzonden', '2026-08-05 13:10:00'),
(11, 5, 63, 8, '100005', 'Verzonden', '2026-08-05 13:10:00'),
(12, 6, 7, 3, '100006', 'Afgeleverd', '2026-08-06 15:35:00'),
(13, 6, 88, 6, '100006', 'Afgeleverd', '2026-08-06 15:35:00'),
(14, 7, 24, 10, '100007', 'In behandeling', '2026-08-07 08:50:00'),
(15, 7, 51, 4, '100007', 'In behandeling', '2026-08-07 08:50:00'),
(16, 7, 12, 9, '100007', 'In behandeling', '2026-08-07 08:50:00'),
(17, 8, 39, 5, '100008', 'Verzonden', '2026-08-08 12:25:00'),
(18, 8, 76, 11, '100008', 'Verzonden', '2026-08-08 12:25:00'),
(19, 9, 3, 7, '100009', 'Afgeleverd', '2026-08-09 16:40:00'),
(20, 9, 68, 14, '100009', 'Afgeleverd', '2026-08-09 16:40:00'),
(21, 10, 45, 6, '100010', 'In behandeling', '2026-08-10 09:55:00'),
(22, 10, 82, 4, '100010', 'In behandeling', '2026-08-10 09:55:00'),
(23, 1, 16, 8, '100011', 'Verzonden', '2026-08-11 10:20:00'),
(24, 1, 97, 3, '100011', 'Verzonden', '2026-08-11 10:20:00'),
(25, 2, 31, 12, '100012', 'Afgeleverd', '2026-08-12 13:50:00'),
(26, 2, 59, 5, '100012', 'Afgeleverd', '2026-08-12 13:50:00'),
(27, 3, 10, 7, '100013', 'In behandeling', '2026-08-13 15:15:00'),
(28, 3, 70, 9, '100013', 'In behandeling', '2026-08-13 15:15:00'),
(29, 4, 22, 6, '100014', 'Verzonden', '2026-08-14 08:30:00'),
(30, 4, 94, 4, '100014', 'Verzonden', '2026-08-14 08:30:00'),
(31, 4, 36, 10, '100014', 'Verzonden', '2026-08-14 08:30:00'),
(32, 5, 61, 5, '100015', 'Afgeleverd', '2026-08-15 11:45:00'),
(33, 5, 5, 8, '100015', 'Afgeleverd', '2026-08-15 11:45:00'),
(34, 6, 78, 6, '100016', 'In behandeling', '2026-08-16 14:15:00'),
(35, 6, 28, 3, '100016', 'In behandeling', '2026-08-16 14:15:00'),
(36, 7, 85, 15, '100017', 'Verzonden', '2026-08-17 16:30:00'),
(37, 7, 14, 4, '100017', 'Verzonden', '2026-08-17 16:30:00'),
(38, 8, 49, 7, '100018', 'Afgeleverd', '2026-08-18 09:20:00'),
(39, 8, 66, 9, '100018', 'Afgeleverd', '2026-08-18 09:20:00'),
(40, 9, 100, 5, '100019', 'In behandeling', '2026-08-19 12:40:00'),
(41, 9, 20, 6, '100019', 'In behandeling', '2026-08-19 12:40:00'),
(42, 9, 53, 11, '100019', 'In behandeling', '2026-08-19 12:40:00'),
(43, 10, 74, 5, '100020', 'Verzonden', '2026-08-20 15:10:00'),
(44, 10, 9, 8, '100020', 'Verzonden', '2026-08-20 15:10:00'),
(45, 1, 41, 4, '100021', 'Afgeleverd', '2026-08-21 10:05:00'),
(46, 1, 87, 10, '100021', 'Afgeleverd', '2026-08-21 10:05:00'),
(47, 2, 32, 6, '100022', 'In behandeling', '2026-08-22 13:25:00'),
(48, 2, 58, 3, '100022', 'In behandeling', '2026-08-22 13:25:00'),
(49, 3, 96, 12, '100023', 'Verzonden', '2026-08-23 09:40:00'),
(50, 3, 17, 7, '100023', 'Verzonden', '2026-08-23 09:40:00');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `bestelling`
--
ALTER TABLE `bestelling`
  ADD PRIMARY KEY (`id`),
  ADD KEY `klant_id` (`klant_id`),
  ADD KEY `product_id` (`product_id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `bestelling`
--
ALTER TABLE `bestelling`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `bestelling`
--
ALTER TABLE `bestelling`
  ADD CONSTRAINT `bestelling_ibfk_1` FOREIGN KEY (`klant_id`) REFERENCES `klant` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `bestelling_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
