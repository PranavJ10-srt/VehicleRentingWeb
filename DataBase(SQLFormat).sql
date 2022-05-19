-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 09, 2021 at 07:46 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbms`
--

DELIMITER $$
--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `TOTALCOST_BIKE` (`book_id` INT, `modelnum` INT, `type` VARCHAR(5)) RETURNS INT(11) begin

declare no_of_days int;
declare cost_pd int;
declare totalcost int;
declare start_d date;
declare return_d date;
declare stat varchar(10);
SELECT startdate , returndate INTO start_d,return_d from book_bike where book_bike.BookingID = book_id and book_bike.modelnumber = modelnum;

SELECT DATEDIFF(return_d , start_d) INTO no_of_days; 
SELECT cost into cost_pd from bikedb  where bikedb.modelnumber = modelnum;

SET totalcost = no_of_days * cost_pd;
SET stat = 'Paid';
INSERT INTO payment_bike(BookingID , modelnumber , Days_booked , Amount ,Payment_type,Payment_status) VALUES(book_id , modelnum , no_of_days , totalcost,type,stat);

return totalcost;
end$$

CREATE DEFINER=`root`@`localhost` FUNCTION `TOTALCOST_CAR` (`book_id` INT, `modelnum` INT, `type` VARCHAR(5)) RETURNS INT(11) begin

declare no_of_days int;
declare cost_pd int;
declare totalcost int;
declare start_d date;
declare return_d date;
declare stat varchar(10);
SELECT startdate , returndate into start_d,return_d from book_car where book_car.BookingID = book_id and book_car.model = modelnum;

SELECT DATEDIFF(return_d , start_d) into no_of_days;
SELECT cost into cost_pd from cardb  where cardb.modelnumber = modelnum;

set totalcost = no_of_days * cost_pd;
set stat='Paid';
INSERT INTO payment_car(BookingID , modelnumber , Days_booked , Amount , Payment_type,Payment_status) VALUES(book_id , modelnum , no_of_days , totalcost , type,stat);

return totalcost;
end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `bikedb`
--

CREATE TABLE `bikedb` (
  `modelnumber` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `mileage` int(11) NOT NULL,
  `cost` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bikedb`
--

INSERT INTO `bikedb` (`modelnumber`, `name`, `mileage`, `cost`) VALUES
(10, 'Unicorn', 45, 500),
(20, 'CBShine', 50, 500),
(30, 'Pulsar', 45, 700),
(40, 'Splender', 40, 400),
(50, 'RoyalEnfield', 35, 1000),
(60, 'CBZ', 50, 600),
(70, 'Activa', 45, 400),
(80, 'Pleasure', 40, 300),
(90, 'Vespa', 50, 500),
(100, 'Maestro', 45, 500);

-- --------------------------------------------------------

--
-- Table structure for table `book_bike`
--

