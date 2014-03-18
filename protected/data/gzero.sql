-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 18, 2014 at 01:44 PM
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
('user', '2', NULL, NULL);

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
('settings_cdn', '1'),
('settings_google_analytic', '11'),
('skin_background_uri', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `id` int(11) NOT NULL DEFAULT '0',
  `language` varchar(16) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `translation` text CHARACTER SET utf8,
  PRIMARY KEY (`id`,`language`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `language`, `translation`) VALUES
(1, 'ar', 'آي دي'),
(1, 'en', 'Id'),
(2, 'ar', ''),
(2, 'en', 'Slug'),
(3, 'en', 'Title En'),
(4, 'ar', 'العنوان'),
(4, 'en', 'Title Ar'),
(5, 'en', 'Body En'),
(6, 'ar', 'بودي'),
(6, 'en', 'Body Arabic'),
(7, 'en', 'Created At'),
(8, 'ar', 'جوجل'),
(8, 'en', 'google'),
(9, 'ar', 'من نحن'),
(9, 'en', 'About us'),
(10, 'ar', 'اتصل بنا'),
(10, 'en', 'Contact'),
(11, 'ar', 'الرئيسية'),
(11, 'en', 'Home'),
(12, 'ar', 'الإدارة'),
(12, 'en', 'Admin'),
(13, 'ar', 'رموز التحقق'),
(13, 'en', 'verifyCode');

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
-- Table structure for table `source_message`
--

CREATE TABLE IF NOT EXISTS `source_message` (
  `id` int(11) NOT NULL,
  `category` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT 'app',
  `message` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  UNIQUE KEY `id_2` (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `source_message`
--

INSERT INTO `source_message` (`id`, `category`, `message`) VALUES
(1, 'app', 'page.id'),
(2, 'app', 'page.slug'),
(3, 'app', 'page.title_en'),
(4, 'app', 'page.title_ar'),
(5, 'app', 'page.body_en'),
(6, 'app', 'page.body_ar'),
(7, 'app', 'page.created_at'),
(8, 'app', 'google'),
(9, 'app', 'aboutus'),
(10, 'app', 'contact'),
(11, 'app', 'home'),
(12, 'app', 'admin'),
(13, 'app', 'verifycode');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

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

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `FK_Message_SourceMessage` FOREIGN KEY (`id`) REFERENCES `source_message` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
