-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 10, 2023 at 11:13 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_aab`
--

-- --------------------------------------------------------

--
-- Table structure for table `app_leave`
--

CREATE TABLE `app_leave` (
  `id` int(11) NOT NULL,
  `leave_id` int(11) NOT NULL,
  `emp_name` text NOT NULL,
  `days` int(11) NOT NULL,
  `start_date` date NOT NULL DEFAULT current_timestamp(),
  `end_date` date NOT NULL DEFAULT current_timestamp(),
  `leave_type` mediumtext NOT NULL,
  `image` varchar(255) NOT NULL,
  `remarks` mediumtext NOT NULL,
  `status` mediumtext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `app_leave`
--

INSERT INTO `app_leave` (`id`, `leave_id`, `emp_name`, `days`, `start_date`, `end_date`, `leave_type`, `image`, `remarks`, `status`, `created_at`) VALUES
(12, 0, 'jake', 3, '2023-07-09', '2023-07-12', 'kdkokdokokd', '1688871961.jpg', 'kdkokdokokd', 'APPROVED', '2023-07-09 03:06:01');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `name` mediumtext NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `sign_in` time NOT NULL DEFAULT current_timestamp(),
  `sign_out` time NOT NULL DEFAULT current_timestamp(),
  `place` mediumtext NOT NULL,
  `status` mediumtext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `name`, `date`, `sign_in`, `sign_out`, `place`, `status`, `created_at`) VALUES
(32, 'jake', '2023-07-09', '11:00:00', '17:00:00', 'SHOP', 'INACTIVE', '2023-07-09 03:00:47');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `prod_qty` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `prod_id`, `prod_qty`, `created_at`) VALUES
(62, 19, 47, 1, '2023-06-21 10:13:13');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(191) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `description` longtext NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `popular` tinyint(4) NOT NULL DEFAULT 0,
  `image` varchar(191) NOT NULL,
  `meta_keywords` mediumtext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `description`, `status`, `popular`, `image`, `meta_keywords`, `created_at`) VALUES
(105, 'SHORT', 'LIMITED OFFER', 'none', 0, 1, '1688713573.jpg', 'limited', '2023-07-07 07:06:13'),
(106, 'TSHIRT', 'HOT SALES', 'kajioahnoa', 0, 1, '1688870664.jfif', 'sales', '2023-07-09 02:44:24');

-- --------------------------------------------------------

--
-- Table structure for table `courier`
--

CREATE TABLE `courier` (
  `id` int(11) NOT NULL,
  `tracking_no` varchar(191) NOT NULL,
  `user_id` int(191) NOT NULL,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `phone` varchar(191) NOT NULL,
  `address` mediumtext NOT NULL,
  `zip_code` int(191) NOT NULL,
  `total_price` int(191) NOT NULL,
  `payment_mode` varchar(191) NOT NULL,
  `payment_id` varchar(191) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `age` int(3) NOT NULL,
  `date_birth` date NOT NULL DEFAULT current_timestamp(),
  `date_hiring` datetime NOT NULL DEFAULT current_timestamp(),
  `gender` text NOT NULL,
  `contact` varchar(11) NOT NULL,
  `salary` int(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `position` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `emp_id`, `name`, `age`, `date_birth`, `date_hiring`, `gender`, `contact`, `salary`, `email`, `position`, `image`, `address`, `created_at`) VALUES
(11, 1010, 'jake', 18, '2023-07-09', '2023-07-09 10:55:00', 'MALE', '09090909090', 50000, 'jake@gmail.com', 'EMPLOYEE', '1688871478.jpg', 'kahit ano', '2023-07-09 02:57:58');

-- --------------------------------------------------------

--
-- Table structure for table `form`
--

CREATE TABLE `form` (
  `fullname` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact` int(13) NOT NULL,
  `address` varchar(255) NOT NULL,
  `inquiries` mediumtext NOT NULL,
  `message` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `form`
--

