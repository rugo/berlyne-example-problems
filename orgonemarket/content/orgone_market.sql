-- phpMyAdmin SQL Dump
-- version 4.6.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 28, 2016 at 06:52 PM
-- Server version: 5.5.50-0+deb8u1
-- PHP Version: 5.6.24-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
DROP DATABASE IF EXISTS orgone_market;
CREATE DATABASE orgone_market;
USE orgone_market;
--

-- --------------------------------------------------------

--
-- Table structure for table `had_free_orgone`
--

CREATE TABLE `had_free_orgone` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `img` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `seller` varchar(255) NOT NULL DEFAULT 'FreeSpirit'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `img`, `name`, `description`, `price`, `seller`) VALUES
(1, 'images/haunebu.png', 'Haunebu Construction Plans', 'One of the most secret weapons east of Aldebaran.', 400, 'FreeSpirit'),
(2, 'images/inner_earth.png', 'Map to the entrance of inner earth', 'By using this map you will be able to visit the civilisations under us.', 7000, 'FreeSpirit'),
(3, 'images/bio_photons.jpg', 'Recipe to use bio photons on food', 'With this recipe you\'ll be able to make every food healthy. By using bio photons.', 301, 'Freeman'),
(4, 'images/chemtrails.png', 'Chemtrail-Disposal-Spray Formula', 'The possession of this formula allows you to mix your own spray, to defeat the Chentrails over your property!', 500, 'A.S.'),
(5, 'images/yinyang.png', 'The Secret of Life', 'While meditating on the highest peak in tibet it came to me. The highest of all powers has told me the secret of a happy life. I was told to sell it though.', 600, 'MrKopp'),
(6, 'images/moon_base.png', 'Position of the secret moon base', 'These are the exact coordinates of the moon base, we all know exists. You\'re government doesn\'t want you to know, but here you can buy them.', 2000, 'FreeSpirit');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `coins` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `had_free_orgone`
--
ALTER TABLE `had_free_orgone`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `had_free_orgone`
--
ALTER TABLE `had_free_orgone`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
create user orgone_market identified by "W4PeV6EGmElBBpZz";
GRANT USAGE ON *.* TO orgone_market;
GRANT SELECT, INSERT, UPDATE, DELETE ON `orgone_market`.* TO 'orgone_market'@'%';

