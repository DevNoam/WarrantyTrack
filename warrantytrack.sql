-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 04, 2024 at 05:00 PM
-- Server version: 8.0.32
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `warrantytrack`
--

-- --------------------------------------------------------

--
-- Table structure for table `cases`
--

CREATE TABLE `cases` (
  `Casenumber` int NOT NULL COMMENT 'The case number that has been created.',
  `clientName` varchar(256) NOT NULL,
  `phoneNumber` varchar(11) NOT NULL,
  `Address` varchar(256) NOT NULL,
  `ReciptNumber` varchar(256) NOT NULL COMMENT 'The receipt of the defected product',
  `ProductSKU` varchar(256) DEFAULT NULL,
  `ProductSerial` varchar(256) DEFAULT NULL,
  `ProductName` varchar(256) NOT NULL,
  `CaseDescription` text NOT NULL COMMENT 'Why client gave the product for checkup, describe the problem.',
  `CreatedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `CaseClosedAt` date DEFAULT NULL,
  `OrderDate` date NOT NULL COMMENT 'When the product has been bought',
  `Status` set('OPEN','Waiting for customer','Waiting for supplier','Returning from supplier','Picked by supplier','Shipped to supplier','Being checked','CLOSED') NOT NULL DEFAULT 'OPEN' COMMENT 'Status of the case, is the case open, resolved.',
  `Fixed` enum('Fixed','Supplied new product','Unfixable','Unsolved','Closed by customer','Product is working') DEFAULT NULL COMMENT 'Choose from the following when the product has been returned or case has been closed.',
  `Fixed Description` text COMMENT 'Tell what was the problem and if the case has been resolved.',
  `Createdby` varchar(256) NOT NULL DEFAULT 'General' COMMENT 'Which agent created the case',
  `Supplier` varchar(256) DEFAULT 'UNKOWN' COMMENT 'Who is the supplier of the product. Warranty will be covered by the supplier.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Triggers `cases`
--
DELIMITER $$
CREATE TRIGGER `update_average_time_on_case_update` AFTER UPDATE ON `cases` FOR EACH ROW BEGIN
    -- Update the AverageTimePerCase in settings
    UPDATE `settings` T
    SET T.AverageTimePerCase = (
        SELECT AVG(TIMESTAMPDIFF(DAY, DATE_FORMAT(CreatedAt, '%Y-%m-%d'), CaseClosedAt)) 
        FROM `cases`
        WHERE `Status` = 'CLOSED'
    );
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int NOT NULL,
  `deleteCases` int NOT NULL DEFAULT '0' COMMENT 'Time to delete old cases in days',
  `AverageTimePerCase` text,
  `StoreName` varchar(64) NOT NULL,
  `Address` text,
  `Phone` varchar(16) DEFAULT NULL,
  `Email` text,
  `Logo` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `deleteCases`, `AverageTimePerCase`, `StoreName`, `Address`, `Phone`, `Email`, `Logo`) VALUES
(1, 0, NULL, 'Example store', 'Example st 1', '09-00000000', 'support@example.com', 'https://example.com.au/wp-content/uploads/2020/03/EXAMPLE-LOGO-BLACK.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` set('Admin','Technician','Supplier','Employee') NOT NULL DEFAULT 'Employee',
  `Name` varchar(64) DEFAULT NULL,
  `session` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `Name`, `session`) VALUES
(1, 'Admin', '$2y$10$KaEcfN5lPFHmb4fwjLF80.7VmdzYSH3kh5scv7lPEm/2tI5fz4Ct6', 'Admin', 'Administrator', 'ld40g38n15jufsbslnjbrrbei1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cases`
--
ALTER TABLE `cases`
  ADD PRIMARY KEY (`Casenumber`) USING BTREE,
  ADD UNIQUE KEY `Casenumber` (`Casenumber`) USING BTREE,
  ADD UNIQUE KEY `Casenumber_2` (`Casenumber`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cases`
--
ALTER TABLE `cases`
  MODIFY `Casenumber` int NOT NULL AUTO_INCREMENT COMMENT 'The case number that has been created.';

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
