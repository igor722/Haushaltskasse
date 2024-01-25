-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 18. Jan 2024 um 11:01
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
-- Datenbank: `haushaltskasse`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `eintraege`
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
-- Daten für Tabelle `eintraege`
--

INSERT INTO `inputs` (`input_id`, `input_name`, `category_id`, `input_amount`, `input_datum`, `input_description`) VALUES
('Miete', 1, -1200.00, '2023-01-01', 'Monatliche Mietzahlung'),
('Lebensmittel', 2, -150.50, '2023-01-02', 'Einkauf im Supermarkt'),
('Stromrechnung', 1, -80.00, '2023-01-04', 'Monatliche Stromrechnung'),
('Restaurantbesuch', 4, -50.00, '2023-01-05', 'Abendessen im Restaurant'),
('Tanken', 2, -70.00, '2023-01-06', 'Auftanken des Autos'),
('Internetrechnung', 1, -60.00, '2023-01-07', 'Monatliche Internetrechnung'),
('Kino', 4, -25.00, '2023-01-08', 'Kinobesuch mit Freunden'),
('Versicherung', 3, -100.00, '2023-01-09', 'Monatliche Versicherungszahlung'),
('Fitnessstudio', 2, -30.00, '2023-01-11', 'Monatliche Fitnessstudio-Gebühr'),
('Kleidung', 5, -75.00, '2023-01-12', 'Einkauf von neuen Kleidungsstücken'),
('Geschenk', 4, -40.00, '2023-01-13', 'Geschenk für einen Freund'),
('Wochenendausflug', 3, -200.00, '2023-01-14', 'Kurzer Wochenendausflug'),
('Handyrechnung', 1, -35.00, '2023-01-15', 'Monatliche Handyrechnung'),
('Konzerttickets', 4, -60.00, '2023-01-16', 'Tickets für ein Konzert'),
('Arztkosten', 2, -90.00, '2023-01-17', 'Arztkosten für eine Untersuchung'),
('Schulmaterial', 5, -15.00, '2023-01-18', 'Einkauf von Schulmaterial'),
('Kreditrückzahlung', 3, -300.00, '2023-01-19', 'Rückzahlung eines Kredits'),
('Gehalt', 6, 2500.00, '2023-01-01', 'Monatliches Gehalt'),
('Bonuszahlung', 6, 500.00, '2023-01-05', 'Jährliche Bonuszahlung'),
('Rückerstattung', 7, 75.00, '2023-01-10', 'Rückerstattung für defektes Produkt'),
('Verkauf auf Flohmarkt', 8, 120.00, '2023-01-15', 'Einnahmen aus dem Verkauf alter Gegenstände');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `feste_werte`
--

CREATE TABLE `repeated_inputs` (
  `repeated_input_id` int(11) NOT NULL,
  `repeated_input_name` varchar(60) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `repeated_input_amount` decimal(10,2) NOT NULL,
  `repeated_input_description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `feste_werte`
--

INSERT INTO `repeated_inputs` (`repeated_input_id`, `repeated_input_name`, `category_id`, `repeated_input_amount`, `repeated_input_description`) VALUES
('Gehalt', 3, 2000.00, 'Monatliches Gehalt'),
('Miete', 2, -1200.00, 'Monatliche Mietzahlung'),
('Einkauf', 1, -150.00, 'Wöchentlicher Lebensmitteleinkauf'),
('Versicherung', 9, -80.00, 'Jährliche Versicherungszahlung'),
('Freelance-Job', 3, 500.00, 'Zusätzliche Einnahmen durch freiberufliche Arbeit'),
('Strom', 8, -50.00, 'Monatliche Stromrechnung'),
('Shopping', 6, -80.00, 'Monatliche Ausgaben für Freizeitaktivitäten'),
('Miete', 2, -1200.00, 'Monatliche Mietzahlung'),
('Gehalt', 3, 2000.00, 'Monatliches Gehalt'),
('Miete', 2, -1200.00, 'Monatliche Mietzahlung');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `kategorien`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(60) NOT NULL,
  `category_income` BOOLEAN DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `kategorien`
--

INSERT INTO `categories` (`category_id`, `category_name`, `category_income`) VALUES
(1, 'Lebensmittel', false),
(2, 'Miete', false),
(3, 'Gehalt', true),
(4, 'Transport', false),
(5, 'Gesundheit', false),
(6, 'Freizeit', false),
(7, 'Kleidung', false),
(8, 'Strom', false),
(9, 'Versicherung', false),
(10, 'Sonstiges', false);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `eintraege`
--
ALTER TABLE `inputs`
  ADD PRIMARY KEY (`input_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indizes für die Tabelle `feste_werte`
--
ALTER TABLE `repeated_inputs`
  ADD PRIMARY KEY (`repeated_input_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indizes für die Tabelle `kategorien`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `eintraege`
--
ALTER TABLE `inputs`
  MODIFY `input_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=197;

--
-- AUTO_INCREMENT für Tabelle `feste_werte`
--
ALTER TABLE `repeated_inputs`
  MODIFY `repeated_input_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT für Tabelle `kategorien`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `eintraege`
--
ALTER TABLE `inputs`
  ADD CONSTRAINT `inputs_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`);

--
-- Constraints der Tabelle `feste_werte`
--
ALTER TABLE `repeated_inputs`
  ADD CONSTRAINT `repeated_inputs_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
