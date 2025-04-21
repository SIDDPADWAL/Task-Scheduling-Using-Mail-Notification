-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 23, 2023 at 12:20 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `prj_task_scheduler_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `company_profile`
--

CREATE TABLE `company_profile` (
  `comp_id` int(9) NOT NULL,
  `comp_name` varchar(90) NOT NULL,
  `comp_tag_line` varchar(120) NOT NULL,
  `pro_pra_name` varchar(90) NOT NULL,
  `comp_add` varchar(90) NOT NULL,
  `comp_mob` varchar(13) NOT NULL,
  `comp_mob1` varchar(13) NOT NULL,
  `comp_web` varchar(120) NOT NULL,
  `uid` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company_profile`
--

INSERT INTO `company_profile` (`comp_id`, `comp_name`, `comp_tag_line`, `pro_pra_name`, `comp_add`, `comp_mob`, `comp_mob1`, `comp_web`, `uid`) VALUES
(1, 'bandima.org.au', 'Learning Management System', 'Raj Gunjal', 'Pune', '98090 80555', '98090 80555', 'contact@bandima.org.au', 1);

-- --------------------------------------------------------

--
-- Table structure for table `end_user`
--

CREATE TABLE `end_user` (
  `euid` int(9) NOT NULL,
  `euname` varchar(30) NOT NULL,
  `eumob` varchar(10) NOT NULL,
  `eupass` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `bdate` date NOT NULL,
  `gender` varchar(10) NOT NULL,
  `address` varchar(250) NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `euregdate` date NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `end_user`
--

INSERT INTO `end_user` (`euid`, `euname`, `eumob`, `eupass`, `email`, `bdate`, `gender`, `address`, `company_name`, `euregdate`, `status`) VALUES
(1, 'Zelos Infotech', '8888789402', '123', 'zelosinfotech@gmail.com', '2023-02-03', 'Male', 'Manchar', 'Zel', '2023-02-26', 1),
(9, '', '', '1234', 'zelosinfotech1@gmail.com', '0000-00-00', '', '', 'Zelos', '2023-04-19', 0),
(10, '', '', '123', 'admin7@gmail.com', '0000-00-00', '', '', 'Zelos', '2023-04-21', 2),
(11, '', '', '123', 'admin9@gmail.com', '0000-00-00', '', '', 'Zelos', '2023-04-21', 1),
(15, 'Subhan', '8888789402', '123', 'subhan.shaikh.786@gmail.com', '0000-00-00', '', '', '', '2023-04-23', 1);

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `slider_id` int(9) NOT NULL,
  `slider_name` varchar(100) NOT NULL,
  `imgpath` varchar(150) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `regdate` date NOT NULL,
  `uid` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`slider_id`, `slider_name`, `imgpath`, `status`, `regdate`, `uid`) VALUES
(1, 'Slider1', '/uploads/slider/1_20230415062706.jpg', 1, '2023-04-15', 1);

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `task_id` int(9) NOT NULL,
  `task_title` varchar(100) NOT NULL,
  `task_date` date NOT NULL,
  `task_time` time NOT NULL,
  `task_datetime` datetime NOT NULL,
  `task_status` tinyint(1) NOT NULL,
  `task_regdate` date NOT NULL,
  `euid` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`task_id`, `task_title`, `task_date`, `task_time`, `task_datetime`, `task_status`, `task_regdate`, `euid`) VALUES
(1, 'Sample Task', '2023-04-23', '00:20:23', '2023-04-23 09:17:18', 1, '2023-04-23', 1),
(2, 'qwe', '2023-04-24', '00:20:23', '2023-04-23 09:29:41', 1, '2023-04-23', 1),
(3, 'Sample Task', '2023-04-25', '00:20:23', '2023-04-23 09:45:25', 1, '2023-04-23', 15),
(4, 'Sample Task121', '2023-04-25', '09:15:12', '2023-04-25 09:15:12', 1, '2023-04-23', 15),
(5, 'asw', '2023-04-25', '20:10:00', '2023-04-25 20:10:00', 2, '2023-04-23', 15),
(6, 'Sample Task11', '2023-04-25', '15:00:00', '2023-04-23 14:46:00', 1, '2023-04-23', 15),
(7, 'Sample Demo', '2023-04-23', '15:45:00', '2023-04-23 15:45:00', 1, '2023-04-23', 15);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `uid` int(9) NOT NULL,
  `uname` varchar(45) NOT NULL,
  `pass` varchar(20) NOT NULL,
  `uregdate` datetime NOT NULL,
  `utype` int(9) NOT NULL,
  `ustatus` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`uid`, `uname`, `pass`, `uregdate`, `utype`, `ustatus`) VALUES
(1, 'admin', 'admin', '2023-02-08 00:00:00', 1, 1),
(23, 'Subhan', 'subhan', '2023-04-15 19:55:17', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `visitors`
--

CREATE TABLE `visitors` (
  `vid` int(9) NOT NULL,
  `ip` varchar(100) NOT NULL,
  `vdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `visitors`
--

INSERT INTO `visitors` (`vid`, `ip`, `vdate`) VALUES
(1, '::1', '2023-02-26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `company_profile`
--
ALTER TABLE `company_profile`
  ADD PRIMARY KEY (`comp_id`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `end_user`
--
ALTER TABLE `end_user`
  ADD PRIMARY KEY (`euid`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`slider_id`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`task_id`),
  ADD KEY `euid` (`euid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `visitors`
--
ALTER TABLE `visitors`
  ADD PRIMARY KEY (`vid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `company_profile`
--
ALTER TABLE `company_profile`
  MODIFY `comp_id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `end_user`
--
ALTER TABLE `end_user`
  MODIFY `euid` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `slider_id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `task_id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `uid` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `visitors`
--
ALTER TABLE `visitors`
  MODIFY `vid` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `company_profile`
--
ALTER TABLE `company_profile`
  ADD CONSTRAINT `company_profile_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
