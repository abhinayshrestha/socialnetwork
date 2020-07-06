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
-- Table structure for table `students_id`
--

CREATE TABLE IF NOT EXISTS `students_id` (
  `faculty` varchar(15) NOT NULL,
  `sem` varchar(5) NOT NULL,
  `id` varchar(10) NOT NULL,
  `id_status` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students_id`
--

INSERT INTO `students_id` (`faculty`, `sem`, `id`, `id_status`) VALUES
('B.E Computer', 'I', '01BEC2017', 'a'),
('B.E Computer', 'I', '02BEC2017', 'a'),
('B.E Computer', 'I', '03BEC2017', 'a'),
('B.E Computer', 'I', '04BEC2017', 'a'),
('B.E Computer', 'I', '05BEC2017', 'a'),
('B.E Computer', 'I', '06BEC2017', 'a'),
('B.E Computer', 'I', '07BEC2017', 'a'),
('B.E Computer', 'I', '08BEC2017', 'a'),
('B.E Computer', 'I', '10BEC2017', 'a'),
('B.E Computer', 'I', '11BEC2017', 'a'),
('B.E Computer', 'I', '12BEC2017', 'a'),
('B.E Computer', 'I', '13BEC2017', 'a'),
('B.E Computer', 'I', '14BEC2017', 'a'),
('B.E Computer', 'I', '15BEC2017', 'a'),
('B.E Computer', 'III', '01BEC2016', 'a'),
('B.E Computer', 'III', '02BEC2016', 'a'),
('B.E Computer', 'III', '03BEC2016', 'a'),
('B.E Computer', 'III', '04BEC2016', 'a'),
('B.E Computer', 'III', '05BEC2016', 'a'),
('B.E Computer', 'III', '06BEC2016', 'a'),
('B.E Computer', 'III', '07BEC2016', 'a'),
('B.E Computer', 'III', '08BEC2016', 'a'),
('B.E Computer', 'III', '09BEC2016', 'a'),
('B.E Computer', 'III', '10BEC2016', 'a'),
('B.E Computer', 'III', '11BEC2016', 'a'),
('B.E Computer', 'III', '13BEC2016', 'a'),
('B.E Computer', 'III', '14BEC2016', 'a'),
('B.E Computer', 'III', '15BEC2016', 'a'),
('B.E Computer', 'III', '17BEC2016', 'a'),
('B.E Computer', 'III', '18BEC2016', 'a'),
('B.E Computer', 'V', '01BEC2015', 'a'),
('B.E Computer', 'V', '02BEC2015', 'a'),
('B.E Computer', 'V', '03BEC2015', 'a'),
('B.E Computer', 'V', '04BEC2015', 'a'),
('B.E Computer', 'V', '05BEC2015', 'a'),
('B.E Computer', 'V', '06BEC2015', 'a'),
('B.E Computer', 'V', '07BEC2015', 'a'),
('B.E Computer', 'V', '08BEC2015', 'a'),
('B.E Computer', 'V', '09BEC2015', 'a'),
('B.E Computer', 'V', '10BEC2015', 'a'),
('B.E Computer', 'V', '11BEC2015', 'a'),
('B.E Computer', 'V', '12BEC2015', 'a'),
('B.E Computer', 'V', '13BEC2015', 'a'),
('B.E Computer', 'V', '14BEC2015', 'a'),
('B.E Computer', 'V', '15BEC2015', 'a'),
('B.E Computer', 'V', '16BEC2015', 'a'),
('B.E Computer', 'V', '17BEC2015', 'a'),
('B.E Computer', 'V', '18BEC2015', 'a'),
('B.E Computer', 'V', '19BEC2015', 'a'),
('B.E Computer', 'V', '20BEC2015', 'a'),
('B.E Computer', 'VII', '02CE2014', 'a'),
('B.E Computer', 'VII', '03CE2014', 'a'),
('B.E Computer', 'VII', '04CE2014', 'a'),
('B.E Computer', 'VII', '05CE2014', 'a'),
('B.E Computer', 'VII', '06CE2014', 'a'),
('B.E Computer', 'VII', '07CE2014', 'a'),
('B.E Computer', 'VII', '08CE2014', 'a'),
('B.E Computer', 'VII', '09CE2014', 'a'),
('B.E Computer', 'VII', '10CE2014', 'a'),
('B.E Computer', 'VII', '11CE2014', 'a'),
('B.E Computer', 'VII', '12CE2014', 'a'),
('B.E Computer', 'VII', '13CE2014', 'a'),
('B.E Computer', 'VII', '14CE2014', 'a'),
('BCA', 'I', '01BCA2017', 'a'),
('BCA', 'I', '02BCA2017', 'a'),
('BCA', 'I', '03BCA2017', 'a'),
('BCA', 'I', '04BCA2017', 'a'),
('BCA', 'I', '05BCA2017', 'a'),
('BCA', 'I', '06BCA2017', 'a'),
('BCA', 'I', '07BCA2017', 'a'),
('BCA', 'I', '08BCA2017', 'a'),
('BCA', 'I', '09BCA2017', 'a'),
('BCA', 'I', '10BCA2017', 'a'),
('BCA', 'I', '11BCA2017', 'a'),
('BCA', 'I', '12BCA2017', 'a'),
('BCA', 'I', '13BCA2017', 'a'),
('BCA', 'I', '14BCA2017', 'a'),
('BCA', 'I', '15BCA2017', 'a'),
('BCA', 'I', '16BCA2017', 'a'),
('BCA', 'I', '17BCA2017', 'a'),
('BCA', 'I', '18BCA2017', 'a'),
('BCA', 'I', '19BCA2017', 'a'),
('BCA', 'I', '20BCA2017', 'a'),
('BCA', 'I', '21BCA2017', 'a'),
('BCA', 'I', '22BCA2017', 'a'),
('BCA', 'I', '23BCA2017', 'a'),
('BCA', 'I', '24BCA2017', 'a'),
('BCA', 'I', '25BCA2017', 'a'),
('BCA', 'I', '26BCA2017', 'a'),
('BCA', 'I', '27BCA2017', 'a'),
('BCA', 'I', '28BCA2017', 'a'),
('BCA', 'I', '29BCA2017', 'a'),
('BCA', 'I', '30BCA2017', 'a'),
('BCA', 'I', '31BCA2017', 'a'),
('BCA', 'I', '32BCA2017', 'a'),
('BCA', 'I', '33BCA2017', 'a'),
('BCA', 'I', '34BCA2017', 'a'),
('BCA', 'I', '35BCA2017', 'a'),
('BCA', 'I', '36BCA2017', 'a'),
('BCA', 'I', '37BCA2017', 'a'),
('BCA', 'I', '38BCA2017', 'a'),
('BCA', 'I', '39BCA2017', 'a'),
('BCA', 'I', '40BCA2017', 'a'),
('BCA', 'I', '41BCA2017', 'a'),
('BCA', 'I', '42BCA2017', 'a'),
('BCA', 'I', '43BCA2017', 'a'),
('BCA', 'I', '44BCA2017', 'a'),
('BCA', 'III', '01BCA2016', 'a'),
('BCA', 'III', '02BCA2016', 'a'),
('BCA', 'III', '03BCA2016', 'a'),
('BCA', 'III', '04BCA2016', 'a'),
('BCA', 'III', '05BCA2016', 'a'),
('BCA', 'III', '06BCA2016', 'a'),
('BCA', 'III', '08BCA2016', 'a'),
('BCA', 'III', '09BCA2016', 'a'),
('BCA', 'III', '10BCA2016', 'a'),
('BCA', 'III', '11BCA2016', 'a'),
('BCA', 'III', '13BCA2016', 'a'),
('BCA', 'III', '14BCA2016', 'a'),
('BCA', 'III', '15BCA2016', 'a'),
('BCA', 'III', '16BCA2016', 'a'),
('BCA', 'III', '17BCA2016', 'a'),
('BCA', 'III', '19BCA2016', 'a'),
('BCA', 'III', '20BCA2016', 'a'),
('BCA', 'III', '21BCA2016', 'a'),
('BCA', 'III', '22BCA2016', 'a'),
('BCA', 'III', '23BCA2016', 'a'),
('BCA', 'III', '24BCA2016', 'a'),
('BCA', 'III', '25BCA2016', 'a'),
('BCA', 'III', '26BCA2016', 'a'),
('BCA', 'III', '27BCA2016', 'a'),
('BCA', 'III', '28BCA2016', 'a'),
('BCA', 'III', '30BCA2016', 'a'),
('BCA', 'III', '31BCA2016', 'a'),
('BCA', 'III', '32BCA2016', 'a'),
('BCA', 'III', '33BCA2016', 'a'),
('BCA', 'III', '34BCA2016', 'a'),
('BCA', 'III', '35BCA2016', 'a'),
('BCA', 'III', '36BCA2016', 'a'),
('BCA', 'III', '37BCA2016', 'a'),
('BCA', 'III', '39BCA2016', 'a'),
('BCA', 'III', '40BCA2016', 'a'),
('BCA', 'III', '41BCA2016', 'a'),
('BCA', 'III', '42BCA2016', 'a'),
('BCA', 'III', '43BCA2016', 'a'),
('BCA', 'III', '44BCA2016', 'a'),
('BCA', 'III', '45BCA2016', 'a'),
('BCA', 'III', '46BCA2016', 'a'),
('BCA', 'III', '47BCA2016', 'a'),
('BCA', 'III', '48BCA2016', 'a'),
('BCA', 'III', '49BCA2016', 'a'),
('BCA', 'III', '50BCA2016', 'a'),
('BCA', 'III', '52BCA2016', 'a'),
('BCA', 'III', '53BCA2016', 'a');
