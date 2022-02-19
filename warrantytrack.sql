-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: פברואר 19, 2022 בזמן 09:09 PM
-- גרסת שרת: 10.4.21-MariaDB
-- PHP Version: 8.0.12

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
CREATE DATABASE IF NOT EXISTS `warrantytrack` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `warrantytrack`;

-- --------------------------------------------------------

--
-- מבנה טבלה עבור טבלה `cases`
--

DROP TABLE IF EXISTS `cases`;
CREATE TABLE IF NOT EXISTS `cases` (
  `Casenumber` int(16) NOT NULL AUTO_INCREMENT COMMENT 'The case number that has been created.',
  `clientName` varchar(256) NOT NULL,
  `phoneNumber` varchar(11) NOT NULL,
  `Address` varchar(256) NOT NULL,
  `ReciptNumber` varchar(256) NOT NULL COMMENT 'The receipt of the defected product',
  `ProductSKU` varchar(256) DEFAULT NULL,
  `ProductSerial` varchar(256) DEFAULT NULL,
  `ProductName` varchar(256) NOT NULL,
  `CaseDescription` text NOT NULL COMMENT 'Why client gave the product for checkup, describe the problem.',
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `CaseClosedAt` date DEFAULT NULL,
  `OrderDate` date NOT NULL COMMENT 'When the product has been bought',
  `Status` set('OPEN','Waiting for customer','Waiting for supplier','Returning from supplier','Picked by supplier','Shipped to supplier','Being checked','CLOSED') NOT NULL DEFAULT 'OPEN' COMMENT 'Status of the case, is the case open, resolved.',
  `Fixed` enum('Fixed','Supplied new product','Unfixable','Unsolved','Closed by customer','Product is working') DEFAULT NULL COMMENT 'Choose from the following when the product has been returned or case has been closed.',
  `Fixed Description` text DEFAULT NULL COMMENT 'Tell what was the problem and if the case has been resolved.',
  `Createdby` varchar(256) NOT NULL DEFAULT 'General' COMMENT 'Which agent created the case',
  `Supplier` varchar(256) DEFAULT 'UNKOWN' COMMENT 'Who is the supplier of the product. Warranty will be covered by the supplier.',
  PRIMARY KEY (`Casenumber`) USING BTREE,
  UNIQUE KEY `Casenumber` (`Casenumber`) KEY_BLOCK_SIZE=8 USING BTREE,
  UNIQUE KEY `Casenumber_2` (`Casenumber`)
) ENGINE=InnoDB AUTO_INCREMENT=742 DEFAULT CHARSET=utf8mb4;

--
-- הוצאת מידע עבור טבלה `cases`
--

INSERT INTO `cases` (`Casenumber`, `clientName`, `phoneNumber`, `Address`, `ReciptNumber`, `ProductSKU`, `ProductSerial`, `ProductName`, `CaseDescription`, `CreatedAt`, `CaseClosedAt`, `OrderDate`, `Status`, `Fixed`, `Fixed Description`, `Createdby`, `Supplier`) VALUES
(737, 'Neamma cohen', '0500000000', 'Very cool address name 007', '23232323', '232323', 'WWP00357732', 'Jabra Elite 75t', 'Defected left earbud', '2022-02-16 20:19:55', '2022-02-18', '2022-02-01', 'Waiting for supplier', 'Supplied new product', '', 'Admin', 'UNKOWN');

--
-- Triggers `cases`
--
DROP TRIGGER IF EXISTS `Fetch average time per case`;
DELIMITER $$
CREATE TRIGGER `Fetch average time per case` BEFORE UPDATE ON `cases` FOR EACH ROW UPDATE `settings` T
SET AverageTimePerCase = (
    SELECT AVG(TIMESTAMPDIFF(DAY, DATE_FORMAT(CreatedAt,'%Y-%m-%d'), CaseClosedAt)) 
    AS avgTime 
    FROM cases 
    WHERE Status = 'CLOSED') WHERE 1
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- מבנה טבלה עבור טבלה `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `Domain` varchar(100) NOT NULL DEFAULT 'localhost',
  `deleteCases` set('NEVER','90','120','180','365') NOT NULL DEFAULT '90',
  `AverageTimePerCase` text DEFAULT NULL,
  `StoreName` varchar(64) NOT NULL,
  `Address` text DEFAULT NULL,
  `Phone` varchar(16) DEFAULT NULL,
  `Email` text DEFAULT NULL,
  `Logo` text DEFAULT NULL,
  PRIMARY KEY (`Domain`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- הוצאת מידע עבור טבלה `settings`
--

INSERT INTO `settings` (`Domain`, `deleteCases`, `AverageTimePerCase`, `StoreName`, `Address`, `Phone`, `Email`, `Logo`) VALUES
('http://localhost/WarrantyTrack/', 'NEVER', NULL, 'Example store', 'Example st 0', '09-00000000', 'support@example.com', 'https://example.com.au/wp-content/uploads/2020/03/EXAMPLE-LOGO-BLACK.png');

-- --------------------------------------------------------

--
-- מבנה טבלה עבור טבלה `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` set('Admin','Technician','Supplier','Employee') NOT NULL DEFAULT 'Employee',
  `Name` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=utf8mb4;

--
-- הוצאת מידע עבור טבלה `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `Name`) VALUES
(1, 'Admin', '1234', 'Admin', 'Administrator');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
