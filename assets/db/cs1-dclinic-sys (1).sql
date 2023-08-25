-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 25, 2023 at 03:44 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cs1-dclinic-sys`
--

-- --------------------------------------------------------
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `appointment_booking`
--

CREATE TABLE `appointment_booking` (
  `id` int(11) NOT NULL,
  `transac_no` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `patient_name` varchar(255) NOT NULL,
  `procedures` varchar(100) NOT NULL,
  `session_time` varchar(50) NOT NULL,
  `session_date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointment_booking`
--

INSERT INTO `appointment_booking` (`id`, `transac_no`, `status`, `name`, `patient_name`, `procedures`, `session_time`, `session_date`) VALUES
(160, 'TR-27655', 'pending', 'Aira Esmenda', 'Aira Esmenda', 'Dental Implants', '8:00AM', '03/08/23 Thursday'),
(161, 'TR-52818', 'pending', 'Sample Patient101', 'Jezzyrel Sanchez', 'Teeth Cleaning', '9:00AM', '12/08/23 Saturday'),
(162, 'TR-42628', 'pending', 'Basti Victoria', 'Basti Victoria', 'Dental Fillings', '10:00AM', '12/08/23 Saturday');

-- --------------------------------------------------------

--
-- Table structure for table `booking_approved`
--

CREATE TABLE `booking_approved` (
  `id` int(11) NOT NULL,
  `transac_no` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `patient_name` varchar(255) NOT NULL,
  `procedures` varchar(255) NOT NULL,
  `session_time` varchar(50) NOT NULL,
  `session_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `booking_completed`
--

