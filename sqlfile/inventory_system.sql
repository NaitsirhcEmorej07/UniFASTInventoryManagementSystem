-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 13, 2022 at 10:40 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `end_user_list_tbl`
--

CREATE TABLE `end_user_list_tbl` (
  `enduser_list_id` int(11) NOT NULL,
  `id_no` varchar(12) NOT NULL,
  `full_name` varchar(60) NOT NULL,
  `designation` varchar(40) NOT NULL,
  `unit` varchar(40) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `end_user_list_tbl`
--

INSERT INTO `end_user_list_tbl` (`enduser_list_id`, `id_no`, `full_name`, `designation`, `unit`, `status`) VALUES
(41, '16-101', 'CHRISTIAN JEROME M. ESPEÑA', 'PROJECT TECHNICAL STAFF 1', 'ICT UNIT', 'ACTIVE'),
(44, '16-102', 'FROILAN L. BOHOL', 'PROJECT TECHNICAL STAFF 1', 'ICT UNIT', 'ACTIVE'),
(45, '16-103', 'JOHN REIMAN CANCINO', 'PROJECT TECHNICAL STAFF 1', 'ICT UNIT', 'ACTIVE'),
(46, '16-104', 'RYAN R. TOBIAS', 'PROJECT TECHNICAL STAFF 1', 'ICT UNIT', 'ACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `end_user_tbl`
--

CREATE TABLE `end_user_tbl` (
  `enduser_id` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `serial_number` varchar(20) NOT NULL,
  `inventory_item_number` varchar(20) NOT NULL,
  `ics_number` varchar(20) NOT NULL,
  `end_user` varchar(90) NOT NULL,
  `unit` varchar(36) NOT NULL,
  `date_received` date NOT NULL,
  `is_assigned` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `end_user_tbl`
--

INSERT INTO `end_user_tbl` (`enduser_id`, `id`, `serial_number`, `inventory_item_number`, `ics_number`, `end_user`, `unit`, `date_received`, `is_assigned`) VALUES
(171, 20220053, 'KMTK26001', 'IT-2022-0001', 'ICS-2022-0001', 'CHRISTIAN JEROME M. ESPEÑA', 'ICT UNIT', '2022-09-02', 1),
(172, 20220053, 'KMTK26002', 'IT-2022-0002', 'ICS-2022-0002', 'FROILAN L. BOHOL', 'ICT UNIT', '2022-09-08', 1),
(173, 20220053, 'KMTK26003', 'IT-2022-0003', 'ICS-2022-0003', 'JOHN REIMAN CANCINO', 'ICT UNIT', '2022-09-15', 1),
(176, 20220053, 'KMTK26004', 'IT-2022-0004', 'ICS-2022-0004', 'RYAN R. TOBIAS', 'ICT UNIT', '2022-09-21', 1),
(177, 20220054, 'OPSK26001', 'IT-2022-1001', 'ICS-2022-1001', 'CHRISTIAN JEROME M. ESPEÑA', 'ICT UNIT', '2022-09-15', 1);

-- --------------------------------------------------------

--
-- Table structure for table `inventory_tbl`
--

CREATE TABLE `inventory_tbl` (
  `id` int(11) NOT NULL,
  `item` varchar(60) NOT NULL,
  `item_description` varchar(400) NOT NULL,
  `quantity` int(6) NOT NULL,
  `unit` varchar(30) NOT NULL,
  `unit_cost` double NOT NULL,
  `received_from` varchar(69) NOT NULL,
  `received_by` varchar(69) NOT NULL,
  `date_acquired` date NOT NULL,
  `supplier` varchar(70) NOT NULL,
  `supplier_contact` varchar(22) NOT NULL,
  `supplier_warranty` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inventory_tbl`
--

INSERT INTO `inventory_tbl` (`id`, `item`, `item_description`, `quantity`, `unit`, `unit_cost`, `received_from`, `received_by`, `date_acquired`, `supplier`, `supplier_contact`, `supplier_warranty`) VALUES
(20220053, 'CANON PRINTER', 'CANON PIXMA G3020', 4, 'UNIT', 10999, 'MARIA CHARINNA', 'CHRISTIAN JEROME ESPEÑA', '2022-08-05', 'MACRO LOGIC', '09123112535', '3 YEARS WARRANTY3'),
(20220054, 'SSD EXTERNAL STORAGE', '1TB, SSD, KINGSTON COLOR BLUE, USB TO TYPE C', 1, 'PCS', 4999, 'MARIA CHARINNA', 'RYAN L. ESTEVEZ', '2022-09-10', 'PC WORKS', '09213661234', '1 YEAR WARRANTY');

-- --------------------------------------------------------

--
-- Table structure for table `user_tbl`
--

CREATE TABLE `user_tbl` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_tbl`
--

INSERT INTO `user_tbl` (`id`, `username`, `password`, `status`) VALUES
(1, 'admin123', 'admin123', 0),
(2, 'NAITSIRHC', 'NAITSIRHC', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `end_user_list_tbl`
--
ALTER TABLE `end_user_list_tbl`
  ADD PRIMARY KEY (`enduser_list_id`);

--
-- Indexes for table `end_user_tbl`
--
ALTER TABLE `end_user_tbl`
  ADD PRIMARY KEY (`enduser_id`);

--
-- Indexes for table `inventory_tbl`
--
ALTER TABLE `inventory_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_tbl`
--
ALTER TABLE `user_tbl`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `end_user_list_tbl`
--
ALTER TABLE `end_user_list_tbl`
  MODIFY `enduser_list_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `end_user_tbl`
--
ALTER TABLE `end_user_tbl`
  MODIFY `enduser_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=178;

--
-- AUTO_INCREMENT for table `inventory_tbl`
--
ALTER TABLE `inventory_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20220055;

--
-- AUTO_INCREMENT for table `user_tbl`
--
ALTER TABLE `user_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
