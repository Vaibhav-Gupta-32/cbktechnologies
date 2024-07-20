-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 13, 2024 at 02:43 PM
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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `adminlogin`
--

INSERT INTO `adminlogin` (`id`, `username`, `password`, `email`, `salt`, `created_at`) VALUES
(1, 'admin', 'MTIz', 'admin@gmail.com', '123', '2024-07-05 05:29:29');

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
(3, 'Mujagahan', 0, 10, 1, 3, 5);

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
(4, 'Mujgahan', 3, 1, 10, 6);

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
  `status` int(11) NOT NULL DEFAULT 0,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `swekshanudan`
--

INSERT INTO `swekshanudan` (`id`, `name`, `phone_number`, `designation`, `district_id`, `vidhansabha_id`, `vikaskhand_id`, `sector_id`, `gram_panchayat_id`, `gram_id`, `subject`, `reference`, `expectations_amount`, `application_date`, `file_upload`, `comment`, `status`, `create_date`, `update_date`) VALUES
(8, 'Lomash Rishi', '9977679866', 'FullStack Dev', 10, 1, 3, 4, '', '', 'Devlopment', 'CBK', 50000, '2024-07-11', 'tree-736885_640.jpg', 'Mobile App devlopment', 4, '2024-07-11 09:06:22', '2024-07-13 12:30:41'),
(9, 'Lomash Rishi', '9977679866', 'FullStack Dev', 10, 1, 3, 4, '', '', 'Devlopment', 'CBK', 50000, '2024-07-11', 'tree-736885_640.jpg', 'Mobile App devlopment', 1, '2024-07-11 09:10:23', '2024-07-13 12:25:40'),
(10, 'Lomash Rishi', '9977679866', 'FullStack Dev', 10, 1, 3, 6, '4', '1', 'Devlopment', 'CBK', 50000, '2024-07-11', 'tree-736885_640.jpg', 'For Ne Project', 1, '2024-07-11 09:22:11', '2024-07-13 12:12:50');

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
(1, 'Abcd'),
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
  MODIFY `gram_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `gram_panchayat_master`
--
ALTER TABLE `gram_panchayat_master`
  MODIFY `gram_panchayat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sector_master`
--
ALTER TABLE `sector_master`
  MODIFY `sector_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `swekshanudan`
--
ALTER TABLE `swekshanudan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

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
