-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 19, 2024 at 02:59 PM
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
  `salt` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `mobile_no` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `adminlogin`
--

INSERT INTO `adminlogin` (`id`, `username`, `password`, `email`, `salt`, `created_at`, `mobile_no`) VALUES
(1, 'admin', 'MTIz', 'admin@gmail.com', '123', '2024-07-05 05:29:29', '9977679866');

-- --------------------------------------------------------

--
-- Table structure for table `chikitsa`
--

CREATE TABLE `chikitsa` (
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
(30, 'Sarangarh-Bilaigarh / सारंगढ़-बिलाईगढ़');

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
(1, 'Mujagahan', 4, 10, 1, 3, 4),
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
(1, 'अनुज शर्मा विधायक जी राजनांदगांव (75)');

-- --------------------------------------------------------

--
-- Table structure for table `nirmaan`
--

CREATE TABLE `nirmaan` (
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
-- Dumping data for table `nirmaan`
--

INSERT INTO `nirmaan` (`id`, `name`, `phone_number`, `designation`, `district_id`, `vidhansabha_id`, `vikaskhand_id`, `sector_id`, `gram_panchayat_id`, `gram_id`, `subject`, `reference`, `expectations_amount`, `application_date`, `file_upload`, `comment`, `status`, `anumodit_amount`, `aadesh_no`, `anumodit_date`, `view_comment`, `create_date`, `update_date`, `sveekrt_amount`, `sveekrt_no`, `sveekrt_comment`, `sveekrt_date`, `yojna_id`, `ptr_sender`, `presit_date`, `anudan_prapt_add`) VALUES
(1, 'Deepak Sahu', '9977679866', 'FullStack Dev', 10, 1, 3, 6, '4', '1', 'Devlopment', 'CBK', 50000, '2024-07-11', 'tree-736885_640.jpg', 'Mobile App devlopment', 3, '222', '220', '2024-07-16', 'ok ', '2024-07-11 03:36:22', '2024-07-18 09:53:54', '676', '67686', '888908908087', '2024-07-17', 2, 'Deepak', '2024-07-17', 'Raipur NIT GE. Road'),
(2, 'Rishi Sinha', '9977679866', 'Programmer', 10, 1, 3, 4, '1', '1', 'Devlopment', 'CBK', 50000, '2024-07-11', 'tree-736885_640.jpg', 'Mobile App devlopment', 1, '500000', '420', '2024-07-16', 'abhi itna rakho\r\n', '2024-07-11 03:40:23', '2024-07-18 09:55:34', '676', '67686', '8686', '2024-07-16', 2, 'Deepak', '2024-07-16', 'Raipur NCP'),
(3, 'Syam lal', '1234567890', 'manager', 10, 1, 3, 6, '4', '1', 'Devlopment', 'CBK', 50000, '2024-07-11', 'tree-736885_640.jpg', 'For Ne Project', 0, '500000', '420', '2024-07-16', 'r4try6', '2024-07-11 03:52:11', '2024-07-18 09:55:18', '676', '67686', 'uiyuki', '2024-07-16', 2, 'Deepak', '2024-07-17', 'Raipur NIT GE. Road'),
(4, 'Vinod', '9988679866', 'md', 10, 2, 4, 5, '3', '4', 'Devlopment', 'CBK', 500009, '2024-07-15', 'beach-3352363_960_720.jpg', 'niiiiil', 4, '222', '420', '2024-07-16', 'Ab aur nahi denge Paisa ', '2024-07-15 07:40:51', '2024-07-18 09:55:06', '300', '46456', 'Hiii', '2024-07-16', 2, '', NULL, ''),
(5, 'Ramesh', '9977985011', 'Professor', 10, 2, 4, 5, '3', '4', 'hostel found', 'CBK Technology', 500009, '2024-07-17', 'beach-3352363_960_720 (2).jpg', 'for collage hostel', 2, '500000', '420', '2024-07-17', 'gvnfhgjm', '2024-07-17 00:32:16', '2024-07-18 09:53:12', '67600', '67686', 'nggfjgf', '2024-07-17', 2, '', NULL, ''),
(6, 'nk modi', '887669850', 'deo', 10, 2, 4, 5, '3', '4', 'hostel found', 'CBK', 60000, '2024-07-17', 'beach-3352363_960_720 (3).jpg', 'ok de diye', 2, '500000', '4209', '2024-07-17', 'hii', '2024-07-17 01:02:12', '2024-07-18 09:54:43', '67600', '67686', 'hioii', '2024-07-17', 1, 'Deepak', '2024-07-17', 'Raipur NCP'),
(18, 'NIT Collage Raipur', '1234567890', 'deo', 10, 1, 3, 6, '4', '1', 'Hostel Devlopment', 'Dk. Verma', 50000, '2024-07-19', 'Screenshot (1).png', '00', 0, '', '', NULL, '', '2024-07-19 10:14:33', '2024-07-19 10:14:33', '', '', '', NULL, 0, '', NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `nirmaan_type_master`
--

CREATE TABLE `nirmaan_type_master` (
  `nirmaan_type_id` int(11) NOT NULL,
  `nirmaan_type_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nirmaan_type_master`
--

INSERT INTO `nirmaan_type_master` (`nirmaan_type_id`, `nirmaan_type_name`) VALUES
(1, 'Hostel Devlopment sasd'),
(2, 'Asdasda'),
(3, ''),
(4, 'hhjg'),
(5, 'Hostel Devlopment Raipur');

-- --------------------------------------------------------

--
-- Table structure for table `otps`
--

CREATE TABLE `otps` (
  `id` int(11) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `otp` varchar(6) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `valid_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `otps`
--

INSERT INTO `otps` (`id`, `phone_number`, `otp`, `created_at`, `valid_time`) VALUES
(1, '9977679866', '612067', '2024-07-19 11:56:10', '2024-07-19 17:31:10');

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
(17, 'Raja Sah', '887669850', 'deo', 10, 2, 4, 5, '3', '4', 'hostel found', 'CBK', 60000, '2024-07-17', 'beach-3352363_960_720 (3).jpg', 'ok de diye', 2, '500000', '4209', '2024-07-17', 'hii', '2024-07-17 06:32:12', '2024-07-18 05:56:53', '67600', '67686', 'hioii', '2024-07-17', 1, 'Deepak', '2024-07-17', 'Raipur NCP'),
(18, 'NIT Collage Raipur', '9977985099', 'Professor', 10, 1, 3, 6, '4', '1', 'Hostel Devlopment', 'Dk. Verma', 9000000, '2024-07-18', 'Screenshot (1).png', 'Nit Collage Devlopment Project', 0, '', '', NULL, '', '2024-07-18 06:22:15', '2024-07-18 06:22:15', '', '', '', NULL, 0, '', NULL, ''),
(19, 'NIT Collage Raipur', '1234567890', 'FullStack Dev', 10, 1, 3, 6, '4', '1', 'Hostel Devlopment', 'CBK Technology', 500009, '2024-07-19', 'Screenshot (1).png', '00', 0, '', '', NULL, '', '2024-07-19 10:16:34', '2024-07-19 10:16:34', '', '', '', NULL, 0, '', NULL, ''),
(20, 'NIT Collage Raipur', '9988679866', 'Programmer', 10, 2, 4, 5, '3', '4', 'Hostel Devlopment', 'CBK Technology', 500009, '2024-07-19', 'Screenshot (1).png', '797jghn', 0, '', '', NULL, '', '2024-07-19 10:21:49', '2024-07-19 10:21:49', '', '', '', NULL, 0, '', NULL, '');

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
-- Indexes for table `nirmaan`
--
ALTER TABLE `nirmaan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nirmaan_type_master`
--
ALTER TABLE `nirmaan_type_master`
  ADD PRIMARY KEY (`nirmaan_type_id`);

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
  MODIFY `district_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

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
-- AUTO_INCREMENT for table `nirmaan`
--
ALTER TABLE `nirmaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `nirmaan_type_master`
--
ALTER TABLE `nirmaan_type_master`
  MODIFY `nirmaan_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `otps`
--
ALTER TABLE `otps`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sector_master`
--
ALTER TABLE `sector_master`
  MODIFY `sector_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `swekshanudan`
--
ALTER TABLE `swekshanudan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

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
