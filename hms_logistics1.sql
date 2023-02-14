-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 14, 2023 at 07:51 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hms_logistics1`
--

-- --------------------------------------------------------

--
-- Table structure for table `ccategory`
--

CREATE TABLE `ccategory` (
  `Ccategory_id` int(11) NOT NULL,
  `Category_Name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ccategory`
--

INSERT INTO `ccategory` (`Ccategory_id`, `Category_Name`) VALUES
(1, 'Building'),
(2, 'Machine');

-- --------------------------------------------------------

--
-- Table structure for table `contractors`
--

CREATE TABLE `contractors` (
  `Contractor_id` int(11) NOT NULL,
  `Contractor_Personnel` varchar(45) NOT NULL,
  `Contractor_Description` varchar(225) NOT NULL,
  `Contractor_CompanyName` varchar(225) NOT NULL,
  `Contractor_ContactNumber` varchar(45) NOT NULL,
  `Contractor_Email` varchar(45) NOT NULL,
  `Contractor_Address` varchar(225) NOT NULL,
  `Ccategory_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contractors`
--

INSERT INTO `contractors` (`Contractor_id`, `Contractor_Personnel`, `Contractor_Description`, `Contractor_CompanyName`, `Contractor_ContactNumber`, `Contractor_Email`, `Contractor_Address`, `Ccategory_id`) VALUES
(2, 'john doe', 'Foreman', 'Nova.inc', '09235486512', 'johndoe@gmail.com', 'Novaliches', 1),
(3, 'kirzin', 'asdasdw', 'qq', '123123', 'asdasd@gmail.com', 'wwweeqwe', 2);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `department_id` int(11) NOT NULL,
  `departmentName` varchar(45) NOT NULL,
  `departmentDescription` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`department_id`, `departmentName`, `departmentDescription`) VALUES
(1, 'Core-1', ''),
(2, 'Core-2', ''),
(3, 'Core-3', ''),
(4, 'Hr-1', ''),
(5, 'Hr-2', '');

-- --------------------------------------------------------

--
-- Table structure for table `inbound`
--

CREATE TABLE `inbound` (
  `Inbound_id` int(11) NOT NULL,
  `Inbound_DeliveryPersonnel` varchar(45) NOT NULL,
  `Inbound_Date` datetime NOT NULL,
  `Inbound_PersonnelReceive` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `inbounditems`
--

CREATE TABLE `inbounditems` (
  `id` int(11) NOT NULL,
  `WarehouseItem_id` int(11) NOT NULL,
  `Inbound_id` int(11) NOT NULL,
  `Inbound_Price` float NOT NULL,
  `Inbound_Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `itemcategory`
--

CREATE TABLE `itemcategory` (
  `ItemCategory_id` int(11) NOT NULL,
  `Category_Name` varchar(225) NOT NULL,
  `Category_Description` varchar(225) NOT NULL,
  `Category_Added` datetime NOT NULL,
  `Category_Modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `itemcategory`
--

INSERT INTO `itemcategory` (`ItemCategory_id`, `Category_Name`, `Category_Description`, `Category_Added`, `Category_Modified`) VALUES
(1, 'Machine', 'New Machine', '2023-01-04 15:29:13', '2023-01-04 14:30:06');

-- --------------------------------------------------------

--
-- Table structure for table `itemrequest`
--

CREATE TABLE `itemrequest` (
  `ItemRequest_id` int(11) NOT NULL,
  `Request_id` int(11) NOT NULL,
  `ItemRequest_Name` varchar(45) NOT NULL,
  `ItemRequest_Quantity` int(11) NOT NULL,
  `ItemRequest_Description` varchar(225) NOT NULL,
  `ItemRequest_Characteristic` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `itemrequest`
--

INSERT INTO `itemrequest` (`ItemRequest_id`, `Request_id`, `ItemRequest_Name`, `ItemRequest_Quantity`, `ItemRequest_Description`, `ItemRequest_Characteristic`) VALUES
(1, 3, 'Monitor', 50, '', ''),
(2, 3, 'Computer Mouse', 400, '', ''),
(3, 3, 'Speaker', 100, '', ''),
(4, 2, 'Table', 20, '', ''),
(5, 2, 'Chair', 40, '', ''),
(6, 2, 'Bed', 50, '', ''),
(7, 2, 'Sofa', 20, '', ''),
(8, 1, 'Tshirt', 100, '', ''),
(9, 1, 'Short', 100, '', ''),
(10, 1, 'Bed Sheets', 400, '', ''),
(11, 4, 'Painting', 40, '', ''),
(12, 4, 'Staircase', 20, '', ''),
(13, 4, 'Ceiling', 40, '', ''),
(14, 4, 'Roof', 20, '', ''),
(15, 5, 'Syringe', 5000, '', ''),
(16, 5, 'Oxygen Tank', 500, '', ''),
(17, 6, 'Headphone', 50, '', ''),
(18, 6, 'Printer', 50, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `Location_id` int(11) NOT NULL,
  `Location_Name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`Location_id`, `Location_Name`) VALUES
(1, 'Samp');

-- --------------------------------------------------------

--
-- Table structure for table `logistic1_log`
--

