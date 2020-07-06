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
-- Table structure for table `cht_chat`
--

CREATE TABLE IF NOT EXISTS `cht_chat` (
  `messageId` binary(32) NOT NULL,
  `username` varchar(300) NOT NULL DEFAULT 'Anonymous',
  `text` varchar(300) NOT NULL DEFAULT '',
  `insertDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sender_id` varchar(10) NOT NULL,
  `receiver_id` varchar(10) NOT NULL,
  PRIMARY KEY (`messageId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cht_chat`
--

