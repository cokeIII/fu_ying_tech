-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 02, 2021 at 01:11 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fu_ying_tech`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `company_code` text NOT NULL,
  `id` int(11) NOT NULL,
  `tax_id` varchar(13) NOT NULL,
  `company_name` text NOT NULL,
  `website` text NOT NULL,
  `payment` int(11) NOT NULL,
  `company_address` text NOT NULL,
  `contact_person` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `fu_ying_tech`
--

CREATE TABLE `fu_ying_tech` (
  `id` int(11) NOT NULL,
  `tax_id` text NOT NULL,
  `website` text NOT NULL,
  `company_address` text NOT NULL,
  `contact_person` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fu_ying_tech`
--

INSERT INTO `fu_ying_tech` (`id`, `tax_id`, `website`, `company_address`, `contact_person`) VALUES
(1, '0105557027270', 'www.fytthailand.com', '[{\"companyAddress\":\"511/67 Srinakarin Rd., Suanluang Suanluang Bangkok 10250 Thailand\",\"tel\":\"0821873751\"}]', '[{\"dept\":\"General Manager\",\"PersonName\":\"Jack Johnson\",\"nickName\":\"อี้\",\"personTel\":\"08817611858\",\"personEmail\":\"sywang@fytthailand.com\",\"personLine\":\"\",\"personWechat\":\"\"}]');

-- --------------------------------------------------------

--
-- Table structure for table `part`
--

CREATE TABLE `part` (
  `part_no` varchar(10) NOT NULL,
  `part_name` text NOT NULL,
  `unit` text NOT NULL,
  `part_description` text NOT NULL,
  `unit_price` float NOT NULL,
  `img` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `quotation`
--

CREATE TABLE `quotation` (
  `quo_no` varchar(20) NOT NULL,
  `part_no` varchar(10) NOT NULL,
  `quo_to` text NOT NULL,
  `quo_attn` text NOT NULL,
  `quo_from` text NOT NULL,
  `quo_contact` text NOT NULL,
  `quo_date` date NOT NULL,
  `delivery` int(11) NOT NULL,
  `term_of_payment` int(11) NOT NULL,
  `shipment` text NOT NULL,
  `qty` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fu_ying_tech`
--
ALTER TABLE `fu_ying_tech`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `part`
--
ALTER TABLE `part`
  ADD PRIMARY KEY (`part_no`);

--
-- Indexes for table `quotation`
--
ALTER TABLE `quotation`
  ADD PRIMARY KEY (`quo_no`,`part_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `fu_ying_tech`
--
ALTER TABLE `fu_ying_tech`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
