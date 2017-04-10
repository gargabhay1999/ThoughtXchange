-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 10, 2017 at 07:52 PM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `discussion`
--
CREATE DATABASE IF NOT EXISTS `discussion` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `discussion`;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `cat_id` int(8) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(255) NOT NULL,
  `cat_description` varchar(255) NOT NULL,
  PRIMARY KEY (`cat_id`),
  UNIQUE KEY `cat_name_unique` (`cat_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_name`, `cat_description`) VALUES
(19, 'Education', 'The recent trends in education technology and common problems faced by students'),
(20, 'Sports', 'Anything and everything about your favourite sport'),
(21, 'Environment', ''),
(22, 'Home & Garden', 'Ask for tips to redesign, decorate and beautify your home'),
(23, 'Health', 'Discuss any health-related matter here as Health is Wealth'),
(24, 'News & Events', 'What''s your view on things going on in the world?'),
(25, 'Entertainment', 'Movie and book reviews and trending music'),
(26, 'Cuisine', 'From Mexican to Indian, talk about whichever food you like');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `post_id` int(8) NOT NULL AUTO_INCREMENT,
  `post_content` text NOT NULL,
  `post_date` datetime NOT NULL,
  `post_topic` int(8) NOT NULL,
  `post_by` int(8) NOT NULL,
  PRIMARY KEY (`post_id`),
  KEY `post_topic` (`post_topic`),
  KEY `post_by` (`post_by`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_content`, `post_date`, `post_topic`, `post_by`) VALUES
(25, 'Internet and Web Programming, OOPs, Data Structure, Computer Architecture , Database Management Systems are very good courses for a CSE student.', '2016-10-20 13:56:51', 5, 3),
(26, 'I agree with Mrunmayi. :)\r\nLearning Java programming will also be very useful.', '2016-10-20 13:58:49', 5, 4),
(29, 'For efficient programming, Data Structures and Algorithms is a must-take course. As for other courses, a few are mandatory and rest depends on your field of interest.', '2016-10-21 10:51:10', 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE IF NOT EXISTS `topics` (
  `topic_id` int(8) NOT NULL AUTO_INCREMENT,
  `topic_subject` varchar(255) NOT NULL,
  `topic_date` datetime NOT NULL,
  `topic_cat` int(8) NOT NULL,
  `topic_by` int(8) NOT NULL,
  `topic_description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`topic_id`),
  KEY `topic_cat` (`topic_cat`),
  KEY `topic_by` (`topic_by`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`topic_id`, `topic_subject`, `topic_date`, `topic_cat`, `topic_by`, `topic_description`) VALUES
(5, 'VIT University', '2016-10-20 13:54:24', 19, 1, 'Which courses should a CSE student undertake? I am a Btech student at VIT Chennai.');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(8) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(30) NOT NULL,
  `user_pass` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_date` datetime NOT NULL,
  `user_level` int(8) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_name_unique` (`user_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_pass`, `user_email`, `user_date`, `user_level`) VALUES
(1, 'Anushka', 'e2dc6c91403aa5ffa6d8699c44d56421ecdff798', 'anushka.bohara@gmail.com', '2016-09-11 12:09:24', 1),
(3, 'Mrunmayi', 'fb7966397fc4bb1f0426e702cdc4223ca1dd9819', 'mrunmayipradeep.kulkarni2015@vit.ac.in', '2016-09-13 09:57:34', 1),
(4, 'Mahima', '9e27c3094face5ca8e897ce7f5941215d2e2ebfb', 'mahima@gmail.com', '2016-09-13 20:18:52', 0),
(5, 'syeda', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'syeda@gmail.com', '2016-09-14 00:15:33', 0),
(6, 'vijayalakshmi', '624362d9df0e3472a93c7906b88db9d853d4c0ba', 'vij.vitcs@gmail.com', '2016-09-16 12:21:04', 0),
(7, 'shikha', 'd8aa87b3a72eba79fe66a5e7f91391efe3b0395e', 'smriti1597@gmail.com', '2016-09-20 11:35:28', 0),
(8, '15BCE1167', '43a357a06806fc53cbc69230874dfec0d3619919', 'anushka.bohara2015@vit.ac.in', '2016-10-16 11:14:14', 1),
(9, 'Sakshi', '358d2450d7514de3693b88b401f7e4670577ca3f', 'sakshi.singh2015a@vit.ac.in', '2016-10-21 00:03:36', 0),
(10, 'pmukt97', 'e5d034fc6ee8689cb6aa9e3a379c83dc75060c4a', 'muktak.pandya2015@vit.ac.in', '2016-10-21 11:06:15', 0);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`post_topic`) REFERENCES `topics` (`topic_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `posts_ibfk_2` FOREIGN KEY (`post_by`) REFERENCES `users` (`user_id`) ON UPDATE CASCADE;

--
-- Constraints for table `topics`
--
ALTER TABLE `topics`
  ADD CONSTRAINT `topics_ibfk_1` FOREIGN KEY (`topic_cat`) REFERENCES `categories` (`cat_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `topics_ibfk_2` FOREIGN KEY (`topic_by`) REFERENCES `users` (`user_id`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
