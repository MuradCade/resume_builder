-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 03, 2025 at 08:24 PM
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
-- Database: `cvbuilder`
--

-- --------------------------------------------------------

--
-- Table structure for table `cv`
--

CREATE TABLE `cv` (
  `id` bigint(20) NOT NULL,
  `userid` bigint(20) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `title` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cv`
--

INSERT INTO `cv` (`id`, `userid`, `created_date`, `title`) VALUES
(22, 77147003, '2025-02-02 18:56:36', 'my cv');

-- --------------------------------------------------------

--
-- Table structure for table `education`
--

CREATE TABLE `education` (
  `id` bigint(20) NOT NULL,
  `cv_id` bigint(20) DEFAULT NULL,
  `edutitle` text NOT NULL,
  `uniname` text NOT NULL,
  `startdate` date NOT NULL,
  `end_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `education`
--

INSERT INTO `education` (`id`, `cv_id`, `edutitle`, `uniname`, `startdate`, `end_date`) VALUES
(18, 22, 'Computer Science', 'Harvad University', '2025-02-02', '2025-02-02'),
(19, 22, 'Computer Engineering', 'MIT University', '2025-02-18', '2025-02-02');

-- --------------------------------------------------------

--
-- Table structure for table `email_confirm`
--

CREATE TABLE `email_confirm` (
  `id` int(4) NOT NULL,
  `userid` int(10) NOT NULL,
  `verification_code` text DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `verified` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `email_confirm`
--

INSERT INTO `email_confirm` (`id`, `userid`, `verification_code`, `created_date`, `verified`) VALUES
(11, 77147003, 'yLZgPjjsb*', '2025-01-24 14:31:57', 1);

-- --------------------------------------------------------

--
-- Table structure for table `experience`
--

CREATE TABLE `experience` (
  `id` bigint(20) NOT NULL,
  `cv_id` bigint(20) DEFAULT NULL,
  `jobname` text NOT NULL,
  `company_name` text NOT NULL,
  `descriptions` text DEFAULT NULL,
  `startdate` date NOT NULL,
  `end_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `experience`
--

INSERT INTO `experience` (`id`, `cv_id`, `jobname`, `company_name`, `descriptions`, `startdate`, `end_date`) VALUES
(9, 22, 'Software Engineer Intern', 'Massachusetts Institute of Technology (MIT)', 'Developed an AI-driven automation system that improved research data processing speed by 45%. Led a small team in designing a machine learning model for predictive analytics, enhancing project efficiency. Contributed to the development of secure data transmission protocols for research applications.', '2025-02-02', '2025-02-02'),
(10, 22, 'Research Assistant - Computer Vision', 'Harvard University', 'Designed an image recognition model for medical applications, improving diagnostic accuracy by 30%. Implemented optimized neural network architectures to accelerate processing time for large datasets. Worked closely with faculty to integrate AI solutions into ongoing research studies.', '2025-02-02', '2025-02-02');

-- --------------------------------------------------------

--
-- Table structure for table `forget_pwd`
--

CREATE TABLE `forget_pwd` (
  `id` int(11) NOT NULL,
  `email` text NOT NULL,
  `code` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `verified` varchar(50) NOT NULL DEFAULT 'true'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `forget_pwd`
--

INSERT INTO `forget_pwd` (`id`, `email`, `code`, `date`, `verified`) VALUES
(5, 'tayotechcompany@gmail.com', '7vSA)', '2025-02-03 19:03:16', 'false'),
(6, 'tayotechcompany@gmail.com', 'FrEd6', '2025-02-03 19:06:35', 'false'),
(7, 'tayotechcompany@gmail.com', 'i&gUg', '2025-02-03 19:14:00', 'true');

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` bigint(20) NOT NULL,
  `cv_id` bigint(20) DEFAULT NULL,
  `language` text NOT NULL,
  `experience_level` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `cv_id`, `language`, `experience_level`) VALUES
(11, 22, 'Somali', 'native'),
(12, 22, 'English', 'native');

-- --------------------------------------------------------

--
-- Table structure for table `personal_info`
--

CREATE TABLE `personal_info` (
  `id` bigint(20) NOT NULL,
  `cv_id` bigint(20) DEFAULT NULL,
  `fullname` text NOT NULL,
  `email` text NOT NULL,
  `phone_number` text NOT NULL,
  `address` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `personal_info`
--

INSERT INTO `personal_info` (`id`, `cv_id`, `fullname`, `email`, `phone_number`, `address`) VALUES
(18, 22, 'John Abdikarim Doe', 'info@etechonlineacademy.com', '0634545454545', 'Banadir , Somalia');

-- --------------------------------------------------------

--
-- Table structure for table `qualities`
--

CREATE TABLE `qualities` (
  `id` bigint(20) NOT NULL,
  `cv_id` bigint(20) DEFAULT NULL,
  `qualityname` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `qualities`
--

INSERT INTO `qualities` (`id`, `cv_id`, `qualityname`) VALUES
(11, 22, 'Problem-Solver'),
(12, 22, 'Quick Learner'),
(13, 22, 'Adaptable'),
(14, 22, 'Detail-Oriented');

-- --------------------------------------------------------

--
-- Table structure for table `reference`
--

CREATE TABLE `reference` (
  `id` bigint(20) NOT NULL,
  `cv_id` bigint(20) DEFAULT NULL,
  `refname` text NOT NULL,
  `refrole` text NOT NULL,
  `refphone` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reference`
--

INSERT INTO `reference` (`id`, `cv_id`, `refname`, `refrole`, `refphone`) VALUES
(7, 22, 'John Doe', 'Software Engineer', '(555) 123-4567'),
(8, 22, 'Jane Smith', 'ABC Technologies', '(555) 987-6543');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `userid` bigint(20) NOT NULL,
  `username` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `userid`, `username`, `email`, `password`) VALUES
(11, 77147003, 'Murad Cade', 'tayotechcompany@gmail.com', '$2y$10$UW86n5Jvps0/UTnY.TQNzOOTzxXpUhQjPiLN2GPw09y6ygHLVjBx6');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cv`
--
ALTER TABLE `cv`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cv_ibfk_1` (`userid`);

--
-- Indexes for table `education`
--
ALTER TABLE `education`
  ADD PRIMARY KEY (`id`),
  ADD KEY `education_ibfk_1` (`cv_id`);

--
-- Indexes for table `email_confirm`
--
ALTER TABLE `email_confirm`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `experience`
--
ALTER TABLE `experience`
  ADD PRIMARY KEY (`id`),
  ADD KEY `experience_ibfk_1` (`cv_id`);

--
-- Indexes for table `forget_pwd`
--
ALTER TABLE `forget_pwd`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `languages_ibfk_1` (`cv_id`);

--
-- Indexes for table `personal_info`
--
ALTER TABLE `personal_info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `personal_info_ibfk_1` (`cv_id`);

--
-- Indexes for table `qualities`
--
ALTER TABLE `qualities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `qualities_ibfk_1` (`cv_id`);

--
-- Indexes for table `reference`
--
ALTER TABLE `reference`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reference_ibfk_1` (`cv_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `userid` (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cv`
--
ALTER TABLE `cv`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `education`
--
ALTER TABLE `education`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `email_confirm`
--
ALTER TABLE `email_confirm`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `experience`
--
ALTER TABLE `experience`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `forget_pwd`
--
ALTER TABLE `forget_pwd`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `personal_info`
--
ALTER TABLE `personal_info`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `qualities`
--
ALTER TABLE `qualities`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `reference`
--
ALTER TABLE `reference`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cv`
--
ALTER TABLE `cv`
  ADD CONSTRAINT `cv_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `education`
--
ALTER TABLE `education`
  ADD CONSTRAINT `education_ibfk_1` FOREIGN KEY (`cv_id`) REFERENCES `cv` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `experience`
--
ALTER TABLE `experience`
  ADD CONSTRAINT `experience_ibfk_1` FOREIGN KEY (`cv_id`) REFERENCES `cv` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `languages`
--
ALTER TABLE `languages`
  ADD CONSTRAINT `languages_ibfk_1` FOREIGN KEY (`cv_id`) REFERENCES `cv` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `personal_info`
--
ALTER TABLE `personal_info`
  ADD CONSTRAINT `personal_info_ibfk_1` FOREIGN KEY (`cv_id`) REFERENCES `cv` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `qualities`
--
ALTER TABLE `qualities`
  ADD CONSTRAINT `qualities_ibfk_1` FOREIGN KEY (`cv_id`) REFERENCES `cv` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reference`
--
ALTER TABLE `reference`
  ADD CONSTRAINT `reference_ibfk_1` FOREIGN KEY (`cv_id`) REFERENCES `cv` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
