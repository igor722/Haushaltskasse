-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 06. Feb 2024 um 11:34
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
-- Datenbank: `budget-tracker3`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(60) NOT NULL,
  `category_income` tinyint(1) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `category_income`, `user_id`) VALUES
(12, 'Strom', 1, 2),
(13, 'Gehalt', 1, 2),
(14, 'Einnahme', 1, 4),
(15, 'Stickprogramm', 1, 2),
(16, 'Test Ausgabe', 0, 2),
(17, 'Placa', 1, 6),
(18, 'Struja', 0, 6);

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
  `input_description` text DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `inputs`
--

INSERT INTO `inputs` (`input_id`, `input_name`, `category_id`, `input_amount`, `input_datum`, `input_description`, `user_id`) VALUES
(87, 'Rechnung für Strom', 12, -120.00, '2024-01-02', 'Monatliche Strom Rechnung', 2),
(88, 'Lohn', 13, 3200.00, '2024-01-26', NULL, 2),
(89, 'Gehalt', 14, 3000.00, '2024-01-26', NULL, 4),
(90, 'Stickprogram DIR-22222', 15, -65.00, '2024-01-22', 'Brustlogo', 2),
(104, 'Test 1 sollte -', 12, -100.00, '2024-01-28', '', 2),
(105, 'Test 2 sollte +', 15, -100.00, '2024-01-28', '', 2),
(106, 'Test 3 sollte +', 15, 100.00, '2024-01-28', '', 2),
(107, 'Test 4 sollte -', 12, 100.00, '2024-01-28', '', 2),
(108, 'Sollte +', 13, 100.00, '2024-01-28', '', 2),
(109, 'Sollte -', 12, 100.00, '2024-01-28', '', 2),
(110, 'Sollte minus 2', 12, 2.00, '2024-01-29', '', 2),
(112, 'TEST 5', 12, 100.00, '2024-01-29', '', 2),
(113, 'Platzhalter', 13, 500.00, '2024-01-30', '', 2),
(114, 'Platzhalter 2 ', 12, 500.00, '2024-01-30', '', 2),
(115, 'Platzhalter 3', 12, 200.00, '2024-01-30', '', 2),
(116, 'Platzhalter 4', 12, 200.00, '2024-01-30', '', 2),
(117, 'Platzhalter 5', 12, 200.00, '2024-01-30', '', 2),
(118, 'Platzhalter', 15, 500.00, '2024-01-30', '', 2),
(119, 'Mjesecna', 17, 3000.00, '2024-01-30', '', 6),
(120, 'Mjesecna', 18, 100.00, '2024-01-30', '', 6),
(121, 'Lohn', 13, 3200.00, '2024-01-30', NULL, 2),
(122, 'Mjesecne rate', 12, -80.00, '2024-01-30', NULL, 2),
(123, 'TEST from all_inputs', NULL, -200.00, '2024-01-31', '', NULL),
(124, 'Test aus all_inputs.php', 12, -200.00, '2024-01-31', '', 2),
(125, 'Test-Feste Eintrag aus repeated_inputs 3', 13, 200.00, '2024-01-31', NULL, 2),
(126, 'Test-Feste Eintrag aus repeated_inputs 3', 13, 200.00, '2024-01-31', NULL, 2),
(127, 'Test-Feste Eintrag aus repeated_inputs 2', 15, 500.00, '2024-01-31', NULL, 2),
(128, 'Test-Feste Eintrag aus repeated_inputs', 12, -100.00, '2024-01-31', NULL, 2),
(129, 'Mjesecne rate', 12, -80.00, '2024-01-31', NULL, 2),
(130, 'Lohn', 13, 3200.00, '2024-01-31', NULL, 2),
(131, 'Test-Feste Eintrag aus repeated_inputs 3', 13, 200.00, '2024-01-31', NULL, 2),
(132, 'Test-Feste Eintrag aus repeated_inputs 2', 15, 500.00, '2024-01-31', NULL, 2),
(133, 'Test-Feste Eintrag aus repeated_inputs', 12, -100.00, '2024-01-31', NULL, 2),
(134, 'Mjesecne rate', 12, -80.00, '2024-01-31', NULL, 2),
(135, 'Test-Feste Eintrag aus repeated_inputs 3', 13, 200.00, '2024-01-31', NULL, 2),
(136, 'Test-Feste Eintrag aus repeated_inputs 2', 15, 500.00, '2024-01-31', NULL, 2),
(137, 'Test-Feste Eintrag aus repeated_inputs', 12, -100.00, '2024-01-31', NULL, 2),
(138, 'Test-Feste Eintrag aus repeated_inputs', 12, -100.00, '2024-01-31', NULL, 2),
(139, 'Mjesecne rate', 12, -80.00, '2024-01-31', NULL, 2),
(140, 'Lohn', 13, 3200.00, '2024-01-31', NULL, 2);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `repeated_inputs`
--

CREATE TABLE `repeated_inputs` (
  `repeated_input_id` int(11) NOT NULL,
  `repeated_input_name` varchar(60) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `repeated_input_amount` decimal(10,2) NOT NULL,
  `repeated_input_description` text DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `repeated_inputs`
--

INSERT INTO `repeated_inputs` (`repeated_input_id`, `repeated_input_name`, `category_id`, `repeated_input_amount`, `repeated_input_description`, `user_id`) VALUES
(13, 'Lohn', 13, 3200.00, 'Monatliche Lohn', 2),
(14, 'Gehalt', 14, 3000.00, '', 4),
(15, 'Mjesecne rate', 12, -80.00, '', 2),
(16, 'Test-Feste Eintrag aus repeated_inputs', 12, -100.00, '', 2),
(17, 'Test-Feste Eintrag aus repeated_inputs 2', 15, 500.00, '', 2),
(18, 'Test-Feste Eintrag aus repeated_inputs 3', 13, 200.00, '', 2);

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
(2, 'igor@test.de', 'e10adc3949ba59abbe56e057f20f883e', 'Igor'),
(3, 'test@test.de', 'e10adc3949ba59abbe56e057f20f883e', 'test'),
(4, 'igor2@test.de', 'e10adc3949ba59abbe56e057f20f883e', 'Igor2'),
(5, 'sanja@test.de', 'e10adc3949ba59abbe56e057f20f883e', 'Sanja'),
(6, 'josip@test.de', 'e10adc3949ba59abbe56e057f20f883e', 'Josip');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indizes für die Tabelle `inputs`
--
ALTER TABLE `inputs`
  ADD PRIMARY KEY (`input_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indizes für die Tabelle `repeated_inputs`
--
ALTER TABLE `repeated_inputs`
  ADD PRIMARY KEY (`repeated_input_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `user_id` (`user_id`);

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
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT für Tabelle `inputs`
--
ALTER TABLE `inputs`
  MODIFY `input_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;

--
-- AUTO_INCREMENT für Tabelle `repeated_inputs`
--
ALTER TABLE `repeated_inputs`
  MODIFY `repeated_input_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints der Tabelle `inputs`
--
ALTER TABLE `inputs`
  ADD CONSTRAINT `inputs_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`),
  ADD CONSTRAINT `inputs_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints der Tabelle `repeated_inputs`
--
ALTER TABLE `repeated_inputs`
  ADD CONSTRAINT `repeated_inputs_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`),
  ADD CONSTRAINT `repeated_inputs_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
