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
-- Table structure for table `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `id` varchar(10) DEFAULT NULL,
  `siid` int(10) DEFAULT NULL,
  `commentid` int(10) NOT NULL AUTO_INCREMENT,
  `comments` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`commentid`),
  KEY `id` (`id`),
  KEY `siid` (`siid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=290 ;

--
-- Dumping data for table `comment`
--


--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`id`) REFERENCES `students_info` (`uid`),
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`siid`) REFERENCES `newsfeed` (`postid`);
