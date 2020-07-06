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
-- Table structure for table `students_info`
--

CREATE TABLE IF NOT EXISTS `students_info` (
  `uid` varchar(10) NOT NULL,
  `name` varchar(40) NOT NULL,
  `gender` varchar(8) NOT NULL,
  `faculty` varchar(15) NOT NULL,
  `sem` varchar(5) NOT NULL,
  `password` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `profilepic` varchar(50) NOT NULL,
  `politicalview` varchar(30) NOT NULL,
  `religion` varchar(30) NOT NULL,
  `assignment` int(5) NOT NULL,
  `event` int(5) NOT NULL,
  `notice` int(5) NOT NULL,
  `location` varchar(30) NOT NULL,
  `quote` varchar(200) NOT NULL,
  `mod_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `notifi` int(5) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students_info`
--

