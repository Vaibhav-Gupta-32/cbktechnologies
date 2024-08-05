-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 05, 2024 at 09:09 AM
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
-- Table structure for table `aamantran`
--

CREATE TABLE `aamantran` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `karykram` varchar(100) NOT NULL,
  `sthan` varchar(255) NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `file_upload` varchar(255) NOT NULL,
  `aamantran_date` date NOT NULL,
  `comment` text NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT '0',
  `view_comment` varchar(255) DEFAULT NULL,
  `preshak` varchar(200) NOT NULL,
  `karykram_time` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `aamantran`
--

INSERT INTO `aamantran` (`id`, `name`, `karykram`, `sthan`, `from_date`, `to_date`, `file_upload`, `aamantran_date`, `comment`, `status`, `view_comment`, `preshak`, `karykram_time`, `created_at`) VALUES
(1, 'Ramesh ', 'बुक वितरण ', 'रायपुर कोटा मैदान ', '2024-07-22', '2024-07-11', '3112512.jpg', '2024-07-22', 'asdasdsa', '0', 'गत', 'Ram lal', '20:59:35', '2024-07-22 08:18:35'),
(2, 'Ramesh ', 'बुक वितरण ', 'रायपुर कोटा मैदान ', '2024-07-22', '2024-07-22', 'beach-3352363_960_720 (3).jpg', '2024-07-22', 'aana jarur', '1', 'Hii ', 'Syam Lala', '09:00:00', '2024-07-22 08:21:44'),
(3, 'Vinod', 'बुक वितरण ', 'रायपुर कोटा मैदान ', '2024-07-16', '2024-07-22', '3112512.jpg', '2024-07-16', 'hii', '1', '', 'Prem lala', '15:09:00', '2024-07-22 09:36:39');

-- --------------------------------------------------------

--
-- Table structure for table `aavedan`
--

