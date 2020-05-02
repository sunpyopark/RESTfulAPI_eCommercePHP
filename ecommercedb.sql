-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 29, 2019 at 07:04 AM
-- Server version: 10.1.39-MariaDB
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommercedb`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cartid` int(255) NOT NULL,
  `products` varchar(255) NOT NULL,
  `quantities` int(255) NOT NULL,
  `user` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cartid`, `products`, `quantities`, `user`) VALUES
(1, 'JJJJJJJJJJJJJJ3.0', 5, 'Steven'),
(2, 'Amazing Pillow', 7, 'Steven Park'),
(3, 'Samsung s9', 1, 'Sukh Kharoud'),
(5, 'Amazing', 7, 'Sukhchain Kharoud'),
(6, 'Amazing', 7, 'Sukhchain Kharoud'),
(7, 'Iphone MAc', 6, 'Kharoud');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `commentid` int(255) NOT NULL,
  `product` varchar(255) NOT NULL,
  `user` varchar(255) NOT NULL,
  `rating` varchar(255) NOT NULL,
  `images` varchar(255) NOT NULL,
  `text` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`commentid`, `product`, `user`, `rating`, `images`, `text`) VALUES
(1, 'Samsung s9', 'Sukh Kharoud', '9 out of 10', 'no image available', 'This is nice phone'),
(2, 'Amazing', 'Sukhchain Kharoud', '8 out 10', 'no', 'this is good');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `productid` int(255) NOT NULL,
  `productDetail` text NOT NULL,
  `productImage` varchar(255) NOT NULL,
  `pricing` int(255) NOT NULL,
  `shipping_cost` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productid`, `productDetail`, `productImage`, `pricing`, `shipping_cost`) VALUES
(1, 'Amzing Pillow 3.0', 'Not Availbe', 12, 4),
(2, 'Amzing Pillow 3.0', 'Not Availbe', 12, 4);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userid` int(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `purchase_history` varchar(255) NOT NULL,
  `shipping_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userid`, `email`, `password`, `username`, `purchase_history`, `shipping_address`) VALUES
(1, 'sukh@gmail.com', 'helloworld', 'sukh1', 'Iphone 8', '251 Albert St. '),
(2, 'sim@kim.com', 'hiworld', 'sim2', 'Samsung s6', '21 glen forest.'),
(3, 'sukh@gmail.com', 'helloworld', 'sukh', '', ''),
(5, 'Amaz@gmail.com', 'edsd22', 'Park', 'two', 'ssds');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cartid`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`commentid`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cartid` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `commentid` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `productid` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userid` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
