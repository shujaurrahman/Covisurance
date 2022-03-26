-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 17, 2022 at 12:52 PM
-- Server version: 5.7.33
-- PHP Version: 7.4.19

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
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`s_no`, `username`, `password`, `name`) VALUES
(60, 'Adminshuja', '$2y$10$FpUmyKkdnCbHzsaD8ziB2unIQVRpkzphOOj8N.PdFr29zMwgOkuvG', 'Shuja ur Rahman');

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
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `alluser`
--

INSERT INTO `alluser` (`s_no`, `first_name`, `last_name`, `username`, `email`, `birthday`, `phonenumber`, `password`, `pancard`, `annual_income`, `_address`, `city`, `country`, `_image`, `date`) VALUES
(16, 'Shuja', 'Rahman', 'Shujarrahman', '210@gmail.com', '2022-03-23', '07579966178', '$2y$10$HaZufUUJ7LSnybbOok/Yi.04TeniSuCna3PnQaWP8EdWqX72VomB6', 'EIEPR3194G', '938287834', 'HN0 805 MOHALLAH MOHD WASIL', 'PILIBHIT', 'India', 'Shujarrahman1.JPG', '0000-00-00 00:00:00'),
(17, 'AQSA', 'RAHMAN', 'Aqsa', 'Aqsarahman@gmail.com', '2022-03-18', '7579966178', '$2y$10$ilHD3CumRSZJkpBJqKLc4empOgONG788Q0iY6T4jacwFZXy1qO8Z.', 'EIEPR3194G', '200000', 'A-124 NANDRAM PARK UTTAM NAGAR EAST', 'Delhi', 'India', 'aqsaIMG_4826.JPG', '0000-00-00 00:00:00'),
(18, 'SDSA', 'ASA', 'ASA', 'ASA', 'ASA', 'ASDA', 'ASA', '', '', '', '', '', '', '2022-03-17 01:19:58'),
(19, 'shuja', 'ur Rahman', 'shujaurrahman32673', 'shuja@gmail.com', '20/04/2003', '7579966178', '1234567', NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-17 02:03:16'),
(20, 'AQSA', 'RAHMAN', 'Faheemua', 'fdscsdcman210@gmail.com', '2022-03-19', '07579966178', '$2y$10$A5zN5esSNcbS/HgP4KHdMOnQbFhc3uRt8kzV/QLYdPqBF8qukfN86', 'EIEPR3194G', 'qwdqwdwf', 'A-124 NANDRAM PARK UTTAM NAGAR EAST', 'Delhi', 'India', 'FaheemuaIMG_2940.jpg', '2022-03-17 02:05:02');

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
  `p_premium` varchar(110) NOT NULL,
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

--
-- Dumping data for table `appliedpolicy`
--

INSERT INTO `appliedpolicy` (`id`, `first_name`, `last_name`, `gender`, `f_name`, `m_name`, `dob`, `email`, `address`, `p_name`, `p_cat`, `p_premium`, `p_coverage`, `pancard`, `phone`, `pan_image`, `aadhar_image`, `medical_image`, `pass_image`, `unique_id`, `username`, `action`, `date`) VALUES
(61, 'Shuja', 'Rahman', 'zxcvzd', 'ada', 'sdfs', '2022-03-23', '210@gmail.com', 'HN0 805 MOHALLAH MOHD WASIL  PILIBHIT  India', 'Faheem', 'Premium', 'are kahan ke paise', 'kaise paise', 'EIEPR3194G', '07579966178', 'Shujarrahman1.JPG', 'Shujarrahman2.jpg', 'Shujarrahman3.jpg', 'Shujarrahman4.jpg', '454317626', 'Shujarrahman', 3, '2022-03-16 11:19:07'),
(66, 'Shuja', 'Rahman', 'Male', 'Obaid', 'Parveen', '2022-03-23', '210@gmail.com', 'HN0 805 MOHALLAH MOHD WASIL  PILIBHIT  India', 'Shuja', 'Basic', 'afad', 'afadfa', 'EIEPR3194G', '07579966178', 'Shujarrahmanaadhaar.jpg', 'Shujarrahmanmdiacal.png', 'ShujarrahmanPancard.jpg', 'Shujarrahmanpassportsize.jpg', '725473670', 'Shujarrahman', 2, '2022-03-16 15:57:45'),
(67, 'Shuja', 'Rahman', 'Male', 'Obaid', 'Parveen', '2022-03-23', '210@gmail.com', 'HN0 805 MOHALLAH MOHD WASIL  PILIBHIT  India', 'COVID-19 G', 'Diamond', '7000', '800000', 'EIEPR3194G', '07579966178', 'ShujarrahmanPancard.jpg', 'Shujarrahmanaadhaar.jpg', 'Shujarrahmanmdiacal.png', 'Shujarrahmanpassportsize.jpg', '482863042', 'Shujarrahman', 2, '2022-03-16 16:03:56'),
(69, 'Shuja', 'Rahman', 'Male', 'Obaid', 'Parveen', '2022-03-23', '210@gmail.com', 'HN0 805 MOHALLAH MOHD WASIL  PILIBHIT  India', 'COVID-19 XYZ', 'Diamond', 'asdsad', 'asdasd', 'EIEPR3194G', '07579966178', 'ShujarrahmanPancard.jpg', 'Shujarrahmanaadhaar.jpg', 'Shujarrahmanmdiacal.png', 'Shujarrahmanpassportsize.jpg', '716379555', 'Shujarrahman', 2, '2022-03-17 00:32:29'),
(70, 'Shuja', 'Rahman', 'Male', 'Obaid', 's', '2022-03-23', '210@gmail.com', 'HN0 805 MOHALLAH MOHD WASIL  PILIBHIT  India', 'COVID-19 XYZ', 'Diamond', 'asdsad', 'asdasd', 'EIEPR3194G', '07579966178', 'ShujarrahmanPancard.jpg', 'Shujarrahmanaadhaar.jpg', 'Shujarrahmanmdiacal.png', 'Shujarrahmanpassportsize.jpg', '246698854', 'Shujarrahman', NULL, '2022-03-17 01:17:12'),
(71, 'AQSA', 'RAHMAN', 'zxcvzd', 'ada', 'asda', '2022-03-19', 'fdscsdcman210@gmail.com', 'A-124 NANDRAM PARK UTTAM NAGAR EAST  Delhi  India', 'Shuja', 'Basic', 'afad', 'afadfa', 'EIEPR3194G', '07579966178', 'Faheemua1.JPG', 'Faheemua2.jpg', 'Faheemua3.jpg', 'Faheemua4.jpg', '197667310', 'Faheemua', 2, '2022-03-17 02:07:19'),
(72, 'Shuja', 'Rahman', 'asda', 'ada', 'Parveen', '2022-03-23', '210@gmail.com', 'HN0 805 MOHALLAH MOHD WASIL  PILIBHIT  India', 'payment test', 'Premium', '20000', '6789900', 'EIEPR3194G', '07579966178', 'Shujarrahmanaadhaar.jpg', 'Shujarrahmanmdiacal.png', 'ShujarrahmanPancard.jpg', 'Shujarrahmanpassportsize.jpg', '896649168', 'Shujarrahman', NULL, '2022-03-17 15:38:08');

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

--
-- Dumping data for table `contactus`
--

INSERT INTO `contactus` (`s_no`, `username`, `name`, `email`, `subject`, `message`, `date`) VALUES
(42, 'Shujarrahman', 'Shuja Ur Rahman', 'Shujaurrehman210@gmail.com', 'zdb', 'Shuja', '2022-03-12 21:20:55'),
(44, 'Shujarrahman', 'victoria', 'kyakarogeemailjankr@gmail.com', 'Are chodo yr ', 'ye agar kam nh kra to so jana bhut jaglye', '2022-03-15 18:00:42'),
(45, 'Shujarrahman', 'AQSA RAHMAN', 'Shujaurrehman210@gmail.com', 'aya msg', 'This is a test that Contact us menu is working ', '2022-03-16 16:43:43'),
(46, 'test', 'Shuja Ur Rahman', 'Shujaurrehman210@gmail.com', 'asdnjoashdnks', 'asdasda', '2022-03-16 19:24:17'),
(47, 'test', 'Shazra', '$asbdhkasbdkjs@gmailc', 'Snjoiajsdoi', 'this is a test', '2022-03-16 19:25:58'),
(48, 'Shujarrahman', 'Shuja Ur Rahman', 'Shujaurrehman210@gmail.com', 'zdb', 'ascasdcda', '2022-03-17 01:17:45');

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
(24, 'Basic', 'Shuja', 'sxas', 'afad', 'afadfa', '2022-03-15 20:26:49'),
(27, 'Diamond', 'COVID-19 XYZ', 'adasd', 'asdsad', 'asdasd', '2022-03-15 21:27:25'),
(29, 'Diamond', 'COVID-19 G', 'Death Guranttee', '7000', '800000', '2022-03-16 16:02:52'),
(30, 'Basic', 'COVID-19 XYZ', 'acadca', 'acascads', 'acascas', '2022-03-17 01:18:18'),
(31, 'Premium', 'payment test', 'yxcxs', '20000', '6789900', '2022-03-17 15:36:43');

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
(6, 'Shujarrahman', 'Shuja Ur Rahman', 'PILIBHIT', 'I love this website you have done a great job at coding this website .', 4, '2022-03-12 13:38:07'),
(7, 'Anonymous,Not registered with ', 'Faheem', 'Aligarh', '                    I was facing some problem while purchasing policy. I\r\n                    approached the customer service of Covisurance and I\r\n                    explained my problem to the exec', 5, '2022-03-12 13:49:54'),
(8, 'Anonymous,Not registered with ', 'Sabeela', 'Pilibhit', '                    I compared many plans on different-different platforms but\r\n                    did not get what I was looking for. Then I landed on\r\n                    Covisurance website and th', 3, '2022-03-12 13:50:57'),
(9, 'Anonymous,Not registered with ', 'Aqsa', 'Delhi', '                    I got protection against medical bills as i bought\r\n                    Mediclaim policy from Covisurance. it was very cost\r\n                    effective and i got lifelong renewa', 2, '2022-03-12 13:51:29'),
(10, 'Anonymous,Not registered with ', 'Shuja Ur Rahman', 'PILIBHIT', 'Shuja ur Rahman Rating test if it works or not lets see \r\nfinger crossed', 3, '2022-03-12 14:07:44'),
(11, 'Shujarrahman', 'Shuja Ur Rahman', 'PILIBHIT', 'Beautiful website you have done a great job ....', 4, '2022-03-12 22:32:56'),
(12, 'mohtarif', 'Mohtarif', 'PILIBHIT', 'Behtar se behtareen ki taraf rama dama har zarurat waqt ke takaze ko poora karne ki or agrsarit website ', 4, '2022-03-13 14:14:52'),
(13, 'test', 'victoria', 'heaven', 'Bhur hi bakwas site hai band krde bhai aur kuch dhang ka kaam kr ', 2, '2022-03-15 14:43:49'),
(14, 'Shujarrahman', 'Shuja Ur Rahman', 'asdas', 'asdsafdavA', 4, '2022-03-17 01:18:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`s_no`);

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
  MODIFY `s_no` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `appliedpolicy`
--
ALTER TABLE `appliedpolicy`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `contactus`
--
ALTER TABLE `contactus`
  MODIFY `s_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `policycards`
--
ALTER TABLE `policycards`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `testimonial`
--
ALTER TABLE `testimonial`
  MODIFY `s_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
