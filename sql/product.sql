-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: mysql:3306
-- Gegenereerd op: 14 sep 2026 om 18:55
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
-- Tabelstructuur voor tabel `product`
--

CREATE TABLE `product` (
  `id` int NOT NULL,
  `gewicht` decimal(5,2) NOT NULL,
  `kleur` varchar(50) NOT NULL,
  `dikte` decimal(5,2) NOT NULL,
  `soort` varchar(50) NOT NULL,
  `gelooid` varchar(64) NOT NULL,
  `prijs` decimal(10,2) NOT NULL,
  `voorraad` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Gegevens worden geëxporteerd voor tabel `product`
--

INSERT INTO `product` (`id`, `gewicht`, `kleur`, `dikte`, `soort`, `gelooid`, `prijs`, `voorraad`) VALUES
(1, 12.50, 'Zwart', 1.20, 'Rundleer', 'natuurlijk', 24.95, 35),
(2, 8.75, 'Bruin', 1.50, 'Rundleer', 'natuurlijk', 19.50, 42),
(3, 15.20, 'Donkerbruin', 2.00, 'Volnerfleer', 'natuurlijk', 39.95, 18),
(4, 6.40, 'Cognac', 1.10, 'Nubuck', 'natuurlijk', 18.75, 27),
(5, 10.00, 'Beige', 1.30, 'Suède', 'natuurlijk', 22.50, 31),
(6, 18.60, 'Zwart', 2.50, 'Rundleer', 'natuurlijk', 45.00, 12),
(7, 7.25, 'Rood', 1.00, 'Lamsleer', 'natuurlijk', 16.95, 25),
(8, 9.80, 'Blauw', 1.40, 'Geitenleer', 'natuurlijk', 21.25, 39),
(9, 13.45, 'Groen', 1.80, 'Rundleer', 'chemisch', 28.50, 16),
(10, 5.90, 'Wit', 0.90, 'Lamsleer', 'natuurlijk', 14.95, 48),
(11, 11.30, 'Zwart', 1.60, 'Volnerfleer', 'natuurlijk', 32.50, 22),
(12, 14.75, 'Bruin', 2.20, 'Rundleer', 'natuurlijk', 42.95, 14),
(13, 8.20, 'Cognac', 1.20, 'Nubuck', 'natuurlijk', 20.00, 36),
(14, 16.50, 'Donkerblauw', 2.00, 'Rundleer', 'natuurlijk', 37.50, 19),
(15, 7.80, 'Grijs', 1.10, 'Suède', 'natuurlijk', 19.95, 44),
(16, 19.25, 'Zwart', 2.80, 'Volnerfleer', 'natuurlijk', 52.50, 9),
(17, 6.75, 'Roze', 0.80, 'Lamsleer', 'natuurlijk', 15.50, 33),
(18, 10.40, 'Groen', 1.50, 'Geitenleer', 'chemisch', 23.75, 21),
(19, 12.90, 'Bruin', 1.90, 'Rundleer', 'natuurlijk', 31.95, 28),
(20, 9.15, 'Beige', 1.30, 'Suède', 'natuurlijk', 21.50, 37),
(21, 17.40, 'Zwart', 2.40, 'Rundleer', 'natuurlijk', 44.95, 11),
(22, 5.50, 'Geel', 0.90, 'Lamsleer', 'natuurlijk', 13.95, 52),
(23, 13.80, 'Cognac', 1.70, 'Volnerfleer', 'natuurlijk', 35.00, 17),
(24, 8.95, 'Blauw', 1.20, 'Nubuck', 'natuurlijk', 20.95, 29),
(25, 15.60, 'Groen', 2.10, 'Rundleer', 'chemisch', 34.50, 13),
(26, 7.35, 'Wit', 1.00, 'Geitenleer', 'natuurlijk', 17.25, 41),
(27, 11.75, 'Rood', 1.50, 'Suède', 'natuurlijk', 25.00, 24),
(28, 18.20, 'Donkerbruin', 2.60, 'Volnerfleer', 'natuurlijk', 49.95, 8),
(29, 6.25, 'Grijs', 0.80, 'Lamsleer', 'natuurlijk', 14.50, 46),
(30, 14.10, 'Zwart', 1.90, 'Rundleer', 'natuurlijk', 33.75, 20),
(31, 9.60, 'Bruin', 1.40, 'Nubuck', 'natuurlijk', 22.95, 34),
(32, 16.80, 'Cognac', 2.30, 'Rundleer', 'natuurlijk', 41.50, 15),
(33, 7.90, 'Groen', 1.10, 'Suède', 'natuurlijk', 18.95, 38),
(34, 12.35, 'Blauw', 1.60, 'Geitenleer', 'chemisch', 24.50, 26),
(35, 19.50, 'Zwart', 2.90, 'Volnerfleer', 'natuurlijk', 55.00, 7),
(36, 5.75, 'Roze', 0.70, 'Lamsleer', 'natuurlijk', 13.50, 55),
(37, 10.85, 'Beige', 1.30, 'Rundleer', 'natuurlijk', 21.95, 32),
(38, 13.25, 'Donkerbruin', 1.80, 'Nubuck', 'natuurlijk', 30.50, 23),
(39, 8.50, 'Wit', 1.00, 'Geitenleer', 'natuurlijk', 16.75, 43),
(40, 15.95, 'Rood', 2.20, 'Rundleer', 'chemisch', 36.95, 10),
(41, 11.10, 'Zwart', 1.50, 'Suède', 'natuurlijk', 23.50, 30),
(42, 6.90, 'Bruin', 1.10, 'Lamsleer', 'natuurlijk', 16.25, 47),
(43, 17.75, 'Cognac', 2.50, 'Volnerfleer', 'natuurlijk', 47.50, 12),
(44, 9.40, 'Groen', 1.30, 'Nubuck', 'natuurlijk', 21.75, 35),
(45, 14.60, 'Blauw', 1.90, 'Rundleer', 'natuurlijk', 32.95, 18),
(46, 7.15, 'Geel', 0.90, 'Suède', 'natuurlijk', 15.95, 49),
(47, 18.90, 'Donkerbruin', 2.70, 'Rundleer', 'natuurlijk', 51.25, 6),
(48, 10.25, 'Grijs', 1.20, 'Geitenleer', 'chemisch', 19.50, 28),
(49, 12.70, 'Zwart', 1.70, 'Volnerfleer', 'natuurlijk', 29.95, 25),
(50, 5.85, 'Wit', 0.80, 'Lamsleer', 'natuurlijk', 13.75, 57),
(51, 16.30, 'Bruin', 2.10, 'Rundleer', 'natuurlijk', 38.50, 16),
(52, 8.65, 'Cognac', 1.40, 'Nubuck', 'natuurlijk', 22.25, 39),
(53, 13.90, 'Groen', 1.80, 'Suède', 'natuurlijk', 28.95, 22),
(54, 7.45, 'Rood', 1.00, 'Lamsleer', 'natuurlijk', 16.50, 45),
(55, 19.80, 'Zwart', 3.00, 'Volnerfleer', 'natuurlijk', 57.50, 5),
(56, 10.70, 'Blauw', 1.50, 'Geitenleer', 'chemisch', 22.75, 31),
(57, 15.25, 'Donkerbruin', 2.30, 'Rundleer', 'natuurlijk', 43.50, 14),
(58, 6.35, 'Beige', 0.90, 'Suède', 'natuurlijk', 14.95, 51),
(59, 11.90, 'Grijs', 1.60, 'Nubuck', 'natuurlijk', 24.95, 33),
(60, 14.45, 'Zwart', 2.00, 'Rundleer', 'natuurlijk', 35.50, 19),
(61, 9.25, 'Bruin', 1.20, 'Geitenleer', 'natuurlijk', 18.75, 40),
(62, 17.10, 'Cognac', 2.40, 'Volnerfleer', 'natuurlijk', 45.95, 11),
(63, 7.70, 'Groen', 1.00, 'Lamsleer', 'natuurlijk', 15.25, 36),
(64, 12.15, 'Rood', 1.70, 'Suède', 'chemisch', 25.50, 23),
(65, 18.45, 'Zwart', 2.80, 'Rundleer', 'natuurlijk', 50.95, 8),
(66, 8.30, 'Blauw', 1.30, 'Nubuck', 'natuurlijk', 20.50, 42),
(67, 13.65, 'Beige', 1.90, 'Rundleer', 'natuurlijk', 30.95, 17),
(68, 5.95, 'Wit', 0.80, 'Lamsleer', 'natuurlijk', 13.25, 53),
(69, 16.75, 'Donkerbruin', 2.20, 'Volnerfleer', 'natuurlijk', 40.50, 13),
(70, 10.50, 'Grijs', 1.40, 'Geitenleer', 'chemisch', 19.95, 29),
(71, 14.90, 'Zwart', 1.80, 'Rundleer', 'natuurlijk', 31.50, 21),
(72, 7.60, 'Bruin', 1.10, 'Suède', 'natuurlijk', 18.25, 34),
(73, 11.45, 'Cognac', 1.50, 'Nubuck', 'natuurlijk', 23.95, 27),
(74, 19.10, 'Groen', 2.60, 'Volnerfleer', 'natuurlijk', 48.50, 7),
(75, 6.80, 'Rood', 0.90, 'Lamsleer', 'natuurlijk', 14.75, 48),
(76, 13.20, 'Blauw', 1.70, 'Rundleer', 'chemisch', 27.50, 20),
(77, 9.75, 'Beige', 1.20, 'Geitenleer', 'natuurlijk', 18.95, 37),
(78, 17.55, 'Donkerbruin', 2.50, 'Rundleer', 'natuurlijk', 46.75, 10),
(79, 8.10, 'Wit', 1.00, 'Suède', 'natuurlijk', 16.95, 44),
(80, 15.40, 'Zwart', 2.10, 'Volnerfleer', 'natuurlijk', 37.95, 15),
(81, 10.15, 'Bruin', 1.30, 'Nubuck', 'natuurlijk', 21.50, 32),
(82, 18.70, 'Cognac', 2.70, 'Rundleer', 'natuurlijk', 52.95, 6),
(83, 6.55, 'Groen', 0.90, 'Lamsleer', 'natuurlijk', 14.25, 50),
(84, 12.80, 'Rood', 1.60, 'Suède', 'chemisch', 24.75, 26),
(85, 16.20, 'Blauw', 2.00, 'Volnerfleer', 'natuurlijk', 35.95, 18),
(86, 9.35, 'Grijs', 1.20, 'Geitenleer', 'natuurlijk', 19.25, 41),
(87, 14.55, 'Beige', 1.80, 'Rundleer', 'natuurlijk', 29.50, 24),
(88, 7.05, 'Wit', 0.80, 'Lamsleer', 'natuurlijk', 13.95, 56),
(89, 19.35, 'Zwart', 2.90, 'Volnerfleer', 'natuurlijk', 54.95, 4),
(90, 11.65, 'Donkerbruin', 1.50, 'Nubuck', 'natuurlijk', 25.50, 30),
(91, 13.50, 'Bruin', 1.90, 'Rundleer', 'natuurlijk', 32.50, 19),
(92, 8.85, 'Cognac', 1.10, 'Suède', 'natuurlijk', 19.75, 35),
(93, 17.90, 'Groen', 2.40, 'Volnerfleer', 'natuurlijk', 44.95, 9),
(94, 6.15, 'Rood', 0.90, 'Lamsleer', 'natuurlijk', 14.50, 47),
(95, 12.60, 'Blauw', 1.50, 'Geitenleer', 'chemisch', 22.95, 28),
(96, 15.85, 'Zwart', 2.20, 'Rundleer', 'natuurlijk', 39.50, 13),
(97, 9.05, 'Beige', 1.20, 'Nubuck', 'natuurlijk', 20.75, 39),
(98, 18.35, 'Donkerbruin', 2.80, 'Volnerfleer', 'natuurlijk', 51.50, 7),
(99, 7.50, 'Grijs', 1.00, 'Suède', 'natuurlijk', 17.50, 43),
(100, 14.25, 'Wit', 1.40, 'Rundleer', 'natuurlijk', 25.95, 25);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `product`
--
ALTER TABLE `product`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
