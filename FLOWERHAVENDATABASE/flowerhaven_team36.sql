-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 12, 2024 at 10:19 AM
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
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` varchar(10) NOT NULL,
  `category_name` varchar(255) DEFAULT NULL,
  `category_description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category_name`, `category_description`) VALUES
('CAT-00001', 'Hand-tied Bouquets', 'A selection of fresh flowers expertly arranged and tied by hand, perfect for personal gifts and special occasions'),
('CAT-00002', 'Vase Arrangements', 'Beautifully arranged flowers in a vase, ready to display for instant elegance and charm.'),
('CAT-00003', 'Basket Arrangements', 'Charming floral arrangements set in decorative baskets, adding a rustic touch to any setting'),
('CAT-00004', 'Boxed Flowers', 'A modern take on flower gifting, with blooms carefully arranged in a stylish box for a unique presentation.'),
('CAT-00005', 'Centerpieces', 'Stunning floral displays designed to be the focal point of tables at weddings, events, or home decor');

--
-- Triggers `category`
--
DELIMITER $$
CREATE TRIGGER `category_id` BEFORE INSERT ON `category` FOR EACH ROW BEGIN
    DECLARE max_id INT;
    DECLARE new_id VARCHAR(10);

    SELECT MAX(CAST(SUBSTRING(id, 5) AS UNSIGNED)) INTO max_id FROM category;
    SET new_id = CONCAT('CAT-', LPAD(IFNULL(max_id, 0) + 1, 5, '0'));

    SET NEW.id = new_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `delivery_status`
--

CREATE TABLE `delivery_status` (
  `id` varchar(10) NOT NULL,
  `delivery_status` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `delivery_status`
--

INSERT INTO `delivery_status` (`id`, `delivery_status`) VALUES
('DEL-00001', 'Awaiting Pickup'),
('DEL-00002', 'Out for delivery'),
('DEL-00003', 'Delayed'),
('DEL-00004', 'Delivered'),
('DEL-00005', 'Failed');

--
-- Triggers `delivery_status`
--
DELIMITER $$
CREATE TRIGGER `delivery_status` BEFORE INSERT ON `delivery_status` FOR EACH ROW BEGIN
    DECLARE max_id INT;
    DECLARE new_id VARCHAR(10);

    SELECT MAX(CAST(SUBSTRING(id, 5) AS UNSIGNED)) INTO max_id FROM delivery_status;
    SET new_id = CONCAT('DEL-', LPAD(IFNULL(max_id, 0) + 1, 5, '0'));

    SET NEW.id = new_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `flower`
--

CREATE TABLE `flower` (
  `id` varchar(10) NOT NULL,
  `flower_name` varchar(32) NOT NULL,
  `flower_description` text NOT NULL,
  `flower_price` decimal(10,0) NOT NULL,
  `stock_quantity` int(255) NOT NULL,
  `category_id` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `flower`
--

INSERT INTO `flower` (`id`, `flower_name`, `flower_description`, `flower_price`, `stock_quantity`, `category_id`) VALUES
('FLO-00001', 'Elegant White Lilies', 'These pristine white lilies symbolize purity and grace. Each stem typically bears multiple large, trumpet-shaped blooms with a sweet, captivating fragrance.', 12, 42, 'CAT-00001'),
('FLO-00002', 'Radiant Sunflowers', 'Bright and cheerful, these radiant sunflowers symbolize happiness and warmth. ', 21, 24, 'CAT-00002');

--
-- Triggers `flower`
--
DELIMITER $$
CREATE TRIGGER `flower_id` BEFORE INSERT ON `flower` FOR EACH ROW BEGIN
    DECLARE max_id INT;
    DECLARE new_id VARCHAR(10);

    SELECT MAX(CAST(SUBSTRING(id, 5) AS UNSIGNED)) INTO max_id FROM flower;
    SET new_id = CONCAT('FLO-', LPAD(IFNULL(max_id, 0) + 1, 5, '0'));

    SET NEW.id = new_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `order_delivery`
--

CREATE TABLE `order_delivery` (
  `id` varchar(10) NOT NULL,
  `orderstatus_id` varchar(10) NOT NULL,
  `deliverystatus_id` varchar(10) NOT NULL,
  `order_date` date NOT NULL,
  `total_amount` decimal(10,0) NOT NULL,
  `delivery_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `order_delivery`
--

INSERT INTO `order_delivery` (`id`, `orderstatus_id`, `deliverystatus_id`, `order_date`, `total_amount`, `delivery_date`) VALUES
('ODD-00001', 'ORS-00001', 'DEL-00001', '2024-04-11', 54, '2024-04-16');

