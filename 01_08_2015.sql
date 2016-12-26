-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 01, 2015 at 01:55 PM
-- Server version: 5.6.24
-- PHP Version: 5.5.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `adserver`
--

-- --------------------------------------------------------

--
-- Table structure for table `advertiser`
--

CREATE TABLE IF NOT EXISTS `advertiser` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `email` varchar(80) DEFAULT NULL,
  `contact_no` varchar(20) DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `advertiser`
--

INSERT INTO `advertiser` (`id`, `name`, `address`, `email`, `contact_no`, `user_id`) VALUES
(1, 'Unilever Bangladesh', 'ZN Tower (Ground Floor), Plot-2, Road-8, Bir Uttam Mir Shawkat Sarak, Dhaka 1212, Bangladesh', 'info@unilever.com', '+880 1745-576878', 2),
(2, 'Robi Axiata Limited', '53 Gulshan South Avenue Gulshan 1', 'info@robi.com.bd', '+88 02 9887146-52', 3);

-- --------------------------------------------------------

--
-- Table structure for table `ad_record`
--

CREATE TABLE IF NOT EXISTS `ad_record` (
  `id` bigint(20) NOT NULL,
  `click_impression` tinyint(1) DEFAULT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `source` varchar(200) DEFAULT NULL,
  `placement_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ad_report_summary`
--

CREATE TABLE IF NOT EXISTS `ad_report_summary` (
  `id` int(11) NOT NULL,
  `summary_date` date DEFAULT NULL,
  `click` int(11) DEFAULT NULL,
  `impression` int(11) DEFAULT NULL,
  `request` int(11) DEFAULT NULL,
  `placement_id` int(11) NOT NULL,
  `banner_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ad_report_summary`
--

INSERT INTO `ad_report_summary` (`id`, `summary_date`, `click`, `impression`, `request`, `placement_id`, `banner_id`) VALUES
(1, '2015-08-01', 9, 1011, 1068, 1, 1),
(2, '2015-08-10', 11, 1508, 1593, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `banner`
--

CREATE TABLE IF NOT EXISTS `banner` (
  `id` int(11) NOT NULL,
  `url` varchar(400) DEFAULT NULL,
  `caption` varchar(200) DEFAULT NULL,
  `campaign_id` int(11) NOT NULL,
  `banner_type_id` int(11) NOT NULL,
  `device_id` int(11) NOT NULL DEFAULT '9',
  `link` varchar(400) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `banner`
--

INSERT INTO `banner` (`id`, `url`, `caption`, `campaign_id`, `banner_type_id`, `device_id`, `link`) VALUES
(1, 'e851d-desert.jpg', 'Clear Banner', 1, 1, 9, 'www.google.com');

-- --------------------------------------------------------

--
-- Table structure for table `banner_placement`
--

CREATE TABLE IF NOT EXISTS `banner_placement` (
  `id` int(11) NOT NULL,
  `impression_ratio` int(11) DEFAULT NULL,
  `banner_id` int(11) NOT NULL,
  `placement_id` int(11) NOT NULL,
  `start_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `end_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `device_id` int(11) NOT NULL DEFAULT '9',
  `ad_publishing_cost_method` enum('CPM','CPC') NOT NULL,
  `per_unit_ad_publishing_cost` int(11) NOT NULL,
  `ad_serving_cost_method` enum('CPM','CPC') NOT NULL,
  `per_unit_ad_serving_cost` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `banner_placement`
--

INSERT INTO `banner_placement` (`id`, `impression_ratio`, `banner_id`, `placement_id`, `start_time`, `end_time`, `device_id`, `ad_publishing_cost_method`, `per_unit_ad_publishing_cost`, `ad_serving_cost_method`, `per_unit_ad_serving_cost`, `active`) VALUES
(1, 100, 1, 1, '2015-08-01 11:50:31', '2015-08-01 18:00:00', 9, 'CPM', 100, 'CPC', 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `banner_type`
--

CREATE TABLE IF NOT EXISTS `banner_type` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `banner_type`
--

INSERT INTO `banner_type` (`id`, `name`) VALUES
(1, 'image'),
(2, 'flash'),
(3, 'html5');

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE IF NOT EXISTS `brand` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `advertiser_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id`, `name`, `advertiser_id`) VALUES
(1, 'Closeup', 1),
(2, 'Clear', 1),
(3, 'Pureit', 1),
(4, 'Robi 3G', 2),
(5, 'Robi Internet', 2);

-- --------------------------------------------------------

--
-- Table structure for table `campaign`
--

CREATE TABLE IF NOT EXISTS `campaign` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `budget` decimal(15,2) DEFAULT NULL,
  `variant_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `campaign`
--

INSERT INTO `campaign` (`id`, `name`, `start_date`, `end_date`, `budget`, `variant_id`) VALUES
(1, 'Clear Eid Special', '2015-07-08', '2015-07-23', '10000000.00', 2),
(2, 'Closeup Eid Special', '2015-07-03', '2015-07-24', '20000000.00', 1),
(3, 'Pureit Eid Special', '2015-07-11', '2015-07-22', '15000000.00', 3);

-- --------------------------------------------------------

--
-- Table structure for table `device`
--

CREATE TABLE IF NOT EXISTS `device` (
  `id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `device`
--

INSERT INTO `device` (`id`, `name`) VALUES
(0, 'desktop'),
(1, 'mobile'),
(2, 'tablet'),
(9, 'all');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE IF NOT EXISTS `payment` (
  `id` int(11) NOT NULL,
  `amount` decimal(15,2) DEFAULT NULL,
  `payment_date` date DEFAULT NULL,
  `campaign_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `amount`, `payment_date`, `campaign_id`) VALUES
(1, '1000000.00', '2015-07-23', 1),
(2, '5000000.00', '2015-07-05', 2),
(3, '6000000.00', '2015-07-05', 3);

-- --------------------------------------------------------

--
-- Table structure for table `placement`
--

CREATE TABLE IF NOT EXISTS `placement` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `position` varchar(100) DEFAULT NULL,
  `width` int(11) DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  `default_banner_id` int(11) DEFAULT NULL,
  `publisher_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `placement`
--

INSERT INTO `placement` (`id`, `name`, `position`, `width`, `height`, `default_banner_id`, `publisher_id`) VALUES
(1, 'Prothom Alo Front Right', 'Front Right', 400, 200, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `publisher`
--

CREATE TABLE IF NOT EXISTS `publisher` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `email` varchar(80) DEFAULT NULL,
  `contact_no` varchar(20) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `publisher`
--

INSERT INTO `publisher` (`id`, `name`, `address`, `email`, `contact_no`) VALUES
(1, 'Prothom Alo', 'The Institute of Chartered Accountants of Bangladesh, 100 Kazi Nazrul Islam Ave, Dhaka 1215, Bangladesh', 'info@prothom-alo.info', '+880 2-8110081');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `full_name` varchar(80) DEFAULT NULL,
  `email` varchar(80) DEFAULT NULL,
  `user_role` enum('advertiser','admin','user') NOT NULL DEFAULT 'advertiser'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `full_name`, `email`, `user_role`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', NULL, NULL, 'admin'),
(2, 'unilever', '01286de8e07e6e4aa33b773f9d89c3bf', NULL, NULL, 'advertiser'),
(3, 'robi', 'b8b743a499e461922accad58fdbf25d2', NULL, NULL, 'advertiser'),
(4, 'user', 'ee11cbb19052e40b07aac0ca060c23ee', 'Test User', 'user@example.com', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `variant`
--

CREATE TABLE IF NOT EXISTS `variant` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `brand_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `variant`
--

INSERT INTO `variant` (`id`, `name`, `brand_id`) VALUES
(1, 'Closeup Papermint Splash', 1),
(2, 'Clear Anti Hair Fall', 2),
(3, 'Pureit Classic Blue', 3),
(4, 'Robi 3G', 4),
(5, 'Robi Internet', 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `advertiser`
--
ALTER TABLE `advertiser`
  ADD PRIMARY KEY (`id`), ADD KEY `user_id` (`user_id`), ADD KEY `advertiser_index` (`id`);

--
-- Indexes for table `ad_record`
--
ALTER TABLE `ad_record`
  ADD PRIMARY KEY (`id`), ADD KEY `placement_id` (`placement_id`), ADD KEY `ad_record_index` (`id`);

--
-- Indexes for table `ad_report_summary`
--
ALTER TABLE `ad_report_summary`
  ADD PRIMARY KEY (`id`), ADD KEY `placement_id` (`placement_id`), ADD KEY `banner_id` (`banner_id`), ADD KEY `ad_report_summary_index` (`id`);

--
-- Indexes for table `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `bannercaption_constraint` (`caption`), ADD KEY `campaign_id` (`campaign_id`), ADD KEY `banner_type_id` (`banner_type_id`), ADD KEY `device_id` (`device_id`), ADD KEY `banner_index` (`id`);

--
-- Indexes for table `banner_placement`
--
ALTER TABLE `banner_placement`
  ADD PRIMARY KEY (`id`), ADD KEY `banner_id` (`banner_id`), ADD KEY `device_id` (`device_id`), ADD KEY `placement_id` (`placement_id`), ADD KEY `banner_placement_index` (`id`);

--
-- Indexes for table `banner_type`
--
ALTER TABLE `banner_type`
  ADD PRIMARY KEY (`id`), ADD KEY `banner_type_index` (`id`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`), ADD KEY `advertiser_id` (`advertiser_id`), ADD KEY `brand_index` (`id`);

--
-- Indexes for table `campaign`
--
ALTER TABLE `campaign`
  ADD PRIMARY KEY (`id`), ADD KEY `variant_id` (`variant_id`), ADD KEY `campaign_index` (`id`);

--
-- Indexes for table `device`
--
ALTER TABLE `device`
  ADD PRIMARY KEY (`id`), ADD KEY `device_index` (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`), ADD KEY `campaign_id` (`campaign_id`), ADD KEY `payment_index` (`id`);

--
-- Indexes for table `placement`
--
ALTER TABLE `placement`
  ADD PRIMARY KEY (`id`), ADD KEY `default_banner_id` (`default_banner_id`), ADD KEY `publisher_id` (`publisher_id`), ADD KEY `placement_index` (`id`);

--
-- Indexes for table `publisher`
--
ALTER TABLE `publisher`
  ADD PRIMARY KEY (`id`), ADD KEY `publisher_index` (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `username_constraint` (`username`), ADD KEY `user_index` (`id`);

--
-- Indexes for table `variant`
--
ALTER TABLE `variant`
  ADD PRIMARY KEY (`id`), ADD KEY `brand_id` (`brand_id`), ADD KEY `variant_index` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `advertiser`
--
ALTER TABLE `advertiser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `ad_record`
--
ALTER TABLE `ad_record`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ad_report_summary`
--
ALTER TABLE `ad_report_summary`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `banner`
--
ALTER TABLE `banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `banner_placement`
--
ALTER TABLE `banner_placement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `banner_type`
--
ALTER TABLE `banner_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `campaign`
--
ALTER TABLE `campaign`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `device`
--
ALTER TABLE `device`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `placement`
--
ALTER TABLE `placement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `publisher`
--
ALTER TABLE `publisher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `variant`
--
ALTER TABLE `variant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `advertiser`
--
ALTER TABLE `advertiser`
ADD CONSTRAINT `advertiser_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ad_record`
--
ALTER TABLE `ad_record`
ADD CONSTRAINT `ad_record_ibfk_1` FOREIGN KEY (`placement_id`) REFERENCES `placement` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ad_report_summary`
--
ALTER TABLE `ad_report_summary`
ADD CONSTRAINT `ad_report_summary_ibfk_1` FOREIGN KEY (`placement_id`) REFERENCES `placement` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `ad_report_summary_ibfk_2` FOREIGN KEY (`banner_id`) REFERENCES `banner` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `banner`
--
ALTER TABLE `banner`
ADD CONSTRAINT `banner_ibfk_1` FOREIGN KEY (`campaign_id`) REFERENCES `campaign` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `banner_ibfk_2` FOREIGN KEY (`banner_type_id`) REFERENCES `banner_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `banner_ibfk_3` FOREIGN KEY (`device_id`) REFERENCES `device` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `banner_placement`
--
ALTER TABLE `banner_placement`
ADD CONSTRAINT `banner_placement_ibfk_1` FOREIGN KEY (`banner_id`) REFERENCES `banner` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `banner_placement_ibfk_2` FOREIGN KEY (`device_id`) REFERENCES `device` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `banner_placement_ibfk_3` FOREIGN KEY (`placement_id`) REFERENCES `placement` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `brand`
--
ALTER TABLE `brand`
ADD CONSTRAINT `brand_ibfk_1` FOREIGN KEY (`advertiser_id`) REFERENCES `advertiser` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `campaign`
--
ALTER TABLE `campaign`
ADD CONSTRAINT `campaign_ibfk_1` FOREIGN KEY (`variant_id`) REFERENCES `variant` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`campaign_id`) REFERENCES `campaign` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `placement`
--
ALTER TABLE `placement`
ADD CONSTRAINT `placement_ibfk_1` FOREIGN KEY (`default_banner_id`) REFERENCES `banner` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `placement_ibfk_2` FOREIGN KEY (`publisher_id`) REFERENCES `publisher` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `variant`
--
ALTER TABLE `variant`
ADD CONSTRAINT `variant_ibfk_1` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
