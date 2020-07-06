-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 18, 2018 at 02:49 PM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `myproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `notice`
--

CREATE TABLE IF NOT EXISTS `notice` (
  `id` varchar(10) DEFAULT NULL,
  `nid` int(5) NOT NULL AUTO_INCREMENT,
  `ntitle` varchar(30) DEFAULT NULL,
  `ndescription` varchar(100) DEFAULT NULL,
  `nimagepath` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`nid`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `notice`
--


--
-- Constraints for dumped tables
--

--
-- Constraints for table `notice`
--
ALTER TABLE `notice`
  ADD CONSTRAINT `notice_ibfk_1` FOREIGN KEY (`id`) REFERENCES `students_info` (`uid`);
