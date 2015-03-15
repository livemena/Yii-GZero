-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 15, 2015 at 10:27 AM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

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
  `data` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `authassignment`
--

INSERT INTO `authassignment` (`itemname`, `userid`, `bizrule`, `data`) VALUES
('admin', '1', NULL, 'N;'),
('user', '2', NULL, NULL),
('user', '3', NULL, 'N;');

-- --------------------------------------------------------

--
-- Table structure for table `authitem`
--

CREATE TABLE IF NOT EXISTS `authitem` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `bizrule` text,
  `data` text
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
  `child` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `id` int(11) NOT NULL DEFAULT '0',
  `language` varchar(16) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `translation` text CHARACTER SET utf8
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
(13, 'en', 'Verification code'),
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
(21, 'ar', 'إرسال الطلب'),
(21, 'en', 'Submit'),
(22, 'ar', 'المحتويات'),
(22, 'en', 'Package Details'),
(23, 'ar', 'إشتري الآن'),
(23, 'en', 'Buy Now'),
(24, 'ar', 'أطلب الآن'),
(24, 'en', 'ORDER NOW'),
(25, 'ar', 'الوثائق'),
(25, 'en', 'Documentation');

-- --------------------------------------------------------

--
-- Table structure for table `message_source`
--

CREATE TABLE IF NOT EXISTS `message_source` (
  `id` int(11) NOT NULL,
  `category` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT 'app',
  `message` text CHARACTER SET utf8 COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `message_source`
--

INSERT INTO `message_source` (`id`, `category`, `message`) VALUES
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
(21, 'app', 'submit'),
(22, 'app', 'package_details'),
(23, 'app', 'buy_now'),
(24, 'app', 'order_now'),
(25, 'app', 'documentation');

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(255) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1392306406),
('m140213_154829_add_simplemailer_tables', 1392306536);

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

CREATE TABLE IF NOT EXISTS `page` (
`id` int(11) NOT NULL,
  `slug` varchar(128) NOT NULL,
  `title_en` varchar(128) NOT NULL,
  `title_ar` varchar(128) NOT NULL,
  `body_en` text NOT NULL,
  `body_ar` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `page`
--

INSERT INTO `page` (`id`, `slug`, `title_en`, `title_ar`, `body_en`, `body_ar`, `created_at`) VALUES
(13, 'about', 'about', 'من نحن', '<p>This is about page !</p>', '<p>صفحة من نحن</p>', '2014-02-12 08:14:14');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`id` int(11) NOT NULL,
  `full_name` varchar(128) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `facebook_id` bigint(20) NOT NULL,
  `google_id` bigint(20) NOT NULL,
  `twitter_id` bigint(20) NOT NULL,
  `key` varchar(255) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `full_name`, `email`, `password`, `facebook_id`, `google_id`, `twitter_id`, `key`) VALUES
(1, 'Admin', 'admin@admin.com', 'e10adc3949ba59abbe56e057f20f883e', 0, 0, 0, '8612c55d2969d1f587bf1c5aaaa32964'),
(2, 'test user', 'user@user.com', 'e10adc3949ba59abbe56e057f20f883e', 0, 0, 0, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authassignment`
--
ALTER TABLE `authassignment`
 ADD PRIMARY KEY (`itemname`,`userid`);

--
-- Indexes for table `authitem`
--
ALTER TABLE `authitem`
 ADD PRIMARY KEY (`name`);

--
-- Indexes for table `authitemchild`
--
ALTER TABLE `authitemchild`
 ADD PRIMARY KEY (`parent`,`child`), ADD KEY `child` (`child`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
 ADD PRIMARY KEY (`id`,`language`);

--
-- Indexes for table `message_source`
--
ALTER TABLE `message_source`
 ADD UNIQUE KEY `id_2` (`id`), ADD KEY `id` (`id`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
 ADD PRIMARY KEY (`version`);

--
-- Indexes for table `page`
--
ALTER TABLE `page`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `page`
--
ALTER TABLE `page`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
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
ADD CONSTRAINT `FK_Message` FOREIGN KEY (`id`) REFERENCES `message_source` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
