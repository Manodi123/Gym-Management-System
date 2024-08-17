-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 21, 2024 at 05:31 AM
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
-- Table structure for table `to_do_lists`
--

CREATE TABLE `to_do_lists` (
  `id` int(11) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `trainer_email` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `to_do_lists`
--

INSERT INTO `to_do_lists` (`id`, `user_email`, `trainer_email`, `created_at`, `updated_at`) VALUES
(2, 'harshalakshitha123456@gmail.com', 'harshalakshitha123456@gmail.com', '2024-07-21 03:01:59', '2024-07-21 03:01:59'),
(4, 'test1@gmai.com', 'harshalakshitha123456@gmail.com', '2024-07-21 03:12:40', '2024-07-21 03:12:40'),
(5, 'harshalakshitha123456@gmail.com', 'harshalakshitha123456@gmail.com', '2024-07-21 03:18:13', '2024-07-21 03:18:13'),
(6, 'test1@gmai.com', 'harshalakshitha123456@gmail.com', '2024-07-21 03:21:13', '2024-07-21 03:21:13'),
(7, 'harshalakshitha123456@gmail.com', 'harshalakshitha123456@gmail.com', '2024-07-21 03:25:32', '2024-07-21 03:25:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `to_do_lists`
--
ALTER TABLE `to_do_lists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_email` (`user_email`),
  ADD KEY `trainer_email` (`trainer_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `to_do_lists`
--
ALTER TABLE `to_do_lists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `to_do_lists`
--
ALTER TABLE `to_do_lists`
  ADD CONSTRAINT `to_do_lists_ibfk_1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `to_do_lists_ibfk_2` FOREIGN KEY (`trainer_email`) REFERENCES `trainers` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