CREATE TABLE `booking_completed` (
  `id` int(11) NOT NULL,
  `transac_no` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `patient_name` varchar(255) NOT NULL,
  `procedures` varchar(255) NOT NULL,
  `session_time` varchar(50) NOT NULL,
  `session_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `booking_completed`
--

INSERT INTO `booking_completed` (`id`, `transac_no`, `status`, `name`, `patient_name`, `procedures`, `session_time`, `session_date`) VALUES
(4, 'TR-17982', 'Completed', 'Sample Patient101', 'Sample Patient101', 'Intervation', '9:00AM', '2026-07-23'),
(5, 'TR-65843', 'Completed', 'adrian makiling', 'Adrian Rodrigo Makiling', 'Intervation', '9:00AM', '2013-07-23');

-- --------------------------------------------------------

--
-- Table structure for table `booking_rejected`
--

CREATE TABLE `booking_rejected` (
  `id` int(11) NOT NULL,
  `transac_no` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `patient_name` varchar(25) NOT NULL,
  `procedures` varchar(255) NOT NULL,
  `session_time` varchar(50) NOT NULL,
  `session_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dental_doctors`
--

CREATE TABLE `dental_doctors` (
  `id` int(11) NOT NULL,
  `doctors_id` varchar(50) NOT NULL,
  `doctors_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `specialties` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dental_doctors`
--

INSERT INTO `dental_doctors` (`id`, `doctors_id`, `doctors_name`, `email`, `contact`, `specialties`) VALUES
(1, 'DD-NCYUP', 'Dentalsample1', 'dentalsample1@gmail.com', '09123456789', 'Periodontics'),
(2, 'DD-5FT5H', 'Dentalsample2', 'dentalsample2@gmail.com', '09234567891', 'General Dentist'),
(3, 'DD-XUNRK', 'Dentalsample3', 'dentalsample3@gmail.com', '09345678912', 'Orthodontics'),
(5, 'DD-XJMWK', 'Dr, Primo Esmenda', 'esmendaprimo@gmail.com', '09123456789', 'Dental Braces');

-- --------------------------------------------------------

--
-- Table structure for table `feedback_table`
--

CREATE TABLE `feedback_table` (
  `id` int(11) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `feedback` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `gcash_transac`
--

CREATE TABLE `gcash_transac` (
  `id` int(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `transac_no` varchar(255) NOT NULL,
  `imagedata` varchar(255) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gcash_transac`
--

INSERT INTO `gcash_transac` (`id`, `name`, `transac_no`, `imagedata`, `date`) VALUES
(1, 'adrian makiling', 'TR-77324', 'imagedata/Cotton Rolls.png', '2023-07-31'),
(2, 'adrian makiling', 'TR-77324', 'imagedata/Saliva Tips.png', '2023-07-31'),
(3, 'adrian makiling', 'TR-77324', 'imagedata/Cotton Rolls.png', '2023-07-31'),
(4, 'Aira Esmenda', 'TR-32006', 'imagedata/Saliva Tips.png', '2023-07-31'),
(5, 'Aira Esmenda', 'TR-27655', 'imagedata/Saliva Tips.png', '2023-07-31'),
(6, 'Sample Patient101', 'TR-52818', 'imagedata/Dental Gloves.jpg', '2023-07-31'),
(7, 'Basti Victoria', 'TR-42628', 'imagedata/Cotton Rolls.png', '2023-07-31');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `id` int(11) NOT NULL,
  `inv_id` varchar(50) NOT NULL,
  `imagedata` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `stocks` int(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`id`, `inv_id`, `imagedata`, `name`, `stocks`, `class`, `date`) VALUES
(1, 'INV-4BLV1', '../imagedata/Celluloid Strips.jpg', 'Celluloid Strips', 12, 'Supplies', '2023-07-20 10:23:00'),
(2, 'INV-997NX', '../imagedata/Microbrush Tips.png', 'Microbush Tips', 11, 'Supplies', '2023-07-20 10:23:00'),
(3, 'INV-RQ32G', '../imagedata/Pumice.png', 'Pumice', 10, 'Supplies', '2023-07-20 10:23:00'),
(4, 'INV-D5LUY', '../imagedata/Prophy Brush.png', 'Prophy Brush', 9, 'Supplies', '2023-07-20 10:23:00'),
(5, 'INV-M697K', '../imagedata/Composite.jpg', 'Composite', 8, 'Supplies', '2023-07-20 10:23:00'),
(6, 'INV-D19TY', '../imagedata/Bonding Agent.jpg', 'Bonding Agent', 7, 'Supplies', '2023-07-20 10:23:00'),
(7, 'INV-RP51I', '../imagedata/Alginate.png', 'Alginate', 6, 'Supplies', '2023-07-20 10:23:00'),
(8, 'INV-EHIZS', '../imagedata/Suction Tips.png', 'Suction', 15, 'Supplies', '2023-07-20 10:23:00'),
(9, 'INV-J6GT8', '../imagedata/Cotton Rolls.png', 'Cotton Rolls', 17, 'Supplies', '2023-07-20 10:23:00'),
(10, 'INV-FT1D6', '../imagedata/Saliva Tips.png', 'Saliva Tips ', 22, 'Supplies', '2023-07-20 10:23:00'),
(13, 'INV-OEUVL', '../imagedata/Plaster of paris.jpg', '  Plaster of paris', 4, '  Supplies', '2023-07-20 10:23:00');

-- --------------------------------------------------------

--
-- Table structure for table `manage_schedule`
--

CREATE TABLE `manage_schedule` (
  `id` int(50) NOT NULL,
  `slots` int(50) NOT NULL,
  `date` date NOT NULL,
  `session_date` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `manage_schedule`
--

INSERT INTO `manage_schedule` (`id`, `slots`, `date`, `session_date`, `start_time`, `end_time`, `status`) VALUES
(6, 7, '2023-07-19', '19/07/23 Wednesday', '08:00:00', '17:00:00', 'Open'),
(7, 4, '2023-08-03', '03/08/23 Thursday', '08:00:00', '12:30:00', 'Open'),
(8, 3, '2023-08-12', '12/08/23 Saturday', '08:00:00', '16:30:00', 'Open');

-- --------------------------------------------------------

--
-- Table structure for table `negative_feedback`
--

CREATE TABLE `negative_feedback` (
  `id` int(11) NOT NULL,
  `patient_name` varchar(255) NOT NULL,
  `feedback` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `neutral_feedback`
--

CREATE TABLE `neutral_feedback` (
  `id` int(11) NOT NULL,
  `patient_name` varchar(255) NOT NULL,
  `feedback` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `patient_list`
--

CREATE TABLE `patient_list` (
  `id` int(11) NOT NULL,
  `patient_id` varchar(255) NOT NULL,
  `patient_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patient_list`
--

INSERT INTO `patient_list` (`id`, `patient_id`, `patient_name`, `email`, `contact`, `date_of_birth`) VALUES
(1, 'PT-9SY7S', 'Patientsample1', 'patientsample1@gmail.com', '09123456789', '2000-01-12'),
(4, 'PT-ZVQ8V', 'Patientsample4', 'patientsample4@gmail.com', '09567891234', '2000-12-14'),
(6, 'PT-LFSZR', 'Angel Lacson Ajeda', 'lacsonajedaangel@gmail.com', '09561234567', '2001-02-07');

-- --------------------------------------------------------

--
-- Table structure for table `patient_transaction`
--

CREATE TABLE `patient_transaction` (
  `id` int(11) NOT NULL,
  `transac_no` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `patient_name` varchar(255) NOT NULL,
  `procedures` varchar(255) NOT NULL,
  `session_time` varchar(255) NOT NULL,
  `session_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patient_transaction`
--

INSERT INTO `patient_transaction` (`id`, `transac_no`, `status`, `name`, `patient_name`, `procedures`, `session_time`, `session_date`) VALUES
(8, 'TR-68537', 'Completed', 'adrian makiling', 'Adrian Rodrigo Makiling', 'Intervation', '9:00AM', '2013-07-23'),
(9, 'TR-57382', 'Completed', 'admin', 'jezzyrel sanchez', 'Teeth Whitening', '10:23 AM', '2023-07-20');

-- --------------------------------------------------------

--
-- Table structure for table `positive_feedback`
--

CREATE TABLE `positive_feedback` (
  `id` int(11) NOT NULL,
  `patient_name` varchar(255) NOT NULL,
  `feedback` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_logs`
--

CREATE TABLE `user_logs` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `time` time NOT NULL DEFAULT current_timestamp(),
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_logs`
--

INSERT INTO `user_logs` (`id`, `name`, `status`, `time`, `date`) VALUES
(1, 'Aira Esmenda', 'login', '06:15:00', '2023-07-25'),
(2, 'Aira Esmenda', 'logout', '18:16:16', '2023-07-25'),
(3, 'adrian makiling', 'login', '06:16:00', '2023-07-25'),
(4, 'adrian makiling', 'logout', '18:17:07', '2023-07-25'),
(5, 'Aira Esmenda', 'login', '06:17:00', '2023-07-25'),
(6, 'Mercedita Dalino', 'login', '06:20:00', '2023-07-25'),
(7, 'Aira Esmenda', 'login', '06:21:00', '2023-07-25'),
(8, 'Mercedita Dalino', 'login', '06:29:00', '2023-07-25'),
(9, 'adrian makiling', 'login', '06:30:00', '2023-07-25'),
(10, 'adrian makiling', 'logout', '18:30:42', '2023-07-25'),
(11, 'Aira Esmenda', 'login', '06:30:00', '2023-07-25'),
(12, 'Aira Esmenda', 'logout', '18:31:13', '2023-07-25'),
(13, 'Mercedita Dalino', 'login', '06:31:00', '2023-07-25'),
(14, 'adrian makiling', 'login', '06:36:00', '2023-07-25'),
(15, 'adrian makiling', 'logout', '18:36:55', '2023-07-25'),
(16, 'Mercedita Dalino', 'login', '06:37:00', '2023-07-25'),
(17, 'adrian makiling', 'login', '06:42:00', '2023-07-25'),
(18, 'adrian makiling', 'logout', '18:43:22', '2023-07-25'),
(19, 'adrian makiling', 'login', '06:47:00', '2023-07-25'),
(20, 'adrian makiling', 'logout', '18:51:23', '2023-07-25'),
(21, 'adrian makiling', 'login', '04:30:00', '2023-07-27'),
(22, 'Mercedita Dalino', 'login', '04:31:00', '2023-07-27'),
(23, 'adrian makiling', 'login', '04:32:00', '2023-07-27'),
(24, 'adrian makiling', 'login', '04:33:00', '2023-07-27'),
(25, 'adrian makiling', 'logout', '04:33:28', '2023-07-27'),
(26, 'Sample Patient101', 'login', '04:42:00', '2023-07-27'),
(27, 'Sample Patient101', 'logout', '04:50:25', '2023-07-27'),
(28, 'Mercedita Dalino', 'login', '04:50:00', '2023-07-27'),
(29, 'adrian makiling', 'login', '05:53:00', '2023-07-27'),
(30, 'adrian makiling', 'logout', '06:17:42', '2023-07-27'),
(31, 'Mercedita Dalino', 'login', '06:17:00', '2023-07-27'),
(32, 'adrian makiling', 'login', '01:02:00', '2023-07-27'),
(33, 'Aira Esmenda', 'login', '01:03:00', '2023-07-27'),
(34, 'Mercedita Dalino', 'login', '01:03:00', '2023-07-27'),
(35, 'Mercedita Dalino', 'login', '01:08:00', '2023-07-27'),
(36, 'adrian makiling', 'login', '01:20:00', '2023-07-27'),
(37, 'Sample Patient101', 'login', '01:20:00', '2023-07-27'),
(38, 'Sample Patient101', 'login', '01:21:00', '2023-07-27'),
(39, 'adrian makiling', 'login', '01:22:00', '2023-07-27'),
(40, 'adrian makiling', 'logout', '13:23:23', '2023-07-27'),
(41, 'Aira Esmenda', 'login', '01:23:00', '2023-07-27'),
(42, 'Mercedita Dalino', 'login', '01:27:00', '2023-07-27'),
(43, 'adrian makiling', 'login', '01:47:00', '2023-07-27'),
(44, 'Mercedita Dalino', 'login', '01:47:00', '2023-07-27'),
(45, 'adrian makiling', 'login', '02:04:00', '2023-07-27'),
(46, 'Mercedita Dalino', 'login', '02:05:00', '2023-07-27'),
(47, 'adrian makiling', 'login', '02:13:00', '2023-07-27'),
(48, 'Mercedita Dalino', 'login', '02:14:00', '2023-07-27'),
(49, 'adrian makiling', 'login', '02:18:00', '2023-07-27'),
(50, 'Mercedita Dalino', 'login', '02:18:00', '2023-07-27'),
(51, 'adrian makiling', 'login', '02:58:00', '2023-07-27'),
(52, 'adrian makiling', 'logout', '15:01:17', '2023-07-27'),
(53, 'Mercedita Dalino', 'login', '03:01:00', '2023-07-27'),
(54, 'adrian makiling', 'login', '04:55:00', '2023-07-27'),
(55, 'Aira Esmenda', 'login', '04:56:00', '2023-07-27'),
(56, 'Sample Patient101', 'login', '04:56:00', '2023-07-27'),
(57, 'Mercedita Dalino', 'login', '04:57:00', '2023-07-27'),
(58, 'Mercedita Dalino', 'login', '03:49:00', '2023-07-29'),
(59, 'Mercedita Dalino', 'login', '03:49:00', '2023-07-29'),
(60, '', 'login', '04:15:00', '2023-07-29'),
(61, 'Sample Patient101', 'login', '04:15:00', '2023-07-29'),
(62, 'Mercedita Dalino', 'login', '04:39:00', '2023-07-29'),
(63, 'adrian makiling', 'login', '04:51:00', '2023-07-29'),
(64, 'adrian makiling', 'login', '04:52:00', '2023-07-29'),
(65, 'adrian makiling', 'logout', '16:57:53', '2023-07-29'),
(66, 'Mercedita Dalino', 'login', '04:57:00', '2023-07-29'),
(67, 'adrian makiling', 'login', '05:01:00', '2023-07-29'),
(68, 'adrian makiling', 'logout', '17:02:03', '2023-07-29'),
(69, 'Mercedita Dalino', 'login', '05:02:00', '2023-07-29'),
(70, 'Mercedita Dalino', 'login', '05:02:00', '2023-07-29'),
(71, 'adrian makiling', 'login', '02:45:00', '2023-07-30'),
(72, 'Mercedita Dalino', 'login', '07:08:00', '2023-07-30'),
(73, 'Mercedita Dalino', 'login', '07:08:00', '2023-07-30'),
(74, 'adrian makiling', 'login', '07:11:00', '2023-07-30'),
(75, 'Mercedita Dalino', 'login', '07:11:00', '2023-07-30'),
(76, 'adrian makiling', 'login', '07:16:00', '2023-07-30'),
(77, 'Mercedita Dalino', 'login', '07:25:00', '2023-07-30'),
(78, 'adrian makiling', 'login', '07:27:00', '2023-07-30'),
(79, 'Mercedita Dalino', 'login', '07:32:00', '2023-07-30'),
(80, 'adrian makiling', 'login', '07:32:00', '2023-07-30'),
(81, 'adrian makiling', 'logout', '19:35:57', '2023-07-30'),
(82, 'adrian makiling', 'login', '04:26:00', '2023-07-31'),
(83, 'adrian makiling', 'logout', '04:27:17', '2023-07-31'),
(84, 'Mercedita Dalino', 'login', '04:27:00', '2023-07-31'),
(85, 'adrian makiling', 'login', '08:37:00', '2023-07-31'),
(86, 'Mercedita Dalino', 'login', '08:45:00', '2023-07-31'),
(87, 'adrian makiling', 'login', '08:46:00', '2023-07-31'),
(88, 'adrian makiling', 'logout', '09:42:12', '2023-07-31'),
(89, 'Mercedita Dalino', 'login', '09:42:00', '2023-07-31'),
(90, 'adrian makiling', 'login', '09:43:00', '2023-07-31'),
(91, 'Mercedita Dalino', 'login', '10:16:00', '2023-07-31'),
(92, 'adrian makiling', 'login', '10:16:00', '2023-07-31'),
(93, 'adrian makiling', 'logout', '10:23:55', '2023-07-31'),
(94, 'Mercedita Dalino', 'login', '10:23:00', '2023-07-31'),
(95, '', 'login', '10:25:00', '2023-07-31'),
(96, 'Aira Esmenda', 'login', '10:25:00', '2023-07-31'),
(97, 'Aira Esmenda', 'logout', '10:25:46', '2023-07-31'),
(98, 'Mercedita Dalino', 'login', '10:25:00', '2023-07-31'),
(99, 'Aira Esmenda', 'login', '10:26:00', '2023-07-31'),
(100, 'Aira Esmenda', 'logout', '10:27:14', '2023-07-31'),
(101, 'Mercedita Dalino', 'login', '10:27:00', '2023-07-31'),
(102, 'adrian makiling', 'login', '10:39:00', '2023-07-31'),
(103, 'adrian makiling', 'logout', '18:17:19', '2023-07-31'),
(104, 'Mercedita Dalino', 'login', '06:17:00', '2023-07-31'),
(105, 'adrian makiling', 'login', '06:18:00', '2023-07-31'),
(106, 'Mercedita Dalino', 'login', '06:18:00', '2023-07-31'),
(107, 'adrian makiling', 'login', '06:20:00', '2023-07-31'),
(108, 'Aira Esmenda', 'login', '06:20:00', '2023-07-31'),
(109, 'Aira Esmenda', 'login', '06:21:00', '2023-07-31'),
(110, 'Sample Patient101', 'login', '06:22:00', '2023-07-31'),
(111, 'Basti Victoria', 'login', '06:22:00', '2023-07-31'),
(112, 'Mercedita Dalino', 'login', '06:23:00', '2023-07-31');

-- --------------------------------------------------------

--
-- Table structure for table `user_registration`
--

CREATE TABLE `user_registration` (
  `id` int(50) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `verify_token` varchar(191) NOT NULL,
  `verify_status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=no, 1=yes',
  `password` varchar(50) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_registration`
--

INSERT INTO `user_registration` (`id`, `fullname`, `email`, `verify_token`, `verify_status`, `password`, `role`) VALUES
(3, 'Aira Esmenda', 'airaesmenda@gmail.com', '123as', 1, 'aira123', 'user'),
(17, 'adrian makiling', 'makilingadrian19@gmail.com', '9dcaa77ebc393561d5dfee84fa2f8a5a', 1, 'Ik@wl@ngb0w4', 'user'),
(18, 'Mercedita Dalino', 'dalinomercedita@gmail.com', '46fcbd05d19f4477b2fc425c1119fa5b', 1, 'Admin123', 'admin'),
(19, 'Sample Patient101', 'sanchez_jezzyrel@plpasig.edu.ph', '9dcaa00ebc3728361d5dfdd84fa2f8a5a', 1, 'Samplepatient101', 'user'),
(29, 'Basti Victoria', 'makilingadrian23@gmail.com', '2bc566a94803015b2eeb2973a4001991', 1, 'admin123', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_settings`
--
ALTER TABLE `admin_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointment_booking`
--
ALTER TABLE `appointment_booking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking_approved`
--
ALTER TABLE `booking_approved`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking_completed`
--
ALTER TABLE `booking_completed`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking_rejected`
--
ALTER TABLE `booking_rejected`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dental_doctors`
--
ALTER TABLE `dental_doctors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback_table`
--
ALTER TABLE `feedback_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gcash_transac`
--
ALTER TABLE `gcash_transac`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manage_schedule`
--
ALTER TABLE `manage_schedule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `negative_feedback`
--
ALTER TABLE `negative_feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `neutral_feedback`
--
ALTER TABLE `neutral_feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient_list`
--
ALTER TABLE `patient_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient_transaction`
--
ALTER TABLE `patient_transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `positive_feedback`
--
ALTER TABLE `positive_feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_logs`
--
ALTER TABLE `user_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_registration`
--
ALTER TABLE `user_registration`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_settings`
--
ALTER TABLE `admin_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `appointment_booking`
--
ALTER TABLE `appointment_booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=163;

--
-- AUTO_INCREMENT for table `booking_approved`
--
ALTER TABLE `booking_approved`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;

--
-- AUTO_INCREMENT for table `booking_completed`
--
ALTER TABLE `booking_completed`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `booking_rejected`
--
ALTER TABLE `booking_rejected`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT for table `dental_doctors`
--
ALTER TABLE `dental_doctors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `feedback_table`
--
ALTER TABLE `feedback_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gcash_transac`
--
ALTER TABLE `gcash_transac`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `manage_schedule`
--
ALTER TABLE `manage_schedule`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `negative_feedback`
--
ALTER TABLE `negative_feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `neutral_feedback`
--
ALTER TABLE `neutral_feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `patient_list`
--
ALTER TABLE `patient_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `patient_transaction`
--
ALTER TABLE `patient_transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `positive_feedback`
--
ALTER TABLE `positive_feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `user_logs`
--
ALTER TABLE `user_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `user_registration`
--
ALTER TABLE `user_registration`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
