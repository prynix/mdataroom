-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 05, 2015 at 02:21 PM
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
  `contact_no` varchar(20) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `advertiser`
--

INSERT INTO `advertiser` (`id`, `name`, `address`, `email`, `contact_no`) VALUES
(1, 'Unilever Bangladesh', 'ZN Tower (Ground Floor), Plot-2, Road-8, Bir Uttam Mir Shawkat Sarak, Dhaka 1212, Bangladesh', 'info@unilever.com', '+880 1745-576878'),
(2, 'Robi Axiata Limited', '53 Gulshan South Avenue Gulshan 1', 'info@robi.com.bd', '+88 02 9887146-52');

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
  `placement_id` int(11) NOT NULL,
  `banner_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ad_report_summary`
--

INSERT INTO `ad_report_summary` (`id`, `summary_date`, `click`, `impression`, `placement_id`, `banner_id`) VALUES
(1, '2015-07-05', 4, 72, 1, 2),
(2, '2015-07-05', 6, 79, 1, 3),
(3, '2015-07-05', 1, 8, 2, 3),
(4, '2015-07-05', 0, 13, 2, 4),
(5, '2015-07-05', 1, 5, 2, 2);

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
  `device_id` int(11) NOT NULL,
  `link` varchar(400) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `banner`
--

INSERT INTO `banner` (`id`, `url`, `caption`, `campaign_id`, `banner_type_id`, `device_id`, `link`) VALUES
(2, 'c066d-clear.jpg', 'Clear Anti Hair Fall', 1, 1, 9, 'http://www.unilever.com.bd/our-brands/detail/Clear/365459/?WT.contenttype=view%20brands'),
(3, 'd3b7e-closeup.jpg', 'Closeup Pepper Mint Special', 2, 1, 9, 'http://www.unilever.com.bd/our-brands/detail/Closeup/365924/?WT.contenttype=view%20brands'),
(4, '76c99-pureit.jpg', 'Pureit Classic Blue', 3, 1, 9, 'http://www.unilever.com.bd/our-brands/detail/Pureit/368189/?WT.contenttype=view%20brands');

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
  `device_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `banner_placement`
--

INSERT INTO `banner_placement` (`id`, `impression_ratio`, `banner_id`, `placement_id`, `start_time`, `end_time`, `device_id`) VALUES
(1, 50, 2, 1, '2015-07-05 10:36:44', '2015-07-30 18:00:00', 9),
(2, 50, 3, 1, '2015-07-05 10:37:13', '2015-07-23 18:00:00', 9),
(3, 33, 2, 2, '2015-07-05 10:37:39', '2015-07-22 18:00:00', 9),
(4, 33, 3, 2, '2015-07-05 10:37:56', '2015-07-24 18:00:00', 9),
(5, 33, 4, 2, '2015-07-05 10:38:19', '2015-07-30 18:00:00', 9);

-- --------------------------------------------------------

--
-- Table structure for table `banner_type`
--

CREATE TABLE IF NOT EXISTS `banner_type` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `banner_type`
--

INSERT INTO `banner_type` (`id`, `name`) VALUES
(1, 'image'),
(2, 'flash');

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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

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
  `publisher_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `placement`
--

INSERT INTO `placement` (`id`, `name`, `position`, `width`, `height`, `publisher_id`) VALUES
(1, 'Prothom alo top right', 'Top right', 370, 370, 1),
(2, 'Prothom alo front page bottom right', 'bottom right', 370, 370, 1);

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
  `email` varchar(80) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `full_name`, `email`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', NULL, NULL);

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
  ADD PRIMARY KEY (`id`), ADD KEY `advertiser_index` (`id`);

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
  ADD PRIMARY KEY (`id`), ADD KEY `campaign_id` (`campaign_id`), ADD KEY `banner_type_id` (`banner_type_id`), ADD KEY `device_id` (`device_id`), ADD KEY `banner_index` (`id`);

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
  ADD PRIMARY KEY (`id`), ADD KEY `publisher_id` (`publisher_id`), ADD KEY `placement_index` (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `banner`
--
ALTER TABLE `banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `banner_placement`
--
ALTER TABLE `banner_placement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `banner_type`
--
ALTER TABLE `banner_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `placement`
--
ALTER TABLE `placement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `publisher`
--
ALTER TABLE `publisher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `variant`
--
ALTER TABLE `variant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `ad_record`
--
ALTER TABLE `ad_record`
ADD CONSTRAINT `ad_record_ibfk_1` FOREIGN KEY (`placement_id`) REFERENCES `placement` (`id`);

--
-- Constraints for table `ad_report_summary`
--
ALTER TABLE `ad_report_summary`
ADD CONSTRAINT `ad_report_summary_ibfk_1` FOREIGN KEY (`placement_id`) REFERENCES `placement` (`id`),
ADD CONSTRAINT `ad_report_summary_ibfk_2` FOREIGN KEY (`banner_id`) REFERENCES `banner` (`id`);

--
-- Constraints for table `banner`
--
ALTER TABLE `banner`
ADD CONSTRAINT `banner_ibfk_1` FOREIGN KEY (`campaign_id`) REFERENCES `campaign` (`id`),
ADD CONSTRAINT `banner_ibfk_2` FOREIGN KEY (`banner_type_id`) REFERENCES `banner_type` (`id`),
ADD CONSTRAINT `banner_ibfk_3` FOREIGN KEY (`device_id`) REFERENCES `device` (`id`);

--
-- Constraints for table `banner_placement`
--
ALTER TABLE `banner_placement`
ADD CONSTRAINT `banner_placement_ibfk_1` FOREIGN KEY (`banner_id`) REFERENCES `banner` (`id`),
ADD CONSTRAINT `banner_placement_ibfk_2` FOREIGN KEY (`device_id`) REFERENCES `device` (`id`),
ADD CONSTRAINT `banner_placement_ibfk_3` FOREIGN KEY (`placement_id`) REFERENCES `placement` (`id`);

--
-- Constraints for table `brand`
--
ALTER TABLE `brand`
ADD CONSTRAINT `brand_ibfk_1` FOREIGN KEY (`advertiser_id`) REFERENCES `advertiser` (`id`);

--
-- Constraints for table `campaign`
--
ALTER TABLE `campaign`
ADD CONSTRAINT `campaign_ibfk_1` FOREIGN KEY (`variant_id`) REFERENCES `variant` (`id`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`campaign_id`) REFERENCES `campaign` (`id`);

--
-- Constraints for table `placement`
--
ALTER TABLE `placement`
ADD CONSTRAINT `placement_ibfk_1` FOREIGN KEY (`publisher_id`) REFERENCES `publisher` (`id`);

--
-- Constraints for table `variant`
--
ALTER TABLE `variant`
ADD CONSTRAINT `variant_ibfk_1` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
