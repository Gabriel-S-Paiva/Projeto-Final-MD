-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 17, 2025 at 06:47 PM
-- Server version: 8.0.17
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `komodu`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `created_at`) VALUES
(2, 2, '2025-08-15 18:43:26'),
(3, 3, '2025-08-15 18:43:26'),
(4, 4, '2025-08-15 18:43:26'),
(5, 5, '2025-08-15 18:43:26'),
(6, 6, '2025-08-16 11:46:51'),
(7, 7, '2025-08-16 16:24:56'),
(8, 2, '2025-08-17 17:27:57'),
(9, 3, '2025-08-17 17:27:57'),
(10, 4, '2025-08-17 17:27:57'),
(11, 5, '2025-08-17 17:27:57');

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `id` int(11) NOT NULL,
  `cart_id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  `variant_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cart_items`
--

INSERT INTO `cart_items` (`id`, `cart_id`, `module_id`, `variant_id`, `quantity`) VALUES
(3, 2, 8, 0, 1),
(4, 2, 9, 0, 2),
(5, 3, 7, 0, 1),
(6, 3, 6, 0, 1),
(7, 4, 3, 0, 1),
(8, 4, 10, 0, 1),
(9, 5, 5, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
  `user_id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `favorites`
--

INSERT INTO `favorites` (`user_id`, `module_id`) VALUES
(2, 1),
(3, 2),
(4, 3),
(5, 4),
(2, 5),
(6, 5),
(3, 6);

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `width` int(11) NOT NULL,
  `height` int(11) NOT NULL,
  `depth` int(11) NOT NULL,
  `type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `compatible_with` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `base_module_id` int(11) DEFAULT NULL,
  `tags` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(10,2) DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `name`, `description`, `width`, `height`, `depth`, `type`, `color`, `compatible_with`, `image`, `base_module_id`, `tags`, `price`) VALUES
(1, 'Base Shelf', 'Modular shelf for living rooms.', 80, 40, 30, 'shelf', '#3A4A5A', '2,3', 'Assets/Imgs/planer.png', NULL, 'empilhavel,compacto', '250.00'),
(2, 'Corner Unit', 'Corner module for flexible arrangements.', 40, 40, 30, 'corner', '#A5B5C0', '1,3', 'Assets/Imgs/hero_mobile.png', NULL, 'compacto', '12.45'),
(3, 'Tall Cabinet', 'Tall storage cabinet.', 80, 180, 40, 'cabinet', '#E5DCCA', '1,2', 'Assets/Imgs/wheel1.png', NULL, 'empilhavel', '15.99'),
(4, 'TV Stand', 'Low TV stand with drawers.', 120, 40, 40, 'stand', '#2E2E2E', '1', 'Assets/Imgs/planer.png', NULL, NULL, '124.00'),
(5, 'Shoe Rack', 'Compact shoe rack for entryways.', 60, 40, 30, 'rack', '#3A4A5A', '2', 'Assets/Imgs/hero_mobile.png', NULL, NULL, '2.99'),
(6, 'Wall Panel', 'Decorative wall panel.', 100, 200, 5, 'panel', '#A5B5C0', '3', 'Assets/Imgs/wheel1.png', NULL, NULL, '0.99'),
(7, 'Desk Module', 'Modular desk for home office.', 120, 75, 60, 'desk', '#E5DCCA', '1,4', 'Assets/Imgs/planer.png', NULL, NULL, '18.99'),
(8, 'Bed Base', 'Modular bed base.', 160, 30, 200, 'bed', '#2E2E2E', '6', 'Assets/Imgs/hero_mobile.png', NULL, NULL, '15.36'),
(9, 'Nightstand', 'Small nightstand.', 40, 50, 40, 'stand', '#3A4A5A', '8', 'Assets/Imgs/wheel1.png', NULL, NULL, '48.59'),
(10, 'Bookshelf', 'Tall bookshelf.', 80, 180, 30, 'shelf', '#A5B5C0', '1,3', 'Assets/Imgs/planer.png', NULL, NULL, '999.99'),
(13, 'Komudu Sofa', 'Modular sofa for living rooms.', 200, 80, 90, 'sofa', '#3A4A5A', '2,3', 'Assets/Imgs/AssetsImgssofa.png', NULL, 'empilhavel,conforto', '499.99'),
(14, 'Coffee Table', 'Minimalist coffee table.', 100, 40, 60, 'table', '#A5B5C0', '1', 'Assets/Imgs/planer.png', NULL, 'compacto', '89.99'),
(15, 'Wall Shelf', 'Floating wall shelf.', 120, 30, 25, 'shelf', '#E5DCCA', '1,2', 'Assets/Imgs/planer.png', NULL, 'empilhavel,decorativo', '59.99'),
(16, 'TV Cabinet', 'Cabinet for TV and electronics.', 180, 50, 45, 'cabinet', '#2E2E2E', '1,3', 'Assets/Imgs/planer.png', NULL, 'armazenamento', '299.99'),
(17, 'Dining Chair', 'Stackable dining chair.', 45, 90, 45, 'chair', '#A5B5C0', '2', 'Assets/Imgs/planer.png', NULL, 'empilhavel', '39.99'),
(18, 'Bookshelf', 'Tall bookshelf for offices.', 80, 200, 30, 'shelf', '#3A4A5A', '3', 'Assets/Imgs/planer.png', NULL, 'armazenamento', '129.99'),
(19, 'Bed Frame', 'Queen size bed frame.', 160, 35, 200, 'bed', '#E5DCCA', '6', 'Assets/Imgs/planer.png', NULL, 'conforto', '399.99'),
(20, 'Desk', 'Work desk with drawers.', 140, 75, 70, 'desk', '#2E2E2E', '4', 'Assets/Imgs/planer.png', NULL, 'compacto', '199.99'),
(21, 'Nightstand', 'Small nightstand.', 50, 55, 40, 'stand', '#A5B5C0', '7', 'Assets/Imgs/planer.png', NULL, 'compacto', '49.99'),
(22, 'Shoe Cabinet', 'Cabinet for shoes.', 80, 100, 35, 'cabinet', '#3A4A5A', '5', 'Assets/Imgs/planer.png', NULL, 'armazenamento', '89.99');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `cart_id` int(11) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT 'pending',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `cart_id`, `total`, `status`, `created_at`) VALUES
(2, 2, 2, '220.00', 'pending', '2025-08-15 18:43:26'),
(3, 3, 3, '180.00', 'completed', '2025-08-15 18:43:26'),
(4, 4, 4, '400.00', 'pending', '2025-08-15 18:43:26'),
(5, 5, 5, '90.00', 'completed', '2025-08-15 18:43:26'),
(6, 7, 7, '97.97', 'completed', '2025-08-16 16:32:12'),
(7, 7, 7, '803.98', 'completed', '2025-08-16 16:33:07'),
(12, 6, 6, '801.96', 'completed', '2025-08-17 19:12:56');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  `variant_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `module_id`, `variant_id`, `quantity`, `price`) VALUES
(1, 6, 3, 4, 3, '15.99'),
(2, 7, 5, 6, 1, '2.99'),
(3, 7, 6, 7, 1, '0.99'),
(4, 7, 1, 1, 3, '250.00'),
(5, 12, 1, 1, 2, '250.00'),
(6, 12, 6, 7, 4, '0.99'),
(7, 12, 4, 5, 2, '124.00');