INSERT INTO `form` (`fullname`, `email`, `contact`, `address`, `inquiries`, `message`, `created_at`) VALUES
('', '', 0, '', '', '', '2023-06-24 11:15:02');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `id` int(11) NOT NULL,
  `supplier_id` varchar(255) NOT NULL,
  `name` text NOT NULL,
  `date_time` datetime NOT NULL DEFAULT current_timestamp(),
  `qty` int(255) NOT NULL,
  `price` int(255) NOT NULL,
  `size` text NOT NULL,
  `type` text NOT NULL,
  `status` mediumtext NOT NULL,
  `remarks` mediumtext NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`id`, `supplier_id`, `name`, `date_time`, `qty`, `price`, `size`, `type`, `status`, `remarks`, `image`) VALUES
(7, '15', 'KOBE', '2023-07-07 00:38:00', 50, 600, 'MEDIUM', 'TSHIRT', 'ACTIVE', 'none', '1688661546.'),
(8, '22', 'GOAT', '2023-07-09 10:41:00', 500, 2000, 'SMALL', 'TSHIRT', 'ACTIVE', 'none', '1688870552.');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `tracking_no` varchar(191) NOT NULL,
  `user_id` int(191) NOT NULL,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `phone` varchar(191) NOT NULL,
  `address` mediumtext NOT NULL,
  `zip_code` int(191) NOT NULL,
  `total_price` int(191) NOT NULL,
  `payment_mode` varchar(191) NOT NULL,
  `payment_id` varchar(191) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `comment` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `tracking_no`, `user_id`, `name`, `email`, `phone`, `address`, `zip_code`, `total_price`, `payment_mode`, `payment_id`, `status`, `comment`, `created_at`) VALUES
(65, 'JGAAMSXX25139999999', 8, 'Administrator', 'admin@admin.com', '999999999', 'gpl3', 0, 700, 'COD', '', 2, NULL, '2023-07-07 07:12:08'),
(66, 'JGAAMSXX76559999999', 8, 'Administrator', 'admin@admin.com', '999999999', 'kahit saan', 0, 2100, 'COD', '', 1, NULL, '2023-07-07 22:33:39'),
(67, 'JGAAMSXX92019999999', 8, 'Administrator', 'admin@admin.com', '999999999', 'kahit saaan', 0, 2100, 'Gcash', '534840817057909625660', 1, NULL, '2023-07-09 02:36:17'),
(68, 'JGAAMSXX97539999999', 8, 'Administrator', 'admin@admin.com', '999999999', 'kahit saan', 0, 700, 'COD', '', 1, NULL, '2023-07-09 07:36:24');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(191) NOT NULL,
  `prod_id` int(191) NOT NULL,
  `qty` int(191) NOT NULL,
  `price` int(191) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `prod_id`, `qty`, `price`, `created_at`) VALUES
