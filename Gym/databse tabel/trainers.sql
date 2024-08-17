-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 28, 2024 at 04:09 PM
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
-- Table structure for table `trainers`
--

CREATE TABLE `trainers` (
  `Name` varchar(255) NOT NULL,
  `ID` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` int(12) NOT NULL,
  `experience` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trainers`
--

INSERT INTO `trainers` (`Name`, `ID`, `email`, `phone`, `experience`, `password`, `image_path`) VALUES
('', '', '', 0, 'pexels-photo-6749777.jpeg', '202cb962ac59075b964b07152d234b70', NULL),
('', '', 'gayan@gym.com', 223652115, '2 years', '202cb962ac59075b964b07152d234b70', NULL),
('', '', 'gygukgyuguk@fghhg.lk', 1223565, '5', '7f6ffaa6bb0b408017b62254211691b5', NULL),
('Harsha Lakshitha', 'T002', 'harshalakshitha123456@gmail.com', 787411299, '5 years', 'caf1a3dfb505ffed0d024130f58c5cfa', NULL),
('Harsha Lakshitha', 'T001', 'hu@gmail.com', 787411299, '169 years', '202cb962ac59075b964b07152d234b70', NULL),
('', 'u8856', 'hukn@der.lk', 715969386, '6', 'caf1a3dfb505ffed0d024130f58c5cfa', NULL),
('', '', 'hykanja@gnau.lk', 1123569511, '5 years', '202cb962ac59075b964b07152d234b70', NULL),
('Harsha Lakshitha', 'T001', 'just@test.com', 787411299, '5 years', '202cb962ac59075b964b07152d234b70', NULL),
('', '', 'sakepuna@gmail.com', 0, '', '202cb962ac59075b964b07152d234b70', NULL),
('', 'T001', 'sunny@gym.com', 112365985, '9 years', '202cb962ac59075b964b07152d234b70', NULL),
('', 'T001', 'sunny@leon.com', 787411299, '3 years', '202cb962ac59075b964b07152d234b70', NULL),
('vinod', '321', 'test@21.com', 787411299, '5 years', '202cb962ac59075b964b07152d234b70', NULL),
('', '', 'test@tesCt.lk', 787411299, 'pexels-photo-6749777.jpeg', '202cb962ac59075b964b07152d234b70', NULL),
('', '', 'test@test.lk', 787411299, 'pexels-photo-6749777.jpeg', '202cb962ac59075b964b07152d234b70', NULL),
('', '', 'test@test2.lk', 0, '6 years', '202cb962ac59075b964b07152d234b70', NULL),
('', '', 'test@test21.ocm', 0, '', '202cb962ac59075b964b07152d234b70', NULL),
('', '', 'test@tst2.lk', 0, '6 years', 'a0a080f42e6f13b3a2df133f073095dd', NULL),
('Harsha Lakshitha', 'T001', 'trainer@gmail.com', 787411299, '5 years', 'caf1a3dfb505ffed0d024130f58c5cfa', NULL),
('Harsha Lakshitha', 'T001', 'tst@gh.com', 787411299, '5 years', '202cb962ac59075b964b07152d234b70', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `trainers`
--
ALTER TABLE `trainers`
  ADD PRIMARY KEY (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
