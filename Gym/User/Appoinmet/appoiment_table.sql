CREATE TABLE `appointments` (
  `appointment_id` int(11) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `trainer_email` varchar(255) NOT NULL,
  `appointment_date` datetime NOT NULL,
  `message` text NOT NULL,
  `status` enum('pending','accepted','rejected') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `appointments`
  ADD PRIMARY KEY (`appointment_id`),
  ADD KEY `user_email_index` (`user_email`),
  ADD KEY `trainer_email_index` (`trainer_email`);

ALTER TABLE `appointments`
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;
