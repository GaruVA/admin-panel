-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 01, 2023 at 02:45 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `renthub`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `product_id` int(11) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `quantity` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`product_id`, `ip_address`, `quantity`) VALUES
(3, '::1', 1),
(9, '::1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`) VALUES
(1, 'Vehicals'),
(2, 'Apparel'),
(3, 'Camera'),
(4, 'Entertainment'),
(5, 'Security'),
(6, 'Medical');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_invoice` int(255) NOT NULL,
  `order_status` varchar(255) NOT NULL,
  `order_payment` varchar(255) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_price` decimal(9,2) NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_desc` varchar(255) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_keywords` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_price`, `category_id`, `product_desc`, `product_image`, `product_keywords`, `date`, `status`) VALUES
(1, 'Cannon Camera', 20.00, 3, 'Capture lifes moments with professional quality. Rent our top-tier cameras for stunning photos and videos. Unleash your creativity with a camera rental today.', 'cannon.jpeg', 'camera', '2023-11-22 16:09:47', 'true'),
(2, 'Western Bridal Dresses', 50.00, 2, 'Experience elegance without the price tag! Rent your dream bridal dress today. Stunning designs, budget-friendly. Explore our collection now', 'Western Bridal Dresses.jpg', 'Dresses', '2023-11-22 16:11:01', 'true'),
(3, 'BMW Cars', 60.00, 1, 'Explore the freedom of car rental! Drive with ease and convenience. Find your perfect ride at competitive rates. Discover new horizons', 'BMW cars.jpg', 'cars', '2023-11-22 16:11:44', 'true'),
(4, 'Apartments', 70.00, 5, 'Dream apartment for rent: Spacious, modern, affordable, prime location, top amenities, vibrant community. Schedule a viewing today!', 'apartment.jpeg', 'apartment', '2023-11-22 16:12:22', 'true'),
(5, 'JBL Speakers', 15.05, 4, 'Experience powerful sound with JBL speaker rental! Perfect for events, parties, and presentations. High-quality audio guaranteed.', 'JBL.jpg', 'speakers', '2023-11-27 06:45:19', 'true'),
(6, 'Mens Suit', 40.00, 2, 'Dress to impress without the stress. Elevate your style with our premium suit rentals. From weddings to special occasions, rent the perfect suit and make a statement.', 'Mens suit.jpg', 'suit', '2023-11-22 16:13:44', 'true'),
(7, 'Double-Breasted Suit', 40.00, 2, 'Double-breasted suits exude timeless elegance and sophistication. Featuring two columns of buttons, they offer a classic, refined look for formal occasions and business attire.', 'Double-Breasted Suit .jpg', 'suit,dress', '2023-11-23 16:55:18', 'true'),
(8, 'Canon R5', 30.00, 3, 'A groundbreaking mirrorless camera, the Canon EOS R5, is designed for professionals with its 45 MP resolution, 8K video capabilities, and exceptional performance, setting new industry standards.', 'Canon R5.jpg', 'camera,canon', '2023-11-23 16:55:59', 'true'),
(9, 'Mercedes Benz S-Class', 70.00, 1, 'The Mercedes-Benz S-Class redefines luxury and innovation with cutting-edge technology, elegant design, and unrivaled performance, and unparalleled comfort, its the epitome of automotive excellence.', 'Mercedes Benz S-Class.jpg', 'cars', '2023-11-23 16:56:39', 'true');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_ip` varchar(100) NOT NULL,
  `user_address` varchar(255) NOT NULL,
  `user_contact` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_password`, `user_ip`, `user_address`, `user_contact`) VALUES
(1, 'garuka', 'garukavassalaarachchi@gmail.com', '$2y$10$gwr234iqtlCHKlykv6XEKuuLXlmaTz3/ejcAMPGcR8eZoBAW7XpzK', '::1', '6/1A pasal mawatha raththanapitiya boralesgamuwa', '0773457723');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`product_id`,`ip_address`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
