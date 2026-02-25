-- phpMyAdmin SQL Dump
-- Banco de dados atualizado com as modificações do projeto DriveHub
--
-- Host: 127.0.0.1
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `parkingdb`
--
CREATE DATABASE IF NOT EXISTS `parkingdb` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `parkingdb`;

-- --------------------------------------------------------

--
-- Table structure for table `parkinglot` (ATUALIZADA)
--

CREATE TABLE `parkinglot` (
  `Id` int(11) NOT NULL,
  `Position` int(11) NOT NULL,
  `Available` int(11) NOT NULL DEFAULT 1,
  `SensorId` int(11) DEFAULT NULL,
  `ocupado_desde` timestamp NULL DEFAULT NULL,
  `placa` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Position` (`Position`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `parkinglot`
--

INSERT INTO `parkinglot` (`Id`, `Position`, `Available`, `SensorId`, `ocupado_desde`, `placa`) VALUES
(1, 1, 1, 100, NULL, NULL),
(2, 2, 1, 200, NULL, NULL),
(3, 3, 1, 300, NULL, NULL),
(4, 4, 1, 400, NULL, NULL),
(5, 5, 1, 500, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `clientes` (NOVA)
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `placa` varchar(10) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `placa` (`placa`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ledcontrol` (ORIGINAL, se ainda usar)
--

CREATE TABLE `ledcontrol` (
  `ID` int(11) NOT NULL,
  `Event` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ledPin` int(11) NOT NULL,
  `ledStatus` varchar(11) NOT NULL,
  `brightness` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ledcontrol`
--

INSERT INTO `ledcontrol` (`ID`, `Event`, `ledPin`, `ledStatus`, `brightness`) VALUES
(1, '2016-02-14 16:41:56', 4, 'ledon', 1);

-- --------------------------------------------------------

--
-- Indexes for dumped tables
--

--
-- Indexes for table `parkinglot`
--
ALTER TABLE `parkinglot`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `placa` (`placa`);

--
-- Indexes for table `ledcontrol`
--
ALTER TABLE `ledcontrol`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `parkinglot`
--
ALTER TABLE `parkinglot`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ledcontrol`
--
ALTER TABLE `ledcontrol`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;