CREATE TABLE `aavedan` (
  `id` int(11) NOT NULL,
  `mantri_comment` varchar(255) DEFAULT NULL,
  `aadesh_date` date DEFAULT NULL,
  `jaavak_date` date DEFAULT NULL,
  `kisko_presit` varchar(255) DEFAULT NULL,
  `jaavak_vibhag` varchar(255) DEFAULT NULL,
  `office_name` varchar(255) DEFAULT NULL,
  `file_upload` varchar(255) DEFAULT NULL,
  `reference` varchar(255) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `aavak_vibhag` varchar(255) DEFAULT NULL,
  `aavak_no` varchar(255) DEFAULT NULL,
  `choose_aavedak_vibhag` varchar(255) DEFAULT NULL,
  `file_no` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `status` int(11) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `aavedan`
--

INSERT INTO `aavedan` (`id`, `mantri_comment`, `aadesh_date`, `jaavak_date`, `kisko_presit`, `jaavak_vibhag`, `office_name`, `file_upload`, `reference`, `subject`, `aavak_vibhag`, `aavak_no`, `choose_aavedak_vibhag`, `file_no`, `date`, `status`, `create_date`) VALUES
(1, 'ise kaam do hfdhdfhdf', '2024-07-27', '2024-07-27', 'vaibhav22', '2', 'ऑफिस का नाम चुनें', '', 'सर 2', 'Job2', '2', '2', '2', '2', '2024-07-27', 0, '2024-07-27 12:40:33');

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
-- Table structure for table `charcha`
--

CREATE TABLE `charcha` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `designation` varchar(100) NOT NULL,
  `district_id` int(11) NOT NULL,
  `vidhansabha_id` int(11) NOT NULL,
  `vikaskhand_id` int(11) NOT NULL,
  `sector_id` int(11) NOT NULL,
  `gram_panchayat_id` varchar(255) NOT NULL,
  `gram_id` varchar(255) NOT NULL,
  `subject` text NOT NULL,
  `reference` text NOT NULL,
  `saral_aadesh_no` varchar(50) NOT NULL,
  `application_date` date NOT NULL,
  `comment` text DEFAULT NULL,
  `file_upload` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0 COMMENT '0=प्राप्त आवेदन, 1=प्रस्तावित आवेदन, 2=स्वीकृत आवेदन, 3=प्रेषित स्वीकृत आवेदन, 4=अस्वीकृत आवेदन',
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `view_comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `charcha`
--

INSERT INTO `charcha` (`id`, `name`, `phone_number`, `designation`, `district_id`, `vidhansabha_id`, `vikaskhand_id`, `sector_id`, `gram_panchayat_id`, `gram_id`, `subject`, `reference`, `saral_aadesh_no`, `application_date`, `comment`, `file_upload`, `status`, `created_date`, `view_comment`) VALUES
(1, 'John Doe', '1234567890', 'Manager', 1, 1, 1, 1, '1', '1', '', 'Reference 1', 'SA-001', '2024-01-01', 'Comment 1', 'uploads/file1.pdf', 0, '2024-07-20 09:29:13', ''),
(2, 'Jane Smith', '2345678901', 'Engineer', 2, 2, 2, 2, 'Panchayat 2', 'Gram 2', 'Subject 2', 'Reference 2', 'SA-002', '2024-01-02', 'Comment 2', 'uploads/file2.pdf', 1, '2024-07-20 09:29:13', ''),
(3, 'Alice Johnson', '3456789012', 'Analyst', 3, 3, 3, 3, 'Panchayat 3', 'Gram 3', 'Subject 3', 'Reference 3', 'SA-003', '2024-01-03', 'Comment 3', 'uploads/file3.pdf', 0, '2024-07-20 09:29:13', ''),
(4, 'Bob Brown', '4567890123', 'Clerk', 4, 4, 4, 4, 'Panchayat 4', 'Gram 4', 'Subject 4', 'Reference 4', 'SA-004', '2024-01-04', 'Comment 4', 'uploads/file4.pdf', 1, '2024-07-20 09:29:13', ''),
(5, 'Charlie Davis', '5678901234', 'Supervisor', 5, 5, 5, 5, 'Panchayat 5', 'Gram 5', 'Subject 5', 'Reference 5', 'SA-005', '2024-01-05', 'Comment 5', 'uploads/file5.pdf', 1, '2024-07-20 09:29:13', ''),
(6, 'Eve White', '6789012345', 'Coordinator', 6, 6, 6, 6, 'Panchayat 6', 'Gram 6', 'Subject 6', 'Reference 6', 'SA-006', '2024-01-06', 'Comment 6', 'uploads/file6.pdf', 1, '2024-07-20 09:29:13', ''),
(7, 'Frank Green', '7890123456', 'Assistant', 7, 7, 7, 7, 'Panchayat 7', 'Gram 7', 'Subject 7', 'Reference 7', 'SA-007', '2024-01-07', 'Comment 7', 'uploads/file7.pdf', 1, '2024-07-20 09:29:13', ''),
(8, 'Grace Lee', '8901234567', 'Officer', 8, 8, 8, 8, 'Panchayat 8', 'Gram 8', 'Subject 8', 'Reference 8', 'SA-008', '2024-01-08', 'Comment 8', 'uploads/file8.pdf', 2, '2024-07-20 09:29:13', ''),
(9, 'hii', '9012345678', 'Director', 9, 0, 0, 0, 'ग्राम पंचायत का नाम चुनें', 'ग्राम का नाम चुनें', 'Subject 9', 'Reference 9', 'SA-009', '2024-01-09', 'Comment 9', 'uploads/file9.pdf', 1, '2024-07-20 09:29:13', 'hii'),
(10, 'Ivy Scott', '0123456789', 'Administrator', 10, 10, 10, 10, 'Panchayat 10', 'Gram 10', 'Subject 10', 'Reference 10', 'SA-010', '2024-01-10', 'Comment 10', 'uploads/file10.pdf', 4, '2024-07-20 09:29:13', ''),
(11, 'NIT Collage Raipur', '9977679850', 'Programmer', 10, 2, 3, 6, '4', '1', 'Hostel Devlopment', 'CBK Technology', '809', '2024-07-20', 'hijio', 'company_logo.png', 1, '2024-07-20 10:43:32', 'hiii'),
(12, 'Vinod', '9988679866', 'FullStack Dev', 10, 2, 4, 5, '3', '4', 'Hostel Devlopment', 'CBK Technology', '809', '2024-07-22', 'hii', '3112512.jpg', 1, '2024-07-22 12:57:24', 'hg');

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

--
-- Dumping data for table `chikitsa`
--

INSERT INTO `chikitsa` (`id`, `name`, `phone_number`, `designation`, `district_id`, `vidhansabha_id`, `vikaskhand_id`, `sector_id`, `gram_panchayat_id`, `gram_id`, `subject`, `reference`, `expectations_amount`, `application_date`, `file_upload`, `comment`, `status`, `anumodit_amount`, `aadesh_no`, `anumodit_date`, `view_comment`, `create_date`, `update_date`, `sveekrt_amount`, `sveekrt_no`, `sveekrt_comment`, `sveekrt_date`, `yojna_id`, `ptr_sender`, `presit_date`, `anudan_prapt_add`) VALUES
(0, 'Ramesh', '1234567890', 'Professor', 10, 1, 3, 6, '4', '1', 'Hostel Devlopment', 'CBK Technology', 60000, '2024-07-22', '3112512.jpg', 'hii', 0, '', '', NULL, '', '2024-07-22 12:56:34', '2024-07-22 12:56:34', '', '', '', NULL, 0, '', NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `chikitsa_seva`
--

CREATE TABLE `chikitsa_seva` (
  `id` int(11) NOT NULL,
  `inquiry_no` varchar(30) NOT NULL,
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
  `expectations_hospital_id` int(11) NOT NULL,
  `application_date` date NOT NULL,
  `file_upload` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0 COMMENT '0 = प्राप्त आवेदन\r\n1 = प्रस्तावित आवेदन\r\n2 = स्वीकृत आवेदन \r\n3 = प्रेषित स्वीकृत आवेदन\r\n4 = अस्वीकृत आवेदन ',
  `anumodit_amount` varchar(200) NOT NULL DEFAULT '',
  `anumodit_hospital_id` int(11) NOT NULL,
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
-- Dumping data for table `chikitsa_seva`
--

INSERT INTO `chikitsa_seva` (`id`, `inquiry_no`, `name`, `phone_number`, `designation`, `district_id`, `vidhansabha_id`, `vikaskhand_id`, `sector_id`, `gram_panchayat_id`, `gram_id`, `subject`, `reference`, `expectations_amount`, `expectations_hospital_id`, `application_date`, `file_upload`, `comment`, `status`, `anumodit_amount`, `anumodit_hospital_id`, `aadesh_no`, `anumodit_date`, `view_comment`, `create_date`, `update_date`, `sveekrt_amount`, `sveekrt_no`, `sveekrt_comment`, `sveekrt_date`, `yojna_id`, `ptr_sender`, `presit_date`, `anudan_prapt_add`) VALUES
(1, '', 'Ramesh kumar', '0000000000', 'Professor', 10, 1, 3, 6, '4', '5', 'Hostel Devlopment', 'CBK Technology', 0, 3, '2024-07-22', '3112512.jpg', 'hii', 1, '', 3, '0001', '2024-07-26', 'das', '2024-07-26 07:29:24', '2024-07-26 11:32:05', '', '', '', NULL, 0, '', NULL, ''),
(2, '', 'Vaibhav Gupta', '9301323211', 'ad', 10, 1, 3, 6, '4', '5', 'डेवलपर', 'da', 0, 3, '2024-07-26', 'dss.pdf', 'asdadas', 1, '', 5, '123', '2024-07-26', 'hospital chale jao', '2024-07-26 10:17:56', '2024-07-26 11:51:47', '', '', '', NULL, 0, '', NULL, ''),
(3, '', 'lomas', '9301323211', 'bbb', 10, 1, 3, 6, '4', '5', 'Job 3', 'सरg', 0, 4, '2024-07-26', 'a.pdf', 'asDa', 1, '', 3, '0003', '2024-07-26', 'asas', '2024-07-26 11:21:54', '2024-07-26 11:51:54', '', '', '', NULL, 0, '', NULL, ''),
(4, '', 'Vaibhav Gupta', '9301323211', 'ccc', 10, 1, 3, 6, '4', '5', 'Job 2', 'सर 2', 0, 3, '2024-07-26', 'protocol_pdf.png', 'dsdsfw', 1, '', 4, '0004', '2024-07-26', 'ewgewg', '2024-07-26 11:34:18', '2024-07-26 11:41:29', '', '', '', NULL, 0, '', NULL, '');

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
-- Table structure for table `hospital_master`
--

CREATE TABLE `hospital_master` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL,
  `contact` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hospital_master`
--

INSERT INTO `hospital_master` (`id`, `name`, `address`, `contact`) VALUES
(3, 'AIIMS Hospital ', 'Gate No 1, Great Eastern Rd, opposite Gurudwara, AIIMS Campus, Tatibandh, Raipur, Chhattisgarh 492099', '077125 722'),
(4, 'District Hospital', 'Pandri', ''),
(5, 'D K Hospital', 'Gadhi Chowk', '');

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
(6, 'nk modi', '887669850', 'deo', 10, 2, 4, 5, '3', '4', 'hostel found', 'CBK', 60000, '2024-07-17', 'beach-3352363_960_720 (3).jpg', 'ok de diye', 3, '500000', '4209', '2024-07-17', 'hii', '2024-07-17 01:02:12', '2024-07-20 07:59:29', '67600', '67686', 'hioii', '2024-07-17', 1, 'vgbg', '2024-07-20', 'ghgbn'),
(18, 'NIT Collage Raipur', '1234567890', 'deo', 10, 1, 3, 6, '4', '1', 'Hostel Devlopment', 'Dk. Verma', 50000, '2024-07-19', 'Screenshot (1).png', 'yhgb', 0, '', '', NULL, '', '2024-07-19 10:14:33', '2024-07-22 12:53:30', '', '', '', NULL, 0, '', NULL, ''),
(19, 'Ramesh', '1234567890', 'deo', 10, 2, 4, 5, '3', '4', 'Hostel Devlopment', 'CBK', 50000, '2024-07-22', '3112512.jpg', 'htgh', 3, '500000', '420', '2024-07-22', 'vcv', '2024-07-22 12:53:04', '2024-07-22 12:55:41', '676', '67686', 'hii', '2024-07-22', 1, 'oijki', '2024-07-22', 'Raipur NIT GE. Road');

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
(3, 'CBK'),
(4, 'hhjg'),
(5, 'Hostel Devlopment Raipur'),
(6, 'Hostel Devlopment Raipur');

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
(1, '9977679866', '612067', '2024-07-19 11:56:10', '2024-07-19 17:31:10'),
(2, '9977679866', '795082', '2024-07-20 13:01:44', '2024-07-20 18:36:44'),
(3, '9977679866', '564609', '2024-07-20 13:05:34', '2024-07-20 18:40:34');

-- --------------------------------------------------------

--
-- Table structure for table `protocol_details`
--

CREATE TABLE `protocol_details` (
  `id` int(11) NOT NULL,
  `kramank_no` varchar(50) NOT NULL,
  `protocol_date` date NOT NULL,
  `travel_date` date NOT NULL,
  `days` varchar(50) NOT NULL,
  `entry_time` time NOT NULL,
  `exit_time` time NOT NULL,
  `madhyam` varchar(100) NOT NULL,
  `district_id` int(11) NOT NULL,
  `details` text NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `protocol_details`
--

INSERT INTO `protocol_details` (`id`, `kramank_no`, `protocol_date`, `travel_date`, `days`, `entry_time`, `exit_time`, `madhyam`, `district_id`, `details`, `create_date`, `update_date`) VALUES
(1, '2', '2024-07-25', '2024-07-25', 'रविवार', '12:00:00', '12:00:00', 'dsadas', 27, 'dasdas', '2024-07-23 07:41:04', '2024-07-23 13:15:42'),
(2, '1', '2024-07-23', '2024-07-23', 'बुधवार', '14:00:00', '17:00:00', 'कार', 10, 'न्कदाद्ज्ख्बक्जा', '2024-07-23 07:46:27', '2024-07-23 12:23:46'),
(3, '1', '2024-07-23', '2024-07-24', 'बुधवार', '14:00:00', '17:00:00', 'कार', 10, 'अनाल्क्ज्ज', '2024-07-23 07:47:13', '2024-07-23 12:23:46'),
(4, '1', '2024-07-23', '2024-07-24', 'बुधवार', '14:00:00', '17:00:00', 'कार', 10, 'म्द्ब्कज्ब्काद्क्ब्ज', '2024-07-23 07:47:40', '2024-07-23 12:23:46'),
(5, '1', '2024-07-23', '2024-07-24', 'बुधवार', '14:00:00', '17:00:00', 'कार', 10, 'sfdsdjfhiodfh', '2024-07-23 07:48:01', '2024-07-23 12:23:46'),
(6, '1', '2024-07-23', '2024-07-24', 'बुधवार', '14:00:00', '17:00:00', 'कार', 10, 'फ्हेफ्होद्ज', '2024-07-23 07:48:07', '2024-07-23 12:23:46');

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
(9, 'Lomash Rishi', '9977679866', 'FullStack Dev', 10, 1, 3, 4, '1', '1', 'Devlopment', 'CBK', 50000, '2024-07-11', 'tree-736885_640.jpg', 'Mobile App devlopment', 3, '500000', '420', '2024-07-16', 'abhi itna rakho\r\n', '2024-07-11 09:10:23', '2024-07-20 09:38:30', '676', '67686', '8686', '2024-07-16', 2, 'Hitesh', '2024-07-20', 'Raipur NCP'),
(10, 'Lomash Rishi', '1234567890', 'FullStack Dev', 10, 1, 3, 6, '4', '1', 'Devlopment', 'CBK', 50000, '2024-07-11', 'tree-736885_640.jpg', 'For Ne Project', 1, '500000', '420', '2024-07-22', 'jihk', '2024-07-11 09:22:11', '2024-07-22 06:10:35', '676', '67686', 'uiyuki', '2024-07-16', 2, 'Deepak', '2024-07-17', 'Raipur NIT GE. Road'),
(15, 'Vinod', '9988679866', 'FullStack Dev', 10, 2, 4, 5, '3', '4', 'Devlopment', 'CBK', 500009, '2024-07-15', 'beach-3352363_960_720.jpg', 'niiiiil', 4, '222', '420', '2024-07-16', 'Ab aur nahi denge Paisa ', '2024-07-15 13:10:51', '2024-07-18 05:57:09', '300', '46456', 'Hiii', '2024-07-16', 2, '', NULL, ''),
(16, 'Ramesh', '9977985011', 'Professor', 10, 2, 4, 5, '3', '4', 'hostel found', 'CBK Technology', 500009, '2024-07-17', 'beach-3352363_960_720 (2).jpg', 'for collage hostel', 3, '500000', '420', '2024-07-17', 'gvnfhgjm', '2024-07-17 06:02:16', '2024-07-20 09:41:00', '67600', '67686', 'nggfjgf', '2024-07-17', 2, 'Hitesh', '2024-07-20', 'Raipur NCP'),
(17, 'Raja Sah', '887669850', 'deo', 10, 2, 4, 5, '3', '4', 'hostel found', 'CBK', 60000, '2024-07-17', 'beach-3352363_960_720 (3).jpg', 'ok de diye', 3, '500000', '4209', '2024-07-17', 'hii', '2024-07-17 06:32:12', '2024-07-20 07:44:30', '67600', '67686', 'hioii', '2024-07-17', 1, 'rolewfkoe', '2024-07-20', 'Raipur NIT GE. Road'),
(18, 'NIT Collage Raipur', '9977985099', 'Professor', 10, 1, 3, 6, '4', '1', 'Hostel Devlopment', 'Dk. Verma', 9000000, '2024-07-18', 'Screenshot (1).png', 'Nit Collage Devlopment Project', 3, '', '', NULL, '', '2024-07-18 06:22:15', '2024-07-20 08:25:15', '', '', '', NULL, 0, 'Hitesh', '2024-07-20', 'Raipur NCP'),
(19, 'NIT Collage Raipur', '1234567890', 'FullStack Dev', 10, 1, 3, 6, '4', '1', 'Hostel Devlopment', 'CBK Technology', 500009, '2024-07-19', 'Screenshot (1).png', '00', 3, '', '', NULL, '', '2024-07-19 10:16:34', '2024-07-20 08:23:06', '', '', '', NULL, 0, 'Hitesh', '2024-07-20', 'Raipur NIT GE. Road'),
(20, 'NIT Collage Raipur', '9988679866', 'Programmer', 10, 2, 4, 5, '3', '4', 'Hostel Devlopment', 'CBK Technology', 500009, '2024-07-19', 'Screenshot (1).png', '797jghn', 3, '', '', NULL, '', '2024-07-19 10:21:49', '2024-07-20 08:27:13', '', '', '', NULL, 0, 'Hitesh', '2024-07-20', 'Raipur NCP'),
(21, 'NIT Collage Raipur', '9988679866', 'Professor', 10, 1, 3, 6, '4', '1', 'Hostel Devlopment', 'CBK Technology', 500009, '2024-07-20', 'company_logo.png', 'ggf', 1, '500000', '000', '2024-07-22', 'm kjkl', '2024-07-20 11:17:01', '2024-07-22 06:10:18', '', '', '', NULL, 0, '', NULL, ''),
(22, 'Vinod', '9988679866', 'FullStack Dev', 10, 2, 4, 5, '3', '4', 'Hostel Devlopment', 'CBK Technology', 50000, '2024-07-22', '3112512.jpg', 'hihi', 3, '500000', '420', '2024-07-22', 'hii', '2024-07-22 12:49:54', '2024-07-22 12:52:15', '67600', '67686', 'kjhkjhb', '2024-07-22', 2, 'Hitesh', '2024-07-22', 'Raipur NCP');

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
(0, '9977679866', '', '', '9977679866', '', '2024-07-29 06:00:53'),
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
-- Indexes for table `aamantran`
--
ALTER TABLE `aamantran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `adminlogin`
--
ALTER TABLE `adminlogin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `charcha`
--
ALTER TABLE `charcha`
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
-- Indexes for table `protocol_details`
--
ALTER TABLE `protocol_details`
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
-- AUTO_INCREMENT for table `aamantran`
--
ALTER TABLE `aamantran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `adminlogin`
--
ALTER TABLE `adminlogin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `charcha`
--
ALTER TABLE `charcha`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
-- AUTO_INCREMENT for table `nirmaan`
--
ALTER TABLE `nirmaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `nirmaan_type_master`
--
ALTER TABLE `nirmaan_type_master`
  MODIFY `nirmaan_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `otps`
--
ALTER TABLE `otps`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sector_master`
--
ALTER TABLE `sector_master`
  MODIFY `sector_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `swekshanudan`
--
ALTER TABLE `swekshanudan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

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
