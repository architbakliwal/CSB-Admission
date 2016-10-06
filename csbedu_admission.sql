-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 04, 2016 at 09:53 PM
-- Server version: 5.6.15-log
-- PHP Version: 5.5.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `csbedu_admission_2017`
--

-- --------------------------------------------------------

--
-- Table structure for table `admission_config`
--

DROP TABLE IF EXISTS `admission_config`;
CREATE TABLE IF NOT EXISTS `admission_config` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `registration_closed` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `admission_year` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admission_config`
--

INSERT INTO `admission_config` (`uid`, `registration_closed`, `admission_year`) VALUES
(1, 'N', '2016');

-- --------------------------------------------------------

--
-- Table structure for table `admission_section_status`
--

DROP TABLE IF EXISTS `admission_section_status`;
CREATE TABLE IF NOT EXISTS `admission_section_status` (
  `application_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `personal_details_status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_details_status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `exam_score_details_status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reference_details_status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `additional_details_status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `document_details_status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_update_date` datetime DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`application_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admission_users`
--

DROP TABLE IF EXISTS `admission_users`;
CREATE TABLE IF NOT EXISTS `admission_users` (
  `uid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `login_system_registrations_date` datetime DEFAULT '0000-00-00 00:00:00',
  `login_system_registrations_user_id` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `f_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `l_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `m_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `application_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mobile_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` char(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `salt` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `registration_ip` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `application_status` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;


-- --------------------------------------------------------

--
-- Table structure for table `login_system_email_activation`
--

DROP TABLE IF EXISTS `login_system_email_activation`;
CREATE TABLE IF NOT EXISTS `login_system_email_activation` (
  `login_system_email_activation_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `login_system_email_activation_user_id` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;


-- --------------------------------------------------------

--
-- Table structure for table `login_system_forgot_password`
--

DROP TABLE IF EXISTS `login_system_forgot_password`;
CREATE TABLE IF NOT EXISTS `login_system_forgot_password` (
  `login_system_forgot_password_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `login_system_forgot_password_user_id` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
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

-- --------------------------------------------------------

--
-- Table structure for table `login_system_login_attempts`
--

DROP TABLE IF EXISTS `login_system_login_attempts`;
CREATE TABLE IF NOT EXISTS `login_system_login_attempts` (
  `login_system_login_attempts_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `login_system_login_attempts_user_id` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `login_system_login_attempts_ip` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `login_system_login_attempts_attempts` int(10) NOT NULL,
  `login_system_login_attempts_first_date` datetime DEFAULT '0000-00-00 00:00:00',
  `login_system_login_attempts_date` datetime DEFAULT '0000-00-00 00:00:00',
  `login_system_login_attempts_blocked_time` datetime DEFAULT '0000-00-00 00:00:00',
  `login_system_login_attempts_username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`login_system_login_attempts_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;


-- --------------------------------------------------------

--
-- Table structure for table `login_system_register_social_networks`
--

DROP TABLE IF EXISTS `login_system_register_social_networks`;
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

-- --------------------------------------------------------

--
-- Table structure for table `users_contact_details`
--

DROP TABLE IF EXISTS `users_contact_details`;
CREATE TABLE IF NOT EXISTS `users_contact_details` (
  `application_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `email_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mobile_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `current_address_line1` text COLLATE utf8_unicode_ci,
  `current_address_line2` text COLLATE utf8_unicode_ci,
  `current_address_line3` text COLLATE utf8_unicode_ci,
  `current_address_city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `current_address_state` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `current_address_state_other` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `current_address_country` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `current_address_pin` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `permanent_same_as_current_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `permanent_address_line1` text COLLATE utf8_unicode_ci,
  `permanent_address_line2` text COLLATE utf8_unicode_ci,
  `permanent_address_line3` text COLLATE utf8_unicode_ci,
  `permanent_address_city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `permanent_address_state` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `permanent_address_state_other` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `permanent_address_country` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `permanent_address_pin` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent_mobile` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent_relation` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent_organisation` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent_designation` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent_qualification` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`application_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- --------------------------------------------------------

--
-- Table structure for table `users_documents_uploads`
--

DROP TABLE IF EXISTS `users_documents_uploads`;
CREATE TABLE IF NOT EXISTS `users_documents_uploads` (
  `application_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `passport_photo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `academic_transcripts` text COLLATE utf8_unicode_ci,
  `resume` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `certificates` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`application_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- --------------------------------------------------------

--
-- Table structure for table `users_personal_details`
--

DROP TABLE IF EXISTS `users_personal_details`;
CREATE TABLE IF NOT EXISTS `users_personal_details` (
  `application_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `f_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `l_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `m_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_dob` date DEFAULT NULL,
  `age` int(10) DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `blood_group` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hear_abt_csb` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`application_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- --------------------------------------------------------

--
-- Table structure for table `users_reference_details`
--

DROP TABLE IF EXISTS `users_reference_details`;
CREATE TABLE IF NOT EXISTS `users_reference_details` (
  `application_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `title_of_refree` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name_of_refree` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `organization` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `designation` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `capacity_of_knowing` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`application_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_additional_info`
--

DROP TABLE IF EXISTS `user_additional_info`;
CREATE TABLE IF NOT EXISTS `user_additional_info` (
  `application_id` varchar(255) NOT NULL,
  `after_mba_plan` text NOT NULL COMMENT 'What do you plan to do after your MBA',
  PRIMARY KEY (`application_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Table structure for table `user_exam_score`
--

DROP TABLE IF EXISTS `user_exam_score`;
CREATE TABLE IF NOT EXISTS `user_exam_score` (
  `application_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `exam_score` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`application_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
