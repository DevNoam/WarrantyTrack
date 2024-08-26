-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 26, 2024 at 07:50 PM
-- Server version: 8.0.30
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
-- Dumping data for table `cases`
--

INSERT INTO `cases` (`Casenumber`, `clientName`, `phoneNumber`, `Address`, `ReciptNumber`, `ProductSKU`, `ProductSerial`, `ProductName`, `CaseDescription`, `CreatedAt`, `CaseClosedAt`, `OrderDate`, `Status`, `Fixed`, `Fixed Description`, `Createdby`, `Supplier`) VALUES
(742, 'Neamma cohen', '0500000000', 'Very cool address name 007', '23232323', '232323', 'WWP00357732', 'Jabra Elite 75t', 'Defected left earbud', '2022-02-16 20:19:55', '2026-02-04', '2022-02-01', 'Waiting for supplier', 'Supplied new product', '', 'Admin', 'UNKOWN');

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

INSERT INTO `settings` (`deleteCases`, `AverageTimePerCase`, `StoreName`, `Address`, `Phone`, `Email`, `Logo`) VALUES
(0, NULL, 'Example store', 'Example st 0', '09-00000000', 'support@example.com', 'https://example.com.au/wp-content/uploads/2020/03/EXAMPLE-LOGO-BLACK.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` set('Admin','Technician','Supplier','Employee') NOT NULL DEFAULT 'Employee',
  `Name` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `Name`) VALUES
(1, 'Admin', '$2y$10$93HPMI1HWdgFlB0qyW8UAeoXGl0NR8IoVohA8RAE6GUcyM5W5yol.', 'Admin', 'Administrator');

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
  MODIFY `Casenumber` int NOT NULL AUTO_INCREMENT COMMENT 'The case number that has been created.', AUTO_INCREMENT=744;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`root`@`localhost` EVENT `update_average_time_per_case_event` ON SCHEDULE EVERY 1 DAY STARTS '2000-01-01 00:00:00' ON COMPLETION NOT PRESERVE ENABLE DO -- Update the AverageTimePerCase in settings
    UPDATE `settings` T
    SET T.AverageTimePerCase = (
        SELECT AVG(TIMESTAMPDIFF(DAY, DATE_FORMAT(CreatedAt, '%Y-%m-%d'), CaseClosedAt)) 
        FROM `cases`
        WHERE `Status` = 'CLOSED'
    )$$

CREATE DEFINER=`root`@`localhost` EVENT `delete_old_cases_event` ON SCHEDULE EVERY 1 DAY STARTS '2000-01-01 00:00:00' ON COMPLETION NOT PRESERVE ENABLE DO -- Delete cases that are CLOSED and older than the specified days
    DELETE FROM `cases`
    WHERE `Status` = 'CLOSED'
    AND `CaseClosedAt` < DATE_SUB(CURDATE(), INTERVAL (
        SELECT CAST(`deleteCases` AS UNSIGNED)
        FROM `settings`
        WHERE 1
    ) DAY)
    AND (SELECT `deleteCases` FROM `settings` WHERE 1) != 0$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
