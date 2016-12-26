-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 03, 2015 at 12:00 PM
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
-- Table structure for table `banner`
--

CREATE TABLE IF NOT EXISTS `banner` (
  `id` int(11) NOT NULL,
  `url` varchar(400) DEFAULT NULL,
  `caption` varchar(200) DEFAULT NULL,
  `campaign_id` int(11) NOT NULL,
  `bannerType` varchar(10) NOT NULL,
  `link` varchar(400) NOT NULL,
  `device` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `banner`
--

INSERT INTO `banner` (`id`, `url`, `caption`, `campaign_id`, `bannerType`, `link`, `device`) VALUES
(1, 'http://localhost/astarserve/_FILES/car.swf', 'Cars Move Fast', 1, 'flash', 'www.google.com', 0),
(2, 'https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcT0NYevBHpvCJ8MmvaQUU9IimmJDHDS_oyyWUqNvaFJVcl5WOdHrfHvUM4', 'SOMETHING SID AZAD', 1, 'image', 'http://cse.buet.ac.bd/faculty/facdetail.php?id=anindyaiqbal', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`id`), ADD KEY `campaign_id` (`campaign_id`), ADD KEY `banner_index` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banner`
--
ALTER TABLE `banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `banner`
--
ALTER TABLE `banner`
ADD CONSTRAINT `banner_ibfk_1` FOREIGN KEY (`campaign_id`) REFERENCES `campaign` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
