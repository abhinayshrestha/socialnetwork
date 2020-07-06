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
-- Table structure for table `newsfeed`
--

CREATE TABLE IF NOT EXISTS `newsfeed` (
  `id` varchar(10) DEFAULT NULL,
  `postid` int(10) NOT NULL AUTO_INCREMENT,
  `comments` int(10) DEFAULT NULL,
  `type` varchar(2) DEFAULT NULL,
  `value` varchar(100) NOT NULL,
  `about` varchar(50) NOT NULL,
  `time` date NOT NULL,
  PRIMARY KEY (`postid`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=300 ;

--
-- Dumping data for table `newsfeed`
--


--
-- Constraints for dumped tables
--

--
-- Constraints for table `newsfeed`
--
ALTER TABLE `newsfeed`
  ADD CONSTRAINT `newsfeed_ibfk_1` FOREIGN KEY (`id`) REFERENCES `students_info` (`uid`);
