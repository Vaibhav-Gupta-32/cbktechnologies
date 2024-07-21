-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 21, 2024 at 10:07 AM
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
-- Database: `admin_dashboard`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminlogin`
--

CREATE TABLE `adminlogin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile_no` varchar(20) NOT NULL,
  `salt` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `adminlogin`
--

INSERT INTO `adminlogin` (`id`, `username`, `password`, `email`, `mobile_no`, `salt`, `created_at`) VALUES
(1, 'admin', 'MTIz', 'admin@gmail.com', '9301323211', '123', '2024-07-05 05:29:29');

-- --------------------------------------------------------

--
-- Table structure for table `district_master`
--

CREATE TABLE `district_master` (
  `district_id` int(11) NOT NULL,
  `district_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `district_master`
--

INSERT INTO `district_master` (`district_id`, `district_name`) VALUES
(1, 'Balod / बालोद'),
(2, 'Baloda Bazar-Bhatapara / बलौदाबाजार - भाटापारा'),
(3, 'Balrampur-Ramanujganj / बलरामपुर - रामानुजगंज'),
(4, 'Bastar / बस्तर'),
(5, 'Bemetara / बेमेतरा'),
(6, 'Bijapur / बीजापुर'),
(7, 'Bilaspur / बिलासपुर'),
(8, 'Chowki / चौकी'),
(9, 'Dantewada / दंतेवाड़ा'),
(10, 'Dhamtari / धमतरी'),
(11, 'Durg / दुर्ग'),
(12, 'Gariaband / गरियाबंद'),
(13, 'Gaurella-Pendra-Marwahi / गौरेला-पेण्ड्रा-मरवाही'),
(14, 'Janjgir-Champa / जांजगीर - चांपा'),
(15, 'Jashpur / जशपुर'),
(16, 'Kabirdham (Kawardha) / कवर्धा जिला'),
(17, 'Kanker / कांकेर'),
(18, 'Khairagarh-Chhuikhadan-Gandai / खैरागढ़-छुईखदान-गण्डई'),
(19, 'Kondagaon / कोंडागांव'),
(20, 'Korba / कोरबा'),
(21, 'Korea / कोरिया'),
(22, 'Mahasamund / महासमुंद'),
(23, 'Manendragarh-Chirmiri-Bharatpur / मानेंद्रगढ़-चिरमिरी-भरतपुर'),
(24, 'Mungeli / मुंगेली'),
(25, 'Narayanpur / नारायणपुर'),
(26, 'Raigarh / रायगढ़'),
(27, 'Raipur / रायपुर'),
(28, 'Rajnandgaon / राजनांदगांव'),
(29, 'Sakti / शक्ति'),
(30, 'Sarangarh-Bilaigarh / सारंगढ़-बिलाईगढ़'),
(38, 'Abcd ');

-- --------------------------------------------------------

--
-- Table structure for table `gram_master`
--