(66, 65, 91, 1, 700, '2023-07-07 07:12:08'),
(67, 66, 92, 1, 700, '2023-07-07 22:33:39'),
(68, 66, 91, 1, 700, '2023-07-07 22:33:39'),
(69, 66, 90, 1, 700, '2023-07-07 22:33:39'),
(70, 67, 90, 1, 700, '2023-07-09 02:36:17'),
(71, 67, 92, 1, 700, '2023-07-09 02:36:17'),
(72, 67, 91, 1, 700, '2023-07-09 02:36:17'),
(73, 68, 90, 1, 700, '2023-07-09 07:36:24');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category_id` varchar(255) NOT NULL,
  `name` varchar(191) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `size` mediumtext NOT NULL,
  `qty` int(11) NOT NULL,
  `original_price` int(11) NOT NULL,
  `selling_price` int(11) NOT NULL,
  `description` mediumtext NOT NULL,
  `image` varchar(191) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `trending` tinyint(4) NOT NULL,
  `meta_keywords` mediumtext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `slug`, `size`, `qty`, `original_price`, `selling_price`, `description`, `image`, `status`, `trending`, `meta_keywords`, `created_at`) VALUES
(90, '105', 'GOAT', 'goat312', 'SMALL', 47, 800, 700, 'GOAT IS POWER', '1688713615.jpg', 0, 1, 'goat', '2023-07-07 07:06:55'),
(91, '105', 'KOBE', 'kobe321', 'LARGE', 26, 800, 700, 'KOBE IS POWER', '1688713650.png', 0, 1, 'kobe', '2023-07-07 07:07:30'),
(92, '105', 'THUNDER', 'thunder2', 'XL', 18, 800, 700, 'thunder', '1688713713.png', 0, 1, 'Thunder12', '2023-07-07 07:08:33'),
(93, '105', 'AABNICE', '06822', 'XL', 90, 980, 1000, 'nice clothes', '1688713758.jpg', 0, 1, 'nice AAB clothes', '2023-07-07 07:09:18'),
(94, '105', 'VINTAGE AAB', '6548', 'LARGE', 98, 890, 9000, 'VINTAGE', '1688713809.jpg', 0, 1, 'VINTAGE YAN BOY', '2023-07-07 07:10:09'),
(95, '106', 'KOBE', 'kokbebebebe2131321', 'LARGE', 50, 800, 700, 'KOBE IS POWER', '1688871236.jpg', 0, 1, 'kobe32', '2023-07-09 02:53:56');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `id` int(11) NOT NULL,
  `inv_id` varchar(191) NOT NULL,
  `date_time` datetime NOT NULL DEFAULT current_timestamp(),
  `qty` int(255) NOT NULL,
  `price` int(255) NOT NULL,
  `size` text NOT NULL,
  `type` text NOT NULL,
  `status` mediumtext NOT NULL,
  `remarks` mediumtext NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` int(11) NOT NULL,
  `cname` varchar(255) NOT NULL,
  `phone` varchar(13) NOT NULL,
  `cperson` mediumtext NOT NULL,
  `email` varchar(255) NOT NULL,
  `product` varchar(255) NOT NULL,
  `cost` int(11) NOT NULL,
  `description` mediumtext NOT NULL,
  `image` varchar(191) NOT NULL,
  `date_time` datetime NOT NULL DEFAULT current_timestamp(),
  `status` mediumtext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `cname`, `phone`, `cperson`, `email`, `product`, `cost`, `description`, `image`, `date_time`, `status`, `created_at`) VALUES
(22, 'jake', '00090909090', 'JAKE MARQUEZ', 'jake@gmail.com', 'TSHIRT', 600000, '', '1688870501.jpg', '2023-07-09 10:41:00', 'ACTIVE', '2023-07-09 02:41:41');

-- --------------------------------------------------------

--
-- Table structure for table `upload`
--

CREATE TABLE `upload` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `image` varchar(75) NOT NULL,
  `cloth_size` varchar(70) NOT NULL,
  `color` varchar(70) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `upload`
--

INSERT INTO `upload` (`id`, `name`, `image`, `cloth_size`, `color`, `created_at`, `status`) VALUES
(28, 'James', '1688579848.jpg', 'Medium', 'White', '2023-07-05 17:57:28', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(191) NOT NULL,
  `name` varchar(191) NOT NULL,
  `image` varchar(191) NOT NULL DEFAULT 'null.jpg',
  `email` varchar(191) DEFAULT NULL,
  `phone` varchar(13) NOT NULL,
  `address` varchar(255) NOT NULL,
  `zip` int(5) NOT NULL,
  `password` varchar(191) NOT NULL,
  `role_as` tinyint(4) NOT NULL DEFAULT 0,
  `verification_code` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `email_verified_at` datetime DEFAULT NULL,
  `code` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `image`, `email`, `phone`, `address`, `zip`, `password`, `role_as`, `verification_code`, `created_at`, `email_verified_at`, `code`) VALUES
