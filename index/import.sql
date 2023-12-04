-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2023 at 05:41 AM
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
(3, '::1', 4),
(9, '::1', 2);

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
-- Table structure for table `delivery`
--

CREATE TABLE `delivery` (
  `order_id` int(11) NOT NULL,
  `delivery_firstname` varchar(100) NOT NULL,
  `delivery_lastname` varchar(100) NOT NULL,
  `delivery_address` varchar(255) NOT NULL,
  `delivery_address_state` varchar(100) NOT NULL,
  `delivery_address_city` varchar(100) NOT NULL,
  `delivery_contact` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `delivery`
--

INSERT INTO `delivery` (`order_id`, `delivery_firstname`, `delivery_lastname`, `delivery_address`, `delivery_address_state`, `delivery_address_city`, `delivery_contact`) VALUES
(1, 'Garuka', 'Assalaarachchi', '6/1 A, Pasal Mawatha,Ratthanapitiya,Boralesgamuwa', 'Kandy', 'Boralesgamuwa', '0773457723');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_invoice` int(255) NOT NULL,
  `order_status` varchar(255) NOT NULL,
  `order_amount` int(11) NOT NULL,
  `order_payment` varchar(255) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `order_invoice`, `order_status`, `order_amount`, `order_payment`, `order_date`) VALUES
(1, 1, 1819305825, 'pending', 98400, 'false', '2023-12-04 04:02:45');

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
(1, 'Cannon Camera', 2500.00, 3, 'Capture lifes moments with professional quality. Rent our top-tier cameras for stunning photos and videos. Unleash your creativity with a camera rental today.', 'cannon.jpeg', 'camera', '2023-12-02 10:59:25', 'true'),
(2, 'Western Bridal Dresses', 1600.00, 2, 'Experience elegance without the price tag! Rent your dream bridal dress today. Stunning designs, budget-friendly. Explore our collection now', 'Western Bridal Dresses.jpg', 'Dresses', '2023-12-02 10:59:25', 'true'),
(3, 'BMW Cars', 25000.00, 1, 'Explore the freedom of car rental! Drive with ease and convenience. Find your perfect ride at competitive rates. Discover new horizons', 'BMW cars.jpg', 'cars', '2023-12-02 10:59:25', 'true'),
(4, 'Apartments', 8000.00, 5, 'Dream apartment for rent: Spacious, modern, affordable, prime location, top amenities, vibrant community. Schedule a viewing today!', 'apartment.jpeg', 'apartment', '2023-12-02 10:59:25', 'true'),
(5, 'JBL Speakers', 800.00, 4, 'Experience powerful sound with JBL speaker rental! Perfect for events, parties, and presentations. High-quality audio guaranteed.', 'JBL.jpg', 'speakers', '2023-12-02 10:59:25', 'true'),
(6, 'Mens Suit', 1500.00, 2, 'Dress to impress without the stress. Elevate your style with our premium suit rentals. From weddings to special occasions, rent the perfect suit and make a statement.', 'Mens suit.jpg', 'suit', '2023-12-02 10:59:25', 'true'),
(7, 'Double-Breasted Suit', 2000.00, 2, 'Double-breasted suits exude timeless elegance and sophistication. Featuring two columns of buttons, they offer a classic, refined look for formal occasions and business attire.', 'Double-Breasted Suit .jpg', 'suit,dress', '2023-12-02 10:59:25', 'true'),
(8, 'Canon R5', 2000.00, 3, 'A groundbreaking mirrorless camera, the Canon EOS R5, is designed for professionals with its 45 MP resolution, 8K video capabilities, and exceptional performance, setting new industry standards.', 'Canon R5.jpg', 'camera,canon', '2023-12-02 10:59:25', 'true'),
(9, 'Mercedes Benz S-Class', 30000.00, 1, 'The Mercedes-Benz S-Class redefines luxury and innovation with cutting-edge technology, elegant design, and unrivaled performance, and unparalleled comfort, its the epitome of automotive excellence.', 'Mercedes Benz S-Class.jpg', 'cars', '2023-12-02 10:59:25', 'true');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_firstname` varchar(100) NOT NULL,
  `user_lastname` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_ip` varchar(100) NOT NULL,
  `user_address` varchar(255) NOT NULL,
  `user_address_state` varchar(100) NOT NULL,
  `user_address_city` varchar(100) NOT NULL,
  `user_contact` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_firstname`, `user_lastname`, `user_email`, `user_password`, `user_ip`, `user_address`, `user_address_state`, `user_address_city`, `user_contact`) VALUES
(1, 'Garuka', 'Assalaarachchi', 'garukavassalaarachchi@gmail.com', '$2y$10$cI4MVBh23dmk8YylAjAtg.kFbRP/KrkonEV9tvOEgUq79ND8j5LhG', '::1', '6/1 A, Pasal Mawatha,Ratthanapitiya,Boralesgamuwa', 'Colombo', 'Boralesgamuwa', '0773457723');

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
-- Indexes for table `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`order_id`);

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
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
