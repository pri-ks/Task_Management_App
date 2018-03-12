-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 09, 2018 at 04:22 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `teamdm`
--

-- --------------------------------------------------------

--
-- Table structure for table `dmuser`
--

CREATE TABLE `dmuser` (
  `UserID` varchar(20) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `Email` varchar(200) NOT NULL,
  `UserRole` varchar(50) NOT NULL,
  `Activateflag` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dmuser`
--

INSERT INTO `dmuser` (`UserID`, `Username`, `Password`, `Email`, `UserRole`, `Activateflag`) VALUES
('123', 'superadmin', 'superadmin', '', 'Superadmin', 1),
('D32223', 'chinmay.j', 'chinmay', 'chinmay.j@media.net', 'Developer', 1),
('D6388', 'priyanka.sh', 'priyanka', 'priyanka.sh@media.net', 'Developer', 1),
('D6550', 'mayuri.k', 'mayuri', 'mayuri.k@media.net', 'Developer', 1),
('D9423', 'yuvraj.p', 'yuvraj', 'yuvraj.p@media.net', 'Developer', 1),
('E5657', 'aditya.di', 'aditya', 'aditya.di@media.net', 'Developer', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pausetask`
--

CREATE TABLE `pausetask` (
  `PauseID` int(11) NOT NULL,
  `TaskID` int(11) NOT NULL,
  `PauseStart` datetime NOT NULL,
  `PauseStop` datetime NOT NULL,
  `diff` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pausetask`
--

INSERT INTO `pausetask` (`PauseID`, `TaskID`, `PauseStart`, `PauseStop`, `diff`) VALUES
(1, 12, '2018-02-21 20:10:41', '2018-02-21 20:11:08', '00:00:27'),
(2, 4, '2018-02-22 20:37:29', '2018-02-22 20:37:58', '00:00:29'),
(3, 17, '2018-02-23 16:05:13', '2018-02-23 16:05:28', '00:00:15'),
(4, 24, '2018-02-27 15:54:30', '2018-02-27 16:11:26', '00:16:56'),
(5, 17, '2018-02-27 17:03:19', '0000-00-00 00:00:00', '00:00:00'),
(6, 25, '2018-03-06 19:38:30', '2018-03-06 19:38:43', '00:00:13'),
(7, 25, '2018-03-06 19:38:47', '2018-03-06 19:38:51', '00:00:04'),
(8, 25, '2018-03-06 21:32:49', '2018-03-06 21:32:53', '00:00:04');

-- --------------------------------------------------------

--
-- Table structure for table `taskdetails`
--

CREATE TABLE `taskdetails` (
  `TaskID` int(11) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `TaskName` varchar(50) NOT NULL,
  `TaskCategory` varchar(30) NOT NULL,
  `StartTime` time NOT NULL,
  `TaskDate` date NOT NULL,
  `DaysElapsed` smallint(6) NOT NULL DEFAULT '0',
  `TimeElapsed` time NOT NULL DEFAULT '00:00:00',
  `StopTime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `PauseCount` int(11) NOT NULL,
  `Counter` tinyint(1) NOT NULL DEFAULT '0',
  `Pauseflag` varchar(10) NOT NULL DEFAULT 'Pause',
  `Stopflag` tinyint(1) NOT NULL,
  `TodoLink` varchar(500) NOT NULL,
  `TaskStatus` varchar(20) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `taskdetails`
--

INSERT INTO `taskdetails` (`TaskID`, `Username`, `TaskName`, `TaskCategory`, `StartTime`, `TaskDate`, `DaysElapsed`, `TimeElapsed`, `StopTime`, `PauseCount`, `Counter`, `Pauseflag`, `Stopflag`, `TodoLink`, `TaskStatus`) VALUES
(1, 'aditya.di', 'Email-Tax Preparation-v2-Jan2017', 'Email Monetization', '13:01:11', '2018-01-02', 0, '00:00:00', '0000-00-00 00:00:00', 0, 0, 'Pause', 0, '', 'Active'),
(2, 'priyanka.sh', 'Email-Last Minute Gifts-v1-Dec17', 'Email Monetization', '18:54:48', '2018-02-13', 5, '20:50:12', '2018-02-19 15:45:01', 0, 0, 'Pause', 1, 'http://buypremiumdeals.com/?tpid=TV6PF4I', 'Completed'),
(4, 'priyanka.sh', 'Email-Gold IRA-v1-Dec17', 'Email Monetization', '15:24:58', '2018-01-19', 34, '05:12:30', '2018-02-21 21:01:26', 1, 0, 'Pause', 0, '', 'Active'),
(6, 'aditya.di', 'Email-Cell Phones-v1-Jan18', 'Email Monetization', '13:49:06', '2018-02-13', 0, '00:00:00', '0000-00-00 00:00:00', 0, 0, 'Pause', 0, 'http://buypremiumdeals.com/?tpid=TV6PF4I', 'Active'),
(9, 'priyanka.sh', 'mrlocal.com', 'General', '20:43:38', '2018-02-13', 5, '19:04:33', '2018-02-19 15:48:14', 0, 0, 'Pause', 1, 'http://buypremiumdeals.com/?tpid=TV6PF4I', 'Completed'),
(10, 'mayuri.k', 'Skenzo-Netsol BluBlack-5Ads', 'Skenzo', '15:04:14', '2018-02-16', 0, '00:00:00', '0000-00-00 00:00:00', 0, 0, 'Pause', 0, 'http://buypremiumdeals.com/?tpid=TV6PF4I', 'Active'),
(11, 'priyanka.sh', 'Skenzo-DarkPurple-5ads-RP-V1', 'Skenzo', '16:17:42', '2018-02-16', 2, '23:29:15', '2018-02-19 15:47:06', 0, 0, 'Pause', 1, 'http://buypremiumdeals.com/?tpid=TV6PF4I', 'Completed'),
(12, 'priyanka.sh', 'Email-CellPhone-V3-3ads-Large', 'Email Monetization', '18:37:03', '2018-02-19', 2, '01:33:37', '0000-00-00 00:00:00', 1, 0, 'Pause', 0, 'http://buypremiumdeals.com/?st=c491511299ed36a36a26f767917381df&dn=Deals&pid=5PO57Q473&q=amazon&maxa', 'Active'),
(14, 'yuvraj.p', 'Web.com-Hosting-UC-oct2016-v3', 'Skenzo', '14:30:24', '2018-02-22', 0, '00:00:00', '0000-00-00 00:00:00', 0, 0, 'Pause', 0, 'http://buypremiumdeals.com/?tpid=TL3Z7G5', 'Active'),
(15, 'mayuri.k', 'Email-Coffee Coupons-v2-Feb18', 'Email Monetization', '14:37:32', '2018-02-22', 0, '00:00:00', '0000-00-00 00:00:00', 0, 0, 'Pause', 0, 'http://psm/234624', 'Active'),
(16, 'chinmay.j', 'Email-Last Minute Gifts-v1-Feb17', 'Email Monetization', '15:58:01', '2018-02-22', 0, '00:00:00', '0000-00-00 00:00:00', 0, 0, 'Pause', 0, 'http://buypremiumdeals.com/?tpid=TV6PF4I', 'Active'),
(17, 'priyanka.sh', 'Email-Last Minute Gifts-v1-Dec17', 'Email Monetization', '13:52:30', '2018-02-23', 4, '03:10:46', '0000-00-00 00:00:00', 2, 1, 'Resume', 0, 'http://buypremiumdeals.com/?tpid=TV6PF4I', 'Halted'),
(18, 'yuvraj.p', 'SearchTemplate-Generic-v1-Feb18 (Lander)', 'Skenzo', '19:58:27', '2018-02-26', 2, '21:22:35', '2018-03-01 17:21:04', 0, 0, 'Pause', 1, 'http://universalfwding.com/?tpid=TR8XCY6', 'Completed'),
(19, 'chinmay.j', 'Email-Mattresses-v1-May2017-rating-SEEIT', 'Email Monetization', '20:03:02', '2018-02-26', 0, '00:00:00', '0000-00-00 00:00:00', 0, 0, 'Pause', 0, 'http://buypremiumdeals.com/?st=c491511299ed36a36a26f767917381df&dn=credits&pid=5PO57Q473&q=Cellphone', 'Active'),
(20, 'priyanka.sh', 'Email-Greek Vacations-v1-april2016-SEEIT', 'Email Monetization', '20:04:55', '2018-02-26', 0, '00:00:00', '0000-00-00 00:00:00', 0, 0, 'Pause', 0, 'http://buypremiumdeals.com/?tpid=T15XEQO', 'Active'),
(21, 'mayuri.k', 'Email-Mattresses-v2-May2017-rating-SEEIT', 'Email Monetization', '13:09:33', '2018-02-27', 0, '00:00:00', '0000-00-00 00:00:00', 0, 0, 'Pause', 0, 'http://buypremiumdeals.com/?st=c491511299ed36a36a26f767917381df&dn=credits&pid=5PO57Q473&q=Cellphones&maxads=5&tpid=TFLRI6W&_fwd_=1', 'Active'),
(23, 'priyanka.sh', 'Skenzo-LightPurple-5ads-v1-Feb18', 'Skenzo', '15:08:56', '2018-02-27', 0, '00:00:00', '0000-00-00 00:00:00', 0, 0, 'Pause', 0, 'http://buypremiumdeals.com/?tpid=TV6PF4I', 'Active'),
(24, 'priyanka.sh', 'Email-Last Minute Gifts-v1-Dec17', 'Email Monetization', '15:20:25', '2018-02-27', 0, '01:43:05', '2018-02-27 17:03:33', 1, 0, 'Pause', 1, 'http://buypremiumdeals.com/?tpid=TV6PF4I', 'Completed'),
(25, 'priyanka.sh', 'Email-Last Minute Gifts-v1-Dec17', 'Email Monetization', '14:32:38', '2018-02-28', 6, '06:59:55', '2018-03-06 21:32:56', 3, 0, 'Pause', 1, 'http://buypremiumdeals.com/?tpid=TV6PF4I', 'Completed'),
(26, 'chinmay.j', 'Email-Last Minute Gifts-v1-Dec17', 'Skenzo', '14:36:56', '2018-02-28', 0, '00:00:00', '0000-00-00 00:00:00', 0, 0, 'Pause', 0, 'http://buypremiumdeals.com/?tpid=TV6PF4I', 'Active'),
(27, 'chinmay.j', 'Email-Last Minute Gifts-v1-Dec17', 'Email Monetization', '14:37:02', '2018-02-28', 0, '00:00:00', '0000-00-00 00:00:00', 0, 0, 'Pause', 0, 'http://buypremiumdeals.com/?tpid=TV6PF4I', 'Active'),
(28, 'yuvraj.p', 'Email-TV-Internet_Phone-v2-Dec17', 'Email Monetization', '16:37:52', '2018-03-01', 0, '00:43:57', '2018-03-01 17:21:50', 0, 0, 'Pause', 1, 'http://buypremiumdeals.com/?tpid=TV6PF4I', 'Completed'),
(29, 'yuvraj.p', 'Email-Grocery Coupons-v1-July17', 'Email Monetization', '16:39:41', '2018-03-01', 0, '00:00:00', '0000-00-00 00:00:00', 0, 0, 'Pause', 0, 'http://buypremiumdeals.com/?tpid=TV6PF4I', 'Active'),
(30, 'aditya.di', 'Skenzo-Blavk-3ads-RP-V5', 'Skenzo', '18:46:12', '2018-03-01', 0, '00:00:34', '2018-03-01 18:46:49', 0, 0, 'Pause', 1, 'http://buypremiumdeals.com/?tpid=TV6PF4I', 'Completed'),
(31, 'aditya.di', 'Email-Vegas Vacations-v2-Dec17', 'Email Monetization', '18:52:30', '2018-03-01', 0, '00:00:16', '2018-03-01 18:52:48', 0, 0, 'Pause', 1, 'http://buypremiumdeals.com/?tpid=TV6PF4I', 'Completed'),
(32, 'priyanka.sh', 'Skenzo-Webcom-v1-Mar18', 'Skenzo', '18:25:50', '2018-03-08', 0, '22:18:09', '2018-03-09 16:44:01', 0, 0, 'Pause', 1, 'http://buypremiumdeals.com/?tpid=TV6PF4I', 'Completed'),
(33, 'priyanka.sh', 'Skenzo-DarkPurple-5ads-RP-V1', 'Skenzo', '16:33:33', '2018-03-09', 0, '00:00:00', '0000-00-00 00:00:00', 0, 0, 'Pause', 0, 'http://buypremiumdeals.com/?tpid=TV6PF4I', 'Active'),
(34, 'mayuri.k', 'Email-Last Minute Gifts-v1-Dec17', 'Email Monetization', '16:33:56', '2018-03-09', 0, '00:00:00', '0000-00-00 00:00:00', 0, 0, 'Pause', 0, 'http://buypremiumdeals.com/?tpid=TV6PF4I', 'Active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dmuser`
--
ALTER TABLE `dmuser`
  ADD PRIMARY KEY (`UserID`),
  ADD KEY `Username` (`Username`);

--
-- Indexes for table `pausetask`
--
ALTER TABLE `pausetask`
  ADD PRIMARY KEY (`PauseID`),
  ADD KEY `TaskID` (`TaskID`);

--
-- Indexes for table `taskdetails`
--
ALTER TABLE `taskdetails`
  ADD PRIMARY KEY (`TaskID`),
  ADD KEY `Username` (`Username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pausetask`
--
ALTER TABLE `pausetask`
  MODIFY `PauseID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `taskdetails`
--
ALTER TABLE `taskdetails`
  MODIFY `TaskID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `pausetask`
--
ALTER TABLE `pausetask`
  ADD CONSTRAINT `pausetask_ibfk_1` FOREIGN KEY (`TaskID`) REFERENCES `taskdetails` (`TaskID`);

--
-- Constraints for table `taskdetails`
--
ALTER TABLE `taskdetails`
  ADD CONSTRAINT `taskdetails_ibfk_1` FOREIGN KEY (`Username`) REFERENCES `dmuser` (`Username`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
