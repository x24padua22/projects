-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 18, 2013 at 03:38 AM
-- Server version: 5.5.24-log
-- PHP Version: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `orm_exercise`
--

-- --------------------------------------------------------

--
-- Table structure for table `time_records`
--

CREATE TABLE IF NOT EXISTS `time_records` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `log_in` datetime NOT NULL,
  `log_out` datetime NOT NULL,
  `notes` longtext NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `time_records`
--

INSERT INTO `time_records` (`id`, `user_id`, `log_in`, `log_out`, `notes`, `created_at`, `updated_at`) VALUES
(1, 1, '2013-03-01 06:02:07', '2013-03-01 15:43:46', 'Worked on the login application', '2013-03-01 06:02:07', NULL),
(2, 1, '2013-03-02 06:09:09', '2013-03-02 17:42:40', 'Worked on the displaying and editing of data.', '2013-03-02 06:09:09', NULL),
(3, 2, '2013-03-01 09:07:10', '2013-03-01 18:41:03', 'Processed business papers.', '2013-03-01 09:07:10', NULL),
(4, 2, '2013-03-02 03:06:07', '2013-03-02 17:41:34', 'Meeting and brainstorming.', '2013-03-02 03:06:07', NULL),
(5, 3, '2013-03-01 04:07:05', '2013-03-01 15:47:40', 'Fixed bugs on the application', '2013-03-01 04:07:05', NULL),
(6, 4, '2013-03-01 06:10:13', '2013-03-01 16:41:48', 'Attended training.', '2013-03-01 06:10:13', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'KB', 'Tonel', 'kb@village88.com', '6a204bd89f3c8348afd5c77c717a097a', '2012-12-18 05:18:15', '2013-04-01 10:21:14'),
(2, 'Oliver', 'Rosales', 'oliver@village88.com', '6a204bd89f3c8348afd5c77c717a097a', '2012-09-18 10:26:20', '2013-03-01 06:13:16'),
(3, 'John', 'Smith', 'js@yahoo.com', '6a204bd89f3c8348afd5c77c717a097a', '2012-05-20 07:16:15', '2013-03-01 02:08:00'),
(4, 'Michael', 'Jordan', 'mj@gmail.com', '6a204bd89f3c8348afd5c77c717a097a', '2012-10-18 07:27:28', '2013-03-01 02:04:06');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
