CREATE TABLE `body_fat_progress` (
  `id` int(11) NOT NULL,
  `user_email` varchar(255) DEFAULT NULL,
  `date` date NOT NULL,
  `body_fat_percentage` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `body_fat_progress`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_email` (`user_email`);

ALTER TABLE `body_fat_progress`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

ALTER TABLE `body_fat_progress`
  ADD CONSTRAINT `body_fat_progress_ibfk_1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`);

INSERT INTO `body_fat_progress` (`id`, `user_email`, `date`, `body_fat_percentage`) VALUES
(1, 'harsha@teset.com', '2024-01-01', 40.00),
(2, 'harsha@teset.com', '2024-02-01', 35.00),
(3, 'harsha@teset.com', '2024-03-01', 30.00),
(4, 'harshalakshitha123456@gmail.com', '2024-01-01', 50.00),
(5, 'harshalakshitha123456@gmail.com', '2024-02-01', 40.00),
(6, 'harshalakshitha123456@gmail.com', '2024-03-22', 30.00);
