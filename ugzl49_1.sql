-- phpMyAdmin SQL Dump
-- version 4.6.6deb4+deb9u2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Erstellungszeit: 11. Jul 2023 um 19:00
-- Server-Version: 5.6.29-1~dotdeb+7.1
-- PHP-Version: 7.0.33-0+deb9u12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `ugzl49_`
--
CREATE DATABASE IF NOT EXISTS `ugzl49_` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `ugzl49_`;
--
-- Datenbank: `ugzl49_1`
--
CREATE DATABASE IF NOT EXISTS `ugzl49_1` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `ugzl49_1`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `accounts`
--

CREATE TABLE `accounts` (
  `accounts_id` bigint(20) NOT NULL,
  `account_number` int(11) NOT NULL,
  `balance` decimal(65,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `accounts`
--

INSERT INTO `accounts` (`accounts_id`, `account_number`, `balance`) VALUES
(12, 383243933, '2400.00'),
(14, 259000669, '350.00'),
(20, 391991870, '0.00');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `statements`
--

CREATE TABLE `statements` (
  `account_number` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `transaction_type` varchar(20) NOT NULL,
  `amount` decimal(65,2) NOT NULL,
  `transaction_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `statement_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `statements`
--

INSERT INTO `statements` (`account_number`, `receiver_id`, `transaction_type`, `amount`, `transaction_date`, `statement_id`) VALUES
(383243933, 383243933, 'Einzahlung', '5000.00', '2023-06-23 09:59:15', 63),
(0, 383243933, 'Auszahlung', '1000.00', '2023-06-23 09:59:24', 64),
(383243933, 813900735, 'Happy bday', '500.00', '2023-06-23 09:59:41', 65),
(383243933, 259000669, 'Lohn', '220.00', '2023-06-24 02:57:12', 66),
(970792590, 970792590, 'Einzahlung', '2000.00', '2023-06-24 03:59:19', 67),
(970792590, 259000669, 'Rechnung', '130.00', '2023-06-24 03:59:41', 68),
(545342087, 545342087, 'Einzahlung', '1000000.00', '2023-06-24 11:42:30', 69),
(0, 545342087, 'Auszahlung', '500.00', '2023-06-24 11:43:44', 70),
(545342087, 813900735, 'Test', '100.00', '2023-06-24 11:44:01', 71),
(545342087, 813900735, 'Rechnung', '330.00', '2023-06-25 10:04:03', 72),
(0, 545342087, 'Auszahlung', '1500.00', '2023-06-25 10:04:21', 73),
(383243933, 383243933, 'Einzahlung', '20.00', '2023-06-25 19:09:20', 74),
(0, 383243933, 'Auszahlung', '500.00', '2023-06-25 19:09:52', 75),
(0, 383243933, 'Auszahlung', '500.00', '2023-06-25 19:10:20', 76),
(383243933, 383243933, 'Einzahlung', '100.00', '2023-06-25 19:12:32', 77),
(383243933, 383243933, 'Einzahlung', '100.00', '2023-06-25 19:13:13', 78),
(383243933, 383243933, 'Einzahlung', '100.00', '2023-06-25 19:13:26', 79),
(383243933, 970792590, 'Happy Bday', '200.00', '2023-06-25 19:14:43', 80);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `first_name` text NOT NULL,
  `last_name` text NOT NULL,
  `street_name` varchar(100) NOT NULL,
  `street_number` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `postal_code` int(5) NOT NULL,
  `role` enum('admin','sachbearbeiter','nutzer') NOT NULL DEFAULT 'nutzer',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('activated','deactivated') NOT NULL DEFAULT 'deactivated'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`id`, `user_name`, `password`, `first_name`, `last_name`, `street_name`, `street_number`, `city`, `postal_code`, `role`, `date`, `status`) VALUES
(12, 'Max', '1234', 'Max', 'fdsgfdgfd', 'Max-Muster-StraÃŸe', '22', 'Musterhausen', 13153, 'admin', '2023-06-23 09:58:06', 'activated'),
(14, 'Moe', '1234', 'Moe', 'Mah', 'Beispiel-Straße', '99', 'Moehausen', 34353, 'sachbearbeiter', '2023-06-23 10:32:17', 'activated'),
(20, 'wert', '1234', 'wert', 'wert', 'wert', '10', 'ffm', 67877, 'nutzer', '2023-06-25 20:49:22', 'activated');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`accounts_id`);

--
-- Indizes für die Tabelle `statements`
--
ALTER TABLE `statements`
  ADD PRIMARY KEY (`statement_id`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `statements`
--
ALTER TABLE `statements`
  MODIFY `statement_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;
--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `accounts`
--
ALTER TABLE `accounts`
  ADD CONSTRAINT `accounts_ibfk_1` FOREIGN KEY (`accounts_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
--
-- Datenbank: `ugzl49_2`
--
CREATE DATABASE IF NOT EXISTS `ugzl49_2` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `ugzl49_2`;
--
-- Datenbank: `ugzl49_3`
--
CREATE DATABASE IF NOT EXISTS `ugzl49_3` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `ugzl49_3`;
--
-- Datenbank: `ugzl49_mybank`
--
CREATE DATABASE IF NOT EXISTS `ugzl49_mybank` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `ugzl49_mybank`;
--
-- Datenbank: `ugzl49_mybank1`
--
CREATE DATABASE IF NOT EXISTS `ugzl49_mybank1` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `ugzl49_mybank1`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `accounts`
--

CREATE TABLE `accounts` (
  `accounts_id` bigint(20) NOT NULL,
  `account_number` int(11) NOT NULL,
  `balance` decimal(65,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `accounts`
--

INSERT INTO `accounts` (`accounts_id`, `account_number`, `balance`) VALUES
(12, 383243933, '2400.00'),
(14, 259000669, '350.00'),
(15, 970792590, '2070.00'),
(16, 545342087, '997570.00'),
(17, 772278932, '0.00'),
(18, 534911020, '0.00'),
(19, 33913630, '0.00'),
(20, 800177927, '0.00');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `statements`
--

CREATE TABLE `statements` (
  `account_number` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `transaction_type` varchar(20) NOT NULL,
  `amount` decimal(65,2) NOT NULL,
  `transaction_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `statement_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `statements`
--

INSERT INTO `statements` (`account_number`, `receiver_id`, `transaction_type`, `amount`, `transaction_date`, `statement_id`) VALUES
(383243933, 383243933, 'Einzahlung', '5000.00', '2023-06-23 09:59:15', 63),
(0, 383243933, 'Auszahlung', '1000.00', '2023-06-23 09:59:24', 64),
(383243933, 813900735, 'Happy bday', '500.00', '2023-06-23 09:59:41', 65),
(383243933, 259000669, 'Lohn', '220.00', '2023-06-24 02:57:12', 66),
(970792590, 970792590, 'Einzahlung', '2000.00', '2023-06-24 03:59:19', 67),
(970792590, 259000669, 'Rechnung', '130.00', '2023-06-24 03:59:41', 68),
(545342087, 545342087, 'Einzahlung', '1000000.00', '2023-06-24 11:42:30', 69),
(0, 545342087, 'Auszahlung', '500.00', '2023-06-24 11:43:44', 70),
(545342087, 813900735, 'Test', '100.00', '2023-06-24 11:44:01', 71),
(545342087, 813900735, 'Rechnung', '330.00', '2023-06-25 10:04:03', 72),
(0, 545342087, 'Auszahlung', '1500.00', '2023-06-25 10:04:21', 73),
(383243933, 383243933, 'Einzahlung', '20.00', '2023-06-25 19:09:20', 74),
(0, 383243933, 'Auszahlung', '500.00', '2023-06-25 19:09:52', 75),
(0, 383243933, 'Auszahlung', '500.00', '2023-06-25 19:10:20', 76),
(383243933, 383243933, 'Einzahlung', '100.00', '2023-06-25 19:12:32', 77),
(383243933, 383243933, 'Einzahlung', '100.00', '2023-06-25 19:13:13', 78),
(383243933, 383243933, 'Einzahlung', '100.00', '2023-06-25 19:13:26', 79),
(383243933, 970792590, 'Happy Bday', '200.00', '2023-06-25 19:14:43', 80);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `first_name` text NOT NULL,
  `last_name` text NOT NULL,
  `street_name` varchar(100) NOT NULL,
  `street_number` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `postal_code` int(5) NOT NULL,
  `role` enum('admin','sachbearbeiter','nutzer') NOT NULL DEFAULT 'nutzer',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('activated','deactivated') NOT NULL DEFAULT 'deactivated'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`id`, `user_name`, `password`, `first_name`, `last_name`, `street_name`, `street_number`, `city`, `postal_code`, `role`, `date`, `status`) VALUES
(12, 'Max', '1234', 'Max', 'fdsgfdgfd', 'Max-Muster-Straße', '22', 'Musterhausen', 13153, 'admin', '2023-06-23 09:58:06', 'activated'),
(14, 'Moe', '1234', 'Moe', 'Mah', 'Beispiel-Straße', '99', 'Moehausen', 34353, 'sachbearbeiter', '2023-06-23 10:32:17', 'activated'),
(15, 'Heiko', '1234', 'Heiko', 'Hell', 'Test Straße', '77', 'Beispielhausen', 23423, 'nutzer', '2023-06-24 03:55:34', 'activated'),
(16, 'Nico', '1234', 'Nico', 'Bau', 'blabla', '123', 'Ofenau', 32423, 'nutzer', '2023-06-24 11:41:03', 'activated'),
(17, 'Carsten', '1234', 'Carsten', 'Hammer', 'Hammerstraße', '18', 'Hamm', 93432, 'nutzer', '2023-06-25 10:05:55', 'activated'),
(18, 'Lux', '1234', 'Lux', 'Lachs', 'Luxstraße', '99', 'Lachsbach', 12412, 'nutzer', '2023-06-25 10:30:28', 'activated'),
(19, 'Jakob', '1234', 'Jakob', 'Test', 'Beispiel-Straße', '89', 'Köln', 23423, 'nutzer', '2023-06-25 19:17:23', 'activated'),
(20, 'wert', '1234', 'wert', 'wert', 'wert', '10', 'ffm', 603344, 'nutzer', '2023-06-25 20:31:31', 'activated');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`accounts_id`);

--
-- Indizes für die Tabelle `statements`
--
ALTER TABLE `statements`
  ADD PRIMARY KEY (`statement_id`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `statements`
--
ALTER TABLE `statements`
  MODIFY `statement_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;
--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `accounts`
--
ALTER TABLE `accounts`
  ADD CONSTRAINT `accounts_ibfk_1` FOREIGN KEY (`accounts_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