CREATE TABLE `logistic1_log` (
  `log_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `date_action` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `logistic1_log`
--

INSERT INTO `logistic1_log` (`log_id`, `user_id`, `description`, `date_action`) VALUES
(3, 3, 'Accepted the requisition form in procurement.', '2023-02-07 21:53:14'),
(4, 3, 'Accepted the requisition form in procurement.', '2023-02-07 22:09:50'),
(5, 3, 'Accepted the requisition form in procurement.', '2023-02-07 22:10:48'),
(6, 3, 'Accepted the requistion form in procurement.', '2023-02-07 22:13:51'),
(7, 3, 'Requested a budget for purchase requisition in procurement.', '2023-02-07 22:30:37'),
(8, 3, 'Requested a budget for purchase requisition in procurement.', '2023-02-08 18:53:59'),
(9, 3, 'Created a purchase order in procurement', '2023-02-08 19:29:23'),
(10, 3, 'Accepted the requistion form in procurement.', '2023-02-08 20:27:36'),
(11, 3, 'Requested a budget for purchase requisition in procurement.', '2023-02-08 20:28:03'),
(12, 3, 'Requested a budget for purchase requisition in procurement.', '2023-02-08 20:29:05'),
(13, 3, 'Accepted the requistion form in procurement.', '2023-02-11 20:16:14'),
(14, 3, 'Accepted the requistion form in procurement.', '2023-02-11 20:18:01'),
(15, 3, 'Accepted the requistion form in procurement.', '2023-02-11 20:18:32'),
(16, 3, 'Accepted the requistion form in procurement.', '2023-02-11 20:21:49'),
(17, 3, 'Requested a budget for purchase requisition in procurement.', '2023-02-11 20:22:15'),
(18, 3, 'Accepted the requistion form in procurement.', '2023-02-11 20:25:52'),
(19, 3, 'Accepted the requistion form in procurement.', '2023-02-11 20:27:04'),
(20, 3, 'Accepted the requistion form in procurement.', '2023-02-11 20:28:09'),
(21, 3, 'Accepted the requistion form in procurement.', '2023-02-11 20:28:43'),
(22, 3, 'Accepted the requistion form in procurement.', '2023-02-11 20:30:22'),
(23, 3, 'Accepted the requistion form in procurement.', '2023-02-11 20:31:20'),
(24, 3, 'Accepted the requistion form in procurement.', '2023-02-11 20:35:12'),
(25, 3, 'Accepted the requistion form in procurement.', '2023-02-11 20:37:10'),
(26, 3, 'Accepted the requistion form in procurement.', '2023-02-11 20:37:37'),
(27, 3, 'Accepted the requistion form in procurement.', '2023-02-11 20:37:41'),
(28, 3, 'Accepted the requistion form in procurement.', '2023-02-11 20:40:19'),
(29, 3, 'Accepted the requistion form in procurement.', '2023-02-11 20:40:56'),
(30, 3, 'Accepted the requistion form in procurement.', '2023-02-11 20:42:18'),
(31, 3, 'Accepted the requistion form in procurement.', '2023-02-11 20:43:18'),
(32, 3, 'Accepted the requistion form in procurement.', '2023-02-11 20:43:44'),
(33, 3, 'Accepted the requistion form in procurement.', '2023-02-11 20:45:18'),
(34, 3, 'Accepted the requistion form in procurement.', '2023-02-11 20:48:38'),
(35, 3, 'Accepted the requistion form in procurement.', '2023-02-11 20:49:35'),
(36, 3, 'Accepted the requistion form in procurement.', '2023-02-11 20:49:48'),
(37, 3, 'Accepted the requistion form in procurement.', '2023-02-11 20:51:16'),
(38, 3, 'Accepted the requistion form in procurement.', '2023-02-11 20:53:05'),
(39, 3, 'Requested a budget for purchase requisition in procurement.', '2023-02-11 20:56:07'),
(40, 3, 'Requested a vendor to vendor\'s portal', '2023-02-11 21:02:34'),
(41, 3, 'Requested a budget for purchase requisition in procurement.', '2023-02-11 21:16:10'),
(42, 3, 'Requested a budget for purchase requisition in procurement.', '2023-02-11 21:46:41'),
(43, 3, 'Requested a budget for purchase requisition in procurement.', '2023-02-11 21:52:07'),
(44, 3, 'Requested a budget for purchase requisition in procurement.', '2023-02-11 22:06:20'),
(45, 3, 'Requested a vendor to vendor\'s portal', '2023-02-11 22:14:57'),
(46, 3, 'Created a purchase order in procurement', '2023-02-11 22:15:28'),
(47, 3, 'Accepted the requistion form in procurement.', '2023-02-12 12:17:23'),
(48, 3, 'Generated a Report in Procurement', '2023-02-13 18:57:12'),
(51, 3, 'Generated a Report in Procurement', '2023-02-13 18:59:48'),
(52, 3, 'Generated a Report in Procurement', '2023-02-13 19:01:27'),
(53, 3, 'Generated a Report in Procurement', '2023-02-13 19:03:04'),
(54, 3, 'Generated a Report in Procurement', '2023-02-13 19:04:32'),
(55, 3, 'Generated a Report in Procurement', '2023-02-13 19:07:27'),
(56, 3, 'Generated a Report in Procurement', '2023-02-13 19:07:37'),
(57, 3, 'Generated a Report in Procurement', '2023-02-13 19:09:16'),
(58, 3, 'Generated a Report in Procurement', '2023-02-13 19:10:40'),
(59, 3, 'Generated a Report in Procurement', '2023-02-13 19:10:55'),
(60, 3, 'Generated a Report in Procurement', '2023-02-13 19:11:35'),
(61, 3, 'Generated a Report in Procurement', '2023-02-13 19:17:21'),
(62, 3, 'Generated a Report in Procurement', '2023-02-13 19:17:58'),
(63, 3, 'Generated a Report in Procurement', '2023-02-13 19:19:24'),
(64, 3, 'Generated a Report in Procurement', '2023-02-13 19:19:47'),
(65, 3, 'Generated a Report in Procurement', '2023-02-13 19:21:27'),
(66, 3, 'Generated a Report in Procurement', '2023-02-13 19:23:59'),
(67, 3, 'Generated a Report in Procurement', '2023-02-13 19:24:18'),
(68, 3, 'Generated a Report in Procurement', '2023-02-13 19:24:27'),
(69, 3, 'Generated a Report in Procurement', '2023-02-13 19:24:39'),
(70, 3, 'Generated a Report in Procurement', '2023-02-13 19:25:24'),
(71, 3, 'Generated a Report in Procurement', '2023-02-13 19:25:35'),
(72, 3, 'Generated a Report in Procurement', '2023-02-13 19:25:41'),
(73, 3, 'Generated a Report in Procurement', '2023-02-13 19:25:45'),
(74, 3, 'Generated a Report in Procurement', '2023-02-13 19:25:51'),
(75, 3, 'Generated a Report in Procurement', '2023-02-13 19:26:22'),
(76, 3, 'Generated a Report in Procurement', '2023-02-13 19:27:43'),
(77, 3, 'Generated a Report in Procurement', '2023-02-13 19:27:55'),
(78, 3, 'Generated a Report in Procurement', '2023-02-13 19:28:26'),
(79, 3, 'Generated a Report in Procurement', '2023-02-13 19:28:54'),
(80, 3, 'Generated a Report in Procurement', '2023-02-13 19:29:16'),
(81, 3, 'Generated a Report in Procurement', '2023-02-13 19:29:47'),
(82, 3, 'Generated a Report in Procurement', '2023-02-13 19:29:57'),
(83, 3, 'Generated a Report in Procurement', '2023-02-13 19:30:04'),
(84, 3, 'Generated a Report in Procurement', '2023-02-13 19:30:09'),
(85, 3, 'Generated a Report in Procurement', '2023-02-13 19:30:13'),
(86, 3, 'Generated a Report in Procurement', '2023-02-13 19:30:19'),
(87, 3, 'Generated a Report in Procurement', '2023-02-13 19:30:46'),
(88, 3, 'Generated a Report in Procurement', '2023-02-13 19:31:10'),
(89, 3, 'Generated a Report in Procurement', '2023-02-13 19:31:29'),
(90, 3, 'Generated a Report in Procurement', '2023-02-13 19:31:51'),
(91, 3, 'Generated a Report in Procurement', '2023-02-13 19:32:09'),
(92, 3, 'Generated a Report in Procurement', '2023-02-13 19:32:19'),
(93, 3, 'Generated a Report in Procurement', '2023-02-13 19:32:24'),
(94, 3, 'Generated a Report in Procurement', '2023-02-13 19:32:35'),
(95, 3, 'Generated a Report in Procurement', '2023-02-13 19:32:45'),
(96, 3, 'Generated a Report in Procurement', '2023-02-13 19:32:56'),
(97, 3, 'Generated a Report in Procurement', '2023-02-13 19:33:05'),
(98, 3, 'Generated a Report in Procurement', '2023-02-13 19:33:15'),
(99, 3, 'Generated a Report in Procurement', '2023-02-13 19:33:20'),
(100, 3, 'Generated a Report in Procurement', '2023-02-13 19:33:55'),
(101, 3, 'Generated a Report in Procurement', '2023-02-13 19:34:04'),
(102, 3, 'Generated a Report in Procurement', '2023-02-13 19:34:15'),
(103, 3, 'Generated a Report in Procurement', '2023-02-13 19:34:31'),
(104, 3, 'Generated a Report in Procurement', '2023-02-13 19:34:48'),
(105, 3, 'Generated a Report in Procurement', '2023-02-13 19:35:22'),
(106, 3, 'Generated a Report in Procurement', '2023-02-13 19:35:39'),
(107, 3, 'Generated a Report in Procurement', '2023-02-13 19:37:22'),
(108, 3, 'Accepted the requistion form in procurement.', '2023-02-13 20:09:40'),
(109, 3, 'Accepted the requistion form in procurement.', '2023-02-13 20:09:53'),
(110, 3, 'Accepted the requistion form in procurement.', '2023-02-13 20:13:25'),
(111, 3, 'Created a purchase order in procurement', '2023-02-13 20:31:12'),
(112, 3, 'Accepted the requistion form in procurement.', '2023-02-13 20:33:14'),
(113, 3, 'Requested a budget for purchase requisition in procurement.', '2023-02-13 20:37:08'),
(114, 3, 'Generated a Report in Procurement', '2023-02-13 20:37:54'),
(115, 3, 'Requested a vendor to vendor\'s portal', '2023-02-13 20:39:15'),
(116, 3, 'Created a purchase order in procurement', '2023-02-13 20:42:02'),
(117, 3, 'Created a purchase order in procurement', '2023-02-13 20:44:37'),
(118, 3, 'Created a purchase order in procurement', '2023-02-13 20:47:45'),
(119, 3, 'Generated a Report in Procurement', '2023-02-13 21:32:53'),
(120, 3, 'Generated a Report in Procurement', '2023-02-13 21:34:40'),
(121, 3, 'Accepted the requistion form in procurement.', '2023-02-13 21:54:35'),
(122, 3, 'Generated a Report in Procurement', '2023-02-13 21:56:28'),
(123, 3, 'Generated a Report in Procurement', '2023-02-13 21:57:28'),
(124, 3, 'Generated a Report in Procurement', '2023-02-13 21:58:30'),
(125, 3, 'Generated a Report in Procurement', '2023-02-13 22:50:52'),
(126, 3, 'Generated a Report in Procurement', '2023-02-13 23:15:06'),
(127, 3, 'Generated a Report in Procurement', '2023-02-13 23:15:19'),
(128, 3, 'Generated a Report in Procurement', '2023-02-13 23:19:24'),
(129, 3, 'Generated a Report in Procurement', '2023-02-13 23:19:48'),
(130, 3, 'Generated a Report in Procurement', '2023-02-13 23:19:55'),
(131, 3, 'Generated a Report in Procurement', '2023-02-13 23:20:00'),
(132, 3, 'Generated a Report in Procurement', '2023-02-13 23:20:14'),
(133, 3, 'Generated a Report in Procurement', '2023-02-13 23:20:20'),
(134, 3, 'Generated a Report in Procurement', '2023-02-13 23:20:25'),
(135, 3, 'Accepted the requistion form in procurement.', '2023-02-13 23:20:40'),
(136, 3, 'Generated a Report in Procurement', '2023-02-13 23:20:48'),
(137, 3, 'Generated a Report in Procurement', '2023-02-13 23:23:23'),
(138, 3, 'Generated a Report in Procurement', '2023-02-13 23:23:45'),
(139, 3, 'Requested a budget for purchase requisition in procurement.', '2023-02-13 23:25:52'),
(140, 3, 'Requested a budget for purchase requisition in procurement.', '2023-02-13 23:27:34'),
(141, 3, 'Generated a Report in Procurement', '2023-02-13 23:28:32'),
(142, 3, 'Requested a vendor to vendor\'s portal', '2023-02-13 23:28:55'),
(143, 3, 'Created a purchase order in procurement', '2023-02-13 23:31:16'),
(144, 3, 'Generated a Report in Procurement', '2023-02-13 23:41:32'),
(145, 3, 'Generated a Report in Procurement', '2023-02-14 06:22:23'),
(146, 3, 'Generated a Report in Procurement', '2023-02-14 06:45:13'),
(147, 3, 'Generated a Report in Procurement', '2023-02-14 14:23:31'),
(148, 3, 'Generated a Report in Procurement', '2023-02-14 14:26:04');

-- --------------------------------------------------------

--
-- Table structure for table `milestone`
--

CREATE TABLE `milestone` (
  `Milestone_id` int(11) NOT NULL,
  `Project_id` int(11) NOT NULL,
  `Milestone_Description` varchar(45) NOT NULL,
  `Milestone_Status` int(11) NOT NULL,
  `Milestone_startdate` date DEFAULT NULL,
  `Milestone_enddate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `milestone`
--

INSERT INTO `milestone` (`Milestone_id`, `Project_id`, `Milestone_Description`, `Milestone_Status`, `Milestone_startdate`, `Milestone_enddate`) VALUES
(2, 46, 'SAasAS', 11, '2023-01-18', '2023-01-31');

-- --------------------------------------------------------

--
-- Table structure for table `outbound`
--

CREATE TABLE `outbound` (
  `OutItem_id` int(11) NOT NULL,
  `Request_id` int(11) NOT NULL,
  `Outbound_Personnel` varchar(45) NOT NULL,
  `Outbound_Date` datetime NOT NULL,
  `Outbound_Address` varchar(225) NOT NULL,
  `Outbound_Driver` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `outbounditems`
--

CREATE TABLE `outbounditems` (
  `id` int(11) NOT NULL,
  `OutItem_id` int(11) NOT NULL,
  `WarehouseItem_id` int(11) NOT NULL,
  `OutItem_Quantity` int(11) NOT NULL,
  `OutItem_Characteristic` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `prequest`
--

CREATE TABLE `prequest` (
  `Prequest_id` int(11) NOT NULL,
  `Project_Requestor` varchar(45) NOT NULL,
  `Project_Name` varchar(45) NOT NULL,
  `Request_Date` date NOT NULL,
  `Request_Details` varchar(180) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `prequest`
--

INSERT INTO `prequest` (`Prequest_id`, `Project_Requestor`, `Project_Name`, `Request_Date`, `Request_Details`) VALUES
(1, 'John Doe', 'Pharmacy Building', '2022-12-11', 'Samp'),
(4, 'kirzin', 'haloo', '2022-12-30', 'haha'),
(22, 'hotdog', '7/11', '2023-01-24', 'bilihan'),
(23, 'hotdog', 'aaa', '2023-01-24', 'aa'),
(24, 'hotdogg', '7/11', '2023-01-24', 'hjghg'),
(25, 'GG', 'ww', '2023-01-24', 'aa'),
(26, 'adoo', '111', '2023-01-27', 'aaa');

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `Project_id` int(11) NOT NULL,
  `Prequest_id` int(11) NOT NULL,
  `Ccategory_id` int(11) NOT NULL,
  `Project_Name` varchar(45) NOT NULL,
  `Project_Status` varchar(45) NOT NULL,
  `Project_StartDate` datetime NOT NULL,
  `Project_EndDate` datetime NOT NULL,
  `Date_Added` datetime NOT NULL,
  `Project_Summary` varchar(225) NOT NULL,
  `Project_DesireOutcome` varchar(225) NOT NULL,
  `Project_ActionToCompletion` varchar(225) NOT NULL,
  `Project_Benefits` varchar(225) NOT NULL,
  `Project_Budget` float NOT NULL,
  `Project_AdditionalInfo` varchar(225) NOT NULL,
  `Project_Progress` int(11) NOT NULL,
  `Project_AR` varchar(45) NOT NULL,
  `Contractor_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`Project_id`, `Prequest_id`, `Ccategory_id`, `Project_Name`, `Project_Status`, `Project_StartDate`, `Project_EndDate`, `Date_Added`, `Project_Summary`, `Project_DesireOutcome`, `Project_ActionToCompletion`, `Project_Benefits`, `Project_Budget`, `Project_AdditionalInfo`, `Project_Progress`, `Project_AR`, `Contractor_id`) VALUES
(1, 1, 1, 'Hospital Office', 'ongoing', '2022-12-11 08:36:52', '2022-12-11 08:36:52', '2022-12-11 08:36:52', 'samp', 'samp', 'samp', 'samp', 1.11, 'samp', 1, 'accept', 2),
(39, 1, 1, 'Pharmacy', 'ongoing', '2022-11-11 00:00:00', '2022-01-01 00:00:00', '2022-12-11 00:00:00', 'asd', 'ddd', 'aaaa', 'aaa', 111, 'wwd', 1, 'accept', 2),
(40, 1, 1, 'Pharmacy', 'null', '2022-11-11 00:00:00', '2022-01-01 00:00:00', '2022-12-11 00:00:00', 'dasd', 'dda', '', 'aasd', 11, 'da', 1, 'accept', 2),
(41, 1, 1, 'Pharmacy', ' ', '2022-11-11 00:00:00', '2022-01-01 00:00:00', '2022-12-11 00:00:00', 'dasd', 'dda', '', 'aasd', 11, 'da', 1, 'accept', 2),
(42, 1, 1, 'Pharmacyettt', ' ', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2022-12-11 00:00:00', 'dasd', 'dda', 'dsdad', 'aasd', 11, 'da1', 1, 'accept', 2),
(46, 23, 1, 'aaa', ' ', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2023-01-24 00:00:00', 'aaaaaaaaaaaaaaaaaaa', 'aaaaa', 'aaa', 'aaaaa', 1111, 'aaa', 0, 'pending', 2),
(47, 4, 2, 'haloo', ' ', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2022-12-30 00:00:00', '', '', 'jhjh', 'jngjhg', 787, 'hbg', 0, 'pending', 3),
(48, 25, 2, 'ww', ' ', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2023-01-24 00:00:00', 'qqq', 'qqwe', 'qweq', 'asad', 1112, 'qwe', 0, 'pending', 2),
(49, 1, 2, 'Pharmacy', ' ', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2022-12-11 00:00:00', 'a', 'a', '', 'a', 111, 'a', 0, 'pending', 2),
(51, 26, 2, '111', ' ', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2023-01-27 00:00:00', 'a', 'a', 'aqa', 'aa', 1, 'aa', 0, 'pending', 3);

-- --------------------------------------------------------

--
-- Table structure for table `purchaseorder_details`
--

CREATE TABLE `purchaseorder_details` (
  `pod_id` int(11) NOT NULL,
  `po_id` int(11) NOT NULL,
  `pod_itemName` varchar(80) NOT NULL,
  `pod_itemDescription` varchar(500) NOT NULL,
  `pod_itemCharacteristic` varchar(500) NOT NULL,
  `pod_itemQuantity` int(11) NOT NULL,
  `pod_itemPrice` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchaseorder_details`
--

INSERT INTO `purchaseorder_details` (`pod_id`, `po_id`, `pod_itemName`, `pod_itemDescription`, `pod_itemCharacteristic`, `pod_itemQuantity`, `pod_itemPrice`) VALUES
(133, 75, 'Painting', '', '', 40, '500.00'),
(134, 75, 'Staircase', '', '', 20, '300.00'),
(135, 75, 'Ceiling', '', '', 40, '500.00'),
(136, 75, 'Roof', '', '', 20, '600.00'),
(137, 76, 'Table', '', '', 20, '0.00'),
(138, 76, 'Chair', '', '', 40, '233.00'),
(139, 76, 'Bed', '', '', 50, '677.00'),
(140, 76, 'Sofa', '', '', 20, '4455.00');

-- --------------------------------------------------------

--
-- Table structure for table `purchaserequest_details`
--

CREATE TABLE `purchaserequest_details` (
  `prd_id` int(11) NOT NULL,
  `pr_id` int(11) NOT NULL,
  `prd_itemName` varchar(80) NOT NULL,
  `prd_itemQuantity` int(11) NOT NULL,
  `prd_itemDescription` varchar(225) NOT NULL,
  `prd_itemCharacteristic` varchar(225) NOT NULL,
  `prd_itemBudget` decimal(10,2) NOT NULL,
  `prd_itemVendorPrice` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchaserequest_details`
--

INSERT INTO `purchaserequest_details` (`prd_id`, `pr_id`, `prd_itemName`, `prd_itemQuantity`, `prd_itemDescription`, `prd_itemCharacteristic`, `prd_itemBudget`, `prd_itemVendorPrice`) VALUES
(217, 80, 'Painting', 40, '', '', '500.00', '500.00'),
(218, 80, 'Staircase', 20, '', '', '300.00', '300.00'),
(219, 80, 'Ceiling', 40, '', '', '500.00', '500.00'),
(220, 80, 'Roof', 20, '', '', '600.00', '600.00'),
(221, 81, 'Tshirt', 100, '', '', '500.00', '0.00'),
(222, 81, 'Short', 100, '', '', '800.00', '0.00'),
(223, 81, 'Bed Sheets', 400, '', '', '2333.00', '0.00'),
(224, 82, 'Table', 20, '', '', '511.00', '511.00'),
(225, 82, 'Chair', 40, '', '', '233.00', '233.00'),
(226, 82, 'Bed', 50, '', '', '677.00', '677.00'),
(227, 82, 'Sofa', 20, '', '', '4455.00', '4455.00');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order`
--

CREATE TABLE `purchase_order` (
  `po_id` int(11) NOT NULL,
  `Request_id` int(11) NOT NULL,
  `Vendor_id` int(11) NOT NULL,
  `po_status` int(11) NOT NULL,
  `dateCreated` datetime NOT NULL,
  `po_notes` varchar(255) NOT NULL,
  `po_totalCost` decimal(7,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchase_order`
--

INSERT INTO `purchase_order` (`po_id`, `Request_id`, `Vendor_id`, `po_status`, `dateCreated`, `po_notes`, `po_totalCost`) VALUES
(75, 4, 1, 1, '2023-02-13 08:47:45', '', '0.00'),
(76, 2, 1, 1, '2023-02-13 11:31:16', 'tes', '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_request`
--

CREATE TABLE `purchase_request` (
  `pr_id` int(11) NOT NULL,
  `Request_id` int(11) NOT NULL,
  `Vendor_id` int(11) DEFAULT NULL,
  `pr_reviewedBy` varchar(80) NOT NULL,
  `budgetadditional_notes` varchar(1000) NOT NULL,
  `vendoradditional_notes` varchar(1000) NOT NULL,
  `request_vendorStatus` int(11) NOT NULL,
  `request_budgetStatus` int(11) NOT NULL,
  `pr_dateCreated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchase_request`
--

INSERT INTO `purchase_request` (`pr_id`, `Request_id`, `Vendor_id`, `pr_reviewedBy`, `budgetadditional_notes`, `vendoradditional_notes`, `request_vendorStatus`, `request_budgetStatus`, `pr_dateCreated`) VALUES
(80, 4, 1, 'Vaun Barcelo', 'pa accept lods', 'hanapan mo ako ng same price pero maganda ang quality sheesh', 5, 4, '2023-02-13 08:33:14'),
(81, 1, NULL, 'Vaun Barcelo', 'test', '', 0, 3, '2023-02-13 09:54:35'),
(82, 2, 1, 'Vaun Barcelo', 'testt', '', 5, 4, '2023-02-13 11:20:40');

-- --------------------------------------------------------

--
-- Table structure for table `rejectionnote`
--

CREATE TABLE `rejectionnote` (
  `Note_id` int(11) NOT NULL,
  `Project_id` int(11) NOT NULL,
  `Note_Description` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rejectionnote`
--

INSERT INTO `rejectionnote` (`Note_id`, `Project_id`, `Note_Description`) VALUES
(1, 46, 'jkhkhj'),
(2, 40, 'hgfhfgfgh');

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `Request_id` int(11) NOT NULL,
  `Item_Requestor` varchar(45) NOT NULL,
  `department_id` int(11) NOT NULL,
  `Request_Date` date NOT NULL,
  `Request_Message` varchar(225) NOT NULL,
  `Request_Approval` int(11) NOT NULL,
  `ProcessedBy` varchar(125) NOT NULL,
  `dateSubmitted` datetime NOT NULL,
  `Request_Status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`Request_id`, `Item_Requestor`, `department_id`, `Request_Date`, `Request_Message`, `Request_Approval`, `ProcessedBy`, `dateSubmitted`, `Request_Status`) VALUES
(1, 'Mark Allen Regino', 1, '2023-02-10', '', 1, 'Johnloyd Aganan', '2023-02-07 07:37:59', 2),
(2, 'Jhamir Tacusalme', 5, '2023-02-16', '', 1, 'Johnloyd Aganan', '2023-02-07 07:38:41', 3),
(3, 'Shigeo Kageyama', 3, '2023-03-15', '', 1, 'Johnloyd Aganan', '2023-02-07 07:39:24', 0),
(4, 'Leonard German', 1, '2023-03-10', '', 1, 'Johnloyd Aganan', '2023-02-07 07:39:57', 3),
(5, 'Claud', 2, '2023-04-13', '', 1, 'Johnloyd Aganan', '2023-02-07 07:40:33', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_table`
--

CREATE TABLE `user_table` (
  `user_id` int(11) NOT NULL,
  `department_id` int(11) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `middlename` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL,
  `date_joined` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_table`
--

INSERT INTO `user_table` (`user_id`, `department_id`, `username`, `password`, `firstname`, `middlename`, `lastname`, `user_type`, `date_joined`) VALUES
(3, 1, 'vbarcelo123', '123', 'Vaun Ervin', 'Calag', 'Barcelo', 'PROCUREMENT MANAGER', '2023-02-07 15:53:36'),
(4, 3, 'blob6', '123', 'blob', 'blob', 'blob', 'PROJECT MANAGER', '2023-02-07 21:26:00');

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `Vendor_id` int(11) NOT NULL,
  `vendor_fname` varchar(80) NOT NULL,
  `vendor_mname` varchar(80) NOT NULL,
  `vendor_lname` varchar(80) NOT NULL,
  `vendor_email` varchar(80) NOT NULL,
  `vendor_contact` varchar(80) NOT NULL,
  `vendor_address` varchar(1000) NOT NULL,
  `vendor_dateAdded` datetime NOT NULL,
  `vendor_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`Vendor_id`, `vendor_fname`, `vendor_mname`, `vendor_lname`, `vendor_email`, `vendor_contact`, `vendor_address`, `vendor_dateAdded`, `vendor_status`) VALUES
(1, 'Cecilia ', '', 'Chapman', 'ceciliachapman@gmail.com', '(257) 563-7401', '711-2880 Nulla St.\r\nMankato Mississippi 96522', '2023-01-31 17:01:13', 1);

-- --------------------------------------------------------

--
-- Table structure for table `warehouseitem`
--

CREATE TABLE `warehouseitem` (
  `WarehouseItem_id` int(11) NOT NULL,
  `ItemCategory_id` int(11) NOT NULL,
  `Location_id` int(11) NOT NULL,
  `Item_Name` varchar(45) NOT NULL,
  `Item_Price` float NOT NULL,
  `Item_DepreciateValue` float NOT NULL,
  `Item_DepreciatePrice` float NOT NULL,
  `Item_Description` varchar(225) NOT NULL,
  `Item_Characteristic` varchar(225) NOT NULL,
  `Item_Quantity` int(11) NOT NULL,
  `Item_Location` int(11) NOT NULL,
  `Date_Modify` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `warehouseitem`
--

INSERT INTO `warehouseitem` (`WarehouseItem_id`, `ItemCategory_id`, `Location_id`, `Item_Name`, `Item_Price`, `Item_DepreciateValue`, `Item_DepreciatePrice`, `Item_Description`, `Item_Characteristic`, `Item_Quantity`, `Item_Location`, `Date_Modify`) VALUES
(1, 1, 1, 'PC', 5000, 4000, 3000, 'i5', 'New', 1, 1, '2023-01-04 14:32:05'),
(2, 1, 1, 'MOUSE', 100, 100, 20, 'MECH', 'NEW', 11, 1, '2023-01-04 15:24:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ccategory`
--
ALTER TABLE `ccategory`
  ADD PRIMARY KEY (`Ccategory_id`);

--
-- Indexes for table `contractors`
--
ALTER TABLE `contractors`
  ADD PRIMARY KEY (`Contractor_id`),
  ADD KEY `Ccategory_id` (`Ccategory_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `inbound`
--
ALTER TABLE `inbound`
  ADD PRIMARY KEY (`Inbound_id`);

--
-- Indexes for table `inbounditems`
--
ALTER TABLE `inbounditems`
  ADD PRIMARY KEY (`id`),
  ADD KEY `WarehouseItem_id` (`WarehouseItem_id`),
  ADD KEY `Inbound_id` (`Inbound_id`);

--
-- Indexes for table `itemcategory`
--
ALTER TABLE `itemcategory`
  ADD PRIMARY KEY (`ItemCategory_id`);

--
-- Indexes for table `itemrequest`
--
ALTER TABLE `itemrequest`
  ADD PRIMARY KEY (`ItemRequest_id`),
  ADD KEY `Request_id` (`Request_id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`Location_id`);

--
-- Indexes for table `logistic1_log`
--
ALTER TABLE `logistic1_log`
  ADD PRIMARY KEY (`log_id`),
  ADD KEY `logistic1_log_ibfk_1` (`user_id`);

--
-- Indexes for table `milestone`
--
ALTER TABLE `milestone`
  ADD PRIMARY KEY (`Milestone_id`),
  ADD KEY `Project_id` (`Project_id`);

--
-- Indexes for table `outbound`
--
ALTER TABLE `outbound`
  ADD PRIMARY KEY (`OutItem_id`),
  ADD KEY `Request_id` (`Request_id`);

--
-- Indexes for table `outbounditems`
--
ALTER TABLE `outbounditems`
  ADD PRIMARY KEY (`id`),
  ADD KEY `WarehouseItem_id` (`WarehouseItem_id`),
  ADD KEY `OutItem_id` (`OutItem_id`);

--
-- Indexes for table `prequest`
--
ALTER TABLE `prequest`
  ADD PRIMARY KEY (`Prequest_id`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`Project_id`),
  ADD KEY `Prequest_id` (`Prequest_id`),
  ADD KEY `Category_id` (`Ccategory_id`),
  ADD KEY `Contractor_id` (`Contractor_id`);

--
-- Indexes for table `purchaseorder_details`
--
ALTER TABLE `purchaseorder_details`
  ADD PRIMARY KEY (`pod_id`),
  ADD KEY `purchaseorder_details_ibfk_1` (`po_id`);

--
-- Indexes for table `purchaserequest_details`
--
ALTER TABLE `purchaserequest_details`
  ADD PRIMARY KEY (`prd_id`),
  ADD KEY `purchaserequest_details_ibfk_1` (`pr_id`);

--
-- Indexes for table `purchase_order`
--
ALTER TABLE `purchase_order`
  ADD PRIMARY KEY (`po_id`),
  ADD KEY `Request_id` (`Request_id`),
  ADD KEY `Vendor_id` (`Vendor_id`);

--
-- Indexes for table `purchase_request`
--
ALTER TABLE `purchase_request`
  ADD PRIMARY KEY (`pr_id`),
  ADD KEY `Request_id` (`Request_id`),
  ADD KEY `Vendor_id` (`Vendor_id`);

--
-- Indexes for table `rejectionnote`
--
ALTER TABLE `rejectionnote`
  ADD PRIMARY KEY (`Note_id`),
  ADD KEY `Project_id` (`Project_id`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`Request_id`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `user_table`
--
ALTER TABLE `user_table`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`Vendor_id`);

--
-- Indexes for table `warehouseitem`
--
ALTER TABLE `warehouseitem`
  ADD PRIMARY KEY (`WarehouseItem_id`),
  ADD KEY `ItemCategory_id` (`ItemCategory_id`),
  ADD KEY `Location_id` (`Location_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ccategory`
--
ALTER TABLE `ccategory`
  MODIFY `Ccategory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `contractors`
--
ALTER TABLE `contractors`
  MODIFY `Contractor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `inbound`
--
ALTER TABLE `inbound`
  MODIFY `Inbound_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inbounditems`
--
ALTER TABLE `inbounditems`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `itemrequest`
--
ALTER TABLE `itemrequest`
  MODIFY `ItemRequest_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `Location_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `logistic1_log`
--
ALTER TABLE `logistic1_log`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=149;

--
-- AUTO_INCREMENT for table `milestone`
--
ALTER TABLE `milestone`
  MODIFY `Milestone_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `outbound`
--
ALTER TABLE `outbound`
  MODIFY `OutItem_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `outbounditems`
--
ALTER TABLE `outbounditems`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `prequest`
--
ALTER TABLE `prequest`
  MODIFY `Prequest_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `Project_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `purchaseorder_details`
--
ALTER TABLE `purchaseorder_details`
  MODIFY `pod_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;

--
-- AUTO_INCREMENT for table `purchaserequest_details`
--
ALTER TABLE `purchaserequest_details`
  MODIFY `prd_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=228;

--
-- AUTO_INCREMENT for table `purchase_order`
--
ALTER TABLE `purchase_order`
  MODIFY `po_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `purchase_request`
--
ALTER TABLE `purchase_request`
  MODIFY `pr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `rejectionnote`
--
ALTER TABLE `rejectionnote`
  MODIFY `Note_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `Request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_table`
--
ALTER TABLE `user_table`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `Vendor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `warehouseitem`
--
ALTER TABLE `warehouseitem`
  MODIFY `WarehouseItem_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `contractors`
--
ALTER TABLE `contractors`
  ADD CONSTRAINT `contractors_ibfk_1` FOREIGN KEY (`Ccategory_id`) REFERENCES `ccategory` (`Ccategory_id`) ON UPDATE CASCADE;

--
-- Constraints for table `inbounditems`
--
ALTER TABLE `inbounditems`
  ADD CONSTRAINT `inbounditems_ibfk_1` FOREIGN KEY (`WarehouseItem_id`) REFERENCES `warehouseitem` (`WarehouseItem_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `inbounditems_ibfk_2` FOREIGN KEY (`Inbound_id`) REFERENCES `inbound` (`Inbound_id`);

--
-- Constraints for table `itemrequest`
--
ALTER TABLE `itemrequest`
  ADD CONSTRAINT `itemrequest_ibfk_1` FOREIGN KEY (`Request_id`) REFERENCES `request` (`Request_id`) ON UPDATE CASCADE;

--
-- Constraints for table `logistic1_log`
--
ALTER TABLE `logistic1_log`
  ADD CONSTRAINT `logistic1_log_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_table` (`user_id`) ON UPDATE CASCADE;

--
-- Constraints for table `milestone`
--
ALTER TABLE `milestone`
  ADD CONSTRAINT `milestone_ibfk_1` FOREIGN KEY (`Project_id`) REFERENCES `project` (`Project_id`) ON UPDATE CASCADE;

--
-- Constraints for table `outbound`
--
ALTER TABLE `outbound`
  ADD CONSTRAINT `outbound_ibfk_1` FOREIGN KEY (`Request_id`) REFERENCES `request` (`Request_id`) ON UPDATE CASCADE;

--
-- Constraints for table `outbounditems`
--
ALTER TABLE `outbounditems`
  ADD CONSTRAINT `outbounditems_ibfk_1` FOREIGN KEY (`WarehouseItem_id`) REFERENCES `warehouseitem` (`WarehouseItem_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `outbounditems_ibfk_2` FOREIGN KEY (`OutItem_id`) REFERENCES `outbound` (`OutItem_id`);

--
-- Constraints for table `project`
--
ALTER TABLE `project`
  ADD CONSTRAINT `project_ibfk_1` FOREIGN KEY (`Prequest_id`) REFERENCES `prequest` (`Prequest_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `project_ibfk_2` FOREIGN KEY (`Ccategory_id`) REFERENCES `ccategory` (`Ccategory_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `project_ibfk_3` FOREIGN KEY (`Contractor_id`) REFERENCES `contractors` (`Contractor_id`) ON UPDATE CASCADE;

--
-- Constraints for table `purchaseorder_details`
--
ALTER TABLE `purchaseorder_details`
  ADD CONSTRAINT `purchaseorder_details_ibfk_1` FOREIGN KEY (`po_id`) REFERENCES `purchase_order` (`po_id`) ON UPDATE CASCADE;

--
-- Constraints for table `purchaserequest_details`
--
ALTER TABLE `purchaserequest_details`
  ADD CONSTRAINT `purchaserequest_details_ibfk_1` FOREIGN KEY (`pr_id`) REFERENCES `purchase_request` (`pr_id`) ON UPDATE CASCADE;

--
-- Constraints for table `purchase_order`
--
ALTER TABLE `purchase_order`
  ADD CONSTRAINT `purchase_order_ibfk_1` FOREIGN KEY (`Request_id`) REFERENCES `request` (`Request_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `purchase_order_ibfk_2` FOREIGN KEY (`Vendor_id`) REFERENCES `vendor` (`Vendor_id`) ON UPDATE CASCADE;

--
-- Constraints for table `purchase_request`
--
ALTER TABLE `purchase_request`
  ADD CONSTRAINT `purchase_request_ibfk_1` FOREIGN KEY (`Request_id`) REFERENCES `request` (`Request_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `purchase_request_ibfk_2` FOREIGN KEY (`Vendor_id`) REFERENCES `vendor` (`Vendor_id`) ON UPDATE CASCADE;

--
-- Constraints for table `rejectionnote`
--
ALTER TABLE `rejectionnote`
  ADD CONSTRAINT `rejectionnote_ibfk_1` FOREIGN KEY (`Project_id`) REFERENCES `project` (`Project_id`) ON UPDATE CASCADE;

--
-- Constraints for table `request`
--
ALTER TABLE `request`
  ADD CONSTRAINT `request_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `department` (`department_id`) ON UPDATE CASCADE;

--
-- Constraints for table `user_table`
--
ALTER TABLE `user_table`
  ADD CONSTRAINT `user_table_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `department` (`department_id`) ON UPDATE CASCADE;

--
-- Constraints for table `warehouseitem`
--
ALTER TABLE `warehouseitem`
  ADD CONSTRAINT `warehouseitem_ibfk_1` FOREIGN KEY (`ItemCategory_id`) REFERENCES `itemcategory` (`ItemCategory_id`),
  ADD CONSTRAINT `warehouseitem_ibfk_2` FOREIGN KEY (`Location_id`) REFERENCES `locations` (`Location_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
