-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 14, 2024 at 12:48 PM
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
-- Database: `adminpanel`
--

-- --------------------------------------------------------

--
-- Table structure for table `trainer`
--

CREATE TABLE `trainer` (
  `trainer_id` int(11) NOT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `join_date` date DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trainer`
--

INSERT INTO `trainer` (`trainer_id`, `user_name`, `name`, `phone_number`, `address`, `join_date`, `password`) VALUES
(1, 'john_doe', 'John Doe', '1234567890', '123 Main St, City', '2024-04-28', NULL),
(2, 'trainer_2', 'Jane Smith', '2345678901', '456 Elm St, Otherville', '2024-04-28', NULL),
(3, 'trainer_3', 'Michael Johnson', '3456789012', '789 Oak St, Somewhereville', '2024-04-28', NULL),
(4, 'trainer_4', 'Emma Williams', '4567890123', '321 Maple St, Nowhere', '2024-04-28', NULL),
(5, 'trainer_5', 'William Brown', '5678901234', '654 Pine St, Anyplace', '2024-04-28', NULL),
(14, 'Tilumi123', 'Tilumi Dilshani', '0717537700', 'Baudaloka Road colombo 7', NULL, '$2y$10$JaKT6rQt2G.G46xivfeBxetr4j.6LdhQ5dYSWVNY4rFv.OE0/G0Ku'),
(19, 'Manodi123', 'Manodi Vihagana Munasinghe', '0717537500', 'Rathnapura,Kiriella', '2024-06-08', '$2y$10$e5Ckod3IAOVsOVrtNdQyJ.wCkYo7.DGVHsNgUr1QAg0hX27Smjtc2'),
(21, 'Hashini123', 'Hashini', '0717537500', 'colmbo4', '2024-06-08', '$2y$10$L2ExuebimpaNESMBA/4aNOjcQ0MAdipVobOGZQjx4ztaCAm.OSoYm');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `trainer`
--
ALTER TABLE `trainer`
  ADD PRIMARY KEY (`trainer_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `trainer`
--
ALTER TABLE `trainer`
  MODIFY `trainer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