-- --------------------------------------------------------

--
-- Table structure for table `simulations`
--

CREATE TABLE `simulations` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `room_width` int(11) DEFAULT NULL,
  `room_height` int(11) DEFAULT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `simulations`
--

INSERT INTO `simulations` (`id`, `user_id`, `room_width`, `room_height`, `name`, `created_at`) VALUES
(7, 6, 900, 600, 'Hello', '2025-08-16 15:40:40'),
(8, 2, 400, 300, 'Sala Moderna', '2025-08-17 17:28:39'),
(9, 3, 600, 400, 'Quarto Minimalista', '2025-08-17 17:28:39'),
(10, 4, 800, 500, 'Escritório Compacto', '2025-08-17 17:28:39'),
(11, 2, 400, 300, 'Sala Moderna', '2025-08-17 17:29:23'),
(12, 3, 600, 400, 'Quarto Minimalista', '2025-08-17 17:29:23'),
(13, 4, 800, 500, 'Escritório Compacto', '2025-08-17 17:29:23'),
(14, 7, 900, 600, 'Minha Simulação', '2025-08-17 19:20:40'),
(15, 7, 900, 600, 'Minha Simulação', '2025-08-17 19:26:57');

-- --------------------------------------------------------

--
-- Table structure for table `simulation_items`
--

