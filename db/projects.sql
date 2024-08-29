-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 29, 2024 at 07:08 AM
-- Server version: 8.0.36-cll-lve
-- PHP Version: 8.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `viksitin_mydb`
--

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int NOT NULL,
  `projectName` varchar(255) NOT NULL,
  `projectDetails` text,
  `deadline` date DEFAULT NULL,
  `bid` varchar(255) DEFAULT NULL,
  `bidValidFrom` date DEFAULT NULL,
  `bidExpireAt` date DEFAULT NULL,
  `bidderName` varchar(255) DEFAULT NULL,
  `bidderBudget` decimal(10,2) DEFAULT NULL,
  `bidderTechnicalData` text,
  `bidderNextAudit` date DEFAULT NULL,
  `bidderVerifyingStatus` enum('Pending','Approved','Rejected') DEFAULT 'Pending',
  `bidderVerifyingComments` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `projectName`, `projectDetails`, `deadline`, `bid`, `bidValidFrom`, `bidExpireAt`, `bidderName`, `bidderBudget`, `bidderTechnicalData`, `bidderNextAudit`, `bidderVerifyingStatus`, `bidderVerifyingComments`) VALUES
(1, 'Project Alpha', 'Details of Project Alpha', '2024-12-31', 'BID123', '2024-09-01', '2024-11-01', 'John Doe', 10000.00, 'Technical details', '2024-10-01', 'Pending', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
