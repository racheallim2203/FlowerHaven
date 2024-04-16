-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 16, 2024 at 07:34 AM
-- Server version: 11.3.2-MariaDB
-- PHP Version: 8.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `flowerhaven_team36`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` varchar(10) NOT NULL,
  `category_name` varchar(255) DEFAULT NULL,
  `category_description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `category_description`) VALUES
('CAT-00001', 'Hand-tied Bouquets', 'A selection of fresh flowers expertly arranged and tied by hand, perfect for personal gifts and special occasions'),
('CAT-00002', 'Vase Arrangements', 'Beautifully arranged flowers in a vase, ready to display for instant elegance and charm.'),
('CAT-00003', 'Basket Arrangements', 'Charming floral arrangements set in decorative baskets, adding a rustic touch to any setting'),
('CAT-00004', 'Boxed Flowers', 'A modern take on flower gifting, with blooms carefully arranged in a stylish box for a unique presentation.'),
('CAT-00005', 'Centerpieces', 'Stunning floral displays designed to be the focal point of tables at weddings, events, or home decor');

--
-- Triggers `categories`
--
DELIMITER $$
CREATE TRIGGER `category_id` BEFORE INSERT ON `categories` FOR EACH ROW BEGIN
    DECLARE max_id INT;
    DECLARE new_id VARCHAR(10);

    SELECT MAX(CAST(SUBSTRING(id, 5) AS UNSIGNED)) INTO max_id FROM categories;
    SET new_id = CONCAT('CAT-', LPAD(IFNULL(max_id, 0) + 1, 5, '0'));

    SET NEW.id = new_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `delivery_statuses`
--

