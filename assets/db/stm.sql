-- phpMyAdmin SQL Dump
-- version 3.1.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 27, 2011 at 06:49 PM
-- Server version: 5.1.33
-- PHP Version: 5.3.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `stm`
--

-- --------------------------------------------------------

--
-- Table structure for table `uur_roles`
--

DROP TABLE IF EXISTS `uur_roles`;
CREATE TABLE IF NOT EXISTS `uur_roles` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `uur_roles`
--

INSERT INTO `uur_roles` (`id`, `name`, `description`) VALUES
(1, 'login', 'Login privileges, granted after account confirmation'),
(2, 'admin', 'Administrative user, has access to everything.');

-- --------------------------------------------------------

--
-- Table structure for table `uur_roles_users`
--

DROP TABLE IF EXISTS `uur_roles_users`;
CREATE TABLE IF NOT EXISTS `uur_roles_users` (
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `fk_role_id` (`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `uur_roles_users`
--

INSERT INTO `uur_roles_users` (`user_id`, `role_id`) VALUES
(1, 1),
(1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `uur_users`
--

DROP TABLE IF EXISTS `uur_users`;
CREATE TABLE IF NOT EXISTS `uur_users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(127) NOT NULL,
  `username` varchar(32) NOT NULL DEFAULT '',
  `password` varchar(64) NOT NULL,
  `logins` int(10) unsigned NOT NULL DEFAULT '0',
  `last_login` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_username` (`username`),
  UNIQUE KEY `uniq_email` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `uur_users`
--

INSERT INTO `uur_users` (`id`, `email`, `username`, `password`, `logins`, `last_login`) VALUES
(1, 'sammy@subrise.com', 'admin', '294948fc2a768e3c435609d32e03aa54e1a181c62e3ca984e0af9552d370835e', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `uur_user_tokens`
--

DROP TABLE IF EXISTS `uur_user_tokens`;
CREATE TABLE IF NOT EXISTS `uur_user_tokens` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `user_agent` varchar(40) NOT NULL,
  `token` varchar(40) NOT NULL,
  `type` varchar(100) NOT NULL,
  `created` int(10) unsigned NOT NULL,
  `expires` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_token` (`token`),
  KEY `fk_user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `uur_user_tokens`
--

