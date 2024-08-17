-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 21, 2024 at 05:35 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gym_management_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `to_do_requests`
--

CREATE TABLE `to_do_requests` (
  `id` int(11) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `status` enum('Pending','Completed') DEFAULT 'Pending',
  `request_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `to_do_requests`
--

INSERT INTO `to_do_requests` (`id`, `user_email`, `status`, `request_date`) VALUES
(1, 'harshalakshitha123456@gmail.com', 'Completed', '2024-07-19 06:24:45'),
(2, 'harshalakshitha123456@gmail.com', 'Completed', '2024-07-19 15:08:46'),
(3, 'harshalakshitha123456@gmail.com', 'Completed', '2024-07-20 04:16:58'),
(4, 'test1@gmai.com', 'Completed', '2024-07-21 03:11:47'),
(5, 'test1@gmai.com', 'Completed', '2024-07-21 03:14:59'),
(6, 'harshalakshitha123456@gmail.com', 'Completed', '2024-07-21 03:17:29'),
(7, 'harshalakshitha123456@gmail.com', 'Completed', '2024-07-21 03:25:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `to_do_requests`
--
ALTER TABLE `to_do_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_email` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `to_do_requests`
--
ALTER TABLE `to_do_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `to_do_requests`
--
ALTER TABLE `to_do_requests`
  ADD CONSTRAINT `to_do_requests_ibfk_1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
