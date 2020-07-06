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
-- Table structure for table `conversation_list`
--

CREATE TABLE IF NOT EXISTS `conversation_list` (
  `user_id` varchar(10) NOT NULL DEFAULT '',
  `chat_with` varchar(10) NOT NULL DEFAULT '',
  `c_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`,`chat_with`),
  KEY `chat_with` (`chat_with`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `conversation_list`
--


--
-- Constraints for dumped tables
--

--
-- Constraints for table `conversation_list`
--
ALTER TABLE `conversation_list`
  ADD CONSTRAINT `conversation_list_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `students_info` (`uid`),
  ADD CONSTRAINT `conversation_list_ibfk_2` FOREIGN KEY (`chat_with`) REFERENCES `students_info` (`uid`);
