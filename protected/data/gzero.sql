-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 13, 2014 at 05:28 PM
-- Server version: 5.6.14
-- PHP Version: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `gzero`
--

-- --------------------------------------------------------

--
-- Table structure for table `authassignment`
--

CREATE TABLE IF NOT EXISTS `authassignment` (
  `itemname` varchar(64) NOT NULL,
  `userid` varchar(64) NOT NULL,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`itemname`,`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `authassignment`
--

INSERT INTO `authassignment` (`itemname`, `userid`, `bizrule`, `data`) VALUES
('admin', '1', NULL, 'N;'),
('user', '10', NULL, 'N;'),
('user', '11', NULL, 'N;'),
('user', '12', NULL, 'N;'),
('user', '13', NULL, 'N;'),
('user', '14', NULL, 'N;'),
('user', '15', NULL, 'N;'),
('user', '16', NULL, 'N;'),
('user', '17', NULL, 'N;'),
('user', '18', NULL, 'N;'),
('user', '19', NULL, 'N;'),
('user', '20', NULL, 'N;'),
('user', '21', NULL, 'N;'),
('user', '22', NULL, 'N;'),
('user', '23', NULL, 'N;'),
('user', '25', NULL, 'N;'),
('user', '26', NULL, 'N;'),
('user', '27', NULL, 'N;'),
('user', '28', NULL, 'N;'),
('user', '3', NULL, 'N;'),
('user', '30', NULL, 'N;'),
('user', '32', NULL, 'N;'),
('user', '33', NULL, 'N;'),
('user', '34', NULL, 'N;'),
('user', '35', NULL, 'N;'),
('user', '37', NULL, 'N;'),
('user', '38', NULL, 'N;'),
('user', '4', NULL, 'N;'),
('user', '40', NULL, 'N;'),
('user', '42', NULL, 'N;'),
('user', '43', NULL, 'N;'),
('user', '45', NULL, 'N;'),
('user', '46', NULL, 'N;'),
('user', '47', NULL, 'N;'),
('user', '48', NULL, 'N;'),
('user', '49', NULL, 'N;'),
('user', '5', NULL, 'N;'),
('user', '50', NULL, 'N;'),
('user', '51', NULL, 'N;'),
('user', '52', NULL, 'N;'),
('user', '54', NULL, 'N;'),
('user', '55', NULL, 'N;'),
('user', '56', NULL, 'N;'),
('user', '58', NULL, 'N;'),
('user', '59', NULL, 'N;'),
('user', '6', NULL, 'N;'),
('user', '60', NULL, 'N;'),
('user', '7', NULL, 'N;'),
('user', '8', NULL, 'N;'),
('user', '9', NULL, 'N;');

-- --------------------------------------------------------

--
-- Table structure for table `authitem`
--

CREATE TABLE IF NOT EXISTS `authitem` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `authitem`
--

INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES
('admin', 1, '', NULL, 'N;'),
('user', 2, '', NULL, 'N;');

-- --------------------------------------------------------

--
-- Table structure for table `authitemchild`
--

CREATE TABLE IF NOT EXISTS `authitemchild` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE IF NOT EXISTS `config` (
  `option` varchar(128) NOT NULL,
  `value` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`option`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`option`, `value`) VALUES
('description', 'Yii-GZero'),
('name', 'Yii-GZero'),
('settings_cdn', '0'),
('settings_google_analytic', '11'),
('skin_background_uri', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

CREATE TABLE IF NOT EXISTS `page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slug` varchar(128) NOT NULL,
  `title_en` varchar(128) NOT NULL,
  `title_ar` varchar(128) NOT NULL,
  `body_en` text NOT NULL,
  `body_ar` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `page`
--

INSERT INTO `page` (`id`, `slug`, `title_en`, `title_ar`, `body_en`, `body_ar`, `created_at`) VALUES
(13, 'about', 'about', 'من نحن', '<p>This is about page !</p>', '<p>صفحة من نحن</p>', '2014-02-12 10:14:14');

-- --------------------------------------------------------

--
-- Table structure for table `sm_list`
--

CREATE TABLE IF NOT EXISTS `sm_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `query` text NOT NULL,
  `email_field` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_sm_list_name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sm_queue`
--

CREATE TABLE IF NOT EXISTS `sm_queue` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `to` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `headers` text NOT NULL,
  `status` int(11) NOT NULL,
  `create_time` timestamp NULL DEFAULT NULL,
  `update_time` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_sm_queue_to` (`to`),
  KEY `idx_sm_queue_subject` (`subject`),
  KEY `idx_sm_queue_status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sm_template`
--

CREATE TABLE IF NOT EXISTS `sm_template` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `from` varchar(255) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `body` text,
  `alternative_body` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_sm_template_name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `sm_template`
--

INSERT INTO `sm_template` (`id`, `name`, `description`, `from`, `subject`, `body`, `alternative_body`) VALUES
(1, 'forgot_password', NULL, 'info@livemena.com', 'Yii-GZero fortgot password email', 'Hello __name__,<br/>\r\n<p>\r\nReset passowrd url: <a href="__url__">__url__</a>\r\n</p>', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_migration`
--

CREATE TABLE IF NOT EXISTS `tbl_migration` (
  `version` varchar(255) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_migration`
--

INSERT INTO `tbl_migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1392306406),
('m140213_154829_add_simplemailer_tables', 1392306536);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(128) CHARACTER SET utf8 NOT NULL,
  `last_name` varchar(128) NOT NULL,
  `gender` tinyint(4) NOT NULL,
  `birth` date NOT NULL,
  `facebook_id` bigint(20) NOT NULL,
  `google_id` bigint(20) NOT NULL,
  `twitter_id` bigint(20) NOT NULL,
  `key` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=61 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `first_name`, `last_name`, `gender`, `birth`, `facebook_id`, `google_id`, `twitter_id`, `key`) VALUES
(1, 'admin@admin.com', 'e10adc3949ba59abbe56e057f20f883e', 'Admin', 'Admin', 0, '0000-00-00', 0, 0, 0, '8612c55d2969d1f587bf1c5aaaa32964'),
(2, 'user@user.com', 'e10adc3949ba59abbe56e057f20f883e', 'Anas', '', 0, '0000-00-00', 0, 0, 0, '');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `authassignment`
--
ALTER TABLE `authassignment`
  ADD CONSTRAINT `authassignment_ibfk_1` FOREIGN KEY (`itemname`) REFERENCES `authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `authitemchild`
--
ALTER TABLE `authitemchild`
  ADD CONSTRAINT `authitemchild_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `authitemchild_ibfk_2` FOREIGN KEY (`child`) REFERENCES `authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
