-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 20, 2023 at 10:18 AM
-- Server version: 10.6.15-MariaDB-1:10.6.15+maria~ubu2004
-- PHP Version: 7.4.3-4ubuntu2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fch2`
--

-- --------------------------------------------------------

--
-- Table structure for table `accountant`
--

CREATE TABLE `accountant` (
  `id` int(11) NOT NULL,
  `img_url` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `name` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `address` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `phone` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `x` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `ion_user_id` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `hospital_id` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `accountant`
--

INSERT INTO `accountant` (`id`, `img_url`, `name`, `email`, `address`, `phone`, `x`, `ion_user_id`, `hospital_id`) VALUES
(1, NULL, 'Accountant', 'Accountant@hms.com', '12345', '12345', NULL, '758', '2'),
(2, NULL, 'Chris O', 'ogirri@gmail.com', 'Lagos', '094595950505', NULL, '764', '3'),
(3, NULL, 'Accountant 1', 'accounts@demo.familycare.com', 'Temp Address', '112344421123', NULL, '770', '1'),
(4, NULL, 'Accountant 1', 'accounts@demo.savealife.com', 'Temp Address', '2343423455556', NULL, '779', '4');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `img_url` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `name` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `address` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `phone` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `x` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `y` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `module` varchar(500) NOT NULL,
  `ion_user_id` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `hospital_id` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `allergy`
--

CREATE TABLE `allergy` (
  `id` int(11) NOT NULL,
  `patient_id` varchar(255) NOT NULL,
  `allergy` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `onset` varchar(255) NOT NULL,
  `severity` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `reactions` text NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `hospital_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `alloted_bed`
--

