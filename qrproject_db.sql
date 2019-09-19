-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 19, 2019 at 07:40 AM
-- Server version: 5.7.23
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `qrproject_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(60) NOT NULL,
  `lastname` varchar(60) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` int(10) NOT NULL,
  `gender` char(1) NOT NULL,
  `password` varchar(255) NOT NULL,
  `confirmation_token` varchar(70) DEFAULT NULL,
  `confirmed_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=52 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `email`, `phone`, `gender`, `password`, `confirmation_token`, `confirmed_at`) VALUES
(49, '', '', 'badrbej', 'badrbej@mail.com', 0, '', '$2y$10$oLs9ZkFh97uSB82f5kqV2eTRsIAtDvwoh1o6uNNTbNgTbNw4eDtzC', NULL, '2019-09-15 17:15:17'),
(50, '', '', 'azeaze', 'azeaze@ze.dz', 0, 'h', '$2y$10$nWAFHth/9MEaie4G0sBBMOIzZ4JbZY8kwTGB2eGumt/OxBspgYImO', 'y60TpZhAqmbVDkeuc62975bZJGzLsXqOjIkOKH0uqvJ68twseCLwpAJrapMd', NULL),
(51, 'azeaze', 'azeaze', 'azcssdsdv', 'dvvv@ezfz.cm', 696845065, 'm', '$2y$10$tHNd3aTFOVe/UQaj2KO5i.J00oA0ItWDKJqEtyEVdlhgaJ4B4b2ta', NULL, '2019-09-19 07:26:25');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
