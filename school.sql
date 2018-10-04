-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 25, 2018 at 11:23 PM
-- Server version: 5.7.21
-- PHP Version: 7.0.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `school`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

DROP TABLE IF EXISTS `courses`;
CREATE TABLE IF NOT EXISTS `courses` (
  `course_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `course_name` varchar(255) NOT NULL,
  `course_description` varchar(255) NOT NULL,
  `course_image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`course_id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_id`, `course_name`, `course_description`, `course_image`) VALUES
(16, 'Jumping off a cliff.', 'In this course you will be jumping off a cliff in order to motivate yourself to fly. Don\'t forget to flap your arms very very fast.', '../uploads/Jumping off a cliff..jpg'),
(15, 'Flapping your arms', 'In this course you will learn to flap your arms very very fast.\nEventually you will start to fly.', '../uploads/Flapping your arms.jpg'),
(17, 'Instrument Rating', 'Useful when flying long distances and a must for professional pilots.', '../uploads/Instrument Rating.jpg'),
(18, 'Flight Instructor', 'The Instrument Rating Instructor license allows holders to provide IR(A) training to pilots. Many pilots wishing to enter professional aviation positions become Flight Instructors in order to build the necessary experience.', '../uploads/Flight Instructor.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
CREATE TABLE IF NOT EXISTS `student` (
  `student_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_name` varchar(200) NOT NULL,
  `student_phone` varchar(200) NOT NULL,
  `student_email` varchar(200) NOT NULL,
  `student_image` varchar(200) NOT NULL,
  PRIMARY KEY (`student_id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`student_id`, `student_name`, `student_phone`, `student_email`, `student_image`) VALUES
(8, 'Avi Dichter', '02-6408460', 'davraham@KNESSET.GOV.IL', '../uploads/Avi Dichter.jpg'),
(14, 'Yoel Razvozov', '02-6408004', 'yrazvozov@knesset.gov.il', '../uploads/Yoel Razvozov.jpg'),
(11, 'Meir Cohen ', '02-6408397', 'cohenmeir@KNESSET.GOV.IL', '../uploads/Meir Cohen .jpg'),
(12, 'Itzik Shmuli', '02-6408064', 'ishmuli@knesset.gov.il', '../uploads/Itzik Shmuli.jpg'),
(13, 'Ksenia Svetlova', '02-6408112', 'ksenias@KNESSET.GOV.IL', '../uploads/Ksenia Svetlova.jpg'),
(16, 'Revital Swid ', '02-6408192', 'revitals@KNESSET.GOV.IL', '../uploads/Revital Swid .jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(200) NOT NULL,
  `user_email` varchar(200) NOT NULL,
  `user_password` varchar(200) NOT NULL,
  `user_phone` varchar(200) NOT NULL,
  `user_role` varchar(200) DEFAULT NULL,
  `user_image` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_name`, `user_email`, `user_password`, `user_phone`, `user_role`, `user_image`) VALUES
(13, 'Sharren  Haskel ', 'shaskel@KNESSET.GOV.IL', '841acb657f35b6dba96164d074bb13ebb048c9eb', '02-6408109', 'sales', '../uploads/Sharren  Haskel .jpg'),
(14, 'Gila Gamliel ', 'ggamliel@KNESSET.GOV.IL', 'f71429157eca1df70a255e562f92ecf72f1ba283', '02-6408463', 'manager', '../uploads/Gila Gamliel .jpg'),
(18, 'Amir Ohana', 'amiro@KNESSET.GOV.IL', '0ef120023bd0d133c3d4cde955bdb2484089769e', '02-6408311', 'manager', '../uploads/Amir Ohana.jpg'),
(17, 'Nurit Koren', 'nkoren@KNESSET.GOV.IL', '9d0b2c4f8e8d9d4f48b1f37e25515ac1277f7342', '02-6408007', 'manager', '../uploads/Nurit Koren.jpg'),
(15, 'Oren Asaf Hazan', 'ohazan@KNESSET.GOV.IL', '4b84eee139afed0e5c409946389a22b34f81aee7', '02-6408866', 'sales', '../uploads/Oren Asaf Hazan.jpg');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
