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
-- Table structure for table `question`
--

CREATE TABLE IF NOT EXISTS `question` (
  `id` varchar(10) DEFAULT NULL,
  `qid` int(10) NOT NULL AUTO_INCREMENT,
  `qfaculty` varchar(15) DEFAULT NULL,
  `qsemester` varchar(5) DEFAULT NULL,
  `qsubject` varchar(60) DEFAULT NULL,
  `year` int(5) DEFAULT NULL,
  `qpath` varchar(50) NOT NULL,
  PRIMARY KEY (`qid`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `question`
--


--
-- Constraints for dumped tables
--

--
-- Constraints for table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `question_ibfk_1` FOREIGN KEY (`id`) REFERENCES `students_info` (`uid`);
