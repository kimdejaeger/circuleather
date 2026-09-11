-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: mysql:3306
-- Gegenereerd op: 11 sep 2026 om 15:13
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
-- Tabelstructuur voor tabel `klant`
--

CREATE TABLE `klant` (
  `id` int NOT NULL,
  `email` varchar(128) NOT NULL,
  `telefoonnummer` varchar(32) NOT NULL,
  `bedrijfsnaam` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Gegevens worden geëxporteerd voor tabel `klant`
--

INSERT INTO `klant` (`id`, `email`, `telefoonnummer`, `bedrijfsnaam`) VALUES
(1, 'info@leerhandel.nl', '020-1234567', 'Leerhandel Nederland'),
(2, 'contact@lederwaren.nl', '010-2345678', 'Lederwaren Rotterdam'),
(3, 'info@ambachtleer.nl', '030-3456789', 'Ambachtelijk Leer'),
(4, 'sales@leerdesign.nl', '070-4567890', 'LeerDesign Den Haag'),
(5, 'info@lederstudio.nl', '040-5678901', 'Lederstudio Eindhoven'),
(6, 'contact@leerfabriek.nl', '050-6789012', 'Leerfabriek Noord'),
(7, 'info@premiumleder.nl', '020-7890123', 'Premium Leder'),
(8, 'sales@leerspecialist.nl', '010-8901234', 'De Leerspecialist'),
(9, 'info@leerwereld.nl', '030-9012345', 'Leerwereld Utrecht'),
(10, 'contact@lederbedrijf.nl', '070-0123456', 'Nederlands Lederbedrijf');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `klant`
--
ALTER TABLE `klant`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `klant`
--
ALTER TABLE `klant`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
