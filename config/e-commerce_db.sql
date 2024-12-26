-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 26, 2024 at 06:49 AM
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
-- Database: `e-commerce_db`
--
CREATE DATABASE IF NOT EXISTS `e-commerce_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `e-commerce_db`;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `seller_id` int(10) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `variation_id` int(10) NOT NULL,
  `quantity` int(11) DEFAULT 1,
  `price` int(11) NOT NULL,
  `total_price` int(100) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `time_added` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `quantity_of_product` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `quantity_of_product`) VALUES
(1, 'Fashion & Apparel', 0),
(2, 'Electronics & Gadgets', 0),
(3, 'Home & Kitchen', 0),
(4, 'Health & Beauty', 0),
(5, 'Books, Movies, & Media', 0),
(6, 'Sports & Outdoor', 0),
(7, 'Food & Beverage', 0),
(8, 'Games & Hobbies', 2),
(9, 'Jewelry & Accessories', 0),
(10, 'Automotive', 0),
(11, 'Pet Supplies', 0),
(12, 'Baby & Kids', 0),
(13, 'Office & Stationery', 0),
(14, 'Travel & Luggage', 0),
(15, 'Virtual Products', 0);

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

CREATE TABLE `order_status` (
  `id` int(50) NOT NULL,
  `product_id` int(50) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `variation_id` int(10) NOT NULL,
  `seller_id` int(10) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `image` varchar(255) NOT NULL,
  `price` int(50) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_status`
--

INSERT INTO `order_status` (`id`, `product_id`, `product_name`, `variation_id`, `seller_id`, `customer_id`, `date`, `status`, `quantity`, `image`, `price`, `payment_method`, `address`) VALUES
(18, 28, 'Lenovo IdeaPad Slim 5', 13, 11, 11, '2024-12-26 00:07:21', 3, 1, '../public/img/675c0a9a6a2463.38697426.jpg', 5999000, 'OVO', 'Jakarta, Indonesia'),
(19, 23, 'Wireless Headphone', 3, 11, 11, '2024-12-26 00:07:21', 3, 2, '../public/img/675bfc2ec32314.85085627.jpeg', 299000, 'OVO', 'Jakarta, Indonesia'),
(20, 30, 'Chess', 1, 11, 11, '2024-12-26 00:07:57', 3, 1, '../public/img/676c4180c8b6d2.88295213.png', 199000, 'Credit Card', 'Jakarta, Indonesia'),
(21, 30, 'Chess', 2, 11, 11, '2024-12-26 00:07:57', 3, 1, '../public/img/676c4180c8b6d2.88295213.png', 199000, 'Credit Card', 'Jakarta, Indonesia'),
(22, 23, 'Wireless Headphone', 3, 11, 16, '2024-12-26 00:37:02', 3, 8, '../public/img/675bfc2ec32314.85085627.jpeg', 299000, 'Shopee', 'Jakarta, Indonesia'),
(23, 30, 'Chess', 2, 11, 16, '2024-12-26 00:38:00', 3, 4, '../public/img/676c4180c8b6d2.88295213.png', 199000, 'Shopee', 'Jakarta, Indonesia'),
(24, 31, 'Samsung A05s Smartphone 8/128 GB', 16, 17, 16, '2024-12-26 01:23:39', 3, 1, '../public/img/676cae71b55584.46786551.jpg', 2499000, 'Debit Card', 'Jakarta, Indonesia'),
(25, 23, 'Wireless Headphone', 5, 11, 16, '2024-12-26 01:23:58', 3, 2, '../public/img/675bfc2ec32314.85085627.jpeg', 299000, 'OVO', 'Jakarta, Indonesia'),
(29, 23, 'Wireless Headphone', 4, 11, 20, '2024-12-26 02:44:44', 3, 1, '../public/img/675bfc2ec32314.85085627.jpeg', 299000, 'Debit Card', 'Kyoto, Japan'),
(30, 32, 'Samsung Galaxy Tab S6', 21, 17, 20, '2024-12-26 02:45:21', 3, 2, '../public/img/676caee51ad4f4.91677727.jpg', 5999000, 'Credit Card', 'Kyoto, Japan'),
(31, 33, 'IT Powerbank Ultra PD Super Fast Charging 30W', 23, 17, 20, '2024-12-26 02:45:21', 3, 2, '../public/img/676cb19ea3c4c0.57358916.jpg', 599000, 'Credit Card', 'Kyoto, Japan'),
(32, 22, 'Tote Bag', 14, 11, 22, '2024-12-26 03:24:06', 2, 4, '../public/img/675bfc02bcfc38.13054374.jpg', 430000, 'Debit Card', 'Jakarta, Indonesia'),
(33, 23, 'Wireless Headphone', 3, 11, 22, '2024-12-26 03:24:06', 3, 2, '../public/img/675bfc2ec32314.85085627.jpeg', 299000, 'Debit Card', 'Jakarta, Indonesia'),
(34, 32, 'Samsung Galaxy Tab S6', 21, 17, 22, '2024-12-26 03:24:48', 3, 1, '../public/img/676caee51ad4f4.91677727.jpg', 5999000, 'Shopee', 'Jakarta Timur, Indonesia');

