-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 16, 2016 at 12:22 PM
-- Server version: 5.6.15-log
-- PHP Version: 5.5.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `csbedu_admission`
--
CREATE DATABASE IF NOT EXISTS `csbedu_admission` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `csbedu_admission`;

-- --------------------------------------------------------

--
-- Table structure for table `added_academic_details`
--

CREATE TABLE IF NOT EXISTS `added_academic_details` (
  `uid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `application_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `extra_academic_degree_level` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `extra_academic_degree_level_other` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `extra_academic_name_of_college` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `extra_academic_university` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `extra_academic_university_other` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `extra_academic_degree_mode` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `extra_academic_degree_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `extra_academic_discipline` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `extra_academic_discipline_other` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `extra_academic_specialisation` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `extra_academic_degree_completed` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `extra_academic_year_completion` int(11) DEFAULT NULL,
  `extra_academic_grading_system` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `extra_academic_class` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `extra_academic_aggregate` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `extra_academic_gpa_obtained` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `extra_academic_gpa_max` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `added_work_experience_details`
--

CREATE TABLE IF NOT EXISTS `added_work_experience_details` (
  `uid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `application_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `employement_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name_of_organization` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `organization_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `organization_type_other` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `started_work_date` datetime DEFAULT NULL,
  `completed_work_date` datetime DEFAULT NULL,
  `joined_as` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `current_designation` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `annual_renumeration` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `roles_and_responsibilty` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `admission_config`
--

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

CREATE TABLE IF NOT EXISTS `admission_section_status` (
  `application_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `personal_details_status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_details_status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `academic_details_status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `work_ex_details_status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `login_system_email_activation`
--

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `login_system_forgot_password`
--

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

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

-- --------------------------------------------------------

--
-- Table structure for table `lookup_graduation_discipline`
--

CREATE TABLE IF NOT EXISTS `lookup_graduation_discipline` (
  `number` int(11) NOT NULL AUTO_INCREMENT,
  `code` int(11) NOT NULL,
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`number`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `lookup_graduation_discipline`
--

INSERT INTO `lookup_graduation_discipline` (`number`, `code`, `description`) VALUES
(1, 1, 'Agriculture'),
(2, 2, 'Agricultural Engineering	'),
(3, 3, 'Animal Husbandry'),
(4, 4, 'Architecture'),
(5, 5, 'Arts/Humanities'),
(6, 6, 'Commerce/Economics/ Banking/Finance/ Secretarial Practices'),
(7, 7, 'Chartered Accountancy'),
(8, 8, 'Cost And Works Accountancy'),
(9, 9, 'Company Secretaryship'),
(10, 10, 'Computer Science/Computer Application/Information Technology'),
(11, 11, 'Dairy Science/Technology'),
(12, 12, 'Education (Including Physical Education And Sports)'),
(13, 13, 'Engineering/Technology'),
(14, 14, 'Fisheries'),
(15, 15, 'Forestry'),
(16, 16, 'Food Technology'),
(17, 17, 'Horticulture'),
(18, 18, 'Hotel & Tourism Management'),
(19, 19, 'Law'),
(20, 20, 'Management (Business Administration/Business Management/Business Studies/Management Studies)'),
(21, 21, 'Medicine/Dentistry'),
(22, 22, 'Pharmacology/Pharmacy'),
(23, 23, 'Rural Studies/Rural Sociology/Rural Cooperatives/Rural Banking'),
(24, 24, 'Life Science: Biology, Biochemistry, Bio-Technology, Botany, Life Science, Zoology'),
(25, 25, 'PhysicalScience: Chemistry, Mathematics, Physics, Statistics, Electronics'),
(26, 26, 'Science (others): Home Science, Nursing &all other branches of Science not explicitly mentioned elsewhere in this List'),
(27, 27, 'Veterinary Science'),
(28, 28, 'Any other');

-- --------------------------------------------------------

--
-- Table structure for table `lookup_graduation_university`
--

CREATE TABLE IF NOT EXISTS `lookup_graduation_university` (
  `number` int(11) NOT NULL AUTO_INCREMENT,
  `code` int(11) NOT NULL,
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`number`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=422 ;

--
-- Dumping data for table `lookup_graduation_university`
--

INSERT INTO `lookup_graduation_university` (`number`, `code`, `description`) VALUES
(1, 99, 'International'),
(2, 100, 'Any Other, Any Other'),
(3, 101, 'Andhra Pradesh, ACHARYA N.G. RANGA AGRICULTURAL'),
(4, 102, 'Andhra Pradesh, ACHARYA NAGARJUNA'),
(5, 103, 'Andhra Pradesh, ANDHRA PRADESH UNIVERSITY OF HEALTH SCIENCES'),
(6, 104, 'Andhra Pradesh, ANDHRA'),
(7, 105, 'Andhra Pradesh, CENTRAL INSTITUTE OF ENGLISH & FOREIGN LANGUAGES'),
(8, 106, 'Andhra Pradesh, DR. B.R. AMBEDKAR OPEN (HYDERABAD)'),
(9, 107, 'Andhra Pradesh, DRAVIDIAN'),
(10, 108, 'Andhra Pradesh, HYDERABAD'),
(11, 109, 'Andhra Pradesh, INTERNATIONAL INSTITUTE OF INFORMATION TECHNOLOGY'),
(12, 110, 'Andhra Pradesh, J.N.T.U'),
(13, 111, 'Andhra Pradesh, KAKATIYA'),
(14, 112, 'Andhra Pradesh, MAULANA AZAD NATIONAL URDU'),
(15, 113, 'Andhra Pradesh, NAGARJUNA'),
(16, 114, 'Andhra Pradesh, NATIONAL ACADEMY OF LEGAL STUDIES AND RESEARCH'),
(17, 115, 'Andhra Pradesh, NATIONAL INSTITUTE OF TECHNOLOGY, WARANGAL'),
(18, 116, 'Andhra Pradesh, NIZAMS INSTITUTE OF MEDICAL SCIENCES'),
(19, 117, 'Andhra Pradesh, OSMANIA'),
(20, 118, 'Andhra Pradesh, POTTI SREERAMULU TELUGU'),
(21, 119, 'Andhra Pradesh, RASHTRIYA SANSKRIT VIDYAPEETHA'),
(22, 120, 'Andhra Pradesh, SRI KRISHNADEVARAYA\n'),
(23, 121, 'Andhra Pradesh, SRI PADMAVATHI MAHILA\n'),
(24, 122, 'Andhra Pradesh, SRI SATHYA SAI INSTITUTE OF HIGHER LEARNING\n'),
(25, 123, 'Andhra Pradesh, SRI VENKATESWARA'),
(26, 124, 'Andhra Pradesh, SRI VENKATESWARA INSTITUTE OF MEDICAL SCIENCES'),
(27, 125, 'Andhra Pradesh, ANY OTHER'),
(28, 126, 'Arunachal Pradesh, ARUNACHAL'),
(29, 127, 'Arunachal Pradesh, RAJIV GANDHI'),
(30, 128, 'Arunachal Pradesh, NORTH EASTERN REGIONAL INSTITUTE OF SCIENCE AND TECHNOLOGY'),
(31, 129, 'Arunachal Pradesh, ANY OTHER'),
(32, 130, 'Assam, ASSAM AGRICULTURAL'),
(33, 131, 'Assam, ASSAM'),
(34, 132, 'Assam, DIBRUGARH'),
(35, 134, 'Assam, INDIAN INSTITUTE OF TECHNOLOGY GUWAHATI'),
(36, 135, 'Assam, NATIONAL INSTITUTE OF TECHNOLOGY, SILCHAR'),
(37, 136, 'Assam, TEZPUR'),
(38, 137, 'Assam, ANY OTHER'),
(39, 138, 'Bihar, BABASAHEB BHIMRAO AMBEDKAR BIHAR (MUZAFFARPUR'),
(40, 139, 'Bihar, BHUPENDRA NARAYAN MANDAL'),
(41, 140, 'Bihar, BIHAR YOGA BHARATI'),
(42, 141, 'Bihar, CHANAKYA NATIONAL LAW'),
(43, 142, 'Bihar, INDIRA GANDHI INSTITUTE OF MEDICAL SCIENCES'),
(44, 143, 'Bihar, JAI PRAKASH'),
(45, 144, 'Bihar, KAMESHWHAR'),
(46, 145, 'Bihar, LALIT NARAYAN MITHILA'),
(47, 133, 'Assam, GAUHATI'),
(48, 146, 'Bihar, MAGADH'),
(49, 147, 'Bihar, MAULANA NAZARUL HAQ'),
(50, 148, 'Bihar, NALANDA OPEN'),
(51, 149, 'Bihar, PATNA'),
(52, 150, 'Bihar, RAJENDRA AGRICULTURAL '),
(53, 151, 'Bihar, TILKA MANJHI BHAGALPUR'),
(54, 152, 'Bihar, VEER KUNWAR SINGH'),
(55, 153, ' Bihar, ANY OTHER'),
(56, 154, 'Chandigarh, PANJAB (CHANDIGARH)'),
(57, 155, 'Chandigarh, POSTGRADUATE INSTITUTE OF MEDICAL EDUCATION AND RESEARCH'),
(58, 156, 'Chandigarh, PUNJAB ENGINEERING COLLEGE'),
(59, 157, 'Chandigarh, ANY OTHER'),
(60, 158, 'Chhattisgarh, Chhattisgarh Swami Vivekanand Technical University'),
(61, 159, 'Chhattisgarh, GURU GHASIDAS'),
(62, 160, 'Chhattisgarh, HIDAYATULLAH NATIONAL LAW UNIVERSITY'),
(63, 161, 'Chhattisgarh, INDIRA GANDHI KRISHI VISHWAVIDYALAYA'),
(64, 162, 'Chhattisgarh, Indira Kala Sangeet'),
(65, 163, 'Chhattisgarh, KUSHABHAU THACKERY'),
(66, 164, 'Chhattisgarh, PANDIT RAVISHANKAR SHUKLA'),
(67, 165, 'Chhattisgarh, PANDIT SUNDARLAL SHARMA'),
(68, 166, 'Chhattisgarh, ANY OTHER'),
(69, 167, 'Delhi, ALL INDIA INSTITUTE OF MEDICAL SCIENCES'),
(70, 168, 'Delhi, DELHI'),
(71, 169, 'Delhi, GURU GOVIND SINGH INDRAPRASTHA'),
(72, 170, 'Delhi, INDIAN AGRICULTURAL RESEARCH INSTITUTE'),
(73, 171, 'Delhi, INDIAN INSTITUTE OF FOREIGN TRADE'),
(74, 172, 'Delhi, INDIAN INSTITUTE OF TECHNOLOGY DELHI'),
(75, 173, 'Delhi, INDIAN LAW INSTITUTE'),
(76, 174, 'Delhi, INDIRA GANDHI NATIONAL OPEN'),
(77, 175, 'Delhi, JAMIA HAMDARD'),
(78, 176, 'Delhi, JAMIA MILLIA ISLAMIA'),
(79, 177, 'Delhi, JAWAHARLAL NEHRU'),
(80, 178, 'Delhi, NATIONAL SCHOOL OF DRAMA'),
(81, 179, 'Delhi, NATIONAL MUSUEM INSTITUTE'),
(82, 180, 'Delhi, NATIONAL UNIVERSITY OF EDUCATIONAL PLANNING & ADMINISTRATION'),
(83, 181, 'Delhi, RASHTRIYA SANSKRIT SANSTHANA'),
(84, 182, 'Delhi, SCHOOL OF PLANNING AND ARCHITECTURE'),
(85, 183, 'Delhi, SRI LAL BAHADUR SHASTRI'),
(86, 184, 'Delhi, TERI SCHOOL OF ADVANCED STUDIES'),
(87, 185, 'Delhi, ANY OTHER'),
(88, 186, 'Goa, GOA'),
(89, 187, 'Goa, ANY OTHER'),
(90, 188, 'Gujarat, BHAVNAGAR'),
(91, 189, 'Gujarat, CENTRE FOR ENVIRONMENTAL PLANNING & TECHNOLOGY'),
(92, 190, 'Gujarat, DHARMSINH DESAI'),
(93, 191, 'Gujarat, DHIRUBHAI AMBANI INSTITUTE OF INFORMATION & COMMUNICATION TECHNOLOGY'),
(94, 192, 'Gujarat, DR. BABASAHEB AMBEDKAR OPEN (AHMEDABAD)'),
(95, 193, 'Gujarat, GANPAT'),
(96, 194, 'Gujarat, GUJARAT AGRICULTURAL'),
(97, 195, 'Gujarat, GUJARAT AYURVED'),
(98, 196, 'Gujarat, GUJARAT'),
(99, 197, 'Gujarat, GUJARAT NATIONAL LAW'),
(100, 198, 'Gujarat, GUJARAT VIDYAPEETH'),
(101, 199, 'Gujarat, HEMCHANDRACHARYA NORTH GUJARAT'),
(102, 200, 'Gujarat, KRANTIGURU SHYAMJI KRISHNAVERMA KACHCH'),
(103, 201, 'Gujarat, MS UNIVERSITY OF BARODA'),
(104, 202, 'Gujarat, NIRMA UNIVERSITY OF SCIENCE & TECHNOLOGY'),
(105, 203, 'Gujarat, SARDAR PATEL'),
(106, 204, 'Gujarat, SARDAR VALLABHBHAI NATIONAL INSTITUTE OF TECHNOLOGY, SURAT'),
(107, 205, 'Gujarat, SAURASHTRA'),
(108, 206, 'Gujarat, SHREE SOMNATH SANSKRIT'),
(109, 207, 'Gujarat, SUMANDEEP VIDYAPEETH'),
(110, 208, 'Gujarat, VEER NARMAD SOUTH GUJARAT'),
(111, 209, 'Gujarat, ANY OTHER'),
(112, 210, 'Haryana, CHAUDHARY CHARAN SINGH HARYANA AGRICULTURAL'),
(113, 211, 'Haryana, CHAUDHARY DEVI LAL, SIRSA'),
(114, 212, 'Haryana, GURU JAMBESHWAR'),
(115, 213, 'Haryana, KURUKSHETRA'),
(116, 214, 'Haryana, MAHARSHI DAYANAND'),
(117, 215, 'Haryana, NATIONAL BRAIN RESEARCH CENTRE, GURGAON'),
(118, 216, 'Haryana, NATIONAL DAIRY RESEARCH INSTITUTE, KARNAL'),
(119, 217, 'Haryana, NATIONAL INSTITUTE OF TECHNOLOGY, KURUKSHETRA'),
(120, 218, 'Haryana, ANY OTHER'),
(121, 219, 'Himachal Pradesh, CHAUDHARY SARWAN KUMAR HIMACHAL PRADESH KRISHI'),
(122, 220, 'Himachal Pradesh, DR. Y.S. PARMAR UNIVERSITY OF HORTICULTURE & FORESTRY, NAUNI'),
(123, 221, 'Himachal Pradesh, HIMACHAL PRADESH'),
(124, 222, 'Himachal Pradesh, JAYPEE UNIVERSITY OF INFORMATION TECHNOLOGY, SOLAN'),
(125, 223, 'Himachal Pradesh, NATIONAL INSTITUTE OF TECHNOLOGY, HAMIRPUR'),
(126, 224, 'Himachal Pradesh, ANY OTHER'),
(127, 225, 'Jammu & Kashmir, BABA GHULAM SHAH BADSHAH'),
(128, 226, 'Jammu & Kashmir, JAMMU'),
(129, 227, 'Jammu & Kashmir, KASHMIR'),
(130, 228, 'Jammu & Kashmir, NATIONAL INSTITUTE OF TECHNOLOGY, SRINAGAR'),
(131, 229, 'Jammu & Kashmir, SHER-E-KASHMIR UNIVERSITY OF MEDICAL SCIENCES'),
(132, 230, 'Jammu & Kashmir, SHER-E-KASHMIR UNIVERSITY OF AGRICULTURAL SCIENCES & TECHNOLOGY'),
(133, 231, 'Jammu & Kashmir, SHRI MATA VAISHNO DEVI'),
(134, 232, 'Jammu & Kashmir, ANY OTHER'),
(135, 233, 'Maharashtra, BIT RANCHI'),
(136, 234, 'Jharkhand, BIRSA AGRICULTURAL'),
(137, 235, 'Jharkhand, INDIAN SCHOOL OF MINES'),
(138, 236, 'Jharkhand, NATIONAL INSTITUTE OF TECHNOLOGY, JAMSHEDPUR'),
(139, 237, 'Jharkhand, RANCHI'),
(140, 238, 'Jharkhand, SIDO-KANHU MURMU'),
(141, 239, 'Jharkhand, VINOBA BHAVE'),
(142, 240, 'Jharkhand, ANY OTHER'),
(143, 241, 'Karnataka, BANGALORE'),
(144, 242, 'Karnataka, GULBARGA'),
(145, 243, 'Karnataka, INDIAN INSTITUTE OF SCIENCE'),
(146, 244, 'Karnataka, INTERNATIONAL INSTITUTE OF INFORMATION TECHNOLOGY'),
(147, 245, 'Karnataka, JAWAHARLAL NEHRU CENTRE FOR ADVANCED SCIENTIFIC RESEARCH'),
(148, 246, 'Karnataka, KANNADA'),
(149, 247, 'Karnataka, KARNATAKA STATE OPEN'),
(150, 248, 'Karnataka, KARNATAKA STATE WOMEN, BIJAPUR'),
(151, 249, 'Karnataka, KARNATAKA VETERINARY ANIMAL & FISHERIES SCIENCES'),
(152, 250, 'Karnataka, KARNATAKA'),
(153, 251, 'Karnataka, KUVEMPU'),
(154, 252, 'Karnataka, KLE ACADEMY OF HIGHER EDUCATION & RESEARCH'),
(155, 253, 'Karnataka, MANGALORE'),
(156, 254, 'Karnataka, MANIPAL ACADEMY OF HIGHER EDUCATION'),
(157, 255, 'Karnataka, MYSORE'),
(158, 256, 'Karnataka, NIMHANS'),
(159, 257, 'Karnataka, NATIONAL INSTITUTE OF TECHNOLOGY, SURATHKAL'),
(160, 258, 'Karnataka, NATIONAL LAW SCHOOL OF INDIA UNIVERSITY'),
(161, 259, 'Karnataka, RAJIV GANDHI UNIVERSITY OF HEALTH SCIENCES'),
(162, 260, 'Karnataka, SWAMI VIVEKANANDA YOGA'),
(163, 261, 'Karnataka, TUMKUR'),
(164, 262, 'Karnataka, UNIVERSITY OF AGRICULTURAL SCIENCES (BANGALORE)'),
(165, 263, 'Karnataka, UNIVERSITY OF AGRICULTURAL SCIENCES (DHARWAD)'),
(166, 264, 'Karnataka, VISVESWARAIAH TECHNOLOGICAL UNIVERSITY'),
(167, 265, 'Karnataka, ANY OTHER'),
(168, 266, 'Kerala, CALICUT'),
(169, 267, 'Kerala, COCHIN UNIVERSITY OF SCIENCE & TECHNOLOGY'),
(170, 268, 'Kerala, KANNUR'),
(171, 269, 'Kerala, KERALA'),
(172, 270, 'Kerala, KERALA AGRICULTURAL'),
(173, 271, 'Kerala, KERALA KALAMANDALAM'),
(174, 272, 'Kerala, MAHATMA GANDHI (KOTTAYAM)'),
(175, 273, 'Kerala, NATIONAL INSTITUTE OF TECHNOLOGY, CALICUT'),
(176, 274, 'Kerala, Sree Chitra Tirunal Institute for Medical Sciences and Technology'),
(177, 275, 'Kerala, SREE SANKARACHARYA UNIVERSITY OF SANSKRIT'),
(178, 276, 'Kerala, ANY OTHER'),
(179, 277, 'Madhya Pradesh, AWADHESH PRATAP SINGH'),
(180, 278, 'Madhya Pradesh, BARKATULLAH'),
(181, 279, 'Madhya Pradesh, DEVI AHILYA'),
(182, 280, 'Madhya Pradesh, DR. HARISINGH GOUR'),
(183, 281, 'Madhya Pradesh, INDIAN INSTITUTE OF INFORMATION TECHNOLOGY AND MANAGEMENT'),
(184, 282, 'Madhya Pradesh, JAWAHARLAL NEHRU KRISHI (JABALPUR)'),
(185, 283, 'Madhya Pradesh, JIWAJI'),
(186, 284, 'Madhya Pradesh, LAKSHMI BAI NATIONAL INST OF PHYSICAL EDUCATION'),
(187, 285, 'Madhya Pradesh, MADHYA PRADESH BHOJ (OPEN)'),
(188, 286, 'Madhya Pradesh, MAHARISHI MAHESH YOGI VEDIC'),
(189, 287, 'Madhya Pradesh, MAHATMA GANDHI CHITRAKOOT GRAMODAY'),
(190, 288, 'Madhya Pradesh, MAKHANLAL CHATURVEDI RASHTRIYA PATRAKARITA'),
(191, 289, 'Madhya Pradesh, MAULANA AZAD NATIONAL INSTITUTE OF TECHNOLOGY, BHOPAL'),
(192, 290, 'Madhya Pradesh, NATIONAL LAW INSTITUTE'),
(193, 291, 'Madhya Pradesh, RAJIV GANDHI PROUDYOGIKI'),
(194, 292, 'Madhya Pradesh, RANI DURGAVATI'),
(195, 293, 'Madhya Pradesh, VIKRAM (UJJAIN)'),
(196, 294, 'Madhya Pradesh, ANY OTHER'),
(197, 295, 'Maharashtra, AMRAVATI'),
(198, 296, 'Maharashtra, BHARATI VIDYAPEETH'),
(199, 297, 'Maharashtra, Central Institute of Fisheries Education'),
(200, 298, 'Maharashtra, Deccan College Post Graduate and Research Institute'),
(201, 299, 'Maharashtra, DEFENCE INSTITUTE OF ADVANCED TECHNOLOGY'),
(202, 300, 'Maharashtra, DR. BABASAHEB AMBEDKAR MARATHWADA (AURANGABAD)'),
(203, 301, 'Maharashtra, DR. BABASAHEB AMBEDKAR TECHNOLOGICAL'),
(204, 302, 'Maharashtra, DR. D.Y. PATIL EDUCATION SOCIETY'),
(205, 303, 'Maharashtra, DR. D.Y. PATIL VIDYAPEETH'),
(206, 304, 'Maharashtra, DATTA MEGHE INSTITUTE OF MEDICAL SCIENCES'),
(207, 305, 'Maharashtra, DR. PANJABRAO DESHMUKH KRISHI VIDYAPEETH'),
(208, 306, 'Maharashtra, GOKHALE INSTITUTE OF POLITICS & ECONOMICS'),
(209, 307, 'Maharashtra, Homi Bhabha National Institute'),
(210, 308, 'Maharashtra, INDIAN INSTITUTE OF TECHNOLOGY BOMBAY'),
(211, 309, 'Maharashtra, INDIRA GANDHI INSTITUTE OF DEVELOPMENT RESEARCH'),
(212, 310, 'Maharashtra, INSTITUTE OF ARMAMENT TECH'),
(213, 311, 'Maharashtra, INTERNATIONAL INSTITUTE OF POPULATION SCIENCES'),
(214, 312, 'Maharashtra, KAVIKULGURU KALIDAS SANSKRIT'),
(215, 313, 'Maharashtra, KONKAN KRISHI VIDYAPEETH'),
(216, 314, 'Maharashtra, KRISHNA INST OF MEDICAL SCIENCES'),
(217, 315, 'Maharashtra, MAHARASHTRA ANIMAL & FISHERY SCIENCES'),
(218, 316, 'Maharashtra, MAHARASHTRA UNIVERSITY OF HEALTH SCIENCES'),
(219, 317, 'Maharashtra, Mahatma Gandhi Antarrashtriya Hindi'),
(220, 318, 'Maharashtra, MAHATMA PHULE KRISHI VIDYAPEETH'),
(221, 319, 'Maharashtra, MARATHWADA AGRICULTURAL'),
(222, 321, 'Maharashtra, NAGPUR'),
(223, 322, 'Maharashtra, NARSEE MONJEE INSTITUTE OF MANAGEMENT STUDIES'),
(224, 323, 'Maharashtra, NORTH MAHARASHTRA'),
(225, 324, 'Maharashtra, PADMASHREE DR. D.Y. PATIL VIDYAPEETH (MUMBAI)'),
(226, 325, 'Maharashtra, PRAVARA INSTITUTE OF MEDICAL SCIENCES'),
(227, 326, 'Maharashtra, PUNE'),
(228, 327, 'Maharashtra, RASHTRASANT TUKADOJI MAHARAJ NAGPUR'),
(229, 328, 'Maharashtra, SANT GADGE BABA AMRAVATI'),
(230, 329, 'Maharashtra, SHIVAJI'),
(231, 330, 'Maharashtra, SOLAPUR'),
(232, 331, 'Maharashtra, SNDT WOMEN''S'),
(233, 332, 'Maharashtra, SWAMI RAMANAND TEERTH MARATHWADA'),
(234, 333, 'Maharashtra, SYMBIOSIS INTERNATIONAL EDUCATION CENTRE'),
(235, 334, 'Maharashtra, Tata Institute of Fundamental Research'),
(236, 335, 'Any Other, Tata Institute of Social Sciences'),
(237, 336, 'Maharashtra, TILAK MAHARASHTRA VIDYAPEETH'),
(238, 337, 'Maharashtra, VISVESVARAYA NATIONAL INSTITUTE OF TECHNOLOGY, NAGPUR'),
(239, 338, 'Maharashtra, YASHWANTRAO CHAVAN MAHARASHTRA OPEN'),
(240, 339, 'Maharashtra, ANY OTHER'),
(241, 340, 'Manipur, CENTRAL AGRICULTURAL (IMPHAL)'),
(242, 341, 'Manipur, MANIPUR'),
(243, 342, 'Manipur, ANY OTHER'),
(244, 343, 'Meghalaya, NORTH EASTERN HILL (SHILLONG)'),
(245, 344, 'Meghalaya, ANY OTHER'),
(246, 345, 'Mizoram, MIZORAM (AIZWAL)'),
(247, 346, 'Mizoram, ANY OTHER'),
(248, 347, 'Nagaland, NAGALAND (KOHIMA)'),
(249, 348, 'Nagaland, ANY OTHER'),
(250, 349, 'Orissa, BERHAMPUR'),
(251, 350, 'Orissa, BIJU PATNAIK UNIVERSITY OF TECHNOLOGY'),
(252, 351, 'Orissa, FAKIR MOHAN'),
(253, 352, 'Orissa, KALINGA INSITUTE OF INDUSTRIAL TECHNOLOGY'),
(254, 353, 'Orissa, NATIONAL INSTITUTE OF TECHNOLOGY, ROURKELA'),
(255, 354, 'Orissa, NORTH ORISSA'),
(256, 355, 'Orissa, ORISSA UNIVERSITY OF AGRICULTURE AND TECHNOLOGY'),
(257, 356, 'Orissa, RAVENSHAW'),
(258, 357, 'Orissa, SAMBALPUR'),
(259, 358, 'Orissa, SHRI JAGANNATH SANSKRIT'),
(260, 359, 'Orissa, UTKAL'),
(261, 360, 'Orissa, UTKAL UNIVERSITY OF CULTURE'),
(262, 361, 'Orissa, ANY OTHER'),
(263, 362, 'Puducherry, PONDICHERRY'),
(264, 363, 'Puducherry, ANY OTHER'),
(265, 364, 'Punjab, BABA FARID UNIVERSITY OF HEALTH SCIENCES'),
(266, 365, 'Punjab, DR. B.R. AMBEDKAR NATIONAL INSTITUTE OF TECHNOLOGY, JALANDHAR'),
(267, 366, 'Punjab, GURU ANGAD DEV VETERINARY & ANIMAL SCIENCES'),
(268, 367, 'Punjab, GURU NANAK DEV'),
(269, 368, 'Punjab, LOVELY PROFESSIONAL'),
(270, 369, 'Punjab, NATIONAL INSTITUTE OF PHARMACEUTICAL EDUCATION AND RESEARCH'),
(271, 370, 'Punjab, PUNJAB AGRICULTURAL'),
(272, 371, 'Punjab, PUNJAB TECHNICAL'),
(273, 372, 'Punjab, PUNJAB'),
(274, 373, 'Punjab, THAPAR INSTITUTE OF ENGINEERING AND TECHNOLOGY'),
(275, 374, 'Punjab, ANY OTHER'),
(276, 375, 'Rajasthan, BANASTHALI VIDHYAPITH'),
(277, 376, 'Rajasthan, BIKANER'),
(278, 377, 'Rajasthan, BITS PILANI'),
(279, 378, 'Rajasthan, INSTITUTE OF ADVANCED STUDIES IN EDUCATION'),
(280, 379, 'Rajasthan, JAI NARAIN VYAS'),
(281, 380, 'Rajasthan, JAIN VISHWA BARATHI INST'),
(282, 381, 'Rajasthan, JANARDAN RAI NAGAR RAJASTHAN VIDYAPEETH'),
(283, 382, 'Rajasthan, KOTA'),
(284, 383, 'Rajasthan, KOTA OPEN'),
(285, 384, 'Rajasthan, LNM INSTITUTE OF INFORMATION TECHNOLOGY'),
(286, 385, 'Rajasthan, MAHARANA PRATAP UNIVERSITY OF AGRICULTURE & TECHNOLOGY'),
(287, 386, 'Rajasthan, MAHARSHI DAYANAND SARASWATI'),
(288, 387, 'Rajasthan, MALVIYA NATIONAL INSTITUTE OF TECHNOLOGY, JAIPUR'),
(289, 388, 'Rajasthan, MODY INSTITUTE OF TECHNOLOGY AND SCIENCE'),
(290, 389, 'Rajasthan, MOHANLAL SUKHADIA'),
(291, 390, 'Rajasthan, NATIONAL LAW UNIVERSITY'),
(292, 391, 'Rajasthan, RAJASTHAN'),
(293, 392, 'Rajasthan, RAJASTHAN AGRICULTURAL'),
(294, 393, 'Rajasthan, RAJASTHAN AYURVEDA'),
(295, 394, 'Rajasthan, RAJASTHAN SANSKRIT'),
(296, 395, 'Rajasthan, RAJASTHAN TECHNICAL'),
(297, 396, 'Rajasthan, ANY OTHER'),
(298, 397, 'Sikkim, SIKKIM-MANIPAL UNIVERSITY OF HEALTH, MEDICAL & TECHNOLOGICAL SCIENCES'),
(299, 398, 'Sikkim, ANY OTHER'),
(300, 399, 'Tamil Nadu, ALAGAPPA'),
(301, 400, 'Tamil Nadu, AMRITA VISHWA VIDYAPEETHAM'),
(302, 401, 'Tamil Nadu, ANNA'),
(303, 402, 'Tamil Nadu, ANNAMALAI'),
(304, 403, 'Tamil Nadu, ARULMIGU KALASALINGAM COLLEGE OF ENGINEERING'),
(305, 404, 'Tamil Nadu, AVINASHILINGAM INSTITUTE FOR HOME SCIENCE & HIGHER EDUCATION FOR WOMEN'),
(306, 405, 'Tamil Nadu, BHARAT INSTITUTE OF HIGHER EDUCATION & RESEARCH'),
(307, 406, 'Tamil Nadu, BHARATHIAR'),
(308, 407, 'Tamil Nadu, BHARATHIDASAN'),
(309, 408, 'Tamil Nadu, CHENNAI MATHEMATICAL INSTITUTE'),
(310, 409, 'Tamil Nadu, DAKSHIN BHARATHI HINDI PRACHAR SABHA'),
(311, 410, 'Tamil Nadu, GANDHIGRAM RURAL INSTITUTE'),
(312, 411, 'Tamil Nadu, INDIAN INSTITUTE OF TECHNOLOGY MADRAS'),
(313, 412, 'Tamil Nadu, KARUNYA'),
(314, 413, 'Tamil Nadu, M.G.R. EDUCATIONAL AND RESEARCH INSTITUTE'),
(315, 414, 'Tamil Nadu, MADRAS'),
(316, 415, 'Tamil Nadu, MADURAI KAMARAJ'),
(317, 416, 'Tamil Nadu, MANONMANIAM SUNDARANAR'),
(318, 417, 'Tamil Nadu, Meenakshi Academy of Higher Education and Research'),
(319, 418, 'Tamil Nadu, MOTHER TERESA WOMEN''S'),
(320, 419, 'Tamil Nadu, NATIONAL INSTITUTE OF TECHNOLOGY, TIRUCHIRAPALLI'),
(321, 420, 'Tamil Nadu, PERIYAR'),
(322, 421, 'Tamil Nadu, SATHYABAMA INSTITUTE OF SCIENCE AND TECHNOLOGY'),
(323, 422, 'Tamil Nadu, SAVEETHA INSTITUTE OF MEDICAL AND TECHNICAL SCIENCES'),
(324, 423, 'Tamil Nadu, SHANMUGHA ARTS, SCIENCE, TECHNOLOGY & RESEARCH ACADEMY'),
(325, 424, 'Tamil Nadu, SRI CHANDRASEKHARENDRA SARASWATHI VISWA MAHAVIDYALAYA'),
(326, 425, 'Tamil Nadu, SRI RAMACHANDRA MEDICAL COLLEGE AND RESEARCH INSTITUTE'),
(327, 426, 'Tamil Nadu, S.R.M. INSTITUTE OF SCIENCE & TECHNOLOGY'),
(328, 427, 'Tamil Nadu, TAMIL NADU AGRICULTURAL'),
(329, 428, 'Tamil Nadu, TAMIL NADU DR. M G R MEDICAL'),
(330, 429, 'Tamil Nadu, TAMIL NADU OPEN'),
(331, 430, 'Tamil Nadu, TAMIL'),
(332, 431, 'Tamil Nadu, TAMILNADU VETERINARY AND ANIMAL SCIENCES'),
(333, 432, 'Tamil Nadu, THE TAMILNADU DR. AMBEDKAR LAW'),
(334, 433, 'Tamil Nadu, THIRUVALLUVAR'),
(335, 434, 'Tamil Nadu, VELLORE INSTITUTE OF TECHNOLOGY'),
(336, 435, 'Tamil Nadu, VINAYAKA MISSION''S RESEARCH FOUNDATION'),
(337, 436, 'Tamil Nadu, ANY OTHER'),
(338, 437, 'Tripura, THE INSTITUTE OF CHARTERED FINANCIAL ANALYSTS OF INDIA'),
(339, 438, 'Tripura, TRIPURA'),
(340, 439, 'Tripura, ANY OTHER'),
(341, 440, 'Uttar Pradesh, ALLAHABAD'),
(342, 441, 'Uttar Pradesh, ALIGARH MUSLIM'),
(343, 442, 'Uttar Pradesh, ALLAHABAD AGRICULTURAL INSTITUTE'),
(344, 443, 'Uttar Pradesh, BABASAHEB BHIMRAO AMBEDKAR (LUCKNOW)'),
(345, 444, 'Uttar Pradesh, BANARAS HINDU'),
(346, 445, 'Uttar Pradesh, BHATKHANDE MUSIC INST'),
(347, 446, 'Uttar Pradesh, BUNDELKHAND, JHANSI'),
(348, 447, 'Uttar Pradesh, CENTRAL INSTITUTE OF HIGHER TIBETAN STUDIES'),
(349, 448, 'Uttar Pradesh, CH. CHARAN SINGH'),
(350, 449, 'Uttar Pradesh, CHANDRA SHEKHAR AZAD UNIVERSITY OF AGRICULTURE & TECHNOLOGY'),
(351, 450, 'Uttar Pradesh, CHHATRAPATI SHAHU JI MAHARAJ'),
(352, 451, 'Uttar Pradesh, DAYALBAGH EDUCATIONAL INSTITUTE'),
(353, 452, 'Uttar Pradesh, DEENDAYAL UPADHYAYA GORAKHPUR'),
(354, 453, 'Uttar Pradesh, DR. BHIM RAO AMBEDKAR (AGRA)'),
(355, 454, 'Uttar Pradesh, DR. RAM MANOHAR LOHIA AVADH'),
(356, 455, 'Uttar Pradesh, DR. RAM MAHOHAR LOHIA NATIONAL LAW'),
(357, 456, 'Uttar Pradesh, INDIAN INSTITUTE OF INFORMATION TECHNOLOGY'),
(358, 457, 'Uttar Pradesh, INDIAN INSTITUTE OF TECHNOLOGY KANPUR'),
(359, 458, 'Uttar Pradesh, INDIAN VETERINARY RESEARCH INSTITUTE'),
(360, 459, 'Uttar Pradesh, INTEGRAL UNIVERSITY'),
(361, 460, 'Uttar Pradesh, JAGADGURU RAMBHADRACHARYA HANDICAPPED'),
(362, 461, 'Uttar Pradesh, JAYPEE INSTITUTE OF INFORMATION TECHNOLOGY'),
(363, 462, 'Uttar Pradesh, KING GEORGE''S MEDICAL'),
(364, 463, 'Uttar Pradesh, LUCKNOW'),
(365, 464, 'Uttar Pradesh, M.J.P. ROHILKHAND'),
(366, 465, 'Uttar Pradesh, MAHATMA GANDHI KASHI VIDYAPEETH'),
(367, 466, 'Uttar Pradesh, MOTILAL NEHRU NATIONAL INSTITUTE OF TECHNOLOGY, ALLAHABAD'),
(368, 467, 'Uttar Pradesh, NARENDRA DEV UNIVERSITY OF AGRICULTURE & TECHNOLOGY'),
(369, 468, 'Uttar Pradesh, SAMPURNANAND SANSKRIT'),
(370, 469, 'Uttar Pradesh, SANJAY GANDHI NATIONAL INSTIT'),
(371, 470, 'Uttar Pradesh, SARDAR VALLABH BHAI PATEL UNIVERSITY OF AGRICULTURE & TECHNOLOGY'),
(372, 471, 'Uttar Pradesh, SHOBHIT INSTITUTE OF ENGINEERING & TECHNOLOGY'),
(373, 472, 'Uttar Pradesh, U.P. King George''s University of Dental Sciences'),
(374, 473, 'Uttar Pradesh, U.P. RAJARSHI TANDON OPEN'),
(375, 474, 'Uttar Pradesh, UTTAR PRADESH TECHNICAL'),
(376, 475, 'Uttar Pradesh, V B S PURVANCHAL'),
(377, 476, 'Uttar Pradesh, ANY OTHER'),
(378, 477, 'Uttaranchal, DEV SANSKRITI'),
(379, 478, 'Uttaranchal, Forest Research Institute, Dehradun'),
(380, 479, 'Uttaranchal, GOVIND BALLABH PANT UNIVERSITY OF AGRICULTURE & TECHNOLOGY'),
(381, 480, 'Uttaranchal, GURUKULA KANGRI'),
(382, 481, 'Uttaranchal, HEMWATI NANDAN BAHUGUNA GARHWAL'),
(383, 482, 'Uttaranchal, INDIAN INSTITUTE OF TECHNOLOGY ROORKEE'),
(384, 483, 'Uttaranchal, KUMAUN'),
(385, 484, 'Uttaranchal, THE INSTITUTE OF CHARTERED FINANCIAL ANALYSTS OF INDIA'),
(386, 485, 'Uttaranchal, UNIVERSITY OF PETROLEUM AND ENERGY STUDIES'),
(387, 486, 'Uttaranchal, UTTARANCHAL SANSKRIT'),
(388, 487, 'Uttaranchal, ANY OTHER'),
(389, 488, 'West Bengal, BIDHAN CHANDRA KRISHI'),
(390, 489, 'West Bengal, BURDWAN'),
(391, 490, 'West Bengal, CALCUTTA'),
(392, 491, 'West Bengal, INDIAN INSTITUTE OF TECHNOLOGY KHARAGPUR'),
(393, 492, 'West Bengal, INDIAN STATISTICAL INSTITUTE'),
(394, 493, 'West Bengal, JADAVPUR'),
(395, 494, 'West Bengal, KALYANI'),
(396, 495, 'West Bengal, NATIONAL INSTITUTE OF TECHNOLOGY, DURGAPUR'),
(397, 496, 'West Bengal, NETAJI SUBHASH OPEN'),
(398, 497, 'West Bengal, NORTH BENGAL'),
(399, 498, 'West Bengal, RABINDRA BHARATI'),
(400, 499, 'West Bengal, RAMAKRSHINA MISSION VIVEKANADA EDUCATION AND RESEARCH INST'),
(401, 500, 'West Bengal, THE BENGAL ENGINEERING & SCIENCE UNIVERSITY'),
(402, 501, 'West Bengal, THE WEST BENGAL UNIVERSITY OF HEALTH SCIENCES'),
(403, 502, 'West Bengal, UTTAR BANGA KRISHI'),
(404, 503, 'West Bengal, VIDYASAGAR'),
(405, 504, 'West Bengal, VISVA BHARTI, SANTINIKETAN'),
(406, 505, 'West Bengal, WEST BENGAL NATIONAL UNIVERSITY OF JURIDICAL SCIENCES'),
(407, 506, 'West Bengal, WEST BENGAL UNIVERSITY OF ANIMAL & FISHERY SCIENCES'),
(408, 507, 'West Bengal, WEST BENGAL UNIVERSITY OF TECHNOLOGY'),
(409, 508, 'West Bengal, ANY OTHER'),
(410, 513, 'Maharashtra, MUMBAI UNIVERSITY'),
(411, 514, 'Maharashtra, PUNE UIVERSITY'),
(412, 515, 'Bihar, Kameshwar Singh Darbhanga Sanskrit'),
(413, 516, 'Bihar, Maulana Mazharul Haque Arabic & Persian'),
(414, 517, 'Delhi, Shri Lal Bahadur Shastri Rashtriya Sanskrit Vidyapeeth'),
(415, 518, 'Karnataka, Swami Vivekananda Yog Anusandhana Samsthana'),
(416, 519, 'Madhya Pradesh, Punjab Technical'),
(417, 520, 'Jharkhand, BIT Ranchi'),
(418, 521, 'Maharashtra, Tata Institute of Social Sciences'),
(419, 523, 'Any Other, NAGPUR'),
(420, 524, 'INSTITUTE OF TECHNICAL EDUCATION AND RESEARCH'),
(421, 525, 'Delhi, THE INSTITUTION OF CIVIL ENGINEERS');

-- --------------------------------------------------------

--
-- Table structure for table `lookup_industry_type`
--

CREATE TABLE IF NOT EXISTS `lookup_industry_type` (
  `number` int(11) NOT NULL AUTO_INCREMENT,
  `code` int(11) NOT NULL,
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`number`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=81 ;

--
-- Dumping data for table `lookup_industry_type`
--

INSERT INTO `lookup_industry_type` (`number`, `code`, `description`) VALUES
(1, 1, 'Agriculture, Agriculture'),
(2, 2, 'Agriculture, Climate Change'),
(3, 3, 'Agriculture, Food Processing'),
(4, 4, 'Agriculture, Water'),
(5, 5, 'Infrastructure, Bio Fuels'),
(6, 6, 'Infrastructure, Civil Aviation'),
(7, 7, 'Infrastructure, Climate '),
(8, 8, 'Infrastructure, Energy'),
(9, 9, 'Infrastructure, Housing'),
(10, 10, 'Infrastructure, Hydrocarbons'),
(11, 11, 'Infrastructure, Infrastructure'),
(12, 12, 'Infrastructure, Oil and Gas'),
(13, 13, 'Infrastructure, Petrochemicals'),
(14, 14, 'Infrastructure, Petroleum'),
(15, 15, 'Infrastructure, Power'),
(16, 16, 'Infrastructure, Real Estate'),
(17, 17, 'Infrastructure, Renewable Energy'),
(18, 18, 'Infrastructure, Surface Transport'),
(19, 19, 'Infrastructure, Urban Development'),
(20, 20, 'Manufacturing, Aerospace'),
(21, 21, 'Manufacturing, Auto Components'),
(22, 22, 'Manufacturing, Automobiles'),
(23, 23, 'Manufacturing, Capital Goods'),
(24, 24, 'Manufacturing, Chemicals'),
(25, 25, 'Manufacturing, Climate Change'),
(26, 26, 'Manufacturing, Competitiveness'),
(27, 27, 'Manufacturing, Defence'),
(28, 28, 'Manufacturing, Design'),
(29, 29, 'Manufacturing, Energy'),
(30, 30, 'Manufacturing, Engineering'),
(31, 31, 'Manufacturing, Family Business'),
(32, 32, 'Manufacturing, Fast Moving Consumer Goods (FMCG'),
(33, 33, 'Manufacturing, Gems and Jewellery '),
(34, 34, 'Manufacturing, Human Resource Development'),
(35, 35, 'Manufacturing, ICTE Manufacturing'),
(36, 36, 'Manufacturing, Industrial Relations'),
(37, 37, 'Manufacturing, Innovation'),
(38, 38, 'Manufacturing, Intellectual Property Rights (IPR)'),
(39, 39, 'Manufacturing, Leather and Leather Products'),
(40, 40, 'Manufacturing, Manufacturing'),
(41, 41, 'Manufacturing, Micro, Medium &amp; Small Scale Industry'),
(42, 42, 'Manufacturing, Mining'),
(43, 43, 'Manufacturing, Safety and Security'),
(44, 44, 'Manufacturing, Steel &amp; Non-Ferrous Metals'),
(45, 45, 'Manufacturing, Technology'),
(46, 46, 'Manufacturing, Textiles &amp; Apparel'),
(47, 47, 'Services, Biotechnology'),
(48, 48, 'Services, Business Process Outsourcing'),
(49, 49, 'Services, Climate Change'),
(50, 50, 'Services, Competitiveness'),
(51, 51, 'Services, Design'),
(52, 52, 'Services, Education'),
(53, 53, 'Services, Family Business'),
(54, 54, 'Services, Healthcare'),
(55, 55, 'Services, Human Resource Development'),
(56, 56, 'Services, Industrial Relations'),
(57, 57, 'Services, Information &amp; Communication Technology'),
(58, 58, 'Services, Intellectual Property Rights (IPR'),
(59, 59, 'Services, Knowledge Management'),
(60, 60, 'Services, Media &amp; Entertainment'),
(61, 61, 'Services, Micro, Medium &amp; Small Scale Industry'),
(62, 62, 'Services, Retail'),
(63, 63, 'Services, Technology'),
(64, 64, 'Services, Telecommunications'),
(65, 65, 'Services, Tourism &amp; Hospitality'),
(66, 66, 'Industrial Competitiveness, Climate Change'),
(67, 67, 'Industrial Competitiveness, Competitiveness'),
(68, 68, 'Industrial Competitiveness, Design'),
(69, 69, 'Industrial Competitiveness, Human Resource Development'),
(70, 70, 'Industrial Competitiveness, Knowledge Management'),
(71, 71, 'Industrial Competitiveness, Logistics'),
(72, 72, 'Industrial Competitiveness, Micro, Medium &amp; Small Scale Industry'),
(73, 73, 'Industrial Competitiveness, Safety and Security'),
(74, 74, 'Industrial Competitiveness, Skills Development'),
(75, 75, 'Industrial Competitiveness, Technology'),
(76, 76, 'Services, Finance &amp; Banking'),
(77, 77, 'Others'),
(78, 78, 'Services, Insurance'),
(79, 79, 'International Agency(such as UNDP, Ford Foundation etc.)'),
(80, 80, 'Manufacturing, Information Technology Products');

-- --------------------------------------------------------

--
-- Table structure for table `lookup_organisation_type`
--

CREATE TABLE IF NOT EXISTS `lookup_organisation_type` (
  `number` int(11) NOT NULL AUTO_INCREMENT,
  `code` int(11) NOT NULL,
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`number`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `lookup_organisation_type`
--

INSERT INTO `lookup_organisation_type` (`number`, `code`, `description`) VALUES
(1, 1, 'Government (Central / State / Local bodies)'),
(2, 2, 'Public Sector'),
(3, 3, 'Private Sector'),
(4, 4, 'Self Employed'),
(5, 5, 'NGO'),
(6, 6, 'Autonomous'),
(7, 7, 'Any Other');

-- --------------------------------------------------------

--
-- Table structure for table `users_academic_details`
--

CREATE TABLE IF NOT EXISTS `users_academic_details` (
  `application_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `tenth_name_of_institute` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tenth_board` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tenth_board_other` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tenth_aggregate` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tenth_year_completion` int(11) DEFAULT NULL,
  `is_twelfth_or_diploma` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `twelfth_name_of_institution` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `twelfth_board` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `twelfth_board_other` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `twelfth_aggregate` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `twelfth_year_completion` int(11) DEFAULT NULL,
  `graduation_name_of_college` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `graduation_university` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `graduation_university_other` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `graduation_degree_mode` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `graduation_degree_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `graduation_discipline` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `graduation_discipline_other` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `graduation_specialisation` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `graduation_degree_completed` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `graduation_year_completion` int(11) DEFAULT NULL,
  `graduation_grading_system` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `graduation_class` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `graduation_aggregate` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `graduation_gpa_obtained` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `graduation_gpa_max` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `extra_academic_added_count` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `achievements_awards` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`application_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users_contact_details`
--

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
-- Table structure for table `users_work_experience_details`
--

CREATE TABLE IF NOT EXISTS `users_work_experience_details` (
  `application_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `work_experience` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `employement_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name_of_organization` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `organization_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `organization_type_other` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `started_work_date` date DEFAULT NULL,
  `completed_work_date` date DEFAULT NULL,
  `joined_as` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `current_designation` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `annual_renumeration` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `roles_and_responsibilty` text COLLATE utf8_unicode_ci,
  `extra_workex_count` int(11) DEFAULT NULL,
  `total_work_experience` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`application_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_additional_info`
--

CREATE TABLE IF NOT EXISTS `user_additional_info` (
  `application_id` varchar(255) NOT NULL,
  `role_model_info` text NOT NULL COMMENT 'Who is your role model? Explain the reasons behind your choice',
  `failure_info` text NOT NULL COMMENT 'What according to you has been your biggest failure and how did you overcome it',
  `acheivement_as_alumnus` text NOT NULL COMMENT 'Create a write-up of yourself as an alumnus of The CSB Programme alumnus and explain how the programme helped you achieve your career goals',
  `support_info` text NOT NULL COMMENT 'Is there anything else you would like to mention that would add to your candidature for the programme',
  PRIMARY KEY (`application_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
