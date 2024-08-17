CREATE TABLE `weight_progress` (
  `id` int(11) NOT NULL,
  `user_email` varchar(255) DEFAULT NULL,
  `date` date NOT NULL,
  `weight` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `weight_progress`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_email` (`user_email`);

ALTER TABLE `weight_progress`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

ALTER TABLE `weight_progress`
  ADD CONSTRAINT `weight_progress_ibfk_1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`);

INSERT INTO `weight_progress` (`id`, `user_email`, `date`, `weight`) VALUES
(1, 'harsha@teset.com', '2024-01-01', 90.00),
(2, 'harsha@teset.com', '2024-02-01', 80.00),
(3, 'harsha@teset.com', '2024-03-01', 75.00),
(4, 'harshalakshitha123456@gmail.com', '2024-01-01', 80.00),
(5, 'harshalakshitha123456@gmail.com', '2024-02-01', 75.00),
(6, 'harshalakshitha123456@gmail.com', '2024-03-22', 60.00);
