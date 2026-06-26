-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 24, 2026 at 06:47 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `placement_management_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `drive_id` int(11) NOT NULL,
  `status` enum('Applied','Selected','Rejected') DEFAULT 'Applied',
  `applied_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `applications`
--

INSERT INTO `applications` (`id`, `student_id`, `drive_id`, `status`, `applied_at`) VALUES
(3, 1, 8, 'Applied', '2026-06-11 04:05:58'),
(5, 1, 10, 'Selected', '2026-06-11 04:17:35');

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` int(11) NOT NULL,
  `company_name` varchar(150) NOT NULL,
  `website` varchar(255) DEFAULT NULL,
  `package` decimal(10,2) DEFAULT NULL,
  `location` varchar(150) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `company_name`, `website`, `package`, `location`, `created_at`) VALUES
(1, 'Google', 'www.google.com', 20.00, 'Delhi', '2026-06-10 06:27:53'),
(2, 'Microsoft', 'www.microsoft.com', 15.00, 'Mumbai', '2026-06-10 10:51:46');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `department_name` varchar(100) NOT NULL,
  `department_code` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `department_name`, `department_code`, `created_at`) VALUES
(1, 'Computer Science and Engineering', 'CSE', '2026-06-10 05:55:53');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `is_read` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `student_id`, `title`, `message`, `is_read`, `created_at`) VALUES
(1, 1, 'Application Submitted', 'You have successfully applied for jnef at Google.', 1, '2026-06-10 10:09:48'),
(2, 1, 'Congratulations!', 'You have been selected for jnef at Google.', 1, '2026-06-10 10:12:05'),
(3, 1, 'Application Update', 'Your application for jnef at Google has been rejected.', 1, '2026-06-10 10:13:13'),
(4, 1, 'Congratulations!', 'You have been selected for Software Develpoer at Google.', 1, '2026-06-10 10:13:24'),
(5, 1, 'New Placement Drive', 'Microsoft has opened applications for Data Scientist.', 1, '2026-06-10 10:52:15'),
(6, 1, 'New Placement Drive', 'Microsoft has opened applications for Data Scientist.', 1, '2026-06-10 10:55:14'),
(8, 1, 'New Placement Drive', 'Google has opened applications for xxy.', 1, '2026-06-11 03:48:52'),
(10, 1, 'New Placement Drive', 'Google has opened applications for Software Develpoer.', 1, '2026-06-11 03:55:58'),
(12, 1, 'New Placement Drive', 'Google has opened applications for Software Develpoer.', 1, '2026-06-11 03:56:24'),
(14, 1, 'Application Submitted', 'You have successfully applied for Software Develpoer at Google.', 1, '2026-06-11 04:05:58'),
(15, 1, 'New Placement Drive', 'Microsoft has opened applications for Data Scientist.', 1, '2026-06-11 04:15:11'),
(17, 1, 'New Placement Drive', 'Microsoft has opened applications for Data Scientist.', 1, '2026-06-11 04:15:51'),
(20, 1, 'Application Submitted', 'You have successfully applied for Data Scientist at Microsoft.', 1, '2026-06-11 04:17:35'),
(21, 1, 'Congratulations!', 'You have been selected for Data Scientist at Microsoft.', 1, '2026-06-11 04:19:19');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`id`, `email`, `token`, `created_at`) VALUES
(7, 'student2@gmail.com', 'e1fe5e576cb79b9cab374e9b459bc77b346849be4492e6693864f776e163df6e', '2026-06-11 10:26:29');

-- --------------------------------------------------------

--
-- Table structure for table `placement_drives`
--

CREATE TABLE `placement_drives` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `job_role` varchar(150) NOT NULL,
  `min_cgpa` decimal(3,2) DEFAULT NULL,
  `package_lpa` decimal(5,2) DEFAULT NULL,
  `last_date` date DEFAULT NULL,
  `status` enum('Open','Closed') DEFAULT 'Open',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `drive_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `placement_drives`
--

INSERT INTO `placement_drives` (`id`, `company_id`, `job_role`, `min_cgpa`, `package_lpa`, `last_date`, `status`, `created_at`, `drive_date`) VALUES
(8, 1, 'Software Develpoer', 8.00, 10.00, '2026-06-30', 'Open', '2026-06-11 03:56:24', NULL),
(10, 2, 'Data Scientist', 7.00, 8.00, '2026-06-18', 'Open', '2026-06-11 04:15:51', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `resumes`
--

CREATE TABLE `resumes` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `resume_file` varchar(255) NOT NULL,
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `resumes`
--

INSERT INTO `resumes` (`id`, `student_id`, `resume_file`, `uploaded_at`) VALUES
(1, 1, '1782107182_1782107182_fafc54deb8f0fdedc129.pdf', '2026-06-10 08:53:50');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `roll_no` varchar(50) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `cgpa` decimal(3,2) DEFAULT NULL,
  `backlogs` int(11) DEFAULT 0,
  `passing_year` year(4) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `user_id`, `department_id`, `roll_no`, `phone`, `cgpa`, `backlogs`, `passing_year`, `created_at`) VALUES
(1, 1, 1, '237106008', NULL, NULL, NULL, NULL, '2026-06-10 06:13:16'),
(4, 11, 1, '237106021', '8968391105', 0.00, 0, '2027', '2026-06-12 18:27:29'),
(5, 10, 1, '237106020', '9518137105', 8.95, 0, '2027', '2026-06-12 18:28:36');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','student') NOT NULL DEFAULT 'student',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`) VALUES
(1, 'Dipanshu', 'dipanshu150206@gmail.com', '$2y$10$B5ZKBq5lUBysGySu6/wQpOFuydvZ..ud1KU7gphhgD3SLkUnQ7CzC', 'student', '2026-06-10 04:24:35'),
(3, 'Admin', 'admin@gmail.com', '$2y$10$PJVM/FCVpb34LZbDWMXh..qxnpaf1UBD.PoCBY8CxHRBW.e4AfrMa', 'admin', '2026-06-10 04:39:42'),
(7, 'Deepa', 'deepansh305@gmail.com', '$2y$10$fpLLNt6psjKFH5Q2ZjewXO8N8u6XYe2IDh1RNjz8kMAp5gGANjvl6', 'student', '2026-06-11 08:50:34'),
(10, 'Jasdeep kaur', 'jasdeepj004@gmail.com', '$2y$10$oIPSYcXt83kwpxQ0pCewau8VCQXSTz2OJVML5DGafUP5nM8cOLFIW', 'student', '2026-06-12 18:21:52'),
(11, 'Jashandeep Kaur', 'jashancheema644@gmail.com', '$2y$10$a/OdVepUMKAiopVffddP9udfHK5e5cwkgB5P7ZB6lHn.NshFB3k1S', 'student', '2026-06-12 18:24:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `drive_id` (`drive_id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `department_code` (`department_code`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `placement_drives`
--
ALTER TABLE `placement_drives`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id` (`company_id`);

--
-- Indexes for table `resumes`
--
ALTER TABLE `resumes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roll_no` (`roll_no`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applications`
--
ALTER TABLE `applications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `placement_drives`
--
ALTER TABLE `placement_drives`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `resumes`
--
ALTER TABLE `resumes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `applications`
--
ALTER TABLE `applications`
  ADD CONSTRAINT `applications_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `applications_ibfk_2` FOREIGN KEY (`drive_id`) REFERENCES `placement_drives` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `placement_drives`
--
ALTER TABLE `placement_drives`
  ADD CONSTRAINT `placement_drives_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `resumes`
--
ALTER TABLE `resumes`
  ADD CONSTRAINT `resumes_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `students_ibfk_2` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
