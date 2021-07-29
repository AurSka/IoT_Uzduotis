-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 29, 2021 at 02:36 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `iot_akademija`
--

-- --------------------------------------------------------

--
-- Table structure for table `miestai`
--

CREATE TABLE `miestai` (
  `Pavadinimas` varchar(40) COLLATE utf32_lithuanian_ci NOT NULL,
  `Plotas` double NOT NULL,
  `Gyventojai` double NOT NULL,
  `Pasto_kodas` varchar(8) COLLATE utf32_lithuanian_ci NOT NULL,
  `FK_Salies_Id` int(11) NOT NULL,
  `Miesto_Id` int(11) NOT NULL,
  `Pridejimo_data` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_lithuanian_ci;

--
-- Dumping data for table `miestai`
--

INSERT INTO `miestai` (`Pavadinimas`, `Plotas`, `Gyventojai`, `Pasto_kodas`, `FK_Salies_Id`, `Miesto_Id`, `Pridejimo_data`) VALUES
('h', 4, 4, 'AA-45682', 5, 26, '2021-07-29');

-- --------------------------------------------------------

--
-- Table structure for table `salys`
--

CREATE TABLE `salys` (
  `Pavadinimas` varchar(40) COLLATE utf32_lithuanian_ci NOT NULL,
  `Plotas` double NOT NULL,
  `Gyventojai` double NOT NULL,
  `Tel_kodas` int(5) NOT NULL,
  `Salies_Id` int(11) NOT NULL,
  `Pridejimo_data` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_lithuanian_ci;

--
-- Dumping data for table `salys`
--

INSERT INTO `salys` (`Pavadinimas`, `Plotas`, `Gyventojai`, `Tel_kodas`, `Salies_Id`, `Pridejimo_data`) VALUES
('a', 5.5, 5.5, 373, 5, '2021-07-27'),
('a', 5.5, 5.5, 370, 7, '2021-07-27'),
('a', 5.5, 5.5, 370, 9, '2021-07-27'),
('a', 5.5, 5.5, 370, 10, '2021-07-27'),
('a', 5.5, 5.5, 370, 11, '2021-07-27'),
('a', 5.5, 5.5, 370, 12, '2021-07-27'),
('a', 5.5, 5.5, 370, 13, '2021-07-27'),
('a', 5.5, 5.5, 374, 14, '2021-07-27'),
('a', 5.5, 5.5, 372, 16, '2021-07-27'),
('b', 5.5, 5.5, 370, 17, '2021-07-27'),
('c', 3, 3, 333, 18, '2021-07-28'),
('g', 5, 5, 752, 19, '2021-07-28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `miestai`
--
ALTER TABLE `miestai`
  ADD PRIMARY KEY (`Miesto_Id`),
  ADD KEY `FK_Salies_Id` (`FK_Salies_Id`);

--
-- Indexes for table `salys`
--
ALTER TABLE `salys`
  ADD PRIMARY KEY (`Salies_Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `miestai`
--
ALTER TABLE `miestai`
  MODIFY `Miesto_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `salys`
--
ALTER TABLE `salys`
  MODIFY `Salies_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `miestai`
--
ALTER TABLE `miestai`
  ADD CONSTRAINT `FK_Salies_Id` FOREIGN KEY (`FK_Salies_Id`) REFERENCES `salys` (`Salies_Id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
