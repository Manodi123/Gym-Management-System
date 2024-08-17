-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 21, 2024 at 05:36 AM
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
-- Table structure for table `to_do_tasks`
--

CREATE TABLE `to_do_tasks` (
  `id` int(11) NOT NULL,
  `todo_list_id` int(11) NOT NULL,
  `task` varchar(255) NOT NULL,
  `deadline` date NOT NULL,
  `priority` enum('Low','Medium','High') DEFAULT 'Medium',
  `status` enum('Pending','Completed') DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `to_do_tasks`
--

INSERT INTO `to_do_tasks` (`id`, `todo_list_id`, `task`, `deadline`, `priority`, `status`) VALUES
(2, 2, 'ane manda ', '2024-07-11', 'Low', 'Pending'),
(4, 4, '1.Push ups 3', '2024-07-17', 'Medium', 'Pending'),
(5, 5, 'hjhhiuhi', '2024-07-15', 'High', 'Pending'),
(6, 6, '1.Push ups 3', '2024-07-30', 'Low', 'Pending'),
(7, 7, '1.Push ups 3', '2024-07-10', 'Low', 'Pending');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `to_do_tasks`
--
ALTER TABLE `to_do_tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `todo_list_id` (`todo_list_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `to_do_tasks`
--
ALTER TABLE `to_do_tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `to_do_tasks`
--
ALTER TABLE `to_do_tasks`
  ADD CONSTRAINT `to_do_tasks_ibfk_1` FOREIGN KEY (`todo_list_id`) REFERENCES `to_do_lists` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
