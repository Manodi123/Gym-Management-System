CREATE TABLE `muscle_gain_progress` (
  `id` int(11) NOT NULL,
  `user_email` varchar(255) DEFAULT NULL,
  `date` date NOT NULL,
  `muscle_mass` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `muscle_gain_progress`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_email` (`user_email`);

ALTER TABLE `muscle_gain_progress`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

ALTER TABLE `muscle_gain_progress`
  ADD CONSTRAINT `muscle_gain_progress_ibfk_1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`);

INSERT INTO `muscle_gain_progress` (`id`, `user_email`, `date`, `muscle_mass`) VALUES
(1, 'harsha@teset.com', '2024-01-01', 20.00),
(2, 'harsha@teset.com', '2024-02-01', 30.00),
(3, 'harsha@teset.com', '2024-03-01', 50.00),
(4, 'harshalakshitha123456@gmail.com', '2024-01-01', 40.00),
(5, 'harshalakshitha123456@gmail.com', '2024-02-01', 60.00),
(6, 'harshalakshitha123456@gmail.com', '2024-03-22', 70.00);
