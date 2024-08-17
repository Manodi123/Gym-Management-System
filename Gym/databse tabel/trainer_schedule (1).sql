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
-- Table structure for table `trainer_schedule`
--

CREATE TABLE `trainer_schedule` (
  `id` int(11) NOT NULL,
  `trainerName` varchar(255) NOT NULL,
  `dayTimeStart` decimal(4,2) NOT NULL,
  `dayTimeEnd` decimal(4,2) NOT NULL,
  `nightTimeStart` decimal(4,2) NOT NULL,
  `nightTimeEnd` decimal(4,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trainer_schedule`
--

INSERT INTO `trainer_schedule` (`id`, `trainerName`, `dayTimeStart`, `dayTimeEnd`, `nightTimeStart`, `nightTimeEnd`, `created_at`) VALUES
(1, '', 5.00, 7.50, 19.00, 20.00, '2024-05-17 17:59:58'),
(2, '  jone', 6.00, 7.50, 19.00, 20.00, '2024-05-17 18:00:31'),
(3, '', 6.00, 7.50, 19.00, 20.00, '2024-05-17 18:15:36'),
(4, 'Manodi', 6.00, 7.50, 19.50, 20.00, '2024-06-04 19:07:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `trainer_schedule`
--
ALTER TABLE `trainer_schedule`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `trainer_schedule`
--
ALTER TABLE `trainer_schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
