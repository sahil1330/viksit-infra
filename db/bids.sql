-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 29, 2024 at 11:33 AM
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
-- Table structure for table `bids`
--

CREATE TABLE `bids` (
  `id` int NOT NULL,
  `project_id` int NOT NULL,
  `bidderName` varchar(255) NOT NULL,
  `bidAmount` decimal(10,2) NOT NULL,
  `bidderBudget` varchar(255) NOT NULL,
  `bidderTechnicalData` varchar(255) NOT NULL,
  `bidderNextAudit` date NOT NULL,
  `bidderVerifyingStatus` enum('Pending','Approved','Rejected') NOT NULL,
  `bidderVerifyingComments` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `bids`
--

INSERT INTO `bids` (`id`, `project_id`, `bidderName`, `bidAmount`, `bidderBudget`, `bidderTechnicalData`, `bidderNextAudit`, `bidderVerifyingStatus`, `bidderVerifyingComments`) VALUES
(1, 1, 'Company A', 50000.00, 'uploads/company_a_budget.pdf', 'uploads/company_a_technical.pdf', '2024-09-15', 'Pending', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bids`
--
ALTER TABLE `bids`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_id` (`project_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bids`
--
ALTER TABLE `bids`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bids`
--
ALTER TABLE `bids`
  ADD CONSTRAINT `bids_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
