-- phpMyAdmin SQL Dump
-- version 3.3.3
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Oct 15, 2014 at 02:00 PM
-- Server version: 5.1.52
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `csbedu_admission`
--

-- --------------------------------------------------------

--
-- Table structure for table `admission_users`
--

CREATE TABLE IF NOT EXISTS `admission_users` (
  `uid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `login_system_registrations_date` datetime DEFAULT '0000-00-00 00:00:00',
  `login_system_registrations_user_id` int(10) NOT NULL,
  `f_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `l_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `m_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `application_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` char(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `salt` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `registration_ip` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `program_enrolled` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `application_status` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;


-- --------------------------------------------------------

--
-- Table structure for table `login_system_email_activation`
--

CREATE TABLE IF NOT EXISTS `login_system_email_activation` (
  `login_system_email_activation_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `login_system_email_activation_user_id` int(10) NOT NULL,
  `login_system_email_activation_username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `login_system_email_activation_expire` datetime DEFAULT '0000-00-00 00:00:00',
  `login_system_email_activation_useremail` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `login_system_email_activation_token` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `login_system_email_activation_date` datetime DEFAULT '0000-00-00 00:00:00',
  `login_system_email_activation_ip` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `login_system_email_activation_attempts` int(10) NOT NULL,
  `login_system_email_activation_blocked_time` datetime DEFAULT '0000-00-00 00:00:00',
  `login_system_email_activation_status` enum('0','1') COLLATE utf8_unicode_ci DEFAULT '0',
  PRIMARY KEY (`login_system_email_activation_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- --------------------------------------------------------

--
-- Table structure for table `login_system_forgot_password`
--

CREATE TABLE IF NOT EXISTS `login_system_forgot_password` (
  `login_system_forgot_password_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `login_system_forgot_password_user_id` int(10) NOT NULL,
  `login_system_forgot_password_username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `login_system_forgot_password_expire` datetime DEFAULT '0000-00-00 00:00:00',
  `login_system_forgot_password_useremail` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `login_system_forgot_password_token` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `login_system_forgot_password_date` datetime DEFAULT '0000-00-00 00:00:00',
  `login_system_forgot_password_ip` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `login_system_forgot_password_attempts` int(10) NOT NULL,
  `login_system_forgot_password_blocked_time` datetime DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`login_system_forgot_password_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `login_system_forgot_password`
--


-- --------------------------------------------------------

--
-- Table structure for table `login_system_login_attempts`
--

CREATE TABLE IF NOT EXISTS `login_system_login_attempts` (
  `login_system_login_attempts_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `login_system_login_attempts_user_id` int(10) NOT NULL,
  `login_system_login_attempts_ip` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `login_system_login_attempts_attempts` int(10) NOT NULL,
  `login_system_login_attempts_date` datetime DEFAULT '0000-00-00 00:00:00',
  `login_system_login_attempts_blocked_time` datetime DEFAULT '0000-00-00 00:00:00',
  `login_system_login_attempts_username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`login_system_login_attempts_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `login_system_login_attempts`
--


-- --------------------------------------------------------

--
-- Table structure for table `login_system_register_social_networks`
--

CREATE TABLE IF NOT EXISTS `login_system_register_social_networks` (
  `login_system_register_social_networks_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `login_system_register_social_networks_provider` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `login_system_register_social_networks_provider_user_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `login_system_register_social_networks_display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `login_system_register_social_networks_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `login_system_register_social_networks_first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `login_system_register_social_networks_last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `login_system_register_social_networks_profile_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `login_system_register_social_networks_date` datetime DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`login_system_register_social_networks_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `login_system_register_social_networks`
--