CREATE TABLE `book_bike` (
  `BookingID` int(11) NOT NULL,
  `Custname` varchar(30) NOT NULL,
  `modelnumber` int(11) NOT NULL,
  `address` varchar(30) NOT NULL,
  `License` int(11) NOT NULL,
  `startdate` date NOT NULL,
  `returndate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book_bike`
--

INSERT INTO `book_bike` (`BookingID`, `Custname`, `modelnumber`, `address`, `License`, `startdate`, `returndate`) VALUES
(9, 'abc', 20, 'abc', 12, '2021-01-01', '2021-01-05');

-- --------------------------------------------------------

--
-- Table structure for table `book_car`
--

CREATE TABLE `book_car` (
  `BookingID` int(11) NOT NULL,
  `Custname` varchar(30) DEFAULT NULL,
  `model` int(11) DEFAULT NULL,
  `address` varchar(30) DEFAULT NULL,
  `License` int(11) DEFAULT NULL,
  `startdate` date DEFAULT NULL,
  `returndate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `canceltable`
--

CREATE TABLE `canceltable` (
  `BillingID` int(11) NOT NULL,
  `Name` varchar(30) NOT NULL,
  `modelnumber` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `canceltable`
--

INSERT INTO `canceltable` (`BillingID`, `Name`, `modelnumber`) VALUES
(3, 'abc', 70),
(4, 'abc', 70),
(5, 'user1', 10),
(6, 'Final', 10),
(7, 'user1', 10),
(1003, 'user1', 200),
(1004, 'abc', 200),
(1006, 'Final', 200);

--
-- Triggers `canceltable`
--
DELIMITER $$
CREATE TRIGGER `removeBooking` AFTER INSERT ON `canceltable` FOR EACH ROW begin
delete from book_bike where book_bike.BookingID = new.BillingID; 
delete from book_car where book_car.BookingID = new.BillingID; 
 
end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `updateStatus` AFTER INSERT ON `canceltable` FOR EACH ROW begin
 
update payment_bike set Payment_status='Refunded' where payment_bike.BookingID = new.BillingID;
update payment_car set Payment_status='Refunded' where payment_car.BookingID = new.BillingID; 

end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `cardb`
--

CREATE TABLE `cardb` (
  `modelnumber` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `mileage` int(11) NOT NULL,
  `cost` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cardb`
--

INSERT INTO `cardb` (`modelnumber`, `name`, `mileage`, `cost`) VALUES
(200, 'Swift', 35, 1000),
(300, 'Nano', 35, 800),
(400, 'WagonR', 30, 1100),
(500, 'Skoda', 40, 1200),
(600, 'Creta', 40, 1100),
(700, 'Baleno', 40, 1200),
(800, 'Fortuner', 40, 1500),
(900, 'MercedesBenz', 40, 2000),
(1000, 'HondaCity', 35, 1400),
(1100, 'Volkswagon', 40, 1800);

-- --------------------------------------------------------

--
-- Table structure for table `dummy`
--

CREATE TABLE `dummy` (
  `modelnumber` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dummy`
--

INSERT INTO `dummy` (`modelnumber`) VALUES
(0),
(10),
(10);

-- --------------------------------------------------------

--
-- Table structure for table `dummy2`
--

CREATE TABLE `dummy2` (
  `modelnumber` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `payment_bike`
--

CREATE TABLE `payment_bike` (
  `PaymentID` int(11) NOT NULL,
  `BookingID` int(11) NOT NULL,
  `modelnumber` int(11) NOT NULL,
  `Days_booked` int(11) NOT NULL,
  `Amount` int(11) NOT NULL,
  `Payment_type` varchar(5) NOT NULL,
  `Payment_status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment_bike`
--

INSERT INTO `payment_bike` (`PaymentID`, `BookingID`, `modelnumber`, `Days_booked`, `Amount`, `Payment_type`, `Payment_status`) VALUES
(11, 4, 70, 3, 1200, 'card', 'Refunded'),
(12, 5, 10, 2, 1000, 'card', 'Refunded'),
(13, 6, 10, 2, 1000, 'card', 'Refunded'),
(14, 7, 10, 2, 1000, 'card', 'Refunded'),
(15, 9, 20, 4, 2000, 'card', 'Paid');

-- --------------------------------------------------------

--
-- Table structure for table `payment_car`
--

CREATE TABLE `payment_car` (
  `PaymentID` int(11) NOT NULL,
  `BookingID` int(11) NOT NULL,
  `modelnumber` int(11) NOT NULL,
  `Days_booked` int(11) NOT NULL,
  `Amount` int(11) NOT NULL,
  `Payment_type` varchar(5) NOT NULL,
  `Payment_status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment_car`
--

INSERT INTO `payment_car` (`PaymentID`, `BookingID`, `modelnumber`, `Days_booked`, `Amount`, `Payment_type`, `Payment_status`) VALUES
(1, 1005, 200, 2, 2000, 'card', 'Paid'),
(2, 1006, 200, 2, 2000, 'card', 'Refunded');

-- --------------------------------------------------------

--
-- Table structure for table `trip`
--

CREATE TABLE `trip` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `age` int(11) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `phone` int(10) NOT NULL,
  `other` text NOT NULL,
  `dt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `trip`
--

INSERT INTO `trip` (`id`, `name`, `age`, `gender`, `email`, `phone`, `other`, `dt`) VALUES
(1, 'Jagtap Pranav Deepak', 20, 'male', 'pranav.jagtapsrt@gma', 2147483647, 'ho', '2021-09-28 15:17:32');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `email` varchar(30) DEFAULT NULL,
  `password` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`email`, `password`) VALUES
('', ''),
('', ''),
('', ''),
('pranav', '123'),
('', ''),
('', ''),
('', ''),
('test', '123'),
('', ''),
('', ''),
('', ''),
('pranav', '123'),
('admin', 'ad123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bikedb`
--
ALTER TABLE `bikedb`
  ADD PRIMARY KEY (`modelnumber`);

--
-- Indexes for table `book_bike`
--
ALTER TABLE `book_bike`
  ADD PRIMARY KEY (`BookingID`);

--
-- Indexes for table `book_car`
--
ALTER TABLE `book_car`
  ADD PRIMARY KEY (`BookingID`);

--
-- Indexes for table `canceltable`
--
ALTER TABLE `canceltable`
  ADD PRIMARY KEY (`BillingID`);

--
-- Indexes for table `cardb`
--
ALTER TABLE `cardb`
  ADD PRIMARY KEY (`modelnumber`);

--
-- Indexes for table `dummy`
--
ALTER TABLE `dummy`
  ADD KEY `FK` (`modelnumber`);

--
-- Indexes for table `dummy2`
--
ALTER TABLE `dummy2`
  ADD KEY `fk` (`modelnumber`);

--
-- Indexes for table `payment_bike`
--
ALTER TABLE `payment_bike`
  ADD PRIMARY KEY (`PaymentID`);

--
-- Indexes for table `payment_car`
--
ALTER TABLE `payment_car`
  ADD PRIMARY KEY (`PaymentID`);

--
-- Indexes for table `trip`
--
ALTER TABLE `trip`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book_bike`
--
ALTER TABLE `book_bike`
  MODIFY `BookingID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `book_car`
--
ALTER TABLE `book_car`
  MODIFY `BookingID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1007;

--
-- AUTO_INCREMENT for table `payment_bike`
--
ALTER TABLE `payment_bike`
  MODIFY `PaymentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `payment_car`
--
ALTER TABLE `payment_car`
  MODIFY `PaymentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `trip`
--
ALTER TABLE `trip`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `book_bike`
--
ALTER TABLE `book_bike`
  ADD CONSTRAINT `book_bike_ibfk_1` FOREIGN KEY (`modelnumber`) REFERENCES `bikedb` (`modelnumber`);

--
-- Constraints for table `book_car`
--
ALTER TABLE `book_car`
  ADD CONSTRAINT `book_car_ibfk_1` FOREIGN KEY (`model`) REFERENCES `cardb` (`modelnumber`);

--
-- Constraints for table `payment_bike`
--
ALTER TABLE `payment_bike`
  ADD CONSTRAINT `payment_bike_ibfk_2` FOREIGN KEY (`modelnumber`) REFERENCES `bikedb` (`modelnumber`);

--
-- Constraints for table `payment_car`
--
ALTER TABLE `payment_car`
  ADD CONSTRAINT `payment_car_ibfk_1` FOREIGN KEY (`modelnumber`) REFERENCES `cardb` (`modelnumber`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
