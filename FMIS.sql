-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 16, 2016 at 11:21 AM
-- Server version: 5.5.49-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `FMIS`
--

-- --------------------------------------------------------

--
-- Table structure for table `access_lvl`
--

CREATE TABLE IF NOT EXISTS `access_lvl` (
  `access_id` int(11) NOT NULL AUTO_INCREMENT,
  `access_name` varchar(20) DEFAULT NULL,
  `description` mediumtext,
  `user_id` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`access_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `access_lvl`
--

INSERT INTO `access_lvl` (`access_id`, `access_name`, `description`, `user_id`) VALUES
(1, 'normal user', 'Only add records', NULL),
(2, 'Manager', 'Add and view view records', NULL),
(3, 'Administrator', 'View records and Manage them', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE IF NOT EXISTS `employees` (
  `emp_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `first_name` varchar(60) DEFAULT NULL,
  `middle_name` varchar(60) DEFAULT NULL,
  `last_name` varchar(60) DEFAULT NULL,
  `department` varchar(60) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `phone_number` int(11) DEFAULT NULL,
  PRIMARY KEY (`emp_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`emp_id`, `user_id`, `first_name`, `middle_name`, `last_name`, `department`, `email`, `phone_number`) VALUES
(1, 0, 'Dee', 'Lewinsky', 'Maraj', 'Educational Technology', 'deelewisky@gmail.com', 2147483647),
(2, 0, 'deedee', 'barbz', 'minaj', 'ICT Services', 'deebarbz@gmail.com', 2147483647),
(3, 0, 'trdfyy', 'gdhgdh', 'hjffyjfy', 'Educational Technology', 'wills9324@gmail.com', 636647865),
(4, 0, 'nzxjxnx', 'kjnqjxh', 'xxjkxhi', 'Educational Technology', 'wills9324@gmail.com', 2147483647),
(5, 0, 'Doric', 'Manyama', 'Ruhusa', 'Educational Technology', 'johnbaraka12@gmail.com', 2147483647),
(6, 0, 'annaz', 'michael', 'nznxzjna', 'Educational Technology', 'wills9324@gmail.com', 2147483647),
(7, 0, 'poswokdo', 'jiswhdiwh', 'sdwxcskljs', 'Educational Technology', 'wills9324@gmail.com', 388910702),
(8, 0, 'Dee', 'william', 'nzzsxias', 'Educational Technology', 'missdee@gmail.com', 286219832),
(9, 0, 'gujkgug', 'kjnqjxh', 'fyfygg', 'Educational Technology', 'god@gmail.com', 549977),
(10, 0, 'wqiohwqd', 'wqxnwkxwq', 'wdxnkwsn', 'Educational Technology', 'williamwaneno@yahoo.com', 2147483647);

-- --------------------------------------------------------

--
-- Table structure for table `expenditure`
--

CREATE TABLE IF NOT EXISTS `expenditure` (
  `exp_id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) DEFAULT NULL,
  `exp_name` varchar(100) DEFAULT NULL,
  `otherExp` varchar(100) DEFAULT NULL,
  `description` mediumtext,
  `amount` int(11) NOT NULL,
  `payee` varchar(60) NOT NULL,
  `receipt_no` varchar(60) NOT NULL,
  `record_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`exp_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `expenditure`
--

INSERT INTO `expenditure` (`exp_id`, `employee_id`, `exp_name`, `otherExp`, `description`, `amount`, `payee`, `receipt_no`, `record_date`) VALUES
(1, 0, 'Payment of wages/salary', '', ' Payment to volunteers', 765432, 'Matoke', '1234TRY', '2016-08-30 21:00:00'),
(2, 0, 'Payment of wages/salary', '', 'Payment to emp[loyees', 1234567, 'Majura Manyama', '456HTYRE', '2016-08-30 21:00:00'),
(3, 0, 'Purchase of clean items', '', 'For computer center ares at main campus', 567890, 'Aman shop', '786TTREY', '2016-08-30 21:00:00'),
(4, 0, 'other', 'lugole ceremony', 'taken on july this year	  ', 456722, 'Lugpole', '34566672', '2016-09-02 21:00:00'),
(5, 0, 'other', 'I will delete this', 'Get some prooveness		  ', 67223, 'me', '67891', '2016-09-03 21:00:00'),
(6, 0, 'Purchase of Equipments', '', '		  somthing', 456788, 'juma', '345tt', '2016-09-06 21:00:00'),
(7, 0, 'Payment of wages/salary', '', 'today', 5673, 'horse', '3557t', '2016-09-06 21:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `income`
--

CREATE TABLE IF NOT EXISTS `income` (
  `income_id` int(11) NOT NULL AUTO_INCREMENT,
  `iemployee_id` int(11) DEFAULT NULL,
  `income_name` varchar(42) DEFAULT NULL,
  `otherIncome` varchar(100) DEFAULT NULL,
  `idescription` text,
  `iamount` int(11) NOT NULL,
  `payer` varchar(60) NOT NULL,
  `ireceipt_no` varchar(60) NOT NULL,
  `irecord_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`income_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `income`
--

INSERT INTO `income` (`income_id`, `iemployee_id`, `income_name`, `otherIncome`, `idescription`, `iamount`, `payer`, `ireceipt_no`, `irecord_date`) VALUES
(1, 0, 'Payment of Milage', '', '		  Mororgoro to Dar-es-salaam	  ', 567009, 'Athuman', 'TTY6678HG', '2016-08-30 21:00:00'),
(2, 0, 'other', 'Grant from the Gov', ' Just Grants fro central goeverment', 45623890, 'Government', '6754322FDSR', '2016-09-03 21:00:00'),
(3, 0, 'Short Course', ' ?>', '		  some notes', 45623890, 'muyenjwa', '455j', '2016-09-06 21:00:00'),
(4, 0, 'Hiring of Facilities', ' ?>', 'hiring', 45623890, 'john', '567yy', '2016-09-06 21:00:00'),
(5, 0, 'Short Course', ' ?>', '		   COURSE', 34521367, 'baraka', '456g', '2016-09-14 21:00:00'),
(6, 0, 'Training', ' ?>', 'For teaching	  ', 456723, 'Matoke', '45673dt', '2016-09-14 21:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `invetory`
--

CREATE TABLE IF NOT EXISTS `invetory` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `item_name` varchar(60) DEFAULT NULL,
  `item_category` varchar(60) DEFAULT NULL,
  `work_status` varchar(20) DEFAULT NULL,
  `item_value` int(11) NOT NULL,
  `location` varchar(60) DEFAULT NULL,
  `department` varchar(60) DEFAULT NULL,
  `custodian` varchar(60) DEFAULT NULL,
  `confirmed` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`item_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `invetory`
--

INSERT INTO `invetory` (`item_id`, `user_id`, `item_name`, `item_category`, `work_status`, `item_value`, `location`, `department`, `custodian`, `confirmed`) VALUES
(1, 2, 'Cables cut 6', 'Electronic Equipment', 'Good', 4563, 'Solomon Malangu Campus(SMC)', 'ICT Services', 'Mr. Mahenge', 1),
(2, 2, 'Desktop Computers', 'Electronic Equipment', 'Good', 56743215, 'Main Campus', 'Educational Technology', 'Dr. Churi (Acting Directo)', 1),
(3, 1, 'Laptops', 'Electronic Equipment', 'Good', 123456787, 'Solomon Malangu Campus(SMC)', 'Training Department', 'Dr. Magesa', 0),
(4, 2, 'ttcl phone', 'Electronic Equipment', 'Good', 786662222, 'Solomon Malangu Campus(SMC)', 'ICT Services', 'Kilima', 1);

-- --------------------------------------------------------

--
-- Table structure for table `profileimage`
--

CREATE TABLE IF NOT EXISTS `profileimage` (
  `img_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `img_code` varchar(10) NOT NULL,
  `img_name` varchar(255) DEFAULT NULL,
  `img_dir_name` varchar(8) DEFAULT NULL,
  PRIMARY KEY (`img_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `profileimage`
--

INSERT INTO `profileimage` (`img_id`, `user_id`, `img_code`, `img_name`, `img_dir_name`) VALUES
(1, 2, 'hp2KCr4s', 'Agripnah_kljs_20160307_125444.jpg', 'FNJdcZ7G');

-- --------------------------------------------------------

--
-- Table structure for table `record`
--

CREATE TABLE IF NOT EXISTS `record` (
  `record_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `income_id` int(11) NOT NULL DEFAULT '0',
  `exp_id` int(11) NOT NULL DEFAULT '0',
  `fcategory` varchar(50) NOT NULL,
  `confirmed` tinyint(4) DEFAULT '0',
  `trush` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`record_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `record`
--

INSERT INTO `record` (`record_id`, `user_id`, `income_id`, `exp_id`, `fcategory`, `confirmed`, `trush`) VALUES
(2, 2, 1, 0, 'income category', 1, 1),
(3, 2, 0, 2, 'exp category', 1, 0),
(4, 1, 0, 3, 'exp category', 1, 0),
(6, 2, 2, 0, 'income category', 1, 0),
(8, 2, 3, 0, 'income category', 1, 1),
(10, 15, 0, 6, 'exp category', 1, 1),
(11, 15, 0, 7, 'exp category', 1, 1),
(12, 2, 5, 0, 'income category', 1, 1),
(13, 2, 6, 0, 'income category', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(40) DEFAULT NULL,
  `middle_name` varchar(40) DEFAULT NULL,
  `last_name` varchar(40) DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL,
  `username` varchar(60) DEFAULT NULL,
  `password` char(42) DEFAULT NULL,
  `access_lvl` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `middle_name`, `last_name`, `category`, `username`, `password`, `access_lvl`) VALUES
(1, 'Baraka', 'John', 'Muyenjwa', 'Educational Technology', 'johnbaraka12@gmail.com', 'f807e1cc28742a01a08a110278cf977cb75bee1c', 1),
(2, 'Matoke', 'John', 'Masatu', 'Training department', 'matoke@gmail.com', 'bfc440ee4fef410facd0459c3d871e31076d0705', 3),
(9, 'Dee', 'Baraka', 'Matoke', 'ICT Services', 'wills9324@gmail.com', '5d0d9c532aac0ec26f0c38ab6692e084b1c8c258', 2),
(16, 'adriano', 'Baraka', 'Mtemela', 'Educational Technology', 'amtemela@gmail.com', '2fe44e38f734b89ef9ea5dde19dc04ee578aa1c4', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
