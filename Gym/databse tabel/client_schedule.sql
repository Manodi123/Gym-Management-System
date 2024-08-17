-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 18, 2024 at 12:04 PM
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
-- Table structure for table `client_schedule`
--

CREATE TABLE `client_schedule` (
  `id` int(11) NOT NULL,
  `clientName` varchar(255) NOT NULL,
  `dayTimeStart` decimal(4,2) NOT NULL,
  `dayTimeEnd` decimal(4,2) NOT NULL,
  `nightTimeStart` decimal(4,2) NOT NULL,
  `nightTimeEnd` decimal(4,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `client_schedule`
--

INSERT INTO `client_schedule` (`id`, `clientName`, `dayTimeStart`, `dayTimeEnd`, `nightTimeStart`, `nightTimeEnd`, `created_at`) VALUES
(20, '  Manodi', 5.00, 7.50, 19.00, 20.00, '2024-05-17 17:13:14'),
(21, '', 5.00, 7.50, 19.00, 20.00, '2024-05-17 17:25:10'),
(22, '', 6.00, 9.00, 19.50, 20.00, '2024-05-17 18:14:05'),
(23, '', 5.00, 7.50, 19.50, 20.00, '2024-05-17 18:31:53'),
(24, 'Hashini', 5.00, 7.50, 19.00, 20.00, '2024-05-27 11:52:09'),
(25, '', 5.00, 7.50, 19.00, 20.00, '2024-05-28 10:38:39'),
(26, 'dasuni', 8.00, 10.00, 19.00, 20.00, '2024-07-18 09:54:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `client_schedule`
--
ALTER TABLE `client_schedule`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `client_schedule`
--
ALTER TABLE `client_schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
