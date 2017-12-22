-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Dec 21, 2017 at 08:38 AM
-- Server version: 5.6.35
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aemon`
--

-- --------------------------------------------------------

--
-- Table structure for table `army`
--

CREATE TABLE `army` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `unit`
--

CREATE TABLE `unit` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `unit_type` int(11) DEFAULT NULL,
  `level` int(11) NOT NULL,
  `power` decimal(10,2) NOT NULL,
  `attack` int(11) NOT NULL,
  `defense` int(11) NOT NULL,
  `health` int(11) NOT NULL,
  `speed` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `unit`
--

INSERT INTO `unit` (`id`, `name`, `unit_type`, `level`, `power`, `attack`, `defense`, `health`, `speed`) VALUES
(2, 'Milice', 1, 1, '2.00', 8, 8, 11, 9),
(3, 'Fantassin', 1, 2, '2.80', 10, 10, 13, 9),
(4, 'Epée-loué', 1, 3, '3.80', 16, 15, 17, 10),
(5, 'Homme d\'armes', 1, 4, '5.00', 18, 20, 24, 9),
(6, 'Porteur d\'hâche', 1, 5, '6.40', 27, 21, 26, 10),
(7, 'Capitaine', 1, 6, '8.00', 27, 29, 34, 9),
(8, 'Epée Lige', 1, 7, '9.80', 38, 32, 39, 9),
(9, 'Immaculé', 1, 8, '11.80', 40, 46, 51, 10),
(10, 'Veteran', 1, 9, '14.00', 55, 51, 52, 10),
(11, 'Garde de maison', 1, 10, '16.40', 62, 64, 69, 9),
(12, 'Frondeur', 2, 1, '2.00', 8, 8, 10, 9),
(13, 'Archer', 2, 2, '2.80', 10, 10, 13, 9),
(14, 'Archer à l\'arc long', 2, 3, '3.80', 16, 14, 17, 9),
(15, 'Arbaletier', 2, 4, '5.00', 18, 20, 24, 9),
(16, 'Hallbardier', 2, 5, '6.40', 27, 20, 26, 9),
(17, 'Archer d\'elite', 2, 6, '8.00', 27, 26, 34, 9),
(18, 'Tireur d\'elite', 2, 7, '9.80', 38, 29, 39, 9),
(19, 'Arbaletier champion', 2, 8, '11.80', 40, 45, 51, 9),
(20, 'Capitain archer', 2, 9, '14.00', 55, 46, 52, 9),
(21, 'Tireur d\'élite expert', 2, 10, '16.40', 62, 55, 69, 9),
(22, 'Ecuyer', 3, 1, '2.00', 8, 10, 10, 16),
(23, 'Arpenteur', 3, 2, '2.80', 10, 11, 13, 16),
(24, 'Cavalier leger', 3, 3, '3.80', 16, 14, 17, 16),
(25, 'Lancier', 3, 4, '5.00', 20, 18, 24, 15),
(26, 'Archer à cheval', 3, 5, '6.40', 29, 19, 26, 15),
(27, 'Champion à cheval', 3, 6, '8.00', 29, 27, 24, 16),
(28, 'Hallebardier à cheval', 3, 7, '9.80', 39, 31, 39, 15),
(29, 'Lancier lourd', 3, 8, '11.80', 39, 47, 51, 16),
(30, 'Sang-coureur', 3, 9, '14.00', 57, 49, 52, 15),
(31, 'Chevalier Oint', 3, 10, '16.40', 66, 60, 69, 16),
(32, 'Catapulte', 4, 1, '2.00', 8, 10, 12, 8),
(33, 'Belier', 4, 2, '2.80', 9, 16, 19, 6),
(34, 'Tour de siège', 4, 3, '3.80', 14, 17, 20, 8),
(35, 'Char de guerre', 4, 4, '5.00', 15, 24, 34, 6),
(36, 'Trebucher', 4, 5, '6.40', 27, 21, 31, 8),
(37, 'Tour d\'archer', 4, 6, '8.00', 27, 30, 48, 6),
(38, 'Belier renforcé', 4, 7, '9.80', 38, 32, 46, 8),
(39, 'Trébucher renforcé', 4, 8, '11.80', 40, 46, 61, 8),
(40, 'Tourelles', 4, 9, '14.00', 39, 60, 74, 6),
(41, 'Catapulte à feux', 4, 10, '16.40', 63, 63, 77, 8),
(42, 'Piège', 6, 1, '1.60', 9, 1, 39, 0),
(43, 'Piège', 6, 2, '2.60', 12, 1, 39, 0),
(44, 'Piège', 6, 3, '3.80', 16, 2, 39, 0),
(45, 'Piège', 6, 4, '5.00', 21, 2, 39, 0),
(46, 'Piège', 6, 5, '6.40', 28, 3, 78, 0),
(47, 'Piège', 6, 6, '8.00', 35, 3, 78, 0),
(48, 'Piège', 6, 9, '15.60', 65, 5, 117, 0),
(49, 'Piège', 6, 10, '19.50', 77, 5, 117, 0),
(50, 'Piège', 6, 7, '10.00', 45, 4, 78, 0),
(51, 'Piège', 6, 8, '12.50', 54, 4, 117, 0);

-- --------------------------------------------------------

--
-- Table structure for table `unit_type`
--

CREATE TABLE `unit_type` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `unit_type`
--

INSERT INTO `unit_type` (`id`, `name`) VALUES
(1, 'Infanterie'),
(2, 'Distance'),
(3, 'Cavalerie'),
(4, 'Siege'),
(6, 'Pièges');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `army`
--
ALTER TABLE `army`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `unit`
--
ALTER TABLE `unit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_DCBB0C5318B673` (`unit_type`);

--
-- Indexes for table `unit_type`
--
ALTER TABLE `unit_type`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `army`
--
ALTER TABLE `army`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `unit`
--
ALTER TABLE `unit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
--
-- AUTO_INCREMENT for table `unit_type`
--
ALTER TABLE `unit_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `unit`
--
ALTER TABLE `unit`
  ADD CONSTRAINT `FK_DCBB0C5318B673` FOREIGN KEY (`unit_type`) REFERENCES `unit_type` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