CREATE TABLE `alloted_bed` (
  `id` int(11) NOT NULL,
  `number` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `category` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `bed_name` varchar(255) NOT NULL,
  `patient` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `a_time` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `d_time` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `discharge` varchar(100) NOT NULL,
  `status` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `x` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `bed_id` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `patientname` varchar(255) NOT NULL,
  `payment_id` varchar(100) DEFAULT NULL,
  `hospital_id` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `alloted_bed`
--

INSERT INTO `alloted_bed` (`id`, `number`, `category`, `bed_name`, `patient`, `a_time`, `d_time`, `discharge`, `status`, `x`, `bed_id`, `patientname`, `payment_id`, `hospital_id`) VALUES
(9, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL),
(8, NULL, NULL, 'Female Ward-001', '1', '02 February 2022 - 01:10 PM', '02 February 2022 - 01:17 PM', '1643807820', NULL, NULL, '2', 'Miss FCH Test Test', '11823', '1'),
(10, NULL, NULL, '', '2', '08 September 2023 - 10:30 PM', '02 September 2023 - 04:35 AM', '', NULL, NULL, 'Female Ward-002', 'UCHE GOODNESS', NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `id` int(11) NOT NULL,
  `patient` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `patientname` varchar(255) NOT NULL,
  `doctor` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `doctorname` varchar(255) NOT NULL,
  `date` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `time_slot` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `s_time` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `e_time` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `remarks` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `add_date` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `registration_time` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `s_time_key` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `status` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `user` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `request` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `room_id` varchar(255) NOT NULL,
  `live_meeting_link` varchar(255) NOT NULL,
  `hospital_id` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`id`, `patient`, `patientname`, `doctor`, `doctorname`, `date`, `time_slot`, `s_time`, `e_time`, `remarks`, `add_date`, `registration_time`, `s_time_key`, `status`, `user`, `request`, `room_id`, `live_meeting_link`, `hospital_id`) VALUES
(1, '2', 'UCHE GOODNESS', '157', 'Doctor 1', '1697760000', 'Not Selected', 'Not Selected', '', 'mm', '10/10/23', '1696949588', '0', 'Confirmed', '2', '', 'hms-meeting-111111111111-742244-1', 'https://meet.jit.si/hms-meeting-111111111111-742244-1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `autoemailshortcode`
--

CREATE TABLE `autoemailshortcode` (
  `id` int(11) NOT NULL,
  `name` varchar(1000) DEFAULT NULL,
  `type` varchar(1000) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `autoemailtemplate`
--

CREATE TABLE `autoemailtemplate` (
  `id` int(11) NOT NULL,
  `name` varchar(1000) DEFAULT NULL,
  `message` varchar(1000) DEFAULT NULL,
  `type` varchar(1000) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `hospital_id` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `autoemailtemplate`
--

INSERT INTO `autoemailtemplate` (`id`, `name`, `message`, `type`, `status`, `hospital_id`) VALUES
(1, 'Payment successful email to patient', 'Dear {name}, Your paying amount - Tk {amount} was successful. Thank You Please contact our support for further queries.', 'payment', 'Active', '1'),
(2, 'Appointment Confirmation email to patient', 'Dear {name}, Your appointment with {doctorname} on {appoinmentdate} at {time_slot} is confirmed. For more information contact with {hospital_name} Regards', 'appoinment_confirmation', 'Active', '1'),
(3, 'Appointment creation email to patient', 'Dear {name}, You have an appointment with {doctorname} on {appoinmentdate} at {time_slot} .Please confirm your appointment. For more information contact with {hospital_name} Regards', 'appoinment_creation', 'Active', '1'),
(4, 'Meeting Schedule Notification To Patient', 'Dear {patient_name}, You have a Live Video Meeting with {doctor_name} on {start_time}. For more information contact with {hospital_name} . Regards', 'meeting_creation', 'Active', '1'),
(5, 'Send Appointment confirmation to Doctor', 'Dear {name}, You are appointed as a doctor in {department} . Thank You {company}', 'doctor', 'Active', '1'),
(6, 'Patient Registration Confirmation', 'Dear {name}, You are registred to {company} as a patient to {doctor}. Regards', 'patient', 'Active', '1'),
(7, 'Payment successful email to patient', 'Dear {name}, Your paying amount - Tk {amount} was successful. Thank You Please contact our support for further queries.', 'payment', 'Active', '2'),
(8, 'Appointment Confirmation email to patient', 'Dear {name}, Your appointment with {doctorname} on {appoinmentdate} at {time_slot} is confirmed. For more information contact with {hospital_name} Regards', 'appoinment_confirmation', 'Active', '2'),
(9, 'Appointment creation email to patient', 'Dear {name}, You have an appointment with {doctorname} on {appoinmentdate} at {time_slot} .Please confirm your appointment. For more information contact with {hospital_name} Regards', 'appoinment_creation', 'Active', '2'),
(10, 'Meeting Schedule Notification To Patient', 'Dear {patient_name}, You have a Live Video Meeting with {doctor_name} on {start_time}. For more information contact with {hospital_name} . Regards', 'meeting_creation', 'Active', '2'),
(11, 'Send Appointment confirmation to Doctor', 'Dear {name}, You are appointed as a doctor in {department} . Thank You {company}', 'doctor', 'Active', '2'),
(12, 'Patient Registration Confirmation', 'Dear {name}, You are registred to {company} as a patient to {doctor}. Regards', 'patient', 'Active', '2'),
(13, 'Payment successful email to patient', 'Dear {name}, Your paying amount - Tk {amount} was successful. Thank You Please contact our support for further queries.', 'payment', 'Active', '3'),
(14, 'Appointment Confirmation email to patient', 'Dear {name}, Your appointment with {doctorname} on {appoinmentdate} at {time_slot} is confirmed. For more information contact with {hospital_name} Regards', 'appoinment_confirmation', 'Active', '3'),
(15, 'Appointment creation email to patient', 'Dear {name}, You have an appointment with {doctorname} on {appoinmentdate} at {time_slot} .Please confirm your appointment. For more information contact with {hospital_name} Regards', 'appoinment_creation', 'Active', '3'),
(16, 'Meeting Schedule Notification To Patient', 'Dear {patient_name}, You have a Live Video Meeting with {doctor_name} on {start_time}. For more information contact with {hospital_name} . Regards', 'meeting_creation', 'Active', '3'),
(17, 'Send Appointment confirmation to Doctor', 'Dear {name}, You are appointed as a doctor in {department} . Thank You {company}', 'doctor', 'Active', '3'),
(18, 'Patient Registration Confirmation', 'Dear {name}, You are registred to {company} as a patient to {doctor}. Regards', 'patient', 'Active', '3'),
(19, 'Payment successful email to patient', 'Dear {name}, Your paying amount - Tk {amount} was successful. Thank You Please contact our support for further queries.', 'payment', 'Active', '4'),
(20, 'Appointment Confirmation email to patient', 'Dear {name}, Your appointment with {doctorname} on {appoinmentdate} at {time_slot} is confirmed. For more information contact with {hospital_name} Regards', 'appoinment_confirmation', 'Active', '4'),
(21, 'Appointment creation email to patient', 'Dear {name}, You have an appointment with {doctorname} on {appoinmentdate} at {time_slot} .Please confirm your appointment. For more information contact with {hospital_name} Regards', 'appoinment_creation', 'Active', '4'),
(22, 'Meeting Schedule Notification To Patient', 'Dear {patient_name}, You have a Live Video Meeting with {doctor_name} on {start_time}. For more information contact with {hospital_name} . Regards', 'meeting_creation', 'Active', '4'),
(23, 'Send Appointment confirmation to Doctor', 'Dear {name}, You are appointed as a doctor in {department} . Thank You {company}', 'doctor', 'Active', '4'),
(24, 'Patient Registration Confirmation', 'Dear {name}, You are registred to {company} as a patient to {doctor}. Regards', 'patient', 'Active', '4');

-- --------------------------------------------------------

--
-- Table structure for table `autosmsshortcode`
--

CREATE TABLE `autosmsshortcode` (
  `id` int(11) NOT NULL,
  `name` varchar(1000) DEFAULT NULL,
  `type` varchar(1000) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `autosmstemplate`
--

CREATE TABLE `autosmstemplate` (
  `id` int(11) NOT NULL,
  `name` varchar(1000) DEFAULT NULL,
  `message` varchar(1000) DEFAULT NULL,
  `type` varchar(1000) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `hospital_id` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `autosmstemplate`
--

INSERT INTO `autosmstemplate` (`id`, `name`, `message`, `type`, `status`, `hospital_id`) VALUES
(1, 'Payment successful sms to patient', 'Dear {name}, Your paying amount - Tk {amount} was successful. Thank You Please contact our support for further queries.', 'payment', 'Active', '1'),
(2, 'Appointment Confirmation sms to patient', 'Dear {name}, Your appointment with {doctorname} on {appoinmentdate} at {time_slot} is confirmed. For more information contact with {hospital_name} Regards', 'appoinment_confirmation', 'Active', '1'),
(3, 'Appointment creation sms to patient', 'Dear {name}, You have an appointment with {doctorname} on {appoinmentdate} at {time_slot} .Please confirm your appointment. For more information contact with {hospital_name} Regards', 'appoinment_creation', 'Active', '1'),
(4, 'Meeting Schedule Notification To Patient', 'Dear {patient_name}, You have a Live Video Meeting with {doctor_name} on {start_time}. For more information contact with {hospital_name} . Regards', 'meeting_creation', 'Active', '1'),
(5, 'send appoint confirmation to Doctor', 'Dear {name}, You are appointed as a doctor in {department} . Thank You {company}', 'doctor', 'Active', '1'),
(6, 'Patient Registration Confirmation', 'Dear {name}, You are registred to {company} as a patient to {doctor}. Regards', 'patient', 'Active', '1'),
(7, 'Payment successful sms to patient', 'Dear {name}, Your paying amount - Tk {amount} was successful. Thank You Please contact our support for further queries.', 'payment', 'Active', '2'),
(8, 'Appointment Confirmation sms to patient', 'Dear {name}, Your appointment with {doctorname} on {appoinmentdate} at {time_slot} is confirmed. For more information contact with {hospital_name} Regards', 'appoinment_confirmation', 'Active', '2'),
(9, 'Appointment creation sms to patient', 'Dear {name}, You have an appointment with {doctorname} on {appoinmentdate} at {time_slot} .Please confirm your appointment. For more information contact with {hospital_name} Regards', 'appoinment_creation', 'Active', '2'),
(10, 'Meeting Schedule Notification To Patient', 'Dear {patient_name}, You have a Live Video Meeting with {doctor_name} on {start_time}. For more information contact with {hospital_name} . Regards', 'meeting_creation', 'Active', '2'),
(11, 'send appoint confirmation to Doctor', 'Dear {name}, You are appointed as a doctor in {department} . Thank You {company}', 'doctor', 'Active', '2'),
(12, 'Patient Registration Confirmation', 'Dear {name}, You are registred to {company} as a patient to {doctor}. Regards', 'patient', 'Active', '2'),
(13, 'Payment successful sms to patient', 'Dear {name}, Your paying amount - Tk {amount} was successful. Thank You Please contact our support for further queries.', 'payment', 'Active', '3'),
(14, 'Appointment Confirmation sms to patient', 'Dear {name}, Your appointment with {doctorname} on {appoinmentdate} at {time_slot} is confirmed. For more information contact with {hospital_name} Regards', 'appoinment_confirmation', 'Active', '3'),
(15, 'Appointment creation sms to patient', 'Dear {name}, You have an appointment with {doctorname} on {appoinmentdate} at {time_slot} .Please confirm your appointment. For more information contact with {hospital_name} Regards', 'appoinment_creation', 'Active', '3'),
(16, 'Meeting Schedule Notification To Patient', 'Dear {patient_name}, You have a Live Video Meeting with {doctor_name} on {start_time}. For more information contact with {hospital_name} . Regards', 'meeting_creation', 'Active', '3'),
(17, 'send appoint confirmation to Doctor', 'Dear {name}, You are appointed as a doctor in {department} . Thank You {company}', 'doctor', 'Active', '3'),
(18, 'Patient Registration Confirmation', 'Dear {name}, You are registred to {company} as a patient to {doctor}. Regards', 'patient', 'Active', '3'),
(19, 'Payment successful sms to patient', 'Dear {name}, Your paying amount - Tk {amount} was successful. Thank You Please contact our support for further queries.', 'payment', 'Active', '4'),
(20, 'Appointment Confirmation sms to patient', 'Dear {name}, Your appointment with {doctorname} on {appoinmentdate} at {time_slot} is confirmed. For more information contact with {hospital_name} Regards', 'appoinment_confirmation', 'Active', '4'),
(21, 'Appointment creation sms to patient', 'Dear {name}, You have an appointment with {doctorname} on {appoinmentdate} at {time_slot} .Please confirm your appointment. For more information contact with {hospital_name} Regards', 'appoinment_creation', 'Active', '4'),
(22, 'Meeting Schedule Notification To Patient', 'Dear {patient_name}, You have a Live Video Meeting with {doctor_name} on {start_time}. For more information contact with {hospital_name} . Regards', 'meeting_creation', 'Active', '4'),
(23, 'send appoint confirmation to Doctor', 'Dear {name}, You are appointed as a doctor in {department} . Thank You {company}', 'doctor', 'Active', '4'),
(24, 'Patient Registration Confirmation', 'Dear {name}, You are registred to {company} as a patient to {doctor}. Regards', 'patient', 'Active', '4');

-- --------------------------------------------------------

--
-- Table structure for table `bankb`
--

CREATE TABLE `bankb` (
  `id` int(11) NOT NULL,
  `group` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `status` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `hospital_id` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `bankb`
--

INSERT INTO `bankb` (`id`, `group`, `status`, `hospital_id`) VALUES
(1, 'A+', '0 Bags', '416'),
(2, 'A-', '0 Bags', '416'),
(3, 'B+', '0 Bags', '416'),
(4, 'B-', '0 Bags', '416'),
(5, 'AB+', '0 Bags', '416'),
(6, 'AB-', '0 Bags', '416'),
(7, 'O+', '0 Bags', '416'),
(8, 'O-', '0 Bags', '416'),
(224, 'O-', '0 Bags', '451'),
(223, 'O+', '0 Bags', '451'),
(222, 'AB-', '0 Bags', '451'),
(221, 'AB+', '0 Bags', '451'),
(220, 'B-', '0 Bags', '451'),
(219, 'B+', '0 Bags', '451'),
(218, 'A-', '0 Bags', '451'),
(217, 'A+', '0 Bags', '451'),
(225, 'A+', '0 Bags', '452'),
(226, 'A-', '0 Bags', '452'),
(227, 'B+', '0 Bags', '452'),
(228, 'B-', '0 Bags', '452'),
(229, 'AB+', '0 Bags', '452'),
(230, 'AB-', '0 Bags', '452'),
(231, 'O+', '0 Bags', '452'),
(232, 'O-', '0 Bags', '452'),
(234, 'A+', '0 Bags', '453'),
(235, 'A-', '0 Bags', '453'),
(236, 'B+', '0 Bags', '453'),
(237, 'B-', '0 Bags', '453'),
(238, 'AB+', '0 Bags', '453'),
(239, 'AB-', '0 Bags', '453'),
(240, 'O+', '0 Bags', '453'),
(241, 'O-', '0 Bags', '453'),
(242, 'A+', '0 Bags', '454'),
(243, 'A-', '0 Bags', '454'),
(244, 'B+', '0 Bags', '454'),
(245, 'B-', '0 Bags', '454'),
(246, 'AB+', '0 Bags', '454'),
(247, 'AB-', '0 Bags', '454'),
(248, 'O+', '0 Bags', '454'),
(249, 'O-', '0 Bags', '454'),
(250, 'A+', '0 Bags', '455'),
(251, 'A-', '0 Bags', '455'),
(252, 'B+', '0 Bags', '455'),
(253, 'B-', '0 Bags', '455'),
(254, 'AB+', '0 Bags', '455'),
(255, 'AB-', '0 Bags', '455'),
(256, 'O+', '0 Bags', '455'),
(257, 'O-', '0 Bags', '455'),
(258, 'A+', '0 Bags', '456'),
(259, 'A-', '0 Bags', '456'),
(260, 'B+', '0 Bags', '456'),
(261, 'B-', '0 Bags', '456'),
(262, 'AB+', '0 Bags', '456'),
(263, 'AB-', '0 Bags', '456'),
(264, 'O+', '0 Bags', '456'),
(265, 'O-', '0 Bags', '456'),
(266, 'null', '0 bags', '416'),
(267, 'null', '0 bags', '451'),
(268, 'null', '0 bags', '452'),
(269, 'null', '0 bags', '453'),
(270, 'null', '0 bags', '454'),
(271, 'null', '0 bags', '455'),
(272, 'null', '0 bags', '456'),
(273, 'Nil', '0 bags', '416'),
(274, 'Nil', '0 bags', '451'),
(275, 'Nil', '0 bags', '452'),
(276, 'Nil', '0 bags', '453'),
(277, 'A+', '0 Bags', '457'),
(278, 'A-', '0 Bags', '457'),
(279, 'B+', '0 Bags', '457'),
(280, 'B-', '0 Bags', '457'),
(281, 'AB+', '0 Bags', '457'),
(282, 'AB-', '0 Bags', '457'),
(283, 'O+', '0 Bags', '457'),
(284, 'O-', '0 Bags', '457'),
(285, 'NIL', 'NIL', '457'),
(286, 'A+', '0 Bags', '458'),
(287, 'A-', '0 Bags', '458'),
(288, 'B+', '0 Bags', '458'),
(289, 'B-', '0 Bags', '458'),
(290, 'AB+', '0 Bags', '458'),
(291, 'AB-', '0 Bags', '458'),
(292, 'O+', '0 Bags', '458'),
(293, 'O-', '0 Bags', '458'),
(294, 'A+', '0 Bags', '1'),
(295, 'A-', '0 Bags', '1'),
(296, 'B+', '0 Bags', '1'),
(297, 'B-', '0 Bags', '1'),
(298, 'AB+', '0 Bags', '1'),
(299, 'AB-', '0 Bags', '1'),
(300, 'O+', '0 Bags', '1'),
(301, 'O-', '0 Bags', '1'),
(302, 'NIL', 'NIL', '1'),
(303, 'A+', '0 Bags', '2'),
(304, 'A-', '0 Bags', '2'),
(305, 'B+', '0 Bags', '2'),
(306, 'B-', '0 Bags', '2'),
(307, 'AB+', '0 Bags', '2'),
(308, 'AB-', '0 Bags', '2'),
(309, 'O+', '0 Bags', '2'),
(310, 'O-', '0 Bags', '2'),
(311, 'NIL', 'NIL', '2'),
(312, 'A+', '0 Bags', '3'),
(313, 'A-', '0 Bags', '3'),
(314, 'B+', '0 Bags', '3'),
(315, 'B-', '0 Bags', '3'),
(316, 'AB+', '0 Bags', '3'),
(317, 'AB-', '0 Bags', '3'),
(318, 'O+', '0 Bags', '3'),
(319, 'O-', '0 Bags', '3'),
(320, 'NIL', 'NIL', '3'),
(321, 'A+', '0 Bags', '4'),
(322, 'A-', '0 Bags', '4'),
(323, 'B+', '0 Bags', '4'),
(324, 'B-', '0 Bags', '4'),
(325, 'AB+', '0 Bags', '4'),
(326, 'AB-', '0 Bags', '4'),
(327, 'O+', '0 Bags', '4'),
(328, 'O-', '0 Bags', '4'),
(329, 'NIL', 'NIL', '4');

-- --------------------------------------------------------

--
-- Table structure for table `bed`
--

CREATE TABLE `bed` (
  `id` int(11) NOT NULL,
  `category` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `price` varchar(100) NOT NULL,
  `number` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `description` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `last_a_time` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `last_d_time` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `status` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `bed_id` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `hospital_id` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `bed`
--

INSERT INTO `bed` (`id`, `category`, `price`, `number`, `description`, `last_a_time`, `last_d_time`, `status`, `bed_id`, `hospital_id`) VALUES
(2, 'Female Ward', '5000', '001', 'Female Ward', '20 November 2021 - 01:20 PM', '23 November 2021 - 03:45 PM', NULL, 'Female Ward-001', '1'),
(3, 'Female Ward', '5000', '002', 'Female Ward', '08 September 2023 - 10:30 PM', '02 September 2023 - 04:35 AM', NULL, 'Female Ward-002', '1'),
(4, 'Female Ward', '5000', '003', 'Female Ward', NULL, NULL, NULL, 'Female Ward-003', '1'),
(5, 'Male Ward', '5000', '001', 'Male Ward', NULL, NULL, NULL, 'Male Ward-001', '1'),
(6, 'Male Ward', '5000', '002', 'Male Ward', NULL, NULL, NULL, 'Male Ward-002', '1');

-- --------------------------------------------------------

--
-- Table structure for table `bedside_medicine`
--

CREATE TABLE `bedside_medicine` (
  `id` int(11) NOT NULL,
  `note_id` varchar(255) NOT NULL,
  `medicine` varchar(255) NOT NULL,
  `dosage` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `bedside_medicine`
--

INSERT INTO `bedside_medicine` (`id`, `note_id`, `medicine`, `dosage`) VALUES
(1, '1', '1*ACYCLOVIR 400MG TABS UNBRANDED', '4'),
(2, '1', '4*Alpha-beta', '32');

-- --------------------------------------------------------

--
-- Table structure for table `bedside_note`
--

CREATE TABLE `bedside_note` (
  `id` int(11) NOT NULL,
  `date` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `patient_id` varchar(255) NOT NULL,
  `pulse` varchar(255) NOT NULL,
  `respiration` varchar(255) NOT NULL,
  `bp` varchar(50) NOT NULL,
  `fhr` varchar(255) NOT NULL,
  `rbs` varchar(255) NOT NULL,
  `note` text NOT NULL,
  `taken_by` varchar(255) NOT NULL,
  `hospital_id` varchar(255) NOT NULL,
  `record_date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `bedside_note`
--

INSERT INTO `bedside_note` (`id`, `date`, `time`, `patient_id`, `pulse`, `respiration`, `bp`, `fhr`, `rbs`, `note`, `taken_by`, `hospital_id`, `record_date`) VALUES
(1, '1637366400', '12:45 AM', '1', 'JJKKHK', 'LKMMKLML', '', '', '', '<p>YGYKIUGGJHGJHGHJ</p>\r\n', 'N11162', '1', '1637408817');

-- --------------------------------------------------------

--
-- Table structure for table `bed_category`
--

CREATE TABLE `bed_category` (
  `id` int(11) NOT NULL,
  `category` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `description` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `hospital_id` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `bed_category`
--

INSERT INTO `bed_category` (`id`, `category`, `description`, `hospital_id`) VALUES
(1, 'Female Ward', 'Female Ward', '1'),
(2, 'Male Ward', 'Male Ward', '1'),
(3, 'Accident & Emergency', 'Accident & Emergency', '1'),
(4, 'Paediatric Ward 1', 'Paediatric Ward 1', '1'),
(5, 'Paediatric Ward 2', 'Paediatric Ward 2', '1');

-- --------------------------------------------------------

--
-- Table structure for table `check_in`
--

CREATE TABLE `check_in` (
  `id` int(11) NOT NULL,
  `patient_id` varchar(255) NOT NULL,
  `checked_in_by` varchar(255) NOT NULL,
  `hospital_id` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `check_in`
--

INSERT INTO `check_in` (`id`, `patient_id`, `checked_in_by`, `hospital_id`, `date`) VALUES
(1, '1', 'R774', '4', '1689252368');

-- --------------------------------------------------------

--
-- Table structure for table `check_out`
--

CREATE TABLE `check_out` (
  `id` int(11) NOT NULL,
  `check_in_id` varchar(255) NOT NULL,
  `check_out_by` varchar(255) NOT NULL,
  `hospital_id` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `consultation`
--

CREATE TABLE `consultation` (
  `id` int(11) NOT NULL,
  `doctor` varchar(255) NOT NULL,
  `patient_id` varchar(255) NOT NULL,
  `dept` varchar(255) NOT NULL,
  `sent_by` varchar(255) NOT NULL,
  `checkin_id` varchar(100) DEFAULT NULL,
  `date` varchar(255) NOT NULL,
  `hospital_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `conversation`
--

CREATE TABLE `conversation` (
  `id` int(11) NOT NULL,
  `hospital_id` varchar(255) NOT NULL,
  `user_1` varchar(255) NOT NULL,
  `user_2` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `conversation`
--

INSERT INTO `conversation` (`id`, `hospital_id`, `user_1`, `user_2`, `date`) VALUES
(1, '1', '11456', '11161', '1648114648'),
(2, '1', '11475', '11474', '1636382909'),
(3, '1', '11471', '11476', '1637326644'),
(4, '1', '11443', '11453', '1637339944'),
(5, '1', '11448', '11449', '1650899012'),
(6, '1', '11455', '11457', '1648114672'),
(7, '4', '774', '779', '1691740243');

-- --------------------------------------------------------

--
-- Table structure for table `custom_vitals`
--

CREATE TABLE `custom_vitals` (
  `id` int(11) NOT NULL,
  `vital_id` varchar(255) NOT NULL,
  `form_id` varchar(255) NOT NULL,
  `patient_id` varchar(255) NOT NULL,
  `data` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `c_patient`
--

CREATE TABLE `c_patient` (
  `id` int(10) NOT NULL,
  `patient` varchar(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `hospital_id` varchar(10) NOT NULL,
  `date` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `c_patient`
--

INSERT INTO `c_patient` (`id`, `patient`, `name`, `phone`, `hospital_id`, `date`) VALUES
(6, '18934', 'KWALE FORTUNE', '09133521235', '1', '1692175400'),
(7, '18935', 'KADOSO OKPEYEMI', '', '1', '1692175402'),
(8, '18937', 'OBIOMA ANNA ', '', '1', '1692175405'),
(9, '18938', 'CHINYERE LINUS', '', '1', '1692175408'),
(10, '18939', 'APIRI AZIBAYAM', '08037807720', '1', '1692175411');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int(11) NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `description` varchar(1000) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `x` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `y` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `first_visit` varchar(50) DEFAULT NULL,
  `follow_up` varchar(50) DEFAULT NULL,
  `hospital_id` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `name`, `description`, `x`, `y`, `first_visit`, `follow_up`, `hospital_id`) VALUES
(1, 'GENERAL PRACTITION', '<p>General Practitioner</p>\r\n', NULL, NULL, '286', '287', '1'),
(2, 'PAEDIATRIC CLINIC', '<p>Pediatrician</p>\r\n', NULL, NULL, '637', '636', '1'),
(3, 'INTERNAL MEDICINE CLINIC', '<p>Internist</p>\r\n', NULL, NULL, '658', '657', '1'),
(7, 'DAVID WELLNESS & GERIATRICS CLINIC', '<p>Wellness &amp; Geriatrics Specialist</p>\r\n', NULL, NULL, '633', '632', '1'),
(9, 'DENTAL CLINIC', '<p>Dental Surgeon</p>\r\n', NULL, NULL, '645', '644', '1'),
(10, 'EYE CLINIC', '<p>Optometrist</p>\r\n', NULL, NULL, '641', '640', '1'),
(15, 'ANTENATAL', '<p>O&amp;G Specialist</p>\r\n', NULL, NULL, NULL, NULL, '1'),
(12, 'DIET AND NUTRITION', '<p>Dietitian</p>\r\n', NULL, NULL, '662', '661', '1'),
(13, 'PHYSIOTHERAPY', '<p>Physiotherapist</p>\r\n', NULL, NULL, '652', '653', '1'),
(17, 'GYNAECOLOGY CLINIC', '<p>O&amp;G Specialist</p>\r\n', NULL, NULL, '660', '659', '1'),
(18, 'DERMATOLOGY', '<p>DERMATOLOGIST</p>\r\n', NULL, NULL, NULL, NULL, '1'),
(19, 'General Practition', '<p>General Practition</p>\r\n', NULL, NULL, NULL, NULL, '2');

-- --------------------------------------------------------

--
-- Table structure for table `diagnostic_report`
--

CREATE TABLE `diagnostic_report` (
  `id` int(11) NOT NULL,
  `date` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `invoice` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `report` varchar(10000) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `status` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `hospital_id` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `id` int(11) NOT NULL,
  `img_url` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `name` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `address` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `phone` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `department` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `profile` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `x` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `y` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `ion_user_id` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `hospital_id` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`id`, `img_url`, `name`, `email`, `address`, `phone`, `department`, `profile`, `x`, `y`, `ion_user_id`, `hospital_id`) VALUES
(149, NULL, 'Xerdocs Test Doctor', 'doctor@hms.com', 'Bayelsa, Nigeria', '234803111222333', 'Cardiology', NULL, NULL, NULL, '751', '2'),
(150, NULL, 'doctor test', 'testdoctor@hms.com', 'address', '09098776', 'General Practition', 'MD', NULL, NULL, '753', '2'),
(151, NULL, 'Ojomaikre Om', 'ojom@xerdocs.com', '12345ftggh ttty', '223445666', 'General Practition', 'Which profile', NULL, NULL, '760', '2'),
(152, NULL, 'Another Doc', 'anotherdoc@gmail.com', 'ododofngo', '080223312344', 'General Practition', 'Crap Profile', NULL, NULL, '761', '2'),
(153, NULL, 'Chinemeze Akuh Hospital', 'akuh@xerdocs.com', 'Abuja', '123123', NULL, 'Another one', NULL, NULL, '763', '3'),
(154, NULL, 'Doctor 2', 'doctor2@demo.familycare.com', 'Temp Address', '22345667788', 'GENERAL PRACTITION', '2', NULL, NULL, '767', '1'),
(155, NULL, 'Doctor 1', 'doctor1@demo.savealife.com', 'Temp Address', '1123434556666', NULL, '123445', NULL, NULL, '775', '4'),
(156, NULL, 'Radiologist', 'radiologist1@demo.savealife.com', 'Temp Address', '2343423455556', NULL, '123445', NULL, NULL, '776', '4'),
(157, NULL, 'Doctor 1', 'doctor1@demo.familycare.com', 'Temp Address', '2343423455556', '1', '123445', NULL, NULL, '781', '1'),
(158, NULL, 'Daniel Ipogah', 'darnielipogah@gmail.com', 'O2tv', '0813672893', '2', 'Personal', NULL, NULL, '785', '1');

-- --------------------------------------------------------

--
-- Table structure for table `donor`
--

CREATE TABLE `donor` (
  `id` int(11) NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `group` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `age` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `sex` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `ldd` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `phone` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `add_date` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `hospital_id` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `email`
--

CREATE TABLE `email` (
  `id` int(11) NOT NULL,
  `subject` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `date` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `message` varchar(10000) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `reciepient` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `user` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `hospital_id` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `email_settings`
--

CREATE TABLE `email_settings` (
  `id` int(11) NOT NULL,
  `admin_email` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `type` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `user` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `password` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `hospital_id` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `email_settings`
--

INSERT INTO `email_settings` (`id`, `admin_email`, `type`, `user`, `password`, `hospital_id`) VALUES
(1, 'Admin Email', NULL, NULL, NULL, '1'),
(2, 'Admin Email', NULL, NULL, NULL, '2'),
(3, 'Admin Email', NULL, NULL, NULL, '3'),
(4, 'Admin Email', NULL, NULL, NULL, '4');

-- --------------------------------------------------------

--
-- Table structure for table `expense`
--

CREATE TABLE `expense` (
  `id` int(11) NOT NULL,
  `category` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `date` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `note` varchar(1000) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `amount` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `user` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `datestring` varchar(1000) NOT NULL,
  `hospital_id` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `expense`
--

INSERT INTO `expense` (`id`, `category`, `date`, `note`, `amount`, `user`, `datestring`, `hospital_id`) VALUES
(1, 'Transport to Bank', '1640164917', 'this is a test, not real', '2000', '11459', '22/12/21', '1');

-- --------------------------------------------------------

--
-- Table structure for table `expense_category`
--

CREATE TABLE `expense_category` (
  `id` int(11) NOT NULL,
  `category` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `description` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `x` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `y` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `hospital_id` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `expense_category`
--

INSERT INTO `expense_category` (`id`, `category`, `description`, `x`, `y`, `hospital_id`) VALUES
(1, 'Transport to Bank', 'Transport to bank', NULL, NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `featured`
--

CREATE TABLE `featured` (
  `id` int(11) NOT NULL,
  `img_url` varchar(1000) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `name` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `profile` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `description` varchar(1000) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `form`
--

CREATE TABLE `form` (
  `id` int(11) NOT NULL,
  `hospital_id` varchar(255) NOT NULL,
  `dept_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `form`
--

INSERT INTO `form` (`id`, `hospital_id`, `dept_id`, `name`, `type`) VALUES
(1, '1', '3', 'Chief Complaint', 'text'),
(2, '1', '3', 'Personal, Family & Social History', 'group'),
(3, '1', 'f2', 'Past Medical History', 'text'),
(4, '1', 'f2', 'Family History', 'text'),
(5, '1', 'f2', 'Social History', 'text'),
(6, '1', '3', 'Review of Systems', 'text'),
(7, '1', '3', 'Physical Examination', 'text'),
(8, '1', '3', 'Diagnosis Details', 'text'),
(9, '1', '3', 'Patient Instruction', 'text'),
(10, '1', '3', 'Follow Up Details', 'group'),
(11, '1', 'f10', 'Next Visiting Date', 'date'),
(12, '1', 'f10', 'Remarks', 'text'),
(13, '1', '1', 'Subjective (Complaints & Relevant History', 'text'),
(14, '1', '1', 'Objective (General & Relevant Examination)', 'text'),
(15, '1', '1', 'Personal, Family & Social History', 'group'),
(16, '1', 'f15', 'Past Medical History', 'text'),
(17, '1', 'f15', 'Family History', 'text'),
(18, '1', 'f15', 'Social History', 'text'),
(19, '1', '1', 'Assesment (Working Diagnosis)', 'text'),
(20, '1', '1', 'TB Screening', 'group'),
(21, '1', 'f20', 'Normal', 'polar'),
(22, '1', 'f20', 'Cough (2 weeks or more)', 'polar'),
(23, '1', 'f20', 'Fever (3 weeks or more)', 'polar'),
(24, '1', 'f20', 'Night Sweat (alot at night)', 'polar'),
(25, '1', 'f20', 'Unexplained Weight Loss (adult)', 'polar'),
(26, '1', 'f20', 'Swelling (Limbs/Neck/Back)', 'polar'),
(27, '1', 'f20', 'Failure to Thrive (Children)', 'polar'),
(28, '1', 'f20', 'Coughing up Blood', 'polar'),
(29, '1', 'f20', 'Referred for Diagnostic Test', 'polar'),
(30, '1', '1', 'Patient Instruction', 'text'),
(31, '1', '1', 'Referral ', 'group'),
(32, '1', 'f31', 'Doctor', 'text'),
(33, '1', 'f31', 'Reason for Referral', 'text'),
(34, '1', '4', 'PC', 'text'),
(35, '1', '4', 'Physical Examination', 'text'),
(38, '1', '4', 'Personal, Family & Social History', 'group'),
(40, '1', '4', 'Prescription Notes', 'text'),
(41, '1', '10', 'Chief Complaint', 'text'),
(42, '1', '10', 'Patient & Family History', 'group'),
(43, '1', 'f42', 'Patient Medical History', 'text'),
(44, '1', 'f42', 'Patient Ocular History', 'text'),
(45, '1', 'f42', 'Family Medical History', 'text'),
(46, '1', '10', 'Previous Visual History', 'text'),
(47, '1', '10', 'LEE', 'text'),
(48, '1', '5', 'Unaided DVA', 'group'),
(49, '1', 'f48', 'Normal', 'text'),
(50, '1', 'f48', 'OD', 'text'),
(51, '1', 'f48', 'OS', 'text'),
(52, '1', 'f48', 'Others', 'text'),
(53, '1', '10', 'NVA', 'group'),
(54, '1', 'f53', 'Normal', 'text'),
(55, '1', 'f53', 'OU', 'text'),
(56, '1', 'f53', 'Others', 'text'),
(57, '1', '10', 'PH', 'group'),
(58, '1', 'f57', 'OD', 'text'),
(59, '1', 'f57', 'OS', 'text'),
(60, '1', '10', 'Aided DVA', 'group'),
(61, '1', 'f60', 'Normal', 'text'),
(62, '1', 'f60', 'OD', 'text'),
(63, '1', 'f60', 'OS', 'text'),
(64, '1', 'f60', 'Others', 'text'),
(65, '1', '10', 'RE', 'group'),
(66, '1', 'f65', 'Normal', 'text'),
(67, '1', 'f65', 'Lid', 'text'),
(68, '1', 'f65', 'Conj', 'text'),
(69, '1', 'f65', 'Cornea', 'text'),
(70, '1', 'f65', 'Pupil', 'text'),
(71, '1', 'f65', 'A/C', 'text'),
(72, '1', 'f65', 'Others', 'text'),
(73, '1', '10', 'LE', 'group'),
(74, '1', 'f73', 'Normal', 'text'),
(75, '1', 'f73', 'Lid', 'text'),
(76, '1', 'f73', 'Conj', 'text'),
(77, '1', 'f73', 'Cornea', 'text'),
(78, '1', 'f73', 'Pupil', 'text'),
(79, '1', 'f73', 'A/C', 'text'),
(80, '1', 'f73', 'Others', 'text'),
(81, '1', '10', 'Opthalmoscopy', 'group'),
(82, '1', 'f81', 'Normal', 'text'),
(83, '1', 'f81', 'OD', 'text'),
(84, '1', 'f81', 'OS', 'text'),
(85, '1', 'f81', 'Others', 'text'),
(86, '1', '10', 'Tonometry', 'group'),
(87, '1', 'f86', 'Normal', 'text'),
(88, '1', 'f86', 'OD', 'text'),
(89, '1', 'f86', 'OS', 'text'),
(90, '1', 'f86', 'Others', 'text'),
(91, '1', '10', 'Cycloplegic/Auto Refraction', 'group'),
(92, '1', 'f91', 'Normal', 'text'),
(93, '1', 'f91', 'OD', 'text'),
(94, '1', 'f91', 'OS', 'text'),
(95, '1', 'f91', 'Others', 'text'),
(96, '1', '10', 'Subjective Refraction', 'group'),
(97, '1', '10', 'Diagnosis Details', 'text'),
(98, '1', '10', 'Patient Instruction', 'text'),
(99, '1', '10', 'Plan Notes', 'text'),
(100, '1', '10', 'Follow Up Details', 'group'),
(101, '1', 'f100', 'Next Visiting Date', 'date'),
(102, '1', 'f100', 'Remarks', 'text'),
(103, '1', '1', 'Follow Up Details', 'group'),
(104, '1', '4', 'Follow Up Details', 'group'),
(105, '1', '8', 'PC', 'text'),
(106, '1', '8', 'HPC', 'text'),
(107, '1', '8', 'Personal, Family & Social History', 'group'),
(108, '1', '8', 'Past / Recent Invesgitation', 'text'),
(109, '1', '8', 'Review of Systems', 'text'),
(110, '1', '8', 'Physical Examination', 'text'),
(111, '1', '8', 'Diagnosis Details', 'text'),
(112, '1', '8', 'Patient Instruction', 'text'),
(113, '1', '8', 'Follow Up Details', 'group'),
(114, '1', 'f113', 'Next Visiting Date', 'date'),
(115, '1', 'f113', 'Remarks', 'text'),
(116, '1', '9', 'Patient\'s Complaint', 'text'),
(117, '1', '9', 'Hx of PC', 'text'),
(118, '1', '9', 'Personal, Family & Social History', 'group'),
(119, '1', '9', 'Intra Oral Examination', 'text'),
(120, '1', 'f118', 'Past Dental History', 'text'),
(121, '1', 'f118', 'Family History', 'text'),
(122, '1', 'f118', 'Social History', 'text'),
(123, '1', 'f96', 'Normal', 'text'),
(124, '1', 'f96', 'OD', 'text'),
(125, '1', 'f96', 'OS', 'text'),
(126, '1', 'f96', 'ADD', 'text'),
(127, '1', 'f96', 'OTHERS', 'text'),
(128, '1', '9', 'Extra Oral Examination', 'text'),
(129, '1', '9', 'Diagnosis Details', 'text'),
(130, '1', '9', 'Management', 'text'),
(131, '1', '9', 'Follow Up Details', 'group'),
(132, '1', 'f131', 'Next Visiting Date', 'date'),
(133, '1', 'f131', 'Remarks', 'text'),
(134, '1', '2', 'Chief Complaint', 'text'),
(135, '1', '2', 'Consultation Notes', 'text'),
(136, '1', '2', 'Personal, Family & Social History', 'group'),
(137, '1', 'f136', 'Past Medical History', 'text'),
(138, '1', 'f136', 'Family History', 'text'),
(139, '1', 'f136', 'Social History', 'text'),
(140, '1', '2', 'Review of Systems', 'text'),
(141, '1', '2', 'Physical Examination', 'text'),
(142, '1', '2', 'Diagnosis Details', 'text'),
(143, '1', '2', 'Patient Instruction', 'text'),
(144, '1', '2', 'Follow Up Details', 'group'),
(145, '1', 'f144', 'Next Visiting Date', 'date'),
(146, '1', 'f144', 'Remarks', 'text'),
(148, '1', '6', 'Chief Complaint', 'text'),
(149, '1', '6', 'Consultation Notes', 'text'),
(150, '1', '6', 'Personal, Family & Social History', 'group'),
(151, '1', 'f150', 'Past Medical History', 'text'),
(152, '1', 'f150', 'Family History', 'text'),
(153, '1', 'f150', 'Social History', 'text'),
(154, '1', '6', 'Review of Systems', 'text'),
(155, '1', '6', 'Physical Examination', 'text'),
(156, '1', '6', 'Diagnosis Details', 'text'),
(157, '1', '6', 'Patient Instruction', 'text'),
(158, '1', '6', 'Follow Up Details', 'group'),
(159, '1', 'f158', 'Next Visiting Date', 'date'),
(160, '1', 'f158', 'Remarks', 'text'),
(161, '1', '11', 'Film', 'image'),
(162, '1', 'f107', 'Past Medical History', 'text'),
(163, '1', 'f107', 'Family History', 'text'),
(164, '1', 'f107', 'Social History', 'text'),
(165, '1', '7', 'MARITAL STATUS', 'text'),
(166, '1', '7', 'MARITAL HISTORY', 'group'),
(167, '1', 'f166', 'Married (When and State of Marriage)', 'text'),
(168, '1', 'f166', 'Divorced (When and Effect)', 'text'),
(169, '1', 'f166', 'Separated (When and Effect)', 'text'),
(170, '1', 'f166', 'Single (Effect)', 'text'),
(171, '1', '7', 'FAMILY', 'group'),
(172, '1', 'f171', 'No of Spouse', 'text'),
(173, '1', 'f171', 'Spouse State of Health', 'text'),
(174, '1', 'f171', 'No of Children', 'text'),
(175, '1', 'f171', 'Child/Children State of Health', 'text'),
(176, '1', 'f171', 'No of Sibling/s', 'text'),
(177, '1', 'f171', 'Sibling/s State of Health', 'text'),
(178, '1', 'f171', 'Indicate Cause of Death of Sibling/s (if any)', 'text'),
(179, '1', 'f171', 'Indicate Cause of Ailment of Sibling/s (if any)', 'text'),
(180, '1', 'f171', 'Parents State of Health (Mother, Father, Grandmother, Grandfather)', 'text'),
(181, '1', 'f171', 'Parents Cause of Death If Any (Father, ,', 'text'),
(182, '1', '7', 'CHRONIC ILLNESS OF ANY FAMILY MEMBER', 'group'),
(183, '1', 'f182', 'HTN (No of Family Member and State of Health)', 'text'),
(184, '1', 'f182', 'DM (No of Family Member and State of Health)', 'text'),
(185, '1', 'f182', 'ASTHMA (No of Family Member and State of Health)', 'text'),
(186, '1', 'f182', 'TB (No of Family Member and State of Health)', 'text'),
(187, '1', 'f182', 'ALLERGY (No of Family Member and State of Health)', 'text'),
(188, '1', 'f182', 'Disability (No of Family Member and State of Health)', 'text'),
(189, '1', 'f182', 'BREAST CANCER (No of Family Member and State of Health)', 'text'),
(190, '1', 'f182', 'CERVICAL CANCER (No of Family Member and State of Health)', 'text'),
(191, '1', 'f182', 'PROSTATE CANCER (No of Family Member and State of Health)', 'text'),
(192, '1', 'f182', 'BPH (No of Family Member and State of Health)', 'text'),
(193, '1', '7', 'How good is the family support system in time of need', 'text'),
(194, '1', '7', 'Who is your closest family member', 'text'),
(195, '1', '7', 'Emotional stress due to family issue', 'text'),
(196, '1', '7', 'SOCIAL HABIT (On a scale of 0-10)', 'group'),
(197, '1', 'f196', 'Smoking', 'text'),
(198, '1', 'f196', 'Alcohol Drinking', 'text'),
(199, '1', 'f196', 'Unprescribed Drugs', 'text'),
(200, '1', 'f196', 'Hard Drugs (Cannabis, Cocaine)', 'text'),
(201, '1', 'f196', 'Herbal Concoction', 'text'),
(202, '1', 'f196', 'Cultural need to be obese', 'text'),
(203, '1', 'f196', 'Unprotected sex outside spouse', 'text'),
(204, '1', 'f196', 'Multiple sex partners', 'text'),
(205, '1', '7', 'PAST SOCIAL HABIT (Indicate duration in years)', 'group'),
(206, '1', 'f205', 'Smoking', 'text'),
(207, '1', 'f205', 'Alcohol Drinking', 'text'),
(208, '1', 'f205', 'Unprescribed Drugs', 'text'),
(209, '1', 'f205', 'Hard Drugs (Cannabis, Cocaine)', 'text'),
(210, '1', 'f205', 'Herbal Concoction', 'text'),
(211, '1', 'f205', 'Cultural need to be obese', 'text'),
(212, '1', 'f205', 'Unprotected sex outside spouse', 'text'),
(213, '1', 'f205', 'Multiple sex partners', 'text'),
(214, '1', '7', 'DIET/NUTRITION (on a scale of 0-10)', 'group'),
(215, '1', '7', 'PRESENT MEDICAL HISTORY', 'group'),
(216, '1', 'f215', 'DM', 'text'),
(217, '1', 'f215', 'HTN', 'text'),
(218, '1', 'f215', 'EPILEPSY', 'text'),
(219, '1', 'f215', 'TB', 'text'),
(220, '1', 'f215', 'PROSTATE', 'text'),
(221, '1', 'f215', 'HEART DISEASE', 'text'),
(222, '1', 'f215', 'DENTAL PROBLEM', 'text'),
(223, '1', 'f215', 'LIVER DISEASE', 'text'),
(224, '1', 'f215', 'HEPATITIS', 'text'),
(225, '1', 'f215', 'SICKLE CELL', 'text'),
(226, '1', 'f215', 'KIDNEY DISEASE', 'text'),
(227, '1', 'f215', 'GALL BLADDER', 'text'),
(228, '1', 'f215', 'MENOPAUSE', 'text'),
(229, '1', 'f215', 'DEPRESSION', 'text'),
(230, '1', 'f215', 'DISABILITY', 'text'),
(231, '1', 'f215', 'LOW BACK PAIN', 'text'),
(232, '1', 'f215', 'BACK PAIN', 'text'),
(233, '1', 'f215', 'HEARING PROBLEM', 'text'),
(234, '1', 'f215', 'VISUAL (EYE) PROBLEM', 'text'),
(235, '1', 'f215', 'POOR ERECTION', 'text'),
(236, '1', 'f215', 'INABILITY TO CONCEIVE', 'text'),
(237, '1', 'f215', 'OBESITY', 'text'),
(238, '1', 'f215', 'DRUNKENNESS', 'text'),
(239, '1', 'f215', 'FAINTING ATTACK', 'text'),
(240, '1', 'f215', 'EPILEPSY', 'text'),
(241, '1', 'f215', 'ARTHRITIS', 'text'),
(242, '1', 'f215', 'HIV/AIDS', 'text'),
(243, '1', 'f215', 'SKIN DISEASE (Ezcema, Dermatitis)', 'text'),
(244, '1', '7', 'PAST MEDICAL HISTORY', 'group'),
(245, '1', '7', 'PAST SURGICAL HISTORY (Indicate with date/hospital)', 'group'),
(246, '1', 'f245', 'APPENDECTOMY', 'text'),
(247, '1', 'f245', 'HERNIA OPERATION', 'text'),
(248, '1', 'f245', 'C/S', 'text'),
(249, '1', 'f245', 'FRACTURE OPERATION', 'text'),
(250, '1', 'f245', 'ECTOPIC PREGNANCY', 'text'),
(251, '1', 'f245', 'FIBROID OPERATION', 'text'),
(252, '1', 'f245', 'THYROID OPERATION', 'text'),
(253, '1', 'f245', 'EYE OPERATION', 'text'),
(254, '1', 'f245', 'BREAST LUMP', 'text'),
(255, '1', 'f245', 'OTHERS', 'text'),
(256, '1', '7', 'ALLERGIES (Rate regularity of drug intake on a scale of 0-10)', 'group'),
(257, '1', 'f256', 'Consistent Drugs', 'text'),
(258, '1', 'f256', 'Contraceptives', 'text'),
(259, '1', 'f256', 'Acute Treatment', 'text'),
(260, '1', '7', 'IMMUNIZATION RECORD', 'group'),
(261, '1', 'f260', 'Have you been immunized against Hepatitis B?', 'polar'),
(262, '1', 'f260', 'Any identified validated blood result showing your Hepatitis C status?', 'polar'),
(263, '1', 'f260', 'Any identified validated blood result showing your HIV status', 'polar'),
(264, '1', 'f260', 'If you have not had chicken pox, have you been immunized?', 'polar'),
(265, '1', 'f260', 'Have had BCG, if so any scar?', 'polar'),
(266, '1', 'f260', 'Have you been immunized against Diphtheria?', 'polar'),
(267, '1', 'f260', 'Have you been immunized against Polio?', 'polar'),
(268, '1', 'f260', 'Have been immunized against Tetanus?', 'polar'),
(269, '1', 'f260', 'Have you been immunized against Hepatitis A?', 'polar'),
(270, '1', 'f260', 'Have you been tested for immunity to Rubella, Measles & Mumps?', 'polar'),
(271, '1', '7', 'OTHERS', 'group'),
(272, '1', 'f271', 'Do you need any special aids/adaptations to assist you at work whether or not you have a disability?', 'text'),
(273, '1', 'f271', 'Do you have any back problems or other musculo-skeletal problems which will cause difficulty with bending, lifting or standing for long periods?', 'text'),
(274, '1', 'f271', 'Do you have a history of anxiety, depression, psychiatric disorder, stress related problems, eating disorders, drug/alcohol misuse, self-harm or overdose?', 'text'),
(275, '1', 'f271', 'Do you take any regular prescribed medication?', 'text'),
(276, '1', 'f271', 'Do you have any skin conditions, allergies to skin cleansing products, latex or other glove problems?', 'text'),
(277, '1', 'f42', 'Family Ocular History', 'text'),
(278, '1', '4', 'DVA', 'group'),
(279, '1', 'f278', 'OD', 'text'),
(280, '1', 'f278', 'OS', 'text'),
(281, '1', '12', 'DIET HISTORY', 'text'),
(282, '1', '12', 'MEDICAL HISTORY', 'group'),
(283, '1', 'f282', 'FAMILY SOCIAL HISTORY', 'text'),
(284, '1', 'f282', 'PATIENT PAST MEDICAL HISTORY', 'text'),
(285, '1', 'f282', 'PATIENT PRESENT MEDICAL HISTORY', 'text'),
(286, '1', '12', 'NUTRITION DIAGNOSIS', 'text'),
(287, '1', '12', 'NUTRITION INTERVENTION', 'text'),
(288, '1', '12', '24 HOURS DIETARY RECALL', 'text'),
(289, '1', '12', 'BIOCHEMICAL ASSESSEMENT', 'text'),
(290, '1', '12', 'CLINICAL ASSESSEMENT', 'text'),
(291, '1', '12', 'ANTHROPOMETRY', 'text'),
(292, '1', '14', 'Migraine (Painful Headache)', 'polar'),
(293, '1', '14', 'Previous Medical History', 'text'),
(294, '1', '14', 'Immunization Date', 'date'),
(295, '1', '14', 'Family Medical History', 'group'),
(296, '1', 'f295', 'Family Name', 'text'),
(297, '1', 'f295', 'Last HIV Check up', 'date'),
(298, '1', 'f295', 'Do you come from a healthy family?', 'polar'),
(299, '1', '15', 'Date of Booking', 'date'),
(300, '1', '15', 'L.M.P.', 'date'),
(301, '1', '15', 'Speak English', 'polar'),
(302, '1', '15', 'Literate', 'polar'),
(303, '1', '15', 'Husband Details', 'group'),
(304, '1', 'f303', 'Husband Name', 'text'),
(305, '1', 'f303', 'Husband Occupation', 'text'),
(306, '1', '15', 'Previous Medical History', 'text'),
(307, '1', '15', 'Previous Pregnancies', 'group'),
(308, '1', 'f307', 'Total', 'text'),
(309, '1', 'f307', 'No of Living Children', 'text'),
(310, '1', 'f307', 'Previous Pregnancy History', 'text'),
(311, '1', '15', 'Immunization', 'group'),
(312, '1', '15', 'Glue Reports of Special Investigations', 'text'),
(313, '1', '15', 'Primary Assessment (History of Present Pregnancy)', 'group'),
(314, '1', 'f313', 'Bleeding', 'text'),
(315, '1', 'f313', 'Discharge', 'text'),
(316, '1', 'f313', 'Urinary Symptoms', 'text'),
(317, '1', 'f313', 'Swelling of Ankles', 'text'),
(318, '1', 'f313', 'Other Symptoms', 'text'),
(319, '1', '15', 'Physical Examination', 'group'),
(320, '1', 'f319', 'General Condition', 'text'),
(321, '1', 'f319', 'Respiratory System', 'text'),
(322, '1', 'f319', 'Cardiovascular System', 'text'),
(323, '1', 'f319', 'Abdomen', 'text'),
(324, '1', 'f319', 'Vaginal Examination', 'text'),
(325, '1', 'f319', 'Other Abnormalities', 'text'),
(326, '1', '15', 'Special Instructions Regarding Puerperium', 'text'),
(327, '1', '15', 'Assessment', 'group'),
(328, '1', 'f327', 'HB GENOTYPE', 'text'),
(329, '1', 'f327', 'CHEST X-RAY', 'text'),
(330, '1', 'f327', 'RHESUS', 'text'),
(331, '1', 'f327', 'KHAN', 'text'),
(332, '1', 'f327', 'ANTIMALARIALS & SPECIFIC THERAPY', 'text'),
(333, '1', '15', 'Follow-up Visits', 'group'),
(334, '1', 'f303', 'Husband Phone no', 'text'),
(335, '1', '15', 'Forecast', 'group'),
(336, '1', '16', '1Complaints & Relevant History (Mother & Child)', 'text'),
(337, '1', '16', '2Physical Examination (Mother & Child)', 'text'),
(338, '1', '16', '3Impression (Mother & Child)', 'text'),
(339, '1', '16', '4Patient Instruction (Mother & Child)', 'text'),
(340, '1', 'f103', 'Next Visit', 'date'),
(341, '1', '16', '5Follow Up Visit', 'group'),
(342, '1', 'f311', 'Name & Date', 'text'),
(343, '1', 'f333', 'Date', 'date'),
(344, '1', 'f333', 'Height of Fundus', 'text'),
(345, '1', 'f333', 'Presentation & Position', 'text'),
(346, '1', 'f333', 'Relationship of Presenting Part of Brim', 'text'),
(347, '1', 'f333', 'Foetal Heart', 'text'),
(348, '1', 'f333', 'Urine', 'text'),
(349, '1', 'f333', 'B.P.', 'text'),
(350, '1', 'f333', 'Weight', 'text'),
(351, '1', 'f333', 'Hb.', 'text'),
(352, '1', 'f333', 'Oedema', 'text'),
(353, '1', 'f333', 'Remarks', 'text'),
(354, '1', 'f333', 'Return', 'text'),
(355, '1', 'f335', 'AP Inlet', 'text'),
(356, '1', 'f335', 'AP Midcavity', 'text'),
(357, '1', 'f335', 'AP Outlet', 'text'),
(358, '1', 'f335', 'Contracted/Normal', 'text'),
(359, '1', 'f341', '6Next Visit', 'date'),
(360, '1', '17', 'Patient History', 'group'),
(361, '1', 'f360', 'Medical/Surgical History', 'text'),
(362, '1', 'f360', 'Obstetric History', 'text'),
(363, '1', 'f360', 'Social History', 'text'),
(364, '1', 'f360', 'Marital History', 'text'),
(365, '1', 'f360', 'Family History', 'text'),
(366, '1', '17', 'Presenting Complain', 'text'),
(367, '1', '17', 'Physical Examination', 'group'),
(368, '1', 'f367', 'General Condition', 'text'),
(369, '1', 'f367', 'Respiratory System', 'text'),
(370, '1', 'f367', 'Cardiovascular System', 'text'),
(371, '1', 'f367', 'Abdomen', 'text'),
(372, '1', 'f367', 'Vaginal Examination', 'text'),
(373, '1', 'f367', 'Other Abnormalities', 'text'),
(374, '1', '17', 'Assessment (Working Diagnosis)', 'text'),
(375, '1', '17', 'Follow Up Visit', 'group'),
(376, '1', 'f375', 'Next Visit', 'date'),
(377, '1', 'f38', 'Past Medical History', 'text'),
(378, '1', 'f38', 'Family History', 'text'),
(379, '1', 'f38', 'Social History', 'text'),
(380, '1', 'f104', 'Next Visit', 'date'),
(381, '1', '7', 'Follow Up Visit', 'group'),
(382, '1', 'f381', 'Next Visit', 'date'),
(383, '1', 'f381', 'Remarks', 'text'),
(384, '1', '12', 'Follow Up Visit', 'group'),
(385, '1', 'f384', 'Next Visit', 'date'),
(386, '1', 'f384', 'Remarks', 'text'),
(387, '1', 'f104', 'Remarks', 'text'),
(388, '1', 'f103', 'Remarks', 'text'),
(389, '1', 'f375', 'Remarks', 'text'),
(390, '1', 'f341', '7Remarks', 'text'),
(391, '1', '4', 'Assessment (Working Diagnosis)', 'text'),
(392, '1', 'f360', 'Gynaecological History', 'text'),
(393, '1', 'f360', 'Drugs/Allergy', 'text'),
(394, '1', '18', 'Chief Complaint', 'text'),
(395, '1', '18', 'Personal, Family & Social History', 'group'),
(396, '1', 'f395', 'Past Medical History', 'text'),
(397, '1', 'f395', 'Family History', 'text'),
(398, '1', 'f395', 'Social History', 'text'),
(399, '1', '18', 'Review of Systems', 'text'),
(400, '1', '18', 'Physical Examination', 'text'),
(401, '1', '18', 'Diagnosis', 'text'),
(402, '1', '18', 'Patient Instructions', 'text'),
(403, '1', '18', 'Follow-up Details', 'group'),
(404, '1', 'f403', 'Next Visit', 'date'),
(405, '1', 'f403', 'Remarks', 'text'),
(406, '1', 'f341', '8', 'text'),
(407, '1', 'f341', '9', 'date'),
(408, '1', 'f341', '10', 'polar'),
(409, '1', '16', 'test', 'group'),
(410, '1', 'f409', 'test 1', 'text'),
(411, '1', 'f409', 'test 2', 'date'),
(412, '1', 'f409', 'test 3', 'polar');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'superadmin', 'Super Admin'),
(2, 'members', 'General User'),
(3, 'Accountant', 'For Financial Activities'),
(4, 'Doctor', ''),
(5, 'Patient', ''),
(6, 'Nurse', ''),
(7, 'Pharmacist', ''),
(8, 'Laboratorist', ''),
(10, 'Receptionist', 'Receptionist'),
(11, 'admin', 'Administrator'),
(12, 'Radiologist', 'Group in charge of the radiology department'),
(13, 'Record_Officer', 'Record_Officer');

-- --------------------------------------------------------

--
-- Table structure for table `hmo`
--

CREATE TABLE `hmo` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `added_by` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `hospital_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `hmo`
--

INSERT INTO `hmo` (`id`, `name`, `phone`, `type`, `added_by`, `date`, `hospital_id`) VALUES
(1, 'NHIS', '000000000', 'HMO Insurance', 'Ad2', '1635266197', '1'),
(2, 'Venus Medicare Ltd', '0', 'HMO Insurance', 'Ad2', '1635266515', '1'),
(3, 'Markfema Nigeria Ltd', '0', 'HMO Insurance', 'Ad2', '1635266515', '1'),
(4, 'Greenbay Healthcare Services Ltd', '0', 'HMO Insurance', 'Ad2', '1635266515', '1'),
(5, 'Regenix Health Services Ltd', '0', 'HMO Insurance', 'Ad2', '1635266515', '1'),
(6, 'Axa Mansard HMO', '0', 'HMO Insurance', 'Ad2', '1635266515', '1'),
(7, 'Lifecare Partners Ltd', '0', 'HMO Insurance', 'Ad2', '1635266515', '1'),
(8, 'Ckline Health Management Ltd', '0', 'HMO Insurance', 'Ad2', '1635266516', '1'),
(9, 'Century HMO', '0', 'HMO Insurance', 'Ad2', '1635266516', '1'),
(10, 'Roding HMO', '0', 'HMO Insurance', 'Ad2', '1635266516', '1'),
(11, 'BHIS', '0', 'HMO Insurance', 'Ad2', '1635266516', '1'),
(12, 'AGIP', '0', 'Corporate Insurance', 'Ad2', '1635266516', '1'),
(13, 'SHELL', '0', 'Corporate Insurance', 'Ad2', '1635266516', '1'),
(14, 'CBN', '0', 'Corporate Insurance', 'Ad2', '1635266516', '1'),
(15, 'AZIKEL', '0', 'Corporate Insurance', 'Ad2', '1635266516', '1'),
(16, 'ZENITH BANK', '0', 'Corporate Insurance', 'Ad2', '1635266516', '1'),
(17, 'KETTISCO', '0', 'Corporate Insurance', 'Ad2', '1635266516', '1'),
(18, 'IHMS Insurance', '0', 'HMO Insurance', 'Ad2', '1635266517', '1'),
(19, 'Hygeia', '0000000', 'HMO Insurance', 'Ad11461', '1637163909', '1'),
(20, 'NodaWorks Nigeria Limited', '00000000', 'Corporate Insurance', 'Ad11461', '1637164052', '1'),
(22, 'Bacceferous Int. Ltd.', '0000000', 'Corporate Insurance', 'Ad11461', '1637164103', '1'),
(23, 'Thorbo Technologies Limited', '0000000', 'Corporate Insurance', 'Ad11461', '1637164137', '1'),
(24, 'Inventus Hub Limited', '0000000', 'Corporate Insurance', 'Ad11461', '1637164163', '1'),
(25, 'Ogiriki & Sons Enterprises', '0000000', 'Corporate Insurance', 'Ad11461', '1637164190', '1'),
(26, 'Reliance HMO', '0000000', 'HMO Insurance', 'Ad11461', '1637164205', '1'),
(27, 'Kings Heaven Global Limited', '0000000', 'Corporate Insurance', 'Ad11461', '1637164230', '1'),
(28, 'INFIL Petroleum Limited', '0000000', 'Corporate Insurance', 'Ad11461', '1637164259', '1'),
(29, 'Jayshawn Nigeria Limited', '0000000', 'Corporate Insurance', 'Ad11461', '1637164288', '1'),
(30, 'Avon HMO', '0000000', 'HMO Insurance', 'Ad11461', '1637164309', '1'),
(31, 'Green Field HMO', '0000000', 'HMO Insurance', 'Ad11461', '1637164326', '1'),
(32, 'MetroHealth HMO', '0000000', 'HMO Insurance', 'Ad11461', '1637164355', '1'),
(33, 'Novo Health HMO', '0000000', 'HMO Insurance', 'Ad11461', '1637164411', '1'),
(34, 'Songhai Health Trust', '0000000', 'HMO Insurance', 'Ad11461', '1637164425', '1'),
(35, 'Precious HMO', '0000000', 'HMO Insurance', 'Ad11461', '1637164438', '1'),
(36, 'Salus Trust HMO', '0000000', 'HMO Insurance', 'Ad11461', '1637164455', '1'),
(37, 'Smathealth HMO', '0000000', 'HMO Insurance', 'Ad11461', '1637164471', '1'),
(38, 'Bastion Health HMO', '0000000', 'HMO Insurance', 'Ad11461', '1637164486', '1'),
(39, 'Synergy HMO', '0000000', 'HMO Insurance', 'Ad11461', '1637164498', '1'),
(40, 'HealthCare International', '0000000', 'HMO Insurance', 'Ad11461', '1637164519', '1'),
(41, 'Total Health Trust HMO', '0000000', 'HMO Insurance', 'Ad11461', '1637164538', '1');

-- --------------------------------------------------------

--
-- Table structure for table `hmo_price`
--

CREATE TABLE `hmo_price` (
  `id` int(11) NOT NULL,
  `hmo_id` varchar(255) NOT NULL,
  `payment_category` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hmo_sponsor`
--

CREATE TABLE `hmo_sponsor` (
  `id` int(11) NOT NULL,
  `insurance_id` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `date` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `hmo_sponsor`
--

INSERT INTO `hmo_sponsor` (`id`, `insurance_id`, `name`, `date`) VALUES
(1, '1', 'Total Health Trust Ltd', '1635266514'),
(2, '1', 'Clearline International Ltd', '1635266514'),
(3, '1', 'Healthcare International Ltd', '1635266514'),
(4, '1', 'Mediplan Healthcare Ltd', '1635266514'),
(5, '1', 'Hygeia HMO Ltd', '1635266515'),
(6, '1', 'AIICO Multishield Nigeria Ltd', '1635266515'),
(7, '1', 'Premier Medicaid Ltd', '1635266515'),
(8, '1', 'United Healthcare International Ltd', '1635266515'),
(9, '1', 'Ronsberger Nigeria Ltd', '1635266515'),
(10, '1', 'Managed Healthcare Services Ltd (SUNU)', '1635266515'),
(11, '1', 'Songhai Health Trust Ltd.', '1635266515'),
(12, '2', 'Venus Medicare Ltd', '1635266515'),
(13, '1', 'Zuma Health Trust', '1635266515'),
(14, '1', 'United Comprehensive Health Managers Ltd', '1635266515'),
(15, '3', 'Markfema Nigeria Ltd', '1635266515'),
(16, '1', 'Royal Exchange Healthcare Ltd', '1635266515'),
(17, '4', 'Greenbay Healthcare Services Ltd', '1635266515'),
(18, '5', 'Regenix Health Services Ltd', '1635266515'),
(19, '1', 'Ultimate Health Management Services Ltd', '1635266515'),
(20, '6', 'Axa Mansard HMO', '1635266515'),
(21, '7', 'Lifecare Partners Ltd', '1635266515'),
(22, '1', 'Police Health Maintenance Ltd', '1635266516'),
(24, '8', 'Ckline Health Management Ltd', '1635266516'),
(25, '9', 'Century HMO', '1635266516'),
(26, '10', 'Roding HMO', '1635266516'),
(27, '1', 'NHIS', '1635266516'),
(28, '11', 'BHIS', '1635266516'),
(29, '12', 'AGIP', '1635266516'),
(30, '13', 'SHELL', '1635266516'),
(31, '14', 'CBN', '1635266516'),
(32, '15', 'AZIKEL', '1635266516'),
(33, '16', 'ZENITH BANK', '1635266516'),
(35, '17', 'KETTISCO', '1635266517'),
(36, '18', 'IHMS Insurance', '1635266517'),
(37, '1', 'NNPC', '1111111'),
(38, '1', 'Precious Health HMO', '1637163786'),
(39, '1', 'Regenix HealthCare Services', '1637163842'),
(40, '20', 'NodaWorks Nigeria Limited', '1637164052'),
(42, '22', 'Bacceferous Int. Ltd.', '1637164103'),
(43, '23', 'Thorbo Technologies Limited', '1637164137'),
(44, '24', 'Inventus Hub Limited', '1637164163'),
(45, '25', 'Ogiriki & Sons Enterprises', '1637164190'),
(46, '27', 'Kings Heaven Global Limited', '1637164230'),
(47, '28', 'INFIL Petroleum Limited', '1637164259'),
(48, '29', 'Jayshawn Nigeria Limited', '1637164288');

-- --------------------------------------------------------

--
-- Table structure for table `holidays`
--

CREATE TABLE `holidays` (
  `id` int(11) NOT NULL,
  `doctor` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `date` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `x` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `y` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `hospital_id` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hospital`
--

CREATE TABLE `hospital` (
  `id` int(11) NOT NULL,
  `name` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `email` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `password` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `address` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `phone` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `package` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `p_limit` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `d_limit` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `module` varchar(1000) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `ion_user_id` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `request_check` varchar(255) NOT NULL,
  `consultation_fee` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `hospital`
--

INSERT INTO `hospital` (`id`, `name`, `email`, `password`, `address`, `phone`, `package`, `p_limit`, `d_limit`, `module`, `ion_user_id`, `request_check`, `consultation_fee`) VALUES
(1, 'Family Care Hospital', 'fch@xerdocshms.com', NULL, 'Bayelsa Yenegoa', '00000', '', '100000', '1000', 'accountant,appointment,lab,bed,department,doctor,donor,finance,pharmacy,laboratorist,medicine,nurse,patient,pharmacist,prescription,receptionist,report,notice,email,sms', '2', '1637073326', ''),
(2, 'Test Hospital', 'hospital@gmail.com', NULL, 'address here', '0901234567', '', '1000', '500', 'accountant,appointment,lab,bed,department,doctor,donor,finance,pharmacy,laboratorist,medicine,nurse,patient,pharmacist,prescription,receptionist,report,notice,email,sms', '752', '', ''),
(3, 'Chinemeze Akuh Hospital', 'neme@gmail.com', NULL, 'Abuja', '123123123', '', '1000', '500', 'accountant,appointment,lab,bed,department,doctor,donor,finance,pharmacy,laboratorist,medicine,nurse,patient,pharmacist,prescription,receptionist,report,notice,email,sms', '762', '', ''),
(4, 'SaveALife Hospital', 'admin@demo.savealife.com', NULL, 'PortHarcourt, Rivers', '123123123123', '', '1000', '500', 'accountant,appointment,lab,bed,department,doctor,donor,finance,pharmacy,laboratorist,medicine,nurse,patient,pharmacist,prescription,receptionist,report,notice,email,sms', '772', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `h_vitals`
--

CREATE TABLE `h_vitals` (
  `id` int(11) NOT NULL,
  `hospital_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `h_vitals`
--

INSERT INTO `h_vitals` (`id`, `hospital_id`, `name`) VALUES
(1, '1', 'SPO2');

-- --------------------------------------------------------

--
-- Table structure for table `lab`
--

CREATE TABLE `lab` (
  `id` int(11) NOT NULL,
  `category` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `patient` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `doctor` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `date` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `category_name` varchar(1000) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `report` varchar(10000) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `status` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `user` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `patient_name` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `patient_phone` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `patient_address` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `doctor_name` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `date_string` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `hospital_id` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `laboratorist`
--

CREATE TABLE `laboratorist` (
  `id` int(11) NOT NULL,
  `img_url` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `name` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `address` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `phone` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `x` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `y` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `ion_user_id` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `hospital_id` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `laboratorist`
--

INSERT INTO `laboratorist` (`id`, `img_url`, `name`, `email`, `address`, `phone`, `x`, `y`, `ion_user_id`, `hospital_id`) VALUES
(0, NULL, 'Laboratorist', 'Laboratorist@hms.com', '12345', '12345', NULL, NULL, '756', '2'),
(0, NULL, 'Laboratist 1', 'lab1@demo.familycare.com', 'Temp Address', '345333333333', NULL, NULL, '768', '1'),
(0, NULL, 'Lab 1', 'laboratist@demo.savealife.com', 'Temp Address', '1123434556666', NULL, NULL, '777', '4');

-- --------------------------------------------------------

--
-- Table structure for table `lab_category`
--

CREATE TABLE `lab_category` (
  `id` int(11) NOT NULL,
  `category` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `description` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `reference_value` varchar(1000) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `hospital_id` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lab_request`
--

CREATE TABLE `lab_request` (
  `id` int(11) NOT NULL,
  `hospital_id` varchar(255) NOT NULL,
  `doctor` varchar(255) NOT NULL,
  `patient_id` varchar(255) NOT NULL,
  `patient_name` varchar(255) NOT NULL,
  `doctor_name` varchar(255) NOT NULL,
  `test` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lab_test`
--

CREATE TABLE `lab_test` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `category` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `specimen` varchar(100) NOT NULL,
  `hospital_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(10) UNSIGNED NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `manualemailshortcode`
--

CREATE TABLE `manualemailshortcode` (
  `id` int(11) NOT NULL,
  `name` varchar(1000) DEFAULT NULL,
  `type` varchar(1000) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `manualsmsshortcode`
--

CREATE TABLE `manualsmsshortcode` (
  `id` int(11) NOT NULL,
  `name` varchar(1000) DEFAULT NULL,
  `type` varchar(1000) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `manual_email_template`
--

CREATE TABLE `manual_email_template` (
  `id` int(11) NOT NULL,
  `name` varchar(1000) DEFAULT NULL,
  `message` varchar(1000) DEFAULT NULL,
  `type` varchar(1000) DEFAULT NULL,
  `hospital_id` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `manual_sms_template`
--

CREATE TABLE `manual_sms_template` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `message` varchar(1000) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `hospital_id` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `medical_history`
--

CREATE TABLE `medical_history` (
  `id` int(11) NOT NULL,
  `patient_id` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `checkin_id` varchar(10) DEFAULT NULL,
  `title` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `description` varchar(10000) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `doctor_id` varchar(255) NOT NULL,
  `department` varchar(10) NOT NULL,
  `patient_name` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `patient_address` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `patient_phone` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `img_url` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `date` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `registration_time` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `hospital_id` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `medical_history_form`
--

CREATE TABLE `medical_history_form` (
  `id` int(11) NOT NULL,
  `hospital_id` varchar(255) NOT NULL,
  `form_id` varchar(255) NOT NULL,
  `history_id` varchar(255) NOT NULL,
  `data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `medicine`
--

CREATE TABLE `medicine` (
  `id` int(11) NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `category` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `price` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `box` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `s_price` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `generic` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `company` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `effects` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `e_date` varchar(70) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `add_date` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `hospital_id` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `medicine`
--

INSERT INTO `medicine` (`id`, `name`, `category`, `price`, `box`, `s_price`, `quantity`, `generic`, `company`, `effects`, `e_date`, `add_date`, `hospital_id`) VALUES
(1, 'Daniel', 'No category', 'DE', 'EWE', 'DWEDWEDWE', 0, 'EWE', 'WEWED', 'WEWEDE', '16-09-2023', '09/22/23', '1');

-- --------------------------------------------------------

--
-- Table structure for table `medicine_category`
--

CREATE TABLE `medicine_category` (
  `id` int(11) NOT NULL,
  `category` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `description` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `hospital_id` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `medicine_category`
--

INSERT INTO `medicine_category` (`id`, `category`, `description`, `hospital_id`) VALUES
(1, 'No category', 'no category', '1');

-- --------------------------------------------------------

--
-- Table structure for table `meeting`
--

CREATE TABLE `meeting` (
  `id` int(11) NOT NULL,
  `patient` varchar(100) DEFAULT NULL,
  `doctor` varchar(100) DEFAULT NULL,
  `topic` varchar(1000) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `start_time` varchar(100) DEFAULT NULL,
  `duration` varchar(100) DEFAULT NULL,
  `timezone` varchar(100) DEFAULT NULL,
  `meeting_id` varchar(100) DEFAULT NULL,
  `meeting_password` varchar(100) DEFAULT NULL,
  `date` varchar(100) DEFAULT NULL,
  `time_slot` varchar(100) DEFAULT NULL,
  `s_time` varchar(100) DEFAULT NULL,
  `e_time` varchar(100) DEFAULT NULL,
  `remarks` varchar(500) DEFAULT NULL,
  `add_date` varchar(100) DEFAULT NULL,
  `registration_time` varchar(100) DEFAULT NULL,
  `s_time_key` varchar(100) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `user` varchar(100) DEFAULT NULL,
  `request` varchar(100) DEFAULT NULL,
  `patientname` varchar(1000) DEFAULT NULL,
  `doctorname` varchar(1000) DEFAULT NULL,
  `ion_user_id` varchar(100) DEFAULT NULL,
  `doctor_ion_id` varchar(100) DEFAULT NULL,
  `patient_ion_id` varchar(100) DEFAULT NULL,
  `hospital_id` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `meeting_settings`
--

CREATE TABLE `meeting_settings` (
  `id` int(11) NOT NULL,
  `api_key` varchar(100) DEFAULT NULL,
  `secret_key` varchar(100) DEFAULT NULL,
  `ion_user_id` varchar(100) DEFAULT NULL,
  `y` varchar(100) DEFAULT NULL,
  `hospital_id` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `convo_id` varchar(255) NOT NULL,
  `message` longtext NOT NULL,
  `sender` varchar(255) NOT NULL,
  `reciever` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `delivered` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `convo_id`, `message`, `sender`, `reciever`, `status`, `delivered`, `date`) VALUES
(1, '1', 'DO U STILL HAVE PATIENTS WAITING FOR U?', '11456', '11161', '0', '1', '1635865651'),
(2, '2', 'how far', '11475', '11474', '1', '1', '1636382865'),
(3, '2', 'are you still seeing patients?', '11475', '11474', '1', '1', '1636382909'),
(4, '3', 'Don\'t forget to cover up for me next month', '11471', '11476', '1', '1', '1637326644'),
(5, '4', 'PLEASE UPDATE MRS SONIA KOROMO TUNAMI ON THE SOFTWARE', '11443', '11453', '1', '1', '1637339944'),
(6, '5', 'pls dont for to enter', '11448', '11449', '1', '1', '1642055306'),
(7, '5', '', '11448', '11449', '1', '1', '1642055314'),
(8, '5', '', '11448', '11449', '1', '1', '1642055318'),
(9, '1', 'yes', '11455', '11456', '1', '0', '1648114648'),
(10, '6', 'where are u?', '11455', '11457', '1', '1', '1648114672'),
(11, '5', 'YOU SAY WAITIN', '11448', '11449', '1', '1', '1650899012'),
(12, '7', 'hi', '774', '779', '1', '1', '1689252824'),
(13, '7', 'How are u doing', '774', '779', '1', '1', '1689252842'),
(14, '7', 'hello', '774', '779', '1', '1', '1691734526'),
(15, '7', '', '774', '779', '1', '1', '1691740243');

-- --------------------------------------------------------

--
-- Table structure for table `module`
--

CREATE TABLE `module` (
  `id` int(11) NOT NULL,
  `hospital_id` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `modules` varchar(1000) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `x` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `y` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notice`
--

CREATE TABLE `notice` (
  `id` int(11) NOT NULL,
  `title` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `description` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `date` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `type` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `hospital_id` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nurse`
--

CREATE TABLE `nurse` (
  `id` int(11) NOT NULL,
  `img_url` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `name` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `address` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `phone` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `x` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `y` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `z` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `ion_user_id` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `hospital_id` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `nurse`
--

INSERT INTO `nurse` (`id`, `img_url`, `name`, `email`, `address`, `phone`, `x`, `y`, `z`, `ion_user_id`, `hospital_id`) VALUES
(1, NULL, 'nurse', 'nurse@hms.com', '12345', '12345', NULL, NULL, NULL, '754', '2'),
(2, NULL, 'Nurse 1', 'nurse1@xerdocshms.com', 'Inside the hospital', '080223312346', NULL, NULL, NULL, '766', '1'),
(3, NULL, 'Nurse 1', 'nurse1@demo.savealife.com', 'Temp Address', '12345555533', NULL, NULL, NULL, '773', '4');

-- --------------------------------------------------------

--
-- Table structure for table `operations`
--

CREATE TABLE `operations` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `hospital_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `operations`
--

INSERT INTO `operations` (`id`, `name`, `price`, `hospital_id`) VALUES
(1, 'EVALUATION', '150000', '1'),
(2, 'OVULATION INDUCTION', '50000', '1'),
(3, 'INTRA-UTERINE INSEMINATION (IUI)', '350000', '1'),
(4, 'IN-VITRO FERTILIZATION (IVF)', '1000000', '1'),
(5, 'DONOR OOCYTES (DO)', '200000', '1'),
(6, 'DONOR SPERM (DS)', '100000', '1'),
(7, 'INTRA-CYSTOPLAMIC SPERM INJECTION (ICSI)', '150000', '1'),
(8, 'CO-STIMULATION', '500000', '1'),
(9, 'SEMEN CRYPTO-PRESERVATION', '50000', '1'),
(10, 'EMBRYO CRYPTO-PRESERVATION', '50000', '1'),
(11, 'Acrylic Additional Tooth', '5000', '1'),
(12, 'Acrylic first tooth', '10000', '1'),
(13, 'Anterior Tooth Extration ', '5000', '1'),
(14, 'Biopsy I/E', '10000', '1'),
(15, 'Bridge(Acrylic)', '20000', '1'),
(16, 'Bridge(Porcelain)', '80000', '1'),
(17, 'Composit Teeth Restoration(Per Tooth)', '10000', '1'),
(18, 'Crown (Acrylic)', '20000', '1'),
(19, 'Crown (Porcelain)', '80000', '1'),
(20, 'Curretage', '5000', '1'),
(21, 'Dental X-Ray', '3000', '1'),
(22, 'Desensitization (Per Tooth)', '5000', '1'),
(23, 'Dry Socket', '10000', '1'),
(24, 'Fractured/Retained Root Tooth Extraction', '5000', '1'),
(25, 'GIC Restoration', '8000', '1'),
(26, 'Incision and Drainage of Ludwig\'s Angina', '60000', '1'),
(27, 'Incision and Drainage of Periapical Abscess', '10000', '1'),
(28, 'Intra-Oral X-Ray (Between)', '3000', '1'),
(29, 'Intra-Oral X-Ray (Periapical)', '3000', '1'),
(30, 'Operculectomy', '7000', '1'),
(31, 'Pericoronitis', '10000', '1'),
(32, 'Pulpectomy', '10000', '1'),
(33, 'Pulpotomy(Per Tooth)', '10000', '1'),
(34, 'Reduction and Imoilization under LA', '60000', '1'),
(35, 'Root Canal Treatment (Anterior Tooth)', '30000', '1'),
(36, 'Root Canal Treatment (Posterior tooth)', '50000', '1'),
(37, 'Surgical Extraction(Per Tooth)', '30000', '1'),
(38, 'Tooth Extraction(Surgical)', '30000', '1'),
(39, 'Tooth Filling (Amalgam) Class 1', '8000', '1'),
(40, 'Tooth Filling (Composite)', '10000', '1'),
(41, '3RD Degree Perineal Tear', '50000', '1'),
(42, 'Assissted Vaginal delivery (Booked)', '35000', '1'),
(43, 'Assisted delivery (Unbooked)', '50000', '1'),
(44, 'Caesarian section with btl', '300000', '1'),
(45, 'Caesarian section(primary)first', '200000', '1'),
(46, 'Caesarian section(secondary) repeat', '250000', '1'),
(47, 'Caesarian section-twins', '300000', '1'),
(48, 'Caesarian section-twins repeat', '300000', '1'),
(49, 'Caeserian for SFC PXT', '350000', '1'),
(50, 'Ceasarian Hysterectomy', '300000', '1'),
(51, 'Cervical circlage', '30000', '1'),
(52, 'Episotomy Primary', '10000', '1'),
(53, 'Episotomy Secondary', '20000', '1'),
(54, 'Exploratory Laparatomy', '200000', '1'),
(55, 'Hysterectomy', '300000', '1'),
(56, 'Induction of Labour', '20000', '1'),
(57, 'Insertion I.U.C.D', '5000', '1'),
(58, 'Manual removal of Placenta', '16000', '1'),
(59, 'Masopialization', '30000', '1'),
(60, 'Mymectomy', '300000', '1'),
(61, 'Normal delivery (Booked)', '25000', '1'),
(62, 'Normal delivery (Unbooked)', '30000', '1'),
(63, 'Pap Smear', '20000', '1'),
(64, 'Surgical removal of Placenta', '20000', '1'),
(65, 'Tubal Ligation', '100000', '1'),
(66, 'Admission Pack', '1500', '1'),
(67, 'Blood giving set', '200', '1'),
(68, 'Canula', '200', '1'),
(69, 'Chromic', '500', '1'),
(70, 'Crepe bandage 3inches', '200', '1'),
(71, 'Crepe bandage 4inches', '250', '1'),
(72, 'Crepe bandage 6inches', '250', '1'),
(73, 'Drip giving set', '100', '1'),
(74, 'Foley', '400', '1'),
(75, 'Injection', '200', '1'),
(76, 'LBD-Mother/Baby', '3000', '1'),
(77, 'Major Pack', '500', '1'),
(78, 'Minor Pack', '250', '1'),
(79, 'NG Tube', '250', '1'),
(80, 'Nylon suture', '300', '1'),
(81, 'Out-patient nursing care', '500', '1'),
(82, 'PBS', '600', '1'),
(83, 'Silk', '300', '1'),
(84, 'Superficial wound dressing', '500', '1'),
(85, 'Surgical blade', '50', '1'),
(86, 'Surgical gloves', '150', '1'),
(87, 'Syringes 10mls', '40', '1'),
(88, 'Syringes 20mls', '50', '1'),
(89, 'Syringes 2mls', '30', '1'),
(90, 'Syringes 5mls', '30', '1'),
(91, 'Urine bags', '250', '1'),
(92, 'Vicryl', '1000', '1'),
(93, 'Wound Dressing: Two or more limbs (double amount)', '2000', '1'),
(94, 'Catherization', '3000', '1'),
(95, 'Congenital multiple digits of cyndactyly', '7500', '1'),
(96, 'Ear syringing', '2000', '1'),
(97, 'Exchange Blood Transfusion (Rh - Ve Blood with set)', '30000', '1'),
(98, 'Exchange Blood Transfusion (Rh + Ve Blood with set)', '20000', '1'),
(99, 'Minor Debridment of Burns', '3500', '1'),
(100, 'Nebulisation', '5000', '1'),
(101, 'Pint of Screened Blood (Rh - Ve)', '25000', '1'),
(102, 'Pint of Screened Blood (Rh + Ve)', '20000', '1'),
(103, 'Release of Chordate ', '5000', '1'),
(104, 'Repair of Minor Laceration ', '10000', '1'),
(105, 'Small Cyst Excision', '5000', '1'),
(106, 'Subdura Tap', '3000', '1'),
(107, 'Tongue Tie Release ', '5000', '1'),
(108, 'Suction per session', '10000', '1'),
(109, 'Oxygen therapy', '20000', '1'),
(110, 'Phototherapy per session', '15000', '1'),
(111, 'Comprehensive Health Assessment', '30000', '1'),
(112, 'Medical Form Completion', '10000', '1'),
(113, 'Abdominal Rectopexy', '170000', '1'),
(114, 'ADENOTONSILLECTOMY (ENT MAJOR SURGERY)', '350000', '1'),
(115, 'Amputation (Upper Limb) (Orthopaedic/Intermediate)', '0', '1'),
(116, 'Amputation of a Digit (Orthopaedic/Minor)', '0', '1'),
(117, 'Amputation of lower limb', '0', '1'),
(118, 'Anal Fistulectomy Repair ', '170000', '1'),
(119, 'Anal Spincteroplasty ', '170000', '1'),
(120, 'Appendicectomy', '170000', '1'),
(121, 'Biopsy (Orthopaedic/Minor)', '0', '1'),
(122, 'Biopsy of Tumor of Abdominal Wall', '50000', '1'),
(123, 'Breast Lump', '0', '1'),
(124, 'Bronchoscopy', '60000', '1'),
(125, 'Caudal block', '0', '1'),
(126, 'Circumcision (Adult)', '120000', '1'),
(127, 'Circumcision (Paediatric)', '15000', '1'),
(128, 'Colostomy', '0', '1'),
(129, 'Combined Epidural and Spinal Anaesthesia', '90000', '1'),
(130, 'Combined Spinal Epidural', '0', '1'),
(131, 'Culdocinthesis', '0', '1'),
(132, 'Cystic Hygroma Excision', '170000', '1'),
(133, 'Cystotomy', '200000', '1'),
(134, 'Dilwan-Evans Procedure (Orthopaedic/Major)', '0', '1'),
(135, 'Dissection of Fermoral Triangle', '170000', '1'),
(136, 'Drainage of Pleural effusion', '0', '1'),
(137, 'Endoscopy of GIT', '40000', '1'),
(138, 'Elective C/S (Booked)', '0', '1'),
(139, 'Emergency C/S (Booked)', '0', '1'),
(140, 'Emergency C/S (Unbooked)', '0', '1'),
(141, 'Emergency Evacuation', '0', '1'),
(142, 'Epidural (Catheter Technique)', '0', '1'),
(143, 'EpigastricHerniorrhappy', '170000', '1'),
(144, 'Excision of Breast lump', '70000', '1'),
(145, 'Excision of Ganglion', '0', '1'),
(146, 'Excision of Intrascrotal Mass', '170000', '1'),
(147, 'Exploratory Laparatomy', '0', '1'),
(148, 'External Fixation (Orthopaedic/Intermediate)', '0', '1'),
(149, 'Fistula In-Ano Repair ', '170000', '1'),
(150, 'Flexor Tendon Repair/Extension Tendon Repair', '0', '1'),
(151, 'Frenulectomy', '0', '1'),
(152, 'Ganglion', '0', '1'),
(153, 'General Anaesthesia', '50000', '1'),
(154, 'General Anaesthesia (ETT)', '0', '1'),
(155, 'General Anaesthesia (Face mask)', '0', '1'),
(156, 'General Anaesthesia + Oxygen', '70000', '1'),
(157, 'General Anaesthesia + Oxygen + Intubation', '90000', '1'),
(158, 'Haemorhoidectomy', '0', '1'),
(159, 'Hemiography (Bilateral)', '0', '1'),
(160, 'Hemiography (Inguinoscrotal - Bilateral)', '0', '1'),
(161, 'Hemiography (Inguinoscrotal - Unilateral)', '0', '1'),
(162, 'Hemiography (Obstructed)', '0', '1'),
(163, 'Hemiography (Single)', '0', '1'),
(164, 'Herniorraphy- Inguinal/Others', '170000', '1'),
(165, 'Hydrocellectomy (Bilateral)', '0', '1'),
(166, 'Hydrocoelectomy (Unilateral)', '0', '1'),
(167, 'Injection Sclerotherapy of Varicose Veins ', '15000', '1'),
(168, 'Laparotomy (Exploratory)', '0', '1'),
(169, 'Laparotomy (Resection and Anastomosis)', '0', '1'),
(170, 'Laparotomy for Pyoperitoneum', '0', '1'),
(171, 'Liver/Kidney/Bone Marrow Biopsy', '120000', '1'),
(172, 'Local Anaesthesia', '0', '1'),
(173, 'Lypomas Excision', '0', '1'),
(174, 'M.U.A./POP (Orthopaedic/Minor)', '0', '1'),
(175, 'Major Procedure Theatre fee', '0', '1'),
(176, 'Major Sugical Incision and Drainage', '70000', '1'),
(177, 'Minor Procedure Theatre fee', '0', '1'),
(178, 'Missed Abortion Evacuation', '20000', '1'),
(179, 'Multiple Ligation Veins ', '170000', '1'),
(180, 'Myomectromy (Multiple)', '0', '1'),
(181, 'Myomectromy (Single-node)', '0', '1'),
(182, 'Nerve Repair (Orthopaedic/Major)', '0', '1'),
(183, 'Oesophagoscopy ', '30000', '1'),
(184, 'Orchidectomy (Bilateral)', '0', '1'),
(185, 'Orchidectomy (Unilateral)', '0', '1'),
(186, 'Orchidectomy/Orchidopexy', '170000', '1'),
(187, 'ORIF (Orthopaedic/Major)', '0', '1'),
(188, 'Pericardiocentesis', '170000', '1'),
(189, 'Posteromedial Release - PMR (Orthopaedic/Major)', '0', '1'),
(190, 'Proctoscopy', '30000', '1'),
(191, 'Protatectomy', '0', '1'),
(192, 'Removal IUCD', '0', '1'),
(193, 'Removal of implant', '0', '1'),
(194, 'Salpingectomy (Ectopic)', '0', '1'),
(195, 'Secondary wound closure', '0', '1'),
(196, 'Septic Evacuation', '0', '1'),
(197, 'Sequestrectomy (Orthopaedic/Intermediate)', '0', '1'),
(198, 'Sigmoidoscopy', '30000', '1'),
(199, 'Single shot Epidural', '50000', '1'),
(200, 'Skin grafting', '0', '1'),
(201, 'Skin Grafting ', '170000', '1'),
(202, 'SkinTraction/Skeletal Traction (Orthopaedic/Minor)', '0', '1'),
(203, 'Spinal Anaesthesia', '40000', '1'),
(204, 'Subtotal Hysterectomy', '0', '1'),
(205, 'SuprapubicCystomy', '70000', '1'),
(206, 'Surgery of Torsion of Spermatic Cord', '170000', '1'),
(207, 'Synovectomy', '80000', '1'),
(208, 'Tenotomy (Orthopaedic/Minor)', '0', '1'),
(209, 'Therapeutic D&C', '0', '1'),
(210, 'Thyroidectomy', '0', '1'),
(211, 'Total Abdominal Hysterectomy', '0', '1'),
(212, 'Tracheostomy', '30000', '1'),
(213, 'Tubal Litigation (Elective Only)', '0', '1'),
(214, 'Wedging of POP (Orthopaedic/Minor)', '0', '1'),
(215, 'Wound dressing (major)', '3000', '1'),
(216, 'Wound dressing (minor)', '2000', '1'),
(217, 'Wound suturing', '30000', '1'),
(218, 'Chicken pox vaccine', '0', '1'),
(219, 'Hbv(adult) vaccine', '0', '1'),
(220, 'Hbv(children) vaccine', '0', '1'),
(221, 'Hepatitis b vac. Child dose(multi dose)', '0', '1'),
(222, 'Hepatitis b vaccine single vial dose', '0', '1'),
(223, 'Measles vaccine', '0', '1'),
(224, 'Meningitis vaccine', '0', '1'),
(225, 'Mmr vaccine', '0', '1'),
(226, 'Yellow fever card', '0', '1'),
(227, 'Yellow fever vaccine', '0', '1'),
(228, 'ANTERIOR NASAL PACKING', '5000', '1'),
(229, 'ANTRAL LAVAGE', '30000', '1'),
(230, 'AURAL ANTISEPTIC WICK DRESSING / DAY', '4000', '1'),
(231, 'AURAL SYRINGING: BOTH EARS ', '22000', '1'),
(232, 'AURAL SYRINGING: ONE EAR ', '15000', '1'),
(233, 'AURAL TOILETING / EAR', '4000', '1'),
(234, 'ELECTROCAUTERY OF THE NOSE', '15000', '1'),
(235, 'FOREIGN BODY REMOVAL FROM EAR', '15000', '1'),
(236, 'FOREIGN BODY REMOVAL FROM NOSE', '15000', '1'),
(237, 'FOREIGN BODY REMOVAL FROM THROAT', '25000', '1'),
(238, 'I & D OF QUINCY', '30000', '1'),
(239, 'INDIRECT LARYNGNOSCOPY', '10000', '1'),
(240, 'PERNASAL BIOPSY', '20000', '1'),
(241, 'POSTERIOR NASAL PACKING', '8000', '1'),
(242, 'RELEASE OF TONGUE TIE', '20000', '1'),
(243, 'PTA', '10000', '1'),
(244, 'SINGLE VISION LENSES (WHITE)', '6000', '1'),
(245, 'SINGLE VISION TRIAR', '6000', '1'),
(246, 'SINGLE VISION TR/AR', '6000', '1'),
(247, 'FUSED BIFOCAL', '8000', '1'),
(248, 'FUSED BIFOCAL TR/AR ', '8000', '1'),
(249, 'INVISIBLE BIFOCAL', '9000', '1'),
(250, 'VARILUX WHITE', '8000', '1'),
(251, 'VARILUX TRIAR', '10000', '1'),
(252, 'VARILUX SPECIAL ORDER WHITE', '11000', '1'),
(253, 'VARILUX SPECIAL ORDER TRIAR ', '23000', '1'),
(254, 'SPECIAL ORDER WHITE ', '5000', '1'),
(255, 'SPECIAL ORDER FUSED WHITE ', '6000', '1'),
(256, 'SPECIAL ORDER FUSED TRIAR', '16000', '1'),
(257, 'SPECIAL ORDER INVISIBLE TRIAR', '21000', '1'),
(258, 'Nursing Care', '2000', '1'),
(259, 'Professional Mediacal care', '3000', '1'),
(260, 'Consumables', '2000', '1');

-- --------------------------------------------------------

--
-- Table structure for table `ot_payment`
--

CREATE TABLE `ot_payment` (
  `id` int(11) NOT NULL,
  `patient` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `doctor_c_s` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `doctor_a_s_1` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `doctor_a_s_2` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `doctor_anaes` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `n_o_o` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `c_s_f` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `a_s_f_1` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `a_s_f_2` varchar(11) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `anaes_f` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `ot_charge` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `cab_rent` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `seat_rent` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `others` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `discount` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `date` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `amount` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `doctor_fees` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `hospital_fees` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `gross_total` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `flat_discount` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `amount_received` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `status` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `user` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `hospital_id` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `package`
--

CREATE TABLE `package` (
  `id` int(11) NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `price` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `p_limit` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `d_limit` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `module` varchar(1000) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `show_in_frontend` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `frontend_order` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `set_as_default` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `id` int(11) NOT NULL,
  `img_url` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `name` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `title` varchar(50) DEFAULT NULL,
  `email` varchar(1000) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `doctor` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `address` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `phone` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `sex` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `religion` varchar(100) DEFAULT NULL,
  `birthdate` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `age` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `kin` text DEFAULT NULL,
  `patient_type` varchar(500) DEFAULT NULL,
  `insurance_id` varchar(255) DEFAULT NULL,
  `policy_no` varchar(255) DEFAULT NULL,
  `occupation` text DEFAULT NULL,
  `marital_status` varchar(500) DEFAULT NULL,
  `id_no` varchar(500) DEFAULT NULL,
  `nationality` varchar(500) DEFAULT NULL,
  `birth_place` text DEFAULT NULL,
  `state_of_origin` varchar(500) DEFAULT NULL,
  `bloodgroup` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `ion_user_id` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `patient_id` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `add_date` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `registration_time` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `how_added` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `hospital_id` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `start_date` varchar(255) DEFAULT NULL,
  `end_date` varchar(255) DEFAULT NULL,
  `kin_phone` varchar(50) DEFAULT NULL,
  `kin_address` text DEFAULT NULL,
  `kin_email` varchar(500) DEFAULT NULL,
  `kin_relationship` varchar(100) DEFAULT NULL,
  `genotype` varchar(5) DEFAULT NULL,
  `mr_no` varchar(100) DEFAULT NULL,
  `insurance_plan` varchar(100) DEFAULT NULL,
  `insurance_group` varchar(100) DEFAULT NULL,
  `insurance_sponsor` varchar(100) DEFAULT NULL,
  `last_visit` varchar(100) DEFAULT NULL,
  `modified_by` varchar(100) DEFAULT NULL,
  `type` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`id`, `img_url`, `name`, `title`, `email`, `doctor`, `address`, `phone`, `sex`, `religion`, `birthdate`, `age`, `kin`, `patient_type`, `insurance_id`, `policy_no`, `occupation`, `marital_status`, `id_no`, `nationality`, `birth_place`, `state_of_origin`, `bloodgroup`, `ion_user_id`, `patient_id`, `add_date`, `registration_time`, `how_added`, `hospital_id`, `start_date`, `end_date`, `kin_phone`, `kin_address`, `kin_email`, `kin_relationship`, `genotype`, `mr_no`, `insurance_plan`, `insurance_group`, `insurance_sponsor`, `last_visit`, `modified_by`, `type`) VALUES
(1, '', 'Daniel Ipogah', 'Mr', 'daniel@demo.savealife.com', '155', '233ggkfltkt', '224334444', 'Male', 'Christian', '13-07-2023', NULL, 'None', 'Private Patient', NULL, '', 'UI Designer', 'Single', 'Service', NULL, '', NULL, 'A+', '782', '311993', '07/13/23', '1689252202', NULL, '4', '', '', '', '', '', '', 'Unkno', NULL, '', NULL, NULL, NULL, '774', 'general'),
(2, NULL, 'UCHE GOODNESS', NULL, 'techteam@xerdocs.com', ',157', '111111111', '111111111111', 'Male', NULL, '05-09-2023', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A+', '783', '361598', '09/05/23', '1693947401', NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(3, 'uploads/IMG1694875111.jpg', 'Adewale Adebayo', 'Mr', '', NULL, '25 CUSTOM ROAD', '09012536063', 'Male', 'CHRISTIAN', '16-09-2023', NULL, 'MIRACLE OKONKWO', 'HMO Insurance', '2', 'BHS10001536', 'STUDENT', 'Married', '123', NULL, '', NULL, 'A+', '784', '553290', '09/16/23', '1694875120', NULL, '1', '', '', '08029111409', '', '', 'SON', 'Unkno', NULL, '', NULL, '12', NULL, '2', 'general');

-- --------------------------------------------------------

--
-- Table structure for table `patient_deposit`
--

CREATE TABLE `patient_deposit` (
  `id` int(11) NOT NULL,
  `patient` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `payment_id` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `date` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `deposited_amount` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `amount_received_id` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `deposit_type` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `gateway` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `user` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `hospital_id` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `patient_deposit`
--

INSERT INTO `patient_deposit` (`id`, `patient`, `payment_id`, `date`, `deposited_amount`, `amount_received_id`, `deposit_type`, `gateway`, `user`, `hospital_id`) VALUES
(5, '2', '5', '1694593544', '3000', '5.gp', 'Cash', NULL, '2', '1');

-- --------------------------------------------------------

--
-- Table structure for table `patient_material`
--

CREATE TABLE `patient_material` (
  `id` int(11) NOT NULL,
  `date` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `title` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `category` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `patient` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `patient_name` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `patient_address` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `patient_phone` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `url` varchar(1000) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `date_string` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `hospital_id` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `category` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `patient` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `doctor` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `date` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `amount` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `vat` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '0',
  `x_ray` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `flat_vat` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `discount` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '0',
  `flat_discount` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `gross_total` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `remarks` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `hospital_amount` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `doctor_amount` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `category_amount` varchar(1000) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `category_name` varchar(1000) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `amount_received` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `deposit_type` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `status` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `user` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `patient_name` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `patient_phone` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `patient_address` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `doctor_name` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `date_string` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `hospital_id` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `category`, `patient`, `doctor`, `date`, `amount`, `vat`, `x_ray`, `flat_vat`, `discount`, `flat_discount`, `gross_total`, `remarks`, `hospital_amount`, `doctor_amount`, `category_amount`, `category_name`, `amount_received`, `deposit_type`, `status`, `user`, `patient_name`, `patient_phone`, `patient_address`, `doctor_name`, `date_string`, `hospital_id`) VALUES
(5, NULL, '2', NULL, '1694593544', '3500', '0', NULL, NULL, '500', '500', '3000', 'no test for this', '3000', '0', NULL, '2*2500*others*1,1*1000*others*1', '3000', 'Cash', 'unpaid', '2', 'UCHE GOODNESS', '111111111111', '111111111', '0', '13-09-23', '1');

-- --------------------------------------------------------

--
-- Table structure for table `paymentgateway`
--

CREATE TABLE `paymentgateway` (
  `id` int(11) NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `merchant_key` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `salt` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `x` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `y` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `APIUsername` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `APIPassword` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `APISignature` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `status` varchar(1000) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `publish` varchar(1000) NOT NULL,
  `secret` varchar(1000) NOT NULL,
  `hospital_id` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `public_key` varchar(1000) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `paymentgateway`
--

INSERT INTO `paymentgateway` (`id`, `name`, `merchant_key`, `salt`, `x`, `y`, `APIUsername`, `APIPassword`, `APISignature`, `status`, `publish`, `secret`, `hospital_id`, `public_key`) VALUES
(1, 'PayPal', NULL, NULL, NULL, NULL, 'PayPal API Username', 'PayPal API Password', 'PayPal API Signature', 'test', '', '', '1', ''),
(2, 'Pay U Money', 'Merchant key', 'Salt', NULL, NULL, NULL, NULL, NULL, 'test', '', '', '1', ''),
(3, 'Stripe', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Publish', 'Secret', '1', ''),
(4, 'Paystack', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'test', '', 'secret', '1', 'Public key');

-- --------------------------------------------------------

--
-- Table structure for table `payment_category`
--

CREATE TABLE `payment_category` (
  `id` int(11) NOT NULL,
  `category` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `description` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `c_price` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `type` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `d_commission` int(11) DEFAULT NULL,
  `h_commission` int(11) DEFAULT NULL,
  `operation_id` varchar(255) NOT NULL,
  `hospital_id` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `payment_category`
--

INSERT INTO `payment_category` (`id`, `category`, `description`, `c_price`, `type`, `d_commission`, `h_commission`, `operation_id`, `hospital_id`) VALUES
(1, 'Blood Glucose (Old)', '', '1000', 'others', 0, NULL, 'lab1', '1'),
(2, 'Absolute Reticulocyte Count - [Blood]', '', '2500', 'others', 0, NULL, 'lab2', '1'),
(3, 'Acid Phosphatase, Prostatic Fraction', '', '8000', 'others', 0, NULL, 'lab3', '1'),
(4, 'Acid Phosphatase, Total', '', '8000', 'others', 0, NULL, 'lab4', '1'),
(5, 'Acid Phosphatase, Total And Prostatic Fraction', '', '14000', 'others', 0, NULL, 'lab5', '1'),
(6, 'AFP-Alpha Feto Protein (Amniotic Fliud)', '', '12000', 'others', 0, NULL, 'lab6', '1'),
(7, 'AFP-Alpha Feto Protein (CSF)', '', '12000', 'others', 0, NULL, 'lab7', '1'),
(8, 'AFP-Alpha Feto Protein (Serum)', '', '12000', 'others', 0, NULL, 'lab8', '1'),
(9, 'AFP-Alpha Feto Protein (Tissule)', '', '12000', 'others', 0, NULL, 'lab9', '1'),
(10, 'Albumin - [Any Body Fluid]', '', '3500', 'others', 0, NULL, 'lab10', '1'),
(11, 'Albumin - [CSF]', '', '3500', 'others', 0, NULL, 'lab11', '1'),
(12, 'Albumin - [Serum/Plasma]', '', '3500', 'others', 0, NULL, 'lab12', '1'),
(13, 'Albumin - [Urine, 24 Hours]', '', '6000', 'others', 0, NULL, 'lab13', '1'),
(14, 'Albumin - [Urine, Spot]', '', '5000', 'others', 0, NULL, 'lab14', '1'),
(15, 'Albumin/Creatinine Ratio(ACR) - [24hr Urine]', '', '7000', 'others', 0, NULL, 'lab15', '1'),
(16, 'Albumin/Creatinine Ratio(ACR) - [Urine Spot)', '', '7000', 'others', 0, NULL, 'lab16', '1'),
(17, 'Alkaline Phosphatase - [Serum/Plasma]', '', '3500', 'others', 0, NULL, 'lab17', '1'),
(18, 'Amylase - [Any Body Fluid]', '', '9000', 'others', 0, NULL, 'lab18', '1'),
(19, 'Amylase - [Serum/Plasma]', '', '9000', 'others', 0, NULL, 'lab19', '1'),
(20, 'Anti D (Rh) Antibody Titre - [Serum]', '', '1000', 'others', 0, NULL, 'lab20', '1'),
(21, 'Anti Streptolysin O (ASO) (Qualitative)', '', '4500', 'others', 0, NULL, 'lab21', '1'),
(22, 'Anti Streptolysin O (ASO) (Quantitative)', '', '4500', 'others', 0, NULL, 'lab22', '1'),
(23, 'APTT- Activated Partial Thromboplastin - [Plasma]', '', '6000', 'others', 0, NULL, 'lab23', '1'),
(24, 'Ascitic Fluid, Routine Examination, (Glucose,Protein,SAAG,PH,SG,Cell Count)', '', '5000', 'others', 0, NULL, 'lab24', '1'),
(25, 'Beta HCG - [Any Body Fluid]', '', '12000', 'others', 0, NULL, 'lab25', '1'),
(26, 'Beta HCG - [Serum]', '', '12000', 'others', 0, NULL, 'lab26', '1'),
(27, 'Beta HCG - [Urine, 24hrs]', '', '10000', 'others', 0, NULL, 'lab27', '1'),
(28, 'Beta HCG - [Urine, Spot]', '', '10000', 'others', 0, NULL, 'lab28', '1'),
(29, 'Bilirubin (direct) - [Serum/Plasma]', '', '2500', 'others', 0, NULL, 'lab29', '1'),
(30, 'Bilirubin (total) - [Serum/Plasma]', '', '2500', 'others', 0, NULL, 'lab30', '1'),
(31, 'Bilirubin (Total, Direct, Indirect) - [Serum/Plasma]', '', '3500', 'others', 0, NULL, 'lab31', '1'),
(32, 'Blood Donor Screening', '', '6000', 'others', 0, NULL, 'lab32', '1'),
(33, 'Blood Products', '', '1', 'others', 0, NULL, 'lab33', '1'),
(34, 'Blood Sugar (FBS + 2HPP Glucose) - [Plasma]', '', '3500', 'others', 0, NULL, 'lab34', '1'),
(35, 'Fasting Blood Sugar- [Plasma]', '', '1500', 'others', 0, NULL, 'lab35', '1'),
(36, 'Blood Sugar Post Prandial - [Plasma]', '', '1500', 'others', 0, NULL, 'lab36', '1'),
(37, 'Random Blood Sugar - [Plasma]', '', '2000', 'others', 0, NULL, 'lab37', '1'),
(38, 'Calcium', '', '3500', 'others', 0, NULL, 'lab38', '1'),
(39, 'Calcium - [Urine, 24 Hours]', '', '4500', 'others', 0, NULL, 'lab39', '1'),
(40, 'Full Blood Count', '', '3500', 'others', 0, NULL, 'lab40', '1'),
(41, 'CEA-Carcino Embryonic Antigen', '', '12000', 'others', 0, NULL, 'lab41', '1'),
(42, 'Cholesterol (Total)', '', '3000', 'others', 0, NULL, 'lab42', '1'),
(43, 'Cholesterol-HDL , Direct', '', '3000', 'others', 0, NULL, 'lab43', '1'),
(44, 'Cholesterol-LDL, Direct', '', '1', 'others', 0, NULL, 'lab44', '1'),
(45, 'Clotting And Bleeding Time', '', '3500', 'others', 0, NULL, 'lab45', '1'),
(46, 'Cortisol', '', '18000', 'others', 0, NULL, 'lab46', '1'),
(47, 'Cortisol - [Urine, 24 Hours]', '', '18000', 'others', 0, NULL, 'lab47', '1'),
(48, 'CORTISOL, FREE, 24-HOUR URINE', '', '9000', 'others', 0, NULL, 'lab48', '1'),
(49, 'CORTISOL, MORNING & EVENING, SERUM', '', '30000', 'others', 0, NULL, 'lab49', '1'),
(50, 'CORTISOL, SERUM (EVENING SAMPLE)', '', '18000', 'others', 0, NULL, 'lab50', '1'),
(51, 'CORTISOL, SERUM (MORNING SAMPLE)', '', '18000', 'others', 0, NULL, 'lab51', '1'),
(52, 'C-PEPTIDE, 24-HOUR URINE', '', '9000', 'others', 0, NULL, 'lab52', '1'),
(53, 'C-PEPTIDE, FASTING', '', '9500', 'others', 0, NULL, 'lab53', '1'),
(54, 'C-PEPTIDE, POST PRANDIAL', '', '9000', 'others', 0, NULL, 'lab54', '1'),
(55, 'C-Reactive Protein(CRP)', '', '9000', 'others', 0, NULL, 'lab55', '1'),
(56, 'Creatine Kinase MB Fraction(CK-MB )', '', '9000', 'others', 0, NULL, 'lab56', '1'),
(57, 'Creatinine', '', '5000', 'others', 0, NULL, 'lab57', '1'),
(58, 'Creatinine - [ Urine, 24 Hrs]', '', '5000', 'others', 0, NULL, 'lab58', '1'),
(59, 'Creatinine - [Spot Urine]', '', '3500', 'others', 0, NULL, 'lab59', '1'),
(60, 'Creatinine Clearance Test', '', '7500', 'others', 0, NULL, 'lab60', '1'),
(61, 'Creatinine Phospho-Kinase (CPK)', '', '9000', 'others', 0, NULL, 'lab61', '1'),
(62, 'CSF, Routine examination, (Glucose,Protein,SG,PH,Cell count)', '', '6000', 'others', 0, NULL, 'lab62', '1'),
(63, 'D-Dimer Quantification', '', '15000', 'others', 0, NULL, 'lab63', '1'),
(64, 'Direct Antiglobulin Test (Direct Coombs) - [Blood]', '', '3000', 'others', 0, NULL, 'lab64', '1'),
(65, 'Drug Abuse', '', '12000', 'others', 0, NULL, 'lab65', '1'),
(66, 'Electrolytes (Sodium, Potassium, Chloride, Bicarbonates) [Serum]', '', '4500', 'others', 0, NULL, 'lab66', '1'),
(67, 'Electrolytes (Sodium, Potassium, Chloride, Bicarbonates) [Urine, 24 Hours]', '', '4500', 'others', 0, NULL, 'lab67', '1'),
(68, 'Electrolytes (Sodium, Potassium, Chloride, Bicarbonates) [Urine, Spot]', '', '4500', 'others', 0, NULL, 'lab68', '1'),
(69, 'Erythrocyte Sedimentation Rate (ESR)', '', '1500', 'others', 0, NULL, 'lab69', '1'),
(70, 'Ferritin', '', '8000', 'others', 0, NULL, 'lab70', '1'),
(71, 'Fibrinogen', '', '7000', 'others', 0, NULL, 'lab71', '1'),
(72, 'Folic Acid , RBC', '', '8000', 'others', 0, NULL, 'lab72', '1'),
(73, 'Folic Acid, Serum', '', '12000', 'others', 0, NULL, 'lab73', '1'),
(74, 'Gamma Glutamyl Transferase (GGT)', '', '4500', 'others', 0, NULL, 'lab74', '1'),
(75, 'Glomerular Filtration Rate(GFR)', '', '2500', 'others', 0, NULL, 'lab75', '1'),
(76, 'Glucose', '', '1500', 'others', 0, NULL, 'lab76', '1'),
(77, 'GTC-Glucose Tolerance Curve (5 Samples) - [Plasma, Urine]', '', '8000', 'others', 0, NULL, 'lab77', '1'),
(78, 'GTC-Glucose Tolerance Curve Gestation (4 Samples)', '', '6000', 'others', 0, NULL, 'lab78', '1'),
(79, 'Haemoglobin', '', '1500', 'others', 0, NULL, 'lab79', '1'),
(80, 'Hb Genotype', '', '3000', 'others', 0, NULL, 'lab80', '1'),
(81, 'Hb Genotype (Hemoglobin Variant)', '', '2500', 'others', 0, NULL, 'lab81', '1'),
(82, 'HbA1c Glycated Haemoglobin', '', '9000', 'others', 0, NULL, 'lab82', '1'),
(83, 'Hepatitis B Envelope Antigen -HBeAg', '', '6000', 'others', 0, NULL, 'lab83', '1'),
(84, 'HIV 1 & 2 ANTIBODIES, SCREENING TEST WITH P24 (QUANTITATIVE)', '', '7500', 'others', 0, NULL, 'lab84', '1'),
(85, 'HIV 1 & 2 Screening', '', '2000', 'others', 0, NULL, 'lab85', '1'),
(86, 'HIV-DUO Antigen & Antibody Screen(Quantitative) - [Serum]', '', '7500', 'others', 0, NULL, 'lab86', '1'),
(87, 'Indirect Antiglobulin Test (Indirect Coombs)', '', '3000', 'others', 0, NULL, 'lab87', '1'),
(88, 'Insulin Random', '', '9500', 'others', 0, NULL, 'lab88', '1'),
(89, 'Insulin, Fasting', '', '9500', 'others', 0, NULL, 'lab89', '1'),
(90, 'Insulin, Post Prandial', '', '9500', 'others', 0, NULL, 'lab90', '1'),
(91, 'Iron - [Serum]', '', '8950', 'others', 0, NULL, 'lab91', '1'),
(92, 'Iron - [Urine, 24 Hours]', '', '8950', 'others', 0, NULL, 'lab92', '1'),
(93, 'Iron Binding Capacity (TIBC) - [Serum]', '', '7000', 'others', 0, NULL, 'lab93', '1'),
(94, 'Iron Studies (Iron, TIBC, Transferrin Saturation)', '', '25000', 'others', 0, NULL, 'lab94', '1'),
(95, 'LDH-Lactate Dehydrogenas]- [Any Body Fluid]', '', '7000', 'others', 0, NULL, 'lab95', '1'),
(96, 'LDH-Lactate Dehydrogenase - [Serum]', '', '7000', 'others', 0, NULL, 'lab96', '1'),
(97, 'LDL Cholesterol -Direct - [Serum]', '', '1', 'others', 0, NULL, 'lab97', '1'),
(98, 'Lipase - [Serum]', '', '9000', 'others', 0, NULL, 'lab98', '1'),
(99, 'Lipid Profile (Total Cholesterol, HDL,LDL,VLDL & Triglycerides) - [Serum]', '', '11000', 'others', 0, NULL, 'lab99', '1'),
(100, 'Liver Function Tests (Bilirubin - total, direct & indirect, ALT, AST, Serum proteins)', '', '8500', 'others', 0, NULL, 'lab100', '1'),
(101, 'Magnesium - [Serum]', '', '5500', 'others', 0, NULL, 'lab101', '1'),
(102, 'Magnesium - [Urine, 24 Hours]', '', '5500', 'others', 0, NULL, 'lab102', '1'),
(103, 'Magnesium - [Urine, Spot]', '', '5500', 'others', 0, NULL, 'lab103', '1'),
(104, 'Malaria Parasite (MP)', '', '2500', 'others', 0, NULL, 'lab104', '1'),
(105, 'Microalbumin - [Urine, Spot]', '', '9000', 'others', 0, NULL, 'lab105', '1'),
(106, 'Microalbumin-[Urine, 24 Hours]', '', '9000', 'others', 0, NULL, 'lab106', '1'),
(107, 'Occult Blood - [Stool]', '', '4500', 'others', 0, NULL, 'lab107', '1'),
(108, 'Packed Cell Volume (PCV)', '', '1500', 'others', 0, NULL, 'lab108', '1'),
(109, 'Peripheral Smear Examination By Haematologist', '', '5000', 'others', 0, NULL, 'lab109', '1'),
(110, 'PH - [Any Body Fluid, Specify]', '', '1200', 'others', 0, NULL, 'lab110', '1'),
(111, 'Phosphorus - [Serum]', '', '7000', 'others', 0, NULL, 'lab111', '1'),
(112, 'Phosphorus - [urine, 24 Hrs]', '', '5000', 'others', 0, NULL, 'lab112', '1'),
(113, 'Phosphorus - [Urine, Spot]', '', '2800', 'others', 0, NULL, 'lab113', '1'),
(114, 'Pint Of Blood +ve', '', '15000', 'others', 0, NULL, 'lab114', '1'),
(115, 'Pint Of Blood -ve', '', '20000', 'others', 0, NULL, 'lab115', '1'),
(116, 'Platelet (Thrombocyte) Count - [Blood]', '', '3500', 'others', 0, NULL, 'lab116', '1'),
(117, 'Pleural Fluid, Routine Examination, (Glucose,Protein,LDH,PH,SG,Cell Count)', '', '5000', 'others', 0, NULL, 'lab117', '1'),
(118, 'Pregnancy Test - [serum]', '', '2500', 'others', 0, NULL, 'lab118', '1'),
(119, 'Pregnancy Test - [Urine]', '', '2500', 'others', 0, NULL, 'lab119', '1'),
(120, 'Proteins - [Any Body Fluid, Specify]', '', '3500', 'others', 0, NULL, 'lab120', '1'),
(121, 'Proteins - [Serum/Plasma]', '', '3500', 'others', 0, NULL, 'lab121', '1'),
(122, 'Proteins - [Urine, 24 Hours]', '', '5000', 'others', 0, NULL, 'lab122', '1'),
(123, 'PTTK-Partial Thromboplastin Time - [Plasma]', '', '7000', 'others', 0, NULL, 'lab123', '1'),
(124, 'PTT-Partial Thromboplastin Time - [Plasma]', '', '7000', 'others', 0, NULL, 'lab124', '1'),
(125, 'Renal Function Tests (Electrolytes, Bicarbonate, Urea & Creatinine)', '', '7000', 'others', 0, NULL, 'lab125', '1'),
(126, 'Reticulocyte Count, Automated - [Blood ]', '', '4500', 'others', 0, NULL, 'lab126', '1'),
(127, 'Rh (Anti D) Antibody Titre - [Serum]', '', '1500', 'others', 0, NULL, 'lab127', '1'),
(128, 'Rheumatoid Factor (RF)', '', '4500', 'others', 0, NULL, 'lab128', '1'),
(129, 'Seminal Fluid Analysis (SFA) RE- [Semen]', '', '6000', 'others', 0, NULL, 'lab129', '1'),
(130, 'SGOT (AST) - [Serum]', '', '2500', 'others', 0, NULL, 'lab130', '1'),
(131, 'SGPT (ALT) - [Serum]', '', '2500', 'others', 0, NULL, 'lab131', '1'),
(132, 'Sickling Test - [Blood]', '', '1500', 'others', 0, NULL, 'lab132', '1'),
(133, 'Stool RE', '', '2000', 'others', 0, NULL, 'lab133', '1'),
(134, 'Stool, Hanging Drop Preparation - [Stool]', '', '2100', 'others', 0, NULL, 'lab134', '1'),
(135, 'Stool, Occult Blood - [Stool]', '', '4500', 'others', 0, NULL, 'lab135', '1'),
(136, 'Stool, Reducing Substances And PH - [Stool]', '', '2500', 'others', 0, NULL, 'lab136', '1'),
(137, 'Sugar, Urine - [Urine, Spot]', '', '1500', 'others', 0, NULL, 'lab137', '1'),
(138, 'TIBC (Direct) - [Serum]', '', '8000', 'others', 0, NULL, 'lab138', '1'),
(139, 'Triglycerides - [Body Fluid]', '', '2500', 'others', 0, NULL, 'lab139', '1'),
(140, 'Triglycerides - [Serum]', '', '2500', 'others', 0, NULL, 'lab140', '1'),
(141, 'Triglycerides - [Urine, Spot] (0.1-1.69)mmol/L', '', '5000', 'others', 0, NULL, 'lab141', '1'),
(142, 'TT -Thrombin Time , Plasma - [Plasma]', '', '9000', 'others', 0, NULL, 'lab142', '1'),
(143, 'Urea', '', '2500', 'others', 0, NULL, 'lab143', '1'),
(144, 'Urea -', '', '2500', 'others', 0, NULL, 'lab144', '1'),
(145, 'Urea - [Urine, 24hrs]', '', '5000', 'others', 0, NULL, 'lab145', '1'),
(146, 'Urea Clearance Test - [Serum And Urine]', '', '3500', 'others', 0, NULL, 'lab146', '1'),
(147, 'Uric Acid', '', '4500', 'others', 0, NULL, 'lab147', '1'),
(148, 'Uric Acid - [Urine,24Hrs]', '', '4500', 'others', 0, NULL, 'lab148', '1'),
(149, 'Uric Acid (Urine Spot)', '', '5000', 'others', 0, NULL, 'lab149', '1'),
(150, 'Urinalysis', '', '1500', 'others', 0, NULL, 'lab150', '1'),
(151, 'Urine Reducing Substances, (paediatric) - [Urine, Spot]', '', '3500', 'others', 0, NULL, 'lab151', '1'),
(152, 'Urine Routine Examination', '', '1500', 'others', 0, NULL, 'lab152', '1'),
(153, 'Vitamin B-12', '', '35000', 'others', 0, NULL, 'lab153', '1'),
(154, 'Widal test', '', '5000', 'others', 0, NULL, 'lab154', '1'),
(155, 'Ear Swab M/cls', '', '3500', 'others', 0, NULL, 'lab155', '1'),
(156, 'PTA', '', '0', 'others', 0, NULL, 'lab156', '1'),
(157, 'Tympanometry', '', '0', 'others', 0, NULL, 'lab157', '1'),
(158, 'Throat Swab M/cls', '', '3500', 'others', 0, NULL, 'lab158', '1'),
(159, 'Clotting Profile', '', '0', 'others', 0, NULL, 'lab159', '1'),
(160, 'AFB, Smear Examination By ZN Stain - [Any Specimen ]', '', '5000', 'others', 0, NULL, 'lab160', '1'),
(161, 'AFB, smear examination by ZN stain (2 samples)', '', '7000', 'others', 0, NULL, 'lab161', '1'),
(162, 'AFB, Smear Examination By ZN Stain (3 Samples)', '', '10000', 'others', 0, NULL, 'lab162', '1'),
(163, 'AFB, Smear Examination By ZN Stain (5 Samples)', '', '12000', 'others', 0, NULL, 'lab163', '1'),
(164, 'Anti HAV-IgG Antibody To Hepatitis A Virus', '', '4500', 'others', 0, NULL, 'lab164', '1'),
(165, 'Anti HAV-IgM Antibody To Hepatitis A Virus', '', '4500', 'others', 0, NULL, 'lab165', '1'),
(166, 'Anti HBcAg-IgM Antibodies To Hepatitis B Core Ag', '', '4500', 'others', 0, NULL, 'lab166', '1'),
(167, 'Anti HBeAg-Antibodies To Hepatitis B Envelope Antigen', '', '4500', 'others', 0, NULL, 'lab167', '1'),
(168, 'Anti HBs-Total Antibodies To Hepatitis B Surface Antigen', '', '4500', 'others', 0, NULL, 'lab168', '1'),
(169, 'Anti HCV- Abs To Hepatitis C Virus', '', '4500', 'others', 0, NULL, 'lab169', '1'),
(170, 'CA-125 (Cancer Antigen-125)', '', '12000', 'others', 0, NULL, 'lab170', '1'),
(171, 'CA-15.3 (Cancer Antigen 15.3)', '', '12000', 'others', 0, NULL, 'lab171', '1'),
(172, 'CA-19.9 (Cancer Antigen 19.9)', '', '12000', 'others', 0, NULL, 'lab172', '1'),
(173, 'Cell Count', '', '2500', 'others', 0, NULL, 'lab173', '1'),
(174, 'Cytology - [Body Fluid]', '', '10000', 'others', 0, NULL, 'lab174', '1'),
(175, 'CYTOMEGALOVIRUS (CMV) ANTIBODIES PANEL, IgG & IgM', '', '25000', 'others', 0, NULL, 'lab175', '1'),
(176, 'Cytomegalovirus (CMV) Antibody, IgG', '', '17000', 'others', 0, NULL, 'lab176', '1'),
(177, 'Cytomegalovirus (CMV) Antibody, IgM', '', '17000', 'others', 0, NULL, 'lab177', '1'),
(178, 'DHEAS-DihydroepiAndrostenedione Sulphate', '', '39000', 'others', 0, NULL, 'lab178', '1'),
(179, 'DNA - Father And Child', '', '180000', 'others', 0, NULL, 'lab179', '1'),
(180, 'DNA - Father, Mother And Child', '', '270000', 'others', 0, NULL, 'lab180', '1'),
(181, 'DNA - Mother And Child', '', '180000', 'others', 0, NULL, 'lab181', '1'),
(182, 'Estradiol (E3), (Advised After 14 Weeks Of Gestation) - [Urine, 24 Hours]', '', '8000', 'others', 0, NULL, 'lab182', '1'),
(183, 'Estradiol (E3), (Advised After 14 Weeks Of Gestation) - Postmenopausal Women', '', '12000', 'others', 0, NULL, 'lab183', '1'),
(184, 'Estradiol/Oestrogen', '', '8000', 'others', 0, NULL, 'lab184', '1'),
(185, 'Female Hormonal Profile: FSH+ LH + Prolactin+ Progesterone-(Mini)', '', '27500', 'others', 0, NULL, 'lab185', '1'),
(186, 'Female Hormonal Profile: FSH+LH+ Prolactin+ Progesterone/Testosterone + Estradiol-(Maxi)', '', '27000', 'others', 0, NULL, 'lab186', '1'),
(187, 'FNAC - Cytological Examination', '', '5000', 'others', 0, NULL, 'lab187', '1'),
(188, 'FNAC -Cytology Examination And Procedure - [Walk In Patient]', '', '12000', 'others', 0, NULL, 'lab188', '1'),
(189, 'Free PSA (Prostate Specific Antigen-Free Molecule)', '', '10000', 'others', 0, NULL, 'lab189', '1'),
(190, 'Free T3 (Free Tcri-iodothyronine)', '', '5000', 'others', 0, NULL, 'lab190', '1'),
(191, 'Free T3 + Free T4', '', '10000', 'others', 0, NULL, 'lab191', '1'),
(192, 'Free T4 (Free Thyroxine)', '', '5000', 'others', 0, NULL, 'lab192', '1'),
(193, 'FSH - Follicle Stimulating Hormone', '', '5500', 'others', 0, NULL, 'lab193', '1'),
(194, 'FSH+ LH +Testosterone', '', '15000', 'others', 0, NULL, 'lab194', '1'),
(195, 'FSH+ LH+ Prolactin+ Testosterone', '', '20000', 'others', 0, NULL, 'lab195', '1'),
(196, 'FSH-LH-Prolactin', '', '15000', 'others', 0, NULL, 'lab196', '1'),
(197, 'Gene Expert', '', '0', 'others', 0, NULL, 'lab197', '1'),
(198, 'Gram`s Staining', '', '1000', 'others', 0, NULL, 'lab198', '1'),
(199, 'HBsAg (Confirmation/Quantification)', '', '9500', 'others', 0, NULL, 'lab199', '1'),
(200, 'HBsAg Screening - [Serum]', '', '5000', 'others', 0, NULL, 'lab200', '1'),
(201, 'HCV Screening', '', '4500', 'others', 0, NULL, 'lab201', '1'),
(202, 'Helicobacter Pylori (Rapid Test)', '', '4500', 'others', 0, NULL, 'lab202', '1'),
(203, 'Helicobacter Pylori -[Stool Ag]', '', '6000', 'others', 0, NULL, 'lab203', '1'),
(204, 'HEPATITIS A PANEL, (Anti-HAV, IgG+ Anti- HAV IgM)', '', '25000', 'others', 0, NULL, 'lab204', '1'),
(205, 'HEPATITIS B CHRONIC PANEL*HBsAg * HBeAg * Anti-HBe', '', '15000', 'others', 0, NULL, 'lab205', '1'),
(206, 'HEPATITIS B PROFILE*HBsAg *Anti-HBs *HBeAg *Anti-HBe *Anti-HBc IgM *Anti-HBc Total', '', '15000', 'others', 0, NULL, 'lab206', '1'),
(207, 'Histology - Large & Complex Sample', '', '15000', 'others', 0, NULL, 'lab207', '1'),
(208, 'Histology - Large Sample', '', '15000', 'others', 0, NULL, 'lab208', '1'),
(209, 'Histology - Medium Sample', '', '12000', 'others', 0, NULL, 'lab209', '1'),
(210, 'Histology - Second Opinion', '', '10000', 'others', 0, NULL, 'lab210', '1'),
(211, 'Histology - Small Sample', '', '10000', 'others', 0, NULL, 'lab211', '1'),
(212, 'Histology - Tissue Block Retrieval For IHC', '', '7000', 'others', 0, NULL, 'lab212', '1'),
(213, 'KOH Mount', '', '2500', 'others', 0, NULL, 'lab213', '1'),
(214, 'LH-Luteinizing Hormone - [Serum]', '', '5500', 'others', 0, NULL, 'lab214', '1'),
(215, 'LH-Luteinizing Hormone - [Tissue]', '', '12000', 'others', 0, NULL, 'lab215', '1'),
(216, 'Male Hormonal Profile: FSH-LH-Prolactin-Testosterone - [Serum]', '', '20000', 'others', 0, NULL, 'lab216', '1'),
(217, 'Ear Swab M/C/S', '', '3500', 'others', 0, NULL, 'lab217', '1'),
(218, 'Fluid Swab M/C/S', '', '3500', 'others', 0, NULL, 'lab218', '1'),
(219, 'Wound Swab', '', '3500', 'others', 0, NULL, 'lab219', '1'),
(220, 'Ascitic Fluid M/C/S', '', '3500', 'others', 0, NULL, 'lab220', '1'),
(221, 'Aspirate M/C/S', '', '3500', 'others', 0, NULL, 'lab221', '1'),
(222, 'Blood Culture/Sensitivity', '', '8000', 'others', 0, NULL, 'lab222', '1'),
(223, 'CSF M/C/S', '', '3500', 'others', 0, NULL, 'lab223', '1'),
(224, 'Endocervical Swab M/C/S', '', '3500', 'others', 0, NULL, 'lab224', '1'),
(225, 'High Vaginal Swab M/C/S', '', '3500', 'others', 0, NULL, 'lab225', '1'),
(226, 'Pleural Fluid M/C/S', '', '3500', 'others', 0, NULL, 'lab226', '1'),
(227, 'Semen M/C/S', '', '3500', 'others', 0, NULL, 'lab227', '1'),
(228, 'Sputum M/C/S', '', '3500', 'others', 0, NULL, 'lab228', '1'),
(229, 'Stool M/C/S', '', '3500', 'others', 0, NULL, 'lab229', '1'),
(230, 'Swab M/C/S', '', '3500', 'others', 0, NULL, 'lab230', '1'),
(231, 'Urethral Swab M/C/S', '', '3500', 'others', 0, NULL, 'lab231', '1'),
(232, 'Urine M/C/S', '', '3500', 'others', 0, NULL, 'lab232', '1'),
(233, 'Pap Smear (Liquid Based Cytology)', '', '12000', 'others', 0, NULL, 'lab233', '1'),
(234, 'Pap Smear For Cytology Examination With Procedure/consultation', '', '10000', 'others', 0, NULL, 'lab234', '1'),
(235, 'Pap Smear Liquid Based Cytology Procedure ?Walk In', '', '15000', 'others', 0, NULL, 'lab235', '1'),
(236, 'PAP Smears For Cytological Examination Only', '', '10000', 'others', 0, NULL, 'lab236', '1'),
(237, 'Progesterone - [serum]', '', '4500', 'others', 0, NULL, 'lab237', '1'),
(238, 'Prolactin - [serum]', '', '4500', 'others', 0, NULL, 'lab238', '1'),
(239, 'Prostate Specific Antigen-Free (Free PSA) - [Serum]', '', '10000', 'others', 0, NULL, 'lab239', '1'),
(240, 'Prostate Specific Antigen- TOTAL (PSA)', '', '10000', 'others', 0, NULL, 'lab240', '1'),
(241, 'Rubella (German Measles) -IgM Antibodies - [CSF]', '', '11200', 'others', 0, NULL, 'lab241', '1'),
(242, 'Rubella (German Measles) -IgM Antibodies - [Serum]', '', '11200', 'others', 0, NULL, 'lab242', '1'),
(243, 'Rubella (German Measles)-IgG Antibodies - [CSF]', '', '11200', 'others', 0, NULL, 'lab243', '1'),
(244, 'Rubella (German Measles)-IgG Antibodies - [Serum]', '', '15000', 'others', 0, NULL, 'lab244', '1'),
(245, 'Seminal Fluid Analysis (SFA) + Semen Culture', '', '12000', 'others', 0, NULL, 'lab245', '1'),
(246, 'Smear Examination', '', '1500', 'others', 0, NULL, 'lab246', '1'),
(247, 'Synovial Fluid Routine Examination (Glucose,Protein,SAAG,PH,SG,Cell Count)', '', '4500', 'others', 0, NULL, 'lab247', '1'),
(248, 'T3,Free (Free Tri-iodothyronine) - [Serum]', '', '5000', 'others', 0, NULL, 'lab248', '1'),
(249, 'T3,Total (Tri Iodothyronine) - [Serum]', '', '5000', 'others', 0, NULL, 'lab249', '1'),
(250, 'T4,Free (Free Thyroxine) - [Serum]', '', '5000', 'others', 0, NULL, 'lab250', '1'),
(251, 'T4,Total (Thyroxine) - [Serum]', '', '5000', 'others', 0, NULL, 'lab251', '1'),
(252, 'T4,Total (Thyroxine), Neonatal Screen - [Blood]', '', '5000', 'others', 0, NULL, 'lab252', '1'),
(253, 'TACROLIMUS TEST', '', '40000', 'others', 0, NULL, 'lab253', '1'),
(254, 'TB Gold (Quantiferon) (Gamma Interferon For TB)', '', '25000', 'others', 0, NULL, 'lab254', '1'),
(255, 'Testosterone Free - [Serum]', '', '15000', 'others', 0, NULL, 'lab255', '1'),
(256, 'Testosterone Total- [Serum]', '', '8000', 'others', 0, NULL, 'lab256', '1'),
(257, 'THYROID PROFILE, FREE*Free T3 *Free T4 *TSH - [Serum]', '', '15000', 'others', 0, NULL, 'lab257', '1'),
(258, 'THYROID PROFILE, TOTAL*T3 Total *T4 Total *TSH - [Serum]', '', '15000', 'others', 0, NULL, 'lab258', '1'),
(259, 'Thyroid Stimulating Hormone (TSH) - [Serum]', '', '5000', 'others', 0, NULL, 'lab259', '1'),
(260, 'Thyroxine, Free (Free T4) - [Serum]', '', '5000', 'others', 0, NULL, 'lab260', '1'),
(261, 'Thyroxine, Total (Total T4) - [Serum]', '', '5000', 'others', 0, NULL, 'lab261', '1'),
(262, 'Toxoplasma-IgM Antibodies - [CSF]', '', '12000', 'others', 0, NULL, 'lab262', '1'),
(263, 'Toxoplasma-IgM Antibodies - [Serum]', '', '12000', 'others', 0, NULL, 'lab263', '1'),
(264, 'Tri Iodothyronine, Free (Free T3) - [Serum]', '', '5000', 'others', 0, NULL, 'lab264', '1'),
(265, 'Tri Iodothyronine, Total (Total T3) - [Serum]', '', '5000', 'others', 0, NULL, 'lab265', '1'),
(266, 'Troponin-I', '', '12000', 'others', 0, NULL, 'lab266', '1'),
(267, 'T-spot TB', '', '1500', 'others', 0, NULL, 'lab267', '1'),
(268, 'Tuberculin Skin Test (Mantoux Test)', '', '3500', 'others', 0, NULL, 'lab268', '1'),
(269, 'Tuberculosis Serology -IgA Antibodies', '', '4000', 'others', 0, NULL, 'lab269', '1'),
(270, 'Tuberculosis Serology -IgG Antibodies', '', '4000', 'others', 0, NULL, 'lab270', '1'),
(271, 'Tuberculosis Serology -IgM Antibodies', '', '4000', 'others', 0, NULL, 'lab271', '1'),
(272, 'Unconjugated Estriol (E3) - [Urine, 24 Hours]', '', '12000', 'others', 0, NULL, 'lab272', '1'),
(273, 'Unconjugated Estriol (E3) (Advised After 14 Weeks Of Gestation) - [Serum]', '', '12000', 'others', 0, NULL, 'lab273', '1'),
(274, 'VDRL (RPR)', '', '2500', 'others', 0, NULL, 'lab274', '1'),
(275, 'Vitamin D3 (25 Hydroxy Cholecalciferol)', '', '33000', 'others', 0, NULL, 'lab275', '1'),
(276, 'OGTT', '', '5000', 'others', 0, NULL, 'lab276', '1'),
(277, '2HPP Blood Sugar', '', '3500', 'others', 0, NULL, 'lab277', '1'),
(278, 'Blood Transfusion', '', '15000', 'others', 0, NULL, 'lab278', '1'),
(279, 'ABO Blood Grouping', '', '2000', 'others', 0, NULL, 'lab279', '1'),
(280, 'Serum Prolactin', '', '5000', 'others', 0, NULL, 'lab280', '1'),
(281, 'Pre Art Investigation - Male', '', '100000', 'others', 0, NULL, 'lab281', '1'),
(282, 'Pre Art Investigation 1 - Female', '', '100000', 'others', 0, NULL, 'lab282', '1'),
(283, 'Pre Art Investigation 2 - Female', '', '100000', 'others', 0, NULL, 'lab283', '1'),
(284, 'HEPATITIS C', '', '15000', 'others', 0, NULL, 'lab284', '1'),
(287, 'GENERAL PRACTITION (Follow Up)', '', '1000', 'others', 0, NULL, '', '1'),
(286, 'GENERAL PRACTITION (First Visit)', '', '1500', 'others', 0, NULL, '', '1'),
(288, 'SARAH FERTILITY CLINIC (Follow Up)', '', '', 'others', 0, NULL, '', '1'),
(289, 'SARAH FERTILITY CLINIC (First Visit)', '', '30000', 'others', 0, NULL, '', '1'),
(290, 'Skull (AP & LAT)', '', '8000', 'others', 0, NULL, 'radio1', '1'),
(291, 'Skull (SINGLE VIEW)', '', '6000', 'others', 0, NULL, 'radio2', '1'),
(292, 'AP/Lateral', '', '8000', 'others', 0, NULL, 'radio3', '1'),
(293, 'Mastoids', '', '8000', 'others', 0, NULL, 'radio4', '1'),
(294, 'Sinuses', '', '8000', 'others', 0, NULL, 'radio5', '1'),
(295, 'Mandibles (Jaw)', '', '8000', 'others', 0, NULL, 'radio6', '1'),
(296, 'Temperomandibular Joint (TMJ)', '', '8000', 'others', 0, NULL, 'radio7', '1'),
(297, 'Thorax', '', '8000', 'others', 0, NULL, 'radio8', '1'),
(298, 'Chest (AP)', '', '8000', 'others', 0, NULL, 'radio9', '1'),
(299, 'Chest (AP/Lateral)', '', '8000', 'others', 0, NULL, 'radio10', '1'),
(300, 'Chest  (Oblique)', '', '8000', 'others', 0, NULL, 'radio11', '1'),
(301, 'Chest (Apical View)', '', '8000', 'others', 0, NULL, 'radio12', '1'),
(302, 'Sternum', '', '8000', 'others', 0, NULL, 'radio13', '1'),
(303, 'Thoracic Inlet', '', '8000', 'others', 0, NULL, 'radio14', '1'),
(304, 'Limbs', '', '8000', 'others', 0, NULL, 'radio15', '1'),
(305, 'Ankle', '', '8000', 'others', 0, NULL, 'radio16', '1'),
(306, 'Clavicle', '', '8000', 'others', 0, NULL, 'radio17', '1'),
(307, 'Elbow', '', '8000', 'others', 0, NULL, 'radio18', '1'),
(308, 'Foot/Toe', '', '8000', 'others', 0, NULL, 'radio19', '1'),
(309, 'Foot/Toe', '', '8000', 'others', 0, NULL, 'radio20', '1'),
(310, 'Forearm (Radius And Ulna)', '', '8000', 'others', 0, NULL, 'radio21', '1'),
(311, 'Hand/Finger', '', '8000', 'others', 0, NULL, 'radio22', '1'),
(312, 'Hip', '', '8000', 'others', 0, NULL, 'radio23', '1'),
(313, 'Humerus', '', '8000', 'others', 0, NULL, 'radio24', '1'),
(314, 'Knee', '', '8000', 'others', 0, NULL, 'radio25', '1'),
(315, 'Leg (Tibia/Fibula)', '', '8000', 'others', 0, NULL, 'radio26', '1'),
(316, 'Pelvis & Hip', '', '8000', 'others', 0, NULL, 'radio27', '1'),
(317, 'Pelvis( AP)', '', '8000', 'others', 0, NULL, 'radio28', '1'),
(318, 'Shoulder', '', '8000', 'others', 0, NULL, 'radio29', '1'),
(319, 'Thigh(Femur)', '', '8000', 'others', 0, NULL, 'radio30', '1'),
(320, 'Wrist', '', '8000', 'others', 0, NULL, 'radio31', '1'),
(321, 'Abdomen', '', '8000', 'others', 0, NULL, 'radio32', '1'),
(322, 'Plain', '', '8000', 'others', 0, NULL, 'radio33', '1'),
(323, 'Erect/Supine', '', '8000', 'others', 0, NULL, 'radio34', '1'),
(324, 'Pelvimetry', '', '8000', 'others', 0, NULL, 'radio35', '1'),
(325, 'Vertebrae', '', '8000', 'others', 0, NULL, 'radio36', '1'),
(326, 'Cervical Spine', '', '8000', 'others', 0, NULL, 'radio37', '1'),
(327, 'Cervical Spine (Oblique)', '', '8000', 'others', 0, NULL, 'radio38', '1'),
(328, 'Coccyx', '', '8000', 'others', 0, NULL, 'radio39', '1'),
(329, 'Lumbar Spine', '', '8000', 'others', 0, NULL, 'radio40', '1'),
(330, 'Lumbo- Sacral Spine', '', '8000', 'others', 0, NULL, 'radio41', '1'),
(331, 'Neck-Lateral View (Soft Tissue)', '', '8000', 'others', 0, NULL, 'radio42', '1'),
(332, 'Sacro- Iliac Joint (SIJ)', '', '8000', 'others', 0, NULL, 'radio43', '1'),
(333, 'Sacrum', '', '8000', 'others', 0, NULL, 'radio44', '1'),
(334, 'Thoracic Spine', '', '8000', 'others', 0, NULL, 'radio45', '1'),
(335, 'Thoraco- Lumbar Spine', '', '8000', 'others', 0, NULL, 'radio46', '1'),
(336, 'Ultrasound Scans', '', '8000', 'others', 0, NULL, 'radio47', '1'),
(337, 'Abdominal Pelvic', '', '8000', 'others', 0, NULL, 'radio48', '1'),
(338, 'Bladder Scan', '', '8000', 'others', 0, NULL, 'radio49', '1'),
(339, 'Breast Scan', '', '8000', 'others', 0, NULL, 'radio50', '1'),
(340, 'Obstetric Scan', '', '8000', 'others', 0, NULL, 'radio51', '1'),
(341, 'Ovulometry', '', '4000', 'others', 0, NULL, 'radio52', '1'),
(342, 'Pelvic Scan', '', '4000', 'others', 0, NULL, 'radio53', '1'),
(343, 'Prostate Scan', '', '8000', 'others', 0, NULL, 'radio54', '1'),
(344, 'Testes Scan', '', '8000', 'others', 0, NULL, 'radio55', '1'),
(345, 'Thyroid Scan', '', '8000', 'others', 0, NULL, 'radio56', '1'),
(346, 'Transvagina Scan (TVS)', '', '8000', 'others', 0, NULL, 'radio57', '1'),
(347, 'Transvaginal/Folliculometry Scan', '', '8000', 'others', 0, NULL, 'radio58', '1'),
(348, 'Other Imaging (SCAN)', '', '8000', 'others', 0, NULL, 'radio59', '1'),
(349, 'Barium Enema', '', '38000', 'others', 0, NULL, 'radio60', '1'),
(350, 'Barium Meal', '', '27000', 'others', 0, NULL, 'radio61', '1'),
(351, 'Barium Meal & Follow-Through', '', '30000', 'others', 0, NULL, 'radio62', '1'),
(352, 'Barium Swallow', '', '27000', 'others', 0, NULL, 'radio63', '1'),
(353, 'Colonoscopy', '', '55000', 'others', 0, NULL, 'radio64', '1'),
(354, 'Cross Fable', '', '7000', 'others', 0, NULL, 'radio65', '1'),
(355, 'CT Scan', '', '70000', 'others', 0, NULL, 'radio66', '1'),
(356, 'Cyst-Urethrogram', '', '18000', 'others', 0, NULL, 'radio67', '1'),
(357, 'Dental-Intra-Oral Periapical', '', '5000', 'others', 0, NULL, 'radio68', '1'),
(358, 'DOPPLER SCAN', '', '30000', 'others', 0, NULL, 'radio69', '1'),
(359, 'Extra Film', '', '4000', 'others', 0, NULL, 'radio70', '1'),
(360, 'Fistulogram/Sinogram', '', '27000', 'others', 0, NULL, 'radio71', '1'),
(361, 'HYSTEROSALPINGOGRAPHY (HSG)', '', '22000', 'others', 0, NULL, 'radio72', '1'),
(362, 'Intravenous Cholangiogram', '', '27000', 'others', 0, NULL, 'radio73', '1'),
(363, 'Intraveous Urography (IVU)', '', '22000', 'others', 0, NULL, 'radio74', '1'),
(364, 'Mamography', '', '35000', 'others', 0, NULL, 'radio75', '1'),
(365, 'Mastoid Owens View', '', '9000', 'others', 0, NULL, 'radio76', '1'),
(366, 'MRI', '', '150000', 'others', 0, NULL, 'radio77', '1'),
(367, 'Oral Cholecystogram', '', '15000', 'others', 0, NULL, 'radio78', '1'),
(368, 'Sacrum', '', '8000', 'others', 0, NULL, 'radio79', '1'),
(369, 'Skeletal Survey', '', '27000', 'others', 0, NULL, 'radio80', '1'),
(370, 'SONO / SIS', '', '17000', 'others', 0, NULL, 'radio81', '1'),
(371, 'MCUG / RCUG', '', '55000', 'others', 0, NULL, 'radio82', '1'),
(372, 'EVALUATION', '', '150000', 'others', 0, NULL, '1', '1'),
(373, 'OVULATION INDUCTION', '', '50000', 'others', 0, NULL, '2', '1'),
(374, 'INTRA-UTERINE INSEMINATION (IUI)', '', '350000', 'others', 0, NULL, '3', '1'),
(375, 'IN-VITRO FERTILIZATION (IVF)', '', '1000000', 'others', 0, NULL, '4', '1'),
(376, 'DONOR OOCYTES (DO)', '', '200000', 'others', 0, NULL, '5', '1'),
(377, 'DONOR SPERM (DS)', '', '100000', 'others', 0, NULL, '6', '1'),
(378, 'INTRA-CYSTOPLAMIC SPERM INJECTION (ICSI)', '', '150000', 'others', 0, NULL, '7', '1'),
(379, 'CO-STIMULATION', '', '500000', 'others', 0, NULL, '8', '1'),
(380, 'SEMEN CRYPTO-PRESERVATION', '', '50000', 'others', 0, NULL, '9', '1'),
(381, 'EMBRYO CRYPTO-PRESERVATION', '', '50000', 'others', 0, NULL, '10', '1'),
(382, 'Acrylic Additional Tooth', '', '5000', 'others', 0, NULL, '11', '1'),
(383, 'Acrylic first tooth', '', '10000', 'others', 0, NULL, '12', '1'),
(384, 'Anterior Tooth Extration ', '', '5000', 'others', 0, NULL, '13', '1'),
(385, 'Biopsy I/E', '', '10000', 'others', 0, NULL, '14', '1'),
(386, 'Bridge(Acrylic)', '', '20000', 'others', 0, NULL, '15', '1'),
(387, 'Bridge(Porcelain)', '', '80000', 'others', 0, NULL, '16', '1'),
(388, 'Composit Teeth Restoration(Per Tooth)', '', '10000', 'others', 0, NULL, '17', '1'),
(389, 'Crown (Acrylic)', '', '20000', 'others', 0, NULL, '18', '1'),
(390, 'Crown (Porcelain)', '', '80000', 'others', 0, NULL, '19', '1'),
(391, 'Curretage', '', '5000', 'others', 0, NULL, '20', '1'),
(392, 'Dental X-Ray', '', '3000', 'others', 0, NULL, '21', '1'),
(393, 'Desensitization (Per Tooth)', '', '5000', 'others', 0, NULL, '22', '1'),
(394, 'Dry Socket', '', '10000', 'others', 0, NULL, '23', '1'),
(395, 'Fractured/Retained Root Tooth Extraction', '', '5000', 'others', 0, NULL, '24', '1'),
(396, 'GIC Restoration', '', '8000', 'others', 0, NULL, '25', '1'),
(397, 'Incision and Drainage of Ludwig\'s Angina', '', '60000', 'others', 0, NULL, '26', '1'),
(398, 'Incision and Drainage of Periapical Abscess', '', '10000', 'others', 0, NULL, '27', '1'),
(399, 'Intra-Oral X-Ray (Between)', '', '3000', 'others', 0, NULL, '28', '1'),
(400, 'Intra-Oral X-Ray (Periapical)', '', '3000', 'others', 0, NULL, '29', '1'),
(401, 'Operculectomy', '', '7000', 'others', 0, NULL, '30', '1'),
(402, 'Pericoronitis', '', '10000', 'others', 0, NULL, '31', '1'),
(403, 'Pulpectomy', '', '10000', 'others', 0, NULL, '32', '1'),
(404, 'Pulpotomy(Per Tooth)', '', '10000', 'others', 0, NULL, '33', '1'),
(405, 'Reduction and Imoilization under LA', '', '60000', 'others', 0, NULL, '34', '1'),
(406, 'Root Canal Treatment (Anterior Tooth)', '', '30000', 'others', 0, NULL, '35', '1'),
(407, 'Root Canal Treatment (Posterior tooth)', '', '50000', 'others', 0, NULL, '36', '1'),
(408, 'Surgical Extraction(Per Tooth)', '', '30000', 'others', 0, NULL, '37', '1'),
(409, 'Tooth Extraction(Surgical)', '', '30000', 'others', 0, NULL, '38', '1'),
(410, 'Tooth Filling (Amalgam) Class 1', '', '8000', 'others', 0, NULL, '39', '1'),
(411, 'Tooth Filling (Composite)', '', '10000', 'others', 0, NULL, '40', '1'),
(412, '3RD Degree Perineal Tear', '', '50000', 'others', 0, NULL, '41', '1'),
(413, 'Assissted Vaginal delivery (Booked)', '', '35000', 'others', 0, NULL, '42', '1'),
(414, 'Assisted delivery (Unbooked)', '', '50000', 'others', 0, NULL, '43', '1'),
(415, 'Caesarian section with btl', '', '300000', 'others', 0, NULL, '44', '1'),
(416, 'Caesarian section(primary)first', '', '200000', 'others', 0, NULL, '45', '1'),
(417, 'Caesarian section(secondary) repeat', '', '250000', 'others', 0, NULL, '46', '1'),
(418, 'Caesarian section-twins', '', '300000', 'others', 0, NULL, '47', '1'),
(419, 'Caesarian section-twins repeat', '', '300000', 'others', 0, NULL, '48', '1'),
(420, 'Caeserian for SFC PXT', '', '350000', 'others', 0, NULL, '49', '1'),
(421, 'Ceasarian Hysterectomy', '', '300000', 'others', 0, NULL, '50', '1'),
(422, 'Cervical circlage', '', '30000', 'others', 0, NULL, '51', '1'),
(423, 'Episotomy Primary', '', '10000', 'others', 0, NULL, '52', '1'),
(424, 'Episotomy Secondary', '', '20000', 'others', 0, NULL, '53', '1'),
(425, 'Exploratory Laparatomy', '', '200000', 'others', 0, NULL, '54', '1'),
(426, 'Hysterectomy', '', '300000', 'others', 0, NULL, '55', '1'),
(427, 'Induction of Labour', '', '20000', 'others', 0, NULL, '56', '1'),
(428, 'Insertion I.U.C.D', '', '5000', 'others', 0, NULL, '57', '1'),
(429, 'Manual removal of Placenta', '', '16000', 'others', 0, NULL, '58', '1'),
(430, 'Masopialization', '', '30000', 'others', 0, NULL, '59', '1'),
(431, 'Mymectomy', '', '300000', 'others', 0, NULL, '60', '1'),
(432, 'Normal delivery (Booked)', '', '25000', 'others', 0, NULL, '61', '1'),
(433, 'Normal delivery (Unbooked)', '', '30000', 'others', 0, NULL, '62', '1'),
(434, 'Pap Smear', '', '20000', 'others', 0, NULL, '63', '1'),
(435, 'Surgical removal of Placenta', '', '20000', 'others', 0, NULL, '64', '1'),
(436, 'Tubal Ligation', '', '100000', 'others', 0, NULL, '65', '1'),
(437, 'Admission Pack', '', '1500', 'others', 0, NULL, '66', '1'),
(438, 'Blood giving set', '', '200', 'others', 0, NULL, '67', '1'),
(439, 'Canula', '', '200', 'others', 0, NULL, '68', '1'),
(440, 'Chromic', '', '500', 'others', 0, NULL, '69', '1'),
(441, 'Crepe bandage 3inches', '', '200', 'others', 0, NULL, '70', '1'),
(442, 'Crepe bandage 4inches', '', '250', 'others', 0, NULL, '71', '1'),
(443, 'Crepe bandage 6inches', '', '250', 'others', 0, NULL, '72', '1'),
(444, 'Drip giving set', '', '100', 'others', 0, NULL, '73', '1'),
(445, 'Foley', '', '400', 'others', 0, NULL, '74', '1'),
(446, 'Injection', '', '200', 'others', 0, NULL, '75', '1'),
(447, 'LBD-Mother/Baby', '', '3000', 'others', 0, NULL, '76', '1'),
(448, 'Major Pack', '', '500', 'others', 0, NULL, '77', '1'),
(449, 'Minor Pack', '', '250', 'others', 0, NULL, '78', '1'),
(450, 'NG Tube', '', '250', 'others', 0, NULL, '79', '1'),
(451, 'Nylon suture', '', '300', 'others', 0, NULL, '80', '1'),
(452, 'Out-patient nursing care', '', '500', 'others', 0, NULL, '81', '1'),
(453, 'PBS', '', '600', 'others', 0, NULL, '82', '1'),
(454, 'Silk', '', '300', 'others', 0, NULL, '83', '1'),
(455, 'Superficial wound dressing', '', '500', 'others', 0, NULL, '84', '1'),
(456, 'Surgical blade', '', '50', 'others', 0, NULL, '85', '1'),
(457, 'Surgical gloves', '', '150', 'others', 0, NULL, '86', '1'),
(458, 'Syringes 10mls', '', '40', 'others', 0, NULL, '87', '1'),
(459, 'Syringes 20mls', '', '50', 'others', 0, NULL, '88', '1'),
(460, 'Syringes 2mls', '', '30', 'others', 0, NULL, '89', '1'),
(461, 'Syringes 5mls', '', '30', 'others', 0, NULL, '90', '1'),
(462, 'Urine bags', '', '250', 'others', 0, NULL, '91', '1'),
(463, 'Vicryl', '', '1000', 'others', 0, NULL, '92', '1'),
(464, 'Wound Dressing: Two or more limbs (double amount)', '', '2000', 'others', 0, NULL, '93', '1'),
(465, 'Catherization', '', '3000', 'others', 0, NULL, '94', '1'),
(466, 'Congenital multiple digits of cyndactyly', '', '7500', 'others', 0, NULL, '95', '1'),
(467, 'Ear syringing', '', '2000', 'others', 0, NULL, '96', '1'),
(468, 'Exchange Blood Transfusion (Rh - Ve Blood with set)', '', '30000', 'others', 0, NULL, '97', '1'),
(469, 'Exchange Blood Transfusion (Rh + Ve Blood with set)', '', '20000', 'others', 0, NULL, '98', '1'),
(470, 'Minor Debridment of Burns', '', '3500', 'others', 0, NULL, '99', '1'),
(471, 'Nebulisation', '', '5000', 'others', 0, NULL, '100', '1'),
(472, 'Pint of Screened Blood (Rh - Ve)', '', '25000', 'others', 0, NULL, '101', '1'),
(473, 'Pint of Screened Blood (Rh + Ve)', '', '20000', 'others', 0, NULL, '102', '1'),
(474, 'Release of Chordate ', '', '5000', 'others', 0, NULL, '103', '1'),
(475, 'Repair of Minor Laceration ', '', '10000', 'others', 0, NULL, '104', '1'),
(476, 'Small Cyst Excision', '', '5000', 'others', 0, NULL, '105', '1'),
(477, 'Subdura Tap', '', '3000', 'others', 0, NULL, '106', '1'),
(478, 'Tongue Tie Release ', '', '5000', 'others', 0, NULL, '107', '1'),
(479, 'Suction per session', '', '10000', 'others', 0, NULL, '108', '1'),
(480, 'Oxygen therapy', '', '20000', 'others', 0, NULL, '109', '1'),
(481, 'Phototherapy per session', '', '15000', 'others', 0, NULL, '110', '1'),
(482, 'Comprehensive Health Assessment', '', '30000', 'others', 0, NULL, '111', '1'),
(483, 'Medical Form Completion', '', '10000', 'others', 0, NULL, '112', '1'),
(484, 'Abdominal Rectopexy', '', '170000', 'others', 0, NULL, '113', '1'),
(485, 'ADENOTONSILLECTOMY (ENT MAJOR SURGERY)', '', '350000', 'others', 0, NULL, '114', '1'),
(486, 'Amputation (Upper Limb) (Orthopaedic/Intermediate)', '', '0', 'others', 0, NULL, '115', '1'),
(487, 'Amputation of a Digit (Orthopaedic/Minor)', '', '0', 'others', 0, NULL, '116', '1'),
(488, 'Amputation of lower limb', '', '0', 'others', 0, NULL, '117', '1'),
(489, 'Anal Fistulectomy Repair ', '', '170000', 'others', 0, NULL, '118', '1'),
(490, 'Anal Spincteroplasty ', '', '170000', 'others', 0, NULL, '119', '1'),
(491, 'Appendicectomy', '', '170000', 'others', 0, NULL, '120', '1'),
(492, 'Biopsy (Orthopaedic/Minor)', '', '0', 'others', 0, NULL, '121', '1'),
(493, 'Biopsy of Tumor of Abdominal Wall', '', '50000', 'others', 0, NULL, '122', '1'),
(494, 'Breast Lump', '', '0', 'others', 0, NULL, '123', '1'),
(495, 'Bronchoscopy', '', '60000', 'others', 0, NULL, '124', '1'),
(496, 'Caudal block', '', '0', 'others', 0, NULL, '125', '1'),
(497, 'Circumcision (Adult)', '', '120000', 'others', 0, NULL, '126', '1'),
(498, 'Circumcision (Paediatric)', '', '15000', 'others', 0, NULL, '127', '1'),
(499, 'Colostomy', '', '0', 'others', 0, NULL, '128', '1'),
(500, 'Combined Epidural and Spinal Anaesthesia', '', '90000', 'others', 0, NULL, '129', '1'),
(501, 'Combined Spinal Epidural', '', '0', 'others', 0, NULL, '130', '1'),
(502, 'Culdocinthesis', '', '0', 'others', 0, NULL, '131', '1'),
(503, 'Cystic Hygroma Excision', '', '170000', 'others', 0, NULL, '132', '1'),
(504, 'Cystotomy', '', '200000', 'others', 0, NULL, '133', '1'),
(505, 'Dilwan-Evans Procedure (Orthopaedic/Major)', '', '0', 'others', 0, NULL, '134', '1'),
(506, 'Dissection of Fermoral Triangle', '', '170000', 'others', 0, NULL, '135', '1'),
(507, 'Drainage of Pleural effusion', '', '0', 'others', 0, NULL, '136', '1'),
(508, 'Endoscopy of GIT', '', '40000', 'others', 0, NULL, '137', '1'),
(509, 'Elective C/S (Booked)', '', '0', 'others', 0, NULL, '138', '1'),
(510, 'Emergency C/S (Booked)', '', '0', 'others', 0, NULL, '139', '1'),
(511, 'Emergency C/S (Unbooked)', '', '0', 'others', 0, NULL, '140', '1'),
(512, 'Emergency Evacuation', '', '0', 'others', 0, NULL, '141', '1'),
(513, 'Epidural (Catheter Technique)', '', '0', 'others', 0, NULL, '142', '1'),
(514, 'EpigastricHerniorrhappy', '', '170000', 'others', 0, NULL, '143', '1'),
(515, 'Excision of Breast lump', '', '70000', 'others', 0, NULL, '144', '1'),
(516, 'Excision of Ganglion', '', '0', 'others', 0, NULL, '145', '1'),
(517, 'Excision of Intrascrotal Mass', '', '170000', 'others', 0, NULL, '146', '1'),
(518, 'Exploratory Laparatomy', '', '0', 'others', 0, NULL, '147', '1'),
(519, 'External Fixation (Orthopaedic/Intermediate)', '', '0', 'others', 0, NULL, '148', '1'),
(520, 'Fistula In-Ano Repair ', '', '170000', 'others', 0, NULL, '149', '1'),
(521, 'Flexor Tendon Repair/Extension Tendon Repair', '', '0', 'others', 0, NULL, '150', '1'),
(522, 'Frenulectomy', '', '0', 'others', 0, NULL, '151', '1'),
(523, 'Ganglion', '', '0', 'others', 0, NULL, '152', '1'),
(524, 'General Anaesthesia', '', '50000', 'others', 0, NULL, '153', '1'),
(525, 'General Anaesthesia (ETT)', '', '0', 'others', 0, NULL, '154', '1'),
(526, 'General Anaesthesia (Face mask)', '', '0', 'others', 0, NULL, '155', '1'),
(527, 'General Anaesthesia + Oxygen', '', '70000', 'others', 0, NULL, '156', '1'),
(528, 'General Anaesthesia + Oxygen + Intubation', '', '90000', 'others', 0, NULL, '157', '1'),
(529, 'Haemorhoidectomy', '', '0', 'others', 0, NULL, '158', '1'),
(530, 'Hemiography (Bilateral)', '', '0', 'others', 0, NULL, '159', '1'),
(531, 'Hemiography (Inguinoscrotal - Bilateral)', '', '0', 'others', 0, NULL, '160', '1'),
(532, 'Hemiography (Inguinoscrotal - Unilateral)', '', '0', 'others', 0, NULL, '161', '1'),
(533, 'Hemiography (Obstructed)', '', '0', 'others', 0, NULL, '162', '1'),
(534, 'Hemiography (Single)', '', '0', 'others', 0, NULL, '163', '1'),
(535, 'Herniorraphy- Inguinal/Others', '', '170000', 'others', 0, NULL, '164', '1'),
(536, 'Hydrocellectomy (Bilateral)', '', '0', 'others', 0, NULL, '165', '1'),
(537, 'Hydrocoelectomy (Unilateral)', '', '0', 'others', 0, NULL, '166', '1'),
(538, 'Injection Sclerotherapy of Varicose Veins ', '', '15000', 'others', 0, NULL, '167', '1'),
(539, 'Laparotomy (Exploratory)', '', '0', 'others', 0, NULL, '168', '1'),
(540, 'Laparotomy (Resection and Anastomosis)', '', '0', 'others', 0, NULL, '169', '1'),
(541, 'Laparotomy for Pyoperitoneum', '', '0', 'others', 0, NULL, '170', '1'),
(542, 'Liver/Kidney/Bone Marrow Biopsy', '', '120000', 'others', 0, NULL, '171', '1'),
(543, 'Local Anaesthesia', '', '0', 'others', 0, NULL, '172', '1'),
(544, 'Lypomas Excision', '', '0', 'others', 0, NULL, '173', '1'),
(545, 'M.U.A./POP (Orthopaedic/Minor)', '', '0', 'others', 0, NULL, '174', '1'),
(546, 'Major Procedure Theatre fee', '', '0', 'others', 0, NULL, '175', '1'),
(547, 'Major Sugical Incision and Drainage', '', '70000', 'others', 0, NULL, '176', '1'),
(548, 'Minor Procedure Theatre fee', '', '0', 'others', 0, NULL, '177', '1'),
(549, 'Missed Abortion Evacuation', '', '20000', 'others', 0, NULL, '178', '1'),
(550, 'Multiple Ligation Veins ', '', '170000', 'others', 0, NULL, '179', '1'),
(551, 'Myomectromy (Multiple)', '', '0', 'others', 0, NULL, '180', '1'),
(552, 'Myomectromy (Single-node)', '', '0', 'others', 0, NULL, '181', '1'),
(553, 'Nerve Repair (Orthopaedic/Major)', '', '0', 'others', 0, NULL, '182', '1'),
(554, 'Oesophagoscopy ', '', '30000', 'others', 0, NULL, '183', '1'),
(555, 'Orchidectomy (Bilateral)', '', '0', 'others', 0, NULL, '184', '1'),
(556, 'Orchidectomy (Unilateral)', '', '0', 'others', 0, NULL, '185', '1'),
(557, 'Orchidectomy/Orchidopexy', '', '170000', 'others', 0, NULL, '186', '1'),
(558, 'ORIF (Orthopaedic/Major)', '', '0', 'others', 0, NULL, '187', '1'),
(559, 'Pericardiocentesis', '', '170000', 'others', 0, NULL, '188', '1'),
(560, 'Posteromedial Release - PMR (Orthopaedic/Major)', '', '0', 'others', 0, NULL, '189', '1'),
(561, 'Proctoscopy', '', '30000', 'others', 0, NULL, '190', '1'),
(562, 'Protatectomy', '', '0', 'others', 0, NULL, '191', '1'),
(563, 'Removal IUCD', '', '0', 'others', 0, NULL, '192', '1'),
(564, 'Removal of implant', '', '0', 'others', 0, NULL, '193', '1'),
(565, 'Salpingectomy (Ectopic)', '', '0', 'others', 0, NULL, '194', '1'),
(566, 'Secondary wound closure', '', '0', 'others', 0, NULL, '195', '1'),
(567, 'Septic Evacuation', '', '0', 'others', 0, NULL, '196', '1'),
(568, 'Sequestrectomy (Orthopaedic/Intermediate)', '', '0', 'others', 0, NULL, '197', '1'),
(569, 'Sigmoidoscopy', '', '30000', 'others', 0, NULL, '198', '1'),
(570, 'Single shot Epidural', '', '50000', 'others', 0, NULL, '199', '1'),
(571, 'Skin grafting', '', '0', 'others', 0, NULL, '200', '1'),
(572, 'Skin Grafting ', '', '170000', 'others', 0, NULL, '201', '1'),
(573, 'SkinTraction/Skeletal Traction (Orthopaedic/Minor)', '', '0', 'others', 0, NULL, '202', '1'),
(574, 'Spinal Anaesthesia', '', '40000', 'others', 0, NULL, '203', '1'),
(575, 'Subtotal Hysterectomy', '', '0', 'others', 0, NULL, '204', '1'),
(576, 'SuprapubicCystomy', '', '70000', 'others', 0, NULL, '205', '1'),
(577, 'Surgery of Torsion of Spermatic Cord', '', '170000', 'others', 0, NULL, '206', '1'),
(578, 'Synovectomy', '', '80000', 'others', 0, NULL, '207', '1'),
(579, 'Tenotomy (Orthopaedic/Minor)', '', '0', 'others', 0, NULL, '208', '1'),
(580, 'Therapeutic D&C', '', '0', 'others', 0, NULL, '209', '1'),
(581, 'Thyroidectomy', '', '0', 'others', 0, NULL, '210', '1'),
(582, 'Total Abdominal Hysterectomy', '', '0', 'others', 0, NULL, '211', '1'),
(583, 'Tracheostomy', '', '30000', 'others', 0, NULL, '212', '1'),
(584, 'Tubal Litigation (Elective Only)', '', '0', 'others', 0, NULL, '213', '1'),
(585, 'Wedging of POP (Orthopaedic/Minor)', '', '0', 'others', 0, NULL, '214', '1'),
(586, 'Wound dressing (major)', '', '3000', 'others', 0, NULL, '215', '1'),
(587, 'Wound dressing (minor)', '', '2000', 'others', 0, NULL, '216', '1'),
(588, 'Wound suturing', '', '30000', 'others', 0, NULL, '217', '1'),
(589, 'Chicken pox vaccine', '', '0', 'others', 0, NULL, '218', '1'),
(590, 'Hbv(adult) vaccine', '', '0', 'others', 0, NULL, '219', '1'),
(591, 'Hbv(children) vaccine', '', '0', 'others', 0, NULL, '220', '1'),
(592, 'Hepatitis b vac. Child dose(multi dose)', '', '0', 'others', 0, NULL, '221', '1'),
(593, 'Hepatitis b vaccine single vial dose', '', '0', 'others', 0, NULL, '222', '1'),
(594, 'Measles vaccine', '', '0', 'others', 0, NULL, '223', '1'),
(595, 'Meningitis vaccine', '', '0', 'others', 0, NULL, '224', '1'),
(596, 'Mmr vaccine', '', '0', 'others', 0, NULL, '225', '1'),
(597, 'Yellow fever card', '', '0', 'others', 0, NULL, '226', '1'),
(599, 'ANTERIOR NASAL PACKING', '', '5000', 'others', 0, NULL, '228', '1'),
(600, 'ANTRAL LAVAGE', '', '30000', 'others', 0, NULL, '229', '1'),
(601, 'AURAL ANTISEPTIC WICK DRESSING / DAY', '', '4000', 'others', 0, NULL, '230', '1'),
(602, 'AURAL SYRINGING: BOTH EARS ', '', '22000', 'others', 0, NULL, '231', '1'),
(603, 'AURAL SYRINGING: ONE EAR ', '', '15000', 'others', 0, NULL, '232', '1'),
(604, 'AURAL TOILETING / EAR', '', '4000', 'others', 0, NULL, '233', '1'),
(605, 'ELECTROCAUTERY OF THE NOSE', '', '15000', 'others', 0, NULL, '234', '1'),
(606, 'FOREIGN BODY REMOVAL FROM EAR', '', '15000', 'others', 0, NULL, '235', '1'),
(607, 'FOREIGN BODY REMOVAL FROM NOSE', '', '15000', 'others', 0, NULL, '236', '1'),
(608, 'FOREIGN BODY REMOVAL FROM THROAT', '', '25000', 'others', 0, NULL, '237', '1'),
(609, 'I & D OF QUINCY', '', '30000', 'others', 0, NULL, '238', '1'),
(610, 'INDIRECT LARYNGNOSCOPY', '', '10000', 'others', 0, NULL, '239', '1'),
(611, 'PERNASAL BIOPSY', '', '20000', 'others', 0, NULL, '240', '1'),
(612, 'POSTERIOR NASAL PACKING', '', '8000', 'others', 0, NULL, '241', '1'),
(613, 'RELEASE OF TONGUE TIE', '', '20000', 'others', 0, NULL, '242', '1'),
(614, 'PTA', '', '10000', 'others', 0, NULL, '243', '1'),
(615, 'SINGLE VISION LENSES (WHITE)', '', '6000', 'others', 0, NULL, '244', '1'),
(616, 'SINGLE VISION TRIAR', '', '6000', 'others', 0, NULL, '245', '1'),
(617, 'SINGLE VISION TR/AR', '', '6000', 'others', 0, NULL, '246', '1'),
(618, 'FUSED BIFOCAL', '', '8000', 'others', 0, NULL, '247', '1'),
(619, 'FUSED BIFOCAL TR/AR ', '', '8000', 'others', 0, NULL, '248', '1'),
(620, 'INVISIBLE BIFOCAL', '', '9000', 'others', 0, NULL, '249', '1'),
(621, 'VARILUX WHITE', '', '8000', 'others', 0, NULL, '250', '1'),
(622, 'VARILUX TRIAR', '', '10000', 'others', 0, NULL, '251', '1'),
(623, 'VARILUX SPECIAL ORDER WHITE', '', '11000', 'others', 0, NULL, '252', '1'),
(624, 'VARILUX SPECIAL ORDER TRIAR ', '', '23000', 'others', 0, NULL, '253', '1'),
(625, 'SPECIAL ORDER WHITE ', '', '5000', 'others', 0, NULL, '254', '1'),
(626, 'SPECIAL ORDER FUSED WHITE ', '', '6000', 'others', 0, NULL, '255', '1'),
(627, 'SPECIAL ORDER FUSED TRIAR', '', '16000', 'others', 0, NULL, '256', '1'),
(628, 'SPECIAL ORDER INVISIBLE TRIAR', '', '21000', 'others', 0, NULL, '257', '1'),
(629, 'Nursing Care', '', '2000', 'others', 0, NULL, '258', '1'),
(630, 'Professional Mediacal care', '', '3000', 'others', 0, NULL, '259', '1'),
(631, 'Consumables', '', '2000', 'others', 0, NULL, '260', '1'),
(632, 'DAVID WELLNESS & GERIATRICS CLINIC (Follow Up)', '', '5000', 'others', 0, NULL, '', '1'),
(633, 'DAVID WELLNESS & GERIATRICS CLINIC (First Visit)', '', '15000', 'others', 0, NULL, '', '1'),
(634, 'SURGERY CLINIC (Follow Up)', '', '5000', 'others', 0, NULL, '', '1');
INSERT INTO `payment_category` (`id`, `category`, `description`, `c_price`, `type`, `d_commission`, `h_commission`, `operation_id`, `hospital_id`) VALUES
(635, 'SURGERY CLINIC (First Visit)', '', '15000', 'others', 0, NULL, '', '1'),
(636, 'PAEDIATRIC CLINIC (Follow Up)', '', '5000', 'others', 0, NULL, '', '1'),
(637, 'PAEDIATRIC CLINIC (First Visit)', '', '15000', 'others', 0, NULL, '', '1'),
(638, 'O&G SPECIALIST (Follow Up)', '', '5000', 'others', 0, NULL, '', '1'),
(639, 'O&G SPECIALIST (First Visit)', '', '15000', 'others', 0, NULL, '', '1'),
(640, 'EYE CLINIC (Follow Up)', '', '3000', 'others', 0, NULL, '', '1'),
(641, 'EYE CLINIC (First Visit)', '', '5000', 'others', 0, NULL, '', '1'),
(642, 'ENT CLINIC (Follow Up)', '', '5000', 'others', 0, NULL, '', '1'),
(643, 'ENT CLINIC (First Visit)', '', '15000', 'others', 0, NULL, '', '1'),
(644, 'DENTAL CLINIC (Follow Up)', '', '3000', 'others', 0, NULL, '', '1'),
(645, 'DENTAL CLINIC (First Visit)', '', '5000', 'others', 0, NULL, '', '1'),
(646, 'Female Ward-001', '', '5000', 'others', 0, NULL, 'bed_1', '1'),
(647, 'Postnasal space X-ray', '', '8000', 'others', 0, NULL, 'radio83', '1'),
(648, 'Paranasal sinus x-ray', '', '8000', 'others', 0, NULL, 'radio84', '1'),
(649, 'ECG', '', '8000', 'others', 0, NULL, 'radio85', '1'),
(650, 'Female Ward-001', '', '5000', 'others', 0, NULL, 'bed_2', '1'),
(651, 'Registration Card', 'Others', '2000', 'others', 0, NULL, '', '1'),
(652, 'PHYSIOTHERAPY (First Visit)', '', '15000', 'others', 0, NULL, '', '1'),
(653, 'PHYSIOTHERAPY (Follow Up)', '', '10000', 'others', 0, NULL, '', '1'),
(654, 'EMERGENCY CARD', 'ADMISSION', '5,000', 'others', 0, NULL, '', '1'),
(655, 'Fake Department (Follow Up)', '', '10000', 'others', 0, NULL, '', '1'),
(656, 'Fake Department (First Visit)', '', '20000', 'others', 0, NULL, '', '1'),
(657, 'INTERNAL MEDICINE CLINIC (Follow Up)', '', '5000', 'others', 0, NULL, '', '1'),
(658, 'INTERNAL MEDICINE CLINIC (First Visit)', '', '15000', 'others', 0, NULL, '', '1'),
(659, 'GYNAECOLOGY CLINIC (Follow Up)', '', '5000', 'others', 0, NULL, '', '1'),
(660, 'GYNAECOLOGY CLINIC (First Visit)', '', '15000', 'others', 0, NULL, '', '1'),
(661, 'DIET AND NUTRITION (Follow Up)', '', '3000', 'others', 0, NULL, '', '1'),
(662, 'DIET AND NUTRITION (First Visit)', '', '5000', 'others', 0, NULL, '', '1'),
(663, 'Female Ward-002', '', '5000', 'others', 0, NULL, 'bed_3', '1'),
(664, 'Female Ward-003', '', '5000', 'others', 0, NULL, 'bed_4', '1'),
(665, 'Male Ward-001', '', '5000', 'others', 0, NULL, 'bed_5', '1'),
(666, 'Male Ward-002', '', '5000', 'others', 0, NULL, 'bed_6', '1'),
(667, 'RVS', '', '2000', 'others', 0, NULL, 'lab285', '1');

-- --------------------------------------------------------

--
-- Table structure for table `pharmacist`
--

CREATE TABLE `pharmacist` (
  `id` int(11) NOT NULL,
  `img_url` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `name` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `address` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `phone` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `x` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `y` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `ion_user_id` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `hospital_id` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `pharmacist`
--

INSERT INTO `pharmacist` (`id`, `img_url`, `name`, `email`, `address`, `phone`, `x`, `y`, `ion_user_id`, `hospital_id`) VALUES
(1, NULL, 'pharmacist', 'pharmacist@hms.com', '12345', '12345', NULL, NULL, '755', '2'),
(2, NULL, 'Pharma1', 'pharm1@demo.familycare.com', 'Temp Address', '88888888888888', NULL, NULL, '769', '1'),
(3, NULL, 'Pharma 1', 'pharm1@demo.savealife.com', 'Temp Address', '1123434556666', NULL, NULL, '778', '4');

-- --------------------------------------------------------

--
-- Table structure for table `pharmacy_expense`
--

CREATE TABLE `pharmacy_expense` (
  `id` int(11) NOT NULL,
  `category` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `date` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `amount` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `user` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `hospital_id` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pharmacy_expense_category`
--

CREATE TABLE `pharmacy_expense_category` (
  `id` int(11) NOT NULL,
  `category` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `description` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `x` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `y` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `hospital_id` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pharmacy_payment`
--

CREATE TABLE `pharmacy_payment` (
  `id` int(11) NOT NULL,
  `category` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `patient` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `prescription_id` varchar(100) DEFAULT NULL,
  `doctor` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `date` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `amount` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `vat` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '0',
  `x_ray` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `flat_vat` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `discount` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '0',
  `flat_discount` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `gross_total` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `hospital_amount` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `doctor_amount` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `category_amount` varchar(1000) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `category_name` varchar(1000) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `amount_received` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `status` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `pharmacists` varchar(100) DEFAULT NULL,
  `hospital_id` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pharmacy_payment_category`
--

CREATE TABLE `pharmacy_payment_category` (
  `id` int(11) NOT NULL,
  `category` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `description` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `c_price` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `d_commission` int(11) DEFAULT NULL,
  `h_commission` int(11) DEFAULT NULL,
  `hospital_id` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `prescription`
--

CREATE TABLE `prescription` (
  `id` int(11) NOT NULL,
  `date` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `patient` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `doctor` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `symptom` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `advice` varchar(1000) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `state` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `dd` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `medicine` varchar(1000) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `validity` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `note` varchar(1000) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `patientname` varchar(1000) NOT NULL,
  `doctorname` varchar(1000) NOT NULL,
  `status` varchar(1) NOT NULL,
  `edited_by` varchar(100) DEFAULT NULL,
  `hospital_id` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `prescription`
--

INSERT INTO `prescription` (`id`, `date`, `patient`, `doctor`, `symptom`, `advice`, `state`, `dd`, `medicine`, `validity`, `note`, `patientname`, `doctorname`, `status`, `edited_by`, `hospital_id`) VALUES
(1, '1697241600', '3', '157', '', '<p>hvuyfyucvyuctucol</p>\r\n', NULL, NULL, '', NULL, '', 'Adewale Adebayo', 'Doctor 1', '', NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `radiology`
--

CREATE TABLE `radiology` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` varchar(100) NOT NULL,
  `hospital_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `radiology`
--

INSERT INTO `radiology` (`id`, `name`, `price`, `hospital_id`) VALUES
(1, 'Skull (AP & LAT)', '8000', '1'),
(2, 'Skull (SINGLE VIEW)', '6000', '1'),
(3, 'AP/Lateral', '8000', '1'),
(4, 'Mastoids', '8000', '1'),
(5, 'Sinuses', '8000', '1'),
(6, 'Mandibles (Jaw)', '8000', '1'),
(7, 'Temperomandibular Joint (TMJ)', '8000', '1'),
(8, 'Thorax', '8000', '1'),
(9, 'Chest (AP)', '8000', '1'),
(10, 'Chest (AP/Lateral)', '8000', '1'),
(11, 'Chest  (Oblique)', '8000', '1'),
(12, 'Chest (Apical View)', '8000', '1'),
(13, 'Sternum', '8000', '1'),
(14, 'Thoracic Inlet', '8000', '1'),
(15, 'Limbs', '8000', '1'),
(16, 'Ankle', '8000', '1'),
(17, 'Clavicle', '8000', '1'),
(18, 'Elbow', '8000', '1'),
(19, 'Foot/Toe', '8000', '1'),
(20, 'Foot/Toe', '8000', '1'),
(21, 'Forearm (Radius And Ulna)', '8000', '1'),
(22, 'Hand/Finger', '8000', '1'),
(23, 'Hip', '8000', '1'),
(24, 'Humerus', '8000', '1'),
(25, 'Knee', '8000', '1'),
(26, 'Leg (Tibia/Fibula)', '8000', '1'),
(27, 'Pelvis & Hip', '8000', '1'),
(28, 'Pelvis( AP)', '8000', '1'),
(29, 'Shoulder', '8000', '1'),
(30, 'Thigh(Femur)', '8000', '1'),
(31, 'Wrist', '8000', '1'),
(32, 'Abdomen', '8000', '1'),
(33, 'Plain', '8000', '1'),
(34, 'Erect/Supine', '8000', '1'),
(35, 'Pelvimetry', '8000', '1'),
(36, 'Vertebrae', '8000', '1'),
(37, 'Cervical Spine', '8000', '1'),
(38, 'Cervical Spine (Oblique)', '8000', '1'),
(39, 'Coccyx', '8000', '1'),
(40, 'Lumbar Spine', '8000', '1'),
(41, 'Lumbo- Sacral Spine', '8000', '1'),
(42, 'Neck-Lateral View (Soft Tissue)', '8000', '1'),
(43, 'Sacro- Iliac Joint (SIJ)', '8000', '1'),
(44, 'Sacrum', '8000', '1'),
(45, 'Thoracic Spine', '8000', '1'),
(46, 'Thoraco- Lumbar Spine', '8000', '1'),
(47, 'Ultrasound Scans', '8000', '1'),
(48, 'Abdominal Pelvic', '8000', '1'),
(49, 'Bladder Scan', '8000', '1'),
(50, 'Breast Scan', '8000', '1'),
(51, 'Obstetric Scan', '8000', '1'),
(52, 'Ovulometry', '4000', '1'),
(53, 'Pelvic Scan', '4000', '1'),
(54, 'Prostate Scan', '8000', '1'),
(55, 'Testes Scan', '8000', '1'),
(56, 'Thyroid Scan', '8000', '1'),
(57, 'Transvagina Scan (TVS)', '8000', '1'),
(58, 'Transvaginal/Folliculometry Scan', '8000', '1'),
(59, 'Other Imaging (SCAN)', '8000', '1'),
(60, 'Barium Enema', '38000', '1'),
(61, 'Barium Meal', '27000', '1'),
(62, 'Barium Meal & Follow-Through', '30000', '1'),
(63, 'Barium Swallow', '27000', '1'),
(64, 'Colonoscopy', '55000', '1'),
(65, 'Cross Fable', '7000', '1'),
(66, 'CT Scan', '70000', '1'),
(67, 'Cyst-Urethrogram', '18000', '1'),
(68, 'Dental-Intra-Oral Periapical', '5000', '1'),
(69, 'DOPPLER SCAN', '30000', '1'),
(70, 'Extra Film', '4000', '1'),
(71, 'Fistulogram/Sinogram', '27000', '1'),
(72, 'HYSTEROSALPINGOGRAPHY (HSG)', '22000', '1'),
(73, 'Intravenous Cholangiogram', '27000', '1'),
(74, 'Intraveous Urography (IVU)', '22000', '1'),
(75, 'Mamography', '35000', '1'),
(76, 'Mastoid Owens View', '9000', '1'),
(77, 'MRI', '150000', '1'),
(78, 'Oral Cholecystogram', '15000', '1'),
(79, 'Sacrum', '8000', '1'),
(80, 'Skeletal Survey', '27000', '1'),
(81, 'SONO / SIS', '17000', '1'),
(82, 'MCUG / RCUG', '55000', '1'),
(83, 'Postnasal space X-ray', '8000', '1'),
(84, 'Paranasal sinus x-ray', '8000', '1'),
(85, 'ECG', '8000', '1');

-- --------------------------------------------------------

--
-- Table structure for table `radio_history`
--

CREATE TABLE `radio_history` (
  `id` int(11) NOT NULL,
  `patient_id` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `title` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `description` varchar(10000) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `doctor_id` varchar(255) NOT NULL,
  `patient_name` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `patient_address` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `patient_phone` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `img_url` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `date` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `registration_time` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `hospital_id` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `radio_images`
--

CREATE TABLE `radio_images` (
  `id` int(11) NOT NULL,
  `report_id` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `date` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rad_request`
--

CREATE TABLE `rad_request` (
  `id` int(11) NOT NULL,
  `hospital_id` varchar(255) NOT NULL,
  `doctor` varchar(255) NOT NULL,
  `patient_id` varchar(255) NOT NULL,
  `patient_name` varchar(255) NOT NULL,
  `doctor_name` varchar(255) NOT NULL,
  `xray` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `receptionist`
--

CREATE TABLE `receptionist` (
  `id` int(11) NOT NULL,
  `img_url` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `name` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `address` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `phone` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `x` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `ion_user_id` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `hospital_id` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `receptionist`
--

INSERT INTO `receptionist` (`id`, `img_url`, `name`, `email`, `address`, `phone`, `x`, `ion_user_id`, `hospital_id`) VALUES
(1, NULL, 'Receptionist', 'Receptionist@hms.com', '12345', '12345', NULL, '759', '2'),
(2, NULL, 'Receptionist 1', 'receptionist1@xerdocshms.com', 'Inside the hospital', '080223312345', NULL, '765', '1'),
(3, NULL, 'Receptionist 1 ', 'receptionist1@demo.savealife.com', 'Temp Address', '2345432345', NULL, '774', '4');

-- --------------------------------------------------------

--
-- Table structure for table `record_officer`
--

CREATE TABLE `record_officer` (
  `id` int(11) NOT NULL,
  `img_url` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `name` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `address` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `phone` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `x` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `ion_user_id` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `hospital_id` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `record_officer`
--

INSERT INTO `record_officer` (`id`, `img_url`, `name`, `email`, `address`, `phone`, `x`, `ion_user_id`, `hospital_id`) VALUES
(1, NULL, 'Records Officer', 'RecordsOfficer@hms.com', '12345', '12345', NULL, '757', '2'),
(2, NULL, 'Records Keeper 1', 'records@demo.familycare.com', 'Inside the hospital', '124858585858585', NULL, '771', '1'),
(3, NULL, 'Records 1', 'records@demo.savealife.com', 'Temp Address', '2343423455556', NULL, '780', '4');

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `id` int(11) NOT NULL,
  `report_type` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `patient` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `description` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `doctor` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `date` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `add_date` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `hospital_id` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `id` int(11) NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `address` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `phone` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `other` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `package` varchar(1000) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `language` varchar(100) NOT NULL,
  `remarks` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `status` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `request_link`
--

CREATE TABLE `request_link` (
  `id` int(11) NOT NULL,
  `request_id` varchar(255) NOT NULL,
  `test_id` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `request_link`
--

INSERT INTO `request_link` (`id`, `request_id`, `test_id`, `date`) VALUES
(1, '108', '2', '1635932467'),
(2, '106', '3', '1635932908'),
(3, '121', '4', '1635940526'),
(4, '121', '5', '1635940677'),
(5, '122', '6', '1635940928'),
(6, '140', '7', '1635941759'),
(7, '299', '9', '1636034572'),
(8, '232', '29', '1637248490'),
(9, '1205', '30', '1637309948'),
(10, '1205', '31', '1637309948'),
(11, '1375', '32', '1637310199'),
(12, '1336', '34', '1637311229'),
(13, '1324', '35', '1637328248'),
(14, '1453', '36', '1637328996'),
(15, '1449', '37', '1637329934'),
(16, '1443', '38', '1637332494'),
(17, '1445', '39', '1637332880'),
(18, '1445', '40', '1637332880'),
(19, '1841', '44', '1639828142'),
(20, '1867', '46', '1640008039'),
(21, '2068', '49', '1641369358'),
(22, '2064', '51', '1641369600'),
(23, '2494', '233', '1648902546'),
(24, '2493', '234', '1648902668'),
(25, '2492', '235', '1648902814'),
(26, '2489', '236', '1648902889'),
(27, '2905', '252', '1651825402'),
(28, '2966', '260', '1652436014');

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `id` int(11) NOT NULL,
  `img_url` varchar(1000) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `title` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `description` varchar(1000) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `system_vendor` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `title` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `address` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `phone` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `facebook_id` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `currency` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `language` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `discount` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `live_appointment_type` varchar(100) NOT NULL,
  `vat` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `login_title` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `logo` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `invoice_logo` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `payment_gateway` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `sms_gateway` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `codec_username` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `codec_purchase_code` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `hospital_id` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `system_vendor`, `title`, `address`, `phone`, `email`, `facebook_id`, `currency`, `language`, `discount`, `live_appointment_type`, `vat`, `login_title`, `logo`, `invoice_logo`, `payment_gateway`, `sms_gateway`, `codec_username`, `codec_purchase_code`, `hospital_id`) VALUES
(1, 'Xerdocs - Hospital Management System', 'Family Care Hospital', 'Bayelsa Yenegoa', '00000', 'fch@xerdocshms.com', NULL, 'N', 'english', 'flat', '', NULL, NULL, 'uploads/fch_logo.JPG', NULL, NULL, 'Clickatell', '', '', '1'),
(2, 'Xerdocs - Hospital Management System', 'Test Hospital', 'address here', '0901234567', 'hospital@gmail.com', NULL, '$', 'english', 'flat', '', NULL, NULL, NULL, NULL, NULL, 'Twilio', NULL, NULL, '2'),
(3, 'Xerdocs - Hospital Management System', 'Chinemeze Akuh Hospital', 'Abuja', '123123123', 'neme@gmail.com', NULL, '$', 'english', 'flat', '', NULL, NULL, NULL, NULL, NULL, 'Twilio', NULL, NULL, '3'),
(4, 'Xerdocs - Hospital Management System', 'SaveALife Hospital', 'PortHarcourt, Rivers', '123123123123', 'admin@demo.savealife.com', NULL, '$', 'english', 'flat', '', NULL, NULL, NULL, NULL, NULL, 'Twilio', NULL, NULL, '4');

-- --------------------------------------------------------

--
-- Table structure for table `slide`
--

CREATE TABLE `slide` (
  `id` int(11) NOT NULL,
  `title` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `img_url` varchar(1000) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `text1` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `text2` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `text3` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `position` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `status` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sms`
--

CREATE TABLE `sms` (
  `id` int(11) NOT NULL,
  `date` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `message` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `recipient` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `user` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `hospital_id` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sms_settings`
--

CREATE TABLE `sms_settings` (
  `id` int(11) NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `username` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `password` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `api_id` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `sender` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `authkey` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `user` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `sid` varchar(1000) NOT NULL,
  `token` varchar(1000) NOT NULL,
  `sendernumber` varchar(1000) NOT NULL,
  `hospital_id` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `sms_settings`
--

INSERT INTO `sms_settings` (`id`, `name`, `username`, `password`, `api_id`, `sender`, `authkey`, `user`, `sid`, `token`, `sendernumber`, `hospital_id`) VALUES
(1, 'Clickatell', 'ur ClickAtell Username', 'ed3e3e33e3', '', NULL, NULL, '2', '', '', '', '1'),
(2, 'MSG91', 'Your MSG91 Username', NULL, 'Your MSG91 API ID', 'Sender Number', 'Your MSG91 Auth Key', '1', '', '', '', '1'),
(3, 'Twilio', NULL, NULL, NULL, NULL, NULL, '1', 'SID Number', 'Token Number', 'Sender Number', '1'),
(4, 'Clickatell', 'Your ClickAtell Username', 'Your ClickAtell Password', 'Your ClickAtell Api Id', NULL, NULL, '1', '', '', '', '2'),
(5, 'MSG91', 'Your MSG91 Username', NULL, 'Your MSG91 API ID', 'Sender Number', 'Your MSG91 Auth Key', '1', '', '', '', '2'),
(6, 'Twilio', NULL, NULL, NULL, NULL, NULL, '1', 'SID Number', 'Token Number', 'Sender Number', '2'),
(7, 'Clickatell', 'Your ClickAtell Username', 'Your ClickAtell Password', 'Your ClickAtell Api Id', NULL, NULL, '1', '', '', '', '3'),
(8, 'MSG91', 'Your MSG91 Username', NULL, 'Your MSG91 API ID', 'Sender Number', 'Your MSG91 Auth Key', '1', '', '', '', '3'),
(9, 'Twilio', NULL, NULL, NULL, NULL, NULL, '1', 'SID Number', 'Token Number', 'Sender Number', '3'),
(10, 'Clickatell', 'Your ClickAtell Username', 'Your ClickAtell Password', 'Your ClickAtell Api Id', NULL, NULL, '1', '', '', '', '4'),
(11, 'MSG91', 'Your MSG91 Username', NULL, 'Your MSG91 API ID', 'Sender Number', 'Your MSG91 Auth Key', '1', '', '', '', '4'),
(12, 'Twilio', NULL, NULL, NULL, NULL, NULL, '1', 'SID Number', 'Token Number', 'Sender Number', '4');

-- --------------------------------------------------------

--
-- Table structure for table `symptom`
--

CREATE TABLE `symptom` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `ion_user_id` varchar(255) NOT NULL,
  `hospital_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `symptom`
--

INSERT INTO `symptom` (`id`, `name`, `description`, `ion_user_id`, `hospital_id`) VALUES
(1, 'Headache', 'ache in the head', '11471', '1'),
(2, 'Daniel', 'Rpo3n2nfo24 nhjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjj', '2', '1'),
(3, '', '', '2', '1');

-- --------------------------------------------------------

--
-- Table structure for table `template`
--

CREATE TABLE `template` (
  `id` int(11) NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `template` varchar(10000) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `user` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `x` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `hospital_id` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `time_schedule`
--

CREATE TABLE `time_schedule` (
  `id` int(11) NOT NULL,
  `doctor` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `weekday` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `s_time` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `e_time` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `s_time_key` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `duration` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `hospital_id` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `time_slot`
--

CREATE TABLE `time_slot` (
  `id` int(11) NOT NULL,
  `doctor` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `s_time` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `e_time` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `weekday` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `s_time_key` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `hospital_id` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tutorials`
--

CREATE TABLE `tutorials` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `type` varchar(20) NOT NULL,
  `category` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tutorials`
--

INSERT INTO `tutorials` (`id`, `name`, `description`, `type`, `category`) VALUES
(1, '1. HMS USER GUIDE FOR DOCTORS (HOW TO LOGIN).pdf', '1. HMS USER GUIDE FOR DOCTORS (HOW TO LOGIN)', 'pdf', 'doctor'),
(2, '2. HMS USER GUIDE FOR DOCTORS (ABOUT THE SYSTEM)', '2. HMS USER GUIDE FOR DOCTORS (ABOUT THE SYSTEM)', 'pdf', 'doctor'),
(3, '3. HMS USER GUIDE FOR DOCTORS (USING THE CHAT FEATURE).pdf', 'USING THE CHAT FEATURE.pdf', 'pdf', 'doctor'),
(4, '4. HMS USER GUIDE FOR DOCTORS (PATIENT LIST).pdf', 'PATIENT LIST.pdf', 'pdf', 'doctor'),
(5, '5. HMS USER GUIDE FOR DOCTORS (SYMPTOMS MANAGER).pdf', 'SYMPTOMS MANAGER', 'pdf', 'doctor'),
(6, '6. HMS USER GUIDE FOR DOCTORS (VITALS).pdf', '6. HMS USER GUIDE FOR DOCTORS (VITALS).pdf', 'pdf', 'doctor'),
(7, '7. HMS USER GUIDE FOR DOCTORS (CONSULTATION).pdf', '7. HMS USER GUIDE FOR DOCTORS (CONSULTATION)', 'pdf', 'doctor'),
(8, '8. HMS USER GUIDE FOR DOCTORS (PAYMENT).pdf', '8. HMS USER GUIDE FOR DOCTORS (PAYMENT)', 'pdf', 'doctor'),
(9, '9. HMS USER GUIDE FOR DOCTORS (CASE LIST).pdf', '9. HMS USER GUIDE FOR DOCTORS (CASE LIST).pdf', 'pdf', 'doctor'),
(10, '10. HMS USER GUIDE FOR DOCTORS (CASE MANAGER).pdf', '10. HMS USER GUIDE FOR DOCTORS (CASE MANAGER).pdf', 'pdf', 'doctor'),
(11, '10. HMS USER GUIDE FOR DOCTORS (CASE MANAGER).pdf', '10. HMS USER GUIDE FOR DOCTORS (CASE MANAGER).pdf', 'pdf', 'doctor'),
(12, '11. HMS USER GUIDE FOR DOCTORS (DOCUMENTS).pdf', '11. HMS USER GUIDE FOR DOCTORS (DOCUMENTS).pdf', 'pdf', 'doctor'),
(13, '12. HMS USER GUIDE FOR DOCTORS (ALL SCHEDULE).pdf', '12. HMS USER GUIDE FOR DOCTORS (ALL SCHEDULE).pdf', 'pdf', 'doctor'),
(14, '14. HMS USER GUIDE FOR DOCTORS (ALL APPOINTMENT).pdf', '14. HMS USER GUIDE FOR DOCTORS (ALL APPOINTMENT).pdf', 'pdf', 'doctor'),
(15, '15. HMS USER GUIDE FOR DOCTORS (ADD APPOINTMENTS).pdf', '15. HMS USER GUIDE FOR DOCTORS (ADD APPOINTMENTS).pdf', 'pdf', 'doctor'),
(16, '16. HMS USER GUIDE FOR DOCTORS (TODAYS APPOINTMENT).pdf', '16. HMS USER GUIDE FOR DOCTORS (TODAYS APPOINTMENT).pdf', 'pdf', 'doctor'),
(17, '16. HMS USER GUIDE FOR DOCTORS (TODAYS APPOINTMENT).pdf', '16. HMS USER GUIDE FOR DOCTORS (TODAYS APPOINTMENT).pdf', 'pdf', 'doctor'),
(18, '17. HMS USER GUIDE FOR DOCTORS (UPCOMING APPOINTMENT).pdf', '17. HMS USER GUIDE FOR DOCTORS (UPCOMING APPOINTMENT).pdf', 'pdf', 'doctor'),
(19, '18. HMS USER GUIDE FOR DOCTORS (APPOINTMENT CALENDAR).pdf', '18. HMS USER GUIDE FOR DOCTORS (APPOINTMENT CALENDAR).pdf', 'pdf', 'doctor'),
(20, '19. HMS USER GUIDE FOR DOCTORS (REQUEST APPOINTMENT).pdf', '19. HMS USER GUIDE FOR DOCTORS (REQUEST APPOINTMENT).pdf', 'pdf', 'doctor'),
(21, '21. HMS USER GUIDE FOR DOCTORS (PRESCRIPTION).pdf', '21. HMS USER GUIDE FOR DOCTORS (PRESCRIPTION).pdf', 'pdf', 'doctor'),
(22, '22. HMS USER GUIDE FOR DOCTORS (REQUEST TEST).pdf', '22. HMS USER GUIDE FOR DOCTORS (REQUEST TEST).pdf', 'pdf', 'doctor'),
(23, '23. HMS USER GUIDE FOR DOCTORS (LAB REPORTS).pdf', '23. HMS USER GUIDE FOR DOCTORS (LAB REPORTS).pdf', 'pdf', 'doctor'),
(24, '24. HMS USER GUIDE FOR DOCTORS (TEMPLATE).pdf', '24. HMS USER GUIDE FOR DOCTORS (TEMPLATE).pdf', 'pdf', 'doctor'),
(25, '25. HMS USER GUIDE FOR DOCTORS (REPORTS).pdf', '25. HMS USER GUIDE FOR DOCTORS (REPORTS).pdf', 'pdf', 'doctor'),
(26, '27. HMS USER GUIDE FOR DOCTORS (PROFILE).pdf', '27. HMS USER GUIDE FOR DOCTORS (PROFILE).pdf', 'pdf', 'doctor'),
(28, 'Tutorial 3 - Schedule Feature.mp4', 'Schedule Feature.mp4', 'video', 'doctor'),
(29, 'Tutorial 2 - Chat Feature.mp4', 'Chat Feature.mp4', 'video', 'doctor'),
(30, 'Tutorial 1 - Dashboard.mp4', 'Dashboard.mp4', 'video', 'doctor');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(10) UNSIGNED DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(10) UNSIGNED NOT NULL,
  `last_login` int(10) UNSIGNED DEFAULT NULL,
  `active` tinyint(3) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `hospital_ion_id` varchar(100) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`, `hospital_ion_id`) VALUES
(1, '127.0.0.1', 'SuperAdmin', '$2y$08$HHToGIISTXxvdMtsIO4IIui2lZDaI7N3ef9cLLKy1M4zgv81kZRGS', '$2y$08$l2HQ5/vh6Jt77bBBEgMId.IKTObSYpqXcf6IvDOq43bbotNSG9CXG', 'superadmin@xerdocshms.com', NULL, 'eX0.Bq6nP57EuXX4hJkPHO973e7a4c25f1849d3a', 1511432365, 'zCeJpcj78CKqJ4sVxVbxcO', 1268889823, 1689124241, 1, 'Super', 'Admin', 'Xerdocs Technology', '0', ''),
(2, '127.0.0.1', 'Family Care Hospital', '$2y$08$aOU9juLyt0UnRojrLuN8eOM5I2.tUXttCzweMC8BB6hptAvP.S7te', NULL, 'fch@xerdocshms.com', NULL, NULL, NULL, NULL, 1634642140, 1697765969, 1, NULL, NULL, NULL, NULL, ''),
(751, '10.10.10.76', 'Test Doctor', '$2y$08$ehhf9vK8Of7YuYL34uhlAel7HT/IOG/afe1/cHebJOOs2MuEhFTyu', NULL, 'doctor@hms.com', NULL, NULL, NULL, NULL, 1562482389, 1682030820, 1, NULL, NULL, NULL, NULL, '2'),
(752, '10.10.10.76', 'Test Hospital', '$2y$08$ppTAefwA85lXDczWZKs2aetKZi1MWzZ3fUbCsjN8lVKjWH2Rin4FS', NULL, 'hospital@gmail.com', NULL, NULL, NULL, NULL, 1682328769, 1684625314, 0, NULL, NULL, NULL, NULL, ''),
(753, '10.10.10.76', 'doctor test', '$2y$08$DT/cfFbay8rD2uS1JjJlq.L6J/MQ6GpBmvj6wOvloiY51kGyTeT.K', NULL, 'testdoctor@hms.com', NULL, NULL, NULL, NULL, 1682328872, NULL, 0, NULL, NULL, NULL, NULL, '752'),
(754, '10.10.10.76', 'nurse', '$2y$08$7ns3cY4WFKrw6jEpaY7jlecxTNphiqB1aD1tMK1iwEaXSOclK/fx2', NULL, 'nurse@hms.com', NULL, NULL, NULL, NULL, 1682329051, NULL, 0, NULL, NULL, NULL, NULL, '752'),
(755, '10.10.10.76', 'pharmacist', '$2y$08$cJ99Dm/Z22z9Rfr/J22C6uzG58OyYyS3H/V4s1kJF2egPA0RrzqkW', NULL, 'pharmacist@hms.com', NULL, NULL, NULL, NULL, 1682329078, NULL, 0, NULL, NULL, NULL, NULL, '752'),
(756, '10.10.10.76', 'Laboratorist', '$2y$08$Wyo5TcYaTCM/kkADrGRCauq4/rkkdeyyrfrjepIlW5nz/Xjnm9EGC', NULL, 'Laboratorist@hms.com', NULL, NULL, NULL, NULL, 1682329104, NULL, 0, NULL, NULL, NULL, NULL, '752'),
(757, '10.10.10.76', 'Records Officer', '$2y$08$nBEMnhq1wnsO1AiGmpB37e8paSj/pyzvlIk.YqY0J7dHjr6ndLXQ6', NULL, 'RecordsOfficer@hms.com', NULL, NULL, NULL, NULL, 1682329135, NULL, 0, NULL, NULL, NULL, NULL, '752'),
(758, '10.10.10.76', 'Accountant', '$2y$08$ffnulq1URJffwLffwTpzF./X3W5C8.yd3vwtl1EIbxVwNhMrr7/dW', NULL, 'Accountant@hms.com', NULL, NULL, NULL, NULL, 1682329156, NULL, 0, NULL, NULL, NULL, NULL, '752'),
(759, '10.10.10.76', 'Receptionist', '$2y$08$kEMZdHKZovMerARvznDes.yU573g4gD3GLW7/k51KjzcwP/ItQoqm', NULL, 'Receptionist@hms.com', NULL, NULL, NULL, NULL, 1682329177, 1682329190, 0, NULL, NULL, NULL, NULL, '752'),
(760, '10.10.10.76', 'Ojomaikre Om', '$2y$08$YgHdz7H8tZ2kEyMeUNpUTO4cBlSRi/F6Oa85BBvWp2MsE7BLysy5W', NULL, 'ojom@xerdocs.com', NULL, NULL, NULL, NULL, 1682375820, 1682375889, 0, NULL, NULL, NULL, NULL, '752'),
(761, '10.10.10.76', 'Another Doc', '$2y$08$8dK6G0MHrZbedA8izawDPu58VQEcTE2xHttSF.mwNGes.lojmLMr.', NULL, 'anotherdoc@gmail.com', NULL, NULL, NULL, NULL, 1682889020, NULL, 0, NULL, NULL, NULL, NULL, '752'),
(762, '10.10.10.76', 'Chinemeze Akuh Hospital', '$2y$08$I1V1J1f619rOUAG8gE3PEeg82FO4Bh60bsSXClE2M0UJFoZbzXwza', NULL, 'neme@gmail.com', NULL, NULL, NULL, NULL, 1682972975, 1682973611, 1, NULL, NULL, NULL, NULL, ''),
(763, '10.10.10.76', 'Chinemeze Akuh Hospital1', '$2y$08$NBDWddbhUymygXL4yiu5NubIQvhbKujjqcyRRr6e0REXeQEmevSBG', NULL, 'akuh@xerdocs.com', NULL, NULL, NULL, NULL, 1682973236, 1682973336, 1, NULL, NULL, NULL, NULL, '762'),
(764, '10.10.10.76', 'Chris O', '$2y$08$gWSV5e0CQl69DcPvsfOZWuVBDGMbVTgAdSJrclvQDBYVGCI0DgW..', NULL, 'ogirri@gmail.com', NULL, NULL, NULL, NULL, 1682973498, 1682973519, 1, NULL, NULL, NULL, NULL, '762'),
(765, '10.10.10.76', 'Receptionist 1', '$2y$08$quBW0m1e/TGM9nnYmFSKCuvouOiLFBRjxggvNhnuoi3JXx08vcYpO', NULL, 'receptionist1@xerdocshms.com', NULL, NULL, NULL, NULL, 1685976937, 1694106362, 1, NULL, NULL, NULL, NULL, '2'),
(766, '10.10.10.76', 'Nurse 1', '$2y$08$h5GNU10ZUiREsuzoGKnHi.w2g87VjGBZQlvEMQu80S6RTpSITuGou', NULL, 'nurse1@xerdocshms.com', NULL, NULL, NULL, NULL, 1685977203, 1689455643, 1, NULL, NULL, NULL, NULL, '2'),
(767, '10.10.10.76', 'Doctor 2', '$2y$08$k/RNS6T4enk5zM.IMTUSKenMvzyy4igp.jrPJTj6iHQ4BMRs0ukbq', NULL, 'doctor2@demo.familycare.com', NULL, NULL, NULL, NULL, 1689123333, 1690119517, 1, NULL, NULL, NULL, NULL, '2'),
(768, '10.10.10.76', 'Laboratist 1', '$2y$08$FSP3zWp617aaye7Fl0GLn.X3i5PBp/NSMbhisPQgBmldWqq9iY5iG', NULL, 'lab1@demo.familycare.com', NULL, NULL, NULL, NULL, 1689123433, 1690117129, 1, NULL, NULL, NULL, NULL, '2'),
(769, '10.10.10.76', 'Pharma1', '$2y$08$3HBcvAuga0KRMqfmo/3YfeccdluE1E8l/2abaI/W/ojGzBYEl9kvK', NULL, 'pharm1@demo.familycare.com', NULL, NULL, NULL, NULL, 1689123487, 1690036531, 1, NULL, NULL, NULL, NULL, '2'),
(770, '10.10.10.76', 'Accountant 1', '$2y$08$cguUgf9SoB1wosRpB.XgEelDBITD8dwqtu22VUnbsjzi8UILADYf2', NULL, 'accounts@demo.familycare.com', NULL, NULL, NULL, NULL, 1689123583, 1689890671, 1, NULL, NULL, NULL, NULL, '2'),
(771, '10.10.10.76', 'Records Keeper 1', '$2y$08$4cYKLCl0rIG9kG1DDdR5euqVV8LxHAdweqaXux/6X3sTcgeLFsO.a', NULL, 'records@demo.familycare.com', NULL, NULL, NULL, NULL, 1689123643, 1689924327, 1, NULL, NULL, NULL, NULL, '2'),
(772, '10.10.10.76', 'SaveALife Hospital', '$2y$08$1evCPOBNAoiFLwP60oWvp.5JiSa1rSj98m1kw1mcfVYkAKi/n/Eka', NULL, 'admin@demo.savealife.com', NULL, NULL, NULL, NULL, 1689124369, 1693847624, 1, NULL, NULL, NULL, NULL, ''),
(773, '10.10.10.76', 'Nurse 11', '$2y$08$h0rYIoPhqHM7Lfw4sPZ6meXOhdF6Z6IBgfOGkFZxCTCZ45TJRbdtK', NULL, 'nurse1@demo.savealife.com', NULL, NULL, NULL, NULL, 1689124521, 1691955351, 1, NULL, NULL, NULL, NULL, '772'),
(774, '10.10.10.76', 'Receptionist 11', '$2y$08$DOoNTRB5rN2FmySbK.O.k.hSBBPsdhsx68o1qOTqT.0vnZ15HBXeC', NULL, 'receptionist1@demo.savealife.com', NULL, NULL, NULL, NULL, 1689124572, 1695755043, 1, NULL, NULL, NULL, NULL, '772'),
(775, '10.10.10.76', 'Doctor 1', '$2y$08$YnujPLGkOWqSRDMvfg9aSeWFCuvze3Zc8y1etQRYVimS69q2bemv6', NULL, 'doctor1@demo.savealife.com', NULL, NULL, NULL, NULL, 1689124639, 1697749832, 1, NULL, NULL, NULL, NULL, '772'),
(776, '10.10.10.76', 'Radiologist', '$2y$08$3LykphzXapYhNGRLtaQfne9R604zycxvX/GEqdVXwQcx5egieRkb2', NULL, 'radiologist1@demo.savealife.com', NULL, NULL, NULL, NULL, 1689124701, 1689125054, 1, NULL, NULL, NULL, NULL, '772'),
(777, '10.10.10.76', 'Lab 1', '$2y$08$AQD9GgiYUozTvmg50Rjt3e3daBQ9QT/XoTdnK9/hBkRxeXXa9PZf.', NULL, 'laboratist@demo.savealife.com', NULL, NULL, NULL, NULL, 1689124849, 1689524098, 1, NULL, NULL, NULL, NULL, '772'),
(778, '10.10.10.76', 'Pharma 1', '$2y$08$FEKcRo/esViivfMYKuoc8u.q7DOxUq7g75bDDG4NqPaoCHq2hK.MC', NULL, 'pharm1@demo.savealife.com', NULL, NULL, NULL, NULL, 1689124889, 1691955539, 1, NULL, NULL, NULL, NULL, '772'),
(779, '10.10.10.76', 'Accountant 11', '$2y$08$vyj/SQ2CPD.x4f6G6MFZAOIFO0N6semTksbDfWiqNHbdsTCLaNSE6', NULL, 'accounts@demo.savealife.com', NULL, NULL, NULL, NULL, 1689124939, 1694089598, 1, NULL, NULL, NULL, NULL, '772'),
(780, '10.10.10.76', 'Records 1', '$2y$08$yl2eq7ik6uEfc4wdRuhp/u7xRlQmHhO6g7YA2tZ/o3CDCkOJbihTm', NULL, 'records@demo.savealife.com', NULL, NULL, NULL, NULL, 1689125028, 1691955501, 1, NULL, NULL, NULL, NULL, '772'),
(781, '10.10.10.76', 'Doctor 11', '$2y$08$JZBgwC0a6V.d2GMYlvevnuy9RkaMYnuFo/WH4ylwNNcLnOclmnKpy', NULL, 'doctor1@demo.familycare.com', NULL, NULL, NULL, NULL, 1689125493, 1694434484, 1, NULL, NULL, NULL, NULL, '2'),
(782, '10.10.10.76', 'Daniel Ipogah', '$2y$08$kP9jzMoIQq7TAAAiZna03OjO0Qk9j8Dy1XQZnt9Ynco.yx6YmCrNS', NULL, 'daniel@demo.savealife.com', NULL, NULL, NULL, NULL, 1689252202, NULL, 1, NULL, NULL, NULL, NULL, '772'),
(783, '10.10.10.76', 'UCHE GOODNESS', '$2y$08$UTXIv/LLaS0Fr.FAdhLNnuy4FZEh7QlBbcIK.cWyuWx5efz.R/E/C', NULL, 'techteam@xerdocs.com', NULL, NULL, NULL, NULL, 1693947401, NULL, 1, NULL, NULL, NULL, NULL, '2'),
(784, '10.10.10.76', 'Adewale Adebayo', '0', NULL, '', NULL, NULL, NULL, NULL, 1694875120, NULL, 1, NULL, NULL, NULL, NULL, '2'),
(785, '10.10.10.76', 'Daniel Ipogah1', '$2y$08$grb.yUM7IGLMO4JyQUTD/.ImSlg8cfliDqoO3oYgfzJELHgbj85Q.', NULL, 'darnielipogah@gmail.com', NULL, NULL, NULL, NULL, 1697036117, NULL, 1, NULL, NULL, NULL, NULL, '2');

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(2, 2, 11),
(10, 751, 4),
(11, 752, 11),
(12, 753, 4),
(13, 754, 6),
(14, 755, 7),
(15, 756, 8),
(16, 757, 13),
(17, 758, 3),
(18, 759, 10),
(19, 760, 4),
(20, 761, 4),
(21, 762, 11),
(22, 763, 4),
(23, 764, 3),
(24, 765, 10),
(25, 766, 6),
(26, 767, 4),
(42, 767, 12),
(27, 768, 8),
(28, 769, 7),
(29, 770, 3),
(30, 771, 13),
(31, 772, 11),
(32, 773, 6),
(33, 774, 10),
(34, 775, 4),
(35, 776, 4),
(36, 776, 12),
(37, 777, 8),
(38, 778, 7),
(39, 779, 3),
(40, 780, 13),
(41, 781, 4),
(43, 782, 5),
(44, 783, 5),
(45, 784, 5),
(46, 785, 4);

-- --------------------------------------------------------

--
-- Table structure for table `vitals`
--

CREATE TABLE `vitals` (
  `id` int(11) NOT NULL,
  `patient_id` varchar(255) NOT NULL,
  `hospital_id` varchar(255) NOT NULL,
  `height` varchar(255) NOT NULL,
  `weight` varchar(255) NOT NULL,
  `bp` varchar(255) NOT NULL,
  `pulse` varchar(255) NOT NULL,
  `temperature` varchar(255) NOT NULL,
  `respiration` varchar(255) NOT NULL,
  `vitals_by` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vitals_appointment`
--

CREATE TABLE `vitals_appointment` (
  `id` int(11) NOT NULL,
  `nurse` varchar(255) NOT NULL,
  `patient_id` varchar(255) NOT NULL,
  `sent_by` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `vital_id` varchar(10) NOT NULL,
  `hospital_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `website_settings`
--

CREATE TABLE `website_settings` (
  `id` int(11) NOT NULL,
  `title` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `logo` varchar(1000) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `address` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `phone` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `emergency` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `support` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `currency` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `block_1_text_under_title` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `service_block__text_under_title` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `doctor_block__text_under_title` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `facebook_id` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `twitter_id` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `google_id` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `youtube_id` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `skype_id` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `x` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `twitter_username` varchar(1000) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accountant`
--
ALTER TABLE `accountant`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `allergy`
--
ALTER TABLE `allergy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `alloted_bed`
--
ALTER TABLE `alloted_bed`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `autoemailshortcode`
--
ALTER TABLE `autoemailshortcode`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `autoemailtemplate`
--
ALTER TABLE `autoemailtemplate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `autosmsshortcode`
--
ALTER TABLE `autosmsshortcode`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `autosmstemplate`
--
ALTER TABLE `autosmstemplate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bankb`
--
ALTER TABLE `bankb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bed`
--
ALTER TABLE `bed`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bedside_medicine`
--
ALTER TABLE `bedside_medicine`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bedside_note`
--
ALTER TABLE `bedside_note`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bed_category`
--
ALTER TABLE `bed_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `check_in`
--
ALTER TABLE `check_in`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `check_out`
--
ALTER TABLE `check_out`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `consultation`
--
ALTER TABLE `consultation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `conversation`
--
ALTER TABLE `conversation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `custom_vitals`
--
ALTER TABLE `custom_vitals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `c_patient`
--
ALTER TABLE `c_patient`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `diagnostic_report`
--
ALTER TABLE `diagnostic_report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `donor`
--
ALTER TABLE `donor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email`
--
ALTER TABLE `email`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_settings`
--
ALTER TABLE `email_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expense`
--
ALTER TABLE `expense`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expense_category`
--
ALTER TABLE `expense_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `featured`
--
ALTER TABLE `featured`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `form`
--
ALTER TABLE `form`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hmo`
--
ALTER TABLE `hmo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hmo_price`
--
ALTER TABLE `hmo_price`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hmo_sponsor`
--
ALTER TABLE `hmo_sponsor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `holidays`
--
ALTER TABLE `holidays`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hospital`
--
ALTER TABLE `hospital`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medicine`
--
ALTER TABLE `medicine`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medicine_category`
--
ALTER TABLE `medicine_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meeting`
--
ALTER TABLE `meeting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meeting_settings`
--
ALTER TABLE `meeting_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `module`
--
ALTER TABLE `module`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notice`
--
ALTER TABLE `notice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nurse`
--
ALTER TABLE `nurse`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `operations`
--
ALTER TABLE `operations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ot_payment`
--
ALTER TABLE `ot_payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `package`
--
ALTER TABLE `package`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient_deposit`
--
ALTER TABLE `patient_deposit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient_material`
--
ALTER TABLE `patient_material`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paymentgateway`
--
ALTER TABLE `paymentgateway`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_category`
--
ALTER TABLE `payment_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pharmacist`
--
ALTER TABLE `pharmacist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pharmacy_expense`
--
ALTER TABLE `pharmacy_expense`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pharmacy_expense_category`
--
ALTER TABLE `pharmacy_expense_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pharmacy_payment`
--
ALTER TABLE `pharmacy_payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pharmacy_payment_category`
--
ALTER TABLE `pharmacy_payment_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prescription`
--
ALTER TABLE `prescription`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `radiology`
--
ALTER TABLE `radiology`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `radio_history`
--
ALTER TABLE `radio_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `radio_images`
--
ALTER TABLE `radio_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rad_request`
--
ALTER TABLE `rad_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `receptionist`
--
ALTER TABLE `receptionist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `record_officer`
--
ALTER TABLE `record_officer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `request_link`
--
ALTER TABLE `request_link`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slide`
--
ALTER TABLE `slide`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms`
--
ALTER TABLE `sms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_settings`
--
ALTER TABLE `sms_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `symptom`
--
ALTER TABLE `symptom`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template`
--
ALTER TABLE `template`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `time_schedule`
--
ALTER TABLE `time_schedule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `time_slot`
--
ALTER TABLE `time_slot`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tutorials`
--
ALTER TABLE `tutorials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- Indexes for table `vitals`
--
ALTER TABLE `vitals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vitals_appointment`
--
ALTER TABLE `vitals_appointment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `website_settings`
--
ALTER TABLE `website_settings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accountant`
--
ALTER TABLE `accountant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `allergy`
--
ALTER TABLE `allergy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `alloted_bed`
--
ALTER TABLE `alloted_bed`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `autoemailshortcode`
--
ALTER TABLE `autoemailshortcode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `autoemailtemplate`
--
ALTER TABLE `autoemailtemplate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `autosmsshortcode`
--
ALTER TABLE `autosmsshortcode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `autosmstemplate`
--
ALTER TABLE `autosmstemplate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `bankb`
--
ALTER TABLE `bankb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=330;

--
-- AUTO_INCREMENT for table `bed`
--
ALTER TABLE `bed`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `bedside_medicine`
--
ALTER TABLE `bedside_medicine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bedside_note`
--
ALTER TABLE `bedside_note`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bed_category`
--
ALTER TABLE `bed_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `check_in`
--
ALTER TABLE `check_in`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `check_out`
--
ALTER TABLE `check_out`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `consultation`
--
ALTER TABLE `consultation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `conversation`
--
ALTER TABLE `conversation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `custom_vitals`
--
ALTER TABLE `custom_vitals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `c_patient`
--
ALTER TABLE `c_patient`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `diagnostic_report`
--
ALTER TABLE `diagnostic_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=159;

--
-- AUTO_INCREMENT for table `donor`
--
ALTER TABLE `donor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `email`
--
ALTER TABLE `email`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `email_settings`
--
ALTER TABLE `email_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `expense`
--
ALTER TABLE `expense`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `expense_category`
--
ALTER TABLE `expense_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `featured`
--
ALTER TABLE `featured`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `form`
--
ALTER TABLE `form`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=413;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `hmo`
--
ALTER TABLE `hmo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `hmo_price`
--
ALTER TABLE `hmo_price`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hmo_sponsor`
--
ALTER TABLE `hmo_sponsor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `holidays`
--
ALTER TABLE `holidays`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `hospital`
--
ALTER TABLE `hospital`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `medicine`
--
ALTER TABLE `medicine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `medicine_category`
--
ALTER TABLE `medicine_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `meeting`
--
ALTER TABLE `meeting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `meeting_settings`
--
ALTER TABLE `meeting_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `module`
--
ALTER TABLE `module`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notice`
--
ALTER TABLE `notice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nurse`
--
ALTER TABLE `nurse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `operations`
--
ALTER TABLE `operations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=262;

--
-- AUTO_INCREMENT for table `ot_payment`
--
ALTER TABLE `ot_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `package`
--
ALTER TABLE `package`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `patient_deposit`
--
ALTER TABLE `patient_deposit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `patient_material`
--
ALTER TABLE `patient_material`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `paymentgateway`
--
ALTER TABLE `paymentgateway`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `payment_category`
--
ALTER TABLE `payment_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=669;

--
-- AUTO_INCREMENT for table `pharmacist`
--
ALTER TABLE `pharmacist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pharmacy_expense`
--
ALTER TABLE `pharmacy_expense`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pharmacy_expense_category`
--
ALTER TABLE `pharmacy_expense_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pharmacy_payment`
--
ALTER TABLE `pharmacy_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pharmacy_payment_category`
--
ALTER TABLE `pharmacy_payment_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `prescription`
--
ALTER TABLE `prescription`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `radiology`
--
ALTER TABLE `radiology`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `radio_history`
--
ALTER TABLE `radio_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `radio_images`
--
ALTER TABLE `radio_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rad_request`
--
ALTER TABLE `rad_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `receptionist`
--
ALTER TABLE `receptionist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `record_officer`
--
ALTER TABLE `record_officer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `request_link`
--
ALTER TABLE `request_link`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `slide`
--
ALTER TABLE `slide`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sms`
--
ALTER TABLE `sms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sms_settings`
--
ALTER TABLE `sms_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `symptom`
--
ALTER TABLE `symptom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `template`
--
ALTER TABLE `template`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `time_schedule`
--
ALTER TABLE `time_schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `time_slot`
--
ALTER TABLE `time_slot`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tutorials`
--
ALTER TABLE `tutorials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=786;

--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `vitals`
--
ALTER TABLE `vitals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vitals_appointment`
--
ALTER TABLE `vitals_appointment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `website_settings`
--
ALTER TABLE `website_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