--
-- Triggers `order_delivery`
--
DELIMITER $$
CREATE TRIGGER `orderdeliver_id` BEFORE INSERT ON `order_delivery` FOR EACH ROW BEGIN
    DECLARE max_id INT;
    DECLARE new_id VARCHAR(10);

    SELECT MAX(CAST(SUBSTRING(id, 5) AS UNSIGNED)) INTO max_id FROM order_delivery;
    SET new_id = CONCAT('ODD-', LPAD(IFNULL(max_id, 0) + 1, 5, '0'));

    SET NEW.id = new_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `order_flower`
--

CREATE TABLE `order_flower` (
  `id` varchar(10) NOT NULL,
  `flower_id` varchar(10) NOT NULL,
  `orderdelivery_id` varchar(10) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `order_flower`
--

INSERT INTO `order_flower` (`id`, `flower_id`, `orderdelivery_id`, `quantity`) VALUES
('ORD-00001', 'FLO-00001', 'ODD-00001', 13);

--
-- Triggers `order_flower`
--
DELIMITER $$
CREATE TRIGGER `orderflower_id` BEFORE INSERT ON `order_flower` FOR EACH ROW BEGIN
    DECLARE max_id INT;
    DECLARE new_id VARCHAR(10);

    SELECT MAX(CAST(SUBSTRING(id, 5) AS UNSIGNED)) INTO max_id FROM order_flower;
    SET new_id = CONCAT('ORD-', LPAD(IFNULL(max_id, 0) + 1, 5, '0'));

    SET NEW.id = new_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

CREATE TABLE `order_status` (
  `id` varchar(10) NOT NULL,
  `order_type` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `order_status`
--

INSERT INTO `order_status` (`id`, `order_type`) VALUES
('ORS-00001', 'Pending'),
('ORS-00002', 'Processing'),
('ORS-00003', 'On Hold'),
('ORS-00004', 'Completed'),
('ORS-00005', 'Cancelled');

--
-- Triggers `order_status`
--
DELIMITER $$
CREATE TRIGGER `order_id` BEFORE INSERT ON `order_status` FOR EACH ROW BEGIN
    DECLARE max_id INT;
    DECLARE new_id VARCHAR(10);

    SELECT MAX(CAST(SUBSTRING(id, 5) AS UNSIGNED)) INTO max_id FROM order_status;
    SET new_id = CONCAT('ORS-', LPAD(IFNULL(max_id, 0) + 1, 5, '0'));

    SET NEW.id = new_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` varchar(10) NOT NULL,
  `orderdelivery_id` varchar(10) NOT NULL,
  `paymentstatus_id` varchar(10) NOT NULL,
  `paymentmethod_id` varchar(10) NOT NULL,
  `user_id` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `orderdelivery_id`, `paymentstatus_id`, `paymentmethod_id`, `user_id`) VALUES
('PAY-00001', 'ODD-00001', 'PAS-00001', 'PAM-00001', 'USE-00001');

--
-- Triggers `payment`
--
DELIMITER $$
CREATE TRIGGER `payment_id` BEFORE INSERT ON `payment` FOR EACH ROW BEGIN
    DECLARE max_id INT;
    DECLARE new_id VARCHAR(10);

    SELECT MAX(CAST(SUBSTRING(id, 5) AS UNSIGNED)) INTO max_id FROM payment;
    SET new_id = CONCAT('PAY-', LPAD(IFNULL(max_id, 0) + 1, 5, '0'));

    SET NEW.id = new_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `payment_method`
--

CREATE TABLE `payment_method` (
  `id` varchar(10) NOT NULL,
  `method_type` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `payment_method`
--

INSERT INTO `payment_method` (`id`, `method_type`) VALUES
('PAM-00001', 'Wire Transfer'),
('PAM-00002', 'BPay'),
('PAM-00003', 'Direct Debit'),
('PAM-00004', 'Credit Card');

--
-- Triggers `payment_method`
--
DELIMITER $$
CREATE TRIGGER `payment_method_id` BEFORE INSERT ON `payment_method` FOR EACH ROW BEGIN
    DECLARE max_id INT;
    DECLARE new_id VARCHAR(10);

    SELECT MAX(CAST(SUBSTRING(id, 5) AS UNSIGNED)) INTO max_id FROM payment_method;
    SET new_id = CONCAT('PAM-', LPAD(IFNULL(max_id, 0) + 1, 5, '0'));

    SET NEW.id = new_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `payment_status`
--

CREATE TABLE `payment_status` (
  `id` varchar(10) NOT NULL,
  `status_type` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `payment_status`
--

INSERT INTO `payment_status` (`id`, `status_type`) VALUES
('PAS-00001', 'In Progress'),
('PAS-00002', 'Completed'),
('PAS-00003', 'Failed'),
('PAS-00004', 'Cancelled');

--
-- Triggers `payment_status`
--
DELIMITER $$
CREATE TRIGGER `payment_status_id` BEFORE INSERT ON `payment_status` FOR EACH ROW BEGIN
    DECLARE max_id INT;
    DECLARE new_id VARCHAR(10);

    SELECT MAX(CAST(SUBSTRING(id, 5) AS UNSIGNED)) INTO max_id FROM payment_status;
    SET new_id = CONCAT('PAS-', LPAD(IFNULL(max_id, 0) + 1, 5, '0'));

    SET NEW.id = new_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` varchar(10) NOT NULL,
  `username` text NOT NULL,
  `email` text NOT NULL,
  `password` varchar(256) NOT NULL,
  `address` text NOT NULL,
  `phone_no` text NOT NULL,
  `isAdmin` tinyint(1) NOT NULL,
  `nonce` varchar(256) NOT NULL,
  `non_expiry` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `address`, `phone_no`, `isAdmin`, `nonce`, `non_expiry`) VALUES
('USE-00001', 'customer1', 'rmn223@gmail.com', 'xxx', 'Konawarra Street VIC ', '0452483345', 0, '', '0000-00-00');

--
-- Triggers `user`
--
DELIMITER $$
CREATE TRIGGER `user_id` BEFORE INSERT ON `user` FOR EACH ROW BEGIN
    DECLARE max_id INT;
    DECLARE new_id VARCHAR(10);

    SELECT MAX(CAST(SUBSTRING(id, 5) AS UNSIGNED)) INTO max_id FROM user;
    SET new_id = CONCAT('USE-', LPAD(IFNULL(max_id, 0) + 1, 5, '0'));

    SET NEW.id = new_id;
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_status`
--
ALTER TABLE `delivery_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `flower`
--
ALTER TABLE `flower`
  ADD PRIMARY KEY (`id`),
  ADD KEY `flower_category` (`category_id`);

--
-- Indexes for table `order_delivery`
--
ALTER TABLE `order_delivery`
  ADD PRIMARY KEY (`id`),
  ADD KEY `deliverystatus_id` (`deliverystatus_id`),
  ADD KEY `orderstatus_id` (`orderstatus_id`);

--
-- Indexes for table `order_flower`
--
ALTER TABLE `order_flower`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orderflower_flower` (`flower_id`),
  ADD KEY `orderflower_orderdelivery` (`orderdelivery_id`);

--
-- Indexes for table `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `paymentmethod_id` (`paymentmethod_id`),
  ADD KEY `paymentstatus_id` (`paymentstatus_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `orderdelivery_id` (`orderdelivery_id`);

--
-- Indexes for table `payment_method`
--
ALTER TABLE `payment_method`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_status`
--
ALTER TABLE `payment_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `flower`
--
ALTER TABLE `flower`
  ADD CONSTRAINT `flower_category` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);

--
-- Constraints for table `order_delivery`
--
ALTER TABLE `order_delivery`
  ADD CONSTRAINT `orderdelivery_deliverystatus` FOREIGN KEY (`deliverystatus_id`) REFERENCES `delivery_status` (`id`),
  ADD CONSTRAINT `orderdelivery_orderstatus` FOREIGN KEY (`orderstatus_id`) REFERENCES `order_status` (`id`);

--
-- Constraints for table `order_flower`
--
ALTER TABLE `order_flower`
  ADD CONSTRAINT `orderflower_flower` FOREIGN KEY (`flower_id`) REFERENCES `flower` (`id`),
  ADD CONSTRAINT `orderflower_orderdelivery` FOREIGN KEY (`orderdelivery_id`) REFERENCES `order_delivery` (`id`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_orderdelivery` FOREIGN KEY (`orderdelivery_id`) REFERENCES `order_delivery` (`id`),
  ADD CONSTRAINT `payment_paymentmethod` FOREIGN KEY (`paymentmethod_id`) REFERENCES `payment_method` (`id`),
  ADD CONSTRAINT `payment_paymentstatus` FOREIGN KEY (`paymentstatus_id`) REFERENCES `payment_status` (`id`),
  ADD CONSTRAINT `payment_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
