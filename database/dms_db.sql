-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 07, 2022 at 09:32 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `dms_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_list`
--

CREATE TABLE `account_list` (
  `id` int(30) NOT NULL,
  `code` varchar(100) NOT NULL,
  `student_id` int(30) NOT NULL,
  `room_id` int(30) NOT NULL,
  `rate` float(12,2) NOT NULL DEFAULT 0.00,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account_list`
--

INSERT INTO `account_list` (`id`, `code`, `student_id`, `room_id`, `rate`, `status`, `delete_flag`, `date_created`, `date_updated`) VALUES
(1, '202205070001', 1, 5, 5000.00, 1, 0, '2022-05-07 13:46:00', '2022-05-07 13:46:00'),
(2, '202205070002', 2, 3, 3500.00, 1, 0, '2022-05-07 14:58:55', '2022-05-07 14:58:55');

-- --------------------------------------------------------

--
-- Table structure for table `dorm_list`
--

CREATE TABLE `dorm_list` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dorm_list`
--

INSERT INTO `dorm_list` (`id`, `name`, `status`, `delete_flag`, `date_created`, `date_updated`) VALUES
(1, 'Male Dorm 1', 1, 0, '2022-05-07 10:07:55', '2022-05-07 10:08:04'),
(2, 'Female Dorm 1', 1, 0, '2022-05-07 10:08:15', '2022-05-07 10:08:15'),
(3, 'Male Dorm 2', 1, 0, '2022-05-07 10:08:32', '2022-05-07 10:08:32'),
(4, 'Female Dorm 2', 1, 0, '2022-05-07 10:08:41', '2022-05-07 10:08:41'),
(5, 'Male Dorm 101', 0, 0, '2022-05-07 10:09:45', '2022-05-07 10:09:45');

-- --------------------------------------------------------

--
-- Table structure for table `payment_list`
--

CREATE TABLE `payment_list` (
  `id` int(30) NOT NULL,
  `account_id` int(30) NOT NULL,
  `month_of` varchar(10) NOT NULL,
  `amount` float(12,2) NOT NULL DEFAULT 0.00,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment_list`
--

INSERT INTO `payment_list` (`id`, `account_id`, `month_of`, `amount`, `date_created`, `date_updated`) VALUES
(3, 1, '2022-04', 5000.00, '2022-05-07 14:55:37', '2022-05-07 14:55:37'),
(4, 1, '2022-05', 5000.00, '2022-05-07 14:58:27', '2022-05-07 15:10:56'),
(5, 2, '2022-05', 3500.00, '2022-05-07 14:59:04', '2022-05-07 14:59:04');

-- --------------------------------------------------------

--
-- Table structure for table `room_list`
--

CREATE TABLE `room_list` (
  `id` int(30) NOT NULL,
  `dorm_id` int(30) NOT NULL,
  `name` text NOT NULL,
  `slots` int(10) NOT NULL DEFAULT 0,
  `price` float(12,2) NOT NULL DEFAULT 0.00,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `room_list`
--

INSERT INTO `room_list` (`id`, `dorm_id`, `name`, `slots`, `price`, `status`, `delete_flag`, `date_created`, `date_updated`) VALUES
(1, 1, 'Room 101', 4, 3500.00, 1, 0, '2022-05-07 10:35:39', '2022-05-07 10:35:39'),
(2, 1, 'Room 102', 4, 3500.00, 1, 0, '2022-05-07 10:35:53', '2022-05-07 10:35:53'),
(3, 2, 'Room 101', 4, 3500.00, 1, 0, '2022-05-07 10:36:08', '2022-05-07 10:36:08'),
(4, 2, 'Room 102', 4, 3500.00, 1, 0, '2022-05-07 10:36:19', '2022-05-07 10:36:19'),
(5, 3, 'Room 101', 2, 5000.00, 1, 0, '2022-05-07 10:36:34', '2022-05-07 10:36:34'),
(6, 4, 'Room 101', 2, 5000.00, 1, 0, '2022-05-07 10:36:43', '2022-05-07 10:36:43'),
(7, 2, 'Room 103', 6, 1000.00, 0, 0, '2022-05-07 10:37:20', '2022-05-07 10:37:20');

-- --------------------------------------------------------

--
-- Table structure for table `student_list`
--

CREATE TABLE `student_list` (
  `id` int(30) NOT NULL,
  `code` varchar(100) NOT NULL,
  `firstname` text NOT NULL,
  `middlename` text DEFAULT NULL,
  `lastname` text NOT NULL,
  `department` text NOT NULL,
  `course` text NOT NULL,
  `gender` varchar(20) NOT NULL,
  `contact` text NOT NULL,
  `email` text NOT NULL,
  `address` text NOT NULL,
  `emergency_name` text NOT NULL,
  `emergency_contact` text NOT NULL,
  `emergency_address` text NOT NULL,
  `emergency_relation` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_list`
--

INSERT INTO `student_list` (`id`, `code`, `firstname`, `middlename`, `lastname`, `department`, `course`, `gender`, `contact`, `email`, `address`, `emergency_name`, `emergency_contact`, `emergency_address`, `emergency_relation`, `status`, `delete_flag`, `date_created`, `date_updated`) VALUES
(1, '6231415', 'Mark', 'D', 'Cooper', 'College of Engineering', 'Bachelor of Science in Computer  Science', 'Male', '09123456789', 'mcooper@gmail.com', '23 St, Here City, Over There Province,  2306', 'Kevin Cooper', '09654789123', '23 St, Here City, Over There Province,  2306', 'Father', 1, 0, '2022-05-07 11:12:38', '2022-05-07 11:12:38'),
(2, '101497', 'Claire', 'C', 'Blake', 'College of Social Science', 'Bachelor of Science in Psychology', 'Female', '09654789123', 'cblake@gmail.com', '15 St., There City, Anywhere Province, 1014', 'Cynthia Blake', '09123456987', '15 St., There City, Anywhere Province, 1014', 'Mother', 1, 0, '2022-05-07 11:17:22', '2022-05-07 11:17:22');

-- --------------------------------------------------------

--
-- Table structure for table `system_info`
--

CREATE TABLE `system_info` (
  `id` int(30) NOT NULL,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `system_info`
--

INSERT INTO `system_info` (`id`, `meta_field`, `meta_value`) VALUES
(1, 'name', 'School Dormitory Management System'),
(6, 'short_name', 'DMS - PHP'),
(11, 'logo', 'uploads/logo.png?v=1651888584'),
(13, 'user_avatar', 'uploads/user_avatar.jpg'),
(14, 'cover', 'uploads/cover.png?v=1651888585');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(50) NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `middlename` text DEFAULT NULL,
  `lastname` varchar(250) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `avatar` text DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 0,
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `middlename`, `lastname`, `username`, `password`, `avatar`, `last_login`, `type`, `date_added`, `date_updated`) VALUES
(1, 'Adminstrator', NULL, 'Admin', 'admin', '0192023a7bbd73250516f069df18b500', 'uploads/avatars/1.png?v=1649834664', NULL, 1, '2021-01-20 14:02:37', '2022-04-13 15:24:24'),
(5, 'Mike', 'C', 'Williamns', 'mwilliams', 'a88df23ac492e6e2782df6586a0c645f', 'uploads/avatars/5.png?v=1651908504', NULL, 2, '2022-05-07 15:28:24', '2022-05-07 15:28:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_list`
--
ALTER TABLE `account_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `room_id` (`room_id`);

--
-- Indexes for table `dorm_list`
--
ALTER TABLE `dorm_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_list`
--
ALTER TABLE `payment_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `account_id` (`account_id`);

--
-- Indexes for table `room_list`
--
ALTER TABLE `room_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dorm_id` (`dorm_id`);

--
-- Indexes for table `student_list`
--
ALTER TABLE `student_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_info`
--
ALTER TABLE `system_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_list`
--
ALTER TABLE `account_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `dorm_list`
--
ALTER TABLE `dorm_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `payment_list`
--
ALTER TABLE `payment_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `room_list`
--
ALTER TABLE `room_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `student_list`
--
ALTER TABLE `student_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `system_info`
--
ALTER TABLE `system_info`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `account_list`
--
ALTER TABLE `account_list`
  ADD CONSTRAINT `room_id_fk_al` FOREIGN KEY (`room_id`) REFERENCES `room_list` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `student_id_fk_al` FOREIGN KEY (`student_id`) REFERENCES `student_list` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `payment_list`
--
ALTER TABLE `payment_list`
  ADD CONSTRAINT `account_id_fk_pl` FOREIGN KEY (`account_id`) REFERENCES `account_list` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `room_list`
--
ALTER TABLE `room_list`
  ADD CONSTRAINT `drom_id_fk_rl` FOREIGN KEY (`dorm_id`) REFERENCES `dorm_list` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;
