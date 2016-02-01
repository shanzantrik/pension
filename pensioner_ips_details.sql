-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2015 at 08:28 AM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pension`
--

-- --------------------------------------------------------

--
-- Table structure for table `pensioner_ips_details`
--

CREATE TABLE IF NOT EXISTS `pensioner_ips_details` (
`id` int(11) NOT NULL,
  `file_no` varchar(45) DEFAULT NULL,
  `date` date NOT NULL,
  `receipt_date` date DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `designation` varchar(200) DEFAULT NULL,
  `appointment_date` date NOT NULL,
  `appoint_as` varchar(20) DEFAULT NULL,
  `pay_scale` varchar(20) DEFAULT NULL,
  `regularization_date` date DEFAULT NULL,
  `department` int(11) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `dor` date DEFAULT NULL,
  `pre_revised_pay_commission` int(11) DEFAULT NULL,
  `exist_bp` double(10,2) DEFAULT NULL,
  `pre_revised` int(11) DEFAULT NULL,
  `revised` int(11) DEFAULT NULL,
  `pay_fixed` double(10,2) DEFAULT NULL,
  `effect_from` date DEFAULT NULL,
  `dni_on` date DEFAULT NULL,
  `remark1` text,
  `remark2` text,
  `remark3` text,
  `remark4` text,
  `remark5` text,
  `remarks6` text,
  `remarks7` text,
  `remarks8` text,
  `remarks9` text,
  `remarks10` text,
  `remarks11` text,
  `remarks12` text,
  `remarks13` text,
  `remarks14` text,
  `remarks15` text,
  `remarks16` text,
  `remarks17` text,
  `remarks18` text,
  `remarks19` text,
  `remarks20` text,
  `remarks21` text,
  `remarks22` text,
  `remarks23` text
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pensioner_ips_details`
--
ALTER TABLE `pensioner_ips_details`
 ADD PRIMARY KEY (`id`), ADD KEY `department` (`department`), ADD KEY `pre_revised_pay_commission` (`pre_revised_pay_commission`), ADD KEY `pre_revised` (`pre_revised`), ADD KEY `revised` (`revised`), ADD KEY `file_no` (`file_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pensioner_ips_details`
--
ALTER TABLE `pensioner_ips_details`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `pensioner_ips_details`
--
ALTER TABLE `pensioner_ips_details`
ADD CONSTRAINT `pensioner_ips_details_department` FOREIGN KEY (`department`) REFERENCES `master_department` (`dept_code`),
ADD CONSTRAINT `pensioner_ips_details_file_no` FOREIGN KEY (`file_no`) REFERENCES `pension_receipt_file_master` (`file_No`),
ADD CONSTRAINT `pensioner_ips_details_pay_commission` FOREIGN KEY (`pre_revised_pay_commission`) REFERENCES `master_pay_comm` (`id`),
ADD CONSTRAINT `pensioner_ips_details_pre_revised` FOREIGN KEY (`pre_revised`) REFERENCES `master_pay_scale` (`id`),
ADD CONSTRAINT `pensioner_ips_details_revised` FOREIGN KEY (`revised`) REFERENCES `master_pay_scale` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
