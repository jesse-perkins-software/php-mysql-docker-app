-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 12, 2024 at 08:05 PM
-- Server version: 8.0.40-0ubuntu0.20.04.1
-- PHP Version: 7.4.3-4ubuntu2.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `C354_w3jperkins`
--

-- --------------------------------------------------------

--
-- Table structure for table `Transactions`
--

CREATE TABLE `Transactions` (
  `Id` int NOT NULL,
  `Username` varchar(1024) NOT NULL,
  `Amount` decimal(10,2) NOT NULL,
  `Category` varchar(1024) NOT NULL,
  `Account` varchar(1024) NOT NULL,
  `Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `Transactions`
--

INSERT INTO `Transactions` (`Id`, `Username`, `Amount`, `Category`, `Account`, `Date`) VALUES
(479, 'test', '5000.00', 'Income', 'Chequing', '2024-11-01'),
(480, 'test', '500.00', 'Groceries', 'Credit Card', '2024-11-09'),
(481, 'test', '200.00', 'Utilities', 'Savings', '2024-11-16'),
(482, 'test', '300.00', 'Entertainment', 'Savings', '2024-11-07'),
(483, 'test', '50.00', 'Transport', 'Credit Card', '2024-11-09'),
(484, 'test', '300.00', 'Savings', 'Savings', '2024-11-12'),
(485, 'test', '100.00', 'Travel Fund', 'Savings', '2024-11-21'),
(486, 'test', '100.00', 'Emergency Fund', 'Chequing', '2024-11-21'),
(487, 'test', '400.00', 'Hobbies', 'Credit Card', '2024-11-20'),
(488, 'test', '4000.00', 'Income', 'Savings', '2024-10-02'),
(489, 'test', '200.00', 'Travel Fund', 'Chequing', '2024-10-25'),
(490, 'test', '600.00', 'Entertainment', 'Chequing', '2024-10-11'),
(491, 'test', '1000.00', 'Rent', 'Savings', '2024-10-09'),
(492, 'test', '1000.00', 'Rent', 'Savings', '2024-11-14'),
(493, 'abc', '150.00', 'Hobbies', 'Chequing', '2024-12-02');

-- --------------------------------------------------------

--
-- Table structure for table `UserDetails`
--

CREATE TABLE `UserDetails` (
  `Id` int NOT NULL,
  `Username` varchar(1024) NOT NULL,
  `Country` varchar(1024) NOT NULL,
  `Phone` varchar(1024) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `UserDetails`
--

INSERT INTO `UserDetails` (`Id`, `Username`, `Country`, `Phone`) VALUES
(34, 'abc', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `UserFunds`
--

CREATE TABLE `UserFunds` (
  `Id` int NOT NULL,
  `Username` varchar(1024) NOT NULL,
  `AmountSaved` decimal(10,2) NOT NULL,
  `EmergencyFund` decimal(10,2) NOT NULL,
  `TravelFund` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `UserFunds`
--

INSERT INTO `UserFunds` (`Id`, `Username`, `AmountSaved`, `EmergencyFund`, `TravelFund`) VALUES
(5, 'abc', '1000.00', '500.00', '500.00');

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `Id` int NOT NULL,
  `firstName` varchar(256) NOT NULL,
  `lastName` varchar(256) NOT NULL,
  `Username` varchar(256) NOT NULL,
  `Password` varchar(2048) NOT NULL,
  `Email` varchar(256) NOT NULL,
  `Date` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`Id`, `firstName`, `lastName`, `Username`, `Password`, `Email`, `Date`) VALUES
(7, 'John', 'Doe', 'test', 'test', 'johndoe@gmail.com', 20241122),
(9, 'abc', 'abc', 'abc', 'abc', 'abc@tru.ca', 20241203);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Transactions`
--
ALTER TABLE `Transactions`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `UserDetails`
--
ALTER TABLE `UserDetails`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `UserFunds`
--
ALTER TABLE `UserFunds`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Transactions`
--
ALTER TABLE `Transactions`
  MODIFY `Id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=495;

--
-- AUTO_INCREMENT for table `UserDetails`
--
ALTER TABLE `UserDetails`
  MODIFY `Id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `UserFunds`
--
ALTER TABLE `UserFunds`
  MODIFY `Id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `Id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