CREATE TABLE `gram_master` (
  `gram_id` int(11) NOT NULL,
  `gram_name` varchar(200) NOT NULL,
  `gram_panchayat_id` int(11) NOT NULL,
  `district_id` int(11) NOT NULL,
  `vidhansabha_id` int(11) NOT NULL,
  `vikaskhand_id` int(11) NOT NULL,
  `sector_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gram_master`
--

INSERT INTO `gram_master` (`gram_id`, `gram_name`, `gram_panchayat_id`, `district_id`, `vidhansabha_id`, `vikaskhand_id`, `sector_id`) VALUES
(2, 'Loharsi', 0, 10, 1, 3, 4),
(3, 'Mujagahan', 0, 10, 1, 3, 5),
(4, 'Loharsi', 3, 10, 2, 4, 5);

-- --------------------------------------------------------

--
-- Table structure for table `gram_panchayat_master`
--

CREATE TABLE `gram_panchayat_master` (
  `gram_panchayat_id` int(11) NOT NULL,
  `gram_panchayat_name` varchar(200) NOT NULL,
  `vikaskhand_id` int(11) NOT NULL,
  `vidhansabha_id` int(11) NOT NULL,
  `district_id` int(11) NOT NULL,
  `sector_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gram_panchayat_master`
--

INSERT INTO `gram_panchayat_master` (`gram_panchayat_id`, `gram_panchayat_name`, `vikaskhand_id`, `vidhansabha_id`, `district_id`, `sector_id`) VALUES
(1, 'Hii', 3, 1, 10, 0),
(2, 'Qswd', 0, 0, 0, 0),
(3, 'Semra', 4, 2, 10, 5),
(4, 'Mujgahan', 3, 1, 10, 6),
(6, 'Loharsi', 3, 1, 10, 4);

-- --------------------------------------------------------

--
-- Table structure for table `maananeey_master`
--

CREATE TABLE `maananeey_master` (
  `maananeey_id` int(11) NOT NULL,
  `maananeey_info` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `maananeey_master`
--

INSERT INTO `maananeey_master` (`maananeey_id`, `maananeey_info`) VALUES
(1, 'Dr. Raman Singh विधायक जी राजनांदगांव (75)');

-- --------------------------------------------------------

--
-- Table structure for table `otps`
--

CREATE TABLE `otps` (
  `id` int(11) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `otp` varchar(6) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `valid_time` datetime DEFAULT NULL,
  `otpSend_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `otps`
--

INSERT INTO `otps` (`id`, `phone_number`, `otp`, `created_at`, `valid_time`, `otpSend_status`) VALUES
(1, '9301323211', '935887', '2024-07-18 13:18:32', NULL, 0),
(2, '9301323211', '605246', '2024-07-18 13:19:30', NULL, 0),
(3, '9301323211', '624020', '2024-07-18 13:21:09', NULL, 0),
(4, '9301323211', '413492', '2024-07-18 13:21:41', NULL, 0),
(5, '6265103457', '093850', '2024-07-18 17:53:16', NULL, 0),
(6, '9301323211', '392460', '2024-07-18 18:06:25', NULL, 0),
(7, '9301323211', '163714', '2024-07-18 18:07:02', NULL, 0),
(8, '9301323211', '151753', '2024-07-18 18:10:27', NULL, 0),
(9, '9301323211', '808950', '2024-07-18 18:13:10', NULL, 0),
(10, '9301323211', '871949', '2024-07-18 18:19:17', NULL, 0),
(11, '9301323211', '309409', '2024-07-18 18:34:30', NULL, 0),
(12, '9301323211', '356949', '2024-07-18 18:34:52', NULL, 0),
(13, '9301323211', '756618', '2024-07-19 06:24:20', NULL, 0),
(14, '9301323211', '574156', '2024-07-19 06:26:13', NULL, 0),
(15, '9301323211', '427746', '2024-07-19 06:27:20', NULL, 0),
(16, '9301323211', '151555', '2024-07-19 06:28:12', NULL, 0),
(17, '9301323211', '041745', '2024-07-19 06:28:51', NULL, 0),
(18, '9301323211', '408660', '2024-07-19 06:35:55', NULL, 0),
(19, '9301323211', '136648', '2024-07-19 06:39:13', NULL, 0),
(20, '9301323211', '911795', '2024-07-19 06:42:28', NULL, 0),
(21, '9301323211', '078859', '2024-07-19 07:02:02', NULL, 0),
(22, '9301323211', '542080', '2024-07-19 07:31:27', '2024-07-19 13:06:27', 0),
(23, '9301323211', '367459', '2024-07-19 07:34:29', '2024-07-19 13:09:29', 0),
(24, '9301323211', '075758', '2024-07-19 07:35:46', '2024-07-19 13:10:46', 0),
(25, '9301323211', '120928', '2024-07-19 07:44:36', '2024-07-19 13:19:36', 0),
(26, '9301323211', '236821', '2024-07-19 07:46:43', '2024-07-19 13:21:43', 0),
(27, '9301323211', '968914', '2024-07-19 07:57:08', '2024-07-19 13:32:08', 0),
(28, '9301323211', '105438', '2024-07-19 08:34:59', '2024-07-19 14:09:59', 0),
(29, '9301323211', '718927', '2024-07-19 09:44:02', '2024-07-19 15:19:02', 0),
(30, '9301323211', '703697', '2024-07-19 10:48:05', '2024-07-19 16:23:05', 0),
(31, '9301323211', '843969', '2024-07-19 10:48:38', '2024-07-19 16:23:38', 0),
(32, '9301323211', '294316', '2024-07-19 10:53:49', '2024-07-19 16:28:49', 0),
(33, '9301323211', '607529', '2024-07-19 11:00:14', '2024-07-19 16:35:14', 0),
(34, '9301323211', '372641', '2024-07-19 12:17:44', '2024-07-19 17:52:44', 0),
(35, '9301323211', '157482', '2024-07-19 12:25:40', '2024-07-19 18:00:40', 0),
(36, '9301323211', '803786', '2024-07-19 12:27:19', '2024-07-19 18:02:19', 0),
(37, '9301323211', '752615', '2024-07-19 12:31:11', '2024-07-19 18:06:11', 0),
(38, '9301323211', '554355', '2024-07-19 12:32:23', '2024-07-19 18:07:23', 0),
(39, '9301323211', '321427', '2024-07-19 12:34:39', '2024-07-19 18:09:39', 0),
(40, '9301323211', '468937', '2024-07-19 13:10:31', NULL, 0),
(41, '9301323211', '303571', '2024-07-20 06:22:58', '2024-07-20 11:57:58', 0),
(42, '9301323211', '343190', '2024-07-20 06:26:39', '2024-07-20 12:01:39', 0),
(43, '9301323211', '793786', '2024-07-20 06:30:54', '2024-07-20 12:05:54', 0),
(44, '9301323211', '383616', '2024-07-20 06:34:44', '2024-07-20 12:09:44', 0),
(45, '9301323211', '890497', '2024-07-20 06:36:15', '2024-07-20 12:11:15', 0),
(46, '9301323211', '838989', '2024-07-20 06:37:56', '2024-07-20 12:12:56', 0),
(47, '9301323211', '254989', '2024-07-20 06:39:03', '2024-07-20 12:14:03', 0),
(48, '9301323211', '101891', '2024-07-20 06:44:28', '2024-07-20 12:19:28', 0),
(49, '9301323211', '888918', '2024-07-20 06:46:32', '2024-07-20 12:21:32', 0),
(50, '9301323211', '484681', '2024-07-20 06:52:19', '2024-07-20 12:27:19', 0),
(51, '9301323211', '337678', '2024-07-20 06:55:06', '2024-07-20 12:30:06', 0),
(52, '9301323211', '033948', '2024-07-20 06:57:14', '2024-07-20 12:32:14', 0),
(53, '9301323211', '689452', '2024-07-20 07:06:00', '2024-07-20 12:41:00', 0),
(54, '9301323211', '689112', '2024-07-20 07:10:39', '2024-07-20 12:45:39', 0),
(55, '9301323211', '749525', '2024-07-20 07:11:17', '2024-07-20 12:46:17', 0),
(56, '9301323211', '877730', '2024-07-20 07:12:02', '2024-07-20 12:47:02', 0),
(57, '6545646546', '700270', '2024-07-20 10:43:05', NULL, 0),
(58, '9301323211', '135529', '2024-07-20 10:46:29', NULL, 0),
(59, '9301323211', '826117', '2024-07-20 10:50:29', NULL, 0),
(60, '9301323211', '026795', '2024-07-20 10:54:33', NULL, 0),
(61, '9301323211', '709600', '2024-07-20 11:01:26', '2024-07-20 16:36:26', 0),
(62, '9977679866', '010576', '2024-07-20 11:27:58', '2024-07-20 17:02:58', 0),
(63, '9301323211', '918418', '2024-07-20 12:06:03', '2024-07-20 17:41:03', 0),
(64, '9301323212', '160945', '2024-07-20 12:07:37', '2024-07-20 17:42:37', 0),
(65, '9301323211', '649193', '2024-07-20 12:15:06', '2024-07-20 17:50:06', 0),
(66, '9301323211', '338979', '2024-07-20 12:16:49', '2024-07-20 17:51:49', 0),
(67, '9301323211', '548024', '2024-07-20 12:17:48', '2024-07-20 17:52:48', 0),
(68, '9301323211', '524968', '2024-07-20 12:19:08', '2024-07-20 17:54:08', 0),
(69, '9301323211', '958584', '2024-07-20 12:22:35', '2024-07-20 17:57:35', 0),
(70, '9301323211', '657607', '2024-07-20 12:23:56', '2024-07-20 17:58:56', 0),
(71, '9301323211', '529900', '2024-07-20 12:25:25', '2024-07-20 18:00:25', 0),
(72, '9301323211', '062384', '2024-07-20 12:26:19', '2024-07-20 18:01:19', 0),
(73, '9301323211', '458400', '2024-07-20 12:28:17', '2024-07-20 18:03:17', 0),
(74, '9301323211', '012339', '2024-07-20 12:29:10', '2024-07-20 18:04:10', 0),
(75, '9301323211', '078158', '2024-07-20 13:02:34', '2024-07-20 18:37:34', 0),
(76, '9301323211', '354907', '2024-07-20 13:05:10', '2024-07-20 18:40:10', 0),
(77, '9301323211', '611921', '2024-07-20 13:05:40', '2024-07-20 18:40:40', 0),
(78, '9301323211', '948285', '2024-07-20 13:06:53', '2024-07-20 18:41:53', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sector_master`
--

CREATE TABLE `sector_master` (
  `sector_id` int(11) NOT NULL,
  `sector_name` varchar(200) NOT NULL,
  `district_id` int(11) NOT NULL,
  `vidhansabha_id` int(11) NOT NULL,
  `vikaskhand_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sector_master`
--

INSERT INTO `sector_master` (`sector_id`, `sector_name`, `district_id`, `vidhansabha_id`, `vikaskhand_id`) VALUES
(1, 'C-23', 10, 1, 3),
(2, 'C-23', 27, 3, 0),
(3, 'C-23', 0, 0, 0),
(4, 'C-24', 10, 1, 3),
(5, 'CBK-25', 10, 2, 4),
(6, 'CBK-25', 10, 1, 3),
(7, 'CBK-50', 10, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `swekshanudan`
--

CREATE TABLE `swekshanudan` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `designation` varchar(100) NOT NULL,
  `district_id` int(11) NOT NULL,
  `vidhansabha_id` int(11) NOT NULL,
  `vikaskhand_id` int(11) NOT NULL,
  `sector_id` int(11) NOT NULL,
  `gram_panchayat_id` varchar(100) NOT NULL,
  `gram_id` varchar(100) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `reference` varchar(100) NOT NULL,
  `expectations_amount` int(11) NOT NULL,
  `application_date` date NOT NULL,
  `file_upload` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0 COMMENT '0 = प्राप्त आवेदन\r\n1 = प्रस्तावित आवेदन\r\n2 = स्वीकृत आवेदन \r\n3 = प्रेषित स्वीकृत आवेदन\r\n4 = अस्वीकृत आवेदन ',
  `anumodit_amount` varchar(200) NOT NULL DEFAULT '',
  `aadesh_no` varchar(200) NOT NULL DEFAULT '',
  `anumodit_date` date DEFAULT NULL,
  `view_comment` text NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `sveekrt_amount` varchar(200) NOT NULL,
  `sveekrt_no` varchar(100) NOT NULL,
  `sveekrt_comment` text NOT NULL,
  `sveekrt_date` date DEFAULT NULL,
  `yojna_id` int(11) NOT NULL,
  `ptr_sender` varchar(200) NOT NULL,
  `presit_date` date DEFAULT NULL,
  `anudan_prapt_add` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `swekshanudan`
--

INSERT INTO `swekshanudan` (`id`, `name`, `phone_number`, `designation`, `district_id`, `vidhansabha_id`, `vikaskhand_id`, `sector_id`, `gram_panchayat_id`, `gram_id`, `subject`, `reference`, `expectations_amount`, `application_date`, `file_upload`, `comment`, `status`, `anumodit_amount`, `aadesh_no`, `anumodit_date`, `view_comment`, `create_date`, `update_date`, `sveekrt_amount`, `sveekrt_no`, `sveekrt_comment`, `sveekrt_date`, `yojna_id`, `ptr_sender`, `presit_date`, `anudan_prapt_add`) VALUES
(8, 'Lomash Rishi', '9977679866', 'FullStack Dev', 10, 1, 3, 6, '4', '1', 'Devlopment', 'CBK', 50000, '2024-07-11', 'tree-736885_640.jpg', 'Mobile App devlopment', 3, '222', '220', '2024-07-16', 'ok ', '2024-07-11 09:06:22', '2024-07-17 06:09:48', '676', '67686', '888908908087', '2024-07-17', 2, 'Deepak', '2024-07-17', 'Raipur NIT GE. Road'),
(9, 'Lomash Rishi', '9977679866', 'FullStack Dev', 10, 1, 3, 4, '1', '1', 'Devlopment', 'CBK', 50000, '2024-07-11', 'tree-736885_640.jpg', 'Mobile App devlopment', 1, '500000', '420', '2024-07-16', 'abhi itna rakho\r\n', '2024-07-11 09:10:23', '2024-07-18 05:56:46', '676', '67686', '8686', '2024-07-16', 2, 'Deepak', '2024-07-16', 'Raipur NCP'),
(10, 'Lomash Rishi', '1234567890', 'FullStack Dev', 10, 1, 3, 6, '4', '1', 'Devlopment', 'CBK', 50000, '2024-07-11', 'tree-736885_640.jpg', 'For Ne Project', 0, '500000', '420', '2024-07-16', 'r4try6', '2024-07-11 09:22:11', '2024-07-18 05:56:59', '676', '67686', 'uiyuki', '2024-07-16', 2, 'Deepak', '2024-07-17', 'Raipur NIT GE. Road'),
(15, 'Vinod', '9988679866', 'FullStack Dev', 10, 2, 4, 5, '3', '4', 'Devlopment', 'CBK', 500009, '2024-07-15', 'beach-3352363_960_720.jpg', 'niiiiil', 4, '222', '420', '2024-07-16', 'Ab aur nahi denge Paisa ', '2024-07-15 13:10:51', '2024-07-18 05:57:09', '300', '46456', 'Hiii', '2024-07-16', 2, '', NULL, ''),
(16, 'Ramesh', '9977985011', 'Professor', 10, 2, 4, 5, '3', '4', 'hostel found', 'CBK Technology', 500009, '2024-07-17', 'beach-3352363_960_720 (2).jpg', 'for collage hostel', 2, '500000', '420', '2024-07-17', 'gvnfhgjm', '2024-07-17 06:02:16', '2024-07-17 07:40:45', '67600', '67686', 'nggfjgf', '2024-07-17', 2, '', NULL, ''),
(17, 'Raja Sah', '887669850', 'deo', 10, 2, 4, 5, '3', '4', 'hostel found', 'CBK', 60000, '2024-07-17', 'beach-3352363_960_720 (3).jpg', 'ok de diye', 2, '500000', '4209', '2024-07-17', 'hii', '2024-07-17 06:32:12', '2024-07-18 05:56:53', '67600', '67686', 'hioii', '2024-07-17', 1, 'Deepak', '2024-07-17', 'Raipur NCP');

-- --------------------------------------------------------

--
-- Table structure for table `userlogin`
--

CREATE TABLE `userlogin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile_no` varchar(20) NOT NULL,
  `salt` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userlogin`
--

INSERT INTO `userlogin` (`id`, `username`, `password`, `email`, `mobile_no`, `salt`, `created_at`) VALUES
(1, '9301323211', '', '', '9301323211', '', '2024-07-20 11:02:07'),
(2, '9977679866', '', '', '9977679866', '', '2024-07-20 11:28:40'),
(3, '9301323211', '', '', '9301323211', '', '2024-07-20 12:48:48');

-- --------------------------------------------------------

--
-- Table structure for table `vibhag_master`
--

CREATE TABLE `vibhag_master` (
  `vibhag_id` int(11) NOT NULL,
  `vibhag_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vibhag_master`
--

INSERT INTO `vibhag_master` (`vibhag_id`, `vibhag_name`) VALUES
(1, 'Abcd'),
(2, 'CS&IT'),
(3, 'जल विभाग');

-- --------------------------------------------------------

--
-- Table structure for table `vidhansabha_master`
--

CREATE TABLE `vidhansabha_master` (
  `vidhansabha_id` int(11) NOT NULL,
  `vidhansabha_name` varchar(200) NOT NULL,
  `district_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vidhansabha_master`
--

INSERT INTO `vidhansabha_master` (`vidhansabha_id`, `vidhansabha_name`, `district_id`) VALUES
(1, 'Dhamtari', 10),
(2, 'Kurud', 10),
(3, 'Arang', 27),
(4, 'Dharsiva', 27);

-- --------------------------------------------------------

--
-- Table structure for table `vikaskhand_master`
--

CREATE TABLE `vikaskhand_master` (
  `vikaskhand_id` int(11) NOT NULL,
  `vikaskhand_name` varchar(200) NOT NULL,
  `vidhansabha_id` int(11) NOT NULL,
  `district_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vikaskhand_master`
--

INSERT INTO `vikaskhand_master` (`vikaskhand_id`, `vikaskhand_name`, `vidhansabha_id`, `district_id`) VALUES
(1, 'Hii', 0, 0),
(2, 'Dhamtari', 10, 10),
(3, 'Dhamtari', 1, 10),
(4, 'Kurud', 2, 10),
(5, 'Bhakhara', 2, 10);

-- --------------------------------------------------------

--
-- Table structure for table `yojna_master`
--

CREATE TABLE `yojna_master` (
  `yojna_id` int(11) NOT NULL,
  `yojna_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `yojna_master`
--

INSERT INTO `yojna_master` (`yojna_id`, `yojna_name`) VALUES
(1, 'E-Rashan'),
(2, 'PM-Kishan');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adminlogin`
--
ALTER TABLE `adminlogin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `district_master`
--
ALTER TABLE `district_master`
  ADD PRIMARY KEY (`district_id`);

--
-- Indexes for table `gram_master`
--
ALTER TABLE `gram_master`
  ADD PRIMARY KEY (`gram_id`);

--
-- Indexes for table `gram_panchayat_master`
--
ALTER TABLE `gram_panchayat_master`
  ADD PRIMARY KEY (`gram_panchayat_id`);

--
-- Indexes for table `maananeey_master`
--
ALTER TABLE `maananeey_master`
  ADD PRIMARY KEY (`maananeey_id`);

--
-- Indexes for table `otps`
--
ALTER TABLE `otps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sector_master`
--
ALTER TABLE `sector_master`
  ADD PRIMARY KEY (`sector_id`);

--
-- Indexes for table `swekshanudan`
--
ALTER TABLE `swekshanudan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_district_id` (`district_id`);

--
-- Indexes for table `userlogin`
--
ALTER TABLE `userlogin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vibhag_master`
--
ALTER TABLE `vibhag_master`
  ADD PRIMARY KEY (`vibhag_id`);

--
-- Indexes for table `vidhansabha_master`
--
ALTER TABLE `vidhansabha_master`
  ADD PRIMARY KEY (`vidhansabha_id`);

--
-- Indexes for table `vikaskhand_master`
--
ALTER TABLE `vikaskhand_master`
  ADD PRIMARY KEY (`vikaskhand_id`);

--
-- Indexes for table `yojna_master`
--
ALTER TABLE `yojna_master`
  ADD PRIMARY KEY (`yojna_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adminlogin`
--
ALTER TABLE `adminlogin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `district_master`
--
ALTER TABLE `district_master`
  MODIFY `district_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `gram_master`
--
ALTER TABLE `gram_master`
  MODIFY `gram_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `gram_panchayat_master`
--
ALTER TABLE `gram_panchayat_master`
  MODIFY `gram_panchayat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `maananeey_master`
--
ALTER TABLE `maananeey_master`
  MODIFY `maananeey_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `otps`
--
ALTER TABLE `otps`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `sector_master`
--
ALTER TABLE `sector_master`
  MODIFY `sector_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `swekshanudan`
--
ALTER TABLE `swekshanudan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `userlogin`
--
ALTER TABLE `userlogin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `vibhag_master`
--
ALTER TABLE `vibhag_master`
  MODIFY `vibhag_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `vidhansabha_master`
--
ALTER TABLE `vidhansabha_master`
  MODIFY `vidhansabha_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `vikaskhand_master`
--
ALTER TABLE `vikaskhand_master`
  MODIFY `vikaskhand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `yojna_master`
--
ALTER TABLE `yojna_master`
  MODIFY `yojna_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `swekshanudan`
--
ALTER TABLE `swekshanudan`
  ADD CONSTRAINT `fk_district_id` FOREIGN KEY (`district_id`) REFERENCES `district_master` (`district_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
