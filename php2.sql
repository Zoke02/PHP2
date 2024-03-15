-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 15, 2024 at 08:22 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `php2`
--

-- --------------------------------------------------------

--
-- Table structure for table `benutzer`
--

CREATE TABLE `benutzer` (
  `id` int(10) UNSIGNED NOT NULL,
  `benutzername` varchar(50) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `passwort` varchar(255) NOT NULL,
  `anzahl_login` int(11) NOT NULL,
  `last_login` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `benutzer`
--

INSERT INTO `benutzer` (`id`, `benutzername`, `email`, `passwort`, `anzahl_login`, `last_login`) VALUES
(1, 'herbert', NULL, '$2y$10$X3fcTRXus/r8DOoEQ61ZE.KPk.Qgp7LtWvsgJy7pg/VZ/uyO0ztNu', 19, '2024-03-15 19:47:41'),
(3, 'gustav', 'gustav@wifi.de', '$2y$10$1md/7zmz6y7vZkNUc2MJx.tzH9w68ExrL7xLF6DAimVVwTMEq7mMS', 1, '2024-03-15 19:05:01'),
(4, 'christian', 'herbst@gmx.at', '$2y$10$1md/7zmz6y7vZkNUc2MJx.tzH9w68ExrL7xLF6DAimVVwTMEq7mMS', 0, NULL),
(5, 'herbst', 'herbst@wifi.at', '$2y$10$X3fcTRXus/r8DOoEQ61ZE.KPk.Qgp7LtWvsgJy7pg/VZ/uyO0ztNu', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `rezepte`
--

CREATE TABLE `rezepte` (
  `id` int(10) UNSIGNED NOT NULL,
  `titel` varchar(50) DEFAULT NULL,
  `beschreibung` text DEFAULT NULL,
  `benutzer_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `rezepte`
--

INSERT INTO `rezepte` (`id`, `titel`, `beschreibung`, `benutzer_id`) VALUES
(1, 'Kaiserschmarr', 'Ist sehr gelb.', 1),
(2, 'Gulasch', 'herzhaft lecker', 3);

-- --------------------------------------------------------

--
-- Table structure for table `zutaten`
--

CREATE TABLE `zutaten` (
  `id` int(10) UNSIGNED NOT NULL,
  `titel` varchar(50) NOT NULL,
  `menge` float DEFAULT NULL,
  `einheit` varchar(50) DEFAULT NULL,
  `kcal_pro_100` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `zutaten`
--

INSERT INTO `zutaten` (`id`, `titel`, `menge`, `einheit`, `kcal_pro_100`) VALUES
(1, 'Zwiebel', 1, 'Stk', 100),
(2, 'Mehl', 100, 'Gramm', 10),
(3, 'Eier', 1, 'Stk', 250);

-- --------------------------------------------------------

--
-- Table structure for table `zutaten_zu_rezepte`
--

CREATE TABLE `zutaten_zu_rezepte` (
  `id` int(10) UNSIGNED NOT NULL,
  `rezepte_id` int(10) UNSIGNED NOT NULL,
  `zutaten_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `zutaten_zu_rezepte`
--

INSERT INTO `zutaten_zu_rezepte` (`id`, `rezepte_id`, `zutaten_id`) VALUES
(1, 2, 3),
(2, 1, 2),
(3, 2, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `benutzer`
--
ALTER TABLE `benutzer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `benutzername` (`benutzername`);

--
-- Indexes for table `rezepte`
--
ALTER TABLE `rezepte`
  ADD PRIMARY KEY (`id`),
  ADD KEY `titel` (`titel`),
  ADD KEY `benutzer_id` (`benutzer_id`);

--
-- Indexes for table `zutaten`
--
ALTER TABLE `zutaten`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zutaten_zu_rezepte`
--
ALTER TABLE `zutaten_zu_rezepte`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rezepte_id` (`rezepte_id`),
  ADD KEY `zutaten_id` (`zutaten_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `benutzer`
--
ALTER TABLE `benutzer`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `rezepte`
--
ALTER TABLE `rezepte`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `zutaten`
--
ALTER TABLE `zutaten`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `zutaten_zu_rezepte`
--
ALTER TABLE `zutaten_zu_rezepte`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `rezepte`
--
ALTER TABLE `rezepte`
  ADD CONSTRAINT `rezepte_ibfk_2` FOREIGN KEY (`benutzer_id`) REFERENCES `benutzer` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `zutaten_zu_rezepte`
--
ALTER TABLE `zutaten_zu_rezepte`
  ADD CONSTRAINT `zutaten_zu_rezepte_ibfk_1` FOREIGN KEY (`rezepte_id`) REFERENCES `rezepte` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `zutaten_zu_rezepte_ibfk_2` FOREIGN KEY (`zutaten_id`) REFERENCES `zutaten` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
