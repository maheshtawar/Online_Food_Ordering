-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 17, 2022 at 11:13 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fos_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `offer`
--

CREATE TABLE `offer` (
  `id` int(11) NOT NULL,
  `oname` varchar(255) NOT NULL,
  `oprice` float NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `ostatus` int(10) NOT NULL COMMENT '1-Active,0-InActive\r\n'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `offer`
--

INSERT INTO `offer` (`id`, `oname`, `oprice`, `image_path`, `ostatus`) VALUES
(1, 'Coffee + Sandwich', 85, 'coffee_sandwich_combo.jpg', 1),
(2, 'Pizza + Diet Coke', 120, 'pizza_diet_combo.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `address` text NOT NULL,
  `mobile` text NOT NULL,
  `email` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1-Confirmed,0-For Verification',
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `name`, `address`, `mobile`, `email`, `status`, `user_id`) VALUES
(1, 'James Smith', 'adasdasd asdadasd', '4756463215', 'jsmith@sample.com', 1, 0),
(2, 'James Smith', 'adasdasd asdadasd', '4756463215', 'jsmith@sample.com', 1, 0),
(3, 'Mahesh Tawar', 'kavhala', '9503337953', 'mahesh28tawar@gmail.com', 1, 2),
(4, 'Mahesh Tawar', 'Kavhala', '9876', 'mahesh28tawar@gmail.com', 0, 2),
(5, 'Mahesh', 'a', '6754', 'a@gmail.com', 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `order_list`
--

CREATE TABLE `order_list` (
  `id` int(30) NOT NULL,
  `order_id` int(30) NOT NULL,
  `product_id` int(30) NOT NULL,
  `qty` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_list`
--

INSERT INTO `order_list` (`id`, `order_id`, `product_id`, `qty`) VALUES
(1, 1, 3, 1),
(2, 1, 5, 1),
(3, 1, 3, 1),
(4, 1, 6, 3),
(5, 2, 1, 2),
(6, 3, 1, 2),
(7, 3, 5, 1),
(8, 3, 4, 1),
(9, 3, 2, 1),
(10, 4, 2, 1),
(11, 4, 4, 2),
(12, 4, 3, 1),
(13, 4, 5, 1),
(14, 5, 2, 1),
(15, 5, 4, 2),
(16, 5, 1, 1),
(17, 5, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_list`
--

CREATE TABLE `product_list` (
  `id` int(30) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` float NOT NULL DEFAULT 0,
  `img_path` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1 Available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_list`
--

INSERT INTO `product_list` (`id`, `name`, `description`, `price`, `img_path`, `status`) VALUES
(1, 'Burger', 'Pattie, Spinach, Cheese, Mustard Sause', 60, 'burger.png', 1),
(2, 'Chicken Pasta', 'Chicken, Pasta, Mustard Sause, Cheese', 120, 'chicken_pasta.jpg', 1),
(3, 'Cheese Pasta', 'Cheese, Spinach', 100, 'cheese_pasta.jpg', 1),
(4, 'Diet Coke', 'Diet Coke', 30, 'diet_coke.jpg', 1),
(5, 'Iced Tea', 'Iced Tea', 30, 'iced_tea.jpg', 1),
(6, 'Paneer Pizza', 'Paneer, Spinach, Mustard Sause, Tomato Sause', 110, 'paneer_pizza.jpg', 1),
(7, 'Margerita Pizza', 'Margerita, Mustard Sause, Tomato Sause', 110, 'margerita_pizza.jpg', 1),
(8, 'Cold Coffee', 'Cold Coffee', 40, 'cold_coffee.jpg', 1),
(9, 'Chicken Pasta', 'Chicken Pasta, Spinach,Garlic', 120, 'chicken_pasta.jpg', 1),
(10, 'Mocha', 'Mocha', 40, 'mocha.jpg', 1),
(11, 'Mineral Water', 'Mineral Water', 20, 'mineral_water.jpg', 1),
(12, 'Cheese Sandwich', 'Cheese, Veg, Tomato Sause', 60, 'cheese_sandwich.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(30) NOT NULL,
  `name` varchar(200) NOT NULL,
  `mail` varchar(200) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `role` varchar(250) NOT NULL DEFAULT 'user' COMMENT 'admin,user',
  `status` varchar(100) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `mail`, `username`, `password`, `role`, `status`) VALUES
(1, 'Administrator', 'mahesh28tawar@gmail.com', 'admin', 'admin123', 'admin', 'Active'),
(2, 'Mahesh', 'a@gmail.com', 'mahesh', 'mahesh123', 'user', 'Active'),
(3, 'Sanjeev Sutar', 'sanjeev@gmail.com', 'sanjeev', 'sanjeev123', 'user', 'Active'),
(4, 'Ashish Satpute', '', 'ashish', 'ashish123', 'user', 'Active'),
(5, 'Kaivalya Sarode', 'kaivalya@gmail.com', 'kaivalya', 'kaivalya123', 'user', 'Active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `offer`
--
ALTER TABLE `offer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_list`
--
ALTER TABLE `order_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_list`
--
ALTER TABLE `product_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `offer`
--
ALTER TABLE `offer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `order_list`
--
ALTER TABLE `order_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `product_list`
--
ALTER TABLE `product_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
