-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 31, 2026 at 11:17 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nuve_clothing_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `user_id`, `first_name`, `last_name`, `email`, `phone`, `message`, `created_at`) VALUES
(1, 1, 'test', 'testt', 'test@testmail.com', '049123123', 'test mesazh', '2026-01-30 16:38:19'),
(2, 1, 'test', 'testt', 'test@testmail.com', '87654321432', 'edewdweddewd', '2026-01-30 19:32:48');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `status` enum('Në Proces','Përfunduar','Anuluar') DEFAULT 'Në Proces',
  `total` decimal(10,2) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `date`, `status`, `total`, `created_at`, `updated_at`) VALUES
(2, 1, '2026-01-30 17:38:53', 'Në Proces', 38.00, '2026-01-30 17:38:53', '2026-01-30 17:38:53'),
(3, 2, '2026-01-30 18:19:53', 'Në Proces', 76.00, '2026-01-30 18:19:53', '2026-01-30 18:19:53'),
(4, 2, '2026-01-30 18:24:29', 'Në Proces', 76.00, '2026-01-30 18:24:29', '2026-01-30 18:24:29'),
(5, 2, '2026-01-30 18:25:32', 'Në Proces', 95.00, '2026-01-30 18:25:32', '2026-01-30 18:25:32'),
(6, 2, '2026-01-30 18:29:25', 'Në Proces', 114.00, '2026-01-30 18:29:25', '2026-01-30 18:29:25'),
(7, 2, '2026-01-30 18:34:20', 'Në Proces', 114.00, '2026-01-30 18:34:20', '2026-01-30 18:34:20'),
(8, 2, '2026-01-30 18:36:34', 'Në Proces', 114.00, '2026-01-30 18:36:34', '2026-01-30 18:36:34'),
(9, 2, '2026-01-30 18:36:53', 'Në Proces', 114.00, '2026-01-30 18:36:53', '2026-01-30 18:36:53'),
(10, 2, '2026-01-30 18:44:13', 'Në Proces', 19.00, '2026-01-30 18:44:13', '2026-01-30 18:44:13'),
(11, 2, '2026-01-30 18:50:23', 'Në Proces', 19.00, '2026-01-30 18:50:23', '2026-01-30 18:50:23'),
(12, 2, '2026-01-30 18:51:47', 'Në Proces', 38.00, '2026-01-30 18:51:47', '2026-01-30 18:51:47'),
(13, 2, '2026-01-30 18:53:34', 'Në Proces', 57.00, '2026-01-30 18:53:34', '2026-01-30 18:53:34'),
(14, 2, '2026-01-30 18:54:54', 'Në Proces', 19.00, '2026-01-30 18:54:54', '2026-01-30 18:54:54'),
(15, 2, '2026-01-30 19:00:31', 'Në Proces', 19.00, '2026-01-30 19:00:31', '2026-01-30 19:00:31'),
(16, 2, '2026-01-30 19:01:19', 'Në Proces', 38.00, '2026-01-30 19:01:19', '2026-01-30 19:01:19'),
(17, 2, '2026-01-30 19:15:13', 'Në Proces', 19.00, '2026-01-30 19:15:13', '2026-01-30 19:15:13'),
(20, 1, '2026-01-30 19:27:05', 'Në Proces', 38.00, '2026-01-30 19:27:05', '2026-01-30 19:27:05'),
(21, 1, '2026-01-30 19:30:39', 'Në Proces', 19.00, '2026-01-30 19:30:39', '2026-01-30 19:30:39');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT 1,
  `price_at_purchase` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price_at_purchase`) VALUES
(6, 9, 1, 6, 19.00),
(7, 10, 1, 1, 19.00),
(8, 11, 1, 1, 19.00),
(9, 12, 1, 2, 19.00),
(10, 13, 1, 3, 19.00),
(11, 14, 1, 1, 19.00),
(12, 15, 1, 1, 19.00),
(13, 16, 1, 2, 19.00),
(14, 17, 1, 1, 19.00),
(15, 20, 1, 2, 19.00),
(16, 21, 1, 1, 19.00);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title`, `content`, `image`) VALUES
(1, 'Rreth Nesh', 'Butiku ynë online është një markë e dedikuar modës moderne, e specializuar në ofrimin e veshjeve cilësore për gra dhe burra që kërkojnë stil, komoditet dhe çmim të arsyeshëm. Ne funksionojmë si një platformë e plotë blerjesh, ku çdo artikull përzgjidhet me kujdes për të reflektuar trendët aktualë dhe nevojat e përditshme të klientëve tanë. Koleksionet tona përfshijnë nga veshjet casual të përditshme, te kombinimet elegante për evente, gjithmonë me synim që çdo klient të gjejë diçka që i përshtatet personalitetit dhe stilit të tij.', 'library/about-us.avif'),
(2, 'Na Kontaktoni', 'Për çdo pyetje rreth porosive, madhësive, dërgesave apo bashkëpunimeve, ekipi ynë është gjithmonë i gatshëm t’ju ndihmojë. Na shkruani përmes formularit të kontaktit ose në rrjetet tona sociale dhe ne do të kthejmë përgjigje sa më shpejt që të jetë e mundur. Vlerësojmë çdo mesazh dhe jemi këtu për t’ju ofruar përvojën më të mirë të blerjes në butikun tonë online.', 'library/contact-us.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `sale` decimal(10,2) DEFAULT 0.00,
  `stock` int(11) DEFAULT 0,
  `image_url` varchar(255) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `sale`, `stock`, `image_url`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Xhaketë me rrip', 'Produkt test', 19.00, 5.00, 100, 'library/product.jpg', 1, '2026-01-30 17:36:23', '2026-01-30 21:22:17');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `text` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `name`, `text`, `created_at`) VALUES
(1, 'fellanza.egegji', 'Cilësi e lartë dhe shërbim shumë profesional. Kam porositur disa herë dhe gjithmonë kam marrë produkte perfekte, të sakta në ngjyra dhe madhësi...', '2026-01-30 17:27:33');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','customer') DEFAULT 'customer',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'test', 'testt', 'test@testmail.com', '$2y$10$MjU6WAOpWeKvbTybPyNmGe/v7ZHaEJNzMcI9iqwfspYPhjWhhKKt2', 'admin', '2026-01-30 16:37:48', '2026-01-30 19:07:33'),
(2, 'fellanza', 'egegji', 'fellanza.egegji@outlook.com', '$2y$10$Z8C5JfIFrpU5lDnYrcXaTuZECIQzMS5LxouWClbDhTdNDUTDYC1pS', 'customer', '2026-01-30 17:19:21', '2026-01-30 17:19:21'),
(3, 'TEST', 'TESTT', 'test@email.com', '$2y$10$ETfGA3Uiw0/RLLWpBnlZOOdccUwc/LDgbZzRgCAY.oLmkm38hk.fC', 'customer', '2026-01-30 19:22:39', '2026-01-30 19:22:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD CONSTRAINT `contact_messages_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