(8, 'Administrator', '1687014261.png', 'admin@admin.com', '999999999', '', 0, '$2y$10$ZxCLEglQVYLYsAR5eeegKO68QTWq5OiKNbScj.CvhkLrE0U9OuQg.', 1, '', '2022-12-10 10:15:50', NULL, ''),
(19, 'joey', 'null.jpg', 'joey@gmail.com', '0909090909', 'MALAPIT LANG', 4103, '$2y$10$NGnZqIKB.tk9t5pC9F0cUOuqvAKTnb.yrceTptgq6swOKBXlkh2xm', 0, '', '2023-06-21 10:12:01', NULL, ''),
(20, 'melby', 'null.jpg', 'melby@gmail.com', '09090909', 'jan lang malapit', 4014, '$2y$10$eTj/0x3Xx3ZvpXJe3Z/BZOIT1ejhh8fLny3rG9stmQ8GH0VhMULei', 0, '', '2023-06-21 10:27:41', NULL, ''),
(21, 'jake', 'null.jpg', 'jake@gmail.com', '090909', 'mALAPT', 4014, '$2y$10$4DEygRwjOFw5MR6iLkTQQ..vBBHy9qzivQKPvjBzULJbBAznPKZtW', 0, '', '2023-06-24 03:40:46', NULL, ''),
(22, 'Gabriel', 'null.jpg', 'dannebioo1@gmail.com', '0909090909', 'kahit saan', 4108, '$2y$10$70SbWT47qtY33.a2M2sVcuCc4uPnrGYxTm1tMDRMFPNCZXN1U0VcG', 0, '', '2023-07-05 23:20:03', NULL, ''),
(24, 'ed', 'null.jpg', 'edigop5@gmail.com', '09486526588', 'huadj', 4114, '$2y$10$s3VavVzbsBCCDDw16E5lb.iQwb3qKy0rze4BJwxLxi2Ft2k2AmoWG', 0, '101172', '2023-07-06 06:34:04', NULL, ''),
(25, 'ed', 'null.jpg', 'edigop5@gmail.com', '09486526588', 'asdjhj', 4114, '$2y$10$eXDcqFv6aAbxHRcgITOyxOg6blCXcXk1Ob8.TwPm5j7HUb0Ba5ere', 0, '947680', '2023-07-06 06:34:49', NULL, ''),
(26, 'danny', 'null.jpg', 'ebio.bab@gmail.com', '0909090909', 'kahiut saan', 41111, '$2y$10$1H6d59YImUd9y/v01H3rzukzXu8T.lsIi4.5YOBI8jiKfIRJcZE6a', 0, '371697', '2023-07-06 06:47:37', NULL, ''),
(27, 'marie', 'null.jpg', 'mariejoy.12.mji@gmail.com', '09090909', 'demo', 4014, '$2y$10$lBqldWbtubRnY5zS5hxZ0Or9yny74EIe0HXNXBg/PQbSq0z1mN93i', 0, '345611', '2023-07-06 12:14:38', NULL, ''),
(28, 'James Fiestada', 'null.jpg', 'lruzellekeane@gmail.com', '0909', 'dyan', 4117, '$2y$10$ewLv1KAoPwyCL1iUO7AL9eZxsnAfKTHQoNXr5GOq6gvZX.EWaNDQu', 0, '356968', '2023-07-07 05:17:22', NULL, '2ee7b99755ee0b2044ef3dfc2ed308e0'),
(29, 'jake', 'null.jpg', 'randel.raagas1270@gmail.com', '0909090909', 'kahit saaan', 4014, '$2y$10$jeTn67Rl6RVvr5vS5qDDxOxLuj4Wbl66peJJZqA9Q9m9nW61du/B2', 0, '383837', '2023-07-09 03:13:55', NULL, '8e9e9474487cf57d0df1f614395e1d40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `app_leave`
--
ALTER TABLE `app_leave`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courier`
--
ALTER TABLE `courier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `upload`
--
ALTER TABLE `upload`
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
-- AUTO_INCREMENT for table `app_leave`
--
ALTER TABLE `app_leave`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `courier`
--
ALTER TABLE `courier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `upload`
--
ALTER TABLE `upload`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(191) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
