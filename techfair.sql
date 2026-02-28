-- phpMyAdmin SQL Dump
-- Banco de dados completo do DriveHub - Pronto para hospedagem
--
-- Host: localhost
-- Generation Time: 2024
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `parkingdb`
--
CREATE DATABASE IF NOT EXISTS `parkingdb` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `parkingdb`;

-- --------------------------------------------------------

--
-- Table structure for table `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `placa` varchar(10) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ledcontrol`
--

CREATE TABLE `ledcontrol` (
  `ID` int(11) NOT NULL,
  `Event` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ledPin` int(11) NOT NULL,
  `ledStatus` varchar(11) NOT NULL,
  `brightness` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ledcontrol`
--

INSERT INTO `ledcontrol` (`ID`, `Event`, `ledPin`, `ledStatus`, `brightness`) VALUES
(1, '2016-02-14 16:41:56', 4, 'ledon', 1);

-- --------------------------------------------------------

--
-- Table structure for table `parkinglot`
--

CREATE TABLE `parkinglot` (
  `Id` int(11) NOT NULL,
  `Position` int(11) NOT NULL,
  `Available` int(11) NOT NULL DEFAULT 1,
  `SensorId` int(11) DEFAULT NULL,
  `ocupado_desde` datetime DEFAULT NULL,
  `placa` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `created_at`) VALUES
(1, 'Administrador', 'admin@drivehub.com', MD5('123456'), CURRENT_TIMESTAMP);

-- --------------------------------------------------------

--
-- Indexes for dumped tables
--

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
-- Indexes for table `parkinglot`
--
ALTER TABLE `parkinglot`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Position` (`Position`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

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

--
-- AUTO_INCREMENT for table `parkinglot`
--
ALTER TABLE `parkinglot`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;