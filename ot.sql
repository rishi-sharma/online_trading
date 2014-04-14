-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 14, 2014 at 08:33 AM
-- Server version: 5.5.32
-- PHP Version: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ot`
--
CREATE DATABASE IF NOT EXISTS `online_trading` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `online_trading`;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE IF NOT EXISTS `cart` (
  `user_nm` varchar(100) NOT NULL,
  `qty` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  PRIMARY KEY (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `item_nm` varchar(100) NOT NULL,
  `delivery_type` varchar(50) NOT NULL DEFAULT 'normal',
  `pic_loc` varchar(100) NOT NULL,
  `user_nm` varchar(100) NOT NULL,
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `quantity` int(11) NOT NULL,
  `cost` int(11) NOT NULL,
  `item_condition` varchar(50) NOT NULL,
  `description` varchar(500) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `type` varchar(10) NOT NULL,
  `promotion_amnt` int(11) NOT NULL,
  `category` varchar(100) NOT NULL,
  `last_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `tax` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`item_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_nm`, `delivery_type`, `pic_loc`, `user_nm`, `item_id`, `quantity`, `cost`, `item_condition`, `description`, `timestamp`, `type`, `promotion_amnt`, `category`, `last_date`, `tax`) VALUES
('Tulip Bouquet', 'instant', 'just tulips.jpeg', 'sdjfhas', 1, 0, 111, 'New', 'gsaddgsad', '2014-04-14 04:52:53', 'sgdas', 111, 'sadfsa', '0000-00-00 00:00:00', 12),
('card', 'normal', 'btrfly.jpg', 'sdjfhas', 2, 56, 185, 'New', 'gsaddgsad', '2014-04-14 05:49:58', 'sgdas', 111, 'sadfsa', '0000-00-00 00:00:00', 13),
('cart uml', 'normal', 'cart.png', 'sdjfhas', 3, 424, 1000, 'New', 'gsaddgsad', '2014-04-14 05:34:23', 'sgdas', 111, 'sadfsa', '0000-00-00 00:00:00', 5),
('how are u', 'normal', 'btrfly.jpg', 'sdjfhas', 4, 95, 1885, 'Old', 'gsaddgsad', '2014-04-14 06:21:20', 'sgdas', 111, 'sadfsa', '0000-00-00 00:00:00', 10),
('bla-bla', 'instant', 'cart.png', 'khilhg', 5, 44, 55555, 'New', 'jllllllllllllllll', '2014-04-14 06:15:53', '', 444, '', '0000-00-00 00:00:00', 5);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `user_nm` varchar(100) NOT NULL,
  `qty` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `txn_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` varchar(50) NOT NULL,
  `order_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `delivery_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` varchar(25) NOT NULL,
  `address` varchar(200) NOT NULL,
  `delivery_type` varchar(100) NOT NULL,
  PRIMARY KEY (`txn_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=80 ;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`user_nm`, `qty`, `item_id`, `txn_id`, `order_id`, `order_time`, `delivery_time`, `status`, `address`, `delivery_type`) VALUES
