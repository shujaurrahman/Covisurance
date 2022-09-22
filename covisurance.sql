-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 22, 2022 at 03:17 PM
-- Server version: 5.7.33
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `covisurance`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `s_no` int(100) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `category` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`s_no`, `username`, `password`, `name`, `category`) VALUES
(60, 'AdminShuja', '$2y$10$FpUmyKkdnCbHzsaD8ziB2unIQVRpkzphOOj8N.PdFr29zMwgOkuvG', 'Shuja ur Rahman', 'Super Admin');

-- --------------------------------------------------------

--
-- Table structure for table `alluser`
--

CREATE TABLE `alluser` (
  `s_no` int(100) NOT NULL,
  `first_name` varchar(10) DEFAULT NULL,
  `last_name` varchar(10) DEFAULT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `birthday` varchar(30) DEFAULT NULL,
  `phonenumber` varchar(100) DEFAULT NULL,
  `password` text,
  `pancard` varchar(20) DEFAULT NULL,
  `annual_income` varchar(100) DEFAULT NULL,
  `_address` varchar(100) DEFAULT NULL,
  `city` varchar(10) DEFAULT NULL,
  `country` varchar(10) DEFAULT NULL,
  `_image` text,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `code` int(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `appliedpolicy`
--

CREATE TABLE `appliedpolicy` (
  `id` int(100) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(110) NOT NULL,
  `gender` varchar(110) NOT NULL,
  `f_name` varchar(110) NOT NULL,
  `m_name` varchar(110) NOT NULL,
  `dob` varchar(110) NOT NULL,
  `email` varchar(110) NOT NULL,
  `address` varchar(110) NOT NULL,
  `p_name` varchar(110) NOT NULL,
  `p_cat` varchar(110) NOT NULL,
  `p_premium` int(110) NOT NULL,
  `p_coverage` varchar(110) NOT NULL,
  `pancard` varchar(110) NOT NULL,
  `phone` varchar(110) NOT NULL,
  `pan_image` text NOT NULL,
  `aadhar_image` text NOT NULL,
  `medical_image` text NOT NULL,
  `pass_image` text NOT NULL,
  `unique_id` varchar(110) NOT NULL,
  `username` varchar(50) NOT NULL,
  `action` int(10) DEFAULT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `contactus`
--

CREATE TABLE `contactus` (
  `s_no` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `message` varchar(300) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `msg_id` int(11) NOT NULL,
  `incoming_msg_id` int(255) NOT NULL,
  `outgoing_msg_id` int(255) NOT NULL,
  `msg` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `notify`
--

CREATE TABLE `notify` (
  `id` int(255) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `account_created` int(255) DEFAULT NULL,
  `email_verified` int(255) DEFAULT NULL,
  `signed_in` int(255) DEFAULT NULL,
  `password_reset` int(255) DEFAULT NULL,
  `update_info` int(255) DEFAULT NULL,
  `profile_pic` int(255) DEFAULT NULL,
  `policy_app` int(255) DEFAULT NULL,
  `policy_claimed` int(255) DEFAULT NULL,
  `admin_review` int(255) DEFAULT NULL,
  `approved` int(255) DEFAULT NULL,
  `disapproved` int(255) DEFAULT NULL,
  `download_pdf` int(255) DEFAULT NULL,
  `question` int(255) DEFAULT NULL,
  `logout` int(255) DEFAULT NULL,
  `payment_success` int(255) DEFAULT NULL,
  `pdf` int(255) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `pass_activity` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(255) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `paid` int(255) DEFAULT NULL,
  `unique_id` int(255) DEFAULT NULL,
  `id_pol` int(255) DEFAULT NULL,
  `next_date` date DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `policycards`
--

CREATE TABLE `policycards` (
  `id` int(255) NOT NULL,
  `policycat` varchar(100) NOT NULL,
  `policyname` varchar(100) NOT NULL,
  `policydetails` varchar(200) NOT NULL,
  `policypremium` varchar(100) NOT NULL,
  `policycoverage` varchar(100) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `policycards`
--

INSERT INTO `policycards` (`id`, `policycat`, `policyname`, `policydetails`, `policypremium`, `policycoverage`, `date`) VALUES
(27, 'Diamond', 'COVID-19 XYZ', 'adasd', 'asdsad', 'asdasd', '2022-03-15 21:27:25'),
(29, 'Diamond', 'COVID-19 G', 'Death Guranttee', '7000', '800000', '2022-03-16 16:02:52');

-- --------------------------------------------------------

--
-- Table structure for table `testimonial`
--

CREATE TABLE `testimonial` (
  `s_no` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `name` varchar(15) NOT NULL,
  `place` varchar(15) NOT NULL,
  `message` varchar(200) NOT NULL,
  `rate` int(20) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `testimonial`
--

INSERT INTO `testimonial` (`s_no`, `username`, `name`, `place`, `message`, `rate`, `date`) VALUES
(7, 'Anonymous,Not registered with ', 'Faheem', 'Aligarh', '                    I was facing some problem while purchasing policy. I\r\n                    approached the customer service of Covisurance and I\r\n                    explained my problem to the exec', 5, '2022-03-12 13:49:54'),
(8, 'Anonymous,Not registered with ', 'Sabeela', 'Pilibhit', '                    I compared many plans on different-different platforms but\r\n                    did not get what I was looking for. Then I landed on\r\n                    Covisurance website and th', 3, '2022-03-12 13:50:57'),
(9, 'Anonymous,Not registered with ', 'Aqsa', 'Delhi', '                    I got protection against medical bills as i bought\r\n                    Mediclaim policy from Covisurance. it was very cost\r\n                    effective and i got lifelong renewa', 2, '2022-03-12 13:51:29'),
(10, 'Anonymous,Not registered with ', 'Shuja Ur Rahman', 'PILIBHIT', 'Shuja ur Rahman Rating test if it works or not lets see \r\nfinger crossed', 3, '2022-03-12 14:07:44'),
(11, 'Shujarrahman', 'Shuja Ur Rahman', 'PILIBHIT', 'Beautiful website you have done a great job ....', 4, '2022-03-12 22:32:56'),
(12, 'mohtarif', 'Mohtarif', 'PILIBHIT', 'Behtar se behtareen ki taraf rama dama har zarurat waqt ke takaze ko poora karne ki or agrsarit website ', 4, '2022-03-13 14:14:52');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `unique_id` int(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `img` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `visitors`
--

CREATE TABLE `visitors` (
  `id` int(255) NOT NULL,
  `browser` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ip` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `county` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `region` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `latitude` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `longitude` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `time` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `count` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`s_no`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `alluser`
--
ALTER TABLE `alluser`
  ADD PRIMARY KEY (`s_no`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `appliedpolicy`
--
ALTER TABLE `appliedpolicy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contactus`
--
ALTER TABLE `contactus`
  ADD PRIMARY KEY (`s_no`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`msg_id`);

--
-- Indexes for table `notify`
--
ALTER TABLE `notify`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `policycards`
--
ALTER TABLE `policycards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonial`
--
ALTER TABLE `testimonial`
  ADD PRIMARY KEY (`s_no`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `visitors`
--
ALTER TABLE `visitors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ip` (`ip`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `s_no` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `alluser`
--
ALTER TABLE `alluser`
  MODIFY `s_no` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `appliedpolicy`
--
ALTER TABLE `appliedpolicy`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contactus`
--
ALTER TABLE `contactus`
  MODIFY `s_no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notify`
--
ALTER TABLE `notify`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `policycards`
--
ALTER TABLE `policycards`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `testimonial`
--
ALTER TABLE `testimonial`
  MODIFY `s_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `visitors`
--
ALTER TABLE `visitors`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
