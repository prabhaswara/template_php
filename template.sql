-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 25, 2015 at 10:24 PM
-- Server version: 5.1.37
-- PHP Version: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `template`
--

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('9e95a88db8eaed2d43b2efb65373670c', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0', 1422199008, '');

-- --------------------------------------------------------

--
-- Table structure for table `tpl_lookup`
--

CREATE TABLE IF NOT EXISTS `tpl_lookup` (
  `lookup_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `value` varchar(50) DEFAULT NULL,
  `display_text` varchar(100) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `order_num` int(11) DEFAULT NULL,
  `datecreate` datetime DEFAULT NULL,
  `usercreate` varchar(30) DEFAULT NULL,
  `dateupdate` datetime DEFAULT NULL,
  `userupdate` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`lookup_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tpl_lookup`
--

INSERT INTO `tpl_lookup` (`lookup_id`, `value`, `display_text`, `type`, `order_num`, `datecreate`, `usercreate`, `dateupdate`, `userupdate`) VALUES
(1, '1', 'Active', 'active_non', 1, '2014-12-30 10:07:40', NULL, '2015-01-24 08:17:27', NULL),
(2, '0', 'Non Active', 'active_non', 2, '2014-12-30 10:07:40', NULL, NULL, NULL),
(3, '1', 'Islam', 'agama', 1, NULL, NULL, NULL, NULL),
(4, '2', 'Kristen', 'agama', 2, NULL, NULL, NULL, NULL),
(5, '3', 'Hindu', 'agama', 3, NULL, NULL, '2015-01-06 14:59:41', '2015'),
(6, '4', 'Budha', 'agama', 4, NULL, NULL, '2015-01-12 11:39:17', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tpl_menu`
--

CREATE TABLE IF NOT EXISTS `tpl_menu` (
  `menu_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `menu_title` varchar(100) DEFAULT NULL,
  `url` varchar(100) DEFAULT NULL,
  `parent_id` bigint(20) unsigned DEFAULT NULL,
  `attributes` varchar(250) DEFAULT NULL,
  `order_num` int(11) DEFAULT NULL,
  `active_non` tinyint(4) DEFAULT NULL,
  `datecreate` datetime DEFAULT NULL,
  `usercreate` varchar(30) DEFAULT NULL,
  `dateupdate` datetime DEFAULT NULL,
  `userupdate` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`menu_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `tpl_menu`
--

INSERT INTO `tpl_menu` (`menu_id`, `menu_title`, `url`, `parent_id`, `attributes`, `order_num`, `active_non`, `datecreate`, `usercreate`, `dateupdate`, `userupdate`) VALUES
(1, 'Admin', '', 0, '', 2, 1, NULL, NULL, '2015-01-25 21:41:18', NULL),
(2, 'User', '/admin/user', 1, '', 2, 1, NULL, NULL, '2015-01-25 22:09:52', NULL),
(3, 'Lookup', '/admin/lookup', 1, '', 3, 1, NULL, NULL, '2015-01-25 22:10:10', NULL),
(4, 'Menu', '/admin/menu', 1, '', 4, 1, NULL, NULL, '2015-01-12 16:48:21', NULL),
(8, 'Role', '/admin/role', 1, '', 1, 1, '2015-01-12 16:43:50', NULL, '2015-01-25 22:10:18', NULL),
(9, 'Home', '/home', 0, '', 1, 1, '2015-01-25 21:40:59', NULL, '2015-01-25 22:10:25', NULL),
(17, 'calendar', '/calendar', 0, '', 0, 1, '2015-01-25 22:05:36', NULL, '2015-01-25 22:10:31', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tpl_menu_role`
--

CREATE TABLE IF NOT EXISTS `tpl_menu_role` (
  `menu_id` bigint(20) unsigned NOT NULL,
  `role_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tpl_menu_role`
--

INSERT INTO `tpl_menu_role` (`menu_id`, `role_id`) VALUES
(1, 'adm_lookup'),
(1, 'adm_menu'),
(1, 'adm_role'),
(1, 'adm_user'),
(9, 'adm_lookup'),
(17, 'adm_lookup'),
(17, 'adm_menu');

-- --------------------------------------------------------

--
-- Table structure for table `tpl_role`
--

CREATE TABLE IF NOT EXISTS `tpl_role` (
  `role_id` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `datecreate` datetime DEFAULT NULL,
  `usercreate` varchar(30) DEFAULT NULL,
  `dateupdate` datetime DEFAULT NULL,
  `userupdate` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tpl_role`
--

INSERT INTO `tpl_role` (`role_id`, `name`, `datecreate`, `usercreate`, `dateupdate`, `userupdate`) VALUES
('adm_lookup', 'Admin Lookup', '2015-01-12 16:58:15', NULL, '2015-01-12 16:58:15', NULL),
('adm_menu', 'Admin Menu', '2015-01-12 16:58:27', NULL, '2015-01-12 16:58:49', NULL),
('adm_role', 'Admin Role', '2015-01-12 16:58:37', NULL, '2015-01-12 17:03:58', NULL),
('adm_user', 'Admin User', '2015-01-12 16:58:03', NULL, '2015-01-12 16:58:03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tpl_user`
--

CREATE TABLE IF NOT EXISTS `tpl_user` (
  `user_id` varchar(30) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(35) DEFAULT NULL,
  `active_non` tinyint(4) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `datecreate` datetime DEFAULT NULL,
  `usercreate` varchar(30) DEFAULT NULL,
  `dateupdate` datetime DEFAULT NULL,
  `userupdate` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tpl_user`
--

INSERT INTO `tpl_user` (`user_id`, `username`, `password`, `active_non`, `last_login`, `datecreate`, `usercreate`, `dateupdate`, `userupdate`) VALUES
('142202504454c261544b70f', 'admin', '', 1, NULL, '2015-01-23 21:57:00', NULL, '2015-01-23 21:57:54', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tpl_user_role`
--

CREATE TABLE IF NOT EXISTS `tpl_user_role` (
  `user_id` varchar(30) NOT NULL,
  `role_id` varchar(100) NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tpl_user_role`
--

INSERT INTO `tpl_user_role` (`user_id`, `role_id`) VALUES
('', 'adm_lookup'),
('142202504454c261544b70f', 'adm_lookup'),
('142202504454c261544b70f', 'adm_menu');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
