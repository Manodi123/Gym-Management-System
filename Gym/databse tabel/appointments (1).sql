-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 22, 2024 at 08:42 PM
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
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `appointment_id` int(11) NOT NULL,
  `user_id` varchar(10) NOT NULL,
  `trainer_id` int(11) NOT NULL,
  `appointment_date` datetime NOT NULL,
  `message` text NOT NULL,
  `status` enum('pending','accepted','rejected') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`appointment_id`, `user_id`, `trainer_id`, `appointment_date`, `message`, `status`) VALUES
(34, '0', 19, '2024-07-26 16:11:00', 'Meal plan', 'rejected'),
(35, '663E47', 19, '2024-07-26 16:30:00', 'workout plan', 'rejected'),
(36, 'X79YVO', 19, '2024-07-30 16:32:00', 'scheduling', 'rejected'),
(37, 'X79YVO', 19, '2024-07-31 16:44:00', 'kkk', 'rejected'),
(38, 'X79YVO', 19, '2024-07-27 17:23:00', 'Meal plan', 'rejected'),
(39, 'X79YVO', 19, '2024-07-31 17:23:00', 'Meal plan', 'rejected'),
(40, 'X79YVO', 19, '2024-07-31 17:23:00', 'Meal plan', 'rejected'),
(41, 'X79YVO', 19, '2024-07-31 17:23:00', 'Meal plan', 'accepted'),
(42, '663E47', 19, '2024-07-10 18:16:00', 'hhh', 'accepted'),
(43, '663E47', 19, '2024-07-10 18:16:00', 'hhh', 'rejected'),
(44, '663E47', 19, '2024-07-10 18:16:00', 'hhh', 'rejected'),
(45, '663E47', 19, '2024-07-22 22:27:00', 'lll', 'rejected'),
(46, '663E47', 19, '2024-07-13 22:27:00', 'lll', 'accepted'),
(47, 'X79YVO', 19, '2024-07-17 22:29:00', 'lll', 'accepted'),
(48, 'X79YVO', 19, '2024-07-17 22:29:00', 'jj', 'accepted'),
(49, 'X79YVO', 19, '2024-07-17 22:29:00', 'jj', 'accepted'),
(50, 'X79YVO', 19, '2024-07-17 22:29:00', 'jj', 'accepted'),
(51, 'X79YVO', 19, '2024-07-17 22:29:00', 'jj', 'accepted'),
(53, 'X79YVO', 19, '2024-07-17 22:29:00', 'jj', 'accepted'),
(54, '663E47', 19, '2024-08-02 23:45:00', 'lll', 'accepted'),
(55, '663E47', 19, '2024-08-02 23:45:00', 'lll', ''),
(56, '663E47', 19, '2024-08-02 23:45:00', 'lll', ''),
(57, '663E47', 19, '2024-08-02 23:45:00', 'lll', ''),
(58, '663E47', 19, '2024-08-02 23:45:00', 'lll', ''),
(59, '663E47', 19, '2024-08-02 23:45:00', 'lll', ''),
(60, '663E47', 19, '2024-08-02 23:45:00', 'lll', 'pending'),
(61, '663E47', 19, '2024-08-02 23:45:00', 'lll', 'pending'),
(62, '663E47', 19, '2024-08-02 23:45:00', 'lll', 'pending'),
(63, '663E47', 19, '2024-07-16 00:02:00', 'jj', ''),
(64, '663E47', 3, '2024-07-03 00:03:00', 'jj', 'pending'),
(65, '663E47', 5, '2024-07-03 00:03:00', 'people', 'pending');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`appointment_id`),
  ADD KEY `user_id_index` (`user_id`),
  ADD KEY `trainer_id_index` (`trainer_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
