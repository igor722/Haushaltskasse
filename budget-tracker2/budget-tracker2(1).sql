-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 25. Jan 2024 um 11:44
-- Server-Version: 10.4.28-MariaDB
-- PHP-Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `budget-tracker2`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(60) NOT NULL,
  `category_income` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `category_income`) VALUES
(1, 'Lebensmittel', 0),
(2, 'Miete', 0),
(3, 'Gehalt', 1),
(4, 'Transport', 0),
(6, 'Freizeit', 0),
(8, 'Strom', 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `inputs`
--

CREATE TABLE `inputs` (
  `input_id` int(11) NOT NULL,
  `input_name` varchar(60) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `input_amount` decimal(10,2) NOT NULL,
  `input_datum` date NOT NULL,
  `input_description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `inputs`
--

INSERT INTO `inputs` (`input_id`, `input_name`, `category_id`, `input_amount`, `input_datum`, `input_description`) VALUES
(22, 'Miete', 1, -1200.00, '2023-01-01', 'Monatliche Mietzahlung'),
(23, 'Lebensmittel', 2, -150.50, '2023-01-02', 'Einkauf im Supermarkt'),
(24, 'Stromrechnung', 1, -80.00, '2023-01-04', 'Monatliche Stromrechnung'),
(25, 'Restaurantbesuch', 4, -50.00, '2023-01-05', 'Abendessen im Restaurant'),
(26, 'Tanken', 2, -70.00, '2023-01-06', 'Auftanken des Autos'),
(27, 'Internetrechnung', 1, -60.00, '2023-01-07', 'Monatliche Internetrechnung'),
(28, 'Kino', 4, -25.00, '2023-01-08', 'Kinobesuch mit Freunden'),
(29, 'Versicherung', 3, -100.00, '2023-01-09', 'Monatliche Versicherungszahlung'),
(30, 'Fitnessstudio', 2, -30.00, '2023-01-11', 'Monatliche Fitnessstudio-Gebühr'),
(32, 'Geschenk', 4, -40.00, '2023-01-13', 'Geschenk für einen Freund'),
(34, 'Handyrechnung', 1, -35.00, '2023-01-15', 'Monatliche Handyrechnung'),
(35, 'Konzerttickets', 4, -60.00, '2023-01-16', 'Tickets für ein Konzert'),
(36, 'Arztkosten', 2, -90.00, '2023-01-17', 'Arztkosten für eine Untersuchung'),
(38, 'Kreditrückzahlung', 3, -300.00, '2023-01-19', 'Rückzahlung eines Kredits'),
(39, 'Gehalt', 6, 2500.00, '2023-01-01', 'Monatliches Gehalt'),
(40, 'Bonuszahlung', 6, 500.00, '2023-01-05', 'Jährliche Bonuszahlung'),
(42, 'Verkauf auf Flohmarkt', 8, 120.00, '2023-01-15', 'Einnahmen aus dem Verkauf alter Gegenstände'),
(45, 'Shopping', 6, -80.00, '2024-01-19', NULL),
(48, 'Miete', 2, -1300.00, '2024-01-24', NULL),
(52, 'Benzin', 4, -120.00, '2024-01-23', 'Für Auto'),
(53, 'Gehalt', 3, 2000.00, '2024-01-24', NULL),
(55, 'Rechnung', 8, -120.00, '2024-01-25', ''),
(56, 'Einkauf', 1, -100.00, '2024-01-25', ''),
(57, 'Einkauf2', 1, -200.00, '2024-01-25', ''),
(58, 'Essen', 1, -150.00, '2024-01-25', NULL),
(59, 'Gehalt', 3, 2000.00, '2024-01-25', NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `repeated_inputs`
--

CREATE TABLE `repeated_inputs` (
  `repeated_input_id` int(11) NOT NULL,
  `repeated_input_name` varchar(60) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `repeated_input_amount` decimal(10,2) NOT NULL,
  `repeated_input_description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `repeated_inputs`
--

INSERT INTO `repeated_inputs` (`repeated_input_id`, `repeated_input_name`, `category_id`, `repeated_input_amount`, `repeated_input_description`) VALUES
(1, 'Gehalt', 3, 2000.00, 'Monatliches Gehalt'),
(2, 'Miete', 2, -1200.00, 'Monatliche Mietzahlung'),
(5, 'Freelance-Job', 3, 500.00, 'Zusätzliche Einnahmen durch freiberufliche Arbeit'),
(6, 'Strom', 8, -50.00, 'Monatliche Stromrechnung'),
(7, 'Shopping', 6, -80.00, 'Monatliche Ausgaben für Freizeitaktivitäten'),
(8, 'Miete', 2, -1200.00, 'Monatliche Mietzahlung'),
(9, 'Gehalt', 3, 2000.00, 'Monatliches Gehalt'),
(10, 'Miete', 2, -1300.00, 'Monatliche Mietzahlung');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_email` varchar(75) NOT NULL,
  `user_password` varchar(100) DEFAULT NULL,
  `user_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`user_id`, `user_email`, `user_password`, `user_name`) VALUES
(1, 'test@test.de', '123456', 'TEST1');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indizes für die Tabelle `inputs`
--
ALTER TABLE `inputs`
  ADD PRIMARY KEY (`input_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indizes für die Tabelle `repeated_inputs`
--
ALTER TABLE `repeated_inputs`
  ADD PRIMARY KEY (`repeated_input_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT für Tabelle `inputs`
--
ALTER TABLE `inputs`
  MODIFY `input_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT für Tabelle `repeated_inputs`
--
ALTER TABLE `repeated_inputs`
  MODIFY `repeated_input_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `inputs`
--
ALTER TABLE `inputs`
  ADD CONSTRAINT `inputs_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`);

--
-- Constraints der Tabelle `repeated_inputs`
--
ALTER TABLE `repeated_inputs`
  ADD CONSTRAINT `repeated_inputs_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