CREATE TABLE `simulation_items` (
  `id` int(11) NOT NULL,
  `simulation_id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  `x` int(11) NOT NULL,
  `y` int(11) NOT NULL,
  `w` int(11) NOT NULL,
  `h` int(11) NOT NULL,
  `rotation` float DEFAULT '0',
  `scale` float DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `simulation_items`
--

INSERT INTO `simulation_items` (`id`, `simulation_id`, `module_id`, `x`, `y`, `w`, `h`, `rotation`, `scale`) VALUES
(20, 14, 2, 440, 290, 20, 20, 0, 3),
(21, 14, 2, 440, 290, 20, 20, 0, 1),
(22, 15, 2, 440, 290, 20, 20, 0, 3),
(23, 15, 2, 440, 290, 20, 20, 0, 1),
(24, 15, 2, 460, 310, 20, 20, 0, 3),
(25, 15, 2, 480, 330, 20, 20, 0, 3),
(26, 15, 2, 500, 350, 20, 20, 0, 3),
(27, 15, 2, 520, 370, 20, 20, 0, 3),
(28, 15, 2, 540, 390, 20, 20, 0, 3),
(29, 15, 2, 560, 410, 20, 20, 0, 3),
(30, 15, 2, 580, 430, 20, 20, 0, 3),
(31, 15, 2, 600, 450, 20, 20, 0, 3),
(32, 15, 2, 620, 470, 20, 20, 0, 3),
(33, 15, 2, 640, 490, 20, 20, 0, 3),
(34, 15, 2, 660, 510, 20, 20, 0, 3),
(35, 15, 2, 680, 530, 20, 20, 0, 3),
(36, 15, 2, 700, 540, 20, 20, 0, 3),
(37, 15, 2, 720, 540, 20, 20, 0, 3),
(38, 15, 2, 740, 540, 20, 20, 0, 3),
(39, 15, 2, 760, 540, 20, 20, 0, 3),
(40, 15, 2, 780, 540, 20, 20, 0, 3),
(41, 15, 2, 800, 540, 20, 20, 0, 3),
(42, 15, 2, 820, 540, 20, 20, 0, 3),
(43, 15, 2, 840, 540, 20, 20, 0, 3),
(44, 15, 2, 840, 540, 20, 20, 0, 3),
(45, 15, 2, 440, 290, 20, 20, 0, 1),
(46, 15, 3, 430, 255, 40, 90, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `role` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT 'user',
  `age` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password_hash`, `name`, `created_at`, `address`, `role`, `age`) VALUES
(2, 'bob', 'bob@example.com', 'hash2', 'Bob Costa', '2025-08-15 18:43:25', '', 'admin', NULL),
(3, 'carla', 'carla@example.com', 'hash3', 'Carla Mendes', '2025-08-15 18:43:25', '', 'user', NULL),
(4, 'daniel', 'daniel@example.com', 'hash4', 'Daniel Rocha', '2025-08-15 18:43:25', '', 'user', NULL),
(5, 'eva', 'eva@example.com', 'hash5', 'Eva Martins', '2025-08-15 18:43:25', '', 'user', NULL),
(6, 'Gabriel', 'mr.sousapaiva@gmail.com', '$2y$10$m.D/8rmdWNfLMHRrQmuYauP1qtwdBDPZt8w.piGKLIUUTsF./bDWu', 'Gabriel P', '2025-08-15 23:20:31', 'R. qualquer', 'user', 21),
(7, 'admin', 'admin@sistema.com', '$2y$10$S21LBFHAcPR3F1hIJi1yX.v.KpvtsiagiHYrg77LYhdy8PGDIBpTq', 'admin', '2025-08-16 16:07:49', '', 'admin', NULL),
(20, 'alice', 'alice@komudu.com', '$2y$10$alicehash', 'Alice Silva', '2025-08-17 17:27:20', 'Rua das Flores, 12', 'user', 28),
(21, 'bruno', 'bruno@komudu.com', '$2y$10$brunohash', 'Bruno Costa', '2025-08-17 17:27:20', 'Av. Central, 45', 'user', 35);

-- --------------------------------------------------------

--
-- Table structure for table `variants`
--