CREATE TABLE `delivery_statuses` (
  `id` varchar(10) NOT NULL,
  `delivery_status` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `delivery_statuses`
--

INSERT INTO `delivery_statuses` (`id`, `delivery_status`) VALUES
('DEL-00001', 'Awaiting Pickup'),
('DEL-00002', 'Out for delivery'),
('DEL-00003', 'Delayed'),
('DEL-00004', 'Delivered'),
('DEL-00005', 'Failed');

--
-- Triggers `delivery_statuses`
--
DELIMITER $$
CREATE TRIGGER `delivery_status` BEFORE INSERT ON `delivery_statuses` FOR EACH ROW BEGIN
    DECLARE max_id INT;
    DECLARE new_id VARCHAR(10);

    SELECT MAX(CAST(SUBSTRING(id, 5) AS UNSIGNED)) INTO max_id FROM delivery_statuses;
    SET new_id = CONCAT('DEL-', LPAD(IFNULL(max_id, 0) + 1, 5, '0'));

    SET NEW.id = new_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `flowers`
--

CREATE TABLE `flowers` (
  `id` varchar(10) NOT NULL,
  `flower_name` varchar(32) NOT NULL,
  `flower_description` text NOT NULL,
  `flower_price` decimal(10,0) NOT NULL,
  `stock_quantity` int(255) NOT NULL,
  `category_id` varchar(10) NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `flowers`
--

INSERT INTO `flowers` (`id`, `flower_name`, `flower_description`, `flower_price`, `stock_quantity`, `category_id`, `image`) VALUES
('FLO-00001', 'Elegant White Lilies', 'These pristine white lilies symbolize purity and grace. Each stem typically bears multiple large, trumpet-shaped blooms with a sweet, captivating fragrance.', 12, 42, 'CAT-00001', NULL),
('FLO-00002', 'Radiant Sunflowers', 'Bright and cheerful, these radiant sunflowers symbolize happiness and warmth. ', 12, 24, 'CAT-00005', NULL),
('FLO-00003', 'a', 'a', 1, 1, 'CAT-00001', NULL);

--
-- Triggers `flowers`
--
DELIMITER $$
CREATE TRIGGER `flower_id` BEFORE INSERT ON `flowers` FOR EACH ROW BEGIN
    DECLARE max_id INT;
    DECLARE new_id VARCHAR(10);

    SELECT MAX(CAST(SUBSTRING(id, 5) AS UNSIGNED)) INTO max_id FROM flowers;
    SET new_id = CONCAT('FLO-', LPAD(IFNULL(max_id, 0) + 1, 5, '0'));

    SET NEW.id = new_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `order_deliveries`
--

CREATE TABLE `order_deliveries` (
  `id` varchar(10) NOT NULL,
  `orderstatus_id` varchar(10) NOT NULL,
  `deliverystatus_id` varchar(10) NOT NULL,
  `order_date` date NOT NULL,
  `total_amount` decimal(10,0) NOT NULL,
  `delivery_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `order_deliveries`
--

INSERT INTO `order_deliveries` (`id`, `orderstatus_id`, `deliverystatus_id`, `order_date`, `total_amount`, `delivery_date`) VALUES
('ODD-00001', 'ORS-00001', 'DEL-00001', '2024-04-11', 54, '2024-04-16');

--
-- Triggers `order_deliveries`
--
DELIMITER $$
CREATE TRIGGER `orderdeliver_id` BEFORE INSERT ON `order_deliveries` FOR EACH ROW BEGIN
    DECLARE max_id INT;
    DECLARE new_id VARCHAR(10);

    SELECT MAX(CAST(SUBSTRING(id, 5) AS UNSIGNED)) INTO max_id FROM order_deliveries;
    SET new_id = CONCAT('ODD-', LPAD(IFNULL(max_id, 0) + 1, 5, '0'));

    SET NEW.id = new_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `order_flowers`
--

CREATE TABLE `order_flowers` (
  `id` varchar(10) NOT NULL,
  `flower_id` varchar(10) NOT NULL,
  `orderdelivery_id` varchar(10) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `order_flowers`
--

INSERT INTO `order_flowers` (`id`, `flower_id`, `orderdelivery_id`, `quantity`) VALUES
('ORD-00001', 'FLO-00001', 'ODD-00001', 13);

--
-- Triggers `order_flowers`
--
DELIMITER $$
CREATE TRIGGER `orderflower_id` BEFORE INSERT ON `order_flowers` FOR EACH ROW BEGIN
    DECLARE max_id INT;
    DECLARE new_id VARCHAR(10);

    SELECT MAX(CAST(SUBSTRING(id, 5) AS UNSIGNED)) INTO max_id FROM order_flowers;
    SET new_id = CONCAT('ORD-', LPAD(IFNULL(max_id, 0) + 1, 5, '0'));

    SET NEW.id = new_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `order_statuses`
--

CREATE TABLE `order_statuses` (
  `id` varchar(10) NOT NULL,
  `order_type` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `order_statuses`
--

INSERT INTO `order_statuses` (`id`, `order_type`) VALUES
('ORS-00001', 'Pending'),
('ORS-00002', 'Processing'),
('ORS-00003', 'On Hold'),
('ORS-00004', 'Completed'),
('ORS-00005', 'Cancelled');

--
-- Triggers `order_statuses`
--
DELIMITER $$
CREATE TRIGGER `order_id` BEFORE INSERT ON `order_statuses` FOR EACH ROW BEGIN
    DECLARE max_id INT;
    DECLARE new_id VARCHAR(10);

    SELECT MAX(CAST(SUBSTRING(id, 5) AS UNSIGNED)) INTO max_id FROM order_statuses;
    SET new_id = CONCAT('ORS-', LPAD(IFNULL(max_id, 0) + 1, 5, '0'));

    SET NEW.id = new_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` varchar(10) NOT NULL,
  `orderdelivery_id` varchar(10) NOT NULL,
  `paymentstatus_id` varchar(10) NOT NULL,
  `paymentmethod_id` varchar(10) NOT NULL,
  `user_id` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `orderdelivery_id`, `paymentstatus_id`, `paymentmethod_id`, `user_id`) VALUES
('PAY-00001', 'ODD-00001', 'PAS-00001', 'PAM-00001', 'USE-00001');

--
-- Triggers `payments`
--
DELIMITER $$
CREATE TRIGGER `payment_id` BEFORE INSERT ON `payments` FOR EACH ROW BEGIN
    DECLARE max_id INT;
    DECLARE new_id VARCHAR(10);

    SELECT MAX(CAST(SUBSTRING(id, 5) AS UNSIGNED)) INTO max_id FROM payments;
    SET new_id = CONCAT('PAY-', LPAD(IFNULL(max_id, 0) + 1, 5, '0'));

    SET NEW.id = new_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `payment_methods`
--

CREATE TABLE `payment_methods` (
  `id` varchar(10) NOT NULL,
  `method_type` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `payment_methods`
--

INSERT INTO `payment_methods` (`id`, `method_type`) VALUES
('PAM-00001', 'Wire Transfer'),
('PAM-00002', 'BPay'),
('PAM-00003', 'Direct Debit'),
('PAM-00004', 'Credit Card');

--
-- Triggers `payment_methods`
--
DELIMITER $$
CREATE TRIGGER `payment_method_id` BEFORE INSERT ON `payment_methods` FOR EACH ROW BEGIN
    DECLARE max_id INT;
    DECLARE new_id VARCHAR(10);

    SELECT MAX(CAST(SUBSTRING(id, 5) AS UNSIGNED)) INTO max_id FROM payment_methods;
    SET new_id = CONCAT('PAM-', LPAD(IFNULL(max_id, 0) + 1, 5, '0'));

    SET NEW.id = new_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `payment_statuses`
--

CREATE TABLE `payment_statuses` (
  `id` varchar(10) NOT NULL,
  `status_type` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `payment_statuses`
--

INSERT INTO `payment_statuses` (`id`, `status_type`) VALUES
('PAS-00001', 'In Progress'),
('PAS-00002', 'Completed'),
('PAS-00003', 'Failed'),
('PAS-00004', 'Cancelled');

--
-- Triggers `payment_statuses`
--
DELIMITER $$
CREATE TRIGGER `payment_status_id` BEFORE INSERT ON `payment_statuses` FOR EACH ROW BEGIN
    DECLARE max_id INT;
    DECLARE new_id VARCHAR(10);

    SELECT MAX(CAST(SUBSTRING(id, 5) AS UNSIGNED)) INTO max_id FROM payment_statuses;
    SET new_id = CONCAT('PAS-', LPAD(IFNULL(max_id, 0) + 1, 5, '0'));

    SET NEW.id = new_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` varchar(10) NOT NULL,
  `username` text NOT NULL,
  `email` text NOT NULL,
  `password` varchar(256) NOT NULL,
  `address` text NOT NULL,
  `phone_no` text NOT NULL,
  `isAdmin` tinyint(1) NOT NULL,
  `nonce` varchar(256) NOT NULL,
  `nonce_expiry` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `address`, `phone_no`, `isAdmin`, `nonce`, `nonce_expiry`) VALUES
('USE-00001', 'customer12', 'rmn223@gmail.com', 'xxx', 'Konawarra Street VIC ', '0452483345', 0, '2332', '2024-04-16'),
('USE-00002', 'a', 'a@test.com', '1', 'a', '1', 1, '1', '2024-04-16');

--
-- Triggers `users`
--
DELIMITER $$
CREATE TRIGGER `user_id` BEFORE INSERT ON `users` FOR EACH ROW BEGIN
    DECLARE max_id INT;
    DECLARE new_id VARCHAR(10);

    SELECT MAX(CAST(SUBSTRING(id, 5) AS UNSIGNED)) INTO max_id FROM users;
    SET new_id = CONCAT('USE-', LPAD(IFNULL(max_id, 0) + 1, 5, '0'));

    SET NEW.id = new_id;
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_statuses`
--
ALTER TABLE `delivery_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `flowers`
--
ALTER TABLE `flowers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `flower_category` (`category_id`);

--
-- Indexes for table `order_deliveries`
--
ALTER TABLE `order_deliveries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `deliverystatus_id` (`deliverystatus_id`),
  ADD KEY `orderstatus_id` (`orderstatus_id`);

--
-- Indexes for table `order_flowers`
--
ALTER TABLE `order_flowers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orderflower_flower` (`flower_id`),
  ADD KEY `orderflower_orderdelivery` (`orderdelivery_id`);

--
-- Indexes for table `order_statuses`
--
ALTER TABLE `order_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `paymentmethod_id` (`paymentmethod_id`),
  ADD KEY `paymentstatus_id` (`paymentstatus_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `orderdelivery_id` (`orderdelivery_id`);

--
-- Indexes for table `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_statuses`
--
ALTER TABLE `payment_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `flowers`
--
ALTER TABLE `flowers`
  ADD CONSTRAINT `flower_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `order_deliveries`
--
ALTER TABLE `order_deliveries`
  ADD CONSTRAINT `orderdelivery_deliverystatus` FOREIGN KEY (`deliverystatus_id`) REFERENCES `delivery_statuses` (`id`),
  ADD CONSTRAINT `orderdelivery_orderstatus` FOREIGN KEY (`orderstatus_id`) REFERENCES `order_statuses` (`id`);

--
-- Constraints for table `order_flowers`
--
ALTER TABLE `order_flowers`
  ADD CONSTRAINT `orderflower_flower` FOREIGN KEY (`flower_id`) REFERENCES `flowers` (`id`),
  ADD CONSTRAINT `orderflower_orderdelivery` FOREIGN KEY (`orderdelivery_id`) REFERENCES `order_deliveries` (`id`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payment_orderdelivery` FOREIGN KEY (`orderdelivery_id`) REFERENCES `order_deliveries` (`id`),
  ADD CONSTRAINT `payment_paymentmethod` FOREIGN KEY (`paymentmethod_id`) REFERENCES `payment_methods` (`id`),
  ADD CONSTRAINT `payment_paymentstatus` FOREIGN KEY (`paymentstatus_id`) REFERENCES `payment_statuses` (`id`),
  ADD CONSTRAINT `payment_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