-- --------------------------------------------------------

--
-- Table structure for table `products_registry`
--

CREATE TABLE `products_registry` (
  `id` int(100) NOT NULL,
  `id_admin` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(20) NOT NULL,
  `image` varchar(255) NOT NULL,
  `stocks` int(11) NOT NULL DEFAULT 1,
  `sold_qty` int(10) NOT NULL DEFAULT 0,
  `description` text DEFAULT NULL,
  `category` varchar(50) NOT NULL,
  `time_added` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products_registry`
--

INSERT INTO `products_registry` (`id`, `id_admin`, `name`, `price`, `image`, `stocks`, `sold_qty`, `description`, `category`, `time_added`) VALUES
(21, 11, 'Gojo\'s Mini Statue', 199000, '../public/img/675cd13580a995.23030937.jpeg', 20, 0, 'Bring the ultimate sorcerer into your collection with this detailed Gojo Satoru\'s figurine. Featuring his iconic white hair and confident pose, this figurine perfectly captures the essence of the strongest Jujutsu Sorcerer.', 'Games & Hobbies', '2024-12-25 23:37:57'),
(22, 11, 'Tote Bag', 430000, '../public/img/675bfc02bcfc38.13054374.jpg', 45, 6, 'A perfect blend of style and practicality, this women\'s tote bag is crafted with high-quality material and elegant leather handles. Spacious and versatile, it’s ideal for work, shopping, or casual outings. Comes with a detachable strap for added convenience.', 'Fashion & Apparel', '2024-12-26 03:24:06'),
(23, 11, 'Wireless Headphone', 299000, '../public/img/675bfc2ec32314.85085627.jpeg', 43, 15, 'Experience immersive sound with these sleek and comfortable wireless headphones. With crystal-clear audio and long-lasting battery life, they are perfect for music lovers and gamers. Lightweight and foldable for easy portability.', 'Electronics & Gadgets', '2024-12-26 03:24:06'),
(24, 11, 'Running Shoes', 399000, '../public/img/675bfc485c4981.38321096.jpg', 69, 1, 'Step into comfort and style with these lightweight running shoes. Featuring breathable mesh material and a slip-resistant sole, they are designed for active lifestyles. Whether you\'re running, training, or walking, these shoes provide excellent support and durability.', 'Sports & Outdoor', '2024-12-26 02:20:48'),
(26, 11, 'Faber Castle Pencil', 9900, '../public/img/675bfcd420f8b2.53010041.png', 190, 0, 'Achieve precision and clarity with the Faber-Castell 9000 pencil. Known for its smooth lead and durability, this pencil is perfect for writing, sketching, and technical drawing. A must-have for artists and professionals.', 'Office & Stationery', '2024-12-25 23:38:59'),
(27, 11, 'Hardcover Book', 39900, '../public/img/675bfcf44109b1.41839117.jpg', 15, 0, 'Dive into a world of knowledge with this elegantly bound hardcover book. Featuring a durable cover and premium-quality pages, it\'s perfect for avid readers and collectors. A great addition to your library or as a thoughtful gift.', 'Books, Movies, & Media', '2024-12-25 23:40:04'),
(28, 11, 'Lenovo IdeaPad Slim 5', 5999000, '../public/img/675c0a9a6a2463.38697426.jpg', 9, 1, 'Sleek, powerful, and portable, the Lenovo IdeaPad Slim 5 is the perfect companion for work and play. Equipped with a Ryzen 7 processor, 16GB RAM, and 512GB SSD, this laptop delivers exceptional performance. The elegant design and vibrant display make it a standout choice for productivity and entertainment.<br>Specification:<br>- Ryzen 7 processor<br>- 16GB RAM<br>- 512GB SSD', 'Electronics & Gadgets', '2024-12-26 00:07:21'),
(29, 11, 'Gojo\'s Mini Figurine', 349000, '../public/img/675cd38ec85667.67239331.jpg', 15, 0, 'Original from Japan, Kondisi NEW, Officially licensed goods.', 'Games & Hobbies', '2024-12-25 23:42:05'),
(30, 11, 'Chess', 199000, '../public/img/676c4180c8b6d2.88295213.png', 44, 6, 'Play and Have Fun Playing Chess with Friends !!', 'Games & Hobbies', '2024-12-26 00:38:00'),
(31, 17, 'Samsung A05s Smartphone 8/128 GB', 2499000, '../public/img/676cae71b55584.46786551.jpg', 19, 1, 'Samsung Galaxy A05s hadir dengan faktor bentuk yang stylish, desain simpel yang menawan dengan warna-warna muda.', 'Electronics & Gadgets', '2024-12-26 01:23:39'),
(32, 17, 'Samsung Galaxy Tab S6', 5999000, '../public/img/676caee51ad4f4.91677727.jpg', 23, 3, 'Garansi Resmi dari Distributor Indonesia selama 1 Tahun<br>Deskripsi Produk :<br>Garansi Resmi dari Samsung Indonesia Selama 1 Tahun<br>Chipset Qualcomm SM7125 Snapdragon 720G (8 nm)<br>Os Android 12, One UI 4.0<br>Display 10.4 inches<br>Ram / Internal 4 GB / 128 GB<br>Simcard Nano-SIM<br>Rear Camera 8 MP<br>Front Camera 5 MP<br>Usb Type-C<br>Battery 7040 mAh', 'Electronics & Gadgets', '2024-12-26 03:24:48'),
(33, 17, 'IT Powerbank Ultra PD Super Fast Charging 30W', 599000, '../public/img/676cb19ea3c4c0.57358916.jpg', 27, 5, 'Kapasitas 10000mAh<br>Desain ringkas dan portabel<br>Super Fast Charging 30W<br>1 x USB-A & 1 x USB-C<br>Fitur Intelligent Auto Power-Off', 'Electronics & Gadgets', '2024-12-26 02:45:21'),
(35, 11, 'Kacamata', 199000, '../public/img/676cd05ed6f4d2.18727858.jpg', 60, 0, 'Kacamata yang memiliki frame kuat dan berkualitas serta nyaman dipakai.', 'Fashion & Apparel', '2024-12-26 03:41:18');

-- --------------------------------------------------------

--
-- Table structure for table `product_variations`
--

CREATE TABLE `product_variations` (
  `variation_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `variation_name` varchar(100) NOT NULL,
  `stocks` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_variations`
--

INSERT INTO `product_variations` (`variation_id`, `product_id`, `variation_name`, `stocks`) VALUES
(1, 30, 'Black & White', 24),
(2, 30, 'Brown & Cream', 20),
(3, 23, 'Black', 8),
(4, 23, 'White', 19),
(5, 23, 'Green', 16),
(6, 21, 'Normal', 20),
(7, 24, '40', 10),
(8, 24, '41', 20),
(9, 24, '42', 20),
(10, 24, '43', 19),
(11, 26, 'Normal', 190),
(12, 27, 'Normal', 15),
(13, 28, 'Normal', 9),
(14, 22, 'Normal', 45),
(15, 29, 'Normal', 15),
(16, 31, 'Pink', 4),
(17, 31, 'Black', 5),
(18, 31, 'White', 10),
(19, 32, 'Phantom Black', 5),
(20, 32, 'Young Pink', 5),
(21, 32, 'Gold and White', 3),
(22, 32, 'Serenity Blue', 10),
(23, 33, 'Pink', 6),
(24, 33, 'Black', 4),
(25, 33, 'Solid Blue', 10),
(26, 33, 'White', 6),
(27, 33, 'Violet Pink', 1),
(28, 34, 'Black', 20),
(29, 34, 'White', 20),
(30, 34, 'Brown', 30),
(31, 34, 'Black', 20),
(32, 34, 'White', 20),
(33, 34, 'Brown', 20),
(34, 35, 'Black', 20),
(35, 35, 'White', 20),
(36, 35, 'Brown', 20),
(37, 36, 'Blue', 35),
(38, 36, 'Red', 30);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `order_id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  `variation_id` int(11) NOT NULL,
  `reviewer_id` int(11) NOT NULL,
  `text` text NOT NULL,
  `rating` float NOT NULL,
  `review_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `order_id`, `product_id`, `variation_id`, `reviewer_id`, `text`, `rating`, `review_date`) VALUES
(1, 14, 22, 14, 11, 'The bag so comfortable and fashionable to wear anywhere i go and my friend want me to buy one for her\'s !!', 2.5, '2024-12-25 17:05:00'),
(2, 19, 23, 3, 11, 'Nice Headphone, i recommended it ', 4.5, '2024-12-25 17:59:00'),
(3, 23, 30, 2, 16, 'Thanks !! Arrived safely and sound', 3.5, '2024-12-25 19:00:00'),
(4, 22, 23, 3, 16, 'Love this headphone so much !!!!!!', 5, '2024-12-26 00:00:00'),
(5, 24, 31, 16, 16, 'Berfungsi dengan baik, sangat direkomendasi !!', 4, '2024-12-26 01:27:08'),
(6, 30, 32, 21, 20, 'Nice Tab !!!', 4.5, '2024-12-26 02:48:32'),
(7, 31, 33, 23, 20, 'Nice PowerBank !!!', 5, '2024-12-26 02:48:45'),
(8, 29, 23, 4, 20, 'Nice Headphone !!!', 4.5, '2024-12-26 02:48:57'),
(9, 33, 23, 3, 22, 'Saya suka sekali warna hitamnya dan suara headphonenya sangat mulus !!', 4.5, '2024-12-26 03:27:30'),
(10, 34, 32, 21, 22, 'Agak sedikit lecet di pinggiran, sisanya saya suka !!', 3.5, '2024-12-26 03:30:09');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `no_telp` varchar(25) NOT NULL,
  `address` varchar(100) NOT NULL,
  `profile_img` varchar(1000) NOT NULL DEFAULT 'https://s3.amazonaws.com/37assets/svn/765-default-avatar.png',
  `is_admin` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `no_telp`, `address`, `profile_img`, `is_admin`) VALUES
(11, 'ChthollyNS', 'jason130105@gmail.com', '$2y$10$O1aJto8EDvdu.j6eS8Dhpubn16o0lR5FlmhkKxGcBVZSaKEi2u2Iu', '081345667765', 'Jakarta, Indonesia', '../public/img/6741fce8be28f8.94203770.jpg', 1),
(16, 'user1234', 'user1234@gmail.com', '$2y$10$l7Y44nZRrsAyxI92HSFAieFizclCLtQOrgNN4hWzIuCxqUUTDLApG', '08123456789', 'Jakarta, Indonesia', 'https://s3.amazonaws.com/37assets/svn/765-default-avatar.png', 0),
(17, 'Admin#2', 'Admin#2@gmail.com', '$2y$10$S1yrsD5kvyMgMM8tVaFuOuBV8Vv.wK3YOb3lI15pMtP0T/X/pn5jm', '081345667764', 'Jakarta, Indonesia', '../public/img/676cc3ad00dac3.15333245.jpg', 1),
(20, 'stelle-chan', 'stelle@gmail.com', '$2y$10$0ESruiTeHnMhXjDo4dr/9eaYkZ/H6n5OKWwqsTleKDjYQTpc7BX32', '08991234567', 'Kyoto, Japan', '../public/img/676cbf07cdd6a0.89579497.jpg', 0),
(22, 'testuser', 'testuser@gmail.com', '$2y$10$n5HJ4ebEEmD09o4cM8wXV.AkfAJkgdRevnxsO2de8oA47lELBIDNq', '08123456789', 'Jakarta, Indonesia', '../public/img/676ccb834a6b40.77044240.jpg', 0),
(23, 'Admin#1', 'Admin#1@gmail.com', '$2y$10$X6fzpuR3cuO3V4amHImOFeNEd3KnU1hdir8SSyDeVCPRr6str40zm', '', '', 'https://s3.amazonaws.com/37assets/svn/765-default-avatar.png', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `cart_ibfk_2` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`) USING BTREE;

--
-- Indexes for table `products_registry`
--
ALTER TABLE `products_registry`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_admin` (`id_admin`),
  ADD KEY `category` (`category`);

--
-- Indexes for table `product_variations`
--
ALTER TABLE `product_variations`
  ADD PRIMARY KEY (`variation_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `order_status`
--
ALTER TABLE `order_status`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `products_registry`
--
ALTER TABLE `products_registry`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `product_variations`
--
ALTER TABLE `product_variations`
  MODIFY `variation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products_registry` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products_registry`
--
ALTER TABLE `products_registry`
  ADD CONSTRAINT `products_registry_ibfk_1` FOREIGN KEY (`id_admin`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