CREATE TABLE `variants` (
  `id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  `color` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `width` int(11) DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  `depth` int(11) DEFAULT NULL,
  `stock` int(11) DEFAULT '0',
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `variants`
--

INSERT INTO `variants` (`id`, `module_id`, `color`, `width`, `height`, `depth`, `stock`, `price`) VALUES
(1, 1, '#A5B5C0', 80, 40, 30, 28, '0.00'),
(2, 1, '#E5DCCA', 80, 40, 30, 18, NULL),
(3, 2, '#3A4A5A', 40, 40, 30, 18, NULL),
(4, 3, '#2E2E2E', 80, 180, 40, 17, NULL),
(5, 4, '#E5DCCA', 120, 40, 40, 18, NULL),
(6, 5, '#A5B5C0', 60, 40, 30, 17, NULL),
(7, 6, '#3A4A5A', 100, 200, 5, 15, NULL),
(8, 7, '#A5B5C0', 120, 75, 60, 20, NULL),
(9, 8, '#E5DCCA', 160, 30, 200, 20, NULL),
(10, 9, '#2E2E2E', 40, 50, 40, 20, NULL),
(11, 10, '#3A4A5A', 80, 180, 30, 20, NULL),
(12, 1, '#3A4A5A', 200, 80, 90, 10, '499.99'),
(13, 1, '#A5B5C0', 200, 80, 90, 5, '499.99'),
(14, 2, '#A5B5C0', 100, 40, 60, 20, '89.99'),
(15, 3, '#E5DCCA', 120, 30, 25, 15, '59.99'),
(16, 4, '#2E2E2E', 180, 50, 45, 8, '299.99'),
(17, 5, '#A5B5C0', 45, 90, 45, 30, '39.99'),
(18, 6, '#3A4A5A', 80, 200, 30, 12, '129.99'),
(19, 7, '#E5DCCA', 160, 35, 200, 7, '399.99'),
(20, 8, '#2E2E2E', 140, 75, 70, 10, '199.99'),
(21, 9, '#A5B5C0', 50, 55, 40, 18, '49.99'),
(22, 10, '#3A4A5A', 80, 100, 35, 6, '89.99');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_id` (`cart_id`),
  ADD KEY `module_id` (`module_id`);

--
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`user_id`,`module_id`),
  ADD KEY `module_id` (`module_id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `base_module_id` (`base_module_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `cart_id` (`cart_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `module_id` (`module_id`),
  ADD KEY `variant_id` (`variant_id`);

--
-- Indexes for table `simulations`
--
ALTER TABLE `simulations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `simulation_items`
--
ALTER TABLE `simulation_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `simulation_id` (`simulation_id`),
  ADD KEY `module_id` (`module_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `variants`
--
ALTER TABLE `variants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `module_id` (`module_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `simulations`
--
ALTER TABLE `simulations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `simulation_items`
--
ALTER TABLE `simulation_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `variants`
--
ALTER TABLE `variants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `cart_items_ibfk_1` FOREIGN KEY (`cart_id`) REFERENCES `cart` (`id`),
  ADD CONSTRAINT `cart_items_ibfk_2` FOREIGN KEY (`module_id`) REFERENCES `modules` (`id`);

--
-- Constraints for table `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `favorites_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `favorites_ibfk_2` FOREIGN KEY (`module_id`) REFERENCES `modules` (`id`);

--
-- Constraints for table `modules`
--
ALTER TABLE `modules`
  ADD CONSTRAINT `modules_ibfk_1` FOREIGN KEY (`base_module_id`) REFERENCES `modules` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`cart_id`) REFERENCES `cart` (`id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`module_id`) REFERENCES `modules` (`id`),
  ADD CONSTRAINT `order_items_ibfk_3` FOREIGN KEY (`variant_id`) REFERENCES `variants` (`id`);

--
-- Constraints for table `simulation_items`
--
ALTER TABLE `simulation_items`
  ADD CONSTRAINT `simulation_items_ibfk_1` FOREIGN KEY (`simulation_id`) REFERENCES `simulations` (`id`),
  ADD CONSTRAINT `simulation_items_ibfk_2` FOREIGN KEY (`module_id`) REFERENCES `modules` (`id`);

--
-- Constraints for table `variants`
--
ALTER TABLE `variants`
  ADD CONSTRAINT `variants_ibfk_1` FOREIGN KEY (`module_id`) REFERENCES `modules` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
