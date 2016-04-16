-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 22, 2014 at 01:43 PM
-- Server version: 5.5.25
-- PHP Version: 5.4.4

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dbapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `dbapp_ci_sessions`
--

DROP TABLE IF EXISTS `dbapp_ci_sessions`;
CREATE TABLE `dbapp_ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dbapp_columnrestrictions`
--

DROP TABLE IF EXISTS `dbapp_columnrestrictions`;
CREATE TABLE `dbapp_columnrestrictions` (
  `dbapp_columnrestrictions_id` int(11) NOT NULL AUTO_INCREMENT,
  `dbapp_columnrestrictions_database` varchar(255) NOT NULL,
  `dbapp_columnrestrictions_table` varchar(255) NOT NULL,
  `dbapp_columnrestrictions_column` varchar(255) NOT NULL,
  `dbapp_columnrestrictions_restrictions` text NOT NULL,
  PRIMARY KEY (`dbapp_columnrestrictions_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `dbapp_columnselect`
--

DROP TABLE IF EXISTS `dbapp_columnselect`;
CREATE TABLE `dbapp_columnselect` (
  `dbapp_columnselect_id` int(11) NOT NULL AUTO_INCREMENT,
  `dbapp_columnselect_database` varchar(255) NOT NULL,
  `dbapp_columnselect_table` varchar(255) NOT NULL,
  `dbapp_columnselect_column` varchar(255) NOT NULL,
  `dbapp_columnselect_values` text NOT NULL,
  PRIMARY KEY (`dbapp_columnselect_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `dbapp_databases`
--

DROP TABLE IF EXISTS `dbapp_databases`;
CREATE TABLE `dbapp_databases` (
  `dbapp_databases_id` int(11) NOT NULL AUTO_INCREMENT,
  `dbapp_databases_database` varchar(255) NOT NULL,
  `dbapp_databases_hostname` varchar(255) NOT NULL DEFAULT 'localhost',
  PRIMARY KEY (`dbapp_databases_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `dbapp_groups`
--

DROP TABLE IF EXISTS `dbapp_groups`;
CREATE TABLE `dbapp_groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  `descr` text NOT NULL,
  `permissions` text NOT NULL,
  `admin_users` int(1) NOT NULL DEFAULT '0',
  `default` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `dbapp_groups`
--

INSERT INTO `dbapp_groups` (`id`, `name`, `description`, `descr`, `permissions`, `admin_users`, `default`) VALUES
(1, 'Administrator', 'Administrator', 'This is the boss man!', '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `dbapp_login_attempts`
--

DROP TABLE IF EXISTS `dbapp_login_attempts`;
CREATE TABLE `dbapp_login_attempts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varbinary(16) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `dbapp_relations`
--

DROP TABLE IF EXISTS `dbapp_relations`;
CREATE TABLE `dbapp_relations` (
  `dbapp_relations_id` int(11) NOT NULL AUTO_INCREMENT,
  `dbapp_relations_database` varchar(255) NOT NULL,
  `dbapp_relations_source_table` varchar(255) NOT NULL,
  `dbapp_relations_source_field` varchar(255) NOT NULL,
  `dbapp_relations_reference_table` varchar(255) NOT NULL,
  `dbapp_relations_reference_field` varchar(255) NOT NULL,
  `dbapp_relations_reference_use` varchar(255) NOT NULL,
  PRIMARY KEY (`dbapp_relations_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `dbapp_users`
--

DROP TABLE IF EXISTS `dbapp_users`;
CREATE TABLE `dbapp_users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varbinary(16) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(80) NOT NULL,
  `salt` varchar(40) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `mysql_user` varchar(255) NOT NULL,
  `mysql_pw` text NOT NULL,
  `tables` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `dbapp_users`
--

INSERT INTO `dbapp_users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`, `mysql_user`, `mysql_pw`, `tables`) VALUES
(1, '\0\0', 'admin@admin.com', '407583d90f6c2c2dc7d25bb4374c77218d14ff49', '9462e8eee0', 'admin@admin.com', '', '8f9191e53f224a42590a6e95b9220e406a42127a', 1392868021, NULL, 1268889823, 1395460247, 1, 'Admin', 'istrator', 'ADMIN', '0', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `dbapp_users_groups`
--

DROP TABLE IF EXISTS `dbapp_users_groups`;
CREATE TABLE `dbapp_users_groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  KEY `fk_users_groups_users1_idx` (`user_id`),
  KEY `fk_users_groups_groups1_idx` (`group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `dbapp_users_groups`
--

INSERT INTO `dbapp_users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `dbapp_users_records`
--

DROP TABLE IF EXISTS `dbapp_users_records`;
CREATE TABLE `dbapp_users_records` (
  `dbapp_users_records_id` int(11) NOT NULL AUTO_INCREMENT,
  `dbapp_users_records_userid` int(11) unsigned NOT NULL DEFAULT '1',
  `dbapp_users_records_database` varchar(255) NOT NULL,
  `dbapp_users_records_table` varchar(255) NOT NULL,
  `dbapp_users_records_recordid` varchar(255) NOT NULL,
  PRIMARY KEY (`dbapp_users_records_id`),
  KEY `dbapp_users_userid` (`dbapp_users_records_userid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dbapp_users_groups`
--
ALTER TABLE `dbapp_users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `dbapp_groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `dbapp_users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `dbapp_users_records`
--
ALTER TABLE `dbapp_users_records`
  ADD CONSTRAINT `dbapp_users_records_ibfk_1` FOREIGN KEY (`dbapp_users_records_userid`) REFERENCES `dbapp_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
