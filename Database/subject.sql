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
-- Table structure for table `subject`
--

CREATE TABLE IF NOT EXISTS `subject` (
  `faculty` varchar(20) NOT NULL,
  `semester` varchar(5) NOT NULL,
  `subjects` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`faculty`, `semester`, `subjects`) VALUES
('BIT', 'I', 'Mathematics-I'),
('BIT', 'I', 'Fundamental of Information Technology'),
('BIT', 'I', 'Technical Communication'),
('BIT', 'I', 'Basic Electrical System and Circuit'),
('BIT', 'I', 'Principles of Management'),
('BIT', 'I', 'Computer Programming-I'),
('BIT', 'II', 'Mathematics-II'),
('BIT', 'II', 'Electronics Devices and Circuits'),
('BIT', 'II', 'Digital Logic'),
('BIT', 'II', 'Object Oriented Programming in C++'),
('BIT', 'II', 'Financial Management and Accounting'),
('BIT', 'III', 'System Analysis and Design'),
('BIT', 'III', 'Microprocessor and Assembly Language'),
('BIT', 'III', 'Data Structure and Algorithm'),
('BIT', 'III', 'User Interface Design'),
('BIT', 'III', 'Numeric Methods'),
('BIT', 'IV', 'Communication System'),
('BIT', 'IV', 'Computer Organization'),
('BIT', 'IV', 'Web Technology-I'),
('BIT', 'IV', 'Database Management System'),
('BIT', 'IV', 'Discrete Mathematics'),
('BIT', 'IV', 'Marketing Management'),
('BIT', 'V', 'Probability and Statistics'),
('BIT', 'V', 'Society and Ethics in IT '),
('BIT', 'V', 'Data Communication'),
('BIT', 'V', 'Web Technology-II'),
('BIT', 'V', 'Computer Graphics'),
('BIT', 'V', 'Operating System'),
('BIT', 'VI', 'Embedded System Programming'),
('BIT', 'VI', 'Computer Network'),
('BIT', 'VI', 'Data Mining and Data Warehousing'),
('BIT', 'VI', 'Advance Object-Oriented Programming'),
('BIT', 'VI', 'Research Methodology'),
('BIT', 'VII', 'Artificial Intelligence'),
('BIT', 'VII', 'Network Programming'),
('BIT', 'VII', 'Software Engineering'),
('BIT', 'VII', 'MIS'),
('BIT', 'VII', 'Elective I'),
('BIT', 'VIII', 'E-commerce'),
('BIT', 'VIII', 'Wireless Communication System'),
('BIT', 'VIII', 'Software Project Management'),
('BIT', 'VIII', 'Elective II (System Administration)'),
('BCA', 'I', 'Mathematics-I'),
('BCA', 'I', 'Technical English'),
('BCA', 'I', 'Computer System Concepts'),
('BCA', 'I', 'Computer Programming in C'),
('BCA', 'I', 'Modern Business Practices'),
('BCA', 'II', 'Mathematics-II'),
('BCA', 'II', 'Digital Logic'),
('BCA', 'II', 'Microprocessor and Assembly Language'),
('BCA', 'II', 'Object-Oriented Programming in C++'),
('BCA', 'II', 'Financial Accounting'),
('BCA', 'III', 'Sociology'),
('BCA ', 'III', 'Computer Architecture'),
('BCA', 'III', 'Data Structure and Algorithm'),
('BCA', 'III', 'System Analysis and Design'),
('BCA', 'III', 'User Interface Design'),
('BCA', 'IV', 'Technology and Operations Management'),
('BCA', 'IV', 'Numerical Methods'),
('BCA', 'IV', 'Operating System'),
('BCA', 'IV', 'Computer Network'),
('BCA', 'IV', 'Database Management System'),
('BCA', 'V', 'Software Engineering'),
('BCA', 'V', 'Object-Oriented Analysis and Design'),
('BCA', 'V', 'Web Technology'),
('BCA', 'V', 'Computer Graphics'),
('BCA', 'V', 'Probability and Statistics'),
('BCA', 'VI', 'Research Methodology'),
('BCA', 'VI', 'Management Information System'),
('BCA', 'VI', 'Network Programming'),
('BCA', 'VI', 'Cloud Computing'),
('BCA', 'VI', 'Artificial Intelligence'),
('BCA', 'VII', 'Software Project Management'),
('BCA', 'VII', 'E-commerce'),
('BCA', 'VII', 'Advance Object Oriented Programming'),
('BCA', 'VII', 'Elective-I'),
('BCA', 'VIII', 'E-Governance'),
('BCA', 'VIII', 'Multimedia Application'),
('BCA', 'VIII', 'Dot Net Programming'),
('BCA', 'VIII', 'Electives-II');
