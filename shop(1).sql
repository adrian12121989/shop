-- phpMyAdmin SQL Dump
-- version 4.4.13.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 14, 2016 at 11:00 AM
-- Server version: 5.6.31-0ubuntu0.15.10.1
-- PHP Version: 5.6.11-1ubuntu3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `access_lvl`
--

CREATE TABLE IF NOT EXISTS `access_lvl` (
  `access_id` int(11) NOT NULL,
  `access_name` varchar(20) DEFAULT NULL,
  `description` mediumtext,
  `user_id` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `access_lvl`
--

INSERT INTO `access_lvl` (`access_id`, `access_name`, `description`, `user_id`) VALUES
(1, 'normal user', 'Only add records', NULL),
(2, 'Manager', 'Add and view view records', NULL),
(3, 'Administrator', 'View records and Manage them', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `borrow`
--

CREATE TABLE IF NOT EXISTS `borrow` (
  `borrow_id` int(11) NOT NULL,
  `buser_id` tinyint(4) DEFAULT NULL,
  `bname` varchar(60) DEFAULT NULL,
  `bamount` varchar(60) DEFAULT NULL,
  `bpurpose` varchar(60) DEFAULT NULL,
  `bregistered_by` varchar(60) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `confirm` tinyint(4) DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `borrow`
--

INSERT INTO `borrow` (`borrow_id`, `buser_id`, `bname`, `bamount`, `bpurpose`, `bregistered_by`, `date`, `confirm`) VALUES
(1, 10, '1', '114500', 'hhhh', 'Ayubu Churi', '2016-10-20 09:10:12', 1),
(2, 7, '4', '350000', 'daineth borrowed this kind of money', 'dora nyamwihula', '2016-10-12 13:27:00', 1),
(3, 8, '2', '600000', 'amekopa simu aina ya j4', 'adrian mtemela', '2016-11-10 13:44:04', 1),
(4, 8, '3', '1000000', 'nokia 200', 'adrian mtemela', '2016-11-10 13:46:16', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `device`
--

CREATE TABLE IF NOT EXISTS `device` (
  `dev_id` int(11) NOT NULL,
  `duser_id` int(11) NOT NULL,
  `dev_name` varchar(100) NOT NULL,
  `dev_number` varchar(50) NOT NULL,
  `dev_warranty` varchar(50) NOT NULL,
  `dev_imei` varchar(200) NOT NULL,
  `dev_price` int(100) NOT NULL,
  `dev_confirm` int(11) NOT NULL DEFAULT '0',
  `dev_status` varchar(20) NOT NULL,
  `sold` int(11) NOT NULL DEFAULT '0',
  `sold_amount` int(200) NOT NULL DEFAULT '0',
  `selcom` varchar(250) NOT NULL DEFAULT 'None',
  `sold_by` varchar(50) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `cphone` int(11) NOT NULL,
  `cemail` varchar(100) NOT NULL DEFAULT 'None',
  `sold_date` varchar(20) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `registered_by` varchar(100) NOT NULL,
  `dev_date` varchar(20) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `device`
--

INSERT INTO `device` (`dev_id`, `duser_id`, `dev_name`, `dev_number`, `dev_warranty`, `dev_imei`, `dev_price`, `dev_confirm`, `dev_status`, `sold`, `sold_amount`, `selcom`, `sold_by`, `fname`, `lname`, `cphone`, `cemail`, `sold_date`, `registered_by`, `dev_date`) VALUES
(1, 2, 'iphone', 'iphone7', '6-12 Months', '2323445576778788888999990', 2000000, 1, 'New', 0, 0, 'None', '', '', '', 0, 'None', '', 'adrian, mtemela', '2016-12-08 13:27:40'),
(2, 2, 'iphone', 'iphone7 plus', '6-12 Months', '235366578906846869707', 3200000, 1, 'New', 0, 0, 'None', '', '', '', 0, 'None', '', 'adrian, mtemela', '2016-12-08 13:35:18'),
(4, 2, 'Huawei', 'y300', '0-5 Months', '1246809976540986', 150000, 1, 'Good', 1, 170000, 'tigopesa 2342524234225', 'catherine,mahimbo', 'husna', 'kidoti', 2147483647, 'husna@gmail.com', '2016-12-11 16:51:38', 'adrian, mtemela', '2016-12-08 13:44:17'),
(5, 2, 'Huawei', 'y305', '1-3 Years', '1446879035784', 130000, 1, 'New', 1, 140000, 'None', 'prince,octavian', 'frank', 'fute', 2147483647, 'frank@gmail.com', '2016-12-08 17:45:11', 'adrian, mtemela', '2016-12-08 13:46:09'),
(6, 2, 'samsung', 's2', '0-5 Months', '1237087753453636788', 150000, 1, 'New', 1, 160000, 'None', 'catherine,mahimbo', 'frank', 'kahuta', 2147483647, 'None', '2016-12-11 00:25:25', 'adrian, mtemela', '2016-12-08 13:47:11'),
(7, 2, 'sony xperia', 'z3', '6-12 Months', '2356789000764321', 600000, 1, 'New', 1, 610000, 'None', 'prince,octavian', 'edgar', 'pastory', 2147483647, 'edgar@gmail.com', '2016-12-08 17:36:32', 'adrian, mtemela', '2016-12-08 13:49:06'),
(8, 2, 'sony', 'x3', '0-5 Months', '1237087753453636788', 2300000, 1, 'Good', 1, 2400000, 'None', 'prince,octavian', 'kanijo', 'john', 2147483647, 'kanijo@gmail.com', '2016-12-12 09:05:07', 'adrian, mtemela', '2016-12-11 00:30:25'),
(9, 2, 'techno', 'j8', '1-3 Years', '13452423425245614322', 350000, 1, 'New', 1, 400000, 'None', 'prince,octavian', 'queen', 'majaliwa', 2147483647, 'queen@gmail.com', '2016-12-12 11:14:03', 'adrian, mtemela', '2016-12-11 17:32:06'),
(10, 14, 'techno', 'phantoom3', '6-12 Months', '235366578906846869707', 198000, 1, 'New', 0, 0, 'None', '', '', '', 0, 'None', '', 'catherine, mahimbo', '2016-12-12 11:43:49');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE IF NOT EXISTS `employees` (
  `emp_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `first_name` varchar(60) DEFAULT NULL,
  `middle_name` varchar(60) DEFAULT NULL,
  `last_name` varchar(60) DEFAULT NULL,
  `position` varchar(50) NOT NULL,
  `phone_number` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`emp_id`, `user_id`, `first_name`, `middle_name`, `last_name`, `position`, `phone_number`) VALUES
(1, 14, 'dorthy', 'willium', 'nyamwihula', 'Admin', 767567432),
(3, 2, 'adriano', 'octavian', 'mtemela', 'Seller', 712854114);

-- --------------------------------------------------------

--
-- Table structure for table `exp`
--

CREATE TABLE IF NOT EXISTS `exp` (
  `exp_id` int(11) NOT NULL,
  `euser_id` int(11) NOT NULL,
  `exp_name` varchar(50) NOT NULL,
  `payee_name` varchar(200) NOT NULL,
  `amount` int(11) NOT NULL,
  `exp_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `exp_by` varchar(100) NOT NULL,
  `confirm` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exp`
--

INSERT INTO `exp` (`exp_id`, `euser_id`, `exp_name`, `payee_name`, `amount`, `exp_date`, `exp_by`, `confirm`) VALUES
(1, 2, 'salary', 'frank daniel', 200000, '2016-12-08 11:04:46', 'adrian mtemela', 1),
(2, 2, 'buying cleaning items', 'market', 350000, '2016-12-08 12:55:05', 'adrian mtemela', 1),
(3, 2, 'tax', 'tra', 78000, '2016-12-08 13:17:56', 'adrian mtemela', 1),
(4, 2, 'rent tax', 'tra', 1200000, '2016-12-08 13:19:33', 'adrian mtemela', 1),
(5, 2, 'food', 'mama anna', 3000, '2016-12-08 13:20:08', 'adrian mtemela', 1),
(6, 2, 'transport', 'selina joanitha', 7000, '2016-12-08 13:20:40', 'adrian mtemela', 1),
(7, 14, 'transport', 'hulian', 30000, '2016-12-12 09:06:19', 'catherine mahimbo', 1);

-- --------------------------------------------------------

--
-- Table structure for table `expenditure`
--

CREATE TABLE IF NOT EXISTS `expenditure` (
  `exp_id` int(11) NOT NULL,
  `employee_id` tinyint(4) DEFAULT NULL,
  `exp_name` varchar(100) DEFAULT NULL,
  `otherExp` varchar(100) DEFAULT NULL,
  `description` mediumtext,
  `amount` varchar(60) NOT NULL,
  `payee` varchar(60) NOT NULL,
  `receipt_no` varchar(60) NOT NULL,
  `record_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `eregistered_by` varchar(60) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `expenditure`
--

INSERT INTO `expenditure` (`exp_id`, `employee_id`, `exp_name`, `otherExp`, `description`, `amount`, `payee`, `receipt_no`, `record_date`, `eregistered_by`) VALUES
(1, 0, 'Purchase of Equipments', '', 'New equipments were purchased	  ', '1500000', 'Naomi', 'AC/ITCB/001', '2016-10-04 19:02:16', 'adrian mtemela'),
(2, 0, 'Purchase of Equipments', '', 'Purchasing of new materials		  ', '130000', 'Derick', 'AC/ITCB/001', '2016-10-05 06:27:28', 'dora nyamwihula'),
(3, 0, 'Payment of wages/salary', '', 'Salary payed for networking job 		  ', '800000', 'Cassandra', 'AC/ITCB/001', '2016-10-05 06:28:22', 'dora nyamwihula'),
(4, 0, 'Payment of wages/salary', '', '		  dqdsd', '340000', 'derick', 'acdgfe', '2016-11-10 13:53:46', 'adrian, mtemela');

-- --------------------------------------------------------

--
-- Table structure for table `income`
--

CREATE TABLE IF NOT EXISTS `income` (
  `income_id` int(11) NOT NULL,
  `iemployee_id` tinyint(4) DEFAULT NULL,
  `income_name` varchar(42) DEFAULT NULL,
  `otherIncome` varchar(100) DEFAULT NULL,
  `idescription` text,
  `iamount` varchar(60) NOT NULL,
  `payer` varchar(60) NOT NULL,
  `ireceipt_no` varchar(60) NOT NULL,
  `irecord_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `iregistered_by` varchar(60) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `income`
--

INSERT INTO `income` (`income_id`, `iemployee_id`, `income_name`, `otherIncome`, `idescription`, `iamount`, `payer`, `ireceipt_no`, `irecord_date`, `iregistered_by`) VALUES
(1, 0, 'Short Course', '', 'Short course for new students	  ', '890000', 'Judith Prince', 'AC/ITCB/001', '2016-10-04 18:56:33', 'adrian mtemela'),
(2, 0, 'Hiring of Facilities', '', 'New facilities were hired for shopping services 		  ', '900000', 'Nigel', 'AC/ITCB/001', '2016-10-05 06:26:36', 'dora nyamwihula'),
(3, 0, 'Training', '', 'Training was conducted for new students	  ', '1000000', 'Hussein', 'AC/ITCB/001', '2016-10-05 06:32:00', 'dora, nyamwihula'),
(5, 0, 'Training', '', 'New trainings were conducted for students	  ', '700000', 'Saida', 'AC/ITCB/001', '2016-10-05 07:14:27', 'adrian, mtemela'),
(6, 0, 'Short Course', '', '		  NOne', '45000', 'Mariam', '123456', '2016-10-20 09:04:47', 'adrian, mtemela'),
(7, 0, 'Short Course', '', '		  new student 	  ', '1400000', 'Deusi Francis', 'ac/56736', '2016-11-10 13:16:42', 'katlsa, dotto'),
(8, 0, 'other', 'device', 'amechukua simu aina ya Tecno boom 8', '450000', 'jacob', '45667', '2016-11-13 17:45:46', 'katlsa, dotto');

-- --------------------------------------------------------

--
-- Table structure for table `invetory`
--

CREATE TABLE IF NOT EXISTS `invetory` (
  `item_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `item_name` varchar(60) DEFAULT NULL,
  `item_category` varchar(60) DEFAULT NULL,
  `work_status` varchar(20) DEFAULT NULL,
  `item_value` varchar(60) DEFAULT NULL,
  `location` varchar(60) DEFAULT NULL,
  `department` varchar(60) DEFAULT NULL,
  `custodian` varchar(60) DEFAULT NULL,
  `confirmed` tinyint(4) DEFAULT '0',
  `trush` tinyint(4) DEFAULT '0',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `registered_by` varchar(60) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `invetory`
--

INSERT INTO `invetory` (`item_id`, `user_id`, `item_name`, `item_category`, `work_status`, `item_value`, `location`, `department`, `custodian`, `confirmed`, `trush`, `date`, `registered_by`) VALUES
(1, 8, 'Computer', 'Electrical Device', 'Good', '1000000', 'Solomon Malangu Campus(SMC)', 'ICT Services', 'Dorathy', 1, 0, '2016-10-04 10:42:18', 'mtemela'),
(2, 7, 'Chair', 'Furniture', 'Good', '200000', 'Main Campus', 'Educational Technology', 'Mahimbo', 1, 0, '2016-10-04 17:11:41', 'nyamwihuladora'),
(3, 7, 'Generator', 'Electronic Equipment', 'Good', '4000000', 'Solomon Malangu Campus(SMC)', 'Training Department', 'Juan Migel', 1, 0, '2016-10-04 17:14:16', 'doranyamwihula'),
(4, 2, 'Desktop Computer', 'Electrical Device', 'Good', '1000000', 'Computer Center(Town)', 'ICT Services', 'seida ', 1, 0, '2016-10-04 17:18:21', 'adrian mtemela'),
(5, 7, 'Mouse', 'Electrical Device', 'Good', '30000', 'Main Campus', 'ICT Services', 'Seline', 1, 0, '0000-00-00 00:00:00', 'dora, nyamwihula'),
(6, 7, 'Fan', 'Electrical Device', 'Good', '190000', 'Solomon Malangu Campus(SMC)', 'ICT Services', 'Prince', 1, 0, '2016-10-05 06:24:48', 'dora nyamwihula'),
(7, 7, 'Camera', 'Electrical Device', 'Good', '200000', 'Solomon Malangu Campus(SMC)', 'Training Department', 'Lilongo', 1, 0, '2016-10-05 06:25:30', 'dora nyamwihula'),
(8, 7, 'Table', 'Furniture', 'Good', '230000', 'Main Campus', 'ICT Services', 'Dominick', 1, 0, '2016-10-06 21:36:38', 'dora, nyamwihula'),
(9, 7, 'Computer', 'Electrical Device', 'Good', '12000', 'Solomon Malangu Campus(SMC)', 'ICT Services', 'kanijo', 1, 0, '2016-10-13 16:52:50', 'dora, nyamwihula'),
(10, 11, 'Computer', 'Electrical Device', 'Good', '5000000', 'Main Campus', 'Educational Technology', 'Mahenge', 1, 0, '2016-11-10 13:18:42', 'katlsa, dotto'),
(11, 8, 'table', 'Furniture', 'Good', '300000', 'Main Campus', 'ICT Services', 'fredy maneno', 1, 0, '2016-11-10 13:40:07', 'adrian, mtemela');

-- --------------------------------------------------------

--
-- Table structure for table `pay`
--

CREATE TABLE IF NOT EXISTS `pay` (
  `pay_id` int(11) NOT NULL,
  `puser_id` tinyint(4) DEFAULT NULL,
  `pname` varchar(60) DEFAULT NULL,
  `ppurpose` varchar(60) NOT NULL,
  `pamount` varchar(60) DEFAULT NULL,
  `borrowed` varchar(60) DEFAULT NULL,
  `pregistered_by` varchar(60) DEFAULT NULL,
  `pdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `confirmed` tinyint(4) DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pay`
--

INSERT INTO `pay` (`pay_id`, `puser_id`, `pname`, `ppurpose`, `pamount`, `borrowed`, `pregistered_by`, `pdate`, `confirmed`) VALUES
(1, 7, '1', 'payement for new car ', '52500', '2000', 'dora nyamwihula', '2016-10-19 19:03:27', 1),
(2, 8, '2', 'amerudish 100000', '100000', '600000', 'adrian mtemela', '2016-11-10 13:46:59', 1),
(3, 8, '3', 'amerudisha 150000', '150000', '1000000', 'adrian mtemela', '2016-11-10 13:47:38', 1);

-- --------------------------------------------------------

--
-- Table structure for table `profileimage`
--

CREATE TABLE IF NOT EXISTS `profileimage` (
  `img_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `img_code` varchar(10) NOT NULL,
  `img_name` varchar(255) DEFAULT NULL,
  `img_dir_name` varchar(8) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `profileimage`
--

INSERT INTO `profileimage` (`img_id`, `user_id`, `img_code`, `img_name`, `img_dir_name`) VALUES
(1, 2, 'qWts6rHe', '1364125264782739178passport.jpg', 'w6o9j3tB'),
(2, 7, 'GpQfvKtY', 'IMG-20160126-WA0005.jpg', '25g0USGk'),
(3, 8, 'szG8WXVq', 'index.jpeg', 'VKHOn6aP'),
(4, 11, 'Mys4VZJL', 'Screenshot_from_2016-06-10_22-15-33.png', 'lUDeas1C'),
(5, 12, 'DBeSiAoM', 'IMG-20160126-WA0005.jpg', 'qT0kFZ9X'),
(6, 14, 'Ts7paMvL', 'images.jpeg', 'BjcQfXVP');

-- --------------------------------------------------------

--
-- Table structure for table `record`
--

CREATE TABLE IF NOT EXISTS `record` (
  `record_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `income_id` int(11) NOT NULL DEFAULT '0',
  `exp_id` int(11) NOT NULL DEFAULT '0',
  `fcategory` varchar(50) NOT NULL,
  `confirmed` tinyint(4) DEFAULT '0',
  `trush` tinyint(4) NOT NULL DEFAULT '0',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `record`
--

INSERT INTO `record` (`record_id`, `user_id`, `income_id`, `exp_id`, `fcategory`, `confirmed`, `trush`, `date`) VALUES
(1, 2, 1, 0, 'income category', 1, 0, '2016-10-04 18:39:43'),
(2, 2, 1, 0, 'income category', 1, 0, '2016-10-04 18:56:38'),
(3, 2, 0, 1, 'exp category', 1, 0, '2016-10-04 19:02:19'),
(4, 7, 2, 0, 'income category', 1, 0, '2016-10-05 06:26:39'),
(5, 7, 0, 2, 'exp category', 1, 0, '2016-10-05 06:27:31'),
(7, 7, 3, 0, 'income category', 1, 0, '2016-10-05 06:32:03'),
(8, 7, 4, 0, 'income category', 1, 0, '2016-10-05 07:03:31'),
(9, 2, 5, 0, 'income category', 1, 0, '2016-10-05 07:14:31'),
(10, 2, 6, 0, 'income category', 1, 0, '2016-10-20 09:04:59'),
(11, 11, 7, 0, 'income category', 1, 0, '2016-11-10 13:16:55'),
(12, 2, 0, 4, 'exp category', 1, 0, '2016-11-10 13:53:50'),
(13, 11, 8, 0, 'income category', 1, 0, '2016-11-13 17:46:41');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(40) DEFAULT NULL,
  `middle_name` varchar(40) DEFAULT NULL,
  `last_name` varchar(40) DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL,
  `username` varchar(60) DEFAULT NULL,
  `password` char(42) DEFAULT NULL,
  `access_lvl` tinyint(4) DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `middle_name`, `last_name`, `category`, `username`, `password`, `access_lvl`) VALUES
(2, 'adrian', 'octavian', 'mtemela', 'Educational Technology', 'adrian2rosil@gmail.com', 'a0dd2ffd3a4699fabd2f3581874cbeaa074051c2', 3),
(12, 'prince', 'adrian', 'octavian', 'ICT Services', 'amtemela@gmail.com', 'a0dd2ffd3a4699fabd2f3581874cbeaa074051c2', 1),
(13, 'katlsa', 'jacob', 'dotto', 'ICT Services', 'jkatulitsa@gmail.com', '8a923dbc01db26f9a36f7ebd2da1ee4ac846fee1', 1),
(14, 'catherine', 'adriano', 'mahimbo', 'ICT Services', 'adriancute1@gmail.com', 'a0dd2ffd3a4699fabd2f3581874cbeaa074051c2', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `access_lvl`
--
ALTER TABLE `access_lvl`
  ADD PRIMARY KEY (`access_id`);

--
-- Indexes for table `borrow`
--
ALTER TABLE `borrow`
  ADD PRIMARY KEY (`borrow_id`);

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD PRIMARY KEY (`session_id`),
  ADD KEY `last_activity_idx` (`last_activity`);

--
-- Indexes for table `device`
--
ALTER TABLE `device`
  ADD PRIMARY KEY (`dev_id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`emp_id`);

--
-- Indexes for table `exp`
--
ALTER TABLE `exp`
  ADD PRIMARY KEY (`exp_id`);

--
-- Indexes for table `expenditure`
--
ALTER TABLE `expenditure`
  ADD PRIMARY KEY (`exp_id`);

--
-- Indexes for table `income`
--
ALTER TABLE `income`
  ADD PRIMARY KEY (`income_id`);

--
-- Indexes for table `invetory`
--
ALTER TABLE `invetory`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `pay`
--
ALTER TABLE `pay`
  ADD PRIMARY KEY (`pay_id`);

--
-- Indexes for table `profileimage`
--
ALTER TABLE `profileimage`
  ADD PRIMARY KEY (`img_id`);

--
-- Indexes for table `record`
--
ALTER TABLE `record`
  ADD PRIMARY KEY (`record_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `access_lvl`
--
ALTER TABLE `access_lvl`
  MODIFY `access_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `borrow`
--
ALTER TABLE `borrow`
  MODIFY `borrow_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `device`
--
ALTER TABLE `device`
  MODIFY `dev_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `emp_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `exp`
--
ALTER TABLE `exp`
  MODIFY `exp_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `expenditure`
--
ALTER TABLE `expenditure`
  MODIFY `exp_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `income`
--
ALTER TABLE `income`
  MODIFY `income_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `invetory`
--
ALTER TABLE `invetory`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `pay`
--
ALTER TABLE `pay`
  MODIFY `pay_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `profileimage`
--
ALTER TABLE `profileimage`
  MODIFY `img_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `record`
--
ALTER TABLE `record`
  MODIFY `record_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
