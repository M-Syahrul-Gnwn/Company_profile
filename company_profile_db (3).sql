-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 27, 2024 at 03:40 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `company_profile_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `checkin` date NOT NULL,
  `checkout` date NOT NULL,
  `room_type` varchar(50) NOT NULL,
  `special_requests` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `cards`
--

CREATE TABLE `cards` (
  `id` int(6) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `price` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cards`
--

INSERT INTO `cards` (`id`, `title`, `price`, `description`, `image`, `created_at`) VALUES
(14, 'Deluxe Suite', 'Rp. 600.000', 'Deluxe Suite', 'https://dbijapkm3o6fj.cloudfront.net/resources/29181,1004,1,6,4,0,600,450/-4608-/20210503231944/deluxe-room.jpeg', '2024-08-26 11:37:25'),
(15, 'President Suite', 'Rp. 1.000.000', 'President Suite', 'https://dbijapkm3o6fj.cloudfront.net/resources/29181,1004,1,6,4,0,600,450/-4608-/20210503231944/deluxe-room.jpeg', '2024-08-26 21:00:14');

-- --------------------------------------------------------

--
-- Table structure for table `carousel_images`
--

CREATE TABLE `carousel_images` (
  `id` int(11) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `caption` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `carousel_images`
--

INSERT INTO `carousel_images` (`id`, `image_url`, `caption`, `created_at`) VALUES
(8, 'https://phinemo.com/wp-content/uploads/2020/07/5451_ho_00_p_1024x768-min.jpg', '', '2024-08-23 21:48:37'),
(11, 'https://cdn0-production-images-kly.akamaized.net/IyyXRhhKeG9RG1iheP16_oSj3fY=/1200x675/smart/filters:quality(75):strip_icc():format(jpeg)/kly-media-production/medias/816952/original/009819900_1424831012-bali-2.jpg', '', '2024-08-23 21:51:43'),
(12, 'https://jenishotel.info/wp-content/uploads/2016/02/hotel-indonesia-termewah-se-asia.jpg', '', '2024-08-23 21:52:21');

-- --------------------------------------------------------

--
-- Table structure for table `facilities`
--

CREATE TABLE `facilities` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `date` date NOT NULL,
  `image_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `content`, `date`, `image_url`) VALUES
(6, 'Hotel X Menjadi Hotel Terbaik di Kota Medan', 'Dikutip Dari Detik.com pada tanggal 25 Februari 2010 Hotel x menjadi hotel terbaik dengan segala fasilitas yang diunggulkan dari segi hospitality, fasilitas, dan administrasi. Hal tersebut terjadi karna menanamkan nilai mengutamakan kepuasan pelanggan. Banyak pelanggan yang meras puas setelah menginap di hotel ini dengan bukti poin bintang 5,0 pada masing masing platform penginapan seperti. traveloka, agoda, pegi-pegi dan masih banyak yang lainnya', '2024-08-23', NULL),
(7, 'GIDS Hotel Merupakan Salah Satu Hotel Terbaik Di Indonesa', 'Dikutip Dari Detik.com pada tanggal 25 Februari 2010 Hotel x menjadi hotel terbaik dengan segala fasilitas yang diunggulkan dari segi hospitality, fasilitas, dan administrasi. Hal tersebut terjadi karna menanamkan nilai mengutamakan kepuasan pelanggan. Banyak pelanggan yang meras puas setelah menginap di hotel ini dengan bukti poin bintang 5,0 pada masing masing platform penginapan seperti. traveloka, agoda, pegi-pegi dan masih banyak yang lainnya', '2024-08-23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  `nama` varchar(100) NOT NULL,
  `alamat` text DEFAULT NULL,
  `no_hp` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `role`, `nama`, `alamat`, `no_hp`) VALUES
(1, 'tes', '$2y$10$y1gmgGyeFi6DVh3RTUsDauEWoSHNScGZ8b250ArQF7A.ZbIK7g5XC', '123@gmail.com', 'user', '', NULL, NULL),
(3, 'b', '$2y$10$II77YwXkGLYy1vxgVqPeqOfzHhKaSvnHxZ2Ks64ckI65ea.2a3roG', '234@gmail.com', 'user', 'ini B', 'sa', '0812212'),
(8, 'admin', '$2y$10$fbkbgUg586FJC8NiIuAgtOQXaAdBYVFddXbZLNpVVUc5xXU.k3j.i', 'admin@gmail.com', 'admin', 'admin', 'admin', '32424234'),
(11, 'sima', '$2y$10$K4zfVAJ7Ub/7mHeRlzUBg.Gvsddk6XZMwjiuQgPOHUMmqnJmH4CyW', 'sima@gmail.com', 'user', 'sima maulina', 'blangkjeren', '08223737383');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cards`
--
ALTER TABLE `cards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carousel_images`
--
ALTER TABLE `carousel_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `facilities`
--
ALTER TABLE `facilities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
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
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `cards`
--
ALTER TABLE `cards`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `carousel_images`
--
ALTER TABLE `carousel_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `facilities`
--
ALTER TABLE `facilities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
