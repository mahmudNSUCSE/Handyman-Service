-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2021 at 06:58 PM
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
-- Database: `main_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `fullname` varchar(250) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `fullname`, `email`, `password`) VALUES
(1, 'Admin', 'admin@handyman.com', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `applied_post`
--

CREATE TABLE `applied_post` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `post_by` int(11) NOT NULL,
  `applied_by` int(11) NOT NULL,
  `applied_to` int(11) NOT NULL,
  `applied_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `customer_ck` varchar(3) NOT NULL DEFAULT 'no',
  `handyman_ck` varchar(3) NOT NULL DEFAULT 'no',
  `handyman_cf` tinyint(4) NOT NULL DEFAULT 0,
  `job_cf` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `applied_post`
--

INSERT INTO `applied_post` (`id`, `post_id`, `post_by`, `applied_by`, `applied_to`, `applied_time`, `customer_ck`, `handyman_ck`, `handyman_cf`, `job_cf`) VALUES
(13, 8, 1, 5, 1, '2021-04-30 02:26:35', 'yes', 'yes', 0, 0),
(14, 9, 10, 9, 10, '2021-04-30 03:05:48', 'yes', 'yes', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `handyman`
--

CREATE TABLE `handyman` (
  `id` int(11) NOT NULL,
  `h_id` int(11) NOT NULL,
  `prefer_job` text NOT NULL,
  `class` text NOT NULL,
  `medium` text NOT NULL,
  `prefer_location` text NOT NULL,
  `salary` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `handyman`
--

INSERT INTO `handyman` (`id`, `h_id`, `prefer_job`, `class`, `medium`, `prefer_location`, `salary`) VALUES
(5, 2, 'Electrician,AC mechanic', 'Expert', 'Home, Any', 'Khilkhet', '1000-3000'),
(11, 6, 'Gardener', 'Professional', 'Any', 'Banani,Gulsan', '2000-9000'),
(15, 5, 'Wall Painter, Tiles-Flooring', 'Semi-Expert', 'Home', 'Farmgate', '5000-7000'),
(17, 9, 'House Cleaner', 'Home', 'Any', 'Banani, Khilkhet, Uttara', '2000-3000');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `postby_id` int(11) NOT NULL,
  `jobs` text NOT NULL,
  `class` text NOT NULL,
  `medium` varchar(20) NOT NULL,
  `salary` varchar(50) NOT NULL,
  `location` text NOT NULL,
  `post_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deadline` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `postby_id`, `jobs`, `class`, `medium`, `salary`, `location`, `post_time`, `deadline`) VALUES
(2, 1, 'Gardener', 'Semi-Expert', 'Home', 'None', 'Khilkhet,Uttara', '2021-06-05 05:11:44', '07/17/2021'),
(3, 1, 'Electrician,AC mechanic', 'Office', 'Expert', '10000-15000', 'Banani,Dhaka,Bangladesh', '2021-05-09 11:36:07', '09/07/2021'),
(4, 1, 'Mobile repair,Electrician', 'Professional', 'Home', '2000-5000', 'Banani', '2021-01-09 22:28:42', '01/17/2021'),
(5, 1, 'Sanitary', 'Expert', 'Office', '1000-2000', 'Mirpur', '2021-01-10 23:17:25', '01/19/2021'),
(6, 1, 'Sanitary', 'Semi-Expert', 'Home', '1000-2000', 'Khilkhet,Banani, Mirpur, Uttara, BD', '2021-01-09 23:24:41', '02/14/2021'),
(7, 1, 'Floor repair', 'Professional', 'Home,Office', '10000-15000', 'Dhanmondi', '2021-06-28 04:23:31', '06/30/2021'),
(8, 1, 'Plumber,Sanitary', 'Amateur', 'Any', '2000-5000', 'Banani', '2021-11-29 23:03:02', '12/19/2021');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `fullname` varchar(150) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `email` varchar(40) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `address` varchar(200) NOT NULL DEFAULT '',
  `pass` varchar(50) NOT NULL,
  `confirmcode` varchar(7) NOT NULL,
  `activation` varchar(3) NOT NULL DEFAULT '',
  `type` varchar(10) NOT NULL,
  `user_pic` text DEFAULT NULL,
  `last_logout` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `online` varchar(5) NOT NULL DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `fullname`, `gender`, `email`, `phone`, `address`, `pass`, `confirmcode`, `activation`, `type`, `user_pic`, `last_logout`, `online`) VALUES
(1, 'customer', 'male', 'mahmud@gmail.com', '015976432566', 'Khilkhet, Dhaka, Bangladesh', 'e10adc3949ba59abbe56e057f20f883e', '205575', '', 'customer', '1543554432.png', '2021-04-30 00:11:19', 'no'),
(2, 'handyman', 'male', 'handyman@gmail.com', '014976432566', 'Banani, Dhaka, Bangladesh', '8d788385431273d11e8b43bb78f3aa41', '901358', '', 'handyman', '1515505450.jpg', '0000-00-00 00:00:00', 'yes'),
(5, 'handyman_1', 'female', 'handyman_1@gmail.com', '014976432566', '1,2 pacific home,Farmgate', '8d788385431273d11e8b43bb78f3aa41', '495196', '', 'handyman', '', '2021-04-30 02:45:02', 'no'),
(6, 'handyman_2', 'male', 'handyman_2@gmail.com', '014976432566', 'Badda', '8d788385431273d11e8b43bb78f3aa41', '292470', '', 'handyman', '1515558340.jpeg', '2021-05-01 20:39:17', 'no'),
(9, 'Test1', 'male', 'test1@gmail.com', '01216469093', 'Dhaka', 'e10adc3949ba59abbe56e057f20f883e', '214114', '', 'handyman', '1543568429.jpg', '2021-04-30 03:00:29', 'yes'),
(10, 'Mahmud customer', 'male', 'mahmud@gmail.com', '01788651991', 'Uttara', 'e10adc3949ba59abbe56e057f20f883e', '946363', '', 'customer', '1543568644.png', '2021-04-30 03:13:40', 'no');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `applied_post`
--
ALTER TABLE `applied_post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `handyman`
--
ALTER TABLE `handyman`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `applied_post`
--
ALTER TABLE `applied_post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `handyman`
--
ALTER TABLE `handyman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
