-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 22, 2024 at 09:25 AM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `user_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `admin_id` int NOT NULL AUTO_INCREMENT,
  `admin_name` varchar(255) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `admin_password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `date_hired` date NOT NULL,
  `admin_lived` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_name`, `admin_email`, `admin_password`, `date_hired`, `admin_lived`) VALUES
(2, 'Test admin', 'admin@gmail.com', 'f925916e2754e5e03f75dd58a5733251', '2024-11-19', 'Tupi, South Cotabato');

-- --------------------------------------------------------

--
-- Table structure for table `chosenseats`
--

DROP TABLE IF EXISTS `chosenseats`;
CREATE TABLE IF NOT EXISTS `chosenseats` (
  `id` int NOT NULL AUTO_INCREMENT,
  `concertid` int NOT NULL,
  `seatid` int NOT NULL,
  `seatnames` varchar(255) NOT NULL,
  `status` enum('Available','Reserved','Taken') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `concertid` (`concertid`),
  KEY `seatid` (`seatid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `chosenseats`
--

INSERT INTO `chosenseats` (`id`, `concertid`, `seatid`, `seatnames`, `status`) VALUES
(1, 1, 26, 'B - VIP', 'Taken');

-- --------------------------------------------------------

--
-- Table structure for table `seats`
--

