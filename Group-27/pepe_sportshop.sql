-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 05, 2024 at 05:53 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pepe_sportshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `manage_categories`
--

CREATE TABLE `manage_categories` (
  `category_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `manage_categories`
--

INSERT INTO `manage_categories` (`category_id`, `name`) VALUES
(1, 'Sport Shoes'),
(2, 'Sport Jerseys'),
(3, 'Badminton Rackets');

-- --------------------------------------------------------

--
-- Table structure for table `manage_members`
--

CREATE TABLE `manage_members` (
  `member_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `manage_members`
--

INSERT INTO `manage_members` (`member_id`, `name`, `email`, `password`) VALUES
(1, 'David ', 'david@gmail.com', '111'),
(2, 'Yu Le', 'yltan0604@gmail.com', '222'),
(3, 'Ricky', 'ricky@gmail.com', '333');

-- --------------------------------------------------------

--
-- Table structure for table `manage_orders`
--

CREATE TABLE `manage_orders` (
  `order_id` int(11) NOT NULL,
  `order_date` datetime DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `total_price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `manage_orders`
--

INSERT INTO `manage_orders` (`order_id`, `order_date`, `customer_id`, `total_price`) VALUES
(1, '2024-06-23 09:34:59', 1, 1899.00),
(2, '2024-06-24 07:12:54', 2, 2000.00),
(3, '2024-07-03 11:55:55', 3, 1099.00),
(4, '2024-07-04 11:24:00', 3, 200.00);

-- --------------------------------------------------------

--
-- Table structure for table `manage_products`
--

CREATE TABLE `manage_products` (
  `product_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `store` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `manage_products`
--

INSERT INTO `manage_products` (`product_id`, `name`, `price`, `category_id`, `store`) VALUES
(1, 'Astrox 88s pro', 800.00, 3, 100),
(2, 'VICTOR Bravesword 1000', 289.00, 3, 100),
(3, 'LI-NING TURBO X 90 III', 259.00, 3, 100),
(4, 'VICTOR-Thruster-Ryuga-II', 840.00, 3, 100),
(5, 'VICTOR badminton shoes A170', 239.00, 1, 100),
(6, 'Li Ning Ning Ultra Speed Sn44', 229.00, 1, 100),
(7, 'Asics Upcourt 5 Sn42', 199.00, 1, 0),
(8, 'Yonex Akita Sn41', 182.00, 1, 0),
(9, 'Yonex Malaysia Master 2023 T-shirt', 59.90, 2, 0),
(10, 'Victor T-00001F', 169.00, 2, 0),
(11, 'Lining ATSS993', 73.90, 2, 0),
(12, 'Lining 2023 Summer Shirt', 54.00, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `manage_staff`
--

CREATE TABLE `manage_staff` (
  `staff_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `manage_staff`
--

INSERT INTO `manage_staff` (`staff_id`, `name`, `role`) VALUES
(1, 'Lily', 'Manager'),
(2, 'Ya ya', 'Worker'),
(3, 'Hii Hi', 'Worker'),
(4, 'Zhe Zhe', 'Worker');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `manage_categories`
--
ALTER TABLE `manage_categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `manage_members`
--
ALTER TABLE `manage_members`
  ADD PRIMARY KEY (`member_id`);

--
-- Indexes for table `manage_orders`
--
ALTER TABLE `manage_orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `manage_products`
--
ALTER TABLE `manage_products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `manage_staff`
--
ALTER TABLE `manage_staff`
  ADD PRIMARY KEY (`staff_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `manage_categories`
--
ALTER TABLE `manage_categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `manage_members`
--
ALTER TABLE `manage_members`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `manage_orders`
--
ALTER TABLE `manage_orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `manage_products`
--
ALTER TABLE `manage_products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `manage_staff`
--
ALTER TABLE `manage_staff`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `manage_products`
--
ALTER TABLE `manage_products`
  ADD CONSTRAINT `manage_products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `manage_categories` (`category_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
