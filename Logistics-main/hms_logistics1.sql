-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 30, 2023 at 07:38 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`department_id`, `departmentName`, `departmentDescription`) VALUES
(1, 'Warehouse', '');

-- --------------------------------------------------------

--
-- Table structure for table `inbound`
--

CREATE TABLE `inbound` (
  `Inbound_id` int(11) NOT NULL,
  `Inbound_DeliveryPersonnel` varchar(45) NOT NULL,
  `Inbound_Date` datetime NOT NULL,
  `Inbound_PersonnelReceive` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `Location_id` int(11) NOT NULL,
  `Location_Name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`Location_id`, `Location_Name`) VALUES
(1, 'Samp');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `Project_Accept/reject` varchar(45) NOT NULL,
  `Contractor_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`Project_id`, `Prequest_id`, `Ccategory_id`, `Project_Name`, `Project_Status`, `Project_StartDate`, `Project_EndDate`, `Date_Added`, `Project_Summary`, `Project_DesireOutcome`, `Project_ActionToCompletion`, `Project_Benefits`, `Project_Budget`, `Project_AdditionalInfo`, `Project_Progress`, `Project_Accept/reject`, `Contractor_id`) VALUES
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
-- Table structure for table `rejectionnote`
--

CREATE TABLE `rejectionnote` (
  `Note_id` int(11) NOT NULL,
  `Project_id` int(11) NOT NULL,
  `Note_Description` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `Request_Date` datetime NOT NULL,
  `Request_Message` varchar(225) NOT NULL,
  `Reqiest_DeliveryAddress` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_username` varchar(45) NOT NULL,
  `user_userpass` varchar(45) NOT NULL,
  `user_fname` varchar(45) NOT NULL,
  `user_mname` varchar(45) NOT NULL,
  `user_lname` varchar(45) NOT NULL,
  `user_gender` varchar(45) NOT NULL,
  `user_residentialAddress` varchar(200) NOT NULL,
  `user_emailAddress` varchar(80) NOT NULL,
  `user_dateCreated` datetime NOT NULL,
  `user_dateModified` timestamp NOT NULL DEFAULT current_timestamp(),
  `userRole_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `user_contact` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_username`, `user_userpass`, `user_fname`, `user_mname`, `user_lname`, `user_gender`, `user_residentialAddress`, `user_emailAddress`, `user_dateCreated`, `user_dateModified`, `userRole_id`, `department_id`, `user_contact`) VALUES
(2, 'vbarcelo123', '123', 'Vaun Ervin', 'Calag', 'Barcelo', 'Male', '123-C Example street, Quezon City, Philippines', 'vaunbarcelo22@gmail.com', '2023-01-06 07:32:40', '2023-01-06 06:33:37', 2, 1, '09283321181');

-- --------------------------------------------------------

--
-- Table structure for table `userrole`
--

CREATE TABLE `userrole` (
  `userRole_id` int(11) NOT NULL,
  `roleName` varchar(45) NOT NULL,
  `roleDescription` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userrole`
--

INSERT INTO `userrole` (`userRole_id`, `roleName`, `roleDescription`) VALUES
(1, 'Project Manager', 'Responsible for the planning, procurement, execution and completion of a project.'),
(2, 'Warehouse Manager', 'Works in warehouses where they supervise the receipt, dispatching, and storage of goods.'),
(3, 'Warehouse Staff', 'Responsible for performing an array of duties such as receiving and processing incoming stock etc.'),
(4, 'Procurement Manager', 'Responsible for sourcing the products and services for a company.'),
(5, 'Asset Manager', 'Responsible for making investments, liquidate assets when needed, and keeping track of performance.');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Indexes for table `rejectionnote`
--
ALTER TABLE `rejectionnote`
  ADD PRIMARY KEY (`Note_id`),
  ADD KEY `Project_id` (`Project_id`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`Request_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `department_id` (`department_id`),
  ADD KEY `userRole_id` (`userRole_id`);

--
-- Indexes for table `userrole`
--
ALTER TABLE `userrole`
  ADD PRIMARY KEY (`userRole_id`);

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
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `ItemRequest_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `Location_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
-- AUTO_INCREMENT for table `rejectionnote`
--
ALTER TABLE `rejectionnote`
  MODIFY `Note_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `Request_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `userrole`
--
ALTER TABLE `userrole`
  MODIFY `userRole_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
-- Constraints for table `rejectionnote`
--
ALTER TABLE `rejectionnote`
  ADD CONSTRAINT `rejectionnote_ibfk_1` FOREIGN KEY (`Project_id`) REFERENCES `project` (`Project_id`) ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `department` (`department_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `user_ibfk_2` FOREIGN KEY (`userRole_id`) REFERENCES `userrole` (`userRole_id`) ON UPDATE CASCADE;

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