DROP TABLE IF EXISTS `seats`;
CREATE TABLE IF NOT EXISTS `seats` (
  `seatid` int NOT NULL AUTO_INCREMENT,
  `seatname` varchar(255) NOT NULL,
  `section` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `status` enum('Available','Reserved','Taken') DEFAULT 'Available',
  PRIMARY KEY (`seatid`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `seats`
--

INSERT INTO `seats` (`seatid`, `seatname`, `section`, `price`, `status`) VALUES
(1, 'A-GA', 'General Admission', '50.00', 'Available'),
(2, 'B-GA', 'General Admission', '50.00', 'Available'),
(3, 'C-GA', 'General Admission', '50.00', 'Available'),
(4, 'D-GA', 'General Admission', '50.00', 'Available'),
(5, 'E-GA', 'General Admission', '50.00', 'Available'),
(6, 'F-GA', 'General Admission', '50.00', 'Available'),
(7, 'G-GA', 'General Admission', '50.00', 'Available'),
(8, 'H-GA', 'General Admission', '50.00', 'Available'),
(9, 'I-GA', 'General Admission', '50.00', 'Available'),
(10, 'J-GA', 'General Admission', '50.00', 'Available'),
(11, 'K-GA', 'General Admission', '50.00', 'Available'),
(12, 'A-UB', 'Upper Bowl', '75.00', 'Available'),
(13, 'B-UB', 'Upper Bowl', '75.00', 'Available'),
(14, 'C-UB', 'Upper Bowl', '75.00', 'Available'),
(15, 'D-UB', 'Upper Bowl', '75.00', 'Available'),
(16, 'E-UB', 'Upper Bowl', '75.00', 'Available'),
(17, 'F-UB', 'Upper Bowl', '75.00', 'Available'),
(18, 'G-UB', 'Upper Bowl', '75.00', 'Available'),
(19, 'A-LB', 'Lower Bowl', '100.00', 'Available'),
(20, 'B-LB', 'Lower Bowl', '100.00', 'Available'),
(21, 'C-LB', 'Lower Bowl', '100.00', 'Available'),
(22, 'D-LB', 'Lower Bowl', '100.00', 'Available'),
(23, 'E-LB', 'Lower Bowl', '100.00', 'Available'),
(24, 'F-LB', 'Lower Bowl', '100.00', 'Available'),
(25, 'A', 'VIP', '123.00', 'Available'),
(26, 'B', 'VIP', '123.00', 'Available'),
(27, 'C', 'VIP', '123.00', 'Available');

-- --------------------------------------------------------

--
-- Table structure for table `tblbuyer`
--

DROP TABLE IF EXISTS `tblbuyer`;
CREATE TABLE IF NOT EXISTS `tblbuyer` (
  `buyer_id` int NOT NULL AUTO_INCREMENT,
  `buyer_name` varchar(255) NOT NULL,
  `buyer_chosenseats` varchar(255) NOT NULL,
  `payment_mode` varchar(50) NOT NULL,
  `buyer_phonenum` varchar(20) NOT NULL,
  `concert_name` varchar(255) NOT NULL,
  `concert_date` date NOT NULL,
  `tickets_qty` int NOT NULL,
  `payment_date` date NOT NULL,
  `transaction_no` varchar(255) NOT NULL,
  `payment_price` decimal(10,2) NOT NULL,
  `status` varchar(50) NOT NULL,
  `concert_id` int NOT NULL,
  PRIMARY KEY (`buyer_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tblbuyer`
--

INSERT INTO `tblbuyer` (`buyer_id`, `buyer_name`, `buyer_chosenseats`, `payment_mode`, `buyer_phonenum`, `concert_name`, `concert_date`, `tickets_qty`, `payment_date`, `transaction_no`, `payment_price`, `status`, `concert_id`) VALUES
(2, 'TEST FULL NAME', 'B - VIP', 'Cash', '09262408442', 'Test', '2024-11-21', 1, '2024-11-22', 'TXN113760', '123.00', 'Paid', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblconcert`
--

DROP TABLE IF EXISTS `tblconcert`;
CREATE TABLE IF NOT EXISTS `tblconcert` (
  `concert_id` int NOT NULL AUTO_INCREMENT,
  `concert_name` varchar(100) NOT NULL,
  `concert_date` date NOT NULL,
  `concert_time` time NOT NULL,
  `concert_artist` varchar(50) NOT NULL,
  `concert_desc` text NOT NULL,
  `concert_genre` varchar(20) NOT NULL,
  `concert_venue` varchar(100) NOT NULL,
  `ub_price` decimal(10,2) NOT NULL,
  `lb_price` decimal(10,2) NOT NULL,
  `vip_price` decimal(10,2) NOT NULL,
  `genad_price` decimal(10,2) NOT NULL,
  `concert_contact` varchar(250) NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`concert_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tblconcert`
--

INSERT INTO `tblconcert` (`concert_id`, `concert_name`, `concert_date`, `concert_time`, `concert_artist`, `concert_desc`, `concert_genre`, `concert_venue`, `ub_price`, `lb_price`, `vip_price`, `genad_price`, `concert_contact`, `image`) VALUES
(1, 'Test', '2024-11-21', '01:00:00', 'qwe', 'qwe', 'qwe', 'qwe', '123.00', '123.00', '123.00', '123.00', 'qwe@gmail.com', 'pixelated_avatar.png'),
(2, 'HAHAH', '2024-11-23', '05:21:00', 'hahaha', 'qwejqowjdlasd', 'Rock', 'JASDKLAS', '1000.00', '2000.00', '1000.00', '1000.00', 'HAHAH@GMAIL.COM', 'pixelated_avatar.png');

-- --------------------------------------------------------

--
-- Table structure for table `tblpayment`
--

DROP TABLE IF EXISTS `tblpayment`;
CREATE TABLE IF NOT EXISTS `tblpayment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `userid` int NOT NULL,
  `cardnum` varchar(16) NOT NULL,
  `cardholder` varchar(255) NOT NULL,
  `monthexp` varchar(2) NOT NULL,
  `yearexp` varchar(4) NOT NULL,
  `cvv` varchar(4) NOT NULL,
  `cardtype` varchar(50) NOT NULL,
  `status` varchar(50) DEFAULT 'Unlinked',
  `pin` varchar(8) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_form`
--

DROP TABLE IF EXISTS `user_form`;
CREATE TABLE IF NOT EXISTS `user_form` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `phonenum` varchar(11) NOT NULL,
  `address` varchar(100) NOT NULL,
  `accdate` datetime NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user_form`
--

INSERT INTO `user_form` (`id`, `username`, `email`, `password`, `fullname`, `dob`, `phonenum`, `address`, `accdate`, `image`) VALUES
(2, 'Test@123', 'test2@gmail.com', 'f925916e2754e5e03f75dd58a5733251', 'TEST FULL NAME', '2024-11-22', '09262408442', 'Prk. Sampaguita Poblacion Of Sto Nino South Cotabato', '2024-11-22 08:12:39', 'boy.png');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