('ayantika', 1, 1, 1, '20140413BB28', '2013-08-06 03:06:58', '2014-04-14 07:00:00', 'Delivered', '', ''),
('ayantika', 1, 1, 3, '201404137DDB', '2013-10-26 03:06:58', '2014-04-14 07:00:00', 'Delivered', '', ''),
('ayantika', 1, 1, 5, '20140413093D', '2013-11-30 03:06:58', '2014-04-14 07:00:00', 'Delivered', '', ''),
('ayantika', 1, 1, 7, '20140413D51E', '2014-04-14 03:06:58', '2014-04-14 07:00:00', 'Delivered', '', ''),
('ayantika', 1, 1, 9, '2014041377FF', '2014-04-14 03:06:58', '2014-04-14 07:00:00', 'Delivered', '', ''),
('ayantika', 1, 1, 11, '2014041369A9', '2014-04-14 03:06:58', '2014-04-14 07:00:00', 'Delivered', 'C-102,Subansiri,\r\nIIT Guwahati,\r\nGuwahati-781039,\r\nAssam', 'instant'),
('ayantika', 1, 1, 13, '201404136E48', '2014-04-14 03:06:58', '2014-04-14 07:00:00', 'Delivered', 'dfx xzc,sdcdzs', 'instant'),
('ayantika', 1, 1, 15, '20140413B779', '2014-04-14 03:06:58', '2014-04-14 07:00:00', 'Delivered', 'gfcmnbm hjbmn,,gjkn,m,.m,.yyy', 'instant'),
('ayantika', 1, 1, 17, '201404137B5D', '2014-04-14 03:06:58', '2014-04-14 07:00:00', 'Delivered', 'gfcmnbm hjbmn,,gjkn,m,.m,.yyy', 'instant'),
('ayantika', 1, 1, 19, '201404134AD9', '2014-04-14 03:06:58', '2014-04-14 07:00:00', 'Delivered', 'gfcmnbm hjbmn,,gjkn,m,.m,.yyy', 'instant'),
('ayantika', 1, 1, 21, '20140413E2F3', '2014-04-14 03:06:58', '2014-04-14 07:00:00', 'Delivered', 'gfcmnbm hjbmn,,gjkn,m,.m,.yyy', 'instant'),
('ayantika', 1, 1, 23, '201404136350', '2014-04-14 03:06:58', '2014-04-14 07:00:00', 'Delivered', 'gfcmnbm hjbmn,,gjkn,m,.m,.yyy', 'instant'),
('ayantika', 1, 1, 25, '20140413E1D3', '2014-04-14 03:06:58', '2014-04-14 07:00:00', 'Delivered', 'gfcmnbm hjbmn,,gjkn,m,.m,.yyy', 'instant'),
('ayantika', 1, 1, 37, '2014041410C1', '2014-04-14 03:06:58', '2014-04-14 07:00:00', 'Delivered', 'gfcmnbm hjbmn,,gjkn,m,.m,.yyy', 'instant'),
('ayantika', 1, 1, 39, '20140414F387', '2014-04-14 03:06:58', '2014-04-14 07:00:00', 'Delivered', 'gfcmnbm hjbmn,,gjkn,m,.m,.yyy', 'instant'),
('ayantika', 1, 1, 43, '201404143483', '2014-04-14 03:06:58', '2014-04-14 07:00:00', 'Delivered', 'gfcmnbm hjbmn,,gjkn,m,.m,.yyy', 'instant'),
('ayantika', 1, 1, 45, '20140414B745', '2014-04-14 03:06:58', '2014-04-14 07:00:00', 'Delivered', 'gfcmnbm hjbmn,,gjkn,m,.m,.yyy', 'instant'),
('ayantika', 1, 1, 47, '2014041442BD', '2014-04-14 03:06:58', '2014-04-14 07:00:00', 'Delivered', 'gfcmnbm hjbmn,,gjkn,m,.m,.yyy', 'instant'),
('ayantika', 1, 1, 49, '201404140EC2', '2014-04-14 03:06:58', '2014-04-14 07:00:00', 'Delivered', 'gfcmnbm hjbmn,,gjkn,m,.m,.yyy', 'instant'),
('ayantika', 1, 1, 52, '20140414C664', '2014-04-14 03:06:58', '2014-04-14 07:00:00', 'Delivered', 'gfcmnbm hjbmn,,gjkn,m,.m,.yyy', 'instant'),
('ayantika', 2, 1, 54, '201404144532', '2014-04-14 03:06:58', '2014-04-14 07:00:00', 'Delivered', 'efseed sddffd eeffdsdf', 'instant'),
('ayantika', 1, 1, 55, '2014041493FD', '2014-04-14 03:06:58', '2014-04-14 07:00:00', 'Delivered', 'efseed sddffd eeffdsdf', 'instant'),
('ayantika', 1, 1, 56, '2014041482E8', '2014-04-14 03:06:58', '2014-04-14 07:00:00', 'Delivered', 'efseed sddffd eeffdsdf', 'instant'),
('ayantika', 0, 0, 57, '2014041418CE', '2014-04-14 03:11:34', '0000-00-00 00:00:00', 'Not Delivered', 'efseed sddffd eeffdsdf', ''),
('ayantika', 1, 2, 58, '2014041418CE', '2014-04-14 03:11:34', '0000-00-00 00:00:00', 'Not Delivered', 'efseed sddffd eeffdsdf', 'normal'),
('ayantika', 1, 1, 59, '201404144991', '2014-04-14 03:15:29', '0000-00-00 00:00:00', 'Not Delivered', 'efseed sddffd eeffdsdf', 'instant'),
('ayantika', 0, 0, 60, '20140414CE48', '2014-04-14 03:20:45', '0000-00-00 00:00:00', 'Not Delivered', 'efseed sddffd eeffdsdf', ''),
('ayantika', 1, 2, 61, '20140414CE48', '2014-04-14 03:20:45', '0000-00-00 00:00:00', 'Not Delivered', 'efseed sddffd eeffdsdf', 'normal'),
('ayantika', 1, 1, 62, '201404149903', '2014-04-14 03:24:46', '0000-00-00 00:00:00', 'Not Delivered', 'efseed sddffd eeffdsdf', 'instant'),
('ayantika', 0, 0, 63, '2014041444D2', '2014-04-14 03:34:07', '0000-00-00 00:00:00', 'Not Delivered', 'efseed sddffd eeffdsdf', ''),
('ayantika', 1, 2, 64, '20140414E005', '2014-04-14 03:34:08', '0000-00-00 00:00:00', 'Not Delivered', 'efseed sddffd eeffdsdf', 'normal'),
('ayantika', 1, 2, 65, '20140414CBF4', '2014-04-14 03:39:07', '0000-00-00 00:00:00', 'Not Delivered', 'efseed sddffd eeffdsdf', ''),
('ayantika', 1, 2, 66, '20140414D188', '2014-04-14 03:40:54', '0000-00-00 00:00:00', 'Not Delivered', 'efseed sddffd eeffdsdf', ''),
('ayantika', 1, 2, 67, '20140414E37B', '2014-04-14 03:41:45', '0000-00-00 00:00:00', 'Not Delivered', 'efseed sddffd eeffdsdf', ''),
('ayantika', 1, 1, 68, '201404142B96', '2014-04-14 03:56:54', '0000-00-00 00:00:00', 'Not Delivered', 'efseed sddffd eeffdsdf', 'instant'),
('ayantika', 5, 1, 69, '20140414F628', '2014-04-14 04:11:21', '0000-00-00 00:00:00', 'Not Delivered', 'efseed sddffd eeffdsdf', 'normal'),
('ayantika', 3, 2, 70, '20140414A7C9', '2014-04-14 04:12:45', '0000-00-00 00:00:00', 'Not Delivered', 'C/O: Aya kit<br>jnpij, ihpiyu.v,.j;vofu', 'normal'),
('ayantika', 3, 1, 71, '201404148B72', '2014-04-14 04:17:21', '0000-00-00 00:00:00', 'Not Delivered', 'efseed sddffd eeffdsdf', 'normal'),
('ayantika', 4, 2, 72, '201404146806', '2014-04-14 04:41:40', '0000-00-00 00:00:00', 'Not Delivered', 'efseed sddffd eeffdsdf', 'normal'),
('ayantika', 6, 3, 73, '201404146806', '2014-04-14 04:41:40', '0000-00-00 00:00:00', 'Not Delivered', 'efseed sddffd eeffdsdf', 'normal'),
('ayantika', 8, 4, 74, '201404146806', '2014-04-14 04:41:40', '0000-00-00 00:00:00', 'Not Delivered', 'efseed sddffd eeffdsdf', 'normal'),
('ayantika', 1, 1, 75, '20140414A617', '2014-04-14 04:52:53', '0000-00-00 00:00:00', 'Not Delivered', 'efseed sddffd eeffdsdf', 'instant'),
('ayantika', 2, 3, 76, '20140414DF39', '2014-04-14 05:34:23', '0000-00-00 00:00:00', 'Not Delivered', 'efseed sddffd eeffdsdf', 'normal'),
('ayantika', 6, 2, 77, '201404149891', '2014-04-14 05:49:58', '0000-00-00 00:00:00', 'Not Delivered', 'efseed sddffd eeffdsdf', 'normal'),
('ayantika', 1, 5, 78, '201404141975', '2014-04-14 06:15:53', '0000-00-00 00:00:00', 'Not Delivered', 'efseed sddffd eeffdsdf', 'instant'),
('ayantika', 10, 4, 79, '20140414174B', '2014-04-14 06:21:20', '0000-00-00 00:00:00', 'Not Delivered', 'efseed sddffd eeffdsdf', 'normal');

-- --------------------------------------------------------

--
-- Table structure for table `saved_list`
--

CREATE TABLE IF NOT EXISTS `saved_list` (
  `user_nm` varchar(100) NOT NULL,
  `qty` int(11) NOT NULL,
  `item_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `saved_list`
--

INSERT INTO `saved_list` (`user_nm`, `qty`, `item_id`) VALUES
('ayantika', 4, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;