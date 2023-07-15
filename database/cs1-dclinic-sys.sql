-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 15, 2023 at 08:29 AM
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

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `name`, `email`, `date`) VALUES
(1, 'Adrian Makiling', 'makiling_adrian19@gmail.com', '2023-07-14'),
(2, 'Adrian Rodrigo Makiling', 'makilingadrian19@gmail.com', '2023-07-21'),
(3, 'adrian makiling', 'adrian@gmail.com', '2023-07-20'),
(4, 'Aira Esmenda', 'EsmendaAira@gmail.com', '2023-07-19'),
(5, 'Adrian Rodrigo Makiling', 'makiling_adrian@plpasig.edu.ph', '2023-07-18'),
(6, 'Jezzyrel Sanchez', 'sanchez_jezzyrel@plpasig.edu.ph', '2023-07-27'),
(7, 'Jezzyrel Sanchez', 'sanchez_jezzyrel@plpasig.edu.ph', '2023-07-29'),
(8, 'Jezzyrel Sanchez', 'sanchez_jezzyrel@plpasig.edu.ph', '2023-07-29');

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
(17, 'adrian makiling', 'makilingadrian19@gmail.com', '9dcaa77ebc393561d5dfee84fa2f8a5a', 1, 'Ik@wl@ngb0w4', 'user'),
(18, 'Mercedita Dalino', 'dalinomercedita@gmail.com', '46fcbd05d19f4477b2fc425c1119fa5b', 1, 'Admin123', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
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
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_registration`
--
ALTER TABLE `user_registration`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
