-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2026 at 10:15 AM
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
-- Database: `misskarin`
--

-- --------------------------------------------------------

--
-- Table structure for table `taallessen`
--

CREATE TABLE `taallessen` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(6,2) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `taallessen`
--

INSERT INTO `taallessen` (`id`, `name`, `price`, `description`) VALUES
(8, 'A1-les', 1999.00, 'Nederlandse taalles niveau A1 (inburgering, per semester)'),
(9, 'A2-les', 1999.00, 'Nederlandse taalles niveau A2 (inburgering, per semester)'),
(10, 'B1-les', 1999.00, 'Nederlandse taalles niveau B1 (inburgering, per semester)'),
(11, 'B2-les', 1999.00, 'Nederlandse taalles niveau B2 (inburgering, per semester)'),
(12, 'ONA-les', 1195.00, 'Oriëntatie op de Nederlandse Arbeidsmarkt (per module, 64 uur les)'),
(13, 'KNM-les', 1195.00, 'Kennis van de Nederlandse Maatschappij (per module)'),
(14, 'Privéles', 49.00, 'Individuele examtraining (spreken, schrijven, lezen, luisteren) per uur'),
(15, 'Online les', 0.00, 'Online Nederlandse les (prijs nog niet bepaald)');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `taallessen`
--
ALTER TABLE `taallessen`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `taallessen`
--
ALTER TABLE `taallessen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
