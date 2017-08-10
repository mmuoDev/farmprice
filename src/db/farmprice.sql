-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 10, 2017 at 05:17 AM
-- Server version: 5.7.9
-- PHP Version: 7.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `farmprice`
--

-- --------------------------------------------------------

--
-- Table structure for table `farm_prices`
--

DROP TABLE IF EXISTS `farm_prices`;
CREATE TABLE IF NOT EXISTS `farm_prices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `produce_id` int(11) NOT NULL,
  `price` float(10,2) NOT NULL,
  `day` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `farm_prices`
--

INSERT INTO `farm_prices` (`id`, `user_id`, `produce_id`, `price`, `day`) VALUES
(1, 1, 2, 133873.00, '2017-08-10 03:40:46'),
(2, 1, 1, 150450.00, '2017-08-10 03:44:44'),
(3, 3, 1, 100450.00, '2017-08-10 03:48:28');

-- --------------------------------------------------------

--
-- Table structure for table `produce`
--

DROP TABLE IF EXISTS `produce`;
CREATE TABLE IF NOT EXISTS `produce` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produce`
--

INSERT INTO `produce` (`id`, `name`, `description`) VALUES
(1, 'cassava', 'cassava is grown in Lagos'),
(2, 'maize', 'Maize is a crop eaten by all people');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `state` varchar(20) NOT NULL,
  `about` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `state`, `about`) VALUES
(1, 'joe doe', 'lagos', 'joe doe is good'),
(2, 'rick ross', 'abia', 'joe doe is good'),
(3, 'french montana', 'Jigawa', 'joe doe is good'),
(4, 'Pep Je', 'Ogun', 'joe doe is good');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
