-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 18, 2018 at 02:48 PM
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
-- Table structure for table `assignment`
--

CREATE TABLE IF NOT EXISTS `assignment` (
  `id` varchar(10) DEFAULT NULL,
  `aid` int(10) NOT NULL AUTO_INCREMENT,
  `assignments` varchar(50) DEFAULT NULL,
  `asubject` varchar(30) DEFAULT NULL,
  `date` date NOT NULL,
  `sem` varchar(5) NOT NULL,
  `afaculty` varchar(15) NOT NULL,
  PRIMARY KEY (`aid`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `assignment`
--


--
-- Constraints for dumped tables
--

--
-- Constraints for table `assignment`
--
ALTER TABLE `assignment`
  ADD CONSTRAINT `assignment_ibfk_1` FOREIGN KEY (`id`) REFERENCES `students_info` (`uid`);
