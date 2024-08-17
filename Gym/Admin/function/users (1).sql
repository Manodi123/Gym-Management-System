-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 14, 2024 at 12:47 PM
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
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` varchar(10) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `weight` varchar(20) NOT NULL,
  `gender` enum('Male','Female','Other') NOT NULL,
  `plan` text NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `registration_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `firstName`, `lastName`, `email`, `phone`, `weight`, `gender`, `plan`, `username`, `password`, `registration_date`) VALUES
('	 663BC1', 'Saranya', 'Vitharana', 'saranya@gmail.com', '0713537600', '45-65', 'Female', 'premium', 'saranya123', '$2y$10$KkdSpnqUtwh0qCXIZvArde1U8CePKzbHVkC.8DIdypnX.t/SW21iC', '2024-06-02 20:00:02'),
('	 663BC7', 'Nimal', 'silva', 'nimal@gmail.com', '0713537500', '45-65', 'Male', 'pemium', 'nimal123', '$2y$10$Nar704hlzi1RBAbUWPK.E.h40Y0LjtwQa.70cvaTjX80w2aUpc6MC', '2024-06-03 08:48:34'),
('663E47', 'Manodi ', 'Vihagana', 'mvofficial345@gmail.com', '0713537400', '65-85', 'Female', '', 'Mano123', '$2y$10$hAlj3Wwc3vKg96dTEh9DxeFyyi6ZlXVKTvsDBcZZ13PUF9nXlw.ni', '2024-05-10 16:12:19'),
('8NDLB', 'Hashini', 'Sandeepani', 'sachi@gmial.com', '0713537700', '65-85', '', 'pro', 'Hashini123', '$2y$10$MlGpzQ3GOmJqE23VpCIyTeuKMvcK9rYtU/5L8iym19b.XLHnKNkHy', '2024-05-10 21:11:14'),
('BWYLH', 'Harsha', 'Lakshitha', 'harsha@gmail.com', '0713537400', '45-65', 'Male', 'Standard', 'harsha123', '$2y$10$rbATD4tacm6y4GKpkGO96eBjaoq4.glMk4mraOiKQ1rC62vDGtVWe', '2024-05-17 10:28:36'),
('FHC7B', 'kamnai', 'vitharab', 'kamani12@gmail.com', '0713537400', '45-65', 'Female', 'Basic', 'kamini123', '$2y$10$y75i1zXf3UqyPWvN9OR9tesTK12EcHk0yUTfqcPaMNx68aSUJM.z6', '2024-06-04 16:30:54'),
('GUB0M', 'Shamasha', 'Ramanayaka', 'shamasharamanayaka123@gmail.com', '0713537800', '65-85', 'Female', 'Basic', 'shama123', '$2y$10$J26TBhiswcwavUTzCut/.eGOpBzFsXKpe4sYnseZL7cd3SeUqbnsm', '2024-06-07 19:50:12'),
('HMPA2', 'kamnai', 'vitharana', 'kamini@gmailcom', '0713537700', '25-45', 'Female', 'Plus', 'kamini12', '$2y$10$QvuQV23uVbmas0s2ccLoROLGjTSWHIMiq3OuOY2Ov4TFbJRggU2yW', '2024-06-07 18:43:51'),
('HPDXI', 'Tilumi', 'Dilshani', 'tilumi@gmail.com', '0713537400', '45-65', 'Female', 'Standard', 'tilu123', '$2y$10$hYkM528f5cw6bJxHE2ne2OxjdA6vK2boMt46Xzq.fkAUaAhBIfpay', '2024-05-29 08:45:58'),
('NKD0K', 'sachini', 'Imasha', 'saman@gmail.com', '0713537800', '65-85', 'Female', 'Standard', 'sachi123', '$2y$10$KJYR.KrRyWSboSo26IALauO0iIdp93nIazG3mP8J2RsM.BXQozbSO', '2024-06-02 18:42:44'),
('P2T2K', 'Pramod', 'Madhushan', 'pramod@gmail.com', '0713537500', '65-85', 'Male', 'Basic', 'pramod123', '$2y$10$cwAYjyVoKh0LJR4n1Gy2JuVmVQlxrGhHEl9Wbinw5As41ibVT.Uwu', '2024-05-17 10:34:42'),
('YRS32S', 'kasuni', 'Sandeepani', 'kasuni@gmail.com', '0713537400', '65-85', 'Female', 'Basic', 'kasuni123', '$2y$10$9OQGjbGe5KVLxCYitDeMQu1Sfq6fadFVXAdDiv47lqV13ZdREYXjO', '2024-06-07 21:27:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
