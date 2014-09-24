-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 08, 2014 at 07:39 PM
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
-- Table structure for table `gz_authassignment`
--

CREATE TABLE IF NOT EXISTS `gz_authassignment` (
  `itemname` varchar(64) NOT NULL,
  `userid` varchar(64) NOT NULL,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`itemname`,`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gz_authassignment`
--

INSERT INTO `gz_authassignment` (`itemname`, `userid`, `bizrule`, `data`) VALUES
('admin', '1', NULL, 'N;'),
('user', '2', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `gz_authitem`
--

CREATE TABLE IF NOT EXISTS `gz_authitem` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gz_authitem`
--

INSERT INTO `gz_authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES
('admin', 1, '', NULL, 'N;'),
('user', 2, '', NULL, 'N;');

-- --------------------------------------------------------

--
-- Table structure for table `gz_authitemchild`
--

CREATE TABLE IF NOT EXISTS `gz_authitemchild` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `gz_config`
--

CREATE TABLE IF NOT EXISTS `gz_config` (
  `option` varchar(128) NOT NULL,
  `value` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`option`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gz_config`
--

INSERT INTO `gz_config` (`option`, `value`) VALUES
('description', 'Yii-GZero'),
('name', 'Yii-GZero'),
('settings_cdn', '1'),
('settings_google_analytic', '11'),
('skin_background_uri', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `gz_message`
--

CREATE TABLE IF NOT EXISTS `gz_message` (
  `id` int(11) NOT NULL DEFAULT '0',
  `language` varchar(16) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `translation` text CHARACTER SET utf8,
  PRIMARY KEY (`id`,`language`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gz_message`
--

INSERT INTO `gz_message` (`id`, `language`, `translation`) VALUES
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
(13, 'en', 'verifyCode'),
(14, 'ar', 'الإسم'),
(14, 'en', 'First Name'),
(15, 'ar', 'دخول'),
(15, 'en', 'Login'),
(16, 'ar', 'العائلة'),
(16, 'en', 'Last Name'),
(17, 'ar', 'الإيميل'),
(17, 'en', 'Email'),
(18, 'ar', 'الجنس'),
(18, 'en', 'Gender'),
(19, 'ar', 'كلمة السر'),
(19, 'en', 'Password'),
(20, 'ar', 'تأكيد كلمة السر'),
(20, 'en', 'Verify Password'),
(21, 'ar', 'إرسال'),
(21, 'en', 'Submit');

-- --------------------------------------------------------

--
-- Table structure for table `gz_migration`
--

CREATE TABLE IF NOT EXISTS `gz_migration` (
  `version` varchar(255) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gz_migration`
--

INSERT INTO `gz_migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1392306406),
('m140213_154829_add_simplemailer_tables', 1392306536);

-- --------------------------------------------------------

--
-- Table structure for table `gz_page`
--

CREATE TABLE IF NOT EXISTS `gz_page` (
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
-- Dumping data for table `gz_page`
--

INSERT INTO `gz_page` (`id`, `slug`, `title_en`, `title_ar`, `body_en`, `body_ar`, `created_at`) VALUES
(13, 'about', 'about', 'من نحن', '<p>This is about page !</p>', '<p>صفحة من نحن</p>', '2014-02-12 10:14:14');

-- --------------------------------------------------------

--
-- Table structure for table `gz_sm_list`
--

CREATE TABLE IF NOT EXISTS `gz_sm_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `description` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `query` text CHARACTER SET latin1 NOT NULL,
  `email_field` varchar(255) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_sm_list_name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `gz_sm_queue`
--

CREATE TABLE IF NOT EXISTS `gz_sm_queue` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `to` varchar(255) CHARACTER SET latin1 NOT NULL,
  `subject` varchar(255) CHARACTER SET latin1 NOT NULL,
  `body` text CHARACTER SET latin1 NOT NULL,
  `headers` text CHARACTER SET latin1 NOT NULL,
  `status` int(11) NOT NULL,
  `create_time` timestamp NULL DEFAULT NULL,
  `update_time` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_sm_queue_to` (`to`),
  KEY `idx_sm_queue_subject` (`subject`),
  KEY `idx_sm_queue_status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `gz_sm_template`
--

CREATE TABLE IF NOT EXISTS `gz_sm_template` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `description` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `from` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `subject` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `body` text CHARACTER SET latin1,
  `alternative_body` text CHARACTER SET latin1,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_sm_template_name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `gz_sm_template`
--

INSERT INTO `gz_sm_template` (`id`, `name`, `description`, `from`, `subject`, `body`, `alternative_body`) VALUES
(1, 'forgot_password', NULL, 'info@livemena.com', 'Yii-GZero fortgot password email', 'Hello __name__,<br/>\r\n<p>\r\nReset passowrd url: <a href="__url__">__url__</a>\r\n</p>', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `gz_source_message`
--

CREATE TABLE IF NOT EXISTS `gz_source_message` (
  `id` int(11) NOT NULL,
  `category` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT 'app',
  `message` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  UNIQUE KEY `id_2` (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gz_source_message`
--

INSERT INTO `gz_source_message` (`id`, `category`, `message`) VALUES
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
(13, 'app', 'verifycode'),
(14, 'app', 'first_name'),
(15, 'app', 'login'),
(16, 'app', 'last_name'),
(17, 'app', 'email'),
(18, 'app', 'gender'),
(19, 'app', 'password'),
(20, 'app', 'verifyPassword'),
(21, 'app', 'submit');

-- --------------------------------------------------------

--
-- Table structure for table `gz_user`
--

CREATE TABLE IF NOT EXISTS `gz_user` (
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
-- Dumping data for table `gz_user`
--

INSERT INTO `gz_user` (`id`, `email`, `password`, `first_name`, `last_name`, `gender`, `birth`, `facebook_id`, `google_id`, `twitter_id`, `key`) VALUES
(1, 'admin@admin.com', 'e10adc3949ba59abbe56e057f20f883e', 'Admin', 'Admin', 0, '0000-00-00', 0, 0, 0, '8612c55d2969d1f587bf1c5aaaa32964'),
(2, 'user@user.com', 'e10adc3949ba59abbe56e057f20f883e', 'Anas', '', 0, '0000-00-00', 0, 0, 0, '');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `gz_authassignment`
--
ALTER TABLE `gz_authassignment`
  ADD CONSTRAINT `gz_authassignment_ibfk_1` FOREIGN KEY (`itemname`) REFERENCES `gz_authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `gz_authitemchild`
--
ALTER TABLE `gz_authitemchild`
  ADD CONSTRAINT `gz_authitemchild_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `gz_authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `gz_authitemchild_ibfk_2` FOREIGN KEY (`child`) REFERENCES `gz_authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `gz_message`
--
ALTER TABLE `gz_message`
  ADD CONSTRAINT `FK_Message_SourceMessage` FOREIGN KEY (`id`) REFERENCES `gz_source_message` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
