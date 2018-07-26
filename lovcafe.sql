-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 26, 2018 at 09:21 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lovcafe`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `CID` int(10) NOT NULL,
  `F_name` varchar(20) NOT NULL,
  `M_name` varchar(20) NOT NULL,
  `L_name` varchar(20) NOT NULL,
  `Phone_no` int(13) UNSIGNED NOT NULL,
  `Email` varchar(50) NOT NULL,
  `House_no` int(3) NOT NULL,
  `Street_no` int(4) NOT NULL,
  `Area-name` varchar(30) NOT NULL,
  `City` varchar(30) NOT NULL,
  `ZIP` int(4) NOT NULL,
  `Join_date` date NOT NULL,
  `Password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONSHIPS FOR TABLE `customer`:
--   `CID`
--       `order` -> `Cus_ID`
--

-- --------------------------------------------------------

--
-- Table structure for table `dish`
--

CREATE TABLE `dish` (
  `Dish_ID` int(10) NOT NULL,
  `D_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONSHIPS FOR TABLE `dish`:
--

--
-- Dumping data for table `dish`
--

INSERT INTO `dish` (`Dish_ID`, `D_name`) VALUES
(3, 'Carbonara'),
(4, 'Spaghetti al pomodoro'),
(5, 'Fettuccine al pomodoro');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `E_ID` int(10) NOT NULL,
  `F_name` varchar(20) NOT NULL,
  `M_name` varchar(20) NOT NULL,
  `L_name` varchar(20) NOT NULL,
  `Phone_no` int(13) UNSIGNED NOT NULL,
  `Email` varchar(50) NOT NULL,
  `House_no` int(3) NOT NULL,
  `Street_no` int(4) NOT NULL,
  `Area_name` varchar(30) NOT NULL,
  `City` varchar(30) NOT NULL,
  `ZIP` int(4) NOT NULL,
  `Join_date` date NOT NULL,
  `Job_type` varchar(30) NOT NULL,
  `Password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONSHIPS FOR TABLE `employee`:
--

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`E_ID`, `F_name`, `M_name`, `L_name`, `Phone_no`, `Email`, `House_no`, `Street_no`, `Area_name`, `City`, `ZIP`, `Join_date`, `Job_type`, `Password`) VALUES
(1, 'Lamia', '', 'Tabassum', 924587, 'l.t@gmail.com', 0, 0, '', '', 0, '2018-05-07', '', ''),
(2, 'Aditi', '', 'Bishas', 964356, 'a.b@gmail.com', 0, 0, '', '', 0, '2018-05-07', '', ''),
(3, 'Iffat', 'Immami', 'Trisha', 926547, 'i.t@gmail.com', 0, 0, '', '', 0, '2018-05-25', '', ''),
(4, 'Prasenjit', '', 'Das', 968454, 'p.d@gmail.com', 0, 0, '', '', 0, '2018-05-28', '', ''),
(5, 'Tabassum', '', 'Kabir', 936272, 't.k@gmail.com', 0, 0, '', '', 0, '2018-06-02', '', ''),
(6, 'Mavro', '', 'Louis', 96543, 'm.l@gmail.com', 0, 0, '', '', 0, '2018-06-03', '', ''),
(8, 'David', 'Kwe', 'Chang', 97368, 'd.c@gmail.com', 0, 0, '', '', 0, '2018-06-03', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `D_ID` int(10) NOT NULL,
  `D_name` varchar(30) NOT NULL,
  `Quantity` int(4) NOT NULL,
  `Order_no` int(10) NOT NULL,
  `Rating` int(2) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONSHIPS FOR TABLE `invoice`:
--

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `Order_no` int(10) NOT NULL,
  `Cus_ID` int(10) NOT NULL,
  `Emp_ID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONSHIPS FOR TABLE `order`:
--   `Order_no`
--       `invoice` -> `Order_no`
--

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`CID`);

--
-- Indexes for table `dish`
--
ALTER TABLE `dish`
  ADD PRIMARY KEY (`Dish_ID`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`E_ID`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD KEY `D_ID` (`D_ID`),
  ADD KEY `Order_no` (`Order_no`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`Order_no`),
  ADD KEY `Cus_ID` (`Cus_ID`),
  ADD KEY `Emp_ID` (`Emp_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `CID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dish`
--
ALTER TABLE `dish`
  MODIFY `Dish_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `E_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `Order_no` int(10) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `fk_customer_order` FOREIGN KEY (`CID`) REFERENCES `order` (`Cus_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `fk_order_invoice` FOREIGN KEY (`Order_no`) REFERENCES `invoice` (`Order_no`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